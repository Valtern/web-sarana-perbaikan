<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Facility;
use App\Models\Building;
use Masmerise\Toaster\Toaster;

class FacilityManagement extends Component
{
    public $name;
    public $facility_ID;
    public $type;
    public $building_ID;
    public $status = 'Good';
    public $editing = true;
    public $editingId;
    public $showModal = false;

    // Available types and statuses
    public $types = ['Electronic', 'Table', 'Chair', 'Desk', 'Computer', 'Miscellaneous'];
    public $statuses = ['Good', 'Fine', 'Damaged'];

    public function closeModal()
    {
        $this->showModal = false;
        $this->reset(['name', 'type', 'building_ID', 'status']);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:50',
            'type' => 'required|in:' . implode(',', $this->types),
            'building_ID' => 'required|exists:building,building_ID',
            'status' => 'required|in:' . implode(',', $this->statuses),
        ]);

        Facility::create([
            'name' => $this->name,
            'type' => $this->type,
            'building_ID' => $this->building_ID,
            'status' => $this->status,
        ]);

        $this->reset(['name', 'type', 'building_ID', 'status']);
        Toaster::success('Facility created!'); 
        $this->closeModal();
    }

    public function delete($id)
    {
        $facility = Facility::find($id);

        if ($facility) {
            $facility->delete();
            Toaster::success('Facility deleted!'); 
        }
    }

    public function render()
    {
        $facilities = Facility::orderBy('facility_ID', 'asc')->get();
        $buildings = Building::orderBy('building_ID', 'asc')->get();
        
        return view('livewire.admin.menu.facility.facility-management', [
            'facilities' => $facilities,
            'buildings' => $buildings
        ]);
    }
}