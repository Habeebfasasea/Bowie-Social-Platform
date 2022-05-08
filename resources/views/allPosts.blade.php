@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <h1><b>Blog Posts</b></h1>
                    @if(count($posts) < 1)
                        <h4 class="text-center">No Blog Posts</h4>
                    @endif
            </div>                       
            @foreach($posts as $post)
                
                    <div class="card mb-5">
                        <img height="400" src="{{asset($post->image)}}" class="card-img-top" alt="Blog Image">                                    
                        <div class="card-body">
                        <h5 class="card-title"><b>{{$post->title}}</b></h5>
                        <p class="card-text">{{ str_limit($post->body, 12) }}</p>
                        <p class="card-text"><small class="text-muted">Author: {{$post->author}}</small></p>
                        <p class="card-text"><small class="text-muted">Department: {{$post->department}}</small></p>
                        <p class="card-text"><small class="text-muted">Status: 
                            @if($post->approved)
                            Approved
                            @elseif($post->pending)
                            Pending
                            @elseif($post->revise)
                            Awaiting Revision
                            @elseif($post->reject)
                            Rejected
                            @endif</small>
                        </p>
                        </div>
                        @if($post->approved == 1)
                            <div class="mb-2 mt-1">
                                {!! Share::page('https://bowiesocial-com.stackstaging.com/blogDetails/'.$post->slug,)->facebook()->twitter()->whatsapp() !!}
                            </div>
                        @endif
                        <div class="text-center mb-3 mt-3">
                            <a href="{{route('blogDetails', $post->slug)}}"><button class="btn btn-success" type="submit">View Post</button></a>                            
                            <a href="{{route('deleteBlogPostSup', $post->id)}}"><button class="btn btn-danger" type="submit">Delete</button></a>
                        </div>
                    </div>
                                    
            @endforeach

        </div>
    </div>
</div>
@endsection
