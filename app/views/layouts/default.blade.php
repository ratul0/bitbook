<!DOCTYPE html>
<html lang="en">
	@include('includes.head')
	<body>
	  	<section id="container">
			@include('includes.topMENU')
		@yield('content')
		</section>

	{{ HTML::script('js/jquery.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	@yield('script')

	</body>
</html>
