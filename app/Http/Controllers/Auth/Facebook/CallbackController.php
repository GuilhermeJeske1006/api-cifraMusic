<?php

namespace App\Http\Controllers\Auth\Facebook;

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
    public function __invoke() : RedirectResponse
    {
        $facebookUser = Socialite::driver('facebook')->user();

        $user = User::query()
            ->updateOrCreate(
                ['nickname' => $facebookUser->getNickname(), 'email' => $facebookUser->getEmail()],
                ['name' => $facebookUser->getName(), 'password' => Str::random(40), 'email_verified_at' => now()]
            );

        Auth::login($user);

        return to_route('dashboard');
    }
}
