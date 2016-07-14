@extends('alumni')

@section('content')

	<div class="container-fluid">
  		<div class="row">
  			@if($status)
				<div class="alert alert-success alert-dismissable">
		            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		            Successfully deleted the record!
		    	</div>
			@endif
  			<legend><h2>Graduate Records</h2></legend>

  			<div class="row">					
				<!-- SEARCH -->
				<div class="col-xs-12">
					<div class="search-section">
					 	<form class="form-horizontal" method="POST" action="{{ url('/search-graduate-filter') }}">
						    <div class="input-group">
						      <div class="input-group-btn">
						        <button type="button" class="btn btn-search dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						          Search Filter <span class="caret"></span>
						        </button>
						        <ul class="dropdown-menu" role="menu">
									<li><a href="#">Major</a></li>
									<li><a href="#">Master of Science Degree</a></li>
									<li><a href="#">Year Graduated</a></li>
									<li><a href="#">Current Company</a></li>
									<li><a href="#">Last Name</a></li>
								</ul>
						      </div>
						      <input type="hidden" name="search_param" value="all" id="search-param">
							  <input type="hidden" name="_token" value="{{ csrf_token() }}">
						      <input type="text" id="input-getter" class="form-control" placeholder="Select search filter">
						      <span class="input-group-btn">
						        <button class="btn btn-search" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						      </span>
						    </div>
						</form>
  					</div>		
				<!-- /search -->
				</div>
  			@if(count($graduates)<1)
  				<div class="col-md-offset-3 col-md-6 col-md-offset-3">	
						<div class="row">
							<h1><i class="fa fa-archive" style="color: #ccc; font-size:100px;"></i><br><p style="color: #ccc;">No records yet.</p></h1>
						</div>
				</div>
  			@else
			<?php $i = 1?>
				  	<table class="table table-hover">
						<thead style="background-color: #a9c056; color: #fff;">
							<tr>
								<th>Name</th>
								<th>Major</th>
								<th>Year</th>							
							</tr>
						</thead>
					@foreach($graduates as $row)
							<tbody>
								<tr>
									<td><a href="#" data-toggle="modal" data-target="#myModal{{$i}}" style="padding:10px 10px;display:block;color:#000; text-decoration:none;">{{$row->lname}}, {{$row->fname}} {{$row->mname}}</a></td>
										<div id="myModal{{$i}}" class="modal fade" role="dialog">
											<div class="modal-dialog">

												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="modal-title">About {{$row->fname}} </h4>
													</div>
													<div class="col-md-12">
														<div class="col-md-2 tabs"> 
      													<br>
													      <ul class="nav">
													        <li class="active"><a href="#a{{$i}}" data-toggle="tab"><span class="fa fa-user"></span></a></li>
													        <li><a href="#b{{$i}}" data-toggle="tab"><span class="fa fa-map-marker"></span></a></li>
													        <li><a href="#c{{$i}}" data-toggle="tab"><span class="fa fa-graduation-cap"></span></a></li>
													        <li> <a href="#d{{$i}}" data-toggle="tab"><span class="fa fa-briefcase"></span></a></li>
													      </ul>
													    </div>

														<div class="tab-content" style="padding:15px;">
															<div id="a{{$i}}" class="tab-pane fade in active">
																<div class="col-md-10">
																	<ul class="list-group"><br>
																		<li class="list-group-item"><strong>Student Number:</strong> {{$row->studnum}}</li>
																		<li class="list-group-item"><strong>Name:</strong> {{$row->fname}} {{$row->mname}} {{$row->lname}} {{$row->suffix}}</li>
																		<li class="list-group-item"><strong>Birthdate:</strong> {{$row->bday}}</li>
																		<li class="list-group-item"><strong>Sex:</strong> {{$row->sex}}</li>
																	</ul>
																</div>
															</div>
															<div id="b{{$i}}" class="tab-pane fade">
																<div class="col-md-10">
																	<ul class="list-group"><br>
																		<li class="list-group-item"><strong>Contact Number:</strong> {{$row->contactnum}}</li>
																		<li class="list-group-item"><strong>Permanent Address:</strong> {{$row->permaddress}}</li>
																		<li class="list-group-item"><strong>Current Address:</strong> {{$row->curraddress}}</li>
																	</ul>
																</div>
															</div>
															<div id="c{{$i}}" class="tab-pane fade">
															  	<div class="col-md-10">
																	<ul class="list-group"><br>
																		<li class="list-group-item"><strong>Major:</strong> {{$row->major}}</li>
																		<li class="list-group-item"><strong>Master of Science Degree:</strong> {{$row->mscdegree}}</li>
																		<li class="list-group-item"><strong>Year Graduated:</strong> {{$row->yeargrad}}</li>
																		<li class="list-group-item"><strong>Honors and Awards Received:</strong> {{$row->honorsreceived}}</li>
																	</ul>
																</div>
															</div>
															<div id="d{{$i}}" class="tab-pane fade">
															  	<div class="col-md-10">
																	<ul class="list-group">
																		<li class="list-group-item"><strong>Name of Company/Institution:</strong> {{$row->companyname}}</li>
																		<li class="list-group-item"><strong>Current Position:</strong> {{$row->position}}</li>
																		<li class="list-group-item"><strong>Nature of Work:</strong> {{$row->natureofwork}}</li>
																		<li class="list-group-item"><strong>Addree:</strong> {{$row->companyaddress}}</li>
																		<li class="list-group-item"><strong>Country:</strong> {{$row->country}}</li>
																		<li class="list-group-item"><strong>Email Address:</strong> {{$row->companyemail}}</li>
																		<li class="list-group-item"><strong>Contact Number:</strong> {{$row->companycontactnum}}</li>

																	</ul>
																</div>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														
														<button type="button" id="search-confirm-del-button" class="btn btn-danger" data-toggle="modal" data-id="{{ $row->studnum }} {{ $row->fname }} {{ $row->mname }} {{ $row->lname }} {{ $row->suffix }}" data-target="#confirm-delete-modal"><i class="fa fa-minus"></i></button>			
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
									<td>{{$row->major}}</td>
									<td>{{$row->yeargrad}}</td>
								</tr>
				  	<?php $i=$i+1; ?>
					@endforeach
				<div class ="center">
					{!! $graduates->render() !!}
				</div>
			@endif
			</tbody>
		</table>
		</div>
		
		
	</div>
	</div>

@endsection