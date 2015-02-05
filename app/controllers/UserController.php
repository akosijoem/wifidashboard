<?php

class UserController extends BaseController {


	public function index()
	{
		return View::make('user.index');
	}
	
	
	
	//get the view for the register page
	public function getCreate()
	{
		return View::make('user.register');
	}

	//get the view for the login page
	public function getLogin()
	{
		if (Auth::check())
		{
		   return Redirect::route('report-home');
		}else{
			return View::make('user.login');
		}
	}
	
	//handles register form data
	public function postCreate()
	{
		/* $validate = Validator::make(Input::all(), array(
			'username' => 'required|unique:users|min:6',
			'password' => 'required|min:6',
			'confirm' => 'required|same:password'
		));
		
		if($validate->fails()){
			return Redirect::route('getCreate')->withErrors($validate)->withInput();
		}else{
			
			$user = new User();
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			
			if($user->save()){
				return Redirect::route('home')->with('success','Successfully registered.');
			}else{
				return Redirect::route('home')->with('fail','Error occured. Please try again later.');
			}
		} */
		
	}
	
	//handles login form data
	public function postLogin()
	{
			
		$validate = Validator::make(Input::all(), array(
			'username' => 'required',
			'password' => 'required',
		));
		
		if($validate->fails()){
			return Redirect::route('getLogin')->withErrors($validate)->withInput();
		}else{
			$remember = (Input::has('remember')) ? true : false;
			
			$auth = Auth::attempt(array(
				'username' => Input::get('username'),
				'password' => Input::get('password')
				//'isAdmin' => 1
			), $remember);
			
			if($auth){
				$user = User::where('username', Input::get('username'))->first();
				Auth::loginUsingId($user->user_id);
				
			
				if($user->isFirst == 1)
				{
					return Redirect::route('changePass');
				}
				else
				{
					return Redirect::route('report-home');
				}
				die();
			}else{
				return Redirect::route('getLogin')->with('fail','Invalid Access.');
			}
		}
	}
	
	
	public function postChangePass()
	{
		
		$validate = Validator::make(Input::all(), array(
			'old_password' => 'required|min:6',
			'password' => 'required|min:6',
			'confirm' => 'required|same:password'
		));
		
		if($validate->fails()){
			return Redirect::route('changePass')->withErrors($validate)->withInput();
		}else{
			$id = Auth::id(); //get session id of user
			$old_pass = Input::get('old_password'); //old password input from form
			$user = User::find($id); //query database for info of the current user
			
			$check = Hash::check($old_pass, $user->password); //compare input password from database
			
			
			if($check == true)
			{
				
				$user->password = Hash::make(Input::get('password'));
				$user->isFirst = 0;
				
				
				
				if($user->save()){
					return Redirect::route('changePass')->with('success','Password successfully changed.');
				}else{
					return Redirect::route('changePass')->with('fail','Something is Wrong with the server. Try Again');
				} 
				
				
			}
			else{
				return Redirect::route('user-home')->with('fail','Old Password does not match. Try Again');
			}
			
		}
		
	}
	
	public function getLogout()
	{
		Auth::logout();
		return Redirect::intended('/');
	}
	
	
	public function changePass()
	{
		return View::make('user.changepass');
	}
	
	public function userList()
	{
		$user = User::all();
		
	
		return View::make('user.userlist')->with('users', $user);
	}
	
	public function searchLocation()
	{
		$location = Location::where('is_active', 1)->get();
		
			
		//$roles = UserRole::where('location_id', $loc_id)->where('is_active', 1)->get();
		
		return View::make('user.adduser')->with('location', $location)->with('roles', $location);
		
	}	
	
	
	public function addUser()
	{
		
		
		$location = Location::all();
		
		//$roles = UserRole::where('location_id', Input::get('location'))->get();
		
		$roles = UserRole::all();
		
		//return View::make('user.adduserlist')->with('roles', $roles);
		return View::make('user.adduserlist')->with('location', $location)->with('roles', $roles);
	 
	}

	public function addUserPost()
	{
		$validate = Validator::make(Input::all(), array(
			'role' => 'required',			
			'email' => 'required|email|unique:users',
			'username' => 'required',
			//'fname' => 'required',
			//'lname' => 'required',
			//'password' => 'required|min:6',
			//'confirm' => 'required|same:password'
		));
		
		if($validate->fails()){
			return Redirect::route('addUser')->withErrors($validate)->withInput();
		}
		else
		{		
			$randompass = substr(md5(time()), 1, 6);
			
			$user = new User();
			$user->email = Input::get('email');
			$user->username = Input::get('username');
			
			$user->password =  Hash::make($randompass);;
			$user->isAdmin = 1;
			$user->role = Input::get('role');
			
			if($user->save())
			{
				Mail::send('user.emailpass', array('name'=>Input::get('username'), 'password'=>$randompass), function($message){
					$message->to(Input::get('email'), Input::get('username').' '.Input::get('password'))->subject('Welcome to Yondu Wifi!');
				}); 
				return Redirect::route('searchLocation')->with('success','Successfully Added.');
			}
			else
			{
				return Redirect::route('searchLocation')->with('fail','Error occured. Please try again later.');
			}
		}
		
	}
	
	
	public function addRole()
	{
		$location = Location::all();
		$roles = UserRole::all();
		
		return View::make('user.addrole')->with('location', $location)->with('roles', $roles);
	}
	
	public function addRolePost()
	{
		
		$validate = Validator::make(Input::all(), array(
			'location' => 'required',			
			'role_name' => 'required|unique:user_role',
			'is_active' => 'required'
		));
		
		if($validate->fails()){
			return Redirect::route('addRole')->withErrors($validate)->withInput();
		}
		else
		{
			$role = new UserRole();
			$role->location_id = Input::get('location');
			$role->role_name = Input::get('role_name');
			$role->is_active = Input::get('is_active');
			
			
			
			
			
			if($role->save())
			{
				/* Mail::send('user.emailpass', array('name'=>Input::get('username')), function($message){
					$message->to(Input::get('email'), Input::get('username').' '.Input::get('password'))->subject('Welcome to Yondu Wifi!');
				}); */
				return Redirect::route('addRole')->with('success','Successfully Added.');
			
			}
			else
			{
				return Redirect::route('addRole')->with('fail','Error occured. Please try again later.');
			}
		}
		
	}
	
	public function addLoc()
	{
		$location = Location::all();
		$roles = UserRole::all();
		
		return View::make('user.addlocation')->with('location', $location)->with('roles', $roles);
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
	
	public function userSettings()
	{
	
		$roles = UserRole::all();
		
		return View::make('user.usersettings')->with('roles', $roles);
	}
	
	
	
	
}
