<?php

use App\Models\{Music, Rhythm, Singer, User};

use function Pest\Laravel\{actingAs, getJson};

it('should be able to list songs by highlights', function () {

    // Arrange :: preparar
    $user = User::factory()->create();
    Rhythm::factory(10)->create();
    Singer::factory(10)->create();
    $RightMusics = Music::factory()->count(5)->create(['is_highlighted' => true]);
    $WrongMusics = Music::factory()->count(5)->create(['is_highlighted' => false]);

    actingAs($user);

    // Act :: agir
    $response = getJson(route('music.highlight'));

    // Assert :: verificar
    $response->assertStatus(200);

    // /** @var Music $q */
    // foreach ($RightMusics as $q) {
    //     $response->assertSee($q->music);
    // }

    // /** @var Music $q */
    // foreach ($WrongMusics as $q) {
    //     $response->assertDontSee($q->music);
    // }
});
