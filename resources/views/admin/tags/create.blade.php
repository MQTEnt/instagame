@extends('admin.layout.master')
@section('title-side', 'Add new tag')

@section('big-title', 'Add new tag')

@section('back-page')
	<p>
		<a href="{{route('tag.index')}}">
			<i class="fa fa-chevron-left" aria-hidden="true"></i>
			Back to list
		</a>
	</p>
@stop

@section('main-content')
	<div class="box box-primary">
		<!-- form start -->
		<form role="form" method="POST" action="{{ route('tag.store') }}">
			{{ csrf_field() }}
			<div class="box-body">
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name">Name</label>
					<input 	id="name" 
							type="text" 
							class="form-control" 
							name="name" 
							value="{{ old('name') }}"
							placeholder="Tag name"
							required>
					@if ($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group{{ $errors->has('desc') ? ' has-error' : '' }}">
					<label for="desc">Description</label>
					<textarea	
						id="desc" 
						class="form-control" 
						name="desc" 
						placeholder="Tag description">{{old('desc')}}</textarea>
					@if ($errors->has('desc'))
					<span class="help-block">
						<strong>{{ $errors->first('desc') }}</strong>
					</span>
					@endif
				</div>
			</div>
			<!-- /.box-body -->

			<div class="box-footer">
				<button type="submit" class="btn btn-primary"><i class="fa fa-share" aria-hidden="true"></i> Create</button>
			</div>
		</form>
	</div>
@stop