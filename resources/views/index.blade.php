<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
 -->
 	<link rel="icon" href="img/favicon.ico" />
 	<link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}">
	
	<link rel="stylesheet" href="{{ asset('/css/reset.css')}}"> <!-- CSS reset -->

	<link rel="stylesheet" href="{{ asset('/css/style.css')}}">
	<link rel="stylesheet" href="{{ asset('/css/util/util.css') }}">

	<link rel="stylesheet" href="{{ asset('/css/dashboard.css') }}"> <!-- Resource style -->
	<link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<script src="{{ asset('/js/jquery.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/modernizr.js') }}"></script> 
    
	<title>IBS-IS | Home</title>
</head>
<body>
	<header class="cd-main-header">
		<a href="#0" class="cd-logo"><img src="{{asset('/img/logo.png') }}" alt="Logo"></a>

		<a href="#0" class="cd-nav-trigger">Menu<span></span></a> <!-- mobile -->
		

	</header>
	
			<!-- <h1>IBS Information System</h1> -->
			<!--<div class="container-fluid">-->
				@yield('content')
			<!--</div>-->

</body>
</html>