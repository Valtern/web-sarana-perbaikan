<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Building;
use Masmerise\Toaster\Toaster;


class EditBuilding extends Component
{
    public $building_ID;
    public $name;
    public $location;
    public $status;

    public $building;

    public function mount($id)
    {
        $this->building = Building::findOrFail($id);
        $this->building_ID = $this->building->building_ID;
        $this->name = $this->building->name;
        $this->location = $this->building->location;
        $this->status = $this->building->status;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:50',
            'location' => 'nullable|string|max:50',
            'status' => 'required|in:Good,Fine,Damaged',
        ]);

        $this->building->update([
            'name' => $this->name,
            'location' => $this->location,
            'status' => $this->status,
        ]);
        
        Toaster::success('Building updated successfully!'); // ✅ Use toaster

        return redirect()->route('building.management');
    }

    public function render()
    {
        return view('livewire.admin.menu.building.edit-building');
    }
}
