<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PurchaseCategoryController extends Controller
{


    public function viewpurchasecategory()
{
    if(Auth::check()){
        $categoryname = Category::select('*')->get();
        $subcategoryname = SubCategory::join('purchasecategory','purchasecategory.id','=','purchase_subcategory.cat_id')
        ->select('purchase_subcategory.*','purchasecategory.cat_name')->get();
        $categorylist = Category::select('*')->where('status',1)->get();
        return view('purchasecategory', [
            'categoryname' => $categoryname,
            'subcategoryname' => $subcategoryname,
            'categorylist' => $categorylist
        ]);
     }
     return redirect("/")->withError('You do not have access');
    }  

public function addcategory(Request $request)
{
 $category= new Category;
 $category->cat_name = $request->categoryname;
 $category->cat_name_arabic = $request->arabiccategoryname;
 $category->status = '1';
 $category->save();
 return redirect("purchase-category")->with('Categorysuccess', "Category added successfully");
}


public function editpurchasecategoryview(Request $request)
{
    $id = $request->id;
    $category =Category::where('id',$id)
              ->select('id','cat_name','cat_name_arabic')
              ->first();
              return Response($category);
}

public function purchasecategoryedit(Request $request){
    $id = $request->input('hiddenid');
    $category=Category::find($id);
    
    $category->cat_name = $request->input('categorynameedit');
    $category->cat_name_arabic = $request->input('arabiccategorynameedit');
    $category->update();
    return redirect("purchase-category")->with('Categorysuccess', "Category updated successfully");
}


// BLOCKING AND UNBLOCKING CATEGORY STARTS HERE

public function block(Request $request,$id)
{
     $category = Category::find($id);
     $category->status = '0';
     $category->update();
     return redirect("purchase-category")->with('Categorysuccess', "Category blocked successfully");
}
public function unblock(Request $request,$id)
{   
     $category= Category::find($id);
     $category->status = '1';
     $category->update();
     return redirect("purchase-category")->with('Categorysuccess', "Category unblocked successfully");
}
  
// BLOCKING AND UNBLOCKING CATEGORY ENDS HERE





public function addsubcategory(Request $request)
{
    // dd($request->subcategory);
 $subcategory= new SubCategory;
 $subcategory->subcat_name = $request->subcategoryname;
 $subcategory->subcat_name_arabic = $request->arabicsubcategoryname;
 $subcategory->cat_id = $request->categoryid;
 $subcategory->status = '1';
 $subcategory->save();
 return redirect("purchase-category")->with('subcategorysuccess',"Sub category added successfully"); 
}



public function editpurchasesubcategoryview(Request $request)
{
    $id = $request->id;
    $subcategory =SubCategory::where('id',$id)
              ->select('id as sid', 'cat_id','subcat_name','subcat_name_arabic')
              ->get();
    $category =Category::select('id as cid', 'cat_name')
              ->get();
              $datas['subcategories']= $subcategory; 
              $datas['categories']= $category; 

              return Response($datas);
}

public function purchasesubcategoryedit(Request $request){
    $id = $request->input('subhiddenid');
    $subcategory=SubCategory::find($id);
    
    $subcategory->subcat_name=$request->input('subcategorynameedit');
    $subcategory->subcat_name_arabic=$request->input('arabicsubcategorynameedit');
    $subcategory->cat_id=$request->input('categoryeditid');
    $subcategory->update();
    return redirect("purchase-category")->with('subcategorysuccess',"Sub category updated successfully");
}










public function blocksubcat(Request $request,$id)
{
     $subcategory = SubCategory::find($id);
     $subcategory->status = '0';
     $subcategory->update();
     return redirect("purchase-category")->with('subcategorysuccess',"Sub category blocked successfully");
}
public function unblocksubcat(Request $request,$id)
{   
     $subcategory= SubCategory::find($id);
     $subcategory->status = '1';
     $subcategory->update();
     return redirect("purchase-category")->with('subcategorysuccess',"Sub category unblocked successfully");

}
  
}
