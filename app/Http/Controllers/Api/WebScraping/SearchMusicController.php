<?php

namespace App\Http\Controllers\Api\WebScraping;

use App\Http\Controllers\Controller;
use Goutte\Client;
use Illuminate\Http\{JsonResponse, Request};

class SearchMusicController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Client $client): JsonResponse
    {
        $name_singer = str_replace(' ', '-', request()->name_singer);
        $name_music  = str_replace(' ', '-', request()->name_music);

        $crawler = $client
                ->request('GET', env('WEB_SCRIPING_URL') . '/' . $name_singer . '/' . $name_music);

        $song = $crawler->filter('.cifra-column--left')->html();

        return response()->json([
            'data' => $song,
        ], 200);
    }
}
