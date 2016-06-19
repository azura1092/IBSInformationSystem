@extends('facultyandstaff.admin.dash-admin')

@section('content')

	@if($status)

	<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ $message }}
	</div>

	@endif

	<div class="row">
		<div class="col-xs-12">
			<h3>{{ $user[0]->firstName }} {{ $user[0]->lastName}}</h3>
			<hr></hr>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12">

			<div id="view-profile" class="panel panel-default">
				<div class="panel-body">
					
					<table class="table table-hover">
						<p style="text-align: right; margin-bottom: 25px;">
							<form method="POST" action=" {{ url('/edit-employee') }} ">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="employeeNum" value="{{ $user[0]->employeeNum }}">
								<button type="submit" id="search-update-button" class="btn btn-default" style="position: absolute; top: 0; right: 15px; border-radius: 0;">
									Edit Profile
								</button>
							</form>
						</p>

						<thead>
							<tr>
								<td><h4><b>Basic Information</b></h4></td>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td class="col-xs-3">Employee Number</td>
								<td>{{ $user[0]->employeeNum }}</td>
							</tr>
						
							<tr>
								<td>First Name</td>
								<td>{{ $user[0]->firstName }}</td>
							</tr>
							<tr>
								<td>Middle Name</td>
								<td>{{ $user[0]->middleName }}</td>
							</tr>
							<tr>
								<td>Last Name</td>
								<td>{{ $user[0]->lastName }}</td>
							</tr>
						</tbody>
					</table>

					<table class="table table-hover">
						<tbody>
							<tr>
								<td class="col-xs-3">Sex</td>
								<td>
									@if($user[0]->sex == 'F')
										Female
									@elseif($user[0]->sex == 'M')
										Male
									@endif
								</td>
							</tr>
							<tr>
								<td>Birthday</td>
								<td>{{ $user[0]->birthdate }}</td>
							</tr>
							<tr>
								<td>Contact Number</td>
								<td>{{ $user[0]->contactNum }}</td>
							</tr>
							<tr>
								<td>Email Address</td>
								<td>{{ $user[0]->emailAddress }}</td>
							</tr>
							<tr>
								<td>Current Address</td>
								<td>{{ $user[0]->currentAddress }}</td>
							</tr>
							<tr>
								<td>Permanent Address</td>
								<td>{{ $user[0]->permanentAddress }}</td>
							</tr>
						</tbody>
					</table>

					<table class="table table-hover">
						<tbody>
							@if($user[0]->type != 2)
							<tr>
								<td class="col-xs-3">Position</td>
								<td>{{ $user[0]->position }}</td>
							</tr>
							@endif

							@if($user[0]->type == 1)
								<tr>
									<td>Division</td>
									<td>{{ $user[0]->division }}</td>
								</tr>
								<tr>
									<td>Degree</td>
									<td>{{ $user[0]->degree }}</td>
								</tr>
								<tr>
									<td>Specialization</td>
									<td>{{ $user[0]->specialization }}</td>
								</tr>
								<tr>
									<td>Year Graduated</td>
									<td>{{ $user[0]->yearGraduated }}</td>
								</tr>
								<tr>
									<td>School Graduated From</td>
									<td>{{ $user[0]->schoolGraduated }}</td>
								</tr>

							@endif
						</tbody>
					</table>

					<table class="table table-hover">
						<thead>
							<tr>
								<td><h4>Files</h4></td>
							</tr>
						</thead>
						<tbody>
							@foreach($fileRecords as $f)
								<tr>
									<td class="col-xs-12">
										<div class="row">
										<form method="post" onclick="viewFile('{{ $f->employeeNum }} - {{ $f->fileName }}')">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<div class="col-xs-2"><button type="submit" class="btn btn-success btn-block"> View File </button></div>
											<div class="col-xs-10"><p>{{ $f->fileName }}</p></div>
										</form>
										</div>
									</td>
								</tr>
							@endforeach

							@if(count($fileRecords) == 0)
								<tr>
									<td>
										<p style="font-style: italic;">No files uploaded yet</p>
									</td>
								</tr>
							@endif
						</tbody>
					</table>


				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function viewFile(p){
			window.open("/get-file-" + p);
		}
	</script>

@endsection