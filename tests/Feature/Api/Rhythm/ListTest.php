<?php

use App\Models\{Rhythm, User};

use function Pest\Laravel\{actingAs, getJson};

it('should list all the rhythm', function () {

    // Arrange :: preparar
    $user    = User::factory()->create();
    $rhythms = Rhythm::factory(10)->create();
    actingAs($user);

    // Act :: agir
    $response = getJson(route('rhythm.index'));

    // Assert :: verificar
    $response->assertStatus(200);

    /** @var Rhythm $q */
    foreach ($rhythms as $q) {
        $response->assertSee($q->rhythm);
    }

});

it('should paginate the result', function () {

    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);
    Rhythm::factory(50)->create();

    // Act
    $response = getJson(route('rhythm.index'));

    // Assert
    $response->assertSuccessful()
        ->assertJsonStructure([
            'data',
            'links',
            'meta',
        ])->assertJsonCount(10, 'data');
});
