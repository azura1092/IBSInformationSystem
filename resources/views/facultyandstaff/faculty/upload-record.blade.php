@extends('facultyandstaff.faculty.dash-faculty')

@section('content')

	@if($status)
	
		<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $message }}
    	</div>

	@endif

    <div class="row">
        <div class="col-xs-12">
            <h3>Upload File</h3>
            <hr></hr>
        </div>
    </div>

	<form action="{{ url('/process-upload-faculty-record') }}" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
    	<div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-file">
                    <i class="fa fa-folder-open"></i> Browse&hellip; 
                    <input type="file" class="upload"  name="fileToUpload" id="fileToUpload" required>
                </span>
            </span>
            <input type="text" class="form-control" placeholder="Choose a file to upload" readonly>
        </div>
        <br>
		<button type="submit" class='btn btn-default pull-right' value="Upload File" name="submit"><i class="fa fa-upload"></i> Upload</button>
	</form>

@endsection