<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\MasterBrand;


class BrandController extends Controller
{
    public function viewmasterbrand()
    {
//echo "working"; exit();
        if(Auth::check()){
            $brandnames = MasterBrand::select('*')->get();
            return view('master_product_brand', ['brandnames' => $brandnames]);
        }
    
    return redirect("/")->withError('You do not have access');
    }

public function addbrand(Request $request)

{
 $brand= new MasterBrand;
 $brand->brand_name = $request->brandname;
 $brand->brand_name_arabic = $request->arabicbrandname;
 $brand->status = '1';
 $brand->save();

//  return redirect("master-brand")->withSuccess('Brandname added successfully');
 return redirect("master-brand")->with('Brandsuccess', "Brand added successfully");

}
public function editbrandview(Request $request)
{
    $id = $request->id;
    $brand =MasterBrand::where('id',$id)
              ->select('id','brand_name','brand_name_arabic')
              ->first();
              return Response($brand);
}

public function brandedit(Request $request){
    $id = $request->input('hiddenid');
    $brand=MasterBrand::find($id);
    
    $brand->brand_name=$request->input('brandnameedit');
    $brand->brand_name_arabic=$request->input('arabicbrandnameedit');
    $brand->update();
    return redirect("master-brand")->with('Brandsuccess', "Brand updated successfully");
}
public function blockbrand(Request $request,$id)
{
     $brand = MasterBrand::find($id);
     $brand->status = '0';
     $brand->update();
     return redirect("master-brand")->with('Brandsuccess', "Brand blocked successfully");
}
public function unblockbrand(Request $request,$id)
{   
     $brand= MasterBrand::find($id);
     $brand->status = '1';
     $brand->update();
     return redirect("master-brand")->with('Brandsuccess', "Brand Unblocked successfully");
}


}
