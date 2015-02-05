@extends('layouts.master')

@section('head')
	@parent
	<title>Registration</title>
@stop


@section('content')
	<div class="container">
		<h1>Register</h1>
		<form role="form" method="post" action="{{ URL::route('postCreate') }}">
			<div class="form-group {{ ($errors->has('username')) ? 'has-error' : '' }}">
				<label for="username">Username: </label>
				<input id="username" name="username" type="text" class="form-control">
				@if($errors->has('username'))
					{{ $errors->first('username') }}
				@endif
			</div>
			<div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
				<label for="password">Password: </label>
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
			<div class="form-group">
				<input id="btn_submit" name="btn_submit" value="Register" type="submit" class="btn btn-default">
			</div>
		</form>
	</div>
	
@stop