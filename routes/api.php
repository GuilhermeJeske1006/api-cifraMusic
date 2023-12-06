<?php

use App\Http\Controllers\Api\Music\HighlightController;
use App\Http\Controllers\Api\WebScraping\{SearchMusicController, SearchSingerController};
use App\Http\Controllers\Api\{MusicController, SingerController};
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

Route::get('/music/highlight', HighlightController::class)->name('music.highlight');
Route::post('/music/store', [MusicController::class, 'store'])->name('music.store');
Route::get('/music', [MusicController::class, 'index'])->name('music.index');
Route::get('/music/{music}', [MusicController::class, 'show'])->name('music.show');
Route::put('/music/{music}/update', [MusicController::class, 'update'])->name('music.update');
Route::delete('/music/{music}/destroy', [MusicController::class, 'destroy'])->name('music.destroy');

Route::post('/singer/store', [SingerController::class, 'store'])->name('singer.store');
Route::get('/singer', [SingerController::class, 'index'])->name('singer.index');
Route::get('/singer/{singer}', [SingerController::class, 'show'])->name('singer.show');
Route::put('/singer/{singer}/update', [SingerController::class, 'update'])->name('singer.update');
Route::delete('/singer/{singer}/destroy', [SingerController::class, 'destroy'])->name('singer.destroy');

Route::get('/webscriping/singer/search', SearchSingerController::class)->name('webscriping.singer');
Route::get('/webscriping/music/search', SearchMusicController::class)->name('webscriping.music');
