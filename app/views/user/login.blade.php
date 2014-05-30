@extends('layouts.guest')

@section('content')
	<body class="login-body">
    	<div class="container">
      		{{ Form::open(['route' => 'login', 'class' => 'form-signin']) }}
	        	<h2 class="form-signin-heading">Log in now</h2>
	        
		        <div class="login-wrap">
	        		@include('includes.alert')

		        	{{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email Address' , 'autofocus']) }}
		        	{{ Form::error($errors, 'email') }}

		        	{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
		        	{{ Form::error($errors, 'password') }}

					<label class="checkbox">
						<span class="pull-right">
							{{ HTML::linkRoute('password.forgot', 'Forgot Password') }}
						</span>
					</label>

	            	{{ Form::submit('Login', ['class' => 'btn btn-lg btn-login btn-block']) }}

		            <!-- <p>or you can sign in via social network</p>
		            <div class="login-social-link">
		                <a href="index.html" class="facebook">
		                    <i class="fa fa-google-plus"></i>
		                    Google
		                </a>
		            </div> -->
	            
					<div class="registration">
						Don't have an account yet?
						{{ HTML::linkRoute('register', 'Create an account') }}
					</div>
				</div>
			{{ Form::close() }}
    	</div>
    </body>
@stop