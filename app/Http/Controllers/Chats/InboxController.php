<?php

namespace App\Http\Controllers\Chats;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Messages\MessagesController;
use App\Models\Chat;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InboxController extends Controller
{
    public function show()
    {
        $chats = auth()->user()->chats()->with(['users.profile'])->get(); // only works with the relation chats() with the parentesis dnw
        
        //return the conversations that the logged user have
        
        return Inertia::render('Chats/Index', ['chats'=>$chats]);
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
        })->first(); // here I search for a chat where involves the user we are trying to reach and the auth user
        
        // case 2: already exists a chat with that person
        // first ask if the chats already exist
        // find a Chat that has an user_id that matches with the received_user_id 
        
        // TODO I should return the chats ordered by time, on a DESC way

        /* dd($existingChat); */

        if ($existingChat) {
            dd('entre');
            return redirect()->action([InboxController::class, 'show']);
        }

        // case 1: first time auth user talks to receiver user
        // create and return the chat with no messages in it, and also all the chats that the user has and also which ones that he received from others
        
        // Create a new chat
        $newChat = new Chat();
        $newChat->save();
        $chats = Chat::whereHas('users', function ($query) use ($receiver_user_id) {
                $query->where('user_id', $receiver_user_id);
        })->get();

        // Attach users to the new chat
        $newChat->users()->attach([$user->id, $receiver_user_id]);

        return redirect()->action([InboxController::class, 'show']);
    }
}
