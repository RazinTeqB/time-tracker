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

    Route::get('/projects', \App\Livewire\Projects\Index::class)->name('projects.index');
    Route::get('/projects/create', \App\Livewire\Projects\Create::class)->name('projects.create');
    Route::get('/projects/show/{project}', \App\Livewire\Projects\Show::class)->name('projects.show');
    Route::get('/projects/update/{project}', \App\Livewire\Projects\Edit::class)->name('projects.edit');
});

require __DIR__ . '/auth.php';
