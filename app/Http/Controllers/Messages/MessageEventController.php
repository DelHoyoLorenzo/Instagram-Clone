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

        $message = Message::create([
            'content' => $request->json('content'),
            'sender_user_id' => (int) $request->json('sender_user_id'), 
            'receiver_user_id' => (int) $request->json('receiver_user_id'), 
            'chat_id' => $chat_id,
        ]);
        
        /* $messages = Message::where('chat_id', $chat_id)->get(); */

        /* $chats = auth()->user()->chats;
        $currentChat = $chats->firstWhere('id', $chat_id);

        $usersInvolved = $currentChat->users->toArray();
        
        $receivers = array_filter($usersInvolved, function ($user) {
            return $user['id'] !== auth()->user()->id;
        });

        $firstReceiver = reset($receivers);
        $receiver_id = $firstReceiver['id']; */

        event(new MessageSent($message));
        /* MessageSent::dispatch($message); !this line does not work */

        // I have to send a notification in any case, does not matter if the user is chatting
        event(new MessageNotification($message));

        return response()->json(['message'=> $message]);
    }
}
