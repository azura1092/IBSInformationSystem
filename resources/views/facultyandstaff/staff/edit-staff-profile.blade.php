@extends('facultyandstaff.staff.dash-staff')

@section('content')
	@if(count($errors) > 0)

		@foreach ($errors->all() as $error)
    	 	<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            	 <li>{{ $error }}</li>
    		</div>
         @endforeach

	@elseif($status)

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
				<form class="form-horizontal" method="POST" data-toggle="validator" action="{{ url('/requestEditStaffProfile') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="employeeNum" id="employeeNum" value="{{$employee[0]->employeeNum}}">
					<div class="form-group">
						<label class="col-sm-3 control-label">First Name</label>
						<div class="col-sm-7">
							<input class="form-control" name="firstName" id="firstName" type="text" value="{{$employee[0]->firstName}}" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>	

					<div class="form-group">
						<label class="col-sm-3 control-label">Middle Name</label>
						<div class="col-sm-7">
							<input class="form-control" name="middleName" id="middleName" type="text" value="{{$employee[0]->middleName}}" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Last Name</label>
						<div class="col-sm-7">
							<input class="form-control" name="lastName" id="lastName" type="text" value="{{$employee[0]->lastName}}" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Position</label>
						<div class="col-sm-7">
							<select class="form-control" name="position" id="position" data-error="Please pick a position." required>
								<option selected disabled></option>
								@foreach($staffpositions as $p)	
									@if($p->positionTitle == $employee[0]->position)
										<option selected>{{ $p->positionTitle }}</option>
									@else
										<option>{{ $p->positionTitle }}</option>
									@endif
								@endforeach
							</select>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Sex</label>
						<div class="col-sm-7">
							<select class="form-control" name="sex" id="sex" data-error="Please indicate your sex." required>
								@if($employee[0]->sex=='F')
									<option>Male</option>
									<option selected>Female</option>
								@elseif($employee[0]->sex=='M')
									<option selected>Male</option>
									<option>Female</option>
								@else
									<option selected disabled></option>
									<option>Female</option>
									<option>Male</option>
								@endif
							</select>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Birthdate</label>
						<div class="col-sm-7">
							<input class="form-control" name="birthdate" id="birthdate" type="date" min="1900" value="{{$employee[0]->birthdate}}" data-error="Please input a valid date." required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Contact Number</label>
						<div class="col-sm-7">
							<input class="form-control" name="contactNum" id="contactNum" type="number" value="{{$employee[0]->contactNum}}" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Email Address</label>
						<div class="col-sm-7">
							<input class="form-control" name="emailAddress" id="emailAddress" type="email" value="{{$employee[0]->emailAddress}}" data-error="Please input a valid email." required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Current Address</label>
						<div class="col-sm-7">
							<input class="form-control" name="currentAddress" id="currentAddress" data-minlength="4" type="text" value="{{$employee[0]->currentAddress}}" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Permanent Address</label>
						<div class="col-sm-7">
							<input class="form-control" name="permanentAddress" id="permanentAddress" data-minlength="4" type="text" value="{{$employee[0]->permanentAddress}}" required>
							<div class="help-block with-errors"></div>
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
