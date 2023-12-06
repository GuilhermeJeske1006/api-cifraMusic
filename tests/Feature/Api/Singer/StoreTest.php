<?php

use App\Models\{Singer, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, postJson};

it('should be able to store a new singer', function () {
    $user   = User::factory()->create();
    $singer = Singer::factory()->create();

    actingAs($user);

    postJson(route('singer.store'), [
        'name_singer' => $singer->name_singer,

    ])->assertSuccessful();

    assertDatabaseHas('singers', [
        'name_singer' => $singer->name_singer,

    ]);
});
