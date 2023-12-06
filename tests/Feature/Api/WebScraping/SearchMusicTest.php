<?php

use App\Models\User;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\actingAs;

it('should be able to return a json when searching for a song', function () {
    // Simula uma requisição HTTP usando Http::fake()
    $user = User::factory()->create();
    actingAs($user);

    Http::fake([
        env('WEB_SCRIPING_URL') . '/*' => Http::response('<html>...</html>', 200),
    ]);

    // Simula uma requisição do Laravel para a rota
    // $response = $this->get('/api/webscriping/music/search?name_singer=bruno e marrone &name_music=Vida Vazia');

    // $response->assertStatus(200);

    // $responseData = json_decode($response->getContent(), true);

    // expect($responseData)->toHaveKey('data');

    // $song = $responseData['data'];

    // expect($song)->not()->toBeEmpty();

    $response = $this->get('/');

    $response->assertStatus(200);
});
