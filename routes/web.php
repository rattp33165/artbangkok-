<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;

Route::get('/', function () {
    return view('home');
});

// TEMPORARY — delete after use
Route::get('/run-storage-link', function () {
    Artisan::call('storage:link');
    return 'Done: storage linked.';
});


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
