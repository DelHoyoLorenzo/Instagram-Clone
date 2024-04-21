@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5 d-flex justify-content-center ">
        <div class="col-6">
            <img class="w-100" src="/storage/{{$post->image}}" alt="post-image">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div>
                        <a class="text-decoration-none" href="/profile/{{$post->user->id}}">
                            <img src="{{$post->user->profile-> profileImage() }}" alt="user-image" class="rounded-circle w-50" style="max-width: 100px;">
                        </a>
                    </div>    
                    <div class="mx-2 fw-bold"><a class="text-decoration-none" href="/profile/{{$post->user->id}}"><span class="text-dark">{{ $post->user->username }}</span></a></div>
                    |
                    <a href="#" class="p-3"><button class="btn btn-primary">Follow</button></a>
                </div>
            </div>
            <hr>
            <div class="d-flex">
                <div class=" font-weight-bold"><a class="text-decoration-none fw-bold" href="/profile/{{$post->user->id}}"><span class="text-dark">{{ $post->user->username }}</span></a></div>
                <p class="mx-2 font-weight-bold">{{ $post->caption }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
