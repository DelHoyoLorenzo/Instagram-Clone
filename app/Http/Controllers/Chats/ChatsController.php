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
        $chats = Chat::where('sender_user_id', auth()->user()->id)->orWhere('recipient_user_id', auth()->user()->id)
        ->get();
        //return the conversations that the logged user have
        
        return view('chats.index', ['chats'=>$chats]);
    }

    public function create($receiver_user_id)
    {
        $receiver_user_id = (int) $receiver_user_id;
        

    // case 2: already has a chat with the receiver
        //first ask if the chats already exist
        $chats = Chat::where('sender_user_id', auth()->user()->id)->orWhere('recipient_user_id', auth()->user()->id)
        ->get();// I should return the chats ordered by time, on a DESC way

        if($chats){
            // just return all the chats of the auth user, each with their messages
            /* $chats */
            return view('chats.index', ['chats'=>$chats]);
        }

    // case 1: first time auth user talks to receiver user
        // create and return the chat with no messages in it, and also all the chats that the user has and also which ones that he received from others
        
        Chat::create(['sender_user_id'=>auth()->user()->id, 'receiver_user_id'=>$receiver_user_id]);
        return view('chats.index', ['chats'=>$chats]);
    }
}
