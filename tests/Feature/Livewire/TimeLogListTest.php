<?php

use App\Models\User;
use Livewire\Livewire;
use App\Livewire\TimeLogList;

it('renders successfully', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test(TimeLogList::class)
        ->assertStatus(200);
});
