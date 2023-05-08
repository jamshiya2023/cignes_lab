<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;
use App\Models\ExpenseCategory; 
use App\Models\Staff; 
use App\Models\Logactivity;
class ExpenseController extends Controller
{
   
    public function expenselist()
    {
		  
			  
       $expense = Expense::join('master_expense_category','expense.expense_category_id','=','master_expense_category.id')
	                 ->join('staff','staff.id','=','expense.pay_by')
                    ->select('master_expense_category.expensecategory','expense.id','expense.title','expense.date','expense.note','expense.amount')
		     ->get();
       $expensecategorys = ExpenseCategory::select('id','expensecategory','status')
            ->orderBy('id','desc')
            ->get();
        //return view('expense',['expense'=>$expense]);
		 return view('expense',['expense' => $expense,'expensecategorys' =>$expensecategorys]);
    }
    public function expenseadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $expense = new Expense;
            $expense->expense_category_id = $request->input('expensecategory');
			 $expense->title =  $request->input('title');
			  $expense->date =  $request->input('date');
			  $expense->note =  $request->input('note');
			  $expense->amount =  $request->input('amount');
			  $expense->pay_by = $userId;
              $expense->status = '1';
			  
              $expense->save();
            return redirect("expense-list")->withSuccess('Expense added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }
	
	 public function editexpense(Request $request)
      {
       $id = $request->id;
	   
       $expense = Expense::join('master_expense_category','expense.expense_category_id','=','master_expense_category.id')
	              ->where('expense.id',$id)
                 ->select('expense.id as eid','expense.expense_category_id as cid','expense.title as title','expense.date as date','expense.note as note','expense.amount as amount')
		     ->first();
	  $expensecategory = ExpenseCategory:: select('id','expensecategory')
                        ->get();  
		  
			/*	foreach($expensecat as $row){
					
					$expensecategory =$row->expensecategory;
					$cid =$row->id;
				} */
              $datas['expenses']= $expense; 
              $datas['expensecategories']= $expensecategory; 
                //$datas['cid']= $cid; 
			  
			 
       return Response($datas);
    }
	 public function viewexpense(Request $request)
      {
       $id = $request->id;
	   
       $testlists = Expense::join('master_expense_category','expense.expense_category_id','=','master_expense_category.id')
	              ->where('expense.id',$id)
                 ->select('master_expense_category.expensecategory','expense.id','expense.expense_category_id','expense.title','expense.date','expense.note','expense.amount')
		     ->first();
	   $datas['date'] = $testlists->date; 
	   $datas['expensecategory'] = $testlists->expensecategory; 
	   $datas['title'] = $testlists->title; 
	   $datas['note'] = $testlists->note; 
	   $datas['amount'] = $testlists->amount;  
              $datas['testlists'] = $testlists; 
			 
       return Response($datas);
    }
	
	 public function delete_expense(Request $request, $id)
    {
		 $res = Expense::where('id',$id)->delete();
         $loguserid = Auth::user()->staff_id;
        $logurl = url()->current();
        $logip = request()->ip();
        $logmethod =  request()->method();
        $logagent = $request->header('User-Agent');
       $logsubject = "Expense Delete";
        $logbranchid = Auth::user()->branchid;
           $loguserqry = Staff::where('id',$loguserid)->first();
           $logusername = $loguserqry->firstname.' '.$loguserqry->lastname;
        
        $log = new Logactivity;
        $log->subject = $logusername.' '.$logsubject;
        $log->url = $logurl;
        $log->method = $logmethod;
        $log->ip = $logip;
        $log->agent = $logagent;
        $log->user_id = $loguserid;
        $log->staff_name = $logusername;
        $log->branch_id = $logbranchid;
        $log->save();
        return redirect("expense-list")->withSuccess('Expense Deleted successfully');
    }
	  
}
