<?php

class WebServiceController extends BaseController {


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
				'password' => Input::get('password'), 
				'isAdmin' => 1
			), $remember);
			
			if($auth){
				$user = User::where('username', Input::get('username'))->first();
				Auth::loginUsingId($user->user_id);
				return Redirect::route('report-home');
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
			return Redirect::route('user-home')->withErrors($validate)->withInput();
		}else{
			$id = Auth::id(); //get session id of user
			$old_pass = Input::get('old_password'); //old password input from form
			$user = User::find($id); //query database for info of the current user
			
			$check = Hash::check($old_pass, $user->password); //compare input password from database
			
			
			if($check == true)
			{
				
				$user->password = Hash::make(Input::get('password'));
				
				
				
				if($user->save()){
					return Redirect::route('user-home')->with('success','Password successfully changed.');
				}else{
					return Redirect::route('user-home')->with('fail','Something is Wrong with the server. Try Again');
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
	
}
