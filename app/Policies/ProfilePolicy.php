<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Profile;

class ProfilePolicy
{
    protected $policies = [
        Profile::class => ProfilePolicy::class,
    ];

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Profile $profile)
    {
        return $user->id === $profile->user_id;
    }
}
