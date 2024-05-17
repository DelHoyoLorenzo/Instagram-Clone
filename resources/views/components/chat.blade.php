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
    <div class="px-2" style="overflow-y: auto; overflow-x: hidden; margin-bottom:10px;">
        @foreach($messages as $message)
            <div class="row">
                <div class="col-md-6 py-1">
                    @if(auth()->user()->id != $message->sender_user_id)
                        <div class="d-flex align-items-center gap-2">
                            <div id="receiver-profile-picture" style="width: 15%">
                                <a href="/profile/{{$message->chat->users->firstWhere('id', $message->sender_user_id)->profile->id}}">
                                    <img class="rounded-circle w-100" src="{{ $message->chat->users->firstWhere('id', $message->receiver_user_id)->profile->profileImage() }}" alt="logged-in-user-profile-picture">
                                </a>
                            </div>
                            <p class="m-0" style='padding: 7px 12px; background-color: rgb(41, 41, 41); border-radius: 20px;'>{{ $message->content }}</p>
                        </div>
                    @endif
                </div>
                <div class="col-md-6 py-1">
                    @if(auth()->user()->id == $message->sender_user_id)
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <p class="m-0" style='padding: 7px 12px; background-color: rgb(55, 151, 240); border-radius: 20px;'>{{ $message->content }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
        {{-- event messages section --}}
        <div class="row">
            {{-- left side --}}
            <div id="left-messages" class="col-md-6 py-1">
                <div id="receiver-messages" class="d-flex align-items-center gap-2">
                    
                </div>
            </div>

            {{-- right side --}}
            <div id="right-messages" class="col-md-6 py-1">
                <div id="sender-messages" class="d-flex flex-column align-items-end  justify-content-end gap-2">

                </div>
            </div>

        </div>

    </div>
    <div class="w-100 border-1 bg-body p-2">
        <form {{-- action="/eventMessage/{{ $chatId }}" method="post" --}} id="messageForm" class="d-flex justify-content-between" style="border: 1px solid white; border-radius: 25px; padding:0.25rem;">
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
            <input class="form-control m-1 bg-body text-primary border-0" style="outline: none; box-shadow: none; padding:0px;" id="content" type="text"{{--  class="@error('content') is-invalid @enderror" --}} name="content" {{-- value="{{ old('content') }}" --}} {{-- autocomplete="content" --}} placeholder="Message..." required>
            
            {{-- @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror --}}
            <button id="sendMessageBtn" type="button" class="m-1 bg-body border-0 fw-bold" style="color:#0095f6">Send</button>
        </form>
        <script>
            $(document).ready(function() {
                const sendMessage = function() {
                    var chatId = $('#chat_id').val();

                    var data = {
                        content: $('#content').val(),
                        sender_user_id: $('#sender_user_id').val(),
                        receiver_user_id: $('#receiver_user_id').val(),
                        chat_id: $('#chat_id').val()
                    };

                    $.ajax({
                        url: `http://127.0.0.1:8000/api/eventMessage/${chatId}`,
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(data),
                        success: function(response) {
                            console.log(response);
                            $('#content').val(''); // Limpiar el input después de enviar el mensaje
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error(errorThrown);
                        }
                    });
                };

                $('#sendMessageBtn').click(function(event) {
                    event.preventDefault();
                    sendMessage();
                });

                $('#content').keypress(function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault(); // Evita que se agregue una nueva línea en el input
                        sendMessage();
                    }
                });
            });

        </script>
    </div>
</div>

<script type="module">
    window.Echo.channel('chat')
    .listen('MessageSent', (e) => {
        let message = e.eventMessage;

        let messageElement = document.createElement('p');

        messageElement.textContent = message.content;
        messageElement.style.padding = "7px 12px";
        messageElement.style.borderRadius = "20px";
        messageElement.style.margin = "0px";

        if(message.sender_user_id === Number($('#sender_user_id').val())){ //right side
            messageElement.style.backgroundColor = "rgb(55, 151, 240)";
            document.getElementById('sender-messages').appendChild(messageElement);
        }else{ //left side
            messageElement.style.backgroundColor = "rgb(41, 41, 41)";
            document.getElementById('receiver-messages').appendChild($('#receiver-profile-picture')[0]);
            document.getElementById('receiver-messages').appendChild(messageElement);
        }
    });
</script>

<!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->