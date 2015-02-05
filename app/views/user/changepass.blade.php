@extends('layouts.master')

@section('head')
	@parent
	<title>User</title>
@stop


@section('content')
	
		<div class="row">
			<div class="col-md-4">
				<h1>User</h1>
				<form role="form" method="post" action="{{ URL::route('postChangePass') }}">
					<div class="form-group">
					
						<label for="username">Username: </label>
						<input value="{{ Auth::user()->username }}" disabled id="username" name="username" type="text" class="form-control">
					</div>
					<div class="form-group {{ ($errors->has('old_password')) ? 'has-error' : '' }}">
						<label for="old_password">Old Password: </label>
						<input id="old_password" name="old_password" type="password" class="form-control">
						@if($errors->has('old_password'))
							{{ $errors->first('old_password') }}
						@endif
					</div>
					<div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
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
					</div>
					{{ Form::token() }}
					<div class="form-group pull-right">
						<input value="Change" type="submit" class="btn btn-primary">
						<input value="Clear" type="reset" class="btn btn-default">
					</div>
				</form>
			</div>
		</div>
		

	
@stop