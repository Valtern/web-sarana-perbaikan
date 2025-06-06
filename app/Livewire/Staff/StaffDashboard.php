<?php

namespace App\Livewire\Staff;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StaffDashboard extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.staff.staff-dashboard');
    }
}
