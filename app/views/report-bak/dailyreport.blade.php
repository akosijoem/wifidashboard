<div class="clearfix" style="padding:15px;">
	<div class="pull-right"><button type="button" id="export_btn" class="btn btn-danger btn-lg">Export</button></div>
</div>
<div id="reportbox" name="day" style="background-color:#FFF;padding:15px;">

<h2 class="sub-header" id="reportheader" name="reportdate_{{date('Ymd', strtotime($data['day'])) }}">
	<em>{{$location}}</em>: {{date("d F Y", strtotime($data['day'])) }}</h2>
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
	<div class="table-responsive">
	@if($data['summary']['succesful'] == 0 && $data['summary']['sms_request'] == 0 && $data['summary']['newuser_attemps'] == 0 && $data['summary']['returning_attemps'] == 0)
	  <h4 class="sub-header">No event for this day.</h2>
	@else
	<table class="table table-bordered">
		<thead id="tableheader">
			<tr>
				<th rowspan="2" class="text-center">Time</th>
				<th colspan="2" class="text-center">New Users</th>
				<th colspan="2" class="text-center">Returning Users</th>
				<th colspan="3" class="text-center">SMS</th>
				<th rowspan="2" class="text-center">Total succesful<br/><small>(new &amp; return)</small></th>
			</tr>
			<tr>
				<th class="text-center">Attempts</th>
				<th class="text-center">Successful</th>
				<th class="text-center">Attempts</th>
				<th class="text-center">Successful</th>
				<th class="text-center">Request</th>
				<th class="text-center">Replied</th>
				<th class="text-center">Successful</th>
			</tr>
			<!--<tr>
				<th class="text-center">Time</th>
				<th class="text-center">New Users<br/>Attempts</th>
				<th class="text-center">New Users<br/>Successful</th>
				<th class="text-center">Returning Users<br/>Attempts</th>
				<th class="text-center">Returning Users<br/>Successful</th>
				<th class="text-center">SMS<br/>Request</th>
				<th class="text-center">SMS<br/>Replied</th>
				<th class="text-center">SMS<br/>Successful</th>
				<th class="text-center">Total succesful<br/><small>(new &amp; return)</small></th>
			</tr>-->
		</thead>
		<tbody>
			@for($x = 0; $x<=24; $x++)
			<tr>
				<td class="hourly text-center bg-info" name="{{($x<=9) ? '0'.$x : $x}}">
					{{ ($x<=9) ? "0".$x : $x }}:00 - {{ ($x<=9) ? "0".$x : $x }}:59</td>
				<td class="text-center">{{ $data['rows'][$x]['newuser_attemps'] }}</td>
				<td class="text-center">{{ $data['rows'][$x]['newuser_success'] }}</td>
				<td class="text-center">{{ $data['rows'][$x]['returning_attemps'] }}</td>
				<td class="text-center">{{ $data['rows'][$x]['returning_success'] }}</td>
				<td class="text-center">
					@if($data['rows'][$x]['sms_request'] > 0)
						<button type="button" class="btn btn-link smsList" name="REQUEST_{{$data['day']}} {{($x<=9) ? '0'.$x : $x}}_{{date('d F Y', strtotime($data['day']))}} {{ ($x<=9) ? '0'.$x : $x }}:00 - {{ ($x<=9) ? '0'.$x : $x }}:59">{{ $data['rows'][$x]['sms_request'] }}</button>
					@else
						{{ $data['rows'][$x]['sms_request'] }}
					@endif
				</td>
				<td class="text-center">
					@if($data['rows'][$x]['sms_replied'] > 0)
						<button type="button" class="btn btn-link smsList" name="REPLIED_{{$data['day']}} {{($x<=9) ? '0'.$x : $x}}_{{date('d F Y', strtotime($data['day']))}} {{ ($x<=9) ? '0'.$x : $x }}:00 - {{ ($x<=9) ? '0'.$x : $x }}:59">{{ $data['rows'][$x]['sms_replied'] }}</button>
					@else
						{{ $data['rows'][$x]['sms_replied'] }}
					@endif
				</td>
				<td class="text-center">
					@if($data['rows'][$x]['sms_success'] > 0)
						<button type="button" class="btn btn-link smsList" name="SUCCESSFUL_{{$data['day']}} {{($x<=9) ? '0'.$x : $x}}_{{date('d F Y', strtotime($data['day']))}} {{ ($x<=9) ? '0'.$x : $x }}:00 - {{ ($x<=9) ? '0'.$x : $x }}:59">{{ $data['rows'][$x]['sms_success'] }}</button>
					@else
						{{ $data['rows'][$x]['sms_success'] }}
					@endif
				</td>
				<td class="text-center">{{ $data['rows'][$x]['succesful'] }}</td>
			</tr>
			@endfor
		</tbody>
		<tfoot>
			<tr>
				<td class="text-right"><em>Total</em></td>
				<td class="text-center"><strong>{{ $data['summary']['newuser_attemps'] }}</strong></td>
				<td class="text-center"><strong>{{ $data['summary']['newuser_success'] }}</strong></td>
				<td class="text-center"><strong>{{ $data['summary']['returning_attemps'] }}</strong></td>
				<td class="text-center"><strong>{{ $data['summary']['returning_success'] }}</strong></td>
				<td class="text-center"><strong>{{ $data['summary']['sms_request'] }}</strong></td>
				<td class="text-center"><strong>{{ $data['summary']['sms_replied'] }}</strong></td>
				<td class="text-center"><strong>{{ $data['summary']['sms_success'] }}</strong></td>
				<td class="text-center"><strong>{{ $data['total'] }}</strong></td>
			</tr>	
		</tfoot>
	</table>
	@endif
	</div>
</div>
	<script>
		$(document).ready(function(){
			
			$('.hourly').click(function(){
				$("#resultbox").html('<h3><span class="label label-danger">Loading...</span></h3>');
				var time = $(this).attr('name');
				$("#resultbox").load("{{ URL::to('/') }}/report/results",{
					'location':$("#location").val(),
					'date_range':'hour',
					'date_hour':'{{$data["day"]}} '+time+':00'
				});
			}).css('cursor','pointer').hover(
				function () {
				   $(this).addClass("bg-primary");
				   $(this).removeClass("bg-info");
				}, 
				 function () {
				   $(this).addClass("bg-info");
				   $(this).removeClass("bg-primary");
				});
				
			
				/* $("#mobtel-body").load("{{ URL::to('/') }}/report/results",{
					'location':$("#location").val(),
					'date':'{{$data["day"]}} '+time+':00',
					'tag': sms
				},function(){
					$("#mobtel-title").html("");
					$("#mobtel").modal('show');
				});*/
			
		
		});
	</script>