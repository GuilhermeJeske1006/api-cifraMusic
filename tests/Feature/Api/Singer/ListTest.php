<?php

use App\Models\{Music, Singer, User};

use function Pest\Laravel\{actingAs, getJson};

it('should list all the singer', function () {

    // Arrange :: preparar
    $user    = User::factory()->create();
    $singers = Singer::factory(10)->create();
    actingAs($user);

    // Act :: agir
    $response = getJson(route('singer.index'));

    // Assert :: verificar
    $response->assertStatus(200);

});

it('should paginate the result', function () {

    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);
    Singer::factory(50)->create();

    // Act
    $response = getJson(route('singer.index'));

    // Assert
    $response->assertSuccessful()
        ->assertJsonStructure([
            'data',
            'links',
            'meta',
        ])->assertJsonCount(10, 'data');
});
