<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Sensitivity;

class SensitivityController extends Controller
{
    public function sensitivityview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $sensitivity = Sensitivity::select('*')
            ->orderBy('id','desc')
            ->get();
            return view('master_sensitivity', ['sensitivity' => $sensitivity]);
        }
        return redirect("/")->withError('You do not have access');
    }

    public function sensitivityadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $sensitivity = new Sensitivity;
            $sensitivity->sensitivity_name = $request->input('sensitivityname');
            $sensitivity->inhibition_zone = $request->input('inhibitionzone');
            $sensitivity->sensitivity_zone = $request->input('sensitivityzone');
            $sensitivity->intermediate_value = $request->input('intermediatevalue');
            $sensitivity->antibiotic_short_name = $request->input('antibioticshortname');
            $sensitivity->sensitivity_min_value = $request->input('sensitivityminvalue');
            $sensitivity->sensitivity_max_value = $request->input('sensitivitymaxvalue');
            
            $sensitivity->status = '1';
            $sensitivity->staffid = $userId;
            $sensitivity->branchid = '0';        
            $sensitivity->save();
            return redirect("sensitivity")->withSuccess('Sensitivity added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }

    public function editsensitivityview(Request $request)
    {         
       $id = $request->id;
       $sensitivity = Sensitivity::where('id',$id)
                ->select('id','sensitivity_name','inhibition_zone','sensitivity_zone','intermediate_value','antibiotic_short_name','sensitivity_min_value','sensitivity_max_value')
                ->first();
       return Response($sensitivity);
    }

    public function sensitivityedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $sensitivity = Sensitivity::find($id);
        $sensitivity->sensitivity_name = $request->input('sensitivitynameedit');
        $sensitivity->inhibition_zone = $request->input('inhibitionzoneedit');
        $sensitivity->sensitivity_zone = $request->input('sensitivityzoneedit');
        $sensitivity->intermediate_value = $request->input('intermediatevalueedit');
        $sensitivity->antibiotic_short_name = $request->input('antibioticshortnameedit');
        $sensitivity->sensitivity_min_value = $request->input('sensitivityminvalueedit');
        $sensitivity->sensitivity_max_value = $request->input('sensitivitymaxvalueedit');
        $sensitivity->update();
        return redirect("sensitivity")->withSuccess('Sensitivity updated successfully');    
    }

    // BLOCKING AND UNBLOCKING SENSITIVITY STARTS HERE
    public function block(Request $request, $id)
    {
        $sensitivity = Sensitivity::find($id);
        $sensitivity->status = '0';        
        $sensitivity->update();
        return redirect("sensitivity")->withSuccess('Sensitivity blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $sensitivity = Sensitivity::find($id);
        $sensitivity->status = '1';        
        $sensitivity->update();
        return redirect("sensitivity")->withSuccess('Sensitivity unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING SENSITIVITY ENDS HERE 

}
