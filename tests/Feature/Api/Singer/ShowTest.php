<?php

use App\Models\{Music, Rhythm, Singer, User};

use function Pest\Laravel\{actingAs, getJson};

it('should show the singer selected', function () {
    // Arrange
    $user   = User::factory()->create();
    $singer = Singer::factory(10)->create()->first();
    actingAs($user);

    // Act
    $response = getJson(route('singer.show', ['singer' => $singer]));

    // Assert
    $response
        ->assertStatus(200)
        ->assertJson([
            'data' => [
                'id'          => $singer->id,
                'name_singer' => $singer->name_singer,
            ],
        ]);
});
