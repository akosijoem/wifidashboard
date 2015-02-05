<h2 class="sub-header">&nbsp;</h2>

	<div class="table-responsive">
	@if(empty($data['rows']))
	  <h4 class="sub-header">No user data yet.</h2>
	@else
	<table class="table table-striped">
		<thead>
			<tr>
			<th>Name</th>
			<th>Email</th>
			<th class="text-center">Mobile<br/><small>(facebook)</small></th>
			<th class="text-center">Mobile<br/><small>(mobtel)</small></th>
			<th class="text-center">Times Visited</th>
			<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data['rows'] as $row)
			<tr>
				<td>{{ $row->name }}</td>
				<td>{{ $row->email }}</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="text-center">0</td>
				<td><button type="button" class="btn btn-link btn-xs morelink" id="morelink_{{ $row->profile_id }}">[MORE]</button></td>
			</tr>
			<tr class="morebox" id="morebox_{{ $row->profile_id }}">
				<td><img src="{{ $row->picture_url }}" height="75"/></td>
				<td colspan="5">
							{{ $row->gender }}</br>
							&nbsp;</br>
							{{ $row->locale }}</br>
							&nbsp;</br>
							{{ $row->fb_id }}</br>
				</td>					
			</tr>
			@endforeach
		</tbody>
	</table>
	@endif
	</div>
	<script>
		$(document).ready(function(){
			
			$(".morebox").hide();
			
			$(".morelink").click(function(){
				var val = $(this).html();
				var id = $(this).attr('id').split("_");
				id = id[1];
				if(val == "[MORE]"){
					$(".morebox").hide("fast",function(){
						$(".morelink").html("[MORE]");
					});
					$("#morebox_"+id).slideDown("fast",function(){
						$("#morelink_"+id).html("[HIDE]");
					});
				}else{
					$("#morebox_"+id).slideUp("fast",function(){
						$("#morelink_"+id).html("[MORE]");
					});
				}
				
			});
		
			
			
		});
	</script>