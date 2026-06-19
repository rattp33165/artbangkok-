<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class SignIn extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected $rules = [
        'email'    => 'required|email',
        'password' => 'required|min:6',
    ];

    public function submit()
    {
        $this->validate();

        $key = 'sign-in:' . str($this->email)->lower() . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('email', "Too many login attempts. Please try again in {$seconds} seconds.");
            $this->dispatch('toast', message: "Too many login attempts. Try again in {$seconds} seconds.", type: 'error');
            return;
        }

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::clear($key);
            session()->regenerate();
            session()->flash('toast', ['message' => 'Signed in successfully.', 'type' => 'success']);
            return redirect()->route('dashboard');
        }

        RateLimiter::hit($key, 60);
        $this->addError('email', 'Email or password is incorrect.');
        $this->dispatch('toast', message: 'Email or password is incorrect.', type: 'error');
    }

    public function render()
    {
        return view('livewire.sign-in');
    }
}
