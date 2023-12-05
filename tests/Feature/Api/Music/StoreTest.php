<?php

use App\Models\Music;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;

it('should be able to store a new music', function () {
    $user = User::factory()->create();
    \App\Models\Rhythm::factory(10)->create();
    \App\Models\Singer::factory(10)->create();
    $musicData = Music::factory()->create(); 

    actingAs($user);


    postJson(route('music.store'), [
        'title' => $musicData->title,
        'singer_id' => $musicData->singer_id,
        'note_id' => $musicData->note_id,
        'bpm' => $musicData->bpm,
        'rhythm_id' => $musicData->rhythm_id,
        'lyrics' => $musicData->lyrics,
        'created_by' => $musicData->created_by,
    ])->assertSuccessful();

    assertDatabaseHas('music', [
        'title' => $musicData->title,
        'singer_id' => $musicData->singer_id,
        'note_id' => $musicData->note_id,
        'bpm' => $musicData->bpm,
        'rhythm_id' => $musicData->rhythm_id,
        'lyrics' => $musicData->lyrics,
        'created_by' => $musicData->created_by,
    ]);
});

