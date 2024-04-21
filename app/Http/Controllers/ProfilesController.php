<?php

namespace App\Http\Controllers;

use App\Models\User; // Import the User model with the correct namespace
use Illuminate\Http\Request;


class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        
            return view('profiles.index', [ //data we send to the front, we render what is within this directory route in our project
                'user' => $user,
                'follows' => $follows
            ]);
        
        //we can save the counters in cache for 30 seconds and avoid reaching the database constantly
        //
        /* $postCount = Cache::remember {
            'count.following.' $user->id,

        } */

        /* $postCount = $user->posts->count();
        $followersCount = $user->profile->followers->count();
        $followingCount = $user->following->count(); */
    }

    public function edit(User $user){
        $this->authorize('update', $user->profile); //protect this route
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        if (request('image')) { //if the request has an image
            $imagePath = request('image')->store('profile','public');

            $imageArray = ['image'=> $imagePath];
        }

        $data = request()->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>'url',
            'image'=>'',
        ]);

        auth()->user()->profile->update(array_merge($data, $imageArray ?? []));
        //we just grab the authenticated user, so I can only edit it if I am the user that is logged

        return redirect('/profile/'.$user->id);
    }
}