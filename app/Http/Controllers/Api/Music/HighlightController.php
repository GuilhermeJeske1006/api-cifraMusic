<?php

namespace App\Http\Controllers\Api\Music;

use App\Http\Controllers\Controller;
use App\Http\Resources\MusicResource;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\{JsonResource, ResourceResponse};

class HighlightController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): JsonResource
    {
        return MusicResource::collection([
            Music::where('is_highlighted', true)->get(),
        ]);
    }
}
