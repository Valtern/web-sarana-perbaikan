<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\CriteriaTopsis;
use App\Models\AlternativeTopsis;
// Unused models, can be removed for cleanliness if they are not used elsewhere in the class.
// use App\Models\SampleTopsis;
// use App\Models\Repair;

class TOPSISCalculation extends Component
{
    public $steps = [];
    public $calculated = false;
    public $showOnlyFinal = false;
    public $showStepsOnly = false;

    /**
     * Executes the full TOPSIS method from data retrieval to ranking.
     * This version uses the standard, academically-correct Vector Normalization method.
     * Any difference between this output and an Excel file is due to non-standard
     * formulas in the spreadsheet.
     */
    public function runTOPSIS()
    {
        // Step 1: Retrieve data from the database.
        $criteria = CriteriaTopsis::all();
        $alternatives = AlternativeTopsis::with('samples')->get();

        // Validate that there is enough data to perform the calculation.
        if ($criteria->isEmpty() || $alternatives->isEmpty() || $alternatives->every(fn($alt) => $alt->samples->isEmpty())) {
            session()->flash('error', 'TOPSIS cannot be calculated: No data available in criteria, alternatives, or sample matrix.');
            return;
        }

        // Initialize data structures for the calculation.
        $decisionMatrix = [];
        $weights = [];
        $types = [];

        // Build the initial decision matrix from alternatives and criteria.
        foreach ($criteria as $criterion) {
            $weights[$criterion->criteria_topsis_id] = $criterion->weight;
            $types[$criterion->criteria_topsis_id] = $criterion->type;
        }

        foreach ($alternatives as $alternative) {
            foreach ($criteria as $criterion) {
                $sample = $alternative->samples->firstWhere('id_criteria', $criterion->criteria_topsis_id);
                $decisionMatrix[$alternative->id_alternative][$criterion->criteria_topsis_id] = $sample ? $sample->value : 0;
            }
        }
        $this->steps['decisionMatrix'] = $decisionMatrix;


        // Step 1.5: Normalize the criteria weights so that they sum to 1.
        $totalWeight = array_sum($weights);
        $normalizedWeights = [];
        if ($totalWeight > 0) {
            foreach ($weights as $criterionId => $weight) {
                $normalizedWeights[$criterionId] = $weight / $totalWeight;
            }
        } elseif (count($criteria) > 0) {
            $equalWeight = 1 / count($criteria);
            foreach ($weights as $criterionId => $weight) {
                $normalizedWeights[$criterionId] = $equalWeight;
            }
        }
        $this->steps['normalizedWeights'] = $normalizedWeights;

        // --- STANDARD TEXTBOOK TOPSIS ALGORITHM ---

        // Step 2: Calculate normalization divisors using Vector Normalization.
        // The divisor for each criterion is the square root of the sum of the squares of its values.
        // Formula: divisor_j = sqrt(sum(X_ij^2)) for i=1 to m
        $divisors = [];
        foreach ($criteria as $criterion) {
            $sumSquares = 0;
            foreach ($alternatives as $alternative) {
                $value = $decisionMatrix[$alternative->id_alternative][$criterion->criteria_topsis_id];
                $sumSquares += pow($value, 2);
            }
            $divisors[$criterion->criteria_topsis_id] = sqrt($sumSquares);
        }
        $this->steps['divisors'] = $divisors;

        // Step 3: Normalize the decision matrix.
        // Each value in the matrix is divided by its column's divisor.
        // Formula: R_ij = X_ij / divisor_j
        // **This is the most likely step where your Excel file differs.**
        // **Compare the output of this `normalizedMatrix` with your Excel sheet to find the discrepancy.**
        $normalizedMatrix = [];
        foreach ($alternatives as $alternative) {
            foreach ($criteria as $criterion) {
                $value = $decisionMatrix[$alternative->id_alternative][$criterion->criteria_topsis_id];
                $divisor = $divisors[$criterion->criteria_topsis_id];
                $normalizedMatrix[$alternative->id_alternative][$criterion->criteria_topsis_id] = $divisor != 0 ? $value / $divisor : 0;
            }
        }
        $this->steps['normalizedMatrix'] = $normalizedMatrix;

        // Step 4: Calculate the weighted normalized decision matrix.
        // Formula: V_ij = R_ij * w_j
        $weightedMatrix = [];
        foreach ($alternatives as $alternative) {
            foreach ($criteria as $criterion) {
                $normalizedValue = $normalizedMatrix[$alternative->id_alternative][$criterion->criteria_topsis_id];
                $weightedMatrix[$alternative->id_alternative][$criterion->criteria_topsis_id] = $normalizedValue * $normalizedWeights[$criterion->criteria_topsis_id];
            }
        }
        $this->steps['weightedMatrix'] = $weightedMatrix;

        // Step 5: Determine the Ideal Best (A+) and Ideal Worst (A-) solutions.
        $idealSolutions = ['positive' => [], 'negative' => []];
        foreach ($criteria as $criterion) {
            $column = array_column($weightedMatrix, $criterion->criteria_topsis_id);
            $criterionType = strtolower($types[$criterion->criteria_topsis_id]);

            if ($criterionType === 'benefit' || $criterionType === 'max') {
                $idealSolutions['positive'][$criterion->criteria_topsis_id] = max($column);
                $idealSolutions['negative'][$criterion->criteria_topsis_id] = min($column);
            } else { // 'cost' or 'min'
                $idealSolutions['positive'][$criterion->criteria_topsis_id] = min($column);
                $idealSolutions['negative'][$criterion->criteria_topsis_id] = max($column);
            }
        }
        $this->steps['idealSolutions'] = $idealSolutions;

        // Step 6: Calculate the separation distance using standard Euclidean distance.
        // Formula: D_i+ = sqrt(sum((V_ij - V_j+)^2)) and D_i- = sqrt(sum((V_ij - V_j-)^2))
        $distances = ['positive' => [], 'negative' => []];
        foreach ($alternatives as $alternative) {
            $sumPositive = 0;
            $sumNegative = 0;
            foreach ($criteria as $criterion) {
                $value = $weightedMatrix[$alternative->id_alternative][$criterion->criteria_topsis_id];
                $sumPositive += pow($value - $idealSolutions['positive'][$criterion->criteria_topsis_id], 2);
                $sumNegative += pow($value - $idealSolutions['negative'][$criterion->criteria_topsis_id], 2);
            }
            $distances['positive'][$alternative->id_alternative] = sqrt($sumPositive);
            $distances['negative'][$alternative->id_alternative] = sqrt($sumNegative);
        }
        $this->steps['distances'] = $distances;


        // Step 7: Calculate the relative closeness (preference score) to the ideal solution.
        // Formula: C_i = D_i- / (D_i+ + D_i-)
        $preference = [];
        foreach ($alternatives as $alternative) {
            $dPositive = $distances['positive'][$alternative->id_alternative];
            $dNegative = $distances['negative'][$alternative->id_alternative];
            $totalDistance = $dPositive + $dNegative;
            $preference[$alternative->id_alternative] = $totalDistance != 0 ? $dNegative / ($dPositive + $dNegative) : 0;
        }
        $this->steps['preference'] = $preference;

        // Step 8: Rank the alternatives and assign a priority based on the rank.
        arsort($preference); // Sort alternatives by score in descending order.

        $rankings = [];
        $total = count($preference);
        $thresholdHigh = ceil($total * 0.3);
        $thresholdMedium = ceil($total * 0.6);
        $currentRank = 1;

        foreach ($preference as $altId => $score) {
            $alt = AlternativeTopsis::find($altId);
            $priority = 'Low'; // Default priority
            if ($currentRank === 1) {
                $priority = 'Very High';
            } elseif ($currentRank <= $thresholdHigh) {
                $priority = 'High';
            } elseif ($currentRank <= $thresholdMedium) {
                $priority = 'Medium';
            }

            if ($alt && $alt->report) {
                $alt->report->priority_Assignment = $priority;
                $alt->report->save();
            }

            $rankings[] = [
                'alternative' => $alt->alternative ?? 'Unknown Alternative ' . $altId,
                'score' => $score,
                'priority' => $priority,
                'rank' => $currentRank,
            ];

            $currentRank++;
        }

        $this->steps['result'] = $rankings;
        $this->calculated = true;
    }

    public function render()
    {
        return view('livewire.admin.topsis-calculation', [
            'finalOnly' => $this->showOnlyFinal,
            'stepsOnly' => $this->showStepsOnly,
        ]);
    }

    public function mount()
    {
        if ($this->showStepsOnly && !$this->calculated) {
            $this->runTOPSIS();
        }
    }
}
