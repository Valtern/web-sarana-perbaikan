<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\CriteriaTopsis;
use App\Models\AlternativeTopsis;
use App\Models\SampleTopsis;

class AssignPriority extends Component
{
    public $mode = 'criteria'; // or 'alternative' or 'sample'
    public $numberOfInputs = 1;

    public $criteriaInputs = [];
    public $alternativeInputs = [];
    public $sampleValues = []; // matrix: [alternative_id][criteria_id] => value

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

    public function render()
    {
        return view('livewire.admin.assigns.assign-priority', [
            'existingCriteria' => CriteriaTopsis::all(),
            'existingAlternatives' => AlternativeTopsis::all(),
        ]);
    }
}
