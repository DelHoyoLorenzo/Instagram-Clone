<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } //we dont have to see the view /p/create until we are logged in

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id'); //colection of users that we follow

        $posts = Post::whereIn('user_id', $users)->with('user')->orderBy('created_at','DESC')->paginate(5);
        //or use latest() to order like that
        //with('user') says to laravel just do one query instead of doing one query per iteration

        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            /* 'another'=>'', */ //pass a different file without validate it
            'caption'=>'required',
            'image'=> ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads','public');
        /* $image = Image::make(public_path("storage/{imagePath}"))->fit(1200, 1200);
        $image->save(); */

        //creating through a relationship
        //it will grab the authenticated user, it will go into their posts and create, laravel is gonna add the user id to it post, it is gonna make the relation with its user automatically
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);

        /* \App\Models\Post::create($data); the line above already does what this line wants to do*/

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}