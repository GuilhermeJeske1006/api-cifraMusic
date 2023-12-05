<?php

use App\Models\Music;
use App\Models\Rhythm;
use App\Models\Singer;
use App\Models\User;
use GuzzleHttp\Promise\Create;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\deleteJson;

it('should make delete a music if exist in database', function () {

    $user = User::factory()->create();
    actingAs($user);
    Rhythm::factory(10)->create();
    Singer::factory(10)->create();
    $music = Music::factory()->create(); 

    deleteJson(route('music.destroy', ['music' => $music]))->assertSuccessful();

});