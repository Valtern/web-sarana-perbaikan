<?php

namespace App\Livewire\Technician;

use App\Models\Repair;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TechnicianDashboard extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

                public function render()
            {
                return view('livewire.technician.technician-dashboard', [
                    'repairs' => Repair::where('technician_id', Auth::id())->latest('repair_ID')->get(),
                ]);
            }

}
