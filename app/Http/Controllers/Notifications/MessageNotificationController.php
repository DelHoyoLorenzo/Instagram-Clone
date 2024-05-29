<?php

namespace App\Http\Controllers\Notifications;

use App\Events\MessageNotification as EventsMessageNotification;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageNotificationController extends Controller
{ 
    // this is for the user to check their notifications
    public function index()
    {
        $authUser = Auth::user();
        $unseenChats = [];

        $unreadMessages = Message::where('receiver_user_id', $authUser->id)
            ->where('seen', false)
            ->get();

        foreach ($unreadMessages as $message) {
            if (!in_array($message->chat_id, $unseenChats)) {
                $unseenChats[] = $message->chat_id;
            }
        }
        return response()->json($unseenChats);
        /* event(new EventsMessageNotification($user_id)); */
    }
}
