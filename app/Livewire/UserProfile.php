<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfile extends Component
{
    use WithFileUploads;

    public $name = '';
    public $photo_upload;

    // Password change (only for non-Google users)
    public $current_password = '';
    public $new_password = '';
    public $new_password_confirmation = '';

    public function mount()
    {
        $this->name = Auth::user()->name;
    }

    public function saveName()
    {
        $this->validate(['name' => 'required|string|max:255']);

        Auth::user()->update(['name' => $this->name]);
        session()->flash('toast', ['message' => 'Name updated.', 'type' => 'success']);
        return redirect()->route('profile');
    }

    public function updatedPhotoUpload()
    {
        $this->validate(['photo_upload' => 'required|image|max:2048']);

        $path = $this->photo_upload->store('profiles/' . Auth::id(), 'public');
        Auth::user()->update(['profile_photo' => asset('storage/' . $path)]);
        $this->photo_upload = null;
        session()->flash('toast', ['message' => 'Profile photo updated.', 'type' => 'success']);
        return redirect()->route('profile');
    }

    public function changePassword()
    {
        $this->validate([
            'current_password'          => 'required',
            'new_password'              => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        if (!Hash::check($this->current_password, Auth::user()->password)) {
            $this->addError('current_password', 'Current password is incorrect.');
            $this->dispatch('toast', message: 'Current password is incorrect.', type: 'error');
            return;
        }

        Auth::user()->update(['password' => Hash::make($this->new_password)]);
        $this->current_password = '';
        $this->new_password = '';
        $this->new_password_confirmation = '';
        $this->dispatch('toast', message: 'Password changed successfully.', type: 'success');
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
