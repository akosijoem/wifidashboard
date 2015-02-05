@extends('layouts.master')

@section('head')
	@parent
	<title>User</title>
@stop


@section('content')
	
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered">
					<tr>
						<th>Username</th>
						<th>User Level</th>
						<th>Date Created</th>
						<th>Date Last Updated</th>
					</tr>
					@foreach($users as $user)
					<tr>
						<td>{{ $user->username }}</td>
						<td>{{ $user->role }}</td>
						<td>{{ $user->created_at }}</td>
						<td>{{ $user->updated_at }}</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
		

	
@stop