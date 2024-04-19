@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img class="w-100" src="/storage/{{$post->image}}" alt="post-image">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pr-2">
                        <img src="{{$post->user->profile-> profileImage() }}" alt="user-image" class="rounded-circle w-50" style="max-width: 100px;">
                    </div>    
                    <div class="font-weight-bold"><a href="/profile/{{$post->user->id}}"><span class="text-dark">{{ $post->user->username }}</span></a></div>
                    |
                    <a href="#" class="p-3">Follow</a>
                </div>
            </div>
            <hr>
            <div class="d-flex">
                <div class="p-2 font-weight-bold"><a href="/profile/{{$post->user->id}}"><span class="text-dark">{{ $post->user->username }}</span></a></div>
                <p class="p-0 font-weight-bold">{{ $post->caption }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
