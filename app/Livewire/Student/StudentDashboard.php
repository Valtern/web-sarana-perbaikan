<?php

namespace App\Livewire\Student;

use App\Models\Report;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class StudentDashboard extends Component
{
    public $user;
    public $selectedReport;
    

    public function mount()
    {
        $this->user = Auth::user();
    }
     public function viewReport($reportId)
    {
        $this->selectedReport = $this->reports->firstWhere('report_ID', $reportId);
    }

    public function render()
    {
        return view('livewire.student.student-dashboard', [
            'reports' => Report::where('user_ID', Auth::id())->latest()->get(),
        ]);
    }
}
