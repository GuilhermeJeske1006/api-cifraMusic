<?php

use App\Models\{Music, Rhythm, Singer, User};

use function Pest\Laravel\{actingAs, be, getJson};

it('should be able to check if the user is logged in through the session table', function () {

    $user = User::factory()->create(['id' => 1]);

    actingAs($user);

    $response = getJson(route('session.user'), ['user_id' => 1]);

    $response->assertStatus(200);

});
