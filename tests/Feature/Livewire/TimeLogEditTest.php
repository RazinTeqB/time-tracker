<?php

use Livewire\Livewire;
use App\Livewire\TimeLogEdit;

it('renders successfully', function () {
    Livewire::test(TimeLogEdit::class)
        ->assertStatus(200);
});
