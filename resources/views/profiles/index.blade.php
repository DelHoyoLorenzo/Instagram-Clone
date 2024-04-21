@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-3 p-5">
                <img src="{{ $user->profile->profileImage() }}" alt="profile-image" class="rounded-circle w-100">
            </div>
            <div class="col-6 pt-5">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center my-4">
                        <h4>{{$user->username}}</h2>
                        <div id="FollowButton" user_id="{{ $user->id }}"></div>
                        @if( $user->id != $user->profile->user_id)
                            <FollowButton user_id="{{ $user->id }}"/>
                        @endif
                        @can ('update', $user->profile)
                            <a href="/profile/{{ $user->id }}/edit"><button class="mx-2 btn btn-primary">Edit Profile</button></a>
                        @endcan
                        @can ('update', $user->profile)
                        <a href="/p/create"><button class="mx-2 btn btn-primary">New Post</button></a>
                        @endcan
                    </div>
                </div>
    
    
                <div class="col-4 d-flex gap-5">
                    <div class="d-flex gap-1">
                        <strong>{{$user->posts->count()}}</strong>
                        <p>posts</p>
                    </div>
                    <div class="d-flex gap-1">
                        <strong>{{$user->profile->followers->count()}}</strong>
                        <p>followers</p>
                    </div>
                    <div class="d-flex gap-1">
                        <strong>{{ $user->following->count() }}</strong>
                        <p>following</p>
                    </div>
                </div>
                <div class="pt-4 font-weight-bold">{{$user->profile->title}}   
                </div>
                <div>{{$user->profile->description}}</div>
                <div><a href="{{$user->profile->url}}" target="_blank">{{$user->profile->url ?? 'link'}}</a></div>
            </div>
            <hr class="mt-5">
        </div>
        <div class="row pt-5">
            @foreach ($user->posts as $post)
            <div class="col-4">
                <a class="w-10 text-decoration-none" href="/p/{{$post->id}}">
                    @if ($post->image)
                        <img class="w-100 rounded" src="/storage/{{ $post->image }}" alt="post-image">
                    @else
                        <p>No image available</p>
                    @endif
                    <h2 class="my-1">{{ $post->caption }}</h2>
                </a>
            </div>
            @endforeach
        </div>
</div>
@endsection
