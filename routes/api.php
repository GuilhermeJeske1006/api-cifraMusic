<?php

use App\Http\Controllers\Api\MusicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/music/store', [MusicController::class, 'store'])->name('music.store');
Route::get('/music', [MusicController::class, 'index'])->name('music.index');
Route::get('/music/{music}', [MusicController::class, 'show'])->name('music.show');
Route::put('/music/{music}/update', [MusicController::class, 'update'])->name('music.update');
Route::delete('/music/{music}/destroy', [MusicController::class, 'destroy'])->name('music.destroy');
