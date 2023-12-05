<?php

use App\Models\Music;
use App\Models\Rhythm;
use App\Models\Singer;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('should list all the music', function () {

    // Arrange :: preparar
    $user = User::factory()->create();
    Rhythm::factory(10)->create();
    Singer::factory(10)->create();
    $musics = Music::factory()->count(5)->create();
    actingAs($user);

    // Act :: agir
    $response = getJson(route('music.index'));

    // Assert :: verificar
    $response->assertStatus(200);

    /** @var Music $q */

    foreach ($musics as $q) {
        $response->assertSee($q->music);
    }
});