<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\CriteriaTopsis;
use App\Models\AlternativeTopsis;
use App\Models\SampleTopsis;
use App\Models\Repair;

class TOPSISCalculation extends Component
{
    public $steps = [];
    public $calculated = false;
    public $showOnlyFinal = false;
    public $showStepsOnly = false;


    public function runTOPSIS()
    {
        // Step 1: Retrieve data
        $criteria = CriteriaTopsis::all();
        $alternatives = AlternativeTopsis::with('samples')->get();

            // Check if there's no data
    if ($criteria->isEmpty() || $alternatives->isEmpty() || $alternatives->every(fn($alt) => $alt->samples->isEmpty())) {
        session()->flash('error', 'TOPSIS cannot be calculated: No data available in criteria, alternatives, or sample matrix.');
        return;
    }


        // Initialize structures
        $decisionMatrix = [];
        $weights = [];
        $types = [];

        // Build decision matrix and extract weights/types
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

        // Step 2: Calculate normalization divisors
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

        // Step 3: Normalize the decision matrix
        $normalizedMatrix = [];
        foreach ($alternatives as $alternative) {
            foreach ($criteria as $criterion) {
                $value = $decisionMatrix[$alternative->id_alternative][$criterion->criteria_topsis_id];
                $normalizedMatrix[$alternative->id_alternative][$criterion->criteria_topsis_id] = $divisors[$criterion->criteria_topsis_id] != 0 ? $value / $divisors[$criterion->criteria_topsis_id] : 0;
            }
        }

        $this->steps['normalizedMatrix'] = $normalizedMatrix;

        // Step 4: Calculate the weighted normalized matrix
        $weightedMatrix = [];
        foreach ($alternatives as $alternative) {
            foreach ($criteria as $criterion) {
                $normalizedValue = $normalizedMatrix[$alternative->id_alternative][$criterion->criteria_topsis_id];
                $weightedMatrix[$alternative->id_alternative][$criterion->criteria_topsis_id] = $normalizedValue * $weights[$criterion->criteria_topsis_id];
            }
        }

        $this->steps['weightedMatrix'] = $weightedMatrix;

        // Step 5: Determine ideal solutions
        $idealSolutions = ['positive' => [], 'negative' => []];
        foreach ($criteria as $criterion) {
            $column = array_column($weightedMatrix, $criterion->criteria_topsis_id);
            if ($criterion->type === 'max') {
                $idealSolutions['positive'][$criterion->criteria_topsis_id] = max($column);
                $idealSolutions['negative'][$criterion->criteria_topsis_id] = min($column);
            } else {
                $idealSolutions['positive'][$criterion->criteria_topsis_id] = min($column);
                $idealSolutions['negative'][$criterion->criteria_topsis_id] = max($column);
            }
        }

        $this->steps['idealSolutions'] = $idealSolutions;

        // Step 6: Calculate distances to ideal solutions
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

        // Step 7: Calculate preference scores
        $preference = [];
        foreach ($alternatives as $alternative) {
            $dPositive = $distances['positive'][$alternative->id_alternative];
            $dNegative = $distances['negative'][$alternative->id_alternative];
            $preference[$alternative->id_alternative] = ($dPositive + $dNegative) != 0 ? $dNegative / ($dPositive + $dNegative) : 0;
        }

        $this->steps['preference'] = $preference;

// Step 8: Determine rankings
arsort($preference); // Sort from best to worst

$rankings = [];
$total = count($preference);
$thresholdHigh = ceil($total * 0.3);
$thresholdMedium = ceil($total * 0.6);
$currentRank = 1;

foreach ($preference as $altId => $score) {
    $alt = AlternativeTopsis::find($altId);

    // Determine priority based on rank
    $priority = 'Low'; // default
    if ($currentRank === 1) {
        $priority = 'Very High';
    } elseif ($currentRank <= $thresholdHigh) {
        $priority = 'High';
    } elseif ($currentRank <= $thresholdMedium) {
        $priority = 'Medium';
    }

    // Update related report based on alternative ID (assuming it's report_ID)
$report = $alt->report; // cleaner if relationship exists
if ($report) {
    $report->priority_Assignment = $priority;
    $report->save();
}


    $rankings[] = [
        'alternative' => $alt->alternative ?? 'Unknown',
        'score' => $score,
        'priority' => $priority,
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
