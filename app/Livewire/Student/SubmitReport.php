<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class SubmitReport extends Component
{
    use WithFileUploads;

    public $facility_name;
    public $location;
    public $description;
    public $category;
    public $picture_proof;

    protected $rules = [
        'facility_name' => 'required|string|max:50',
        'location' => 'nullable|string|max:200',
        'description' => 'nullable|string|max:200',
        'category' => 'required|in:Electronic,Table,Chair,Desk,Computer,Miscellaneous',
        'picture_proof' => 'nullable|image|max:2048', // 2MB max
    ];

    public function submit()
    {
        $validated = $this->validate();

        $imagePath = null;
        if ($this->picture_proof) {
            $imagePath = $this->picture_proof->store('proof', 'public');
        }

        Report::create([
            'user_ID' => Auth::id(),
            'facility_name' => $this->facility_name,
            'location' => $this->location,
            'description' => $this->description,
            'category' => $this->category,
            'picture_proof' => $imagePath ? "storage/$imagePath" : null,
        ]);

        // Reset form
        $this->reset(['facility_name', 'location', 'description', 'category', 'picture_proof']);

        // Emit event to update report table
        $this->dispatch('report-submitted');

        session()->flash('success', 'Report submitted successfully.');
    }

    public function render()
    {
        return view('livewire.student.submit-report');
    }
}
