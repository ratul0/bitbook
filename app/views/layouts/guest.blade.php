<!DOCTYPE html>
<html lang="en">
	@include('includes.head')
	@yield('content')

	{{ HTML::script('js/jquery.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	@yield('script')

	</body>
</html>
