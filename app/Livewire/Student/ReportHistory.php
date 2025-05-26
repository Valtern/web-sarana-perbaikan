<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportHistory extends Component
{
    public function render()
    {
        return view('livewire.student.report-history', [
            'reports' => Report::where('user_ID', Auth::id())->latest()->get(),
        ]);
    }
}
