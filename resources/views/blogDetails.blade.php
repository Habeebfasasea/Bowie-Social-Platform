@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <h1><b>Blog Details</b></h1>                    
            </div>                                   
                <div class="card mb-3">
                    <img height="400" src="{{asset($post->image)}}" class="card-img-top" alt="Blog Image">                                   
                    <div class="card-body">
                    <h2 class="card-title"><b>{{$post->title}}</b></h2>
                    <p class="card-text">{{$post->body}}</p>
                    <p class="card-text"><small class="text-muted">Author: {{$post->author}}</small></p>
                    <p class="card-text"><small class="text-muted">Department: {{$post->department}}</small></p>                    
                    </div>                                                         
                </div>
           
        </div>
    </div>
</div>
@endsection
