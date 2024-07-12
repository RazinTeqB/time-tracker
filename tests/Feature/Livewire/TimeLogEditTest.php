<?php

use App\Models\User;
use Livewire\Livewire;
use App\Livewire\TimeLogEdit;

it('renders successfully', function () {
    /** @var User */
    $user = User::factory()->create();
    $timeLog = $user->timeLogs()->create([
        'title' => fake()->name(),
        'started_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
    ]);

    Livewire::actingAs($user)
        ->test(TimeLogEdit::class, ['timeLog' => $timeLog])
        ->assertStatus(200);
});
