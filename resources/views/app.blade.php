<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{{ asset('/css/app.css')}}"> <!-- CSS reset -->
	<link rel="stylesheet" href="{{ asset('/css/reset.css')}}"> <!-- CSS reset -->
	<link rel="stylesheet" href="{{ asset('/css/login.css') }}"> <!-- Gem style -->
	<link rel="stylesheet" href="{{ asset('/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{ asset('/css/bootstrap-social.css') }}"> <!-- Gem style -->
	<link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css')}}">

	<script src="{{ asset('/js/modernizr.js')}}"></script> <!-- Modernizr -->
  	
	<title>IBS | Log In</title>
</head>
<body style="background-image: url('../img/bg2.jpg'); -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
	@yield('content')


<footer class="footer">
	<div class="container">
  	<p>
      	Institute of Biological Sciences | College of Arts and Sciences <br>
      	R.B. Espino Wing, L.B. Uichanco Hall | University of the Philippines Los Baños <br>
		College, Laguna 4031, Philippines | 
		Telefax: (63) (049) 536-2893
  	</p>
	</div>
</footer>


<script src="{{ asset('/js/jquery-2.1.4.js')}}"></script>
<script src="{{ asset('js/login.js') }}"></script>

</body>
</html>
