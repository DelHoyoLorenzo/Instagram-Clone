<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Chat extends Component
{
   /*  CHAT COMPONENT */
   public $messages;

    public function __construct()
    {
        $this->messages;
    }
   
    public function render(): View|Closure|string
    {
        return view('components.chat');
    }
}
