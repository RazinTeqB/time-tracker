<?php

use Livewire\Livewire;
use App\Livewire\SwitchDarkTheme;

it('renders successfully', function () {
    Livewire::test(SwitchDarkTheme::class)
        ->assertStatus(200);
});
