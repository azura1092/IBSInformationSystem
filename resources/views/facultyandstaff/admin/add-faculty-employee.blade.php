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
			<h3>Add Faculty Record</h3>
			<hr></hr>
		</div>
	</div>
				
				<div class="update-section">
					<div class="row">
						<div class="col-xs-12">
							<form class="form-horizontal" data-toggle="validator" method="POST" action="{{ url('/processAddEmployee') }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
									<label class="col-sm-3 control-label">Employee Number</label>
									<div class="col-sm-7">
										<input class="form-control" name="employeeNumber" id="employeeNumber" type="text" maxlength="10" data-minlength="10" data-error="Please input a valid employee number." value="" required>
										<div class="help-block with-errors"></div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">First Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="firstName" id="firstName" type="text" value="" required>
										<div class="help-block with-errors"></div>
									</div>
								</div>	

								<div class="form-group">
									<label class="col-sm-3 control-label">Middle Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="middleName" id="middleName" type="text" value="" required>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Last Name</label>
									<div class="col-sm-7">
										<input class="form-control" name="lastName" id="lastName" type="text" value="" required>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Position</label>
									<div class="col-sm-7">
										<select class="form-control" name="position" id="position" data-error="Please pick a position." required>
											<option selected disabled></option>
											@foreach($positions as $p)
												<option>{{ $p->positionTitle }}</option>
											@endforeach
										</select>	
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Division</label>
									<div class="col-sm-7">
										<select class="form-control" name="division" id="division" data-error="Please pick a division." required>
											<option selected disabled></option>
											@foreach($divisions as $d)
												<option>{{ $d->division }}</option>
											@endforeach
										</select>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Sex</label>
									<div class="col-sm-7">
										<select class="form-control" name="sex" id="sex" data-error="Please indicate your sex." required>
											<option selected disabled></option>
											<option name="Female" value="Female">Female</option>
											<option name="Male" value="Male">Male</option>
										</select>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Birthdate</label>
									<div class="col-sm-7">
										<input class="form-control" name="birthdate" id="birthdate" type="date" value="" data-error="Please provide a valid date." required>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Contact Number</label>
									<div class="col-sm-7">
										<input class="form-control" name="contactNumber" id="contactNumber" type="number" value="" data-minlength="5" required>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Email Address</label>
									<div class="col-sm-7">
										<input class="form-control" name="emailAddress" id="emailAddress" type="email" value="" data-minlength="6" required>
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
									<label class="col-sm-3 control-label">Degree</label>
									<div class="col-sm-7">
										<select class="form-control" name="degree" id="degree" data-error="Please pick a degree." required>
											<option selected disabled></option>
											@foreach($degrees as $d)
												<option>{{ $d->degree }}</option>
											@endforeach
										</select>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Specialization</label>
									<div class="col-sm-7">
										<select class="form-control" name="specialization" id="specialization" data-error="Please pick a specialization." required>
											<option selected disabled></option>
											@foreach($specializations as $s)
												<option>{{ $s->specialization }}</option>
											@endforeach
										</select>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Year Graduated</label>
									<div class="col-sm-7">
										<input class="form-control" name="yearGraduated" id="number" maxlength="4" data-minlength="4" pattern="^[0-9]*" type="text" value="" data-error="Please input a year." required>
										<div class="help-block with-errors"></div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">School Graduated From</label>
									<div class="col-sm-7">
										<input class="form-control" name="school" id="school" type="text" value="" data-minlength="4" required>
										<div class="help-block 	with-errors"></div>
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