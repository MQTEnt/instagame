@extends('admin.layout.master')
@section('title-side', 'Games Management')

@section('big-title', 'Games Management')

@section('main-content')

<div class="row margin-bottom">
	<div class="col-lg-2">
		<a class="btn btn-block btn-primary" href="{{route('game.create')}}"><i class="fa fa-user-plus"></i> Add new</a>
	</div>
</div>

<!-- Alert... -->

<!-- table -->
<div class="box">
	<div class="box-header">
		<h3 class="box-title">
			@if(count($games) > 0)
				Game list
			@else
				No record
			@endif
		</h3>
		<div class="box-tools">
			<form action="{{route('tag.search')}}">
				<div class="input-group input-group-sm" style="width: 200px;">
					<input type="text" name="q" class="form-control pull-right" placeholder="Search...">
					<div class="input-group-btn">
						<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- /.box-header -->
	@if(count($games) > 0)
	<div class="box-body table-responsive no-padding">
		<table class="table table-hover">
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Desc</th>
				<th>Rate</th>
				<th style='text-align: center'>Detail</th>
			</tr>
			@foreach($games as $game)
			<tr style="cursor: pointer">
				<td>{{$game->id}}</td>
				<td>{{$game->name}}</td>
				<td>{{$game->desc}}</td>
				<td>{{$game->rate}}</td>
				<td style='text-align: center'><a href="{{route('game.show', $game->id)}}"><i class="fa fa-chevron-circle-right"></i></a></td>
			</tr>
			@endforeach
		</table>
	</div>

	<div class="box-footer clearfix">
		{{ $games->links('admin.partials.pagination') }}
	</div>
	@endif
</div>
<!-- /.table -->
@stop

@section('js')
<script>
	// $(document).ready(function(){
	// 	//Alert effect
	// 	$('#alert').fadeOut(5000);
	// });
</script>
@stop