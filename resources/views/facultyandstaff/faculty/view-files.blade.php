@extends('facultyandstaff.faculty.dash-faculty')

@section('content')

	@if(count($fileRecords) == 0)
		<h1>No files uploaded yet</h1>

	@else

	<div class="row">
		<div class="col-xs-12">
			<div id="view-files" class="panel panel-default">
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<td><h4>Uploaded Files</h4></td>
							</tr>
						</thead>
						<tbody>
							@foreach($fileRecords as $f)
								<tr>
									<td class="col-xs-12">
										<div class="row">
										<form method="post" action="{{ url('/processDeleteFile') }}">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="fileName" id="fileName" value="{{ $f->fileName }}">
											<input type="hidden" name="fileID" id="fileID" value="{{ $f->id }}">

											<div class="col-xs-1"><button type="submit" class="btn btn-danger btn-block"> x </button></div>
										</form>	
											<div class="col-xs-2"><button type="btn" class="btn btn-success btn-block" onclick="viewFile('{{ $f->employeeNum }} - {{ $f->fileName }}')"> View File </button></div>
											<div class="col-xs-8"><p>{{ $f->fileName }}</p></div>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
						
					</table>
				</div>
			</div>
		</div>
	</div>
	@endif

	<script type="text/javascript">
		function viewFile(p){
			window.open("/get-faculty-file-" + p);
		}
	</script>

@endsection