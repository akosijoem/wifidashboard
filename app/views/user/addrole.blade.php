@extends('layouts.master')

@section('head')
	@parent
	<title>User</title>
@stop


@section('content')
	
		<div class="row">
			<div class="col-md-4">
				<h1>Roles</h1>
				<form role="form" method="post" action="{{ URL::route('addRolePost') }}">
					
					<!--<div class="form-group">
						<label for="location">Existing Roles: </label>
							<select class="form-control" id="role" name="role">
							@foreach($roles as $role)
								<option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
							@endforeach
							
						</select>
					
					</div>-->
					
					<div class="form-group {{ ($errors->has('location')) ? 'has-error' : '' }}">
						<label for="location">Location: </label>							
							<select class="form-control" id="location" name="location">
							@foreach($location as $loc)
								<option value="{{ $loc->location_id }}">{{ $loc->name }}</option>
							@endforeach
						</select>
					</div>
					
					
					<div class="form-group {{ ($errors->has('role_name')) ? 'has-error' : '' }}">
						<label for="location">Name of New Role: </label>							
							<input value="{{ Input::old('role_name') }}" id="role_name" name="role_name" type="text" class="form-control">
						@if($errors->has('role_name'))
							{{ $errors->first('role_name') }}
						@endif
					</div>
					
					
					<div class="form-group">
						<label for="location">Status: </label>							
							<select class="form-control" id="is_active" name="is_active">
							
								<option value="0">Disable</option>
								<option value="1">Enable</option>
						
						</select>
					</div>
					
					
					
					
					{{ Form::token() }}
					<div class="form-group pull-right">
						<input value="Save" type="submit" class="btn btn-primary">
						<input value="Clear" type="reset" class="btn btn-default">
					</div>
				</form>
			</div>
		</div>
		

	
@stop