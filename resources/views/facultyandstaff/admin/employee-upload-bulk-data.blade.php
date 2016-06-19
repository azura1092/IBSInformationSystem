@extends('facultyandstaff.admin.dash-admin')

@section('content')

	@if($status == 0 || $status == 2)
		<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $message }}
    	</div>

	@elseif($status == 1)
		<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $message }}
    	</div>

	@endif

	@if($error != "")

		<div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ $error }}
    	</div>

	@endif

	<form action="{{ url('/process-employee-upload-bulk-data') }}" method="post" enctype="multipart/form-data">
    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
		Select csv file to upload:<br/><br/>
    	<div class="fileUpload btn btn-primary">
    		<span>Choose file</spam>
		    <input type="file" class="upload" name="fileToUpload" id="fileToUpload" required>
		</div>
		<button type='submit' class='btn btn-default' value="Upload CSV File" name="submit">Upload</button>
	</form>

@endsection