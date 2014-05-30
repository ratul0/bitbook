@extends('layouts.guest')

@section('content')
	<body class="login-body">
    	<div class="container">
    		{{ Form::open(['route' => 'password.forgot', 'class' => 'form-signin']) }}
	        	<h2 class="form-signin-heading">Forgot Password</h2>
	        
		        <div class="login-wrap">
					@include('includes.alert')
				
					{{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email Address']) }}
		        	{{ Form::error($errors, 'email') }}


					{{ Form::submit('Reset Password', ['class' => 'btn btn-lg btn-login btn-block']) }}
				</div>
			{{ Form::close() }}
		</div>
	</body>
    
@stop