<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rhythm;
use Illuminate\Http\{JsonResponse, Request};

class RhythmController extends Controller
{
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

}
