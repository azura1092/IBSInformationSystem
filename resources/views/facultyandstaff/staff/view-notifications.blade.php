@extends('facultyandstaff.staff.dash-staff')

@section('content')

	@if(count($approvedusers) == 0 && count($declinedusers) == 0 && count($editnoticeusers) == 0)
		<h1>No new messages</h1>

	@else
	<div class="row">
		<div class="col-xs-12">
			<h3>Notifications</h3>
			<hr></hr>
		</div>
	</div>

	
	<div class="update-section">
		<div class="row">
			<div class="col-xs-12">
				@foreach($approvedusers as $u)
					<div class="alert alert-success alert-dismissible" role="alert">
						<form method="POST" action="{{ url('/processDismissStaffNotif') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="employeeNum" id="employeeNum" value="{{ $u->employeeNum }}">
							<input type="hidden" name="empID" id="empID" value="{{ $u->id }}">
							<input type="hidden" name="notifType" id="notifType" value="approvedRequest">
							
							<button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Your profile update request last {{ $u->requestMadeAt }} has been approved!	
						</form>		
					</div>
				@endforeach

				@foreach($declinedusers as $u)
					<div class="alert alert-danger alert-dismissible" role="alert">
						<form method="POST" action="{{ url('/processDismissStaffNotif') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="employeeNum" id="employeeNum" value="{{ $u->employeeNum }}">
							<input type="hidden" name="empID" id="empID" value="{{ $u->id }}"> 
							<input type="hidden" name="notifType" id="notifType" value="declinedRequest">
							
							<button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							Your profile update request last {{ $u->requestMadeAt }} was not approved.	
						</form>		
					</div>
				@endforeach

				@foreach($editnoticeusers as $u)
					<div class="alert alert-warning alert-dismissible" role="alert">
						<form method="POST" action="{{ url('/processDismissStaffNotif') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="employeeNum" id="employeeNum" value="{{ $u->employeeNum }}">
							<input type="hidden" name="empID" id="empID" value="{{ $u->id }}"> 
							<input type="hidden" name="notifType" id="notifType" value="editNotice">
							
							<button type="submit" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							The administrator made changes to your basic profile information.	
						</form>		
					</div>
				@endforeach
			</div>
		</div>
	</div>
	@endif


@endsection

