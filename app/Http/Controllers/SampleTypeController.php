<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sampletype;

class SampleTypeController extends Controller
{
    public function sampletypeview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $sampletypes = Sampletype::select('id','sample_type_name','sample_type_name_arabic','status')
            ->orderBy('id','desc')
            ->get();
            //return view('master_sample_type');
            return view('master_sample_type', ['sampletypes' => $sampletypes]);
        }
        return redirect("/")->withError('You do not have access');
    }

    public function sampletypeadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $sampletype = new Sampletype;
            $sampletype->sample_type_name = $request->input('sampletypename');
            $sampletype->sample_type_name_arabic = $request->input('arabicsampletypename');
            $sampletype->status = '1';
            $sampletype->staffid = $userId;
            $sampletype->branchid = '0';        
            $sampletype->save();
            return redirect("sample-type")->withSuccess('Sample type added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }

    public function editsampleview(Request $request)
    {         
       $id = $request->id;
       $sampletype = Sampletype::where('id',$id)
                ->select('id','sample_type_name','sample_type_name_arabic')
                ->first();
       return Response($sampletype);
    }

    public function sampletypeedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $sampletype = Sampletype::find($id);
        $sampletype->sample_type_name = $request->input('sampletypenameedit');
        $sampletype->sample_type_name_arabic = $request->input('arabicsampletypenameedit');
        
        $sampletype->update();
        return redirect("sample-type")->withSuccess('Sample type updated successfully');    
    }

    // BLOCKING AND UNBLOCKING TAX STARTS HERE
    public function block(Request $request, $id)
    {
        $tax = Sampletype::find($id);
        $tax->status = '0';        
        $tax->update();
        return redirect("sample-type")->withSuccess('Sample type blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $tax = Sampletype::find($id);
        $tax->status = '1';        
        $tax->update();
        return redirect("sample-type")->withSuccess('Sample type unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING TAX ENDS HERE 
}
