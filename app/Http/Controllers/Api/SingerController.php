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
    /**
     * Store a newly created resource in storage.
     */
    public function store(Singer $singer): JsonResource
    {
        $singer->created([
            'name_singer' => request()->name_singer,
        ]);

        return SingerResource::make($singer);
    }
}
