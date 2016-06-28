<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>
 -->
	<link rel="icon" href="{{ asset('/img/favicon.ico')}}" />
	<link rel="stylesheet" href="{{ asset('/css/reset.css')}}"> <!-- CSS reset -->
	<link rel="stylesheet" href="{{ asset('/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{ asset('/css/dashboard.css')}}"> <!-- Resource style -->
 	<link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css')}}">
	

	<link rel="stylesheet" href="{{ asset('/css/style.css')}}">
	<link rel="stylesheet" href="{{ asset('/css/util/util.css')}}">
	<link rel="stylesheet" href="{{ asset('/css/custom.css')}}">

	<script src="js/modernizr.js"></script> <!-- Modernizr -->
  	
	<title>IBS-IS</title>
</head>
<body>
	<header class="cd-main-header">
		<a href="home" class="cd-logo"><img src="{{asset('/img/logo.png')}}" alt="Logo"></a>
		<a href="#" class="cd-nav-trigger">Menu<span></span></a> <!-- mobile -->

		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<li class="has-children account">
					<a href="#0">
						<img src="{{Session::get('avatar')}}" alt="avatar">
						{{ Session::get('userEmp')['firstName'] }} {{ Session::get('userEmp')['lastName'] }}
					</a>

					<ul>

						<li><a href="staff-profile">My Profile</a></li>
						<li>
							<form method="POST" action="{{ url('logout') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<a href="logout">Logout</a>

							</form>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
	</header> <!-- .cd-main-header -->

	<main class="cd-main-content">
		<nav class="cd-side-nav">
			<ul>
				<li class="cd-label">Menu</li>
				<li>
					<a href="home">Home</a>
				</li>
				<li>
					<a href="staff-profile">My Profile</a>
				</li>
				<!-- NOTIFICATIONS -->
				<li class="notifications">
					<a href="staff-notifications">Notifications
						<?php 
							$total = count($approvedCount) + count($declinedCount) + count($editNoticeCount);
						?>
						@if($total!=0)
							<span class="count">
								{{ $total }}
							</span>
						@endif
					</a>
				</li>
				<li class="has-children">
					<a href="#0">Graduate</a>

					<ul>
						<li><a href="{{ url('/staff-search-graduate-filter') }}">View All</a></li>
						<li><a href="{{ url('/graphStaff') }}">Visualize Data</a></li>
					</ul>
				</li>
			</ul>
		</nav>

		<div class="content-wrapper">
			<div class="container-fluid">

				@yield('content')

			</div>
				

		</div> <!-- .content-wrapper -->
	</main> <!-- .cd-main-content -->
<script src="js/jquery-2.1.4.js"></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/dashboard.js"></script> <!-- Resource jQuery -->
<script>
	$(document).ready(function(e){
		$('.search-panel .dropdown-menu').find('a').click(function(e){
			e.preventDefault();
			var param = $(this).attr("href").replace("#", "");
			var concept = $(this).text();
			$('.search-panel span#search_concept').text(concept);
			$('.input-group #search_param').val(param);
		});
		$('.search-section .dropdown-menu').find('a').click(function(e){
			e.preventDefault();
			var concept = $(this).text();
			$('.search-section #input-getter').attr("placeholder", "Search by " + concept);


			if(concept == "Major"){
				$('.search-section #input-getter').attr("name", "major");
				$('.search-section form').attr("action", "{{ url('/staff-search-graduate-major') }}");
			}
			else if(concept == "Master of Science Degree"){
				$('.search-section #input-getter').attr("name", "mscdegere");
				$('.search-section form').attr("action", "{{ url('/staff-search-graduate-mscdegree') }}");
			}
			else if(concept == "Year Graduated"){
				$('.search-section #input-getter').attr("name", "yeargrad");
				$('.search-section form').attr("action", "{{ url('/staff-search-graduate-yeargrad') }}");
			}
			else if(concept == "Current Company"){
				$('.search-section #input-getter').attr("name", "companyname");
				$('.search-section form').attr("action", "{{ url('/staff-search-graduate-companyname') }}");
			}else if(concept == "Last Name"){
				$('.search-section #input-getter').attr("name", "lname");
				$('.search-section form').attr("action", "{{ url('/staff-search-graduate-lname') }}");
			}
			
		});

		$('.btn').click(function(){
			var buttonID = $(this).attr('id');
			
			if(buttonID == 'search-confirm-del-button'){
				var emp = $(this).data('id').split(" ");				

				$('.getter').val(emp[0]);
				$('.modal-body').html("Are you sure you want to delete the record of <b>" + emp[1] + " " + emp[2] + "</b>?");
			}

			else if(buttonID == 'search-delete-button'){
				$('.search-result-btns').attr("action", "{{ url('/delete-graduate') }}");
				
			}
		});
			$(document).on('change', '.btn-file :file', function() {
		  var input = $(this),
		      numFiles = input.get(0).files ? input.get(0).files.length : 1,
		      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		  input.trigger('fileselect', [numFiles, label]);
		});

		$(document).ready( function() {
		    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
		        
		        var input = $(this).parents('.input-group').find(':text'),
		            log = numFiles > 1 ? numFiles + ' files selected' : label;
		        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
        
    });
	});
	});
</script>
</body>
</html>