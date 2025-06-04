<?php

namespace App\Livewire\Technician;

use Livewire\Component;
use App\Models\Repair;
use Illuminate\Support\Facades\Auth;

class ManageAssignmentStatus extends Component
{
    public $repairs;
    public $repairCount = 0;


    public function mount()
    {
        $this->loadRepairs();
        $this->repairCount = $this->repairs->count();
    }

    public function loadRepairs()
    {
        $this->repairs = Repair::with('report')
            ->where('technician_id', Auth::id())
            ->whereHas('report', function ($query) {
                $query->where('status', '!=', 'Declined');
            })
            ->get();
    }

    public function accept(int $repairId): void
    {
        $repair = Repair::with('report')->findOrFail($repairId);
        $repair->report->update(['status' => 'In_progress']);
        $repair->update(['repair_status' => 'In_progress']);
        $this->loadRepairs();
    }

public function decline(int $repairId): void
{
    $repair = Repair::with('report')->findOrFail($repairId);


    $repair->report->update(['status' => 'Declined']);


    $repair->delete();


    $this->loadRepairs();
}

    public function render()
    {
        return view('livewire.technician.menu.manage-assignment-status');
    }
    public function updateRepairStatus(int $repairId, string $status): void
{
    $repair = Repair::findOrFail($repairId);
    $repair->update(['repair_status' => $status]);
    $this->loadRepairs(); // optional: refresh list
}

public function checkNewRepair()
{
    $newRepairs = Repair::with('report')
        ->where('technician_id', Auth::id())
        ->whereHas('report', function ($query) {
            $query->where('status', '!=', 'Declined');
        })
        ->get();

    if ($newRepairs->count() > $this->repairCount) {
        $this->dispatch('toast', [
            'type' => 'info',
            'message' => '🔔 Ada tugas baru yang masuk!',
        ]);
        $this->repairCount = $newRepairs->count();
        $this->repairs = $newRepairs;
    }
}




}
