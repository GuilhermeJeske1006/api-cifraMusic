<?php

use App\Models\{Music, Rhythm, Singer, User};

use function Pest\Laravel\{actingAs, deleteJson};

it('should make delete a singer if exist in database', function () {

    $user = User::factory()->create();
    actingAs($user);
    $singer = Singer::factory()->create();

    deleteJson(route('singer.destroy', ['singer' => $singer]))->assertSuccessful();

});
