<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee_Attendance;

class Attendance extends Model
{
    use HasFactory;
    public static $attendance,$emp_attendance;
    public static function newAttendance($request){
        $attendance_id = Attendance::insertGetId([
            'date' => $request->date,
            'status' => $request->status,
        ]);
        foreach ($request->employee_id as $key => $id){
            Employee_Attendance::insert([
                'attendance_id'=> $attendance_id,
                'employee_id'=> $request->employee_id[$key],
                'employee_status'=> $request->employee_status[$key]
            ]);
        }
    }
    public static function deleteAttendance($id)
    {
        self::$attendance = Attendance::where('id',$id)->delete();
        self::$attendance = Employee_Attendance::where('attendance_id',$id)->delete();
    }
}
