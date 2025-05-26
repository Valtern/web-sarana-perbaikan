<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Repair;
use App\Models\Report;
use Livewire\Component;
use Livewire\WithPagination;
use Masmerise\Toaster\Toaster;

class AssignTechnician extends Component
{
    use WithPagination;

    public $facility_report_id;
    public $technician_id;
    public $notes;
    public $editRepairId = null;

    protected $rules = [
        'facility_report_id' => 'required|exists:report,report_ID',
        'technician_id' => 'required|exists:users,id',
    ];

    public function store()
    {
        $this->validate();

        if ($this->editRepairId) {
            $repair = Repair::find($this->editRepairId);

            if ($repair) {
                $repair->update([
                    'technician_id' => $this->technician_id,
                    'notes' => $this->notes,
                ]);
                Toaster::success('Repair updated!');
            } else {
                Toaster::error('Repair not found!');
            }
        } else {
            Repair::create([
                'facility_report_id' => $this->facility_report_id,
                'technician_id' => $this->technician_id,
                'repair_status' => 'Not_started',
                'notes' => $this->notes,
            ]);
            Toaster::success('Technician Assigned!');
        }

        $this->resetForm();
        $this->resetPage();
    }

    public function delete($repair_ID)
    {
        $repair = Repair::find($repair_ID);
        if ($repair) {
            $repair->delete();
            Toaster::success('Repair deleted!');
        } else {
            Toaster::error('Repair not found!');
        }
    }

    public function resetForm()
    {
        $this->reset(['facility_report_id', 'technician_id', 'notes', 'editRepairId']);
    }

   public function render()
    {
    $technicians = User::where('role', 'technician')->get();
    $reports = Report::where('status', '!=', 'Completed')->get();
    $repairs = Repair::with(['report', 'technician'])->latest()->paginate(10);

    return view('livewire.admin.assigns.assign-technician', compact('technicians', 'reports', 'repairs'));  
    }

}
