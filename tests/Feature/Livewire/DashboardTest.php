<?php

use Livewire\Livewire;
use App\Livewire\Dashboard;

it('renders successfully', function () {
    Livewire::test(Dashboard::class)
        ->assertStatus(200);
});
