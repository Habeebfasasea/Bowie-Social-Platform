@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <h1><b>Blog Posts</b></h1>                    
            </div>                       
            @foreach($posts as $post)
                <div class="card mb-5">   
                    <img height="400" src="{{asset($post->image)}}" class="card-img-top" alt="Blog Image">                 
                    <div class="card-body">
                    <h5 class="card-title"><b>{{$post->title}}</b></h5>
                    <p class="card-text">{{ str_limit($post->body, 12) }}</p>
                    <p class="card-text"><small class="text-muted">Author: {{$post->author}}</small></p>
                    <p class="card-text"><small class="text-muted">Department: {{$post->department}}</small></p>                    
                    {{$post->created_at->diffForHumans()}}

                    </div>
                    <div class="text-center mb-2 mt-2">
                        <a href="{{route('blogDetails', $post->slug)}}" class="btn btn-primary">View Post</a>
                    </div>                                       
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
