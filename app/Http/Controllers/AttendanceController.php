<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee_Attendance;
use Illuminate\Http\Request;


class AttendanceController extends Controller
{
    public function index(){
        $emp_attendance = Employee_Attendance::select('employee_status')->get();
        $attendance = Attendance::select('id','date','status')->get();
        return view('attendance.index',[
        'attendances'=>$attendance,
        'emp_attendance'=>$emp_attendance,
    ]);
    }
    public function create(Request $request){
        return $request;
       Attendance::newAttendance($request);
        return back()->with('message', 'Attendance created successfully.');
    }

    public function update(Request $request,$id){
        return $request;
        Attendance::updateAttendance($request,$id);
        return redirect(route('employee.manage'))->with('message', 'Employee Updated successfully.');
    }

    public function view($id){
        $date =Attendance::find($id);
        $employee_attendance = Employee_Attendance::where('attendance_id',$id)->get();
        return view('attendance.view',[
            'employee_attendances'=>$employee_attendance,
            'date'=>$date
        ]);
    }
    public function delete($id){
        Attendance::deleteAttendance($id);
        return back()->with('message', 'Attendance Deleted successfully.');
    }
}
