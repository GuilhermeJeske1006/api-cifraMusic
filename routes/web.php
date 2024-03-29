<?php

use App\Http\Controllers\Auth\Facebook\{CallbackController, RedirectController};
use App\Http\Controllers\Auth\Google\{CallbackController as GoogleCallbackController, RedirectController as GoogleRedirectController};
use App\Http\Controllers\Pdf\MusicPdfController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect(env('FRONT_URL'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/facebook/login', RedirectController::class)->name('facebook.login');
Route::get('/facebook/callback', CallbackController::class)->name('facebook.callback');

Route::get('/google/login', GoogleRedirectController::class)->name('google.login');
Route::get('/google/callback', GoogleCallbackController::class)->name('google.callback');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/pdf/music/{music}', MusicPdfController::class)->name('pdf.music');

require __DIR__ . '/auth.php';
