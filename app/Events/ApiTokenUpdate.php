<?php

namespace App\Events;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Str;

class ApiTokenUpdate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->update([
            'api_token' => Str::random(60)
        ]);
    }
}
