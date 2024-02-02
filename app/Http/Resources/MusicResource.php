<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MusicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->resource->loadMissing('singer', 'note', 'rhythm', 'createdBy');

        return [
            'id'             => $this->resource->id,
            'title'          => $this->resource->title,
            'singer'         => SingerResource::make($this->whenLoaded('singer')),
            'note'           => NoteResource::make($this->whenLoaded('note')),
            'rhythm'         => RhythmResource::make($this->whenLoaded('rhythm')),
            'bpm'            => $this->resource->bpm,
            'lyrics'         => $this->resource->lyrics,
            'is_highlighted' => $this->resource->is_highlighted,
            'created_by'     => UserResource::make($this->whenLoaded('createdBy')),
            'created_at'     => $this->resource->created_at,
            'updated_at'     => $this->resource->updated_at,

        ];
    }
}
