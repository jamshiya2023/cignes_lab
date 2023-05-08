<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Labunit;

class LabUnitController extends Controller
{
    public function labunitview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $labunits = Labunit::select('id','labunit_name','labunit_name_arabic','status')
            ->orderBy('id','desc')
            ->get();
            //return view('master_labunit');
            return view('master_lab_unit', ['labunits' => $labunits]);
        }
        return redirect("/")->withError('You do not have access');
    }


    public function labunitadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $labunit = new Labunit;
            $labunit->labunit_name = $request->input('labunitname');
            $labunit->labunit_name_arabic = $request->input('arabiclabunitname');
            $labunit->status = '1';
            $labunit->staffid = $userId;
            $labunit->branchid = '0';        
            $labunit->save();
            return redirect("lab-unit")->withSuccess('Lab unit added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }

    public function editlabunitview(Request $request)
    {         
       $id = $request->id;
       $labunit = Labunit::where('id',$id)
                ->select('id','labunit_name','labunit_name_arabic')
                ->first();
       return Response($labunit);
    }

    public function labunitedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $labunit = Labunit::find($id);
        $labunit->labunit_name = $request->input('labunitnameedit');
        $labunit->labunit_name_arabic = $request->input('arabiclabunitnameedit');        
        $labunit->update();
        return redirect("lab-unit")->withSuccess('Lab unit updated successfully');    
    }

    // BLOCKING AND UNBLOCKING LAB UNIT STARTS HERE
    public function block(Request $request, $id)
    {
        $labunit = Labunit::find($id);
        $labunit->status = '0';        
        $labunit->update();
        return redirect("lab-unit")->withSuccess('Lab unit blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $labunit = Labunit::find($id);
        $labunit->status = '1';        
        $labunit->update();
        return redirect("lab-unit")->withSuccess('Lab unit unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING LAB UNIT ENDS HERE 
}
