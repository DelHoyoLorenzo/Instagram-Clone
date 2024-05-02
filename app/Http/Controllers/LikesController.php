<?php

namespace App\Http\Controllers;

use App\Models\Like;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // we only are allowed to comment if we are logged in
    }

    public function store($query)
    {

        $post_id = (int) $query;
        $like = auth()->user()->likes()->where('post_id', $post_id)->firstOrNew();
        $user_id = auth()->user()->id;
        
        if($like->like !== null){
            $like->update(['like' => !$like->like]);
        }else{
            Like::create(
                ['user_id' => $user_id, 'post_id' => $post_id, 'like' => true],
            );
        } //updateOrCreate

        /*

        $like->date->now | liberia -> carbon
        $like ->save()
        FECHAS
        
        */


        return 'Liked or unliked succesfully'; //retornar cantidad de likes
    }
}











/* $liked = auth()->user()->likes()->where('post_id', $post_id)->first()?->like; */
/* $users = auth()->user()->following()->pluck('profiles.user_id');
    $profile = auth()->user()->profile;
    
    $posts = Post::whereIn('user_id', $users)->with('user')->latest()->get(); */