@extends('facultyandstaff.staff.dash-staff')

@section('content')

<div class="row">
	<div class="col-xs-12">
		<h3>Welcome, {{ $user[0]->firstName }}</h3>
		<hr></hr>
	</div>
</div>

<div class='row'>
	<div class='col-xs-12'>

		<div id="view-profile" class='panel panel-default'>
			<div class='panel-body'>
				<table class="table table-hover">
					<p style="text-align: right; margin-bottom: 25px;">
						<form method="POST" action=" {{ url('/edit-staff-profile') }} ">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="employeeNum" value="{{ $user[0]->employeeNum }}">
							<button type="submit" id="search-update-button" class="btn btn-default" style="position: absolute; top: 0; right: 15px; border-radius: 0;">
								Edit Profile
							</button>
						</form>
					</p>
					<thead>
						<tr>
							<td><h4><b>Basic Information</b></h4></td>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td class="col-xs-3">Employee Number</td>
							<td>{{ $user[0]->employeeNum }}</td>
						</tr>

						<tr>
							<td class="col-xs-3">First Name</td>
							<td>{{ $user[0]->firstName }}</td>
						</tr>
						<tr>
							<td>Middle Name</td>
							<td>{{ $user[0]->middleName }}</td>
						</tr>
						<tr>
							<td>Last Name</td>
							<td>{{ $user[0]->lastName }}</td>
						</tr>

						<tr>
							<td class="col-xs-3">Sex</td>
							<td>
								@if( $user[0]->sex == 'F')
									Female
								@elseif( $user[0]->sex == 'M')
									Male
								@endif
							</td>
						</tr>
						<tr>
							<td>Birthday</td>
							<td>{{ $user[0]->birthdate }}</td>
						</tr>
						<tr>
							<td>Contact Number</td>
							<td>{{ $user[0]->contactNum }}</td>
						</tr>
						<tr>
							<td>Email Address</td>
							<td>{{ $user[0]->emailAddress }}</td>
						</tr>
						<tr>
							<td>Current Address</td>
							<td>{{ $user[0]->currentAddress }}</td>
						</tr>
						<tr>
							<td>Permanent Address</td>
							<td>{{ $user[0]->permanentAddress }}</td>
						</tr>
						
						<tr>
							<td class="col-xs-3">Position</td>
							<td>{{ $user[0]->position }}</td>
						</tr>
						
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>


@endsection