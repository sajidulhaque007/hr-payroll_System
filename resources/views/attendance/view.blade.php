@extends('admin.master')
@section('title')
    Attendance Date: {{ $date->date }}
@endsection
@section('body')
    <a href="{{route('attendance.add')}}" class="btn btn-outline-info">Back</a>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Attendance Date: <b>{{ $date->date }}</b></h4>
                    <table id="datatable-buttons"  class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Employee name</th>
                            <th>Attendance Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employee_attendances as $employee_attendance)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$employee_attendance->hasEmployee->name}}</td>
                                <td>{{$employee_attendance->employee_status}}</td>

                        @endforeach
                        </tbody>
                    </table>
                </div>  <!-- end card-body -->
            </div>  <!-- end card -->
        </div>  <!-- end col -->
    </div>

@endsection
