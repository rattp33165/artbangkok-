<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Find by google_id first, then fall back to email (existing account)
        $user = User::where('google_id', $googleUser->getId())->first()
            ?? User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            $user->update([
                'google_id'     => $googleUser->getId(),
                'profile_photo' => $googleUser->getAvatar(),
            ]);
        } else {
            $user = User::create([
                'name'          => $googleUser->getName(),
                'email'         => $googleUser->getEmail(),
                'google_id'     => $googleUser->getId(),
                'profile_photo' => $googleUser->getAvatar(),
                'password'      => bcrypt(str()->random(24)),
                'role'          => 'gallery',
            ]);
        }

        Auth::login($user);

        session()->flash('toast', ['message' => 'Signed in with Google successfully.', 'type' => 'success']);

        return redirect()->route('dashboard');
    }
}
