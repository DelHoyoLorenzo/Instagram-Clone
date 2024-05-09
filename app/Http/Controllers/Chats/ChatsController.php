<?php

namespace App\Http\Controllers\Chats;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        /* $chats = Chat::where('sender_user_id', auth()->user()->id)->orWhere('recipient_user_id', auth()->user()->id)
        ->get(); */
        $chats = auth()->user()->chats;
        //return the conversations that the logged user have
        
        return view('chats.index', ['chats'=>$chats]);
    }

    public function create($receiver_user_id)
    {
        $receiver_user_id = (int) $receiver_user_id;
        
        $user = auth()->user();

        $existingChat = Chat::whereHas('users', function ($query) use ($receiver_user_id) {
            $query->where('user_id', $receiver_user_id);
        })
        ->whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->first();
        // case 2: already exists a chat with that person
        // first ask if the chats already exist
        // find a Chat that has an user_id that matches with the received_user_id 
        
        // TODO I should return the chats ordered by time, on a DESC way

        /* dd($existingChat); */

        if ($existingChat) {
            $chats = Chat::all();
            return view('chats.index', ['chats'=>$chats]);
        }

        // case 1: first time auth user talks to receiver user
        // create and return the chat with no messages in it, and also all the chats that the user has and also which ones that he received from others
        
        // Create a new chat
        $newChat = new Chat();
        $newChat->save();
        $chats = Chat::all();
        // Attach users to the new chat
        $newChat->users()->attach([$user->id, $receiver_user_id]);
        
        return view('chats.index', ['chat' => $chats]);
    }
}
