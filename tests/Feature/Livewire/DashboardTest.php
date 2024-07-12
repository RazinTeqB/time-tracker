<?php

use App\Models\User;
use Livewire\Livewire;
use App\Livewire\Dashboard;

it('renders successfully', function () {
    $user = User::factory()->create();
    Livewire::actingAs($user)
        ->test(Dashboard::class)
        ->assertStatus(200);
});
