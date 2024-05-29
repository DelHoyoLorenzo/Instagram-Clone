<?php

namespace App\Listeners;

use App\Events\MessageNotification;
use App\Models\Chat;
use App\Models\Message;
use App\View\Components\Messages;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleMessageNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageNotification $event):void
    {
        $chat_id = $event->chatId;
        $user_id = $event->userId;
        $chats_unseen = [];

        //I have to check the receivers messages on that $chat_id
            // so thinking deeply, I have to get the chats with $chat_id and also check the messages within that chat that also has the receiver_user_id == $user_id
        /*
        $chats = Chat::where('id', $chat_id)->get(); 
        $receiver_messages = Message::where('chat_id', $chat_id)
                                 ->where('receiver_user_id', $user_id)
                                 ->get(); */
        
        /* $receiver_messages = Message::where('chat_id', $chat_id)
            ->where('receiver_user_id', $user_id)
            ->get(); */

        // it costs  too much to bring up an array full of messages, it is better to take the last one
        $last_receiver_message = Message::where('chat_id', $chat_id)
            ->where('receiver_user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->first();
            
        //check if the chat is already in chats_unseen
            // the other user sends a second message in a row
        
        array_push($chats_unseen, $chat_id);
        /* if ($last_receiver_message && !$last_receiver_message->seen) {
        }

        if(!in_array($chat_id, $chats_unseen)){ 
        } */
        $event->unseenChats = $chats_unseen;
    }
}
