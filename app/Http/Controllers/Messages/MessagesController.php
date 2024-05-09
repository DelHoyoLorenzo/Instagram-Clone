<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //we only are allowed to comment if we are logged in
    }

    public function show()
    {
        
    }

    public function create($chat_id)
    {
        $chat_id = (int) $chat_id;

        Message::create([
            'content'=>request('content'), 
            'sender_user_id'=>request('sender_user_id'), 
            'receiver_user_id'=>request('receiver_user_id'), 
            'chat_id'=>request('chat_id')
        ]);
        
        $messages = Message::where('chat_id', $chat_id)->get();

        return view('components.chat', ['messages'=> $messages]);
    }
}
