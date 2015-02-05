<?php

class ReportController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		$locations = Location::all();
		return View::make('report.index')->with("locations",$locations);
	}
	
	public function getNewUsersReport(){
		 $validator = Validator::make(Input::all(), array(
			'location' => 'required',
			'date_range' => 'required', //hour, day, week, month, year
		));
		
		$report = Input::get('report_type');
		$loc_id = Input::get('location');
		$range = Input::get('date_range');
		
		$date_hour = Input::get('date_hour');
		$hour = explode(":", $date_hour);
		$day = Input::get('date_day');
		$week_start = Input::get('date_week_from');
		$week_end = Input::get('date_week_to');
		$month = Input::get('date_year')."-".Input::get('date_month');
		$year = Input::get('date_year');
		
		$data = array();
		if($validator->fails()){
			return Redirect::route('report-home')->with('fail','Error Occurred.');
		}else{
			$location = Location::find($loc_id);
			if($range=="hour"){
				$data['subheader'] = "New Users: ".date("d F Y H:00 - H:59", strtotime($date_hour)).' ('.$location->name.')';
				$data['rows'] = ProfileFB::getNewUser($hour[0],$loc_id);
			}else if($range=="day"){
				$data['subheader'] = "New Users: ".date("d F Y", strtotime($day)).' ('.$location->name.')';
				$data['rows'] = ProfileFB::getNewUser($day,$loc_id);
			}else if($range=="month"){
				$data['subheader'] = "New Users: ".date("F Y", strtotime($month."-1")).' ('.$location->name.')';
				$data['rows'] = ProfileFB::getNewUser($month,$loc_id);
			}else if($range=="year"){
				$data['subheader'] = "New Users: ".$year.' ('.$location->name.')';
				$data['rows'] = ProfileFB::getNewUser($year,$loc_id);
			}
			
			return View::make('report.newuser')->with("data",$data);
		
		}
	}
	
	public function getReturningReport(){
		 $validator = Validator::make(Input::all(), array(
			'location' => 'required',
			'date_range' => 'required', //hour, day, week, month, year
		));
		
		$report = Input::get('report_type');
		$loc_id = Input::get('location');
		$range = Input::get('date_range');
		
		$date_hour = Input::get('date_hour');
		$hour = explode(":", $date_hour);
		$day = Input::get('date_day');
		$week_start = Input::get('date_week_from');
		$week_end = Input::get('date_week_to');
		$month = Input::get('date_year')."-".Input::get('date_month');
		$year = Input::get('date_year');
		
		$data = array();
		if($validator->fails()){
			return Redirect::route('report-home')->with('fail','Error Occurred.');
		}else{
			$location = Location::find($loc_id);
			if($range=="hour"){
				$data['subheader'] = "Returning Users: ".date("d F Y H:00 - H:59", strtotime($date_hour)).' ('.$location->name.')';
				$data['rows'] = ReturningUser::getReturningUser($hour[0],$loc_id);
			}else if($range=="day"){
				$data['subheader'] = "Returning Users: ".date("d F Y", strtotime($day)).' ('.$location->name.')';
				$data['rows'] = ReturningUser::getReturningUser($day,$loc_id);
			}else if($range=="month"){
				$data['subheader'] = "Returning Users: ".date("F Y", strtotime($month."-1")).' ('.$location->name.')';
				$data['rows'] = ReturningUser::getReturningUser($month,$loc_id);
			}else if($range=="year"){
				$data['subheader'] = "Returning Users: ".$year.' ('.$location->name.')';
				$data['rows'] = ReturningUser::getReturningUser($year,$loc_id);
			}
			
			return View::make('report.newuser')->with("data",$data);
		
		}
	}
	
	public function getDemographic(){
		 $validator = Validator::make(Input::all(), array(
			'location' => 'required',
			'date_range' => 'required', //hour, day, week, month, year
		));
		
		$report = Input::get('report_type');
		$loc_id = Input::get('location');
		$range = Input::get('date_range');
		
		$date_hour = Input::get('date_hour');
		$hour = explode(":", $date_hour);
		$day = Input::get('date_day');
		$week_start = Input::get('date_week_from');
		$week_end = Input::get('date_week_to');
		$month = Input::get('date_year')."-".Input::get('date_month');
		$year = Input::get('date_year');
		
		$data = array();
		if($validator->fails()){
			return Redirect::route('report-home')->with('fail','Error Occurred.');
		}else{
			$location = Location::find($loc_id);
			if($range=="hour"){
				$data['subheader'] = "New Users: ".date("d F Y H:00 - H:59", strtotime($date_hour)).' ('.$location->name.')';
				$data['rows'] = ProfileFB::getNewUser($hour[0],$loc_id);
			}else if($range=="day"){
				$data['subheader'] = "New Users: ".date("d F Y", strtotime($day)).' ('.$location->name.')';
				$data['rows'] = ProfileFB::getNewUser($day,$loc_id);
			}else if($range=="month"){
				$data['subheader'] = "New Users: ".date("F Y", strtotime($month."-1")).' ('.$location->name.')';
				$data['rows'] = ProfileFB::getNewUser($month,$loc_id);
			}else if($range=="year"){
				$data['subheader'] = "New Users: ".$year.' ('.$location->name.')';
				$data['rows'] = ProfileFB::getNewUser($year,$loc_id);
			}
			
			return View::make('report.demograph')->with("data",$data);
		
		}
	}
	
	public function getSMSResults()
	{
		$date = Input::get('date');
		$tag = Input::get('tag');
		$results = FBConnectUser::getSMS($date, $tag);
		if($results == null){
			return json_encode(array('status'=>'none'));
		}else{
			return json_encode(array('status'=>'ok','data'=>$results));
		}
	}
	
	public function getReports()
	{
		 set_time_limit(60);
		//return View::make('report.report');
		 $validator = Validator::make(Input::all(), array(
			'report_type' => 'required',
			'location' => 'required',
			'date_range' => 'required', //hour, day, week, month, year
			/*'date_hour' => 'required',
			'date_day' => 'required',
			'date_week_from' => 'required',
			'date_week_to' => 'required',
			'date_month' => 'required',
			'date_year' => 'required',*/
		));
		
		$report = Input::get('report_type');
		$location = Input::get('location');
		$range = Input::get('date_range');
		
		$date_hour = Input::get('date_hour');
		$hour = explode(":", $date_hour);
		$day = Input::get('date_day');
		$week_start = Input::get('date_week_from');
		$week_end = Input::get('date_week_to');
		$month = Input::get('date_year')."-".Input::get('date_month');
		$year = Input::get('date_year');
		
		$data = array();
		if($validator->fails()){
			echo "Error occured";
		}else{
			if($range=="hour"){
				$data['day'] = $date_hour;
				$data['rows'] = FBConnectUser::getFBUserData($hour[0]);
				$data['rows2'] = FBConnectUser::getReturning($hour[0]);
				//$data['rows'] = FBConnectUser::getReturning($hour[0]);
				$data['summary'] = FBConnectUser::summary($hour[0]);
				return View::make('report.userreport')->with("data",$data)->with("location",$location);
			}else if($range=="day"){
				$data['day'] = $day;
				$data['summary'] = FBConnectUser::summary($day);
				$data['total'] = 0;
				for($x = 0; $x<=24; $x++){
					$y = ($x<=9) ? "0".$x : $x;
					$data['rows'][$x] = FBConnectUser::summary($day." ".$y);
					$data['total'] += $data['rows'][$x]['succesful'];
				}
				return View::make('report.dailyreport')->with("data",$data)->with("location",$location);
			}else if($range=="week"){
				$data['rows'] = FBConnectUser::getWeekly($week_start, $week_end);
				$data['summary'] = array();
			}else if($range=="month"){
				$data['day'] = $month;
				$data['summary'] = FBConnectUser::summary($month);
				$data['total'] = 0;
				$last_day = date("t", strtotime($month."-1"));
				for($x = 1; $x<=$last_day; $x++){
					$y = ($x<=9) ? "0".$x : $x;
					$data['rows'][$x] = FBConnectUser::summary($month."-".$y);
					$data['total'] += $data['rows'][$x]['succesful'];
				}
				return View::make('report.monthlyreport')->with("data",$data)->with('last_day',$last_day)->with("location",$location);
			}else if($range=="year"){
				$data['summary'] = FBConnectUser::summary($year);
				$data['total'] = 0;
				for($x = 1; $x<=12; $x++){
					$y = ($x<=9) ? "0".$x : $x;
					$data['rows'][$x] = FBConnectUser::summary($year."-".$y);
					$data['total'] += $data['rows'][$x]['succesful'];
				}
				return View::make('report.yearreport')->with("data",$data)->with('year',$year)->with("location",$location);
			}
		} 
	}
}
