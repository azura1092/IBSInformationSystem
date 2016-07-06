@extends('facultyandstaff.admin.dash-admin')

@section('content')

	@if($status == 1)

		<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Successfully edited course!
    	</div>


	@elseif($status == 2)

		<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Successfully deleted course!
    	</div>

	@endif

	<div class="row">
		<div class="col-xs-12">
			<h3>Update Course Details</b></h3>
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
							<button class="btn btn-success" type="submit" name="edit" value="edit">Search</button>
						</div>

					</div>
								
				</form>
			</div>
		</div>
	</div>

	@if($s == 1)

	<div class="row">
		<div class="col-xs-12">
			<h3>{{{$courseSelected[0]->courseNum}}} - {{{$courseSelected[0]->courseTitle}}}</b></h3>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
			<form class="form-horizontal" method="POST" action="{{ url('/processEditCourse') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="courseNum" id="courseNum" value="{{ $courses[0]->courseNum }}">								

				<div class="form-group">
					<label class="col-sm-3 control-label">Course Number</label>
					<div class="col-sm-7">
						<input class="form-control" name="courseNum" id="course_num" type="text" value="{{$courseSelected[0]->courseNum}}" required>
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
						<input class="form-control" name="prerequisite" id="prerequisite" type="text" value="{{$courseSelected[0]->prerequisite}}" >
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-3 control-label">Semester(s) Offered</label>
					<div class="col-sm-7">
						<input class="form-control" name="semOffered" id="semOffered" type="text" value="{{$courseSelected[0]->semOffered}}" placeholder="Separate using commas e.g. 1,2,S" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-12">
						&nbsp
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-2">
						&nbsp
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-4">
						<button type="submit" class="btn btn-success btn-block" name="edit" value="edit">Save Edit</button>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-4">
						<button class="btn btn-danger btn-block" id="delete-course-btn" type="button" data-toggle="modal" data-target="#validate-delete">Delete Course</button>
					</div>
				</div>

				<div class="modal fade" id="validate-delete" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body" id="delete-modal-body"></div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
								<button type="submit" class="btn btn-danger" name="delete" value="delete">Delete</button>
							</div>
						</div>
					</div>
				</div>	

			</form>

		</div>
	</div>


	@endif
	

@endsection
