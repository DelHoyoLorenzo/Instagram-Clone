<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User; // Import the User model with the correct namespace
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        $user_id = $user->id;
        $auth_profile = auth()->user()->profile;
        /* $following = auth()->user()->following; // does not work with following()*/
        
        $user_requested = User::where('id', $user_id)->with(['profile', 'posts', 'following'])->first();
        
        /* $follows = $user_requested->following->contains($auth_user->id); */

        $isFollowed = auth()->user()->following->contains('user_id', $user_id);

        $followers = Profile::where('user_id', $user_id)->with('followers')->get();

        return Inertia::render('Profile/Index', [
            'user' => $user_requested,
            'profile' => $user_requested->profile,
            'authProfile'=> $auth_profile,
            'followers' => $followers,
            'isFollowed' => $isFollowed,
            'following' =>$user_requested->following,
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
        $this->authorize('update', $user->profile); //protect this route, for logged users and also just for the current users's profile

        return Inertia::render('Profile/EditProfile', ['user' => $user, 'profile'=> $user->profile]);
    }

    public function update(User $user) // MODEL BINDING!!!!!!!!!!! LARAVEL RESOLVES IT AUTOMATICALLY BY TAKING DE ID FROM THE URL, it gives a model instance just by resolving the url
    {
        $this->authorize('update', $user->profile);

        if (request('image')) { //if the request has an image
            $imagePath = request('image')->store('profile','public');

            $imageArray = ['image'=> $imagePath];
            // I put the image into an array because then I merge the $data array and the image array so the whole array has 'image' => '/path'
        }

        $data = request()->validate([
            'title'=>'string',
            'description'=>'string',
            'url'=>'url',
            'image'=>'',
        ]);

        auth()->user()->profile->update(array_merge($data, $imageArray ?? [ 'image' => auth()->user()->profile->image ]));
        //we just grab the authenticated user, so I can only edit it if I am the user that is logged

        return redirect('/profile/'.$user->id);
    }
}