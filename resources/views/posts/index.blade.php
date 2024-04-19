@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
    <div class="row">
        <div class="col-6 offset-3">
            <a href="/profile/{{ $post->user->id }}">
                <img class="w-100" src="/storage/{{$post->image}}" alt="post-image">
            </a>
        </div>
        <div class="row p-4">
            <div class="col-6 offset-3">
                <div class="d-flex align-items-center">
                    <div class="p-2 font-weight-bold">
                        <a href="/profile/{{$post->user->id}}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </div>
                    <p class="p-0 font-weight-bold text-dark">{{ $post->caption }}</p>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
