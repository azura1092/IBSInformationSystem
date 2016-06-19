@extends('facultyandstaff.admin.dash-admin')

@section('content')

	@if($status == 0)

		<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Course being added already exists!
    	</div>

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
				<form class="form-horizontal" method="POST" action="{{ url('/processAddCourse') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label class="col-sm-3 control-label">Course Number</label>
						<div class="col-sm-7">
							<input class="form-control" name="courseNum" id="courseNum" type="text" value="" placeholder="e.g. BIO 1" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Course Title</label>
						<div class="col-sm-7">
							<input class="form-control" name="courseTitle" id="courseTitle" type="text" value="" placeholder="e.g. General Biology I" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Classification</label>
						<div class="col-sm-7">
							<select class="form-control" name="classification" id="classification" required>
								<option selected disabled></option>
								<option name="Undergraduate" value="Undergraduate">Undergraduate</option>
								<option name="Graduate" value="Graduate">Graduate</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Number of Units</label>
						<div class="col-sm-7">
							<input class="form-control" name="numOfUnits" id="numOfUnits" type="number" value="" min="1" max="5" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Prerequisite</label>
						<div class="col-sm-7">
							<input class="form-control" name="prerequisite" id="prerequisite" type="text" value="" placeholder="e.g. PR. BIO 30">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Semester(s) Offered</label>
						<div class="col-sm-7">
							<div class="checkbox-inline">
								<input type="checkbox" id="semOffered1" name="semOffered1" value="1">1st sem
							</div>
							<div class="checkbox-inline">
								<input type="checkbox" id="semOffered2" name="semOffered2" value="2">2nd sem
							</div>
							<div class="checkbox-inline">
								<input type="checkbox" id="semOfferedS" name="semOfferedS" value="S">Summer/Midyear
							</div>
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