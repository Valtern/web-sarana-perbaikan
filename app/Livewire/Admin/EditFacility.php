<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Facility;
use App\Models\Building;
use Masmerise\Toaster\Toaster;

class EditFacility extends Component
{
    public $facility_ID;
    public $name;
    public $type;
    public $building_ID;
    public $status;

    public $facility;
    public $types = ['Electronic', 'Table', 'Chair', 'Desk', 'Computer', 'Miscellaneous'];
    public $statuses = ['Good', 'Fine', 'Damaged'];
    public $buildings;

    public function mount($id)
    {
        $this->facility = Facility::findOrFail($id);
        $this->facility_ID = $this->facility->facility_ID;
        $this->name = $this->facility->name;
        $this->type = $this->facility->type;
        $this->building_ID = $this->facility->building_ID;
        $this->status = $this->facility->status;

        $this->buildings = Building::orderBy('name')->get(); // For dropdown
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:50',
            'type' => 'required|in:' . implode(',', $this->types),
            'building_ID' => 'required|exists:building,building_ID',
            'status' => 'required|in:' . implode(',', $this->statuses),
        ]);

        $this->facility->update([
            'name' => $this->name,
            'type' => $this->type,
            'building_ID' => $this->building_ID,
            'status' => $this->status,
        ]);

        Toaster::success('Facility updated successfully!');
        return redirect()->route('facility.management');
    }

    public function render()
    {
        return view('livewire.admin.menu.facility.edit-facility', [
            'buildings' => $this->buildings
        ]);
    }
}
