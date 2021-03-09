<?php

namespace App\Broadcasting;

use App\Models\Messages;
use App\Models\User;

class messaging
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User  $user
     * @return array|bool
     */
    public function join(User $user, Messages $message)
    {
        return $message;
    }
}
