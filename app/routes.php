<?php

Route::group(array('before' => 'guest'), function()
{
	// login
	Route::get('login', array('as' 	=>	'login',
							'uses'	=>	'UserController@login'));
	Route::post('login', array('uses' => 'UserController@doLogin'));

	// register
	Route::get('register', array('as' 	=>	'register',
							'uses'	=>	'UserController@register'));
	Route::post('register', array('uses' => 'UserController@doRegister'));
	
	// password reset
	Route::get('password/forgot', array('as' 	=>	'password.forgot',
										'uses'	=>	'UserController@forgotPassword'));
	Route::post('password/forgot', array('uses'	=>	'UserController@savePasswordToken'));
	Route::get('password/reset/{token}', array('as' =>	'password.reset',
											'uses'	=>	'UserController@resetPassword'));
	Route::post('password/reset/{token}', array('uses' => 'UserController@doResetPassword'));
});

Route::group(array('before' => 'auth'), function()
{
	// News feed
	Route::get('/', array('as' 	=>	'feed',
							'uses'	=>	'UserController@feed'));
	Route::get('logout', array('as' 	=>	'logout',
								'uses'	=>	'UserController@logout'));
});

Route::resource('users', 'userController');
