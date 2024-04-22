@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5 d-flex justify-content-center ">
        {{-- post img --}}
        <div class="col-6">
            <img class="rounded w-100" src="/storage/{{$post->image}}" alt="post-image">
        </div>

        <div class="col-4" style="height: 100%;">
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
            <hr style="margin: 0 0 5px">
            <div class="d-flex flex-column justify-content-between ">
                <div class="d-flex">
                    <div class=" font-weight-bold"><a class="text-decoration-none fw-bold" href="/profile/{{$post->user->id}}"><span class="text-dark">{{ $post->user->username }}</span></a></div>
                    <p class="mx-2 font-weight-bold">{{ $post->caption }}</p>
                </div>

                {{-- comments --}}
                <div>
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
                        </div>


                    @endforeach
                </div>

                <div class="" style="width: 100%;">
                    <hr style="margin: 0 0 5px">
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
