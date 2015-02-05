<div class="clearfix" style="padding:15px;">
	<div class="pull-right"><button type="button" id="export_btn" class="btn btn-danger btn-lg">Export</button></div>
</div>
<div id="reportbox" name="hour" style="background-color:#FFF;padding:15px;">

<h2 class="sub-header" id="reportheader" name="reporthour_{{date('Ymd-Hi', strtotime($data['day'])) }}">
	<em>{{$location}}</em>: {{date("d F Y H:i", strtotime($data['day'])) }}</h2>
<div class="row">
	<div class="list-group col-md-6">
		<div class="list-group-item"><span class="badge">{{ $data['summary']['newuser_success'] }}</span> Total number of users(success new)</div>
		<div class="list-group-item"><span class="badge">{{ $data['summary']['newuser_attemps'] }}</span> Total number of users(attempts new)</div>
		<div class="list-group-item"><span class="badge">{{ $data['summary']['returning_success'] }}</span> Total number of users(success returning)</div>
		<div class="list-group-item"><span class="badge">{{ $data['summary']['returning_attemps'] }}</span> Total number of users(attempts returning)</div>
		<div class="list-group-item"><span class="badge">{{ $data['summary']['succesful'] }}</span> Total succesful (new &amp; return)</div>
	</div>
	<div class="list-group col-md-6">
		<div class="list-group-item"><span class="badge">{{ $data['summary']['fbtotal'] }}</span> Total FB profiles</div>
		<div class="list-group-item"><span class="badge">{{ $data['summary']['sms_request'] }}</span> Total number of sms(request)</div>
		<div class="list-group-item"><span class="badge">{{ $data['summary']['sms_replied'] }}</span> Total number of sms(replied)</div>
		<div class="list-group-item"><span class="badge">{{ $data['summary']['sms_success'] }}</span> Total number of sms(success)</div>
	</div>
</div>

	<h2 class="sub-header">New Users</h2>
	<div class="table-responsive">
	@if(empty($data['rows']))
	  <h4 class="sub-header">No new user.</h2>
	@else
	<table class="table table-striped">
		<thead>
			<tr>
			<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>Gender</th>
			<th>Date Time</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data['rows'] as $row)
			<tr>
			<td>{{ $row->intID }}</td>
			<td>{{ $row->strCreatedBy }}</td>
			<td>{{ $row->strEmail }}</td>
			<td>{{ $row->gender }}</td>
			<td>{{ $row->dateModifiedDate }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
	</div>

	<h2 class="sub-header">Returning Users</h2>
	<div class="table-responsive">
	@if(empty($data['rows2']))
	  <h4 class="sub-header">No returning user.</h2>
	@else
	<table class="table table-striped">
		<thead>
			<tr>
			<th>#</th>
			<th>Name</th>
			<th>Email</th>
			<th>Gender</th>
			<th>Date Time</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data['rows2'] as $row)
			<tr>
			<td>{{ $row->intID }}</td>
			<td>{{ $row->strCreatedBy }}</td>
			<td>{{ $row->strEmail }}</td>
			<td>{{ $row->gender }}</td>
			<td>{{ $row->dateModifiedDate }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
	</div>
</div>