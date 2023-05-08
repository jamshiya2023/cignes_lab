<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;

class ExpenseCategoryController extends Controller
{
    public function expensecategoryview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $expensecategorys = ExpenseCategory::select('id','expensecategory','status')
            ->orderBy('id','desc')
            ->get();
            return view('master_expense_category', ['expensecategorys' => $expensecategorys]);
        }
        return redirect("/")->withError('You do not have access');
    }
    public function expensecategoryadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $expensecategory = new expenseCategory;
            $expensecategory->expensecategory = $request->input('expensecategoryname');
            $expensecategory->status = '1';
            $expensecategory->staffid = $userId;
            $expensecategory->branchid = '0';        
            $expensecategory->save();
            return redirect("expense-category")->withSuccess('Expense category added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }
    public function editexpensecategoryview(Request $request)
    {         
       $id = $request->id;
       $expensecategory = ExpenseCategory::where('id',$id)
                ->select('id','expensecategory')
                ->first();
       return Response($expensecategory);
    }

    public function expensecategoryedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $expensecategory = ExpenseCategory::find($id);
        $expensecategory->expensecategory = $request->input('expensecategorynameedit');
        $expensecategory->update();
        return redirect("expense-category")->withSuccess('Expense category updated successfully');    
    }

    // BLOCKING AND UNBLOCKING expense category STARTS HERE
    public function block(Request $request, $id)
    {
        $expensecategory = ExpenseCategory::find($id);
        $expensecategory->status = '0';        
        $expensecategory->update();
        return redirect("expense-category")->withSuccess('Expense category blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $expensecategory = ExpenseCategory::find($id);
        $expensecategory->status = '1';        
        $expensecategory->update();
        return redirect("expense-category")->withSuccess('Expense category unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING expense category ENDS HERE
}
