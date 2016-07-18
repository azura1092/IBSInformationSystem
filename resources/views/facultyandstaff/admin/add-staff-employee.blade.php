@extends('facultyandstaff.admin.dash-admin')

@section('content')
	@if(count($errors) > 0)

		@foreach ($errors->all() as $error)
    	 	<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            	 <li>{{ $error }}</li>
    		</div>
         @endforeach

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
							<form class="form-horizontal" data-toggle="validator" method="POST" action="{{ url('/processAddStaffEmployee') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<label class="col-sm-3 control-label">Employee Number</label>
									<div class="col-sm-7">
										<input class="form-control" name="employeeNumber" id="employeeNumber" type="text" value="{{old('employeeNumber')}}" maxlength="10" data-minlength="10" data-error="Please input a valid employee number." required>
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">First Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="firstName" id="firstName" type="text" value="{{old('firstName')}}" required>
										<div class="help-block with-errors"></div>
									</div>
								</div>	

								<div class="form-group">
									<label class="col-sm-3 control-label">Middle Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="middleName" id="middleName" type="text" value="{{old('middleName')}}" required>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Last Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="lastName" id="lastName" type="text" value="{{old('lastName')}}" required>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Position</label>
									<div class="col-sm-7">
										<select class="form-control" name="position" id="position" data-error="Please pick a position." required>
											<option selected disabled></option>
											@foreach($positions as $p)
												<option value="{{ $p->positionTitle }}" @if (Input::old('position') == $p->positionTitle) selected="selected" @endif>{{ $p->positionTitle }}</option>
											@endforeach
										</select>	
										<div class="help-block with-errors"></div>	
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Sex</label>
									<div class="col-sm-7">
										<select class="form-control" name="sex" id="sex" data-error="Please indicate your sex."  required>
											<option selected disabled></option>
											<option name="Female" value="Female" @if (Input::old('sex') == 'Female') selected="selected" @endif>Female</option>
											<option name="Male" value="Male" @if (Input::old('sex') == 'Male') selected="selected" @endif>Male</option>
										</select>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Birthdate</label>
									<div class="col-sm-7">
										<input class="form-control" name="birthdate" id="birthdate" data-error="Please provide a valid date." type="date" value="{{old('birthdate')}}" required>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Contact Number</label>
									<div class="col-sm-7">
										<input class="form-control" name="contactNumber" id="contactNumber" type="text" value="{{old('contactNumber')}}" data-minlength="5" required>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Email Address</label>
									<div class="col-sm-7">
										<input class="form-control" name="emailAddress" id="emailAddress" type="email" value="{{old('emailAddress')}}" data-minlength="6" required>
										<div class="help-block with-errors"></div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Current Address</label>
									<div class="col-sm-7">
										<textarea class="form-control" name="currentAddress" id="currentAddress" data-minlength="5" required>{{{old('currentAddress')}}}</textarea>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Permanent Address</label>
									<div class="col-sm-7">
										<textarea class="form-control" name="permanentAddress" id="permanentAddress" data-minlength="5" required>{{{old('lastName')}}}</textarea>
										<div class="help-block with-errors"></div>
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