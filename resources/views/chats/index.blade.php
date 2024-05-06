@extends('layouts.app')

@section('content')
    <div class="d-flex">
        <div id="inbox-chats" class="d-flex flex-column">
            @foreach($chats as $chat)
                {{-- check if the chat is filled --}}
                <div class="m-5">
                   <div class="w-100">
                       <img class="w-25 rounded-circle" src="{{ $chat->receiver->profile->profileImage() }}" alt="receiver-profile-picture">
                   </div>
                </div>
            @endforeach
        </div>
        <div id="conversation-and-message-sending">
            <div>
                MESSAGES
                Load a component, by clicking a chat
            </div>
            <form action="">
                <input type="text" />
            </form>
        </div>
    </div>
@endsection