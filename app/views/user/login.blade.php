<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Admin Dashboard Login</title>

	<link href="{{ URL::to('/') }}/css/bootstrap.min.css" rel="stylesheet">
	<link href="{{ URL::to('/') }}/css/signin.css" rel="stylesheet">
</head>

<body>
<div class="container">

	<form class="form-signin" role="form" method="post" action="{{ URL::route('postLogin') }}">
		<h2 class="form-signin-heading">Please sign in</h2>
		@if(Session::has('fail'))
			<div class="alert alert-danger">{{ Session::get('fail') }}</div>
		@endif
		<input type="username" name="username" class="form-control" placeholder="Username" required autofocus>
			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif
		<input type="password" name="password" class="form-control" placeholder="Password" required>
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		<label class="checkbox">
			<input type="checkbox" id="remember" name="remember"> Remember me
		</label>
		{{ Form::token() }}
		<button class="btn btn-lg btn-primary btn-block" type="submit" id="btn_submit">Sign in</button>
	</form>

</div>
</body>
</html>