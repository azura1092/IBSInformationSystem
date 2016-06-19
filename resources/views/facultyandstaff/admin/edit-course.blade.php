@extends('facultyandstaff.admin.dash-admin')

@section('content')

	@if($status)

		<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Successfully edited course!
    	</div>

	@endif


	<div class="row">
		<div class="col-xs-12">
			<h3>Edit Course</b></h3>
			<hr></hr>
		</div>
	</div>
				
	<div class="update-section">
		<div class="row">
			<div class="col-xs-12">
				<form class="form-horizontal" method="POST" action="{{ url('/edit-course-selected') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="search_param" value="all" id="search-param">								
					
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Select Course</label>
						<div class="col-sm-7">
							<select class="form-control" name="courseNum" id="course-getter" required>
								<option disabled selected></option>
								@foreach($courses as $c)
									<option value="{{ $c->courseNum }}">{{ $c->courseNum }} - {{ $c->courseTitle }}</option>
								@endforeach
							</select>
						</div>

						<div class="col-sm-2">
							<button class="btn btn-success" type="submit">Submit</button>
						</div>
					</div>
								
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				@if($s == 1)
				<form class="form-horizontal" method="POST" action="{{ url('/processEditCourse') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="courseNum" id="courseNum" value="{{ $courses[0]->courseNum }}">								

					<div class="form-group">
						<label class="col-sm-3 control-label">Course Number</label>
						<div class="col-sm-7">
							<input class="form-control" name="courseNum" id="courseNum" type="text" value="{{$courseSelected[0]->courseNum}}" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Course Title</label>
						<div class="col-sm-7">
							<input class="form-control" name="courseTitle" id="courseTitle" type="text" value="{{$courseSelected[0]->courseTitle}}" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Classification</label>
						<div class="col-sm-7">
							<select class="form-control" name="classification" id="classification" required>
								@if($courseSelected[0]->classification == 'Undergraduate')
									<option selected>Undergraduate</option>
									<option>Gradute</option>
								@else
									<option>Undergraduate</option>
									<option selected>Gradute</option>
								@endif
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Number of Units</label>
						<div class="col-sm-7">
							<input class="form-control" name="numOfUnits" id="numOfUnits" type="number" min="1" max="5" value="{{$courseSelected[0]->numOfUnits}}" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Prerequisite</label>
						<div class="col-sm-7">
							<input class="form-control" name="prerequisite" id="prerequisite" type="text" value="{{$courseSelected[0]->prerequisite}}" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Semester(s) Offered</label>
						<div class="col-sm-7">
							<input class="form-control" name="semOffered" id="semOffered" type="text" value="{{$courseSelected[0]->semOffered}}" placeholder="Separate using commas e.g. 1,2,S" required>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-success btn-block">Save</button>
						</div>
					</div>
				</form>

				@endif
			</div>
		</div>
	</div>
	

@endsection
