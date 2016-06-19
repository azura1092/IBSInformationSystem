@extends('facultyandstaff.admin.dash-admin')

@section('content')
	
	@if(count($editnotifs) == 0)
		<h1>No pending requests</h1>
	@else

	<div class="row">
		<div class="col-xs-12">
			<h3>Notifications</h3>
			<hr></hr>
		</div>
	</div>

	<div class="update-section">
		<div class="row">
			<div class="col-xs-12">
				<?php $i = 1; ?>
				@foreach($editnotifs as $e)
					<div class="alert alert-warning" role="alert">
						<a role="button" data-toggle="collapse" href="#notif-collapse-{{ $i }}" aria-expanded="false" style="color: inherit;">
							{{ $e->firstName }} {{ $e->lastName }} has made a request to edit basic profile information.
						</a>
					</div>
					<div class="collapse" id="notif-collapse-{{ $i }}">
						<div class="panel panel-default">
							<table class="table table-hover">
								<thead>
									<tr style="font-weight: bold; text-align: center;">
										<td>Category</td>
										<td>Current Information</td>
										<td>Requested Changes</td>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $u)
										@if($u->employeeNum == $e->employeeNum)
											
											<!-- category conditions -->
											@if($u->firstName != $e->firstName)	
											<tr style="text-align: center;">										
												<td>First Name</td>
												<td>
													@if($u->firstName == '')
														<em>No previous record</em>
													@else
														{{ $u->firstName }}
													@endif
												</td>
												<td>{{ $e->firstName }}</td>
											</tr>
											@endif

											@if($u->middleName != $e->middleName)	
											<tr style="text-align: center;">										
												<td>Middle Name</td>
												<td>
													@if($u->middleName == '')
														<em>No previous record</em>
													@else
														{{ $u->middleName }}
													@endif
												</td>
												<td>{{ $e->middleName }}</td>
											</tr>
											@endif

											@if($u->lastName != $e->lastName)	
											<tr style="text-align: center;">										
												<td>Last Name</td>
												<td>
													@if($u->lastName == '')
														<em>No previous record</em>
													@else
														{{ $u->lastName }}
													@endif
												</td>
												<td>{{ $e->lastName }}</td>
											</tr>
											@endif

											@if($u->position != $e->position)	
											<tr style="text-align: center;">										
												<td>Position</td>
												<td>
													@if($u->position == '')
														<em>No previous record</em>
													@else
														{{ $u->position }}
													@endif
												</td>
												<td>{{ $e->position }}</td>
											</tr>
											@endif

											@if($u->division != $e->division)	
											<tr style="text-align: center;">										
												<td>Division</td>
												<td>
													@if($u->division == '')
														<em>No previous record</em>
													@else
														{{ $u->division }}
													@endif
												</td>
												<td>{{ $e->division }}</td>
											</tr>
											@endif

											@if($u->sex != $e->sex)	
											<tr style="text-align: center;">										
												<td>Sex</td>
												<td>
													@if($u->sex == '')
														<em>No previous record</em>
													@else
														{{ $u->sex }}
													@endif
												</td>
												<td>{{ $e->sex }}</td>
											</tr>
											@endif

											@if($u->birthdate != $e->birthdate)	
											<tr style="text-align: center;">										
												<td>Birthdate</td>
												<td>
													@if($u->birthdate == '0000-00-00')
														<em>No previous record</em>
													@else
														{{ $u->birthdate }}
													@endif
												</td>
												<td>{{ $e->birthdate }}</td>
											</tr>
											@endif

											@if($u->contactNum != $e->contactNum)	
											<tr style="text-align: center;">										
												<td>Contact Number</td>
												<td>
													@if($u->contactNum == '')
														<em>No previous record</em>
													@else
														{{ $u->contactNum }}
													@endif
												</td>
												<td>{{ $e->contactNum }}</td>
											</tr>
											@endif

											@if($u->emailAddress != $e->emailAddress)	
											<tr style="text-align: center;">										
												<td>Email Address</td>
												<td>
													@if($u->emailAddress == '')
														<em>No previous record</em>
													@else
														{{ $u->emailAddress }}
													@endif
												</td>
												<td>{{ $e->emailAddress }}</td>
											</tr>
											@endif

											@if($u->currentAddress != $e->currentAddress)	
											<tr style="text-align: center;">										
												<td>Current Address</td>
												<td>
													@if($u->currentAddress == '')
														<em>No previous record</em>
													@else
														{{ $u->currentAddress }}
													@endif
												</td>
												<td>{{ $e->currentAddress }}</td>
											</tr>
											@endif

											@if($u->permanentAddress != $e->permanentAddress)	
											<tr style="text-align: center;">										
												<td>Permanent Address</td>
												<td>
													@if($u->permanentAddress == '')
														<em>No previous record</em>
													@else
														{{ $u->permanentAddress }}
													@endif
												</td>
												<td>{{ $e->permanentAddress }}</td>
											</tr>
											@endif

											@if($u->degree != $e->degree)	
											<tr style="text-align: center;">										
												<td>Degree</td>
												<td>
													@if($u->degree == '')
														<em>No previous record</em>
													@else
														{{ $u->degree }}
													@endif
												</td>
												<td>{{ $e->degree }}</td>
											</tr>
											@endif

											@if($u->specialization != $e->specialization)	
											<tr style="text-align: center;">										
												<td>Specialization</td>
												<td>
													@if($u->specialization == '')
														<em>No previous record</em>
													@else
														{{ $u->specialization }}
													@endif
												</td>
												<td>{{ $e->specialization }}</td>
											</tr>
											@endif

											@if($u->yearGraduated != $e->yearGraduated)	
											<tr style="text-align: center;">										
												<td>Year Graduated</td>
												<td>
													@if($u->yearGraduated == '')
														<em>No previous record</em>
													@else
														{{ $u->yearGraduated }}
													@endif
												</td>
												<td>{{ $e->yearGraduated }}</td>
											</tr>
											@endif

											@if($u->schoolGraduated != $e->schoolGraduated)	
											<tr style="text-align: center;">										
												<td>School Graduated</td>
												<td>
													@if($u->schoolGraduated == '')
														<em>No previous record</em>
													@else
														{{ $u->schoolGraduated }}
													@endif
												</td>
												<td>{{ $e->schoolGraduated }}</td>
											</tr>
											@endif
												
										@endif
									@endforeach
								</tbody>
							</table>

							<p style="margin-top: 25px; text-align: center">
								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#validate-approve-modal-{{ $i }}">Approve</button>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#validate-decline-modal-{{ $i }}">Decline</button>
							</p>

							<div class="modal fade" id="validate-approve-modal-{{ $i }}" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="modal-body">
											Are you sure you want to approve this request?
										</div>
										<div class="modal-footer">
											<form method="POST" action="{{ url('/processApproveEditRequest') }}">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="employeeNum" id="employeeNum" value="{{ $e->employeeNum }}">
												
												<button type="submit" class="btn btn-success">Approve Request</button>
											</form>
										</div>
									</div>
								</div>
							</div>

							<div class="modal fade" id="validate-decline-modal-{{ $i }}" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										</div>
										<div class="modal-body">
											Are you sure you want to decline this request?
										</div>
										<div class="modal-footer">
											<form method="POST" action="{{ url('/processDeclineEditRequest') }}">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												<input type="hidden" name="_token" value="{{ csrf_token() }}">
												<input type="hidden" name="employeeNum" id="employeeNum" value="{{ $e->employeeNum }}">

												<button type="submit" class="btn btn-danger">Decline Request</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php $i++; ?>
				@endforeach	
			</div>
		</div>
	</div>

	@endif

@endsection

