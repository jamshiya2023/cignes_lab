<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tax;

class TaxController extends Controller
{
    public function listtax()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $taxes  = Tax::orderBy('id','desc')->get();
            return view('tax', ['taxes' => $taxes]);
        }
        return redirect("/")->withError('You do not have access');
    }

    public function viewaddtax()
    {
        if(Auth::check()){
            $userId = Auth::id();
            //dd($userId);
            //$staffdetails = Staff::select('staff.*', 'departments.department_name as departmentname', 'designation.designation_name as designationname')
             //   ->join('departments', 'departments.id', '=', 'staff.department_id')
             //   ->join('designation', 'designation.id', '=', 'staff.designation_id')
             //   ->get();
            //return view('staffs', compact('staffdetails'));
            return view('addtax');
        }
        return redirect("/")->withError('You do not have access');
    }


    public function addtax(Request $request)
    {
            $tax = new Tax;
            $tax->taxname = $request->input('taxname');
            $tax->taxrate = $request->input('taxrate');
            $tax->taxtype = $request->input('taxtype');
            $tax->status = '1';
            $tax->save();
            return redirect("tax")->withSuccess('Tax added successfully');
    }

    public function viewedittax($id)
    {
        if(Auth::check()){
            $tax = Tax::where('id', $id)->first();
        return view('edittax', compact('tax'));
         }
         return redirect("/")->withError('You do not have access');
    }



    public function edittax(Request $request, $id)
    { 
        $tax = Tax::find($id);
        $tax->taxname = $request->input('taxname');
        $tax->taxrate = $request->input('taxrate');
        $tax->taxtype = $request->input('taxtype');
        $tax->update();
        return redirect("tax")->withSuccess('Tax updated successfully');    
    }

    // BLOCKING AND UNBLOCKING TAX STARTS HERE
    public function blocktax(Request $request, $id)
    {
        $tax = Tax::find($id);
        $tax->status = '0';        
        $tax->update();
        return redirect("tax")->withSuccess('Tax blocked successfully');
    }

    public function unblocktax(Request $request, $id)
    {
        $tax = Tax::find($id);
        $tax->status = '1';        
        $tax->update();
        return redirect("tax")->withSuccess('Tax unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING TAX ENDS HERE 


}
