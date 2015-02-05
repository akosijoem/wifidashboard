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
						<th>Location ID</th>
						<th>Name</th>
						<th>SSID</th>
						<th>Date Created</th>
						<th>Date Last Updated</th>
					</tr>
					@foreach($location as $loc)
					<tr>
						<td>{{ $loc->location_id }}</td>
						<td>{{ $loc->name }}</td>
						<td>{{ $loc->ssid }}</td>
						<td>{{ $loc->created_at }}</td>
						<td>{{ $loc->updated_at }}</td>
					</tr>
					@endforeach
				</table>
			</div>
		</div>
		

	
@stop