<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageEventController extends Controller
{
    public function show($chat_id)
    {
        dd($chat_id);
    }

    public function create($chat_id, Request $request)
    {
        $chat_id = (int) $chat_id;

        $message = Message::create([
            'content' => $request->json('content'),
            'sender_user_id' => (int) $request->json('sender_user_id'), 
            'receiver_user_id' => (int) $request->json('receiver_user_id'), 
            'chat_id' => $chat_id,
        ]);

        /* dd($message); */
        
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

        /* return view('chats.index', ['messages'=>$messages, 'chat_id'=>$chat_id ,'chats'=>$chats, 'receiver_user_id'=>$receiver_id]); */
        return response()->json(['message'=> $message]);
    }
}
