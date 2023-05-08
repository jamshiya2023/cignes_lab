<?php

namespace App\Http\Controllers;
use App\Models\MasterWarehouse;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{
    public function viewmasterwarehouse()
    {
// echo "working"; exit();
        if(Auth::check()){
            $warehouses = MasterWarehouse::select('*')->get();
            $country = Country::select('id','country_name')
            ->where('status',1)
            ->orderBy('country_name','asc')
            ->get();
            $city = City::join('country','country.id','=','city.country_id')
            ->join('state','state.id','=','city.state_id')
            ->select('country.country_name as countryname','state.state_name as statename', 'city.id as id', 'city.city_name as cityname','city.status as status')
            ->orderBy('id','asc')
            ->get();
            

            return view('master_warehouse', [
                'warehouses'=>$warehouses,
                'countries' => $country,
                'cities' => $city
            ]);

            
       }
    
return redirect("/")->withError('You do not have access');

    }
    public function addwarehouse(Request $request)

{
 $warehouse= new MasterWarehouse;
 $warehouse->warehouse_name = $request->name;
 $warehouse->warehouse_name_arabic = $request->namearabic;
 $warehouse->code= $request->code;
 $warehouse->contact_number = $request->contactnumber;
 $warehouse->email= $request->email;
 $warehouse->address= $request->address;
 $warehouse->address_arabic= $request->addressarabic;
 $warehouse->city= $request->cityname;
 $warehouse->state= $request->statename;
 $warehouse->country= $request->countryname;
 $warehouse->status = '1';
 $warehouse->save();


 return redirect("warehouse")->with('WareHousesuccess', "Warehouse added successfully");

}

public function blockwarehouse(Request $request,$id)
{
     $supplier = MasterWarehouse::find($id);
     $supplier->status = '0';
     $supplier->update();
     return redirect("warehouse")->with('WareHousesuccess', "Warehouse blocked successfully");
}
public function unblockwarehouse(Request $request,$id)
{   
     $supplier= MasterWarehouse::find($id);
     $supplier->status = '1';
     $supplier->update();
     return redirect("warehouse")->with('WareHousesuccess', "Warehouse unblocked successfully");
}


public function editwarehouseview(Request $request)
{         
   $id = $request->id;
   $warehouse =MasterWarehouse::where('id',$id)
              ->select('id','warehouse_name','warehouse_name_arabic','contact_number','email','country','state','city','address','address_arabic','code')
              ->get();
              
    $warehousecountry = MasterWarehouse::where('id',$id)
    ->select('country','state')
    ->first();

   $country = Country::where('status',1)->select('id as cid','country_name')
                ->get(); 
    $state = State::where('country_id','=',$warehousecountry->country)
    ->where('status',1)
    ->select('id as sid','state_name as state')
    ->get();

    $city = City::where('state_id','=',$warehousecountry->state)
    ->where('status',1)
    ->select('id as cityid','city_name')
    ->get();

    $datas['cities'] = $city;
    $datas['states'] = $state;
    $datas['countries'] = $country;
    $datas['warehouses'] = $warehouse;
                       
   return Response($datas);
}

public function warehouseedit(Request $request){
    $id = $request->input('hiddenid');
    $warehouse=MasterWarehouse::find($id);
    // dd($request);
    $warehouse->warehouse_name=$request->input('nameedit');
    $warehouse->warehouse_name_arabic=$request->input('namearabicedit');
    $warehouse->contact_number=$request->input('contactnumberedit');
    $warehouse->email=$request->input('emailedit');
    $warehouse->code=$request->input('codeedit');
    $warehouse->country=$request->input('countrynameedit');
    $warehouse->state=$request->input('statenameedit');
    $warehouse->city=$request->input('citynameedit');
    $warehouse->address=$request->input('addressedit');
    $warehouse->address_arabic=$request->input('addressarabicedit');
    $warehouse->update();
    return redirect("warehouse")->with('WareHousesuccess', "Warehouse updated successfully");
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
 public function warehouseview(Request $request){
   
    $id = $request->id; 

    $warehouse = MasterWarehouse::where('master_warehouse.id',$id)
    ->leftjoin('country','country.id','=','master_warehouse.country')
    ->leftjoin('state','state.id','=','master_warehouse.state')
    ->leftjoin('city','city.id','=','master_warehouse.city')
    //->select('master_supplier.*')
    ->select('master_warehouse.*','country.country_name as countryname','state.state_name as statename','city.city_name as cityname')
    ->first();

    //dd($supplier);
    return Response($warehouse);









}
}
