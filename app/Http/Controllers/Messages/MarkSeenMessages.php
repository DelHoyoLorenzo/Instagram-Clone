<?php

namespace App\Http\Controllers\Messages;

use App\Events\MessageNotification;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarkSeenMessages extends Controller
{
    /* public function __construct()
    {
        $this->middleware('auth');
    } */

    public function update($chat_id, Request $request)
    {
        $chat_id = (int) $chat_id;

        $user_id = (int) $request->userId;

        //seach for the messages from that chat, and also those which have not been seen
        $messages = Message::where('chat_id', $chat_id)
        ->where('seen', false)
        ->where('sender_user_id', '!=', $user_id)
        ->update(['seen' => true, 'seen_at' => now()]);

        /* event(new MessageNotification($chat_id, $user_id)); */

        return response()->json(['message'=>'Messages successfully updated']);
    }
}
