<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MusicResource;
use App\Models\Music;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\{JsonResource, ResourceResponse};

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResource
    {
        return MusicResource::collection(Music::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(): JsonResponse
    {
        request()->validate([
            'title'  => 'required',
            'lyrics' => 'required',
        ]);

        $music = user()->musics()
            ->create([
                'title'      => request()->title,
                'singer_id'  => request()->singer_id,
                'note_id'    => request()->note_id,
                'bpm'        => request()->bpm,
                'rhythm_id'  => request()->rhythm_id,
                'lyrics'     => request()->lyrics,
                'created_by' => request()->created_by,
            ]);

        return response()->json([
            'message' => 'Musica criada com sucesso',
            'data'    => $music,
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(Music $music): JsonResource
    {
        return MusicResource::make($music);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Music $music): JsonResponse
    {
        request()->validate([
            'title'  => 'required',
            'lyrics' => 'required',
        ]);

        $music->updated(
            request()->all()
        );

        return response()->json([
            'message' => 'Musica atualizada com sucesso',
            'data'    => $music,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Music $music): JsonResponse
    {
        $music->deleteOrFail();

        return response()->json(['Musica excluida com sucesso'], 200);

    }
}
