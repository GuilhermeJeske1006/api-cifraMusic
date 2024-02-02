<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RhythmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id'          => $this->resource->id,
            'name_rhythm' => $this->resource->name_rhythm,
            'created_at'  => $this->resource->created_at->format('d/m/y'),
            'updated_at'  => $this->resource->updated_at->format('d-m-y'),
            'musics'      => MusicResource::collection($this->whenLoaded('musics')),
        ];
    }
}
