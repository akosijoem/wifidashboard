<?php

class LocationController extends BaseController {


	public function index()
	{
		return View::make('location.index');
	}
	
	
	
	
	public function addLoc()
	{
		$location = Location::all();
		$roles = UserRole::all();
		
		return View::make('location.addlocation')->with('location', $location)->with('roles', $roles);
	}
	
	
	public function addLocPost()
	{
		
		$validate = Validator::make(Input::all(), array(		
			'name' => 'required|unique:locations',
			'ssid' => 'required|unique:locations',
			'is_active' => 'required'
		));
		
		if($validate->fails()){
			return Redirect::route('addLoc')->withErrors($validate)->withInput();
		}
		else
		{
			$location = new Location();
			$location->name = Input::get('name');				
			$location->ssid = Input::get('ssid');				
			$location->is_active = Input::get('is_active');
			
			
			if($location->save())
			{
				/* Mail::send('user.emailpass', array('name'=>Input::get('username')), function($message){
					$message->to(Input::get('email'), Input::get('username').' '.Input::get('password'))->subject('Welcome to Yondu Wifi!');
				}); */
				return Redirect::route('addLoc')->with('success','Successfully Added.');
			}
			else
			{
				return Redirect::route('addLoc')->with('fail','Error occured. Please try again later.');
			}
		}
		
	}
	
	
	public function listLoc()
	{
		$location = Location::all();
		return View::make('location.listlocation')->with('location', $location);
	}
	
	
	
}
