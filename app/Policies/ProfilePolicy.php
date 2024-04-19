<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Profile;

class ProfilePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Profile $profile)
    {
        return $user->id == $profile->user_id;
    }
}
