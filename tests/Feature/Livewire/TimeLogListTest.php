<?php

use Livewire\Livewire;
use App\Livewire\TimeLogList;

it('renders successfully', function () {
    Livewire::test(TimeLogList::class)
        ->assertStatus(200);
});
