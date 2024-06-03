<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User; // Import the User model with the correct namespace
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfilesController extends Controller
{
    public function index($request)
    {
        $user_id = (int) $request;
        $auth_user = auth()->user();
        /* $following = auth()->user()->following; // does not work with following()

        */
        
        $user_requested = User::where('id', $user_id)->with(['profile', 'posts', 'following'])->first();
        
        /* $follows = $user_requested->following->contains($auth_user->id); */

        $followers = Profile::where('user_id', $user_id)->with('followers')->get();

        return Inertia::render('Profile/Index', [
            'user' => $user_requested,
            'followers' => $followers,
            'profile' => $user_requested->profile,
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