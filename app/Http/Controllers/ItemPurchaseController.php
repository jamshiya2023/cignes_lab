<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MasterItemPurchase;
use App\Models\MasterBrand;
use App\Models\MasterUnit;
use App\Models\MasterWarehouse;
use App\Models\Tax;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ItemPurchaseController extends Controller
{
    public function viewadditempurchase()
    {
        if(Auth::check()){
            $categoryname = Category::select('*')->get();
            $subcategoryname = SubCategory::join('purchasecategory','purchasecategory.id','=','purchase_subcategory.cat_id')
            ->select('purchase_subcategory.*','purchasecategory.cat_name')->get();
            $brandname = MasterBrand::select('*')->get();
            $warehousename = MasterWarehouse::select('*')->get();
            $unitname = MasterUnit::select('*')->get();
            $taxname = Tax::select('*')->get();
            return view('addpurchaseitem',compact('categoryname','subcategoryname','brandname','unitname','taxname','warehousename'));
       }
       return redirect("/")->withError('You do not have access');
    }

    public function viewitemlist()
    {
        if(Auth::check()){  

        $itempurchases = MasterItemPurchase::join('purchasecategory','purchasecategory.id','=','purchase_master.category_id')
        ->leftjoin('master_brand', 'master_brand.id', '=', 'purchase_master.brand_id')
        ->leftjoin('master_warehouse', 'master_warehouse.id', '=', 'purchase_master.warehouse_id')
        ->leftjoin('tax', 'tax.id', '=', 'purchase_master.itemvat')
        ->orderBy('purchase_master.id','DESC')
        ->select('purchase_master.*','purchasecategory.cat_name','master_brand.brand_name','tax.taxname','master_warehouse.warehouse_name as warehousename')
        ->get();

        return view('purchaseitemlist',compact('itempurchases'));
        }    
    
        return redirect("/")->withError('You do not have access');
    }

    public function additempurchase(Request $request)
    {
        $itempurchase= new MasterItemPurchase;
        $itempurchase->itemname = $request->itemname;
        $itempurchase->item_name_arabic = $request->itemnamearabic;
        $itempurchase->serialnumber = $request->serialnumber;
        $itempurchase->itemcode = $request->itemcode;
        $itempurchase->category_id = $request->categoryid;
        $itempurchase->subcategory_id= $request->subcategoryid;
        $itempurchase->brand_id= $request->brandid;
        $itempurchase->warehouse_id= $request->warehousename;
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
        $itempurchase->save();
        return redirect("item-purchase-list")->withSuccess('Purchase item added successfully');
    }
    public function loadsubcategory(Request $request){
    $categoryid = $request->id;
    $subcategory = SubCategory::where('cat_id',$categoryid)
            ->where('status',1)
            ->select('id as sid','subcat_name as subcategoryname')
            ->get();
            $datas['subcategories'] = $subcategory;
            return Response($datas);
}



public function editpurchase($id)
    {
       //dd($id);
         $itempurchases=MasterItemPurchase::where('purchase_master.id',$id)
        //  ->leftjoin('purchase_subcategory','purchase_subcategory.id','=','purchase_master.subcategory_id')

            /*->join('purchasecategory','purchasecategory.id','=','purchase_master.category_id')
            ->join('master_brand','master_brand.id','=','purchase_master.brand_id')
            ->join('master_unit','master_unit.id','=','purchase_master.unit_id')
            ->leftjoin('purchase_subcategory','purchase_subcategory.id','=','purchase_master.subcategory_id')
            ->select('purchase_master.*','purchasecategory.id as catid','master_brand.brand_name as brandname','purchase_subcategory.subcat_name as subcatname','master_unit.unit_name as unitname')*/
            ->first();
         
        $categoryname = Category::select('*')->get();
        $subcategoryname = SubCategory::select('*')->where('cat_id','=',$itempurchases->category_id)->get();

        /*$subcategoryname = SubCategory::join('purchasecategory','purchasecategory.id','=','purchase_subcategory.cat_id')
           ->select('purchase_subcategory.*','purchasecategory.cat_name')->get();
        */
        $brandname = MasterBrand::select('*')->get();
        $warehousename = MasterWarehouse::select('*')->get();
        $unitname = MasterUnit::select('*')->get();
        $taxname = Tax::select('*')->get();
        return view('editpurchaseitem' ,compact('itempurchases','categoryname','brandname','unitname','taxname','subcategoryname','warehousename'));
    }

    public function loadsubcategoryedit(Request $request){
        $categoryid = $request->id;
        //dd($categoryid);
        $subcategory = SubCategory::where('cat_id',$categoryid)
                ->where('status',1)
                ->select('id as sid','subcat_name as subcategoryname')
                ->get();
                $datas['subcategories'] = $subcategory;
                return Response($datas);
    }
   
    

    public function updatepurchase(Request $request)
    {
        $id = $request->hiddenid;
        //dd($request);
        $itempurchases = MasterItemPurchase::find($id);
        $itempurchases->itemname = $request->input('itemname');  
        $itempurchases->item_name_arabic = $request->input('itemnamearabicedit');  
        $itempurchases->serialnumber=$request->input('serialnumber');
        $itempurchases->itemcode=$request->input('itemcode');
        $itempurchases->category_id=$request->input('categoryid');
        $itempurchases->subcategory_id=$request->input('subcategoryname');
        $itempurchases->brand_id=$request->input('brandid');
        $itempurchases->warehouse_id=$request->input('warehousename');
        $itempurchases->itemcost=$request->input('itemcost');
        $itempurchases->sellingprice=$request->input('sellingprice');
        $itempurchases->itemvat=$request->input('taxid');
        $itempurchases->vatmethod=$request->input('vatmethod');
        $itempurchases->expirydate=$request->input('expirydate');
        $itempurchases->unit_id=$request->input('unitid');
        $itempurchases->openingstock=$request->input('openingstock');
      
        $itempurchases->update();
        
        return redirect("item-purchase-list")->withSuccess('Purchase item updated successfully');

    }

    public function purchaseview(Request $request)
    {   
                $id = $request->id;      
                $itempurchases = MasterItemPurchase::where('purchase_master.id',$id)
                ->join('purchasecategory','purchasecategory.id','=','purchase_master.category_id')
                //->join('master_supplier','master_supplier.id','=','purchase_master.supplier_id')
                ->leftjoin('master_brand','master_brand.id','=','purchase_master.brand_id')
                ->join('master_unit','master_unit.id','=','purchase_master.unit_id')
                ->leftjoin('tax','tax.id','=','purchase_master.itemvat')
                ->leftjoin('master_warehouse','master_warehouse.id','=','purchase_master.warehouse_id')
                ->leftjoin('purchase_subcategory','purchase_subcategory.id','=','purchase_master.subcategory_id')
                ->select('purchase_master.*','purchasecategory.cat_name as categoryname','master_brand.brand_name as brandname','purchase_subcategory.subcat_name as subcatname','master_unit.unit_name as unitname','tax.taxname as taxname','master_warehouse.warehouse_name as warehousename')
                ->first();
                return Response($itempurchases);
            

}


}

