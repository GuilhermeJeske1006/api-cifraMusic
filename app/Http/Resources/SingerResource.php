<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id'          => $this->resource->id,
            'name_singer' => $this->resource->name_singer,
            'musics'      => MusicResource::collection($this->whenLoaded('musics')),
        ];
    }
}
