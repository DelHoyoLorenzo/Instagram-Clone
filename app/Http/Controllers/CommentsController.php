<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Hamcrest\Type\IsString;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //we only are allowed to comment if we are logged in
    } 

    public function create($query)
    {
        $post_id = (int) $query;
        $user_id = auth()->user()->id;

        /* dd(is_string($user_id)); */

        $data = request()->validate([
            'comment'=>['required', 'string'],
        ]);

        /* Comment::create(){} the code below does the same that using Comment::create*/

        auth()->user()->comments()->create([
            'comment' => $data['comment'],
            'post_id' => $post_id
        ]);

        $post = Post::findOrFail($post_id);

        /* dd($post); */

        // Create the comment with the provided data and associate it with the post
        /* $post->comments()->create([
            'comment' => $data['comment'],
            'user_id' => $user_id,
            'post_id' => $post -> id
        ]); */
    
        return redirect()->back()->with('success', 'Comment created successfully!');
    }
}
