@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-9">
        @foreach($posts as $post)
            <div class="col-4 offset-2 py-3 d-flex gap-1 text-primary">
                <a class="text-decoration-none" href="/profile/{{$post->user->id}}">
                    <img class="w-50 p-0 m-0  rounded-circle" src="{{ $post->user->profile->profileImage() }}" alt="user-profile-image">
                </a>
                <div class="pl-1" style="width: 100%;">
                    <p class="fw-bold"><a class="text-decoration-none" href="/profile/{{$post->user->id}}">{{ $post->user->username }}</a></p>
                </div>
            </div>
            {{-- image --}}
            <div class="col-7 offset-2">
                <a href="/p/{{ $post->id }}">
                    <img class="w-100 rounded" src="/storage/{{ $post->image }}" alt="post-image">
                </a>
            </div>
            <div class="col-6 offset-2 py-2">
                {{-- like-comment icons --}}
                <div class="d-flex gap-3 my-2">
                    <div style="cursor: pointer;" id="LikeButton" class="like-button" post_id={{ $post->id }} ></div>
                    
                    {{-- <LikeButton id="like-button" post_id={{ $post->id }}/> --}}

                    @include('components.like-button', ['post_id' => $post->id])
                    
                    <svg width="25" viewBox="0 0 32.00 32.00" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000" transform="matrix(-1, 0, 0, 1, 0, 0)rotate(0)" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.384"></g><g id="SVGRepo_iconCarrier"> <title>comment-1</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke-width="0.00032" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-100.000000, -255.000000)" fill="#ffffff"> <path d="M116,281 C114.832,281 113.704,280.864 112.62,280.633 L107.912,283.463 L107.975,278.824 C104.366,276.654 102,273.066 102,269 C102,262.373 108.268,257 116,257 C123.732,257 130,262.373 130,269 C130,275.628 123.732,281 116,281 L116,281 Z M116,255 C107.164,255 100,261.269 100,269 C100,273.419 102.345,277.354 106,279.919 L106,287 L113.009,282.747 C113.979,282.907 114.977,283 116,283 C124.836,283 132,276.732 132,269 C132,261.269 124.836,255 116,255 L116,255 Z" id="comment-1" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                </div>

                <div class="d-flex align-items-baseline gap-2">
                    <div>
                        <a class="text-decoration-none fw-bold" href="/profile/{{$post->user->id}}">
                        <span>{{ $post->user->username }}</span>
                        </a>
                    </div>
                    <p class="p-0 m-0 font-weight-bold text-primary">{{ $post->caption }}</p>
                </div>
                <a class="text-decoration-none m-0 p-0" href="/p/{{ $post->id }}">
                    <p class="p-0 my-2 text-comment" >View all comments...</p>
                </a>
            </div>
            <hr class="col-7 text-primary offset-2 my-0">
            @endforeach
        </div>

        {{-- side bar user info --}}
        <div class="col-3 py-4 d-flex">
            <a class="text-decoration-none" href="/profile/{{$user->id}}">
                <div class="col-6 d-flex align-items-center">
                    <div></div>
                    <img class="w-25 rounded-circle" src="{{ $user->profile->profileImage() }}" alt="user-profile-image">
                    <div class="d-flex flex-column align-items-baseline" style="margin-left: 10px;">
                        <p class="fw-bold m-0">{{ $user->username }}</h3>
                        <p>{{ $user->profile->description }}</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
    {{-- <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div> --}}
</div>
@endsection
<script>
    const post_id_{{ $post->id }} = {{ $post->id }};
    ReactDOM.render(
        <React.StrictMode>
            <LikeButton post_id={post_id_{{ $post->id }}} />
            </React.StrictMode>,
                document.getElementById('like-button-{{ $post->id }}')
            );
</script>