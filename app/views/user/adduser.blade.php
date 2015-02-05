@extends('layouts.master')

@section('head')
	@parent
	<title>User</title>
@stop


@section('content')
	
		<div class="row">
			<div class="col-md-4">
				<h1>Add User</h1>
				<form role="form" id="location_submit" method="post" action="{{ URL::route('addUser') }}">
					<div class="form-group">
						<label for="location">Location: </label>							
							<select class="form-control" id="location_adduser" name="location">
								<option value="">-----------------</option>
								@foreach($location as $loc)								
									<option value="{{ $loc->location_id }}">{{ $loc->name }}</option>
								@endforeach
							</select>
							{{ Form::token() }}
							
					</div>
					<!--<div class="form-group">
						<label for="location">User Role: </label>
							<select class="form-control" id="role" name="role">
							@foreach($roles as $role)
								<option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
							@endforeach
						</select>
					</div>
					
					
					<div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
					
						<label for="username">Email: </label>
						<input value="{{ Input::old('email') }}" id="email" name="email" type="email" class="form-control">
						@if($errors->has('email'))
							{{ $errors->first('email') }}
						@endif
					</div>
					
					<div class="form-group {{ ($errors->has('username')) ? 'has-error' : '' }}">
					
						<label for="username">Username: </label>
						<input value="{{ Input::old('username') }}" id="username" name="username" type="text" class="form-control">
						@if($errors->has('username'))
							{{ $errors->first('username') }}
						@endif
					</div>
					<!--<div class="form-group {{ ($errors->has('fname')) ? 'has-error' : '' }}">					
						<label for="fname">First name: </label>
						<input value="{{ Input::old('fname') }}" id="fname" name="fname" type="text" class="form-control">
						
						@if($errors->has('fname'))
							{{ $errors->first('fname') }}
						@endif
					</div>
						<div class="form-group {{ ($errors->has('lname')) ? 'has-error' : '' }}">					
						<label for="lname">Last Name: </label>
						<input value="{{ Input::old('lname') }}" id="lname" name="lname" type="text" class="form-control">
						@if($errors->has('lname'))
							{{ $errors->first('lname') }}
						@endif
					</div>-->
					<!--<div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
						<label for="password">New Password: </label>
						<input id="password" name="password" type="password" class="form-control">
						@if($errors->has('password'))
							{{ $errors->first('password') }}
						@endif
					</div>
					<div class="form-group {{ ($errors->has('confirm')) ? 'has-error' : '' }}">
						<label for="confirm">Confirm Password: </label>
						<input id="confirm" name="confirm" type="password" class="form-control">
						@if($errors->has('confirm'))
							{{ $errors->first('confirm') }}
						@endif
					</div>-->
					
						
				</form>
				
				
				
				
				
				
			</div>
		</div>
		

	
@stop