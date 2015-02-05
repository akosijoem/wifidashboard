@extends('layouts.master')

@section('head')
	@parent
	<title>Dashboard: Reports</title>
@stop

@section('content')
	<h1 class="page-header">Reports</h1>
	<form class="form-horizontal" id="reportForm" role="form" method="post">
		<div class="form-group">
			<label for="location" class="col-sm-3 control-label">Location</label>
			<div class="col-sm-4">
				<select readonly class="form-control" id="location" name="location">
					<option value="Glorietta">Glorietta</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="date_range" class="col-sm-3 control-label">Date Range</label>
			<div class="col-sm-8 form-inline">
				<div class="input-group col-sm-2">
					<span class="input-group-addon">
						<input type="radio" name="date_range" value="hour" >
					</span>
					<label class="form-control">Hourly</label>
				</div>
				<div class="input-group col-sm-2">
					<span class="input-group-addon">
						<input type="radio" name="date_range" value="day" >
					</span>
					<label class="form-control">Daily</label>
				</div>
				<div class="input-group col-sm-2 hidden">
					<span class="input-group-addon">
						<input disabled type="radio" name="date_range" value="week" >
					</span>
					<label class="form-control">Weekly</label>
				</div>
				<div class="input-group col-sm-2">
					<span class="input-group-addon">
						<input type="radio" name="date_range" value="month" >
					</span>
					<label class="form-control">Monthly</label>
				</div>
				<div class="input-group col-sm-2">
					<span class="input-group-addon">
						<input type="radio" name="date_range" value="year" >
					</span>
					<label class="form-control">Annual</label>
				</div>
				
			</div>
		</div>
		<div class="form-group" id="selDate_hour">
			<label for="date_hour" class="col-sm-3 control-label">Date Time</label>
			<div class="col-sm-3">
				<div class="input-group">
				<input type="text" class="form-control" id="date_hour" name="date_hour">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="img_cal_hour" ><span class="glyphicon glyphicon-calendar"></span></button>
				</span>
				</div>
			</div>
		</div>
		<div class="form-group" id="selDate_day">
			<label for="date_day" class="col-sm-3 control-label">Date</label>
			<div class="col-sm-3">
				<div class="input-group">
				<input type="text" class="form-control" id="date_day" name="date_day">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="img_cal_day" ><span class="glyphicon glyphicon-calendar"></span></button>
				</span>
				</div>
			</div>
		</div>
		<div class="form-group" id="selDate_week">
			<label for="date_day" class="col-sm-3 control-label">Date Range</label>
			<div class="form-inline col-sm-8">
				<div class="input-group">
				<span class="input-group-addon">from</span>
				<input type="text" class="form-control" id="date_week_from" name="date_week_from">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="img_cal_week_from" ><span class="glyphicon glyphicon-calendar"></span></button>
				</span>
				</div>
				<div class="input-group">
				<span class="input-group-addon">to</span>
				<input type="text" class="form-control" id="date_week_to" name="date_week_to">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="img_cal_week_to" ><span class="glyphicon glyphicon-calendar"></span></button>
				</span>
				</div>
			</div>
		</div>
		<div class="form-group" id="selDate_month">
			<label for="date_month" class="col-sm-3 control-label">Month</label>
			<div class="col-sm-2">
				<select class="form-control" id="date_month" name="date_month">
					<option value="0">--Select Month--</option>
					@for ($i = 1; $i<= 12; $i++)
						<option value="{{ date('m', mktime(0, 0, 0, $i, 10)) }}">{{ date('F', mktime(0, 0, 0, $i, 10)) }}</option>
					@endfor
				</select>
			</div>
			
		</div>
		<div class="form-group" id="selDate_year">
			<label for="date_year" class="col-sm-3 control-label">Year</label>
			<div class="col-sm-2">
				<select class="form-control" id="date_year" name="date_year">
					@for ($y = date('Y'); $y>= 2014; --$y)
						<option value="{{ $y }}">{{ $y }}</option>
					@endfor
				</select>
			</div>
			
		</div>
	</form>	
		
		<div class="form-group clearfix">
			<div class="col-sm-9">
				<div class="pull-right">
					
					<input type="button" id="view_btn" class="btn btn-primary" value="View"/>
					<button type="button" id="clear_btn" class="btn btn-default">Clear</button>
				</div>
			</div>
		</div>
	
	<div id="resultbox"></div>
	<div id="editor"></div>
	<div class="modal fade" id="mobtel" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">&nbsp;
				<div class="pull-right" >
					<button type="button" class="btn btn-danger" id="exportMobile_btn">Export</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
				</div>
				<div class="modal-body" id="mobtel-body" style="background-color:#FFF;padding:15px;">
					<h4 class="modal-title" id="mobtel-title"></h4>
					<table class="table table-bordered">
					<thead>
					<tr>
						<th class="text-center">ID</th>
						<th class="text-center">Mobile #</th>
						<th class="text-center">Date Time</th>
					</tr>
					</thead>
					<tbody id="mobtel-tbody">
					</tbody>
					</table>
				</div>
				<div class="modal-footer">
				</div>
			</div>
		</div>
	</div>

@stop

