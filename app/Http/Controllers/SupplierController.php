<?php

namespace App\Http\Controllers;
use App\Models\MasterSupplier;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;




class SupplierController extends Controller
{
   public function viewmastersupplier()
    {
// echo "working"; exit();
        if(Auth::check()){
            $suppliernames = MasterSupplier::select('*')->get();
            $country = Country::select('id','country_name')
            ->where('status',1)
            ->orderBy('country_name','asc')
            ->get();
            $city = City::join('country','country.id','=','city.country_id')
            ->join('state','state.id','=','city.state_id')
            ->select('country.country_name as countryname','state.state_name as statename', 'city.id as id', 'city.city_name as cityname','city.status as status')
            ->orderBy('id','asc')
            ->get();
            

            return view('master_product_supplier', [
                'suppliernames'=>$suppliernames,
                'countries' => $country,
                'cities' => $city
            ]);

            
       }
    
return redirect("/")->withError('You do not have access');

    }

public function addsupplier(Request $request)

{
 $supplier= new MasterSupplier;
 $supplier->supplier_name = $request->suppliername;
 $supplier->supplier_name_arabic = $request->suppliernamearabic;
 $supplier->contact_name = $request->contactname;
 $supplier->contact_name_arabic = $request->contactnamearabic;
 $supplier->contact_number = $request->contactnumber;
 $supplier->vat_number = $request->vatnumber;
 $supplier->email= $request->email;
 $supplier->address= $request->address;
 $supplier->address_arabic= $request->addressarabic;
 $supplier->city= $request->cityname;
 $supplier->state= $request->statename;
 $supplier->country= $request->countryname;
 $supplier->postbox= $request->postbox;
 $supplier->status = '1';
 $supplier->save();

//  return redirect("master-brand")->withSuccess('Brandname added successfully');
 return redirect("master-supplier")->with('Suppliersuccess', "Supplier added successfully");

}



public function editsupplierview(Request $request)
{         
   $id = $request->id;
   $supplier =MasterSupplier::where('id',$id)
              ->select('id','supplier_name','supplier_name_arabic','contact_name','contact_name_arabic','contact_number','vat_number','email','country','state','city','postbox','address','address_arabic')
              ->get();
              
    $suppliercountry = MasterSupplier::where('id',$id)
    ->select('country','state')
    ->first();

   $country = Country::where('status',1)->select('id as cid','country_name')
                ->get(); 
    $state = State::where('country_id','=',$suppliercountry->country)
    ->where('status',1)
    ->select('id as sid','state_name as state')
    ->get();

    $city = City::where('state_id','=',$suppliercountry->state)
    ->where('status',1)
    ->select('id as cityid','city_name')
    ->get();

    $datas['cities'] = $city;
    $datas['states'] = $state;
    $datas['countries'] = $country;
    $datas['suppliers'] = $supplier;
                       
   return Response($datas);
}

public function supplieredit(Request $request){
    $id = $request->input('hiddenid');
    $supplier=MasterSupplier::find($id);
    // dd($request);
    $supplier->supplier_name=$request->input('suppliernameedit');
    $supplier->supplier_name_arabic=$request->input('suppliernamearabicedit');
    $supplier->contact_name=$request->input('contactnameedit');
    $supplier->contact_name_arabic=$request->input('contactnamearabicedit');
    $supplier->contact_number=$request->input('contactnumberedit');
    $supplier->vat_number=$request->input('vatnumberedit');
    $supplier->email=$request->input('emailedit');
    $supplier->country=$request->input('countrynameedit');
    $supplier->state=$request->input('statenameedit');
    $supplier->city=$request->input('citynameedit');
    $supplier->postbox=$request->input('postboxedit');
    $supplier->address=$request->input('addressedit');
    $supplier->address_arabic=$request->input('addressarabicedit');
    $supplier->update();
    return redirect("master-supplier")->with('Suppliersuccess', "Supplier updated successfully");
}

public function blocksupplier(Request $request,$id)
{
     $supplier = MasterSupplier::find($id);
     $supplier->status = '0';
     $supplier->update();
     return redirect("master-supplier")->with('Suppliersuccess', "Supplier blocked successfully");
}
public function unblocksupplier(Request $request,$id)
{   
     $supplier= MasterSupplier::find($id);
     $supplier->status = '1';
     $supplier->update();
     return redirect("master-supplier")->with('Suppliersuccess', "Supplier Unblocked successfully");
}


public function loadstate(Request $request){
    $countryid = $request->id;
    $state = State::where('country_id',$countryid)
            ->where('status',1)
            ->select('id as sid','state_name as statename')
            ->get();
            $datas['states'] = $state;
            return Response($datas);

}


public function loadcity(Request $request){
     $stateid = $request->id;
     $city = City::where('state_id',$stateid)
            ->where('status',1)
            ->select('id as sid','city_name as cityname')
            ->get();
             $datas['cities'] = $city;
             return Response($datas);


 }


  public function supplierview(Request $request){
   
            $id = $request->id; 

            $supplier = MasterSupplier::where('master_supplier.id',$id)
            ->leftjoin('country','country.id','=','master_supplier.country')
            ->leftjoin('state','state.id','=','master_supplier.state')
            ->leftjoin('city','city.id','=','master_supplier.city')
            //->select('master_supplier.*')
            ->select('master_supplier.*','country.country_name as countryname','state.state_name as statename','city.city_name as cityname')
            ->first();

            //dd($supplier);
            return Response($supplier);
         




 
 }
}

