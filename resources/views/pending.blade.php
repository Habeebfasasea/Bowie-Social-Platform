@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <h1><b>Your request to create a department is pending</b></h1>                    
            </div>           
            <div class="text-center mb-3">
                <a href="{{ url('/') }}"><button class="btn btn-warning" type="submit">Home Page</button></a>
            </div>            

        </div>
    </div>
</div>
@endsection
