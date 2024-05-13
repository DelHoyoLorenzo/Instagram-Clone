<div class="d-flex flex-column justify-content-between w-100" style="max-height: 100vh;">
    <div class="p-3 px-2" style="border-bottom: 0.5px solid gray">
        <a href="/messages/{{ $chatId }}" class="text-decoration-none" id="chatLink">
            <div class="d-flex gap-2 align-items-center ">
                <div style="width: 10%;">
                    <img class="w-100 rounded-circle" src="{{ $receiverUser->profile->profileImage() }}" alt="receiver-profile-picture">
                </div>
                <p class="m-0">{{ $receiverUser->username }}</p>
            </div>
        </a>
    </div>
    <div class="px-2" style="overflow-y: auto; overflow-x: hidden; max-height: 550px; margin-bottom:10px;">
        @foreach($messages as $message)
            <div class="row">
                <div class="col-md-6 py-1">
                    @if(auth()->user()->id == $message->sender_user_id)
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 15%">
                                <a href="/profile/{{$message->chat->users->firstWhere('id', $message->sender_user_id)->profile->id}}">
                                    <img class="rounded-circle w-100" src="{{ $message->chat->users->firstWhere('id', $message->sender_user_id)->profile->profileImage() }}" alt="logged-in-user-profile-picture">
                                </a>
                            </div>
                            <p class="m-0">{{ $message->content }}</p>
                        </div>
                    @endif
                </div>
                <div class="col-md-6 py-1">
                    @if(auth()->user()->id != $message->sender_user_id)
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 10%">
                                <a href="/profile/{{$message->chat->users->firstWhere('id', $message->receiver_user_id)->profile->id}}">
                                    <img class="w-100 rounded-circle" src="{{ $message->chat->users->firstWhere('id', $message->receiver_user_id)->profile->profileImage() }}" alt="receiver-profile-picture">
                                </a>
                            </div>
                            <p class="m-0">{{ $message->content }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="w-100 border-1 bg-body px-2">
        <form class="d-flex justify-content-between" action="/messages/{{ $chatId }}" enctype="multipart/form-data" method="post" style="border: 1px solid white; border-radius: 15px;">
            @csrf
            {{-- @foreach($chat->users as $user)
                @if($user->id == auth()->user()->id)
                    <input type="hidden" id="sender_user_id" name="sender_user_id" value="{{ auth()->user()->id }}"/>
                    @else
                    <input type="hidden" id="receiver_user_id" name="receiver_user_id" value="{{ $user->id }}">
                    @endif
                    @endforeach --}}
                    
            <input type="hidden" id="receiver_user_id" name="receiver_user_id" value="{{ $receiverUserId }}">
            <input type="hidden" id="sender_user_id" name="sender_user_id" value="{{ auth()->user()->id }}"/>
            <input type="hidden" id="chat_id" name="chat_id" value="{{ $chatId }}">
            <input class="m-1 bg-body text-primary border-0" id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" autocomplete="content" placeholder="Message..." required>
            
            @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <button type="submit" class="m-1 bg-body border-0 fw-bold" style="color:#0095f6">Send</button>
        </form>
    </div>
</div>

<!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->