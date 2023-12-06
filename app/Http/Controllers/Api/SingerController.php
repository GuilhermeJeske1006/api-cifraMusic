<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SingerResource;
use App\Models\Singer;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\{JsonResponse as HttpJsonResponse, Request};
use Symfony\Component\HttpFoundation\JsonResponse;

class SingerController extends Controller
{
    public function index(): JsonResource
    {
        return SingerResource::collection(
            Singer::with('musics')
                ->paginate(10)
        );
    }

    public function store(Singer $singer): JsonResource
    {
        request()->validate([
            'name_singer' => 'required',
        ]);

        $singer->created([
            'name_singer' => request()->name_singer,
        ]);

        return SingerResource::make($singer);
    }

    public function show(Singer $singer): JsonResource
    {
        return SingerResource::make(
            $singer->load('musics')
        );
    }

    public function update(Singer $singer): JsonResource
    {
        $singer->updated([
            'name_singer' => request()->name_singer,
        ]);

        return SingerResource::make($singer);
    }
}
