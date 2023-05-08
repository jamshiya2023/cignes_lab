<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\IncomeCategory;

class IncomeCategoryController extends Controller
{
    public function incomecategoryview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $incomecategorys = IncomeCategory::select('id','incomecategory','status')
            ->orderBy('id','desc')
            ->get();
            return view('master_income_category', ['incomecategorys' => $incomecategorys]);
        }
        return redirect("/")->withError('You do not have access');
    }
    public function incomecategoryadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $incomecategory = new IncomeCategory;
            $incomecategory->incomecategory = $request->input('incomecategoryname');
            $incomecategory->status = '1';
            $incomecategory->staffid = $userId;
            $incomecategory->branchid = '0';        
            $incomecategory->save();
            return redirect("income-category")->withSuccess('Income category added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }
    public function editincomecategoryview(Request $request)
    {         
       $id = $request->id;
       $incomecategory = IncomeCategory::where('id',$id)
                ->select('id','incomecategory')
                ->first();
       return Response($incomecategory);
    }

    public function incomecategoryedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $incomecategory = IncomeCategory::find($id);
        $incomecategory->incomecategory = $request->input('incomecategorynameedit');
        $incomecategory->update();
        return redirect("income-category")->withSuccess('Income category updated successfully');    
    }

    // BLOCKING AND UNBLOCKING Income category STARTS HERE
    public function block(Request $request, $id)
    {
        $incomecategory = IncomeCategory::find($id);
        $incomecategory->status = '0';        
        $incomecategory->update();
        return redirect("income-category")->withSuccess('Income category blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $incomecategory = IncomeCategory::find($id);
        $incomecategory->status = '1';        
        $incomecategory->update();
        return redirect("income-category")->withSuccess('Income category unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING Income category ENDS HERE

}
