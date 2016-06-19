@extends('facultyandstaff.faculty.dash-faculty')

@section('content')
	@if($status)

		<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Your edit request has been submitted for validation!
    	</div>

	@endif

	<div class="row">					
		<div class="col-xs-12">
			<h3>Employee <b>{{$employee[0]->employeeNum}}</b></h3>
			<hr></hr>
		</div>
	</div>
	
	<div class="update-section">
		<div class="row">
			<div class="col-xs-12">
				<form class="form-horizontal" method="POST" action="{{ url('/requestEditFacultyProfile') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="employeeNum" id="employeeNum" value="{{$employee[0]->employeeNum}}">
					<div class="form-group">
						<label class="col-sm-3 control-label">First Name</label>
						<div class="col-sm-7">
							<input class="form-control" name="firstName" id="firstName" type="text" value="{{$employee[0]->firstName}}" required>
						</div>
					</div>	

					<div class="form-group">
						<label class="col-sm-3 control-label">Middle Name</label>
						<div class="col-sm-7">
							<input class="form-control" name="middleName" id="middleName" type="text" value="{{$employee[0]->middleName}}" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Last Name</label>
						<div class="col-sm-7">
							<input class="form-control" name="lastName" id="lastName" type="text" value="{{$employee[0]->lastName}}" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Position</label>
						<div class="col-sm-7">
							<select class="form-control" name="position" id="position" required>
								<option selected disabled></option>
								@foreach($facultypositions as $p)
									@if($p->positionTitle == $employee[0]->position)
										<option selected>{{ $p->positionTitle }}</option>
									@else
										<option>{{ $p->positionTitle }}</option>
									@endif
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Division</label>
						<div class="col-sm-7">
							<select class="form-control" name="division" id="division" required>
								<option selected disabled></option>
								@foreach($divisions as $d)
									@if($d->division == $employee[0]->division)
										<option selected>{{ $d->division }}</option>
									@else
										<option>{{ $d->division }}</option>
									@endif
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Sex</label>
						<div class="col-sm-7">
							<select class="form-control" name="sex" id="sex" required>
								<option selected disabled></option>
								@if($employee[0]->sex=='F')
									<option>Male</option>
									<option selected>Female</option>
								@elseif($employee[0]->sex=='M')
									<option selected>Male</option>
									<option>Female</option>
								@else
									<option>Female</option>
									<option>Male</option>
								@endif
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Birthdate</label>
						<div class="col-sm-7">
							<input class="form-control" name="birthdate" id="birthdate" type="date" value="{{$employee[0]->birthdate}}" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Contact Number</label>
						<div class="col-sm-7">
							<input class="form-control" name="contactNum" id="contactNum" type="number" value="{{$employee[0]->contactNum}}" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Email Address</label>
						<div class="col-sm-7">
							<input class="form-control" name="emailAddress" id="emailAddress" type="email" value="{{$employee[0]->emailAddress}}" required>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Current Address</label>
						<div class="col-sm-7">
							<input class="form-control" name="currentAddress" id="currentAddress" type="text" value="{{$employee[0]->currentAddress}}" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Permanent Address</label>
						<div class="col-sm-7">
							<input class="form-control" name="permanentAddress" id="permanentAddress" type="text" value="{{$employee[0]->permanentAddress}}" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Degree</label>
						<div class="col-sm-7">
							<select class="form-control" name="degree" id="degree" required>
								<option selected disabled></option>
								@foreach($degrees as $d)
									@if($d->degree == $employee[0]->degree)
										<option selected>{{ $d->degree }}</option>
									@else
										<option>{{ $d->degree }}</option>
									@endif
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Specialization</label>
						<div class="col-sm-7">
							<select class="form-control" name="specialization" id="specialization" required>
								<option selected disabled></option>
								@foreach($specializations as $s)
									@if($s->specialization == $employee[0]->specialization)
										<option selected>{{ $s->specialization }}</option>
									@else
										<option>{{ $s->specialization }}</option>
									@endif
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Year Graduated</label>
						<div class="col-sm-7">
							<input class="form-control" name="yearGraduated" id="number" type="number" min="1900" value="{{$employee[0]->yearGraduated}}" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">School Graduated From</label>
						<div class="col-sm-7">
							<input class="form-control" name="schoolGraduated" id="schoolGraduated" type="text" value="{{$employee[0]->schoolGraduated}}" required>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-success btn-block">Submit</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>

@endsection