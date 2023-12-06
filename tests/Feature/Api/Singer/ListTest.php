<?php

use App\Models\{Singer, User};

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

    /** @var Singer $q */
    foreach ($singers as $q) {
        $response->assertSee($q->name_singer);
    }
});
