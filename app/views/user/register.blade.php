@extends('layouts.guest')

@section('content')
	<body class="login-body">
    	<div class="container">
    		{{ Form::open(['route' => 'register', 'class' => 'form-signin']) }}
	        	<h2 class="form-signin-heading">Create New Account now</h2>
	        
		        <div class="login-wrap">
	        		@include('includes.alert')

		        	{{ Form::text('full_name', '', ['class' => 'form-control', 'placeholder' => 'Full Name' , 'autofocus']) }}
		        	{{ Form::error($errors, 'full_name') }}

		        	{{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email Address']) }}
		        	{{ Form::error($errors, 'email') }}

		        	{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
		        	{{ Form::error($errors, 'password') }}

		        	{{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) }}
		        	{{ Form::error($errors, 'password_confirmation') }}


	            	{{ Form::submit('Create Account', ['class' => 'btn btn-lg btn-login btn-block']) }}

		            <!-- <p>or you can sign in via social network</p>
		            <div class="login-social-link">
		                <a href="index.html" class="facebook">
		                    <i class="fa fa-google-plus"></i>
		                    Google
		                </a>
		            </div> -->
	            
					<div class="registration">
						Already have an account?
						{{ HTML::linkRoute('login', 'Login') }}
					</div>
				</div>
			{{ Form::close() }}
    	</div>
    </body>
    
@stop