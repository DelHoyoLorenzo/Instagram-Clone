@extends('layouts.app')


@section('content')
<div class="d-flex py-5">
        <div id="inbox-chats" class="d-flex flex-column w-25">
            @foreach($chats as $chat)
            @php
                $userAuth = auth()->user();
                $receiverUser = $chat->users->first(function ($user) use ($userAuth) {
                return $user->id !== $userAuth->id;})
            @endphp
                {{-- TODO check if the chat is filled --}}
                <a href="" class="text-decoration-none">
                    <div class="d-flex gap-2 align-items-center ">
                       <div class="w-25">
                           <img class="w-100 rounded-circle" src="{{ $receiverUser->profile->profileImage() }}" alt="receiver-profile-picture">
                       </div>
                       <h4 class="">{{ $receiverUser->username }}</h4>
                    </div>
                </a>
                {{-- if I click a chat I have to render a component next to the chats where I can chat to the receiver user --}}
                {{-- this div has to have an <a> that will hit and endpoint that returns a blade component into this view, if no chat was clicked, component will be just a start a chat and a send message button --}}
                <div id="conversation-and-message-sending" class="py-2">
        
                    <div>
                        MESSAGES
                        {{-- Load a component, by clicking a chat --}}
                        <x-messages :chat='$chat' />
                    </div>
        
                </div>
            @endforeach
        </div>
    </div>
@endsection