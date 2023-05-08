<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterInsurance;

class InsuranceController extends Controller
{
    public function viewinsurancelist()
    {
    
            $insurance = MasterInsurance::all();

    	 	
    	return view('insursncelist',['insurance'=>$insurance]);
    }

		   

    public function addinsurance(Request $request)
    {
        $insurance = MasterInsurance::all();
    	$insurance= new MasterInsurance;
    	// $insurance->id=$request->id;
        $insurance->insurance_name = $request->name;
 
 
 $insurance->save();


 return redirect('Insurance')->with('Insurancesuccess', "Insurance added successfully");

}

public function editinsuranceview(Request $request)
{

	// Fetch the insurance record from the database based on the $id parameter
    $insurance = Insurance::find($id);

    // Return the view with the insurance record data
    return view('insurance.edit', ['insurance' => $insurance]);
	 // $id = $request->id;
   // $insurance =MasterInsurance::where('id',$id)
   //            ->select('id','insurance_name')
   //            ->get();
              
    // $insurance = MasterInsurance::where('id',$id)
    // ->select('country','state')
    // ->first();

  
   
   //  $datas['insurance'] = $insurance;
                       
   // return Response($datas);

    }


    public function insuranceedit(Request $request)
    {
    	 $id = $request->input('hiddenid');
    $insurance=MasterInsurance::find($id);
    // dd($request);
    $insurance->insurance_name=$request->input('nameedit');
    
    $insurance->update();
    return redirect("insursncelist")->with('WareHousesuccess', "Warehouse updated successfully");
}
    }

