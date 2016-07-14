@extends('facultyandstaff.admin.dash-admin')


@section('content')

	<div class="container-fluid">
  		<div class="row">
  			<legend><h2>Course Offering</h2></legend>

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
  			@if(count($course)<1)
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
<!-- //===========================-->
 								<th>
 								    <select name="selectMajor" style="border: none;
    								background-color: #a9c056;">
							        <option selected="selected"> Major </option>
							        <option>major 1</option>
							        <option>major 2</option>
							    	</select>
								</th>

 								<th>
 								    <select name="selectYear" style="border: none;
    								background-color: #a9c056;">
							        <option selected="selected"> Year </option>
							        <option>sample1</option>
							        <option>sample2</option>
							    	</select>
								</th>
<!-- //===========================-->

								<th>Options</th>								
							</tr>
						</thead>
					
				<div class ="center">
					<!-- {!! $graduates->render() !!} -->
				</div>
			@endif
			</tbody>
		</table>
		</div>
		
		
	</div>
	</div>

@endsection