<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): \Illuminate\Http\JsonResponse
    {
        $userId = request()->user_id;

        $sessaoAtiva = DB::table('sessions')
            ->where('user_id', $userId)
            ->exists();

        if ($sessaoAtiva) {
            return response()->json([
                'message' => 'Usuário já está logado',
                'status'  => 200,
            ]);
        } else {
            return response()->json([
                'message' => 'Usuário não está logado',
                'status'  => 401,
            ]);
        }
    }

}
