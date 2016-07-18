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
            Successfully added course!
    	</div>

	@endif

	<div class="row">				
		<div class="col-xs-12">
			<h3>Add Course</h3>
			<hr></hr>
		</div>
	</div>
				
	<div class="update-section">
		<div class="row">
			<div class="col-xs-12">
				<form class="form-horizontal" data-toggle="validator" method="POST" action="{{ url('/processAddCourse') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label class="col-sm-3 control-label">Course Number</label>
						<div class="col-sm-7">
							<input class="form-control" name="courseNum" id="courseNum" data-minlength="3" type="text" value="{{old('courseNum')}}" placeholder="e.g. BIO 1" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Course Title</label>
						<div class="col-sm-7">
							<input class="form-control" name="courseTitle" id="courseTitle" data-minlength="2" type="text" value="{{old('courseTitle')}}" placeholder="e.g. General Biology I" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Classification</label>
						<div class="col-sm-7">
							<select class="form-control" name="classification" id="classification" data-error="Please select a classification." required>
								<option selected disabled></option>
								<option name="Undergraduate" value="Undergraduate"  @if (Input::old('classification') == 'Undergraduate') selected="selected" @endif>Undergraduate</option>
								<option name="Graduate" value="Graduate"  @if (Input::old('classification') == 'Graduate') selected="selected" @endif>Graduate</option>
							</select>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Number of Units</label>
						<div class="col-sm-7">
							<input class="form-control" name="numOfUnits" id="numOfUnits" type="number" value="{{old('numOfUnits')}}" min="1" max="5" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Prerequisite</label>
						<div class="col-sm-7">
							<input class="form-control" name="prerequisite" id="prerequisite" type="text" value="{{old('prerequisite')}}" placeholder="e.g. PR. BIO 30" required>
							<div class="help-block">Input n/a if subject has no prerequisites.</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Semester(s) Offered</label>
						<div class="col-sm-7">
							<div class="checkbox-inline">
								<input type="checkbox" id="semOffered1" name="semOffered1" value="1" @if(old('semOffered1')=="1") checked @endif>1st sem
							</div>
							<div class="checkbox-inline">
								<input type="checkbox" id="semOffered2" name="semOffered2" value="2" @if(old('semOffered2')=="2") checked @endif>2nd sem
							</div>
							<div class="checkbox-inline">
								<input type="checkbox" id="semOfferedS" name="semOfferedS" value="S" @if(old('semOfferedS')=="S") checked @endif>Summer/Midyear
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-10">
							&nbsp;
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-3">
							<button type="submit" class="btn btn-success btn-block">Submit</button>
						</div>
					</div>
								
				</form>
	
			</div>
		</div>
	</div>

@endsection