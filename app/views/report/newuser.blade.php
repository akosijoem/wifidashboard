<h2 class="sub-header">{{$data['subheader']}}</h2>

	<div class="table-responsive">
	@if(empty($data['rows']))
	  <h4 class="sub-header">No user data yet.</h2>
	@else
	<table class="table table-striped" id="grid" >
		<thead>
			<tr>
			<th data-column-id="name" data-sortable="false">Name</th>
			<th data-column-id="fbid" data-type="numeric" data-sortable="false">Facebook ID</th>
			<th data-column-id="email" data-sortable="false">Email</th>
			<th data-column-id="sex" data-sortable="false">Gender</th>
			<th data-column-id="time" data-sortable="false">Date Time</th>
			<th data-column-id="mac" data-sortable="false">MAC</th>
		</thead>
		<tbody>
			@foreach($data['rows'] as $row)
			<tr>
			<td>{{ $row->name }}</td>
			<td>{{ $row->fb_id }}</td>
			<td>{{ $row->email }}</td>
			<td>{{ $row->gender }}</td>
			<td>{{ $row->created_at }}</td>
			<td>{{ $row->mac }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
	</div>
	
	<script>
		$(document).ready(function(){
			$("#grid").bootgrid();
			$("#grid-header").hide();
		});
	</script>