<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            session()->flash('toast', ['message' => 'Signed in successfully.', 'type' => 'success']);
            return redirect()->route('dashboard');
        }

        $this->addError('email', 'Email or password is incorrect.');
        $this->dispatch('toast', message: 'Email or password is incorrect.', type: 'error');
    }

    public function render()
    {
        return view('livewire.sign-in');
    }
}
