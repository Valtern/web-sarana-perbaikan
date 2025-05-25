<?php

namespace App\Livewire\Technician;

use Livewire\Component;
use App\Models\Facility;
use App\Models\Building;
use Masmerise\Toaster\Toaster;

class FacilityList extends Component
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

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:50',
            'type' => 'required|in:' . implode(',', $this->types),
            'building_ID' => 'required|exists:building,building_ID',
            'status' => 'required|in:' . implode(',', $this->statuses),
        ]);

        $this->reset(['name', 'type', 'building_ID', 'status']);
        Toaster::success('Facility created!'); 
        $this->closeModal();
    }

     public function render()
    {
        $facilities = Facility::orderBy('facility_ID', 'asc')->get();
        $buildings = Building::orderBy('building_ID', 'asc')->get();
        
        return view('livewire.lecturer.lecturer-facility-list', [
            'facilities' => $facilities,
            'buildings' => $buildings
        ]);
    }
}


