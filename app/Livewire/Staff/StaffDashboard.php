<?php

namespace App\Livewire\Staff;

use App\Models\Report;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class StaffDashboard extends Component
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

    return view('livewire.staff.staff-dashboard', [
        'reports' => $reports,
        'chartData' => $chartData,
    ]);
}
}
