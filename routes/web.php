<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('sign-in');
})->name('home');

Route::get('/ticket', function () {
    return view('ticket');
})->name('ticket');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/exhibition-preview', function () {
    return view('exhibition-preview');
})->name('exhibition-preview');

Route::get('/visitor-information', function () {
    return view('visitor-information');
})->name('visitor-information');

Route::get('/fair-and-event', function () {
    return view('fair-and-event');
})->name('fair-and-event');

Route::get('/exhibitors', function () {
    return view('exhibitors');
})->name('exhibitors');


// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/sign-in', function () { return view('auth.sign-in'); })->name('sign-in');
    Route::get('/sign-up', function () { return view('auth.sign-up'); })->name('sign-up');
});

Route::post('/sign-out', [AuthController::class, 'signOut'])->name('sign-out');

// Google OAuth
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/application', function () { return view('dashboard'); })->name('dashboard');
    Route::get('/profile', function () { return view('profile'); })->name('profile');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', fn() => view('admin.users'))->name('users');
    Route::get('/applications', fn() => view('admin.applications'))->name('applications');
    Route::get('/applications/{application}', function (\App\Models\Application $application) {
        return view('admin.application-detail', compact('application'));
    })->name('applications.show');
});
