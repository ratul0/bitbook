@extends('layouts.guest')

@section('content')
	<body class="login-body">
    	<div class="container">
    		{{ Form::open(['route' => ['password.reset', $tokenData->token], 'class' => 'form-signin']) }}
	        	<h2 class="form-signin-heading">Reset Password</h2>
	        
		        <div class="login-wrap">
					
					@include('includes.alert')

					{{ Form::hidden('email', $tokenData->email) }}
 
 					{{ Form::password('new_password', ['class' => 'form-control', 'placeholder' => 'New Password']) }}
		        	{{ Form::error($errors, 'new_password') }}

		        	{{ Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm New Password']) }}
		        	{{ Form::error($errors, 'new_password_confirmation') }}

					{{ Form::submit('Reset Password', ['class' => 'btn btn-lg btn-login btn-block']) }}
				</div>
			{{ Form::close() }}
		</div>
	</body>
    
@stop