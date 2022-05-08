@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('post.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="text-center">
            <h1><b>Edit Post</b></h1>
            <a class="btn btn-warning" href="{{route('blog.view')}}">My Posts</a>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Post Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Post Title" name="title" value=" {{$post->title}} ">
                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="col-md-12">                                                        
            <div class="">                                                                           
                <img src="{{asset($post->image)}}" width="200" height="150" alt="post image">
            </div>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Image</label>
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="formFile" name="image">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Post Body</label>
            <textarea class="form-control @error('body') is-invalid @enderror" id="exampleFormControlTextarea1" rows="5" name="body">{{$post->body}}</textarea>
                @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>        
        <div class="mb-3">
            <button class="btn btn-warning" type="submit">Edit Post</button>
        </div>
    </form>
</div>
@endsection
