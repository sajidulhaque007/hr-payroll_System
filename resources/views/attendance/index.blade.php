@extends('admin.master')
@section('title')
    Attendance
@endsection
@section('body')
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            <i class="ri-check-line me-2"></i> {{ session('message') }}
        </div>
    @endif
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attendance">Add New</button>
    <hr>
    <div class="modal fade" id="attendance" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Create Attendance</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    @php $i=1 @endphp
                    <form class="ps-3 pe-3" action="{{ route('attendance.new') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input class="form-control" type="date" name="date" placeholder="Enter Date" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="status">
                                <option value="prepared">Prepared</option>
                                <option value="approved">Approved</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Employee Id/Name</th>
                                    <th>Attendance Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(employees() as $key =>  $employee)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>
                                            <div class="mb-3">
                                                <label class="form-label">{{ $employee->code }} |{{ $employee->name }}</label>
                                                <input class="form-control" type="hidden" name="employee_id[]" value="{{$employee->id}}" placeholder="Enter Date">
                                            </div>
                                        </td>
                                        <td>
{{--                                            <select class="form-select" name="employee_status[]">--}}
{{--                                                <option value="Absent">Absent</option>--}}
{{--                                                <option value="Attendanced">Attendanced</option>--}}
{{--                                                <option value="Leave">Leave</option>--}}
{{--                                                <option value="Govt-holiday">Govt Holiday</option>--}}
{{--                                            </select>--}}
                                            <div class="mb-3">
                                                    <input type="radio"  name="employee_status[{{$key}}]" value="Absent"> Absent &nbsp;
                                                    <input type="radio"  name="employee_status[{{$key}}]" value="Attendanced"> Attendanced &nbsp;
                                                    <input type="radio" name="employee_status[{{$key}}]" value="Leave"> Leave &nbsp;
                                                    <input type="radio" name="employee_status[{{$key}}]" value="Govt-holiday"> Govt-holiday &nbsp;
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3 text-center">
                            <button class="btn btn-primary" type="submit" onclick="return confirm('Ary you sure to submit this..');">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">All Attendance Information</h4>
                    <table id="datatable-buttons"  class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$attendance->date}}</td>
                                <td>{{$attendance->status}}</td>
                                <td>
                                    <a href="{{route('attendance.view', ['id' => $attendance->id])}}" class="btn btn-outline-dark
                                     btn-sm" title="View" >
                                        <i class=" ri-eye-line "></i>
                                    </a>
                                    <a href="{{route('attendance.delete', ['id' => $attendance->id])}}" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Ary you sure to delete this..');">
                                        <i class="ri-chat-delete-fill"></i>
                                    </a>
                                </td>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
