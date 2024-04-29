<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class LikeButton extends Component
{
    public $post_id;
    public $like;
    public $message = 'hola';

    public function mount($post_id)
    {
        $this->post_id = $post_id;
    }

    public function likePost()
    {  
        /* dd($this->message); */
        /* $data = [
            'like' => true,
            'post_id' => $this->post_id,
        ]; */

        $response = Http::post("http://127.0.0.1:8000/like/{$this->post_id}");
        dd($response);
        if ($response->successful()) {
            // Do something if the request was successful
            $responseData = $response->json();
            /* dd($responseData); */
        } else {
            // Do something if the request failed
        }
    }

    public $count = 1;
 
    public function increment()
    {
        dd($this->count);
        $this->count++;
    }
 
    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        return view('livewire.like-button')/* ->with([
            'liked' => $liked,
        ]) */;
    }
}
