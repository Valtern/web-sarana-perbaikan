<?php

namespace App\Livewire\Lecturer;

use App\Models\Report;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LecturerDashboard extends Component
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
    $reports = Report::where('user_ID', Auth::id())->latest()->get();

    $chartData = [
        'in_progress' => $reports->where('status', 'In_progress')->count(),
        'pending' => $reports->where('status', 'Pending')->count(),
        'solved' => $reports->where('status', 'Solved')->count(),
    ];

    return view('livewire.lecturer.lecturer-dashboard', [
        'reports' => $reports,
        'chartData' => $chartData,
    ]);
}
}
