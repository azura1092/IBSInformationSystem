@extends('facultyandstaff.admin.dash-admin')

@section('content')

	<div class="row">
		<div class="col-xs-12">
			<h3>View Courses</b></h3>
			<hr></hr>
		</div>
	</div>
				
	<div class="update-section">
		<div class="row">
			<div class="col-xs-12">
				<form class="form-horizontal" method="POST" action="{{ url('/view-course-selected') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="search_param" value="all" id="search-param">								
					
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Select Course</label>
						<div class="col-sm-7">
							<select class="form-control" name="courseNum" id="course-getter" required>
								@foreach($courses as $c)
									@if($s==1)
										@if($c->courseNum ==  $courseSelected[0]->courseNum)
											<option value="{{ $c->courseNum }}" selected>{{ $c->courseNum }} - {{ $c->courseTitle }}</option>
										@else
											<option value="{{ $c->courseNum }}">{{ $c->courseNum }} - {{ $c->courseTitle }}</option>
										@endif
									@else
										<option value="{{ $c->courseNum }}">{{ $c->courseNum }} - {{ $c->courseTitle }}</option>
									@endif
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
				@if($s==1)	
					<div class="panel panel-success" style="margin-top: 25px;">
						<div class="panel-heading">
							{{ $courseSelected[0]->courseNum}} - {{ $courseSelected[0]->courseTitle }}
						</div>
						<div class="panel-body">
							<table class="table table-hover">
								<thead>
									<tr style="font-weight: bold; text-align: center;">
										<td>Section</td>
										<td>Units</td>
										<td>Lecture</td>
										<td>Lecturer</td>
										<td>Laboratory</td>
										<td>Instructor</td>
									</tr>
								</thead>
								<tbody>
									<tr style="text-align: center;">
										<td>B-1L</td>
										<td>3</td>
										<td>9-10 WF IBSLH Main</td>
										<td>TBA</td>
										<td>7-10 Mon BS C-116</td>
										<td>TBA</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="panel-footer">
							<h6 class="text-right text-muted">
								Units: {{ $courseSelected[0]->numOfUnits }} | 
								Classification: {{ $courseSelected[0]->classification }} 
								@if($courseSelected[0]->semOffered != "")
									| Semester Offered: {{ $courseSelected[0]->semOffered }}
								@endif
								@if($courseSelected[0]->prerequisite != "")
									| Prerequisite: {{ $courseSelected[0]->prerequisite }}
								@endif
							</h6>
						</div>
					</div>	
				@endif
			</div>
		</div>
	</div>
@endsection

