@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <a class="btn btn-link" href="{{ route('facebook.login') }}">
                        <i class="fa fa-facebook-official" aria-hidden="true"></i> Login with Facebook
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
