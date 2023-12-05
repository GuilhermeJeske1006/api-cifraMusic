<?php

namespace App\Http\Controllers\Auth\Google;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\{RedirectResponse, Request};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class CallbackController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::query()
            ->updateOrCreate(
                ['nickname' => $googleUser->getNickname(), 'email' => $googleUser->getEmail()],
                ['name' => $googleUser->getName(), 'password' => Str::random(40), 'email_verified_at' => now()]
            );

        Auth::login($user);

        return to_route('dashboard');
    }
}
