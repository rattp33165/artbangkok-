<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class SignUp extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    protected $rules = [
        'name'     => 'required|min:2',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ];

    protected $messages = [
        'name.required' => 'Gallery name is required.',
        'name.min'      => 'Gallery name must be at least 2 characters.',
    ];

    public function submit()
    {
        $key = 'sign-up:' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('email', "Too many attempts. Please try again in {$seconds} seconds.");
            return;
        }

        $this->validate();

        RateLimiter::hit($key, 60);

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => bcrypt($this->password),
            'role'     => 'gallery',
        ]);

        Auth::login($user);

        session()->flash('toast', ['message' => 'Account created successfully. Welcome!', 'type' => 'success']);
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.sign-up');
    }
}
