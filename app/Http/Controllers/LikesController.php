<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //we only are allowed to comment if we are logged in
    } 

    public function store($query)
    {
        $post_id = (int) $query;
        
        /* $data = request()->validate([
            '$query' => 'string',
        ]); */

        $existingLike = auth()->user()->likes()->where('post_id', $post_id)->first();

        if ($existingLike) { 
            $existingLike->update(['like' => !$existingLike->like]);
            return 'Unliked successfully';
        } else {
            auth()->user()->likes()->create([
                'like' => true,
                'user_id' => auth()->user()->id,
                'post_id' => $post_id,
            ]);
            return 'Liked successfully';
        }

    }
}
