<?php

namespace App\Http\Controllers\Api\WebScraping;

use App\Http\Controllers\Controller;
use Goutte\Client;
use Illuminate\Http\{JsonResponse, Request};

class SearchSingerController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Client $client): JsonResponse
    {
        $name_singer = str_replace(' ', '-', request()->name_singer);

        $crawler = $client
                ->request('GET', env('WEB_SCRIPING_URL') . '/' . $name_singer);

        $listSongs = $crawler->filter('.song-verified--inline')
                ->each(function ($node) {
                    return $node->text();
                });

        $prefixedlistSongs = array_map(function ($item, $index) {
            return [
                'id'   => $index + 1,
                'name' => $item,
            ];
        }, $listSongs, array_keys($listSongs));

        return response()->json([
            'data' => $prefixedlistSongs,
        ], 200);
    }
}
