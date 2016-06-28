@extends('facultyandstaff.admin.dash-admin')

@section('content')

    <legend><h2>User Logs</h2></legend>

    <table class="table table-hover">
        <thead style="background-color: #a9c056; color: #fff;">
            <tr>
                <th>Log ID</th>
                <th>Employee ID</th>
                <th>Transaction</th>
                <th>Timestamp</th>
                <th>IP Address</th>                                
            </tr>
        </thead>

        @foreach($logs as $row)
            <tr>
                <td>{{$row->logId}}</td>
                <td>{{$row->userNum}}</td>
                <td>{{$row->message}}</td>
                <td>{{$row->created_at}}</td>
                <td>{{$ipaddress}}</td>
            </tr>
        @endforeach
</tbody>
        </table>

@endsection    

