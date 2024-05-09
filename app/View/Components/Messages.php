<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Messages extends Component
{
    public $chat;

    public function __construct($chat)
    {
        $this->chat = $chat;
    }

    public function render(): View|Closure|string
    {
        return view('components.messages');
    }
}
