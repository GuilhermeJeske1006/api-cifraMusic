<?php

use App\Models\{Music, Rhythm, Singer, User};

use function Pest\Laravel\{actingAs, getJson};

it('should show the music selected', function () {
    // Arrange
    $user = User::factory()->create();
    Rhythm::factory(10)->create();
    Singer::factory(10)->create();
    $music = Music::factory()->count(1)->create()->first();
    actingAs($user);

    // Act
    $response = getJson(route('music.show', ['music' => $music]));

    // Assert
    $response
        ->assertStatus(200);

});
