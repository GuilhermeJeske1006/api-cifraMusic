<?php

use App\Models\{Music, Rhythm, Singer, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, put, putJson};

it('should be able to update a singer', function () {
    // Arrange
    $user   = User::factory()->create();
    $singer = Singer::factory()->create()->first();

    actingAs($user);

    // Act
    putJson(route('singer.update', ['singer' => $singer]), [
        'name_singer' => $singer->name_singer,

    ])->assertSuccessful();

    $singer->refresh();

    assertDatabaseHas('singers', [
        'name_singer' => $singer->name_singer,

    ]);
});

// test('when updating the singer, the name_singer are required', function () {
//     // Arrange
//     $user = User::factory()->create();
//     $singer = Singer::factory()->create();

//     actingAs($user);

//     // Act - Valid update
//     putJson(route('singer.update', ['singer' => $singer]), [
//         'name_singer' => $singer->name_singer,
//     ])->assertSuccessful();

//     // Act - Invalid update
//     putJson(route('singer.update', ['singer' => $singer]), [
//         'name_singer' => null
//     ])->assertJsonValidationErrors(['name_singer']);
// });
