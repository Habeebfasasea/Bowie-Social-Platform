@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center mb-3">
        <h1><b>{{$user->department}} Department</b></h1>
    </div>
    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                <h5 class="card-title"><b>Create Posts</b></h5>
                <p class="card-text"></p>
                <a href="{{route('createPosts')}}" class="btn btn-warning">Create Posts</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                <h5 class="card-title"><b>My Posts</b></h5>
                <p class="card-text"></p>
                <a href="{{route('blog.view')}}" class="btn btn-success">View Posts</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                <h5 class="card-title"><b>Revision Notification({{count($revPosts)}})</b></h5>
                <p class="card-text"></p>
                <a href="{{route('blog.revision')}}" class="btn btn-secondary">View Posts</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                <h5 class="card-title"><b>Rejection Notification({{count($rejPosts)}})</b></h5>
                <p class="card-text"></p>
                <a href="{{route('blog.rejected')}}" class="btn btn-danger">Rejected Posts</a>
                </div>
            </div>
        </div>        
        @if($user->super_admin)
            <div class="col-md-4 mb-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <h5 class="card-title"><b>All Posts</b></h5>
                    <p class="card-text"></p>
                    <a href="{{route('all.posts')}}" class="btn btn-primary">All Posts</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <h5 class="card-title"><b>View Approved Posts</b></h5>
                    <p class="card-text"></p>
                    <a href="{{route('appPosts')}}" class="btn btn-success">View Approved Posts</a>
                    </div>
                </div>
            </div>       
            <div class="col-md-4 mb-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <h5 class="card-title"><b>View Pending Posts</b></h5>
                    <p class="card-text"></p>
                    <a href="{{route('pendPosts')}}" class="btn btn-secondary">View Pending Posts</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <h5 class="card-title"><b>Awaiting Revision(Posts)</b></h5>
                    <p class="card-text"></p>
                    <a href="{{route('awaitingRevision')}}" class="btn btn-secondary">Awaiting Revision</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <h5 class="card-title"><b>Rejected Posts</b></h5>
                    <p class="card-text"></p>
                    <a href="{{route('viewRejectedPosts')}}" class="btn btn-danger">Rejected Posts</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                    <h5 class="card-title"><b>View Pending Departments({{count($pendingDepts)}})</b></h5>
                    <p class="card-text"></p>
                    <a href="{{route('appDept')}}" class="btn btn-secondary">Pending Departments</a>
                    </div>
                </div>
            </div>
        @endif        
    </div>
</div>
@endsection
