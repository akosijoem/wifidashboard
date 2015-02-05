@extends('layouts.master')

@section('head')
	@parent
	<title>Location</title>
@stop


@section('content')
	
		<div class="row">
			<div class="col-md-12">
				<h1>Location</h1>
				<a href="{{ URL::route('listLoc') }}" class="btn btn-primary">View all</a>
				<a href="{{ URL::route('addLoc') }}" class="btn btn-primary">Add Location</a>
			</div>
		</div>
		

	
@stop