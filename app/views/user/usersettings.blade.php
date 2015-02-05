@extends('layouts.master')

@section('head')
	@parent
	<title>Choose User</title>
@stop


@section('content')
	
		<div class="row">
			<div class="col-md-6">
				<h1>Choose User</h1>
					<div class="form-group">
						<label for="location">User Role: </label>
							<select class="form-control" id="role" name="role">
							<option>------</option>
							@foreach($roles as $role)
								<option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
							@endforeach
						</select>
					</div>		




					<div class="super_user" style="display: none;">
						<table class="table">
							<tr>
								<th>Viewing of Users</th>
								<td><input type="radio" name="bandwidth">Yes <input type="radio" name="bandwidth">No</td>
							</tr>
							<tr>
								<th>Viewing of Reports</th>
								<td><input type="radio" name="maxtime">Yes <input type="radio" name="maxtime">No</td>
							</tr>
						</table>
					</div>
			</div>
		</div>
		

	
@stop

