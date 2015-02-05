<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => '/', 'uses' => 'UserController@getLogin'));

Route::get('/home', array('uses'=>'HomeController@index', 'as' => 'home'));

//LOGIN
Route::group(array('before'=>'guest'), function(){
	Route::get('/user/login',array('uses'=>'UserController@getLogin','as'=>'getLogin'));

	Route::group(array('before'=>'csrf'),function(){
		Route::post('/user/login',array('uses'=>'UserController@postLogin', 'as'=>'postLogin'));
	});
});

//ADMIN ACCESS ONLY	
Route::group(array('before'=>'admin'), function(){
	//USERS
	Route::group(array('prefix' => 'user'), function(){
		Route::get('logout', array('uses'=>'UserController@getLogout', 'as' => 'getLogout'));

		Route::get('/', array('uses'=>'UserController@index', 'as' => 'user-home'));
		Route::get('create',array('uses'=>'UserController@getCreate','as'=>'getCreate'));
		Route::get('changepass',array('uses'=>'UserController@changePass','as'=>'changePass'));
	
		Route::get('userlist',array('uses'=>'UserController@userList','as'=>'userList'));
		
		Route::get('adduser',array('uses'=>'UserController@addUser','as'=>'addUser'));
		Route::get('adduserlist/{id}',array('uses'=>'UserController@addUserList','as'=>'addUserList'));
		Route::get('addrole',array('uses'=>'UserController@addRole','as'=>'addRole'));
		
		Route::get('settings',array('uses'=>'UserController@userSettings','as'=>'userSettings'));
		Route::get('verify/{code}',array('uses'=>'UserController@userSettings','as'=>'userSettings'));
		
		
		
		Route::group(array('before'=>'csrf'),function(){	
		
			Route::post('adduserpost',array('uses'=>'UserController@addUserPost', 'as'=>'addUserPost'));
			Route::post('addrolepost',array('uses'=>'UserController@addRolePost', 'as'=>'addRolePost'));
			Route::post('addlocpost',array('uses'=>'UserController@addLocPost', 'as'=>'addLocPost'));
			Route::post('searchlocation',array('uses'=>'UserController@searchLocation', 'as'=>'searchLocation'));
			Route::post('create',array('uses'=>'UserController@postCreate', 'as'=>'postCreate'));
			Route::post('change_pass',array('uses'=>'UserController@postChangePass', 'as'=>'postChangePass'));
		});
	});
	
	//REPORTS
	Route::group(array('prefix' => 'report'), function(){
		Route::get('/', array('uses'=>'ReportController@index', 'as' => 'report-home'));
		Route::any('results', array('uses'=>'ReportController@getReports', 'as' => 'getReportResults'));
		Route::any('newusers', array('uses'=>'ReportController@getNewUsersReport', 'as' => 'getNewUsersReport'));
		Route::any('returning', array('uses'=>'ReportController@getReturningReport', 'as' => 'getReturningReport'));
		Route::any('demograph', array('uses'=>'ReportController@getDemographic', 'as' => 'getDemographic'));
		Route::any('mobtel', array('uses'=>'ReportController@getMobtel', 'as' => 'getMobtel'));
		Route::any('lemcon', array('uses'=>'ReportController@getLemcon', 'as' => 'getLemcon'));
		Route::post('smsresults', array('uses'=>'ReportController@getSMSResults', 'as' => 'getSMSResults'));
	});
	
	//LOCATION
		Route::group(array('prefix' => 'location'), function(){
		Route::get('/', array('uses'=>'LocationController@index', 'as' => 'loc-home'));
		Route::get('addlocation',array('uses'=>'LocationController@addLoc','as'=>'addLoc'));
		Route::get('listlocation',array('uses'=>'LocationController@listLoc','as'=>'listLoc'));
	});
});

