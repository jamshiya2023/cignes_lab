<?php
namespace App\Http\Controllers;
use App\Models\MasterUnit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UnitController extends Controller
{
    //

    public function viewmasterunit()
    {
// echo "working"; exit();
        if(Auth::check()){
             $unitnames = MasterUnit::select('*')->get();
            return view('master_product_unit', ['unitnames' => $unitnames]);
        }
    
    return redirect("/")->withError('You do not have access');
    }

    public function addunit(Request $request)

    {
     $unit= new MasterUnit;
     $unit->unit_name = $request->unitname;
     $unit->unit_name_arabic = $request->arabicunitname;
     $unit->short_code = $request->shortcode;
     $unit->status = '1';
     $unit->save();
    
    //  return redirect("master-brand")->withSuccess('Brandname added successfully');
     return redirect("master-unit")->with('Unitsuccess', "Unit added successfully");
    
    }

    public function editunitview(Request $request)
{
    $id = $request->id;
    $unit =MasterUnit::where('id',$id)
              ->select('id','unit_name','unit_name_arabic','short_code')
              ->first();
              return Response($unit);
}

public function unitedit(Request $request){
    $id = $request->input('hiddenid');
    $unit=MasterUnit::find($id);
    
    $unit->unit_name=$request->input('unitnameedit');
    $unit->unit_name_arabic=$request->input('arabicunitnameedit');
    $unit->short_code=$request->input('shortcodeedit');
    $unit->update();
    return redirect("master-unit")->with('Unitsuccess', "Unit updated successfully");
}


public function blockunit(Request $request,$id)
{
     $unit = MasterUnit::find($id);
     $unit->status = '0';
     $unit->update();
     return redirect("master-unit")->with('Unitsuccess', "Unit blocked successfully");
}
public function unblockunit(Request $request,$id)
{   
     $unit= MasterUnit::find($id);
     $unit->status = '1';
     $unit->update();
     return redirect("master-unit")->with('Unitsuccess', "Unit Unblocked successfully");
}
}
