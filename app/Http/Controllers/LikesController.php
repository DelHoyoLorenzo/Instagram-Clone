<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // we only are allowed to comment if we are logged in
    }

    public function store($query)
    {

        $post_id = (int) $query;
        $like = auth()->user()->likes()->where('post_id', $post_id)->firstOrNew(); // have I liked this post?
        $user_id = auth()->user()->id;
        
        if($like->like !== null){
            $like->update(['like' => !$like->like]);
        }else{
            Like::create(
                ['user_id' => $user_id, 'post_id' => $post_id, 'like' => true],
            );
        } //updateOrCreate

        $current_post = Post::find($post_id);
        $true_post_likes = $current_post->likes()->where('like', 1)->count();
        /* $true_post_likes = $current_post->likes->filter(function ($like) {
            return $like->like;
        }); */
        /* dd($true_post_likes); */
        /*
        
        $like->date->now | liberia -> carbon
        $like ->save()
        FECHAS
        
        */

        return response()->json(['true_post_likes' => $true_post_likes]);
    }
}











/* $liked = auth()->user()->likes()->where('post_id', $post_id)->first()?->like; */
/* $users = auth()->user()->following()->pluck('profiles.user_id');
    $profile = auth()->user()->profile;
    
    $posts = Post::whereIn('user_id', $users)->with('user')->latest()->get(); */