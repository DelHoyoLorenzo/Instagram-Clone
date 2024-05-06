@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5 d-flex justify-content-center ">
        {{-- post img --}}
        <div class="col-6 p-0">
            <img class="w-100" src="/storage/{{$post->image}}" alt="post-image">
        </div>

        <div class="col-4 p-0" style="height: 100%;">
            <div class="px-4">
                <div class="d-flex align-items-center">
                    <div>
                        <a class="text-decoration-none" href="/profile/{{$post->user->id}}">
                            <img src="{{$post->user->profile-> profileImage() }}" alt="user-image" class="rounded-circle w-50" style="max-width: 100px;">
                        </a>
                    </div>    
                    <div class="mx-2 fw-bold"><a class="text-decoration-none" href="/profile/{{$post->user->id}}"><span class="text-dark">{{ $post->user->username }}</span></a></div>
                    <span class="fw-bolder">.</span>
                    @php
                        $isFollowed = false;
                        foreach(auth()->user()->following as $following){
                            if($following->user_id == $post->user->id){
                                $isFollowed = true;
                            }
                        }
                    @endphp
                        
                    @if( $post->user->profile->user_id != auth()->user()->id)
                        <div id="FollowButton" user_id="{{ auth()->user()->id }}" isFollowed="{{ $isFollowed }}"></div>
                    @endif

                </div>
            </div>
            <hr style="margin: 0 0 5px; width: 100%; padding: 0px;">
            <div class="d-flex flex-column justify-content-between">
                <div class="d-flex px-4">
                    <div class=" font-weight-bold"><a class="text-decoration-none fw-bold" href="/profile/{{$post->user->id}}"><span class="text-dark">{{ $post->user->username }}</span></a></div>
                    <p class="mx-2 font-weight-bold">{{ $post->caption }}</p>
                </div>

                {{-- comments --}}
                <div class="px-4">
                    @foreach($post->comments as $comment)
                        <div class="d-flex align-items-baseline gap-2">
                            <div class="d-flex" style="width:20%;">
                                <a class="text-decoration-none" href="/profile/{{ $post->user->id }}">
                                    <img class="w-25 rounded-circle" src="{{ $post->user->profile->profileImage() }}" alt="user-profile-image">
                                </a>
                            </div>
                            <a class="text-decoration-none" href="/profile/{{ $post->user->id }}">
                                <p class="fw-bold"> {{ $comment->user->username  }} </h3>
                            </a>
                            <p>{{ $comment->comment  }}</p>
                            <div>
                                <svg aria-label="Comment Options" class="x1lliihq x1n2onr6 x1roi4f4" fill="currentColor" height="24" role="img" viewBox="0 0 24 24" width="24"><title>Comment Options</title><circle cx="12" cy="12" r="1.5"></circle><circle cx="6" cy="12" r="1.5"></circle><circle cx="18" cy="12" r="1.5"></circle></svg>
                            </div>
                        </div>


                    @endforeach
                </div>

                <hr style="margin: 0 0 5px">
                <div class="px-4" style="width: 100%;">
                    {{-- like-comment icons --}}
                    <div class="d-flex gap-3 my-2">
                        <div style="cursor: pointer;" id="likeButton" class="likeButton" liked={{ $post->likes }} post_id={{ $post->id }} user_id={{ auth()->user()->id }} key={{ $post->id }} ></div>
                        <a href="/p/{{ $post->id }}">
                            <svg width="25" viewBox="0 0 32.00 32.00" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000" transform="matrix(-1, 0, 0, 1, 0, 0)rotate(0)" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.384"></g><g id="SVGRepo_iconCarrier"> <title>comment-1</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke-width="0.00032" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-100.000000, -255.000000)" fill="#ffffff"> <path d="M116,281 C114.832,281 113.704,280.864 112.62,280.633 L107.912,283.463 L107.975,278.824 C104.366,276.654 102,273.066 102,269 C102,262.373 108.268,257 116,257 C123.732,257 130,262.373 130,269 C130,275.628 123.732,281 116,281 L116,281 Z M116,255 C107.164,255 100,261.269 100,269 C100,273.419 102.345,277.354 106,279.919 L106,287 L113.009,282.747 C113.979,282.907 114.977,283 116,283 C124.836,283 132,276.732 132,269 C132,261.269 124.836,255 116,255 L116,255 Z" id="comment-1" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                        </a>
                    </div>
                    {{-- likes qty --}}
                    <div class="d-flex align-items-baseline gap-2">
                        <p class="fw-bold">
                            @php
                                $sum = 0;
                                foreach($post->likes as $like) {
                                    if($like->like) {
                                        $sum += 1;
                                    }
                                }
                                echo $sum;
                            @endphp
                        </p>
                        <p class="fw-bold">likes</p>
                    </div>
                    <form class="d-flex align-items-baseline justify-content-between" action="/comments/create/{{ $post->id }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <input class="bg-body text-primary border-0" style="border:none; " id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" autocomplete="comment" placeholder="Add a comment..." autofocus>
                        
                        @error('comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button type="submit" class="bg-body text-primary border-0 fw-bold">Post</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
