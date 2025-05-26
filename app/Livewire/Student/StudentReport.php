<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Report;

class StudentReport extends Component
{
    use WithFileUploads;

    public $facility_name;
    public $location;
    public $description;
    public $category;
    public $picture_proof;

    public $reports;

    public function mount()
    {
        $this->reports = Report::with('user')
            ->where('user_id', auth()->id())
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
        ]);

        $imagePath = null;

        if ($this->picture_proof) {
            $filename = time() . '_' . preg_replace('/\s+/', '_', $this->picture_proof->getClientOriginalName());
            $this->picture_proof->storeAs('public/proof', $filename); // stores to storage/app/public/proof
            $imagePath = 'proof/' . $filename;
        }

        Report::create([
            'user_ID' => Auth::id(),
            'facility_name' => $this->facility_name,
            'location' => $this->location,
            'description' => $this->description,
            'category' => $this->category,
            'picture_proof' => $imagePath,
        ]);

        // Refresh reports
        $this->mount(); // reload the reports
        $this->reset(['facility_name', 'location', 'description', 'category', 'picture_proof']);
        session()->flash('success', 'Report submitted successfully.');
    }

    public function render()
    {
        return view('livewire.student.student-report');
    }
}
