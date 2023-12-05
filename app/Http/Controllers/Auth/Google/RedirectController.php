<?php

namespace App\Http\Controllers\Auth\Google;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke() : RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }
}
