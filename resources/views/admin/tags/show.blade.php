@extends('admin.layout.master')
@section('title-side', 'Detail of tag')

@section('big-title', 'Detail of tag')

@section('back-page')
	<p>
		<a href="{{route('tag.index')}}">
			<i class="fa fa-chevron-left" aria-hidden="true"></i>
			Back to list
		</a>
	</p>
@stop

@section('main-content')
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<div class="box box-primary">
				<!-- form start -->
				<div class="box-body">
					<form id="formEdit" role="form" method="POST" action="{{ route('tag.update', $tag->id) }}">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="PUT">
						<div class="form-group">
							<label for="id">ID</label>
							<input type="text" 
							class="form-control" 
							name="id" 
							value="{{ $tag->id }}"
							disabled>
						</div>

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name">Name</label>
							<input 	id="name" 
							type="text" 
							class="form-control" 
							name="name" 
							value="{{ $tag->name }}"
							placeholder="Tag name...">
							@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
							@endif
						</div>

						<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
							<label for="desc">Description</label>
							<textarea	id="desc" 
							class="form-control" 
							name="desc" 
							placeholder="Tag description">{{$tag->desc}}</textarea>
							@if ($errors->has('desc'))
							<span class="help-block">
								<strong>{{ $errors->first('desc') }}</strong>
							</span>
							@endif
						</div>
					</form>
				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<div class="col-lg-6">
						<button id="btnUpdate" type="button" class="btn btn-primary btn-block"><i class="fa fa-share"></i> Update</button>
					</div>
					<div class="col-lg-6">
						<button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#alertModal"><i class="fa fa-trash-o"></i> <b>Delete</b></button>
					</div>
					<!-- Modal Alert -->
					<div class="modal fade" id="alertModal" role="dialog">
					 	<div class="modal-dialog modal-sm">
					 		<form id="deleteForm" role="form" method="POST" action="{{ route('tag.destroy', $tag->id) }}">
								{{ csrf_field() }}
								<input name="_method" type="hidden" value="DELETE">
						 		<div class="modal-content">
						 			<div class="modal-header">
						 				<h4 class="modal-title">Alert</h4>
						 			</div>
						 			<div class="modal-body">
						 				<p><i class="fa fa-trash" aria-hidden="true"></i> Are you sure to delete this tag</p>
						 			</div>
						 			<div class="modal-footer">
						 				<button type="submit" class="btn btn-success">Ok</button>
						 				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						 			</div>
						 		</div>
						 	</form>
					 	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js')
	<script>
		$(document).ready(function(){
			$('#btnUpdate').click(function(){
				$('#formEdit').submit();
			})
		});
	</script>
@stop