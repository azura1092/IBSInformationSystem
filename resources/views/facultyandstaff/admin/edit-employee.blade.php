@extends('facultyandstaff.admin.dash-admin')

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
            Successfully edited the record!
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
				<form class="form-horizontal" data-toggle="validator" method="POST" action="{{ url('/processEditEmployee') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="employeeNum" id="employeeNum" value="{{$employee[0]->employeeNum}}">
					
					<!--
					<div class="form-group">
						<label class="col-sm-3 control-label">First Name</label>
						<div class="col-sm-7">
							<input class="form-control" name="firstName" id="firstName" type="text" value="{{$employee[0]->firstName}}" required>
						</div>
					</div>	

					-->

					<div class="form-group">
						<label class="col-sm-3 control-label">First Name</label>
						<div class="col-sm-7">
							<input class="form-control" name="firstName" id="firstName" type="text" value="{{($employee[0]->firstName != '')? $employee[0]->firstName : old('firstName')}}" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>	

					<div class="form-group">
						<label class="col-sm-3 control-label">Middle Name</label>
						<div class="col-sm-7">
							<input class="form-control" name="middleName" id="middleName" type="text" value="{{($employee[0]->middleName != '')? $employee[0]->middleName : old('middleName')}}" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Last Name</label>
						<div class="col-sm-7">
							<input class="form-control" name="lastName" id="lastName" type="text" value="{{($employee[0]->lastName != '')? $employee[0]->lastName : old('lastName')}}" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
				
					@if($employee[0]->type!=2)
					<div class="form-group">
						<label class="col-sm-3 control-label">Position</label>
						<div class="col-sm-7">
							<select class="form-control" name="position" id="position" data-error="Please select a position." required>
								@if($employee[0]->type == 1)
									@if($employee[0]->position != '')
										@foreach($facultypositions as $p)
											@if($p->positionTitle == $employee[0]->position)
												<option selected>{{ $p->positionTitle }}</option>
											@else
												<option>{{ $p->positionTitle }}</option>
											@endif
										@endforeach
									@else
										@foreach($facultypositions as $p)
											<option value="{{ $p->positionTitle }}" @if (Input::old('position') == $p->positionTitle) selected="selected" @endif>{{ $p->positionTitle }}</option>
										@endforeach
									@endif
								@elseif($employee[0]->type == 0)
									@if($employee[0]->position != '')
										@foreach($staffpositions as $p)
											@if($p->positionTitle == $employee[0]->position)
												<option selected>{{ $p->positionTitle }}</option>
											@else
												<option>{{ $p->positionTitle }}</option>
											@endif
										@endforeach
									@else
										@foreach($staffpositions as $p)
											<option value="{{ $p->positionTitle }}" @if (Input::old('position') == $p->positionTitle) selected="selected" @endif>{{ $p->positionTitle }}</option>
										@endforeach
									@endif
								@endif
							</select>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					@endif

					@if($employee[0]->type == 1)
					<div class="form-group">
						<label class="col-sm-3 control-label">Division</label>
						<div class="col-sm-7">
							<select class="form-control" name="division" id="division" data-error="Please select a division." required>
								@if($employee[0]->division != '')
									@foreach($divisions as $d)
										@if($d->division == $employee[0]->division)
											<option value="{{ $d->division }}" selected>{{ $d->division }}</option>
										@else
											<option value="{{ $d->division }}">{{ $d->division }}</option>
										@endif
									@endforeach
								@else
									@foreach($divisions as $d)
										<option value="{{ $d->division }}" @if (Input::old('division') == $d->division) selected="selected" @endif>{{ $d->division }}</option>
									@endforeach
								@endif
							</select>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					@endif

					<div class="form-group">
						<label class="col-sm-3 control-label">Sex</label>
						<div class="col-sm-7">
							<select class="form-control" name="sex" id="sex" data-error="Please indicate your sex." required>
								@if($employee[0]->sex=="F")
									<option>Male</option>
									<option selected>Female</option>
								@elseif($employee[0]->sex=="M")
									<option selected>Male</option>
									<option>Female</option>
								@else
									<option selected disabled></option>
									<option name="Female" value="Female" @if (Input::old('sex') == 'Female') selected="selected" @endif>Female</option>
									<option name="Male" value="Male" @if (Input::old('sex') == 'Male') selected="selected" @endif>Male</option>
								@endif
							</select>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Birthdate</label>
						<div class="col-sm-7">
							<input class="form-control" name="birthdate" id="birthdate" type="date" value="{{( old('birthdate') == 'NULL')? $employee[0]->birthdate : old('birthdate')}}" data-error="Please provide a valid date." required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Contact Number</label>
						<div class="col-sm-7">
							<input class="form-control" name="contactNumber" id="contactNumber" type="text" value="{{(old('contactNumber') == '')? $employee[0]->contactNum : old('contactNumber')}}" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Email Address</label>
						<div class="col-sm-7">
							<input class="form-control" name="emailAddress" id="emailAddress" type="email" value="{{($employee[0]->emailAddress != '')? $employee[0]->emailAddress : old('emailAddress')}}" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Current Address</label>
						<div class="col-sm-7">
							<textarea class="form-control" name="currentAddress" id="currentAddress" value="{{$employee[0]->currentAddress}}" data-minlength="5" required>{{{($employee[0]->currentAddress != '')? $employee[0]->currentAddress : old('currentAddress')}}}</textarea>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Permanent Address</label>
						<div class="col-sm-7">
							<textarea class="form-control" name="permanentAddress" id="permanentAddress"  value="{{$employee[0]->permanentAddress}}" data-minlength="5" required>{{{($employee[0]->permanentAddress != '')? $employee[0]->permanentAddress : old('permanentAddress')}}}</textarea>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					@if($employee[0]->type == 1)
					<div class="form-group">
						<label class="col-sm-3 control-label">Degree</label>
						<div class="col-sm-7">
							<select class="form-control" name="degree" id="degree" data-error="Please select a degree." required>
								@if($employee[0]->degree != '')
									@foreach($degrees as $d)
										@if($d->degree == $employee[0]->degree)
											<option selected>{{ $d->degree }}</option>
										@else
											<option>{{ $d->degree }}</option>
										@endif
									@endforeach
								@else
									@foreach($degrees as $d)
										<option value="{{ $d->degree }}" @if (Input::old('degree') == $d->degree) selected="selected" @endif>{{ $d->degree }}</option>
									@endforeach
								@endif
							</select>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Specialization</label>
						<div class="col-sm-7">
							<select class="form-control" name="specialization" id="specialization"  data-error="Please select a specialization." required>
								@if($employee[0]->specialization != '')	
									@foreach($specializations as $s)
										@if($s->specialization == $employee[0]->specialization)
											<option selected>{{ $s->specialization }}</option>
										@else
											<option>{{ $s->specialization }}</option>
										@endif
									@endforeach
								@else
									@foreach($specializations as $s)
										<option value="{{ $s->specialization }}"  @if (Input::old('specialization') == $s->specialization) selected="selected" @endif>{{ $s->specialization }}</option>
									@endforeach
								@endif
							</select>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Year Graduated</label>
						<div class="col-sm-7">
							<input class="form-control" name="yearGraduated" id="number" type="number" value="{{($employee[0]->yearGraduated != '')? $employee[0]->yearGraduated : old('yearGraduated')}}" maxlength="4" data-minlength="4" pattern="^[0-9]*" data-error="Please input a year." required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">School Graduated From</label>
						<div class="col-sm-7">
							<input class="form-control" name="school" id="school" type="text" value="{{($employee[0]->schoolGraduated != '')? $employee[0]->schoolGraduated : old('school')}}" data-minlength="4" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					@endif
					<div class="form-group">
						<div class="col-sm-10">&nbsp;</div>
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