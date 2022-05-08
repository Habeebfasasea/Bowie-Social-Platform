@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <h1><b>Awaiting Revision({{count($posts)}})</b></h1>
                    
            </div>           
            <div class="text-center mb-3">
                <a href="{{ route('appPosts') }}"><button class="btn btn-outline-secondary" type="submit">Approved Posts</button></a>
                <a href="{{route('pendPosts')}}"><button class="btn btn-outline-warning" type="submit">Pending Posts</button></a>
                <a href="{{route('viewRejectedPosts')}}"><button class="btn btn-outline-danger" type="submit">Rejected Posts</button></a>
            </div>
            @foreach($posts as $post)
            <div class="card mb-5">
                <img height="400" src="{{asset($post->image)}}" class="card-img-top" alt="Blog Image">                
                <div class="card-body">                                
                <h5 class="card-title"><b>{{$post->title}}</b></h5>
                <p class="card-text">{{$post->body}}</p>
                <p class="card-text"><small class="text-muted">Author: {{$post->author}}</small></p>
                <p class="card-text"><small class="text-muted">Department: {{$post->department}}</small></p>
                <p class="card-text"><small class="text-muted">Status: 
                    @if($post->approved)Approved
                    @elseif($post->pending)
                    Pending
                    @elseif($post->revise)
                    Awaiting Revision
                    @elseif($post->reject)
                    Rejected
                    @endif</small>
                </p>
                <p class="card-text"><small class="text-muted">Revision Reason: {{$post->revise_reason}}</small></p>
                </div>
                <div class="text-center mb-2 mt-2">
                    <a href="{{route('disAppPostsPen.posts',$post->id)}}" class="btn btn-primary">Set To Pending</a>
                    <a class="btn btn-warning" onclick="toggleRevise('{{$post->id}}')">Revise Post</a>
                    <a class="btn btn-danger" onclick="toggleReject('{{$post->id}}')">Reject Post</a>
                </div>
                {{-- Revise Form --}}
                <div class="revise-form-{{$post->id}} d-none">
                    <div class="container text-center mt-4">
                        <form action="{{route('awaiting.update',  $post->slug)}}" method="POST">
                            @csrf
                            <div class="">
                                <h4><b>Revise Post</b></h4>   
                            </div>                           
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Revise Comment</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="revise_reason" required>{{$post->revise_reason}}</textarea>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-warning" type="submit">Revise</button>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- Reject Form --}}
                <div class="reject-form-{{$post->id}} d-none">
                    <div class="container text-center mt-4">
                        <form action="{{route('rejected.update',  $post->slug)}}" method="POST">
                            @csrf
                            <div class="">
                                <h4><b>Reject Post</b></h4>   
                            </div>                           
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Rejection Reason</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="reject_reason">{{$post->reject_reason}}</textarea>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-warning" type="submit">Reject</button>
                            </div>
                        </form>
                    </div>
                </div>                  
            </div>
            @endforeach

        </div>
    </div>
</div>
<script>
    function toggleRevise(postId){
            $('.revise-form-'+postId).toggleClass('d-none');
    }

    function toggleReject(postId){
            $('.reject-form-'+postId).toggleClass('d-none');            
    }
</script>
@endsection