@section('javascript')
	@parent
	<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/jquery.datetimepicker.css"/>
	<script src="{{ URL::to('/') }}/js/jquery.datetimepicker.js"></script>
	<script src="{{ URL::to('/') }}/js/jspdf.min.js"></script>
	<script src="{{ URL::to('/') }}/js/html2canvas.js"></script>
	<script src="{{ URL::to('/') }}/js/jspdf.plugin.addhtml.js"></script>
	<script>
		$(document).ready(function(){
			
			$('#view_btn').click(function()
			{
				$("#resultbox").html("");
				$(this).val("Loading...").removeClass("btn-primary").addClass("btn-danger");
				$("#resultbox").load("{{ URL::to('/') }}/report/results",$("#reportForm").serialize(),function(){
					$('#view_btn').val("View").removeClass("btn-danger").addClass("btn-primary");
				});
			});
			
			$('#clear_btn').click(function(){
				 location.reload(true);
			});
			
			$("#selDate_day, #selDate_week, #selDate_month, #selDate_year").hide();
			$("input[type='radio'][name='date_range'][value='hour']").prop("checked", true);
			$("#selDate_hour").show();
		
			$("input[type='radio'][name='date_range']").change(function(){
				var divmode = $("input[type='radio'][name='date_range']:checked").val();
				hideSelDate();
				//alert("#selDate_"+divmode);
				$("#selDate_" + divmode).show();
				if(divmode == "month"){
					$("#selDate_year").show();
				}
			});
			
			/*var getWeek = function(day){
				var from = new Date(day);
				var to = new Date(day);
				//$("#date_week_to").val(to.setDate(day.getDate()+7));
			};*/
			
			// DATE TIME SETUP
			var hideSelDate = function(){
				$("#selDate_hour").hide();
				$("#selDate_day").hide();
				$("#selDate_week").hide();
				$("#selDate_month").hide();
				$("#selDate_year").hide();
			};
			
			$('#date_hour').datetimepicker({ format:'Y-m-d H:i'});
			$('#img_cal_hour').click(function(){
				$('#date_hour').datetimepicker('show');
			});
			$('#date_day').datetimepicker({
				timepicker:false,
				format:'Y-m-d'
			});
			$('#img_cal_day').click(function(){
				$('#date_day').datetimepicker('show');
			});
			
			$('#date_week_from').datetimepicker({
				timepicker:false,
				format:'Y-m-d',
				//onChangeDateTime:getWeek
			});
			$('#img_cal_week_from').click(function(){
				$('#date_week_from').datetimepicker('show');
			});
			$('#date_week_to').datetimepicker({
				timepicker:false,
				format:'Y-m-d'
			});
			$('#img_cal_week_to').click(function(){
				$('#date_week_to').datetimepicker('show');
			});
			
			//** PDF GENERATOR **//
			/*$(document).on(	'click','#export_btn',function () {
				var doc = new jsPDF();
				var specialElementHandlers = {
					'#editor': function (element, renderer) {
						return true;
					}
				};
			
				var filename = $('#reportbox').attr('title');
				var mode = $('#reportbox').attr('name');
				if(mode != 'hour'){
					$("#tableheader").html('<tr><th class="text-center">Time</th><th class="text-center">New Users<br/>Attempts</th><th class="text-center">New Users<br/>Successful</th><th class="text-center">Returning Users<br/>Attempts</th><th class="text-center">Returning Users<br/>Successful</th><th class="text-center">SMS<br/>Request</th><th class="text-center">SMS<br/>Replied</th><th class="text-center">SMS<br/>Successful</th><th class="text-center">Total succesful<br/><small>(new &amp; return)</small></th></tr>');
				}
				doc.fromHTML($('#reportbox').html(), 10, 10, {
					'width': 500,
						'elementHandlers': specialElementHandlers
				});
				doc.save(filename+'.pdf');
			});*/
			$(document).on(	'click','#export_btn',function () {
				var filename = $('#reportheader').attr('name');
				var pdf = new jsPDF('p','pt','legal');

				pdf.addHTML(document.getElementById("reportbox"),function() {
					pdf.save(filename+'.pdf');
				});
				
			}); 
			$(document).on(	'click','#exportMobile_btn',function () {
				var filename = $('#mobtel').attr('name');
				var pdf = new jsPDF('p','pt','legal');

				pdf.addHTML(document.getElementById("mobtel-body"),function() {
					pdf.save(filename+'.pdf');
				});
				
			}); 
			
			$(document).on(	'click','.smsList',function(){
				var name = $(this).attr('name').split("_");
				var title = name[0];
				var tag = name[0].substring(0, 3);;
				var time = name[1];
				var date_title = name[2];
				$('#mobtel-tbody').html("");
				$.post( "{{ URL::to('/') }}/report/smsresults", 
					{date: time,tag: tag},
					function( data ) {
						var result = JSON.parse(data);
						if(result.status=='ok'){
							$('#mobtel-title').html("SMS "+title+": "+date_title);
							//$('#mobtel').attr('name', "SMS "+title+": "+date_title);
							$('#mobtel').attr('name', "smsreport");
							$.each(result.data, function( key, value ) {
								$( "#mobtel-tbody" ).append( "<tr><td>"+value.ID+"</td><td>"+value.Mobile_Num+"</td><td>"+value.DateTime+"</td></tr>" );
							});
							$("#mobtel").modal('show');
						}else{
							return false;
						}
				});
			}); 
		});
	</script>
@stop