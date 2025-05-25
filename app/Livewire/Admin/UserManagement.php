<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Masmerise\Toaster\Toaster;

class UserManagement extends Component
{
    public $name, $email, $password, $role, $editingId;
    public $showModal = false;
    public $roles = ['admin', 'student', 'lecturer', 'staff', 'technician'];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role' => 'required|in:admin,student,lecturer,staff,technician',
    ];

    public function openModal()
    {
        $this->reset(['name', 'email', 'password', 'role', 'editingId']);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        Toaster::success('User created!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->editingId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->password = ''; // Leave password blank
        $this->showModal = true;
    }

    public function update()
    {
        $user = User::findOrFail($this->editingId);
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,student,lecturer,staff,technician',
        ]);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        Toaster::success('User updated!');
        $this->closeModal();
    }

    public function delete($id)
    {
        User::destroy($id);
        Toaster::success('User deleted!');
    }
    public function render()
{
    $users = User::all(); // Or paginate if needed
    return view('livewire.admin.menu.user.user-management', [
        'users' => $users
    ]);
}
}
