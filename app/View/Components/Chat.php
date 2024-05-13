<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Chat extends Component
{
   /*  CHAT COMPONENT */
    public $messages;
    public $chatId;
    public $receiverUserId;
    public $receiverUser;

    public function __construct($messages, $receiverUserId, $chatId, $receiverUser)
    {
        $this->messages = $messages;
        $this->chatId = $chatId;
        $this->receiverUserId = $receiverUserId;
        $this->receiverUser = $receiverUser;
    }

    public function render(): View|Closure|string
    {
        return view('components.chat');
    }
}
