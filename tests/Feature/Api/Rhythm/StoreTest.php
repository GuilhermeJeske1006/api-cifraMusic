<?php

use App\Models\{Rhythm, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, postJson};

it('should be able to store a new rhythm', function () {
    $user   = User::factory()->create();
    $rhythm = Rhythm::factory()->create();

    actingAs($user);

    postJson(route('rhythm.store'), [
        'name_rhythm' => $rhythm->name_rhythm,

    ])->assertSuccessful();

    assertDatabaseHas('rhythms', [
        'name_rhythm' => $rhythm->name_rhythm,
    ]);
});

test('when to create a new rhythm, the name_rhythm needed required', function () {

    $user   = User::factory()->create();
    $rhythm = rhythm::factory()->create();

    actingAs($user);

    postJson(route('rhythm.store'), [
        'name_rhythm' => $rhythm->name_rhythm,

    ])->assertSuccessful();

    postJson(route('rhythm.store'), [
        'name_rhythm' => null,
    ])->assertJsonValidationErrors(['name_rhythm']);
});
