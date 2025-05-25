<?php

namespace App\Livewire\Staff;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Masmerise\Toaster\Toaster;



class SubmitReport extends Component
{
    use WithFileUploads;

    public $facility_name, $location, $description, $category, $picture_proof;

    protected $rules = [
        'facility_name' => 'required|string|max:50',
        'location' => 'nullable|string|max:200',
        'description' => 'nullable|string|max:200',
        'category' => 'required|in:Electronic,Table,Chair,Desk,Computer,Miscellaneous',
        'picture_proof' => 'nullable|image|max:2048',
    ];

public function submit()
{
    $validated = $this->validate();

    $imagePath = null;

    if ($this->picture_proof) {
        $filename = time() . '_' . Str::slug($this->picture_proof->getClientOriginalName());
        $imagePath = $this->picture_proof->storeAs('proof', $filename, 'public');
    }

    Report::create([
        'user_ID' => Auth::id(),
        'facility_name' => $this->facility_name,
        'location' => $this->location,
        'description' => $this->description,
        'category' => $this->category,
        'picture_proof' => $imagePath ? "storage/{$imagePath}" : null,
    ]);

    $this->reset(['facility_name', 'location', 'description', 'category', 'picture_proof']);

    // Fire toaster event
    Toaster::success('User updated successfully!');


    $this->dispatch('report-submitted');
}

    public function render()
    {
        return view('livewire.staff.submit-report');
    }
}
