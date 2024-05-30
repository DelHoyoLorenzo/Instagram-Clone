<?php

namespace App\Http\Controllers\Messages;

use App\Events\MessageNotification;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageEventController extends Controller
{
    public function create($chat_id, Request $request)
    {
        $chat_id = (int) $chat_id;
        $receiver_user_id = (int) $request->json('receiver_user_id');
        
        $message = Message::create([
            'content' => $request->json('content'),
            'sender_user_id' => (int) $request->json('sender_user_id'), 
            'receiver_user_id' => (int) $request->json('receiver_user_id'), 
            'chat_id' => $chat_id,
        ]);

        /* MessageSent::dispatch($message); !this line does not work */
        event(new MessageSent($message));

        // I have to send a notification in any case, does not matter if the user is chatting or not
        
        broadcast(new MessageNotification($receiver_user_id))->toOthers();

        return response()->json(['message'=> $message]);
    }
}
