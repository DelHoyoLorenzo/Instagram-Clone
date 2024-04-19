@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" alt="profile-image" class="rounded-circle w-100">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center">
                    <h4>{{$user->username}}</h2>
                    <div id="FollowButton" user_id="{{ $user->id }}"></div>
                    <FollowButton user_id="{{ $user->id }}"/>
                </div>
                @can ('update', $user->profile)
                <a href="/p/create">Add New Post</a>
                @endcan
            </div>

            @can ('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan

            <div class="d-flex justify-content-around">
                <div class="d-flex">
                    <strong>{{$user->posts->count()}}</strong>
                    <p class="pl-3">posts</p>
                </div>
                <div class="d-flex">
                    <strong>{{$user->profile->followers->count()}}</strong>
                    <p class="pl-3">followers</p>
                </div>
                <div class="d-flex">
                    <strong>{{ $user -> followingCount }}</strong>
                    <p class="pl-3">following</p>
                </div>
            </div>
            <div class="pt-4 font-weight-bold">     {{$user->profile->title}}   
            </div>
            <div>{{$user->profile->description}}</div>
            <div><a href="{{$user->profile->url}}" target="_blank">{{$user->profile->url ?? 'link'}}</a></div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach ($user->posts as $post)
        <a class="w-10" href="/p/{{$post->id}}">
            <div class="col-4">
                @if ($post->image)
                    <img class="w-100 rounded" src="/storage/{{ $post->image }}" alt="post-image">
                @else
                    <p>No image available</p>
                @endif
                <h2>{{$post->caption}}</h2>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
