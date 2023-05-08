<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Designation;
use DB;
class DepartmentController extends Controller
{
    // Authentication checking for access and view department listing page
    
    public function viewdepartment()
    {
        if(Auth::check()){
            $departments = Department::select('departments.*','designation.designation_name','designation.id as designationid','designation.status as designationstatus')
            ->join('designation', 'designation.department_id', '=', 'departments.id')
            ->get();
            return view('departments', ['departments' => $departments]);
        }
        return redirect("/")->withError('You do not have access');
    }
    
    // Authentication checking for access and view add department page
    public function viewadddepartment()
    {
        if(Auth::check()){
           $department_data = Department::select('*')->get();
           return view('adddepartment',compact('department_data'));
        }
        return redirect("/")->withError('You do not have access');
    }

    // Store datas to database
    public function adddepartment(Request $request)
    {
        
        if($request->input('addtype') =='addnew') 
        {
            $department = new Department;
            $department->department_name = $request->input('department');
            $department->status = '1';
            $department->save();
            $departmentlastid = $department->id;

            $designation = new Designation;
            $designation->department_id = $departmentlastid;
            $designation->designation_name = $request->input('designation');
            $designation->status = '1';
            $designation->save();
            return redirect("departments")->withSuccess('Department/Designation added successfully');
        } else {
            $designation = new Designation;
            $designation->department_id = $request->input('addtype');
            $designation->designation_name = $request->input('designation');
            $designation->status = '1';
            $designation->save();
            return redirect("departments")->withSuccess('Designation added successfully');
        }
        
    }

    public function editdepartment($id)
    {
        if(Auth::check()){
            $designation = Designation::join('departments', 'designation.department_id', '=', 'departments.id')
               ->where('designation.id', $id)
               ->first(['designation.*','departments.department_name']);
        return view('editdepartment', compact('designation'));
         }
         return redirect("/")->withError('You do not have access');
    }


    public function updatedepartment(Request $request, $id)
    {
        $designation = Designation::find($id);
        $designation->designation_name = $request->input('designation');        
        $designation->update();
        return redirect("departments")->withSuccess('Designation updated successfully');
    }

    public function blockdesignation(Request $request, $id)
    {
        $designation = Designation::find($id);
        $designation->status = '0';        
        $designation->update();
        return redirect("departments")->withSuccess('Designation blocked successfully');
    }

    public function unblockdesignation(Request $request, $id)
    {
        $designation = Designation::find($id);
        $designation->status = '1';        
        $designation->update();
        return redirect("departments")->withSuccess('Designation unblocked successfully');
    }
}
