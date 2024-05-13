<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //we only are allowed to comment if we are logged in
    }

    public function show($chat_id)
    {
        $chat_id = (int) $chat_id;
        $messages = Message::where('chat_id', $chat_id)->get();
        $chats = auth()->user()->chats;

        $usersInvolved = Chat::find($chat_id)->users->toArray(); // which is the format after I called find method to a db table??
        
        $receivers = array_filter($usersInvolved, function ($user) {
            return $user['id'] !== auth()->user()->id;
        });

        $firstReceiver = reset($receivers);
        $receiver_id = $firstReceiver['id'];

        return view('chats.index', ['messages'=>$messages, 'chat_id'=>$chat_id ,'chats'=>$chats, 'receiver_user_id'=>$receiver_id]);
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

        $chats = auth()->user()->chats;
        $currentChat = $chats->firstWhere('id', $chat_id);

        $usersInvolved = $currentChat->users->toArray();
        
        $receivers = array_filter($usersInvolved, function ($user) {
            return $user['id'] !== auth()->user()->id;
        });

        $firstReceiver = reset($receivers);
        $receiver_id = $firstReceiver['id'];

        return view('chats.index', ['messages'=>$messages, 'chat_id'=>$chat_id ,'chats'=>$chats, 'receiver_user_id'=>$receiver_id]);
    }
}
