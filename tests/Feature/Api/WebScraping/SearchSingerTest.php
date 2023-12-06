<?php

use App\Models\User;
use Illuminate\Support\Facades\Http;

use function Pest\Laravel\actingAs;

it('should be able to return a json when searching for a singer', function () {
    $user = User::factory()->create();

    actingAs($user);

    Http::fake([
        env('WEB_SCRIPING_URL') . '/' => Http::response('<html>...</html>', 200),
    ]);

    $response = $this->get('/api/webscriping/singer/search?name_singer=baitaca')->assertStatus(200);

    $responseData = json_decode($response->getContent(), true);

    expect($responseData)->toHaveKey('data');

    $list = $responseData['data'];

    expect($list)->toBeArray();
    expect(count($list))->toBeGreaterThan(0);

    foreach ($list as $item) {
        expect($item)->toHaveKeys(['id', 'name']);
        expect($item['name'])->toBeString();
    }
});
