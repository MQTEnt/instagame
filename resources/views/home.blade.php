@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <p style='text-align: center'><a href="/login">Login</a></p>
                <p style='text-align: center'><a href="/logout">Logout</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
