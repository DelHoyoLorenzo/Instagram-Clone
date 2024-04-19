<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowsController extends Controller
{
    public function __construct()
    { //what happende if we hit follow while being unlogged
        //we have to be logged for following
        $this->middleware('auth');
    }
    
    public function store(User $user)
    {
        //toggle -> attach and detach followers

        return auth()->user()->following()->toggle($user->profile);
    }
}
