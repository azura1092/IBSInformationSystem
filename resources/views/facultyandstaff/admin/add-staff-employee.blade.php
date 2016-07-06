@extends('facultyandstaff.admin.dash-admin')

@section('content')
	@if($status == 2)

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
										<input class="form-control" name="employeeNumber" id="employeeNumber" type="text" value="{{old('employeeNumber')}}" required>
										@if($errors->has('employeeNumber'))
											<li class="list-group-item list-group-item-danger">Please type a valid employee number</li>
										@endif
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">First Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="firstName" id="firstName" type="text" value="{{old('firstName')}}" required>
										@if($errors->has('firstName'))
											<li class="list-group-item list-group-item-danger">Please check your input</li>
										@endif
									</div>
								</div>	

								<div class="form-group">
									<label class="col-sm-3 control-label">Middle Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="middleName" id="middleName" type="text" value="{{old('middleName')}}" required>
										@if($errors->has('middleName'))
											<li class="list-group-item list-group-item-danger">Please check your input</li>
										@endif
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Last Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="lastName" id="lastName" type="text" value="{{old('lastName')}}" required>
										@if($errors->has('lastName'))
											<li class="list-group-item list-group-item-danger">Please check your input</li>
										@endif
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Position</label>
									<div class="col-sm-7">
										<select class="form-control" name="position" id="position" required>
											<option selected disabled></option>
											@foreach($positions as $p)
												<option value="{{ $p->positionTitle }}" @if (Input::old('position') == $p->positionTitle) selected="selected" @endif>{{ $p->positionTitle }}</option>
											@endforeach
										</select>	
										@if($errors->has('position'))
											<li class="list-group-item list-group-item-danger">Please check your input</li>
										@endif	
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Sex</label>
									<div class="col-sm-7">
										<select class="form-control" name="sex" id="sex" required>
											<option selected disabled></option>
											<option name="Female" value="Female" @if (Input::old('sex') == 'Female') selected="selected" @endif>Female</option>
											<option name="Male" value="Male" @if (Input::old('sex') == 'Male') selected="selected" @endif>Male</option>
										</select>
										@if($errors->has('sex'))
											<li class="list-group-item list-group-item-danger">Please check your input</li>
										@endif
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Birthdate</label>
									<div class="col-sm-7">
										<input class="form-control" name="birthdate" id="birthdate" type="date" value="{{old('birthdate')}}" required>
										@if($errors->has('birthdate'))
											<li class="list-group-item list-group-item-danger">Please input a valid birthdate.</li>
										@endif
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Contact Number</label>
									<div class="col-sm-7">
										<input class="form-control" name="contactNumber" id="contactNumber" type="text" value="{{old('contactNumber')}}" required>
										@if($errors->has('contactNumber'))
											<li class="list-group-item list-group-item-danger">Please input a valid contact number.</li>
										@endif
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Email Address</label>
									<div class="col-sm-7">
										<input class="form-control" name="emailAddress" id="emailAddress" type="email" value="{{old('emailAddress')}}" required>
										@if($errors->has('emailAddress'))
											<li class="list-group-item list-group-item-danger">Please input a valid email address</li>
										@endif
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Current Address</label>
									<div class="col-sm-7">
										<textarea class="form-control" name="currentAddress" id="currentAddress" required>{{{old('currentAddress')}}}</textarea>
										@if($errors->has('currentAddress'))
											<li class="list-group-item list-group-item-danger">Please check your input</li>
										@endif
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Permanent Address</label>
									<div class="col-sm-7">
										<textarea class="form-control" name="permanentAddress" id="permanentAddress" required>{{{old('lastName')}}}</textarea>
										@if($errors->has('permanentAddress'))
											<li class="list-group-item list-group-item-danger">Please check your input</li>
										@endif
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-10">
										&nbsp;
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-3">
										<button type="submit" class="btn btn-success btn-block">Save</button>
									</div>
								</div>
							</form>
	
						</div>
					</div>
				</div>

@endsection