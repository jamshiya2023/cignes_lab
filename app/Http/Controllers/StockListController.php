<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Stock;
use App\Models\MasterBrand;
use App\Models\MasterUnit;
use App\Models\MasterSupplier;
use App\Models\MasterWarehouse;
use App\Models\StockWareHouse;
use App\Models\Tax;
use DB;





class StockListController extends Controller
{
    public function viewaddstock()
    {
        
        
        if(Auth::check()){
        // $itempurchases = MasterItemPurchase::select('*')->get();
            $categoryname = Category::select('*')->get();
            $subcategoryname = SubCategory::join('purchasecategory','purchasecategory.id','=','purchase_subcategory.cat_id')
            ->select('purchase_subcategory.*','purchasecategory.cat_name')->get();
            $brandname = MasterBrand::select('*')->get();
            $suppliername = MasterSupplier::select('*')->get();
            $unitname = MasterUnit::select('*')->get();
            $taxname = Tax::select('*')->get();
            $warehousename = MasterWarehouse::select('*')->get();
            return view('addstock',compact('categoryname','subcategoryname','brandname','unitname','taxname','suppliername','warehousename'));
       }
       return redirect("/")->withError('You do not have access');
    }

    public function viewstocklist()
    {
     
        
        if(Auth::check()){  

        $itempurchases = Stock::join('purchasecategory','purchasecategory.id','=','stock.category_id')
        ->leftjoin('master_brand', 'master_brand.id', '=', 'stock.brand_id')
        ->leftjoin('tax', 'tax.id', '=', 'stock.itemvat')
        ->orderBy('stock.id','DESC')
        ->select('stock.*','purchasecategory.cat_name','master_brand.brand_name','tax.taxname')
        ->get();

        return view('stocklist',compact('itempurchases'));
        }    
    
        return redirect("/")->withError('You do not have access');
    }

    public function addstock(Request $request)
{
 $itempurchase= new Stock;
 $lastCompanyId = Stock::select('id')->orderBy('id', 'desc')->value('id');
 $id= $lastCompanyId + 1;
 $itempurchase->id = $id;
 $itempurchase->itemname = $request->itemname;
 $itempurchase->item_name_arabic = $request->itemnamearabic;
 $itempurchase->serialnumber = $request->serialnumber;
 $itempurchase->itemcode = $request->itemcode;
 $itempurchase->category_id = $request->categoryid;
 $itempurchase->subcategory_id= $request->subcategoryid;
 $itempurchase->brand_id= $request->brandid;
 $itempurchase->itemcost= $request->itemcost;
 $itempurchase->sellingprice= $request->sellingprice;
$itempurchase->itemvat= $request->taxid;
$itempurchase->vatmethod= $request->vatmethod;
 $itempurchase->expirydate= $request->expirydate;
 $itempurchase->unit_id= $request->unitid;
 $itempurchase->openingstock= $request->openingstock;
 $itempurchase->staff_id = '3';
 $itempurchase->branch_id = '0';
 $itempurchase->status = '1';

 $totalstock="0";
 foreach($request->warehouseid as $key=>$warehouseid)
 {
      $warehouse = new StockWareHouse();
      $warehouse->warehouse_id = $warehouseid;
      $warehouse->stock_id = $id;
      $warehouse->quantity = $request->quantity[$key];
      $totalstock=$totalstock+$request->quantity[$key];
      $warehouse->save();
 }
$itempurchase->warehouse= $totalstock;
$itempurchase->save();
return redirect("stock-list")->withSuccess('stock list added successfully');    
    }



    public function stockview(Request $request)
    { 
        // $itempurchase->id = $id;

         $id = $request->id; 
        //  dd($id);
          
        $itempurchases = Stock::where('stock.id',$id)

        ->join('purchasecategory','purchasecategory.id','=','stock.category_id')
        ->leftjoin('master_brand','master_brand.id','=','stock.brand_id')
        // ->leftjoin('stock_warehouse','stock_warehouse.stock_id','=','stock.warehouse')
        ->join('master_unit','master_unit.id','=','stock.unit_id')
        ->leftjoin('tax','tax.id','=','stock.itemvat')
        ->leftjoin('purchase_subcategory','purchase_subcategory.id','=','stock.subcategory_id')
        ->select('stock.*','purchasecategory.cat_name as categoryname','master_brand.brand_name as brandname','purchase_subcategory.subcat_name as subcatname','master_unit.unit_name as unitname','tax.taxname as taxname')->first();
     

        return Response($itempurchases);
        
    
}




}