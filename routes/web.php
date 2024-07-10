<?php

use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    // Route::view('dashboard', 'dashboard')
    //     ->middleware(['auth', 'verified'])
    //     ->name('dashboard');
    Route::get('dashboard', Dashboard::class)
        ->name('dashboard');
    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');
});

require __DIR__ . '/auth.php';
