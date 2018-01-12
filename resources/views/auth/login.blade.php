@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <a 
                        class="btn btn-link"  
                        target="_blank"
                        onclick="window.open('/facebook', 
                            'newwindow', 
                            'width=450,height=600'); 
                            return false;"
                    >
                        <i class="fa fa-facebook-official" aria-hidden="true"></i> Login with Facebook
                    </a>
                    <input type="hidden" id="back_url" value='{{ $back_url }}'>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(window).bind('storage', function (e) {
        //console.log(e.originalEvent.newValue);
        window.location = $('#back_url').val()
    });
</script>
@endsection
