@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/p" enctype="multipart/form-data" method="post">
        @csrf <!-- //Laravel authenticate the post with this directive, you have to be on the page to post that, to enter that endpoint -->
        <div class="row">
            <div class="col-8 offset-2">
            <div class="row mb-3">
                <div class="form-group row">
                <div class="row">
                    <h1>Add New Post</h1>
                </div>
                <label for="caption" class="col-md-4 col-form-label text-md-end">Post Caption</label>
                <input id="caption" 
                type="text" 
                class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"
                autocomplete="caption" autofocus>
        
                @error('caption')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label text-md-end">Post Image</label>
                    <input type="file" name="image" class="form-contro-file" id="image" role="alert">
                    
                    @error('image')
                            <strong>{{ $message }}</strong>
                    @enderror
                </div>
    <div class="row">
    <button class="btn btn-primary">
       Add New Post 
    </button>
    </div>
                </div>
                                
            </div>
        </div>
    </form>
</div>
@endsection
