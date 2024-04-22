@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
    <div class="col-9">
    @foreach($posts as $post)
        <div class="col-3 offset-3 py-4 d-flex gap-2 text-primary">
            <a class="text-decoration-none" href="/profile/{{$post->user->id}}">
                <img class="w-50 p-0 m-0  rounded-circle" src="{{ $post->user->profile->profileImage() }}" alt="user-profile-image">
            </a>
            <div class="pl-1">
                <p class="fw-bold"><a class="text-decoration-none" href="/profile/{{$post->user->id}}">{{ $post->user->username }}</a></p>
            </div>
        </div>
        {{-- image --}}
        <div class="col-6 offset-3">
            <a href="/p/{{ $post->id }}">
                <img class="w-100 rounded" src="/storage/{{ $post->image }}" alt="post-image">
            </a>
        </div>
        <div class="col-6 offset-3 py-4">
            <div class="d-flex align-items-baseline gap-2">
                <div>
                    <a class="text-decoration-none fw-bold" href="/profile/{{$post->user->id}}">
                       <span>{{ $post->user->username }}</span>
                    </a>
                </div>
                <p class="p-1 m-0 font-weight-bold text-primary">{{ $post->caption }}</p>
            </div>
        </div>
        <hr class="col-6 text-primary offset-3">
    @endforeach
    </div>

    <div class="col-3 py-4 d-flex">
        {{-- //imagen //username
                      //descp --}}
        <a class="text-decoration-none" href="/profile/{{$user->id}}">
            <div class="col-6 d-flex align-items-center">
                <img class="w-50 rounded-circle" src="/storage/{{ $user->profile->image }}" alt="user-profile-image">
                <div class="d-flex flex-column m-1">
                    <h3>{{ $user->username }}</h3>
                    <p>{{ $user->profile->description }}</p>
                </div>
            </div>
        </a>
        <a href="">
            <p>View all comments...</p>
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
