@extends('alumni')

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
        @foreach($addRecord as $row)
                    <tr>
                        <td>{{$row->logId}}</td>
                        <td>{{$row->userNum}}</td>
                        <td>Employee {{$row->userNum}} added a graduate record.</td>
                        <td>{{$row->created_at}}</td>
                        <td>{{$ipaddress}}</td>
                    </tr>
        @endforeach
        @foreach($editRecord as $row)
                    <tr>
                        <td>{{$row->logId}}</td>
                        <td>{{$row->userNum}}</td>
                        <td>Employee {{$row->userNum}} edited a graduate record.</td>
                        <td>{{$row->created_at}}</td>
                        <td>{{$ipaddress}}</td>
                    </tr>
        @endforeach
        @foreach($deleteRecord as $row)
                    <tr>
                        <td>{{$row->logId}}</td>
                        <td>{{$row->userNum}}</td>
                        <td>Employee {{$row->userNum}} deleted a graduate record.</td>
                        <td>{{$row->created_at}}</td>
                        <td>{{$ipaddress}}</td>
                    </tr>
        @endforeach
        @foreach($addStaff as $row)
                    <tr>
                        <td>{{$row->logId}}</td>
                        <td>{{$row->userNum}}</td>
                        <td>Employee {{$row->userNum}} added a staff record.</td>
                        <td>{{$row->created_at}}</td>
                        <td>{{$ipaddress}}</td>
                    </tr>
        @endforeach
        @foreach($addFaculty as $row)
                    <tr>
                        <td>{{$row->logId}}</td>
                        <td>{{$row->userNum}}</td>
                        <td>Employee {{$row->userNum}} added a faculty record.</td>
                        <td>{{$row->created_at}}</td>
                        <td>{{$ipaddress}}</td>
                    </tr>
        @endforeach
        @foreach($addCourse as $row)
                    <tr>
                        <td>{{$row->logId}}</td>
                        <td>{{$row->userNum}}</td>
                        <td>Employee {{$row->userNum}} added a course.</td>
                        <td>{{$row->created_at}}</td>
                        <td>{{$ipaddress}}</td>
                    </tr>
        @endforeach
        @foreach($editStaff as $row)
                    <tr>
                        <td>{{$row->logId}}</td>
                        <td>{{$row->userNum}}</td>
                        <td>Employee {{$row->userNum}} updated an employee record.</td>
                        <td>{{$row->created_at}}</td>
                        <td>{{$ipaddress}}</td>
                    </tr>
        @endforeach
        @foreach($editCourse as $row)
                    <tr>
                        <td>{{$row->logId}}</td>
                        <td>{{$row->userNum}}</td>
                        <td>Employee {{$row->userNum}} updated a course.</td>
                        <td>{{$row->created_at}}</td>
                        <td>{{$ipaddress}}</td>
                    </tr>
        @endforeach
        @foreach($deleteStaff as $row)
                    <tr>
                        <td>{{$row->logId}}</td>
                        <td>{{$row->userNum}}</td>
                        <td>Employee {{$row->userNum}} deleted an employee record.</td>
                        <td>{{$row->created_at}}</td>
                        <td>{{$ipaddress}}</td>
                    </tr>
        @endforeach
        @foreach($deleteCourse as $row)
                    <tr>
                        <td>{{$row->logId}}</td>
                        <td>{{$row->userNum}}</td>
                        <td>Employee {{$row->userNum}} deleted course.</td>
                        <td>{{$row->created_at}}</td>
                        <td>{{$ipaddress}}</td>
                    </tr>
        @endforeach
        @foreach($archive as $row)
                    <tr>
                        <td>{{$row->logId}}</td>
                        <td>{{$row->userNum}}</td>
                        <td>Employee {{$row->userNum}} archived an employee record.</td>
                        <td>{{$row->created_at}}</td>
                        <td>{{$ipaddress}}</td>
                    </tr>
        @endforeach
        @foreach($uploadBulk as $row)
                    <tr>
                        <td>{{$row->logId}}</td>
                        <td>{{$row->userNum}}</td>
                        <td>Employee {{$row->userNum}} uploaded a bulk of data.</td>
                        <td>{{$row->created_at}}</td>
                        <td>{{$ipaddress}}</td>
                    </tr>
        @endforeach
</tbody>
        </table>

@endsection    

