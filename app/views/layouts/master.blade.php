<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@section('head')
		<link href="{{ URL::to('/') }}/css/bootstrap.min.css" rel="stylesheet">
		<link href="{{ URL::to('/') }}/css/dashboard.css" rel="stylesheet">
	@show
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">PROJECT WIFI</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{ URL::route('getLogout') }}"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li><a href="{{ URL::route('home') }}"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
				<li><a href="{{ URL::route('loc-home') }}"><span class="glyphicon glyphicon glyphicon-globe"></span> Locations</a></li>
				<li><a href="{{ URL::route('report-home') }}"><span class="glyphicon glyphicon-stats"></span> Reports</a></li>
				<li><a href="{{ URL::route('user-home') }}"><span class="glyphicon glyphicon-user"></span> Users</a></li>
			</ul>
		</div>
		
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			@if(Session::has('success'))
				<div class="alert alert-success">{{ Session::get('success') }}</div>
			@elseif(Session::has('fail'))
				<div class="alert alert-danger">{{ Session::get('fail') }}</div>
			@endif

			@yield('content')
		</div>
	</div>
</div>

@section('javascript')
	<script src="{{ URL::to('/') }}/js/jquery-2.1.1.min.js"></script>
	<script src="{{ URL::to('/') }}/js/bootstrap.min.js"></script>
	<script src="{{ URL::to('/') }}/js/user.js"></script>
	
@show
</body>
</html>