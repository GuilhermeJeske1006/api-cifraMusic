<?php

use App\Models\{Music, Rhythm, Singer, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, put, putJson};

it('should be able to update a music', function () {
    // Arrange
    $user = User::factory()->create();
    Rhythm::factory(10)->create();
    Singer::factory(10)->create();
    $music = Music::factory()->create();

    actingAs($user);

    // Act
    putJson(route('music.update', ['music' => $music]), [
        'title'      => 'Updated Title',
        'singer_id'  => $music->singer_id,
        'note_id'    => $music->note_id,
        'bpm'        => $music->bpm,
        'rhythm_id'  => $music->rhythm_id,
        'lyrics'     => 'Updated Lyrics',
        'created_by' => $music->created_by,
    ])->assertSuccessful();

    $music->refresh();

    assertDatabaseHas('music', [
        'title'      => 'Updated Title',
        'singer_id'  => $music->singer_id,
        'note_id'    => $music->note_id,
        'bpm'        => $music->bpm,
        'rhythm_id'  => $music->rhythm_id,
        'lyrics'     => 'Updated Lyrics',
        'created_by' => $music->created_by,
    ]);
});

test('when updating the music, the title and lyrics are required', function () {
    // Arrange
    $user = User::factory()->create();
    \App\Models\Rhythm::factory(10)->create();
    \App\Models\Singer::factory(10)->create();
    $music = Music::factory()->create();

    actingAs($user);

    // Act - Valid update
    putJson(route('music.update', ['music' => $music]), [
        'title'      => 'Updated Title',
        'singer_id'  => $music->singer_id,
        'note_id'    => $music->note_id,
        'bpm'        => $music->bpm,
        'rhythm_id'  => $music->rhythm_id,
        'lyrics'     => 'Updated Lyrics',
        'created_by' => $music->created_by,
    ])->assertSuccessful();

    // Act - Invalid update
    putJson(route('music.update', ['music' => $music]), [
        'title'      => null,
        'singer_id'  => $music->singer_id,
        'note_id'    => $music->note_id,
        'bpm'        => $music->bpm,
        'rhythm_id'  => $music->rhythm_id,
        'lyrics'     => null,
        'created_by' => $music->created_by,
    ])->assertJsonValidationErrors(['title', 'lyrics']);
});
