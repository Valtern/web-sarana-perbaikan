<?php

namespace App\Livewire\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $profile_picture = '';
    public $photo;

    public User $user;

    public function mount(): void
    {
        $this->user = Auth::user();
        
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->profile_picture = $this->user->profile_picture 
            ? Storage::url($this->user->profile_picture)
            : "https://pn-solok.go.id/images/pas_photo/blank-profile-picture.png";
    }

    public function deleteProfilePhoto()
    {
        if ($this->user->profile_picture) {
            $user = Auth::user();
            Storage::disk('public')->delete($this->user->profile_picture);
            $user->profile_picture = null;
            $user->save();
            // $user->update(['profile_picture' => 'https://pn-solok.go.id/images/pas_photo/blank-profile-picture.png']);

            $this->profile_picture = "https://pn-solok.go.id/images/pas_photo/blank-profile-picture.png";
        }
    }

    public function updateProfileInformation()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'photo' => 'nullable|image|max:2048', // max 2MB
        ]);

        $user = Auth::user();

        if ($this->photo) {
            $photoPath = $this->photo->store('profile-photos', 'public');
            $user->profile_picture = $photoPath;
        }

        $user->name = $this->name;
        $user->email = $this->email;
        $this->profile_picture = $photoPath;
        $user->save();
        

        $this->dispatch('profile-updated');
        session()->flash('status', 'Profile updated!');
    }

    public function resendVerificationNotification(): void
    {
        if ($this->user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $this->user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    public function render()
    {
        return view('livewire.settings.profile');
    }
}