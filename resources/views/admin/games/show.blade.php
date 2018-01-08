@extends('admin.layout.master')
@section('token')
	<meta name='csrf-token' content='{{csrf_token()}}'/>
@stop

@section('title-side', 'Detail of game')

@section('big-title', 'Detail of game')

@section('back-page')
	<p>
		<a href="{{route('game.index')}}">
			<i class="fa fa-chevron-left" aria-hidden="true"></i>
			Back to list
		</a>
	</p>
@stop

@section('main-content')

<!-- table -->
<div id="root" data-game-id='{{$game_id}}'>
</div>
<!-- /.table -->
@stop

@section('js')
<script src="/js/admin/game/edit.js"></script>
@stop