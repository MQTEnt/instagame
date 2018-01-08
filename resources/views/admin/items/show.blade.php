@extends('admin.layout.master')
@section('token')
	<meta name='csrf-token' content='{{csrf_token()}}'/>
@stop

@section('title-side', 'Detail of item')

@section('big-title', 'Detail of item')

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
<div id="root" data-item-id='{{$item_id}}'>
</div>
<!-- /.table -->
@stop

@section('js')
<script src="/js/admin/item/edit.js"></script>
@stop