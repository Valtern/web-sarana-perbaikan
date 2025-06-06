<?php

namespace App\Livewire\Lecturer;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LecturerDashboard extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.lecturer.lecturer-dashboard');
    }
}
