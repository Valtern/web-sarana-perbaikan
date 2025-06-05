<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\CriteriaTopsis;
use App\Models\AlternativeTopsis;
use App\Models\SampleTopsis;
use App\Models\Report;

class AssignPriority extends Component
{
    public $mode = 'criteria'; // or 'alternative' or 'sample'
    public $numberOfInputs = 1;

    public $criteriaInputs = [];
    public $alternativeInputs = [];
    public $sampleValues = []; // matrix: [alternative_id][criteria_id] => value

public $reportSearch = [];
public $reportResults = [];


    public function mount()
    {
        $this->criteriaInputs = [['criteria_name' => '', 'weight' => '', 'type' => 'max']];
        $this->alternativeInputs = [['alternative' => '']];
    }

    public function rules()
    {
        return match ($this->mode) {
            'criteria' => [
                'criteriaInputs.*.criteria_name' => 'required|string|max:100',
                'criteriaInputs.*.weight' => 'required|numeric|min:0',
                'criteriaInputs.*.type' => 'required|in:max,min',
            ],
            'alternative' => [
                'alternativeInputs.*.alternative' => 'required|string|max:100',
                 'alternativeInputs.*.report_id' => 'nullable|integer|exists:report,report_ID',
            ],
            default => [],
        };
    }

    public function updateFieldCount()
    {
        if ($this->mode === 'criteria') {
            $this->criteriaInputs = array_fill(0, $this->numberOfInputs, [
                'criteria_name' => '', 'weight' => '', 'type' => 'max'
            ]);
        } elseif ($this->mode === 'alternative') {
            $this->alternativeInputs = array_fill(0, $this->numberOfInputs, [
                'alternative' => ''
            ]);
        }
    }

    public function submit()
    {
        $this->validate();

        if ($this->mode === 'criteria') {
            foreach ($this->criteriaInputs as $input) {
                CriteriaTopsis::create($input);
            }
            session()->flash('message', 'Criteria added successfully!');
        }

        if ($this->mode === 'alternative') {
            foreach ($this->alternativeInputs as $input) {
                AlternativeTopsis::create($input);
            }
            session()->flash('message', 'Alternatives added successfully!');
        }

        $this->numberOfInputs = 1;
        $this->resetExcept(['mode']);
    }

    public function submitSampleValues()
    {
       if (empty($this->sampleValues)) {
        session()->flash('error', 'Cannot save: Sample matrix is empty.');
        return;
    }
        foreach ($this->sampleValues as $alternativeId => $criteriaArray) {
            foreach ($criteriaArray as $criteriaId => $value) {
                SampleTopsis::updateOrCreate(
                    ['id_alternative' => $alternativeId, 'id_criteria' => $criteriaId],
                    ['value' => $value]
                );
            }
        }
        session()->flash('message', 'Sample matrix saved successfully!');
    }

    public function clearAll()
{
    if ($this->mode === 'criteria') {
        $criteria = CriteriaTopsis::all();
        foreach ($criteria as $item) {
            $item->delete();
        }
        session()->flash('message', 'All criteria have been deleted.');
    }

    if ($this->mode === 'alternative') {
        $alternatives = AlternativeTopsis::all();
        foreach ($alternatives as $item) {
            $item->delete();
        }
        session()->flash('message', 'All alternatives have been deleted.');
    }

    if ($this->mode === 'sample') {
        $samples = SampleTopsis::all();
        foreach ($samples as $item) {
            $item->delete();
        }
        session()->flash('message', 'All sample matrix data has been deleted.');
    }

    $this->numberOfInputs = 1;
    $this->resetExcept(['mode']);
}

public function searchReports($index)
{
    $value = $this->reportSearch[$index] ?? '';

    if (strlen($value) > 1) {
        $this->reportResults[$index] = Report::where('facility_name', 'like', "%{$value}%")
            ->limit(5)
            ->get();
    } else {
        $this->reportResults[$index] = [];
    }
}


public function selectReport($index, $reportId)
{
    $report = Report::find($reportId);
    if ($report) {
        $this->alternativeInputs[$index] = [
            'alternative' => "{$report->facility_name} - {$report->report_ID}",
            'report_id' => $report->report_ID,
        ];
        $this->reportSearch[$index] = "{$report->facility_name} - {$report->report_ID}";
        $this->reportResults[$index] = [];
    }
}
public function addAllReportsAsAlternatives()
{
    $reports = Report::all();

    $this->alternativeInputs = [];
    $this->reportSearch = [];

    foreach ($reports as $index => $report) {
        $this->alternativeInputs[$index] = [
            'alternative' => "{$report->facility_name} - {$report->report_ID}",
            'report_id' => $report->report_ID,
        ];

        $this->reportSearch[$index] = "{$report->facility_name} - {$report->report_ID}";
    }

    $this->numberOfInputs = count($this->alternativeInputs);
}



    public function render()
    {
        return view('livewire.admin.assigns.assign-priority', [
            'existingCriteria' => CriteriaTopsis::all(),
            'existingAlternatives' => AlternativeTopsis::all(),
        ]);
    }
}
