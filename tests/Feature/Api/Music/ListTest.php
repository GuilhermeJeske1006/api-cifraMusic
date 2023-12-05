<?php

use App\Models\Music;
use App\Models\Rhythm;
use App\Models\Singer;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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

it('should paginate the result', function () {

    // Arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);
    Rhythm::factory(10)->create();
    Singer::factory(10)->create();
    Music::factory()->count(20)->create();

    // Act
    $response = getJson(route('music.index'));

    // Assert
    $response->assertSuccessful()
             ->assertJsonStructure([
                 'data',
                 'links',
                 'meta',
             ])
             ->assertJsonCount(10, 'data'); // Adjust the count based on your pagination setup
});