<?php

namespace App\Livewire\Lecturer;

use Livewire\Component;
use App\Models\Building;
use Masmerise\Toaster\Toaster;


class BuildingList extends Component
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

    public function render()
    {
        $buildings = Building::orderBy('building_ID', 'asc')->get();
        return view('livewire.lecturer.menu.lecturer-building-list', compact('buildings'));
    }
}


