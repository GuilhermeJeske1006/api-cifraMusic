<?php

use App\Models\{Music, Rhythm, Singer, User};

use function Pest\Laravel\{actingAs, deleteJson};

it('should make delete a rhythm if exist in database', function () {

    $user = User::factory()->create();
    actingAs($user);
    $rhythm = rhythm::factory()->create();

    deleteJson(route('rhythm.destroy', ['rhythm' => $rhythm]))->assertSuccessful();

});
