<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RhythmResource;
use App\Models\Rhythm;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\{JsonResponse, Request};

class RhythmController extends Controller
{
    public function index(): JsonResource
    {
        return RhythmResource::collection(Rhythm::with('musics')->paginate(20));
    }

    public function store(Rhythm $rhythm): JsonResponse
    {
        request()->validate([
            'name_rhythm' => 'required',
        ]);

        $rhythm->created([
            'name_rhythm' => request()->name_rhythm,
        ]);

        return response()->json([
            'message' => 'Ritmo criado com sucesso',
            'data'    => $rhythm,
        ], 201);
    }

    public function update(Rhythm $rhythm): JsonResponse
    {
        request()->validate([
            'name_rhythm' => 'required',
        ]);

        $rhythm->updateOrFail([
            'name_rhythm' => request()->name_rhythm,
        ]);

        return response()->json([
            'message' => 'Ritmo atualizado com sucesso',
            'data'    => $rhythm,
        ], 200);
    }

    public function destroy(Rhythm $rhythm): JsonResponse
    {
        $rhythm->deleteOrFail();

        return response()->json(['Ritmo excluido com sucesso'], 200);
    }

}
