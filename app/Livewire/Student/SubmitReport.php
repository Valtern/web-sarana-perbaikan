<?php

namespace App\Livewire\Student;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Masmerise\Toaster\Toaster;
use App\Services\ReportService; // Import the service

class SubmitReport extends Component
{
    use WithFileUploads;
    public $facility_name, $location, $description, $category, $picture_proof, $weight = [];

    protected $rules = [
        'facility_name' => 'required|string|max:50',
        'location' => 'nullable|string|max:200',
        'description' => 'nullable|string|max:200',
        'category' => 'required|in:Electronic,Table,Chair,Desk,Computer,Miscellaneous',
        'picture_proof' => 'nullable|image|max:2048',
        'weight' => 'nullable|array',
    ];

    // Inject the Service here
    public function submit(ReportService $reportService)
    {
        $validated = $this->validate();

        $imagePath = null;
        if ($this->picture_proof) {
            $filename = time() . '_' . Str::slug($this->picture_proof->getClientOriginalName());
            $imagePath = $this->picture_proof->storeAs('proof', $filename, 'public');
        }

        // Prepare data
        $data = [
            'user_ID' => Auth::id(),
            'facility_name' => $this->facility_name,
            'location' => $this->location,
            'description' => $this->description,
            'category' => $this->category,
            'picture_proof' => $imagePath,
            'weight' => $this->weight,
        ];

        // Use the Service instead of the Model directly
        $reportService->createReport($data);

        $this->reset(['facility_name', 'location', 'description', 'category', 'picture_proof', 'weight']);

        Toaster::success('Laporan berhasil dikirim!');
        $this->dispatch('report-submitted');
    }

    public function render()
    {
        return view('livewire.student.submit-report');
    }
}
