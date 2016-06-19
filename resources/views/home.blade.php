@extends('alumni')

@section('content')

<div class="container-fluid">
  		<div class="row">
			<div class="col-md-offset-3 col-md-6 col-md-offset-3">	
						<div class="row">
							<h1><br><br><p style="color: #ccc;">Welcome! {{ Auth::user()->name }}</p></h1>
						</div>
			</div>
		</div>
</div>

<!--<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					You are logged in!
				</div>
			</div>
		</div>
	</div>
</div>-->

@endsection
