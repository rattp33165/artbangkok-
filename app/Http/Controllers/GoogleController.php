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

        $user = User::updateOrCreate(
            ['google_id' => $googleUser->getId()],
            [
                'name'          => $googleUser->getName(),
                'email'         => $googleUser->getEmail(),
                'google_id'     => $googleUser->getId(),
                'profile_photo' => $googleUser->getAvatar(),
                'password'      => bcrypt(str()->random(24)),
            ]
        );

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
