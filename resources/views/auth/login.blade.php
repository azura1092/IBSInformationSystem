@extends('app')

@section('content')

@if($error != "")

	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ $error }}
	</div>

@endif

<header role="banner">
		<div id="cd-logo"><a href="#0"><img src="{{ asset('img/logo.png') }}" alt="Logo"></a></div>

		<nav class="main-nav">
			<ul>
				<li><a class="btn btn-block btn-social btn-google" href="{{ url('auth/google') }}">
    					<span class="fa fa-google"></span> Sign in with Google
  					</a>
  				</li>
			</ul>
		</nav>
</header>
	
@endsection
