@extends('layouts.master')

@section('head')
	@parent
	<title>User</title>
@stop


@section('content')
	
		<div class="row">
			<div class="col-md-12">
				<h1>User</h1>
				
				<a href="{{ URL::route('addRole') }}" class="btn btn-primary">Roles</a>
				<a href="{{ URL::route('addUser') }}" class="btn btn-primary">New User</a>
				<a href="{{ URL::route('userList') }}" class="btn btn-primary">List User</a>
				<a href="{{ URL::route('changePass') }}" class="btn btn-primary">Change Password</a>
				<a href="{{ URL::route('userSettings') }}" class="btn btn-primary">User Settings</a>
			</div>
		</div>
		

	
@stop