<?php

namespace App\Observers;

use App\Jobs\SendEmailCreation;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        SendEmailCreation::dispatch($user);
    }

}
