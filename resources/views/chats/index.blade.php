@extends('layouts.app')


@section('content')
<div class="d-flex">
    <div id="inbox-chats" class="col-4 d-flex flex-column" style="height: 100vh; border-right: 1px solid gray;">
        <div class="py-4 px-4">
            <h2>{{ auth()->user()->username }}</h2>
            <h5 class="py-2">Messages</h5>
            @foreach($chats as $chat)
            @php
                $userAuth = auth()->user();
                $receiverUser = $chat->users->first(function ($user) use ($userAuth) {
                return $user->id !== $userAuth->id;})
            @endphp

            {{-- TODO check if the chat is filled --}}
            <div id="chats" class="d-flex flex-column">
                <a href="/messages/{{ $chat->id }}" class="text-decoration-none" id="chatLink">
                    <div class="d-flex gap-2 align-items-center ">
                        <div class="w-25">
                            <img class="w-100 rounded-circle" src="{{ $receiverUser->profile->profileImage() }}" alt="receiver-profile-picture">
                        </div>
                        <p class="m-0">{{ $receiverUser->username }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
        
    {{-- if I click a chat I have to render a component next to the chats where I can chat to the receiver user --}}
    {{-- Load a component, by clicking a chat --}}
    @if(isset($messages) && isset($receiver_user_id) && isset($chat_id))
        <x-chat :chatId='$chat_id' :messages='$messages' :receiverUserId='$receiver_user_id' :receiverUser='$receiverUser' />

    @else
        <div class="col-8 d-flex flex-column align-items-center ">
            <div class="d-flex flex-column align-items-center py-4">
                <h4>Your messages</h4>
                <p>Send a message to start a chat.</p>
                <button class="btn btn-primary ">Send message</button>
            </div>
        </div>
    @endif

</div>
<script type="module">
    window.Echo.channel('notification')
    .listen('MessageNotification', (e)=>{
        console.log('sidebar',e) //it comes the right data, when im in /inbox not working on /messages/1
        /* let unseenChats = [];

        let currentChatId = e.notificationMessage.chat_id;
        unseenChats.push(currentChatId)
        console.log(unseenChats) */
        //check if the message was sent NOT by the auth user
        // check if the message has been seen?
        // store the chat ids so you count if the chat_id is not in an array of unseen chats

        /* $(#'notification').appendChild(1) */
        /* if(unseenChats.find( id => id===currentChatId )){
            let e.notificationMessage.content
        } */
        
        //when the message is seen by the auth user remove the notification o decrease the number of unseen chats
    })
</script>
@endsection
