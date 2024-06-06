<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Hamcrest\Type\IsString;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //we only are allowed to comment if we are logged in
    } 

    public function create()
    {
        $data = request()->validate([
            'comment'=>['required', 'string'],
            'userId'=>['required', 'integer'],
            'postId'=>['required', 'integer'],
        ]);

        $comment_created = Comment::create([
            'comment' => $data['comment'],
            'user_id' => $data['userId'],
            'post_id' => $data['postId'],
        ]);
        
        // the code below does the same that using Comment::create
        /* $comment = auth()->user()->comments->create([
            'comment' => $data['comment'],
            'post_id' => $post_id
        ]);*/

        $comment_created->load('user.profile');

        return response()->json(['comment' => $comment_created]);
    }
}
