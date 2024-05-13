<!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
<div>
    <x-chat />
</div>
{{-- where I reach create message endpoint | TODO it has not be shown if I did not click a chat --}}
{{-- <form class="d-flex align-items-baseline justify-content-between" action="/messages/{{ auth()->user()->id }}" enctype="multipart/form-data" method="post">
    @csrf
    @foreach($chat->users as $user)
        @if($user->id == auth()->user()->id)
            <input type="hidden" id="sender_user_id" name="sender_user_id" value="{{ auth()->user()->id }}"/>
        @else
            <input type="hidden" id="receiver_user_id" name="receiver_user_id" value="{{ $user->id }}">
        @endif
    @endforeach
            
    <input type="hidden" id="chat_id" name="chat_id" value="{{ $chat->id }}">
    <input class="bg-body text-primary border-0" style="border:none; " id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" autocomplete="content" placeholder="Message..." autofocus>
    
    @error('content')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <button type="submit" class="bg-body text-primary border-0 fw-bold">Post</button>
</form> --}}