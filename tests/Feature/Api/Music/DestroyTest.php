<?php

use App\Models\{Music, Rhythm, Singer, User};

use function Pest\Laravel\{actingAs, deleteJson};

it('should make delete a music if exist in database', function () {

    $user = User::factory()->create();
    actingAs($user);
    Rhythm::factory(10)->create();
    Singer::factory(10)->create();
    $music = Music::factory()->create();

    deleteJson(route('music.destroy', ['music' => $music]))->assertSuccessful();

});
