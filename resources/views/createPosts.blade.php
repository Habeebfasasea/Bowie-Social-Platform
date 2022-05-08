@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('posts.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="text-center">
            <h1><b>Create Post</b></h1>
            <a class="btn btn-warning" href="{{route('blog.view')}}">My Posts</a>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Post Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Post Title" name="title">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="formFile" name="image" required>
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Post Body</label>
            <textarea class="form-control @error('body') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" name="body"></textarea>
                @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-warning" type="submit">Create Posts</button>
        </div>
    </form>
</div>
@endsection
