@extends('facultyandstaff.admin.dash-admin')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>GENERATE REPORT</b>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><b>Reports</b></th>
                                    <th><b>Generate</b></th>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr>
                            		<td>List of All Faculty and Staff</td>
                            		<td>
                            			<a href="generate-1">
	                            			<button type="button" class="btn btn-success btn-block" >
	                                            Generate
	                                        </button>
                                    	</a>
                                    </td>
                            	</tr>
                            	<tr>
                            		<td>List of All Faculty</td>
                            		<td>
                            			<a href="generate-2">
	                            			<button type="button" class="btn btn-success btn-block" >
	                                            Generate
	                                        </button>
                                    	</a>
                                    </td>
                            	</tr>
                            	<tr>
                            		<td>List of All Faculty Classified Per Division</td>
                            		<td>
                            			<a href="generate-3">
	                            			<button type="button" class="btn btn-success btn-block" >
	                                            Generate
	                                        </button>
                                    	</a>
                                    </td>
                            	</tr>
                            	<tr>
                            		<td>List of All Faculty Classified Per Position</td>
                            		<td>
                            			<a href="generate-4">
	                            			<button type="button" class="btn btn-success btn-block" >
	                                            Generate
	                                        </button>
                                    	</a>
                                    </td>
                            	</tr>
                            	<tr>
                            		<td>List of All Staff</td>
                            		<td>
                            			<a href="generate-5">
	                            			<button type="button" class="btn btn-success btn-block" >
	                                            Generate
	                                        </button>
                                    	</a>
                                    </td>
                            	</tr>
                            </tbody>
                        </table>
                	</div>
                <!-- /.table-responsive -->
            	</div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>

@endsection