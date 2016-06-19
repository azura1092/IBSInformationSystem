@extends('facultyandstaff.admin.dash-admin')

@section('content')

	@if($status)

		<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Successfully deleted course!
    	</div>

	@endif


	<div class="row">
		<div class="col-xs-12">
			<h3>Delete Course</b></h3>
			<hr></hr>
		</div>
	</div>
				
	<div class="update-section">
		<div class="row">
			<div class="col-xs-12">
				<form class="form-horizontal" method="POST" action="{{ url('/processDeleteCourse') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="search_param" value="all" id="search-param">								
					
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Select Course</label>
						<div class="col-sm-7">
							<select class="form-control" name="courseNum" id="course-getter" required>
								@foreach($courses as $c)
									<option value="{{ $c->courseNum }}">{{ $c->courseNum }} - {{ $c->courseTitle }}</option>
								@endforeach
							</select>
						</div>

						<div class="col-sm-2">
							<button class="btn btn-danger" id="delete-course-btn" type="button" data-toggle="modal" data-target="#validate-delete">Delete</button>
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
									<button type="submit" class="btn btn-danger">Delete</button>
								</div>
							</div>
						</div>
					</div>								
				</form>
			</div>
		</div>
	</div>
@endsection

