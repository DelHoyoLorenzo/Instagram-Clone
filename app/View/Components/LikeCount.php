<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LikeCount extends Component
{
    /**
     * Create a new component instance.
     */
    /* public $likesCount; */
    public $postId;
    public $id;

    public function __construct(/* $likesCount ,*/ $postId)
    {
        /* $this->likesCount = $likesCount; */
        $this->postId = $postId;
        $this->id;
    }

    public function fetchLikeData($postId){
        dd($postId);
        $current_post = Post::find($postId);
        $true_post_likes = $current_post->likes()->where('like', 1)->count();

        $this->id = $true_post_likes;

    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.like-count');
    }
}
