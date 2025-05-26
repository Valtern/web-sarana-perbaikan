<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Building;
use Masmerise\Toaster\Toaster;


class BuildingManagement extends Component
{
    public $name;
    public $building_ID;
    public $location;
    public $editing = true;
    public $editingId;
    public $showModal = false;

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        Building::create([
            'name' => $this->name,
            'location' => $this->location,
        ]);

        $this->reset('name', 'location');
        Toaster::success('Building created!'); 
        $this->closeModal();
    }

    public function delete($id)
    {
        $building = Building::find($id);

        if ($building) {
            $building->delete();
            Toaster::success(message: 'Building deleted!'); 
        }
    }

    public function render()
    {
        $buildings = Building::orderBy('building_ID', 'asc')->get();
        return view('livewire.admin.menu.building.building-management', compact('buildings'));
    }
}
