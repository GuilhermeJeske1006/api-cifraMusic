<?php

use App\Models\{Music, Note, Rhythm, Singer, User};

use function Pest\Laravel\{actingAs, getJson};

it('should list all the music', function () {

    // Arrange :: preparar
    $user  = User::factory()->create();
    $notes = Note::factory(10)->create();

    actingAs($user);

    // Act :: agir
    $response = getJson(route('note.index'));

    // Assert :: verificar
    $response->assertStatus(200);

    /** @var Music $q */
    foreach ($notes as $q) {
        $response->assertSee($q->note);
    }
});
