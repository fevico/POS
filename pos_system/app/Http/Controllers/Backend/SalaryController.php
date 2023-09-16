<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use App\Models\PaySalary;
use Carbon\Carbon;

class SalaryController extends Controller
{
    //
    public function AddAdvanceSalary(){
        $employee = Employee::latest()->get();
        return view('backend.salary.add_advance_salary', compact('employee'));
    }

    public function AdvanceSalaryStore(Request $request){
        $validate = $request->validate([
            'month' => 'required',
            'year' => 'required',
        ]);

        $month = $request->month;
        $employee_id = $request->employee_id;
        $advance = AdvanceSalary::where('month', $month)->where('employee_id', $employee_id)->first();
        if($advance === NULL){
            AdvanceSalary::insert([
             'employee_id' => $request->employee_id,    
             'month' => $request->month,    
             'year' => $request->year,    
             'advance_salary' => $request->advance_salary,    
             'created_at' => Carbon::now(),    
            ]);
            $notification = array(
                'message' => 'Advance Salaray Paid Successfully',
                'alert-type' => 'success'
                 ); 
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'message' => 'Advance Already Paid',
                'alert-type' => 'warning'
                 ); 
            return redirect()->route('all-advance-salary')->with($notification);
        }
    }

    public function AllAdvanceSalary(){
        $salary = AdvanceSalary::latest()->get();
        return view('backend.salary.all_advance_salary', compact('salary'));
    }

    public function EditAdvanceSalary($id){
        $employee = Employee::latest()->get();
        $salary = AdvanceSalary::findOrFail($id);
        return view('backend.salary.edit_advance_salary', compact('salary', 'employee'));
    }

 public function AdvanceSalaryUpdate(Request $request){
    $slary_id = $request->id;
    AdvanceSalary::findOrFail($slary_id)->update([
        'employee_id' => $request->employee_id,    
        'month' => $request->month,    
        'year' => $request->year,    
        'advance_salary' => $request->advance_salary,    
        'created_at' => Carbon::now(),    
       ]);
       $notification = array(
           'message' => 'Advance Salaray Updated Successfully',
           'alert-type' => 'success'
            ); 
       return redirect()->route('all-advance-salary')->with($notification);
 }

 public function PaySalary(){
    $employee = Employee::latest()->get();
    return view ('backend.salary.pay_salary', compact('employee'));
 }

 public function PayNow($id){
    $paysalary = Employee::findOrFail($id);
    return view('backend.salary.paid_salary', compact('paysalary'));
 }

 public function EmployeeSalaryStore(Request $request){
     $employee_id = $request->id;
     PaySalary::insert([
         'employee_id' => $employee_id,
         'salary_month' => $request->salary_month,
         'paid_ammount' => $request->paid_ammount,
         'advance_salary' => $request->advance_salary,
         'due_salary' => $request->due_salary,
         'created_at' => Carbon::now(),
     ]);
     $notification = array(
        'message' => 'Employee Salaray Paid Successfully',
        'alert-type' => 'success'
         ); 
    return redirect()->route('pay-salary')->with($notification);
 }

 public function MonthSalary(){
     $paid_salary = PaySalary::latest()->get();
     return view('backend.salary.month_salary', compact('paid_salary'));
 }

}
