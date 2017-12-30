@extends('admin.layout.master')
@section('token')
	<meta name='csrf-token' content='{{csrf_token()}}'/>
@stop

@section('title-side', 'Add new item')

@section('big-title', 'Add new item')

@section('back-page')
	<p>
		<a href="{{route('item.index')}}">
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
<script src="/js/admin/item.js"></script>
@stop