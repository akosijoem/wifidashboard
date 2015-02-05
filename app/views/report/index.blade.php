@extends('layouts.master')

@section('head')
	@parent
	<link href="{{ URL::to('/') }}/css/jquery.bootgrid.css" rel="stylesheet" />
	<title>Dashboard: Reports</title>
@stop

@section('content')
<div class="topview hidden-print">
	<h1 class="page-header">Report Generation</h1>
	<form class="form-horizontal" id="reportForm" role="form" method="post">
		<div class="form-group">
			<label for="report_type" class="col-sm-3 control-label">Report Type</label>
			<div class="col-sm-5">
				<select class="form-control" id="report_type" name="report_type">
					<option value="newusers">New User Statistics</option>
					<option value="returning">Returning User Statistics</option>
					<option value="demograph">Demographics Report</option>
					<option value="mobtel" disabled>Mobtel Acquisition Report</option>
					<option value="lemcon" disabled>Internet Usage Report</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="location" class="col-sm-3 control-label">Location</label>
			<div class="col-sm-5">
				<select class="form-control" id="location" name="location">
					@foreach($locations as $loc)
						<option value="{{ $loc->location_id }}">{{ $loc->name }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="date_range" class="col-sm-3 control-label">Date Range</label>
			<div class="col-sm-5">
				<select class="form-control" id="date_range" name="date_range">
					<option value="hour">Hourly</option>
					<option value="day">Daily</option>
					<option value="month">Monthly</option>
					<option value="year">Yearly</option>
				</select>
			</div>
		</div>
		<div class="form-group" id="selDate_hour">
			<label for="date_hour" class="col-sm-3 control-label">Date Time</label>
			<div class="col-sm-5">
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
			<div class="col-sm-5">
				<div class="input-group">
				<input type="text" class="form-control" id="date_day" name="date_day">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button" id="img_cal_day" ><span class="glyphicon glyphicon-calendar"></span></button>
				</span>
				</div>
			</div>
		</div>
		<div class="form-group" id="selDate_month">
			<label for="date_month" class="col-sm-3 control-label">Month</label>
			<div class="col-sm-3">
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
			<div class="col-sm-8">
				<div class="pull-right">
					
					<input type="button" id="export_btn" class="btn btn-danger" disabled value="Export"/>
					<input type="button" id="view_btn" class="btn btn-primary" value="Generate"/>
					<button type="button" id="clear_btn" class="btn btn-default hide">Clear</button>
				</div>
			</div>
		</div>
</div>	
	<div id="resultbox"></div>

@stop

@section('javascript')
	@parent
	<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/jquery.datetimepicker.css"/>
	<script src="{{ URL::to('/') }}/js/jquery.datetimepicker.js"></script>
	<script src="{{ URL::to('/') }}/js/jquery.bootgrid.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#report_type, #location, #date_range,#selDate_hour, #selDate_day, #selDate_month, #selDate_year").change(function(){
				$('#export_btn').prop( "disabled", "disabled" );
			});
			$('#view_btn').click(function()
			{
				var report = $("#report_type").val();
				/*$('#export_btn').removeAttr('disabled');*/
				$("#resultbox").html("");
				$(this).val("Loading...").removeClass("btn-primary").addClass("btn-danger");
				$("#resultbox").load("{{ URL::to('/') }}/report/"+report,$("#reportForm").serialize(),function(){
					$('#export_btn').removeAttr('disabled');
					$('#view_btn').val("Generate").removeClass("btn-danger").addClass("btn-primary");
				});
			});
			$('#export_btn').click(function(){
				window.print();
			});
			
			$('#clear_btn').click(function(){
				 location.reload(true);
			});
			
			$("#selDate_hour, #selDate_day, #selDate_month, #selDate_year").hide();
			$("#selDate_" + $("#date_range").val()).show();//$("#selDate_hour").show();
		
			$("#date_range").change(function(){
				var divmode = $("#date_range").val();
				hideSelDate();
				//alert("#selDate_"+divmode);
				$("#selDate_" + divmode).show();
				if(divmode == "month"){
					$("#selDate_year").show();
				}
			});
			
			
			// DATE TIME SETUP
			var hideSelDate = function(){
				$("#selDate_hour").hide();
				$("#selDate_day").hide();
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
			
		});
	</script>
@stop