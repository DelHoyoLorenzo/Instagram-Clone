@extends('layouts.app')

@section('content')
<div class="container py-4">
    <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">
        @csrf <!-- //Laravel authenticate the post with this directive, you have to be on the page to post that, to enter that endpoint -->
        @method('PATCH')
        <div class="row">
            <div class="col-8">
                <div class="row mb-3">
                    <div class="row">
                        <h1 class="fw-bold ">Edit Profile</h1> <!-- only shown if logged -->
                    </div>
                    <div class="d-flex align-items-center justify-content-between rounded py-3 my-4" style="background-color:#262626">
                        <div class="col-6 d-flex align-items-center">
                            <img class="w-25 rounded-circle" src="/storage/{{ $user->profile->image }}" alt="user-profile-image">
                            <div class="d-flex flex-column m-1">
                                <h3>{{ $user->username }}</h3>
                                <p>{{ $user->profile->description }}</p>
                            </div>
                        </div>

                        <input class="btn btn-primary" type="file" name="image" class="form-contro-file" id="image" role="alert">
                        
                        @error('image')
                                <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label ">Title</label>
                        <input id="title" 
                        type="text" 
                        class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}"
                        autocomplete="title" autofocus>
                
                        @error('caption')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label ">Description</label>
                        <input id="description" 
                        type="text" 
                        class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') ?? $user->profile->description }}"
                        autocomplete="description" autofocus>
                
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="url" class="col-md-4 col-form-label">URL</label>
                        <input id="url" 
                        type="text" 
                        class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url }}"
                        autocomplete="url" autofocus>
                
                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        <div class="row w-25 pt-4">
            <button class="btn btn-primary">
            Save Profile 
            </button>
        </div>
    </form>
</div>
@endsection