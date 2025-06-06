<?php

namespace App\Livewire\Technician;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TechnicianDashboard extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.technician.technician-dashboard');
    }
}
