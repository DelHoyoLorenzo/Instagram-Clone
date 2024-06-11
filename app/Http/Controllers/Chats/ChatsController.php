<?php

namespace App\Http\Controllers\Chats;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatsController extends Controller
{
    public function show($chat_id)
    {
        $chat_id = (int) $chat_id;
        $messages = Message::where('chat_id', $chat_id)->get();
        
        $user = auth()->user();
        
        $users_involved = Chat::find($chat_id)->users->toArray(); // which is the data format received after I called find method to a db table??
        
        $receivers = array_filter($users_involved, function ($user) {
            return $user['id'] !== auth()->user()->id;
        });
        
        $first_receiver = reset($receivers);
        $receiver_id = $first_receiver['id'];
        $receiver_user = User::find($receiver_id)->load('profile');
        
        /* return response()->json(['messages'=>$messages, 'chatId'=>$chat_id , 'user'=>$user,'receiverUser'=>$receiver_user, 'receiverUserId'=>$receiver_id]); */

        $chats = $user->chats;
        $chats->load('users.profile');

        return Inertia::render('Chats/Chat', ['chats' => $chats, 'messages'=>$messages, 'chatId'=>$chat_id , 'user'=>$user,'receiverUser'=>$receiver_user, 'receiverUserId'=>$receiver_id]);
    }

    // public function create($chat_id)
    // {
    //     $chat_id = (int) $chat_id;

    //     $message = Message::create([
    //         'content'=>request('content'), 
    //         'sender_user_id'=>request('sender_user_id'), 
    //         'receiver_user_id'=>request('receiver_user_id'), 
    //         'chat_id'=>request('chat_id')
    //     ]);
        
    //     /* $messages = Message::where('chat_id', $chat_id)->get(); */

    //     $chats = auth()->user()->chats;
    //     $currentChat = $chats->firstWhere('id', $chat_id);

    //     $usersInvolved = $currentChat->users->toArray();
        
    //     $receivers = array_filter($usersInvolved, function ($user) {
    //         return $user['id'] !== auth()->user()->id;
    //     });

    //     $firstReceiver = reset($receivers);
    //     $receiver_id = $firstReceiver['id'];

    //     event(new MessageSent($message));

    //     /* return view('chats.index', ['messages'=>$messages, 'chat_id'=>$chat_id ,'chats'=>$chats, 'receiver_user_id'=>$receiver_id]); */
    //     /* return response()->json(['message' => $message]); */
    //     /* return redirect('messages/'.$chat_id); */
    // }
}
