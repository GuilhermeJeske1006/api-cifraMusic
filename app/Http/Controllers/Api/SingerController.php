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
        if(request()->has('search')) {
            $singers = (new Singer())->search(request()->search);
        } else {
            $singers = Singer::with('musics')->paginate(10);
        }

        return SingerResource::collection(
            $singers
        );
    }

    public function store(Singer $singer): JsonResponse
    {
        request()->validate([
            'name_singer' => 'required',
        ]);

        $singer->created([
            'name_singer' => request()->name_singer,
        ]);

        return response()->json([
            'message' => 'Artista criado com sucesso',
            'data'    => $singer,
        ], 201);
    }

    public function show(Singer $singer): JsonResource
    {
        return SingerResource::make(
            $singer->load('musics')
        );
    }

    public function update(Singer $singer): JsonResponse
    {
        $singer->updated([
            'name_singer' => request()->name_singer,
        ]);

        return response()->json([
            'message' => 'Artista atualizado com sucesso',
            'data'    => $singer,
        ], 200);
    }

    public function destroy(Singer $singer): JsonResponse
    {
        $singer->deleteOrFail();

        return response()->json(['Artista excluido com sucesso'], 200);
    }
}
