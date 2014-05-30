<?php

class UserController extends BaseController {

	/**
	 * shows login page
	 * @return void
	 */
	public function login()
	{
		return View::make('user.login')
							->with('title', 'Login');
	}

	/**
	 * process to login a user
	 * @return void
	 */
	public function doLogin()
	{
		$rules = array
		(
	    	'email' 	=> 'required|email',
	    	'password' 	=> 'required'
		);
		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('login')
								->withInput()
								->withErrors($validation);
		else
		{
			$credentials = array
			(
				'email'		=>	Input::get('email'),
				'password'	=>	Input::get('password')
			);

			if(Auth::attempt($credentials))
			{
				Session::put('role', Auth::user()->role_id);
			    return Redirect::intended('/');
			}
			else
				return Redirect::route('login')
									->withInput()
									->with('error', 'Error in Email Address or Password.');
		}
	}

	/**
	 * logout a user
	 * @return void
	 */
	function logout()
	{
		Session::forget('role');
		Auth::logout();

		return Redirect::route('login')
						->with('success', 'You have been logged out.');
	}

	/**
	 * shows forgot password page
	 * @return void
	 */
	public function forgotPassword()
	{
		return View::make('user.forgotPassword')
							->with('title', 'Forgot Password');
	}

	/**
	 * save and send password reset link
	 * @return void
	 */
	public function savePasswordToken()
	{
		$rules = array
		(
	    	'email' 	=> 'required|email'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('password.forgot')
								->withInput()
								->withErrors($validation);
		else
		{
			if(User::where('email', '=', Input::get('email'))->first())
			{
				$credentials = array('email' => Input::get('email'));
		 
		  		$isEmailSent = Password::remind($credentials, function($message) {
								$message->subject('Reset Password'); 
							});

		  		if($isEmailSent)
		  			return Redirect::route('login')
								->with('success', 'A email has been sent to the email address containing a reset password link.');
				else
					return Redirect::route('password.forgot')
										->withInput()
										->with('error', 'Password could not be reset. Try again.');
			}
			else
			{
				return Redirect::route('password.forgot')
									->withInput()
									->with('error', 'No Account found with this email address.');
			}
		}
	}

	/**
	 * shows reset password page
	 * @param  string $token
	 * @return void
	 */
	public function resetPassword($token)
	{
		if($tokenData = DB::table('password_reminders')->where('token', '=', $token)->first())
		{
			return View::make('user.resetPassword')
							->with('title', 'Reset Password')
							->with('tokenData', $tokenData);
		}
		else
		{
			return Redirect::route('login')
						->with('error', 'Sorry, Token does not match.');
		}
	}

	/**
	 * reset password of a user
	 * @param  string $token
	 * @return void
	 */
	public function doResetPassword($token)
	{
		$rules = array
		(
	    	'new_password' 				=> 'required|confirmed',
	    	'new_password_confirmation' => 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
		{
			return Redirect::route('password.reset', array('token' => $token))
								->withInput()
								->withErrors($validation);
		}
		else
		{
			$user = User::where('email', '=', Input::get('email'))->first();
			$user->password = Hash::make(Input::get('new_password'));
			$user->save();

			DB::table('password_reminders')->where('token', '=', $token)->delete();

			return Redirect::route('login')
									->with('success', 'Your password has been reset. Login with the new password.');
		}
	}

	public function register()
	{
		return View::make('user.register')
							->with('title', 'Register');
	}


	public function doRegister()
	{
		$rules = array
		(
			'full_name'				=> 'required',
			'email' 				=> 'required|email|unique:users,email',
	    	'password' 				=> 'required|confirmed',
	    	'password_confirmation' => 'required'
		);

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
		{
			return Redirect::route('register')
								->withInput()
								->withErrors($validation);
		}
		else
		{
			$user = new User;
			$user->full_name = Input::get('full_name');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('new_password'));
			$user->save();

			return Redirect::route('login')
								->with('success', 'Congratulations. You have registered successfully.');
		}
	}

	/**
	 * Display a listing of users.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::get();

		return Response::json(array(
				'users' => $users->toArray()
			));
	}

	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created user
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array
		(
	    	'full_name'	=> 'required',
	    	'email' 	=> 'required|email|unique:users,email',
	    	'password' 	=> 'required',
	    	'role_id'	=> 'required'
		);
		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
		{
			return Response::json(array(
					'error'	=>	$validation->messages()->toArray()
				));
		}
		else
		{
			$user = new User();
			$user->full_name = Input::get('full_name');
			$user->nick_name = Input::get('nick_name');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->role_id = Input::get('role_id');
			$user->save();

			return Response::json(array(
					'user' 		=> 	$user->toArray(),
					'success'	=>	'User has been added.'
				));
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id)->toArray();

		return Response::json(array(
			'user' => $user
		));
	}

	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array
		(
			'full_name'	=> 'required',
	    	'email' 	=> 'required|email|unique:users,email,'.$id,
	    	'password' 	=> 'required',
	    	'role_id'	=> 'required'
		);
		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
		{
			return Response::json(array(
					'error'	=>	$validation->messages()->toArray()
				));
		}
		else
		{
			$user = User::find($id);
			$user->full_name = Input::get('full_name');
			$user->nick_name = Input::get('nick_name');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->role_id = Input::get('role_id');
			$user->save();

			return Response::json(array(
					'user' 		=> 	$user->toArray(),
					'success'	=>	'User has been updated.'
				));
		}
	}

	/**
	 * Remove the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::find($id)->delete();

		return Response::json(array(
					'success'	=>	'User has been deleted.'
				));
	}

	/**
	 * shows feed page
	 * @return void
	 */
	public function feed()
	{
		return View::make('user.feed')
							->with('title', 'Feed');
	}
}
