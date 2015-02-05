@extends('layouts.master')

@section('head')
	@parent
	<title>User</title>
@stop


@section('content')
	
		<div class="row">
			<div class="col-md-4">
				<h1>Locations</h1>
				<form role="form" method="post" action="{{ URL::route('addLocPost') }}">
					
					<!--<div class="form-group">
						<label for="location">Existing Roles: </label>
							<select class="form-control" id="role" name="role">
							@foreach($roles as $role)
								<option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
							@endforeach
							
						</select>
					
					</div>-->
					
				
					
					<div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
						<label for="location">Name of New Location: </label>							
							<input value="{{ Input::old('name') }}" id="name" name="name" type="text" class="form-control">
						@if($errors->has('name'))
							{{ $errors->first('name') }}
						@endif
					</div>
					
					
					<div class="form-group {{ ($errors->has('ssid')) ? 'has-error' : '' }}">
						<label for="location">Name of SSID: </label>							
							<input value="{{ Input::old('ssid') }}" id="ssid" name="ssid" type="text" class="form-control">
						@if($errors->has('ssid'))
							{{ $errors->first('ssid') }}
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