@extends('facultyandstaff.admin.dash-admin')

@section('content')
    <br>
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

    <legend><h2>Upload Bulk Data</h2></legend>
    <form action="{{ url('/process-employee-upload-bulk-data') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-file">
                        <i class="fa fa-folder-open"></i> Browse&hellip; <input type="file" class="upload"  name="fileToUpload" id="fileToUpload" required>

                    </span>
                </span>
                <input type="text" class="form-control" readonly>
            </div>
            <br>
        <button type='submit' class='btn btn-default pull-right' value="Upload CSV File" name="submit"><i class="fa fa-upload"></i> Upload</button>
    </form>
    

@endsection