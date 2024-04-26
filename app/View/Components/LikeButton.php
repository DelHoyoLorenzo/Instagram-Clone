<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LikeButton extends Component
{
    public $isLiked = false;
    /**
     * Create a new component instance.
     */
    public function __construct() 
    {
        
    }

    public function likePost(int|string $post_id)
    {
        $url = "http://127.0.0.1:8000/like/{$post_id}";

        // Data to be sent in the request body
        $data = [
            'like' => true,
            'post_id' => $post_id,
            // Add any other data you want to send
        ];

        // Options for the HTTP request
        $options = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/json',
                'content' => json_encode($data),
            ],
        ];

        // Create a stream context
        $context = stream_context_create($options);

        // Send the HTTP request
        $response = file_get_contents($url, false, $context);

        // Dump the response
        dd($response); 
    }

    public function render(): View|Closure|string
    {
        return view('components.like-button');
        /* return <<<'blade'
        <div class="alert alert-danger">
            {{ $post_id }}
        </div>
        blade; */
    }
}
