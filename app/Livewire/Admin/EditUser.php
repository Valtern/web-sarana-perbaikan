<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Masmerise\Toaster\Toaster;

class EditUser extends Component
{
    public $user;
    public $userId;
    public $name;
    public $email;
    public $password;
    public $role;

    public $roles = ['admin', 'student', 'lecturer', 'staff', 'technician'];

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
        $this->userId = $this->user->id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role = $this->user->role;
        $this->password = ''; // optional input
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'role' => 'required|in:' . implode(',', $this->roles),
            'password' => 'nullable|min:6',
        ]);

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => $this->password ? Hash::make($this->password) : $this->user->password,
        ]);

        Toaster::success('User updated successfully!');
        return redirect()->route('user.management'); // Make sure this route exists
    }

    public function render()
    {
        return view('livewire.admin.menu.user.edit-user', [
            'roles' => $this->roles
        ]);
    }
}
