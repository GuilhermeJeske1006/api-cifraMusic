<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SingerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $request->id,
            'name_singer' => $request->name_singer,
            'musics'      => MusicResource::collection($this->whenLoaded('musics')),
        ];
    }
}
