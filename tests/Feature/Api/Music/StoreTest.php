<?php

use App\Models\{Music, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, postJson};

it('should be able to store a new music', function () {
    $user = User::factory()->create();
    \App\Models\Rhythm::factory(10)->create();
    \App\Models\Singer::factory(10)->create();
    $musicData = Music::factory()->create();

    actingAs($user);

    postJson(route('music.store'), [
        'title'      => $musicData->title,
        'singer_id'  => $musicData->singer_id,
        'note_id'    => $musicData->note_id,
        'bpm'        => $musicData->bpm,
        'rhythm_id'  => $musicData->rhythm_id,
        'lyrics'     => $musicData->lyrics,
        'created_by' => $musicData->created_by,
    ])->assertSuccessful();

    assertDatabaseHas('music', [
        'title'      => $musicData->title,
        'singer_id'  => $musicData->singer_id,
        'note_id'    => $musicData->note_id,
        'bpm'        => $musicData->bpm,
        'rhythm_id'  => $musicData->rhythm_id,
        'lyrics'     => $musicData->lyrics,
        'created_by' => $musicData->created_by,
    ]);
});

test('when to create the song, the title and lyrics needed required', function () {

    $user = User::factory()->create();
    \App\Models\Rhythm::factory(10)->create();
    \App\Models\Singer::factory(10)->create();
    $musicData = Music::factory()->create();

    actingAs($user);

    postJson(route('music.store'), [
        'title'      => $musicData->title,
        'singer_id'  => $musicData->singer_id,
        'note_id'    => $musicData->note_id,
        'bpm'        => $musicData->bpm,
        'rhythm_id'  => $musicData->rhythm_id,
        'lyrics'     => $musicData->lyrics,
        'created_by' => $musicData->created_by,
    ])->assertSuccessful();

    postJson(route('music.store'), [
        'title'      => null,
        'singer_id'  => $musicData->singer_id,
        'note_id'    => $musicData->note_id,
        'bpm'        => $musicData->bpm,
        'rhythm_id'  => $musicData->rhythm_id,
        'lyrics'     => null,
        'created_by' => $musicData->created_by,
    ])->assertJsonValidationErrors(['title', 'lyrics']);
});
