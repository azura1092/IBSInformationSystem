@extends('facultyandstaff.admin.dash-admin')

@section('content')

	@if($status)
	
		<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $message }}
    	</div>

	@endif

	<form action="{{ url('/process-upload-record') }}" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		Select file to upload:<br/><br/>
    	<div class="fileUpload btn btn-primary">
    		<span>Choose file</spam>
		    <input type="file" class="upload" name="fileToUpload" id="fileToUpload" required>
		</div>
		<button type='submit' class='btn btn-default' value="Upload File" name="submit">Upload</button>
	</form>

@endsection