@extends('admin.layout.master')
@section('token')
	<meta name='csrf-token' content='{{csrf_token()}}'/>
@stop

@section('title-side', 'Add new game')

@section('big-title', 'Add new game')

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
<div id="root">
</div>
<!-- /.table -->
@stop

@section('js')
<script src="/js/admin/game/create.js"></script>
@stop