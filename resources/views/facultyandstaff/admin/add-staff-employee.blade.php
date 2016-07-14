@extends('facultyandstaff.admin.dash-admin')

@section('content')
	@if($status == 0)

		<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Record cannot be added. Employee number already exists.
    	</div>

	@elseif($status == 2)

		<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Successfully added the record!
    	</div>

	@endif

	<div class="row">				
		<div class="col-xs-12">
			<h3>Add Staff Record</h3>
			<hr></hr>
		</div>
	</div>
				
				<div class="update-section">
					<div class="row">
						<div class="col-xs-12">
							<form class="form-horizontal" method="POST" action="{{ url('/processAddStaffEmployee') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<label class="col-sm-3 control-label">Employee Number</label>
									<div class="col-sm-7">
										<input class="form-control" name="employeeNumber" id="employeeNumber" type="text" value="" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">First Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="firstName" id="firstName" type="text" value="" required>
									</div>
								</div>	

								<div class="form-group">
									<label class="col-sm-3 control-label">Middle Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="middleName" id="middleName" type="text" value="" required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Last Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="lastName" id="lastName" type="text" value="" required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Position</label>
									<div class="col-sm-7">
										<select class="form-control" name="position" id="position" required>
											<option selected disabled></option>
											@foreach($positions as $p)
												<option>{{ $p->positionTitle }}</option>
											@endforeach
										</select>		
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Sex</label>
									<div class="col-sm-7">
										<select class="form-control" name="sex" id="sex" required>
											<option selected disabled></option>
											<option name="Female" value="Female">Female</option>
											<option name="Male" value="Male">Male</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Birthdate</label>
									<div class="col-sm-7">
										<input class="form-control" name="birthdate" id="birthdate" type="date" value="" required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Contact Number</label>
									<div class="col-sm-7">
										<input class="form-control" name="contactNumber" id="contactNumber" type="number" value="" required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Email Address</label>
									<div class="col-sm-7">
										<input class="form-control" name="emailAddress" id="emailAddress" type="email" value="" required>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Current Address</label>
									<div class="col-sm-7">
										<input class="form-control" name="currentAddress" id="currentAddress" type="text" value="" required>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Permanent Address</label>
									<div class="col-sm-7">
										<input class="form-control" name="permanentAddress" id="permanentAddress" type="text" value="" required>
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-10">
										<button type="submit" class="btn btn-success btn-block">Save</button>
									</div>
								</div>
							</form>
	
						</div>
					</div>
				</div>

@endsection