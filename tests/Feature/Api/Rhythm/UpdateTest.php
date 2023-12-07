<?php

use App\Models\{Music, Rhythm, Singer, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, put, putJson};

it('should be able to update a rhythm', function () {
    // Arrange
    $user   = User::factory()->create();
    $rhythm = rhythm::factory()->create()->first();

    actingAs($user);

    // Act
    putJson(route('rhythm.update', ['rhythm' => $rhythm]), [
        'name_rhythm' => $rhythm->name_rhythm,

    ])->assertSuccessful();

    $rhythm->refresh();

    assertDatabaseHas('rhythms', [
        'name_rhythm' => $rhythm->name_rhythm,

    ]);
});

test('when updating the rhythm, the name_rhythm are required', function () {
    // Arrange
    $user   = User::factory()->create();
    $rhythm = rhythm::factory()->create();

    actingAs($user);

    // Act - Valid update
    putJson(route('rhythm.update', ['rhythm' => $rhythm]), [
        'name_rhythm' => $rhythm->name_rhythm,
    ])->assertSuccessful();

    // Act - Invalid update
    putJson(route('rhythm.update', ['rhythm' => $rhythm]), [
        'name_rhythm' => null,
    ])->assertJsonValidationErrors(['name_rhythm']);
});
