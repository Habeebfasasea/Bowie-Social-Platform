@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <h1><b>Approved Departments({{count($users)}})</b></h1>                   
            </div>           
            <div class="text-center mb-3">
                <a href="{{ route('appDept') }}"><button class="btn btn-warning" type="submit">Pending Departments</button></a>
            </div>
            @foreach($users as $user)                
                <div class="card mb-5">                    
                    <div class="card-body">
                    <h5 class="card-title"><b>{{$user->department}}</b></h5>                    
                    <p class="card-text"><small class="text-muted">Admin Name: {{$user->name}}</small></p>                    
                    <p class="card-text"><small class="text-muted">Status: 
                        @if($user->admin)Approved
                        @else 
                        Pending
                        @endif</small>
                    </p>
                    </div>
                    <div class="text-center mb-2 mt-2">
                        <a href="{{route('disAppDept.Role',$user->id)}}" class="btn btn-primary">Disapprove</a>
                    </div>                   
                </div>                
            @endforeach

        </div>
    </div>
</div>
@endsection
