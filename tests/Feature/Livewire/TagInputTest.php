<?php

use App\Models\User;
use Livewire\Livewire;
use App\Livewire\TagInput;

it('renders successfully', function () {
    /** @var User */
    $user = User::factory()->create();
    Livewire::actingAs($user)
        ->test(TagInput::class)
        ->assertStatus(200);
});
