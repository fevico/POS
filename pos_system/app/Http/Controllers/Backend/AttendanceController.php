<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //
    public function EmployeeAttendanceList(){
        $allData = Attendance::select('date')->groupBy('date')->orderBy('id','DESC')->get();
        return view('backend.attendance.employee_attendance', compact('allData'));
    }

    public function AddEmployeeAttendance(){
        $employees = Employee::all();
        return view('backend.attendance.add_employee_attendance', compact('employees'));
    }

    public function EmployeeAttendanceStore( Request $request){
        Attendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();
        
        $countemployee = count($request->employee_id);
        for($i=0; $i < $countemployee; $i++){
            $attendance_status = 'attend_status'.$i; 
            $attend = new Attendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attendance_status;
            $attend->save();
        }
        $notification = array(
            'message' => 'Data Inserted Succesfully',
            'alert-type' => 'success'
             ); 
        return redirect()->route('employee-attendance-list')->with($notification);
    }

    public function EmployeeAttendanceEdit($date){
        $employees = Employee::all();
        $editdata = Attendance::where('date',$date)->get();
        return view('backend.attendance.edit_employee_attend', compact('employees', 'editdata'));
    }

    public function EmployeeAttendanceView($date){
        $details = Attendance::where('date',$date)->get();
        return view('backend.attendance.details_employee_attend', compact('details'));  
    }
}
