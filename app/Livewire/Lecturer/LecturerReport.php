<?php

namespace App\Livewire\Lecturer;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class LecturerReport extends Component
{
    use WithFileUploads;

    public $facility_name;
    public $location;
    public $description;
    public $category;
    public $picture_proof;
    public $weight = [];

    public $reports;

    public function mount()
    {
        $this->reports = Report::with('user')
            ->where('user_ID', auth()->id())
            ->latest()
            ->get();
    }

    public function submit()
{
    $this->validate([
        'facility_name' => 'required|string|max:50',
        'location' => 'nullable|string|max:200',
        'description' => 'nullable|string|max:200',
        'category' => 'required|in:Electronic,Table,Chair,Desk,Computer,Miscellaneous',
        'picture_proof' => 'nullable|image|max:2048',
        'weight' => 'nullable|array',
    ]);

    $imagePath = null;
    if ($this->picture_proof) {
        $imagePath = $this->picture_proof->store('proof', 'public');
    }

    Report::create([
        'user_ID' => auth()->id(),
        'facility_name' => $this->facility_name,
        'location' => $this->location,
        'description' => $this->description,
        'category' => $this->category,
        'picture_proof' => $imagePath,
        'weight' => $this->weight,
    ]);

    session()->flash('success', 'Report submitted successfully.');
    $this->reset();
}


    public function render()
    {
        return view('livewire.lecturer.lecturer-report');
    }
}
