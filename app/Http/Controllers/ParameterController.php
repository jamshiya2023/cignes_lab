<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Machine;
use App\Models\TestMethod;
use App\Models\Labunit;

use App\Models\Parameter;
use App\Models\ParameterEquipmentMethod;
use App\Models\ParameterReferenceRange;

class ParameterController extends Controller
{
    public function parameterview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $parameters = Parameter::select('id','parameter_name','parameter_name_arabic','status')
            ->get();
            //return view('master_parameter');
            return view('master_parameter', ['parameters' => $parameters]);
        }
        return redirect("/")->withError('You do not have access');
    }


    public function addparameter()
    {
        if(Auth::check()){
            $machines = Machine::select('id as machineid', 'machine_name')->where('status','=','1')->get();
            $methods = TestMethod::select('id as testmethodid', 'testmethod')->where('status','=','1')->get();
            $units = Labunit::select('id as unitid','labunit_name')->where('status','=','1')->get();
            return view('add_master_parameter', ['machines' => $machines, 'testmethods' => $methods, 'units'=>$units]);
        }
        return redirect("/")->withError('You do not have access');
    }

    public function parameteradd(Request $request)
    {
        if(Auth::check()){
            //dd($request);
            
            
            $userId = Auth::id();
            $parameter = new Parameter;            
            $parameter->parameter_name = $request->input('parametername');
            $parameter->parameter_name_arabic = $request->input('arabicparametername');
            $parameter->short_code = $request->input('parametershortcode');
            $parameter->lis_parameter_code = $request->input('parameterliscode');
            $parameter->label_heading = $request->input('labelheading');
            $parameter->final_result = $request->input('finalresult');
            $parameter->status = '1';
            $parameter->staffid = $userId;
            $parameter->branchid = '0';        
            $parameter->save();
            $parameterlastid = $parameter->id;

            if($request->input('equipment')){                
                $parametermapping = new ParameterEquipmentMethod;
                $parametermapping->parameter_id = $parameterlastid;
                $parametermapping->equipment_id = $request->input('equipment');
                $parametermapping->equipment_test_id = $request->input('equipmenttestid');
                $parametermapping->result_value = $request->input('resultvalue');
                $parametermapping->duration = $request->input('duration');
                $parametermapping->equation = $request->input('equation');
                $parametermapping->method_id = $request->input('parametermethod');
                $parametermapping->decimal_nos = $request->input('decimalnos');
                $parametermapping->unit_id = $request->input('parameterunit');
                $parametermapping->status = '1';
                $parametermapping->save();
            }
            
            foreach($request->lowertypehidden as $index => $referenceranges) {
                $referencerange = new ParameterReferenceRange();
                $referencerange->parameter_id = $parameterlastid;
                $referencerange->lowertype = $request->lowertypehidden[$index];
                $referencerange->lowervalue = $request->lowervaluehidden[$index];
                $referencerange->lowerchronological = $request->lowerchronologicalhidden[$index];
                $referencerange->highertype = $request->highertypehidden[$index];
                $referencerange->highervalue = $request->highervaluehidden[$index];
                $referencerange->higherchronological = $request->higherchronologicalhidden[$index];
                $referencerange->malevalue = $request->malevaluehidden[$index];
                $referencerange->minmalevalue = $request->minmalevaluehidden[$index];
                $referencerange->maxmalevalue = $request->maxmalevaluehidden[$index];
                $referencerange->femalevalue = $request->femalevaluehidden[$index];
                $referencerange->minfemalevalue = $request->minfemalevaluehidden[$index];
                $referencerange->maxfemalevalue = $request->maxfemalevaluehidden[$index];
                $referencerange->status = '1';
                $referencerange->save();
            }
            

            return redirect("parameter-setup")->withSuccess('Parameter added successfully');
            
        }
        return redirect("/")->withError('You do not have access');
    }

    public function editparameterview($id)
    {         
    
        $machines = Machine::select('id as machineid', 'machine_name')->where('status','=','1')->get();
        $methods = TestMethod::select('id as testmethodid', 'testmethod')->where('status','=','1')->get();
        $units = Labunit::select('id as unitid','labunit_name')->where('status','=','1')->get();

        $parameters = Parameter::leftjoin('master_parameter_equipment_method as mpem','mpem.parameter_id','=','master_parameter.id')
        ->select('master_parameter.*','mpem.id as pemid','mpem.equipment_id','mpem.equipment_test_id','mpem.result_value','mpem.duration','mpem.equation','mpem.method_id','mpem.decimal_nos','mpem.unit_id')
        ->where('master_parameter.id','=',$id)->first();

        $referenceranges = ParameterReferenceRange::where('parameter_id',$id)
        ->select('id as refid','lowertype','lowervalue','lowerchronological','highertype','highervalue','higherchronological','malevalue','minmalevalue','maxmalevalue','femalevalue','minfemalevalue','maxfemalevalue')
        ->get();

        $referenceCount = $referenceranges->count();
    
        return view('edit_master_parameter', [
            'machines' => $machines, 
            'testmethods' => $methods, 
            'units' => $units,
            'parameters' => $parameters,
            'referenceCount' => $referenceCount,
            'referenceranges' => $referenceranges
        ]);
    }

    public function parameteredit(Request $request)
    { 
      
        $parameterid = $request->input('parameterid');
        $parameter = Parameter::find($parameterid);
        $parameter->parameter_name = $request->input('parametername');
        $parameter->parameter_name_arabic = $request->input('arabicparametername');
        $parameter->short_code = $request->input('parametershortcode');
        $parameter->lis_parameter_code = $request->input('parameterliscode');
        $parameter->label_heading = $request->input('labelheading');
        $parameter->final_result = $request->input('finalresult');
        $parameter->update();
        
        if($request->input('mappingid')){
                $mpemid = $request->input('mappingid');
                $parametermapping = ParameterEquipmentMethod::find($mpemid);
                $parametermapping->equipment_id = $request->input('equipment');
                $parametermapping->equipment_test_id = $request->input('equipmenttestid');
                $parametermapping->result_value = $request->input('resultvalue');
                $parametermapping->duration = $request->input('duration');
                $parametermapping->equation = $request->input('equation');
                $parametermapping->method_id = $request->input('parametermethod');
                $parametermapping->decimal_nos = $request->input('decimalnos');
                $parametermapping->unit_id = $request->input('parameterunit');
                $parametermapping->update();
        }
        if($request->input('mappingid') == '' && $request->input('equipment')) {
                $parametermapping = new ParameterEquipmentMethod;
                $parametermapping->parameter_id = $parameterid;
                $parametermapping->equipment_id = $request->input('equipment');
                $parametermapping->equipment_test_id = $request->input('equipmenttestid');
                $parametermapping->result_value = $request->input('resultvalue');
                $parametermapping->duration = $request->input('duration');
                $parametermapping->equation = $request->input('equation');
                $parametermapping->method_id = $request->input('parametermethod');
                $parametermapping->decimal_nos = $request->input('decimalnos');
                $parametermapping->unit_id = $request->input('parameterunit');
                $parametermapping->status = '1';
                $parametermapping->save();
        }

        if($request->lowertypehidden) {
            foreach($request->lowertypehidden as $index => $referenceranges) {
                $referencerange = new ParameterReferenceRange();
                $referencerange->parameter_id = $parameterid;
                $referencerange->lowertype = $request->lowertypehidden[$index];
                $referencerange->lowervalue = $request->lowervaluehidden[$index];
                $referencerange->lowerchronological = $request->lowerchronologicalhidden[$index];
                $referencerange->highertype = $request->highertypehidden[$index];
                $referencerange->highervalue = $request->highervaluehidden[$index];
                $referencerange->higherchronological = $request->higherchronologicalhidden[$index];
                $referencerange->malevalue = $request->malevaluehidden[$index];
                $referencerange->minmalevalue = $request->minmalevaluehidden[$index];
                $referencerange->maxmalevalue = $request->maxmalevaluehidden[$index];
                $referencerange->femalevalue = $request->femalevaluehidden[$index];
                $referencerange->minfemalevalue = $request->minfemalevaluehidden[$index];
                $referencerange->maxfemalevalue = $request->maxfemalevaluehidden[$index];
                $referencerange->status = '1';
                $referencerange->save();
            }
        }

        return redirect("parameter-setup")->withSuccess('Parameter updated successfully');    
    }

    // POPUP VIEW STARTS HERE 
    public function viewparameter(Request $request){
        $id = $request->id;
        $parameters = Parameter::leftjoin('master_parameter_equipment_method as mpem','mpem.parameter_id','=','master_parameter.id')
        ->leftjoin('master_machine as machine','machine.id','=','mpem.equipment_id')
        ->leftjoin('master_test_method as method','method.id','=','mpem.method_id')
        ->leftjoin('master_labunit as labunit','labunit.id','=','mpem.unit_id')
        ->select('master_parameter.*','mpem.id as pemid','mpem.equipment_id','mpem.equipment_test_id','mpem.result_value','mpem.duration','mpem.equation','mpem.method_id','mpem.decimal_nos','mpem.unit_id','machine.machine_name','method.testmethod','labunit.labunit_name')
        ->where('master_parameter.id','=',$id)->first();

        $referenceranges = ParameterReferenceRange::where('parameter_id',$id)
        ->select('id as refid','lowertype','lowervalue','lowerchronological','highertype','highervalue','higherchronological','malevalue','minmalevalue','maxmalevalue','femalevalue','minfemalevalue','maxfemalevalue')
        ->get();


        //$data['success'] = 1;  
        $data['parameter'] = $parameters;
        $data['referenceranges'] = $referenceranges;
        return response()->json($data);

    }

    // POPUP VIEW ENDS HERE 

    // EXISTING REFERENCE DELETE WHILE EDITING STARTS HERE 

    public function referencerangedelete(Request $request){
        $id = $request->id;
        $referencerange=ParameterReferenceRange::where('id',$id)->delete();
        $data['success'] = 1;  
        return response()->json($data);
    }

    // EXISTING REFERENCE DELETE WHILE EDITING ENDS HERE 

    // BLOCKING AND UNBLOCKING TAX STARTS HERE
    public function block(Request $request, $id)
    {
        $tax = Parameter::find($id);
        $tax->status = '0';        
        $tax->update();
        return redirect("parameter-setup")->withSuccess('Parameter blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $tax = Parameter::find($id);
        $tax->status = '1';        
        $tax->update();
        return redirect("parameter-setup")->withSuccess('Parameter unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING TAX ENDS HERE 
}
