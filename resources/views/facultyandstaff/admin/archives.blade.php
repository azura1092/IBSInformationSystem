@extends('facultyandstaff.admin.dash-admin')

@section('content')

	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>ARCHIVED PROFILES</b>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><b>Employee Number</b></th>
                                    <th><b>First Name</b></th>
                                    <th><b>Last Name</b></th>
                                    <th><b>Type</b></th>
                                    <th><b>Retrieve</b></th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($archives as $a)
                            		<tr>
                            			<td>{{ $a->employeeNum }}</td>
                            			<td>{{ $a->firstName }}</td>
                            			<td>{{ $a->lastName }}</td>
                            			<td>{{ $a->type }}</td>
                            			<td>
                            				<form method="POST" action="{{ url('/retrieve-archive') }}">
                            					<input type="hidden" name="_token" value="{{ csrf_token() }}">
                            					<input type="hidden" name="employeeNum" value="{{ $a->employeeNum }}">
                            					<button type="button" id="confirm-retrieve-button" class="btn btn-success btn-block" data-toggle="modal" data-id="{{ $a->employeeNum }} {{ $a->firstName }} {{ $a->lastName }}" data-target="#confirm-retrieve-modal">
                                                    Retrieve
                                                </button>
                            				</form>
                            			</td>
                            		</tr>
                            	@endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>

    <!-- Retrieve Archive Confirmation Modal -->
    <div class="modal fade" id="confirm-retrieve-modal" tab-index="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="modal-title">Confirm Retrieve Archive</div>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <form class="search-result-btns" method="POST" action="">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input class="getter" type="hidden" name="employeeNum" value="">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="retrieve-archive-button" class="btn btn-success">Retrieve</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection