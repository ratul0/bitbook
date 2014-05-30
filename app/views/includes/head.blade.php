	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="{{ url('favicon.ico') }}">

		<title>{{ isset($title) ? $title : '' }} - {{ Config::get('siteConfig.siteName') }}</title>

		<!-- stylesheets -->
		{{ HTML::style('css/bootstrap.min.css') }}
		{{ HTML::style('css/bootstrap-reset.css') }}
		{{ HTML::style('assets/font-awesome/css/font-awesome.css') }}
		{{ HTML::style('css/style.css') }}
		{{ HTML::style('css/style-responsive.css') }}
		@yield('style')
		{{ HTML::style('css/custom.css') }}
		<!-- /stylesheets -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    	<!--[if lt IE 9]>
		    <script src="js/html5shiv.js"></script>
		    <script src="js/respond.min.js"></script>
    	<![endif]-->
	</head>