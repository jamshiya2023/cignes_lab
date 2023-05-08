<?php

namespace App\Models;
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Registration;
use App\Models\Customer;
use App\Models\Country;
use App\Models\Invoicedetails;
use App\Models\Invoice;
use App\Models\Transactions;
use App\Models\PaymentMethod;
use App\Models\Refund; 
use App\Models\Logactivity; 

use DB;

class RefundController extends Controller
{
	
 public function refundlist()
    {
		 
		  $paymentmethod = PaymentMethod::where("status", "=", 1)->get();
	     
		    $testdetails = DB::table('invoice')
		   ->join('registration','registration.id','=','invoice.reg_id')
		   ->join('customer','customer.id','=','registration.cust_id')
		   ->join('invoicedetails','invoice.id','=','invoicedetails.invoice_id')
           ->join('alltests','invoicedetails.test_name','=','alltests.id')
		   ->where('registration.sample_status','=','pending')
		   ->where('invoice.paymentstatus','!=','refunded')
		   ->orderBy("invoice.id", "desc")
		   
		   ->select('customer.name','customer.phone','invoice.invoice_number','invoice.created_at','alltests.testname','invoicedetails.test_subtotal')
		  
		  ->get(); 
		     return view('refund',['testdetails' => $testdetails, 'paymentmethods' => $paymentmethod]);
      }
	  
    
    function addrefund(Request $request)
       {
		  
		    
		$invoiceid =  $request['invoiceid'];
		$invoiced = DB::table('invoicedetails')->where('invoicedetails.id','=', $invoiceid)->get();
		foreach($invoiced as $invd)
		$invoice_id = $invd->invoice_id;
		$paymentmethod = $request['paymentmethod'];
		$refund_amount = $request['total'];
		 
		$invoice = DB::table('invoice')->where('invoice.id','=', $invoice_id)->get();
		foreach($invoice as $inv)
		$rid = $inv->reg_id;
		$paidamt= $inv->paidamt;
		$inid=$inv ->id;
		 //$paidamt= $inv ->paidamt;
		$registration = DB::table('registration')->where('registration.id','=', $rid)->get();
		foreach($registration as $reg)
		$cid = $reg->cust_id;
		
		$customer = DB::table('customer')->where('customer.id','=', $cid)->get();
		foreach($customer as $cust)
		$customername = $cust->name;
		$customerphone = $cust->phone;
		$invoice = Invoice::find($inid);
		
		//foreach($invoice as $ivoice)
		//{
		//$paidamt= $ivoice ->paidamt;
			
		//}
		if($paidamt == $refund_amount)
			
			{
			 $invoice->paymentstatus = 'refunded';
				
				
			}
			else {
				
				 $invoice->paymentstatus = 'partial';
			}
		
		//dd($paidamt);die();
		
        $invoice->update(); 
		  
	   $refund = new Refund;
        $refund->invoice_id = $invoice_id;  
		 $refund->staff_id = '1';
		  $refund->paymentmethod_id = $paymentmethod;
		   $refund->name = $customername;
            $refund->phone = $customerphone;
             $refund->refund_amount = $refund_amount;
            //$refund->paidamt = $paidamt;
             //$refund->balanceamt = $paidamt-$refund_amount;
                $refund->status = '1';
                 $refund->save();
		        $loguserid = Auth::user()->staff_id;
	           $logbranchid = Auth::user()->branchid;
              $logurl = url()->current();
             $logip = request()->ip();
            $logmethod =  request()->method();
           $logagent = $request->header('User-Agent');
          $logsubject = "Refund Payment";
        if($loguserid == '0') {
            $logusername = 'Super admin';
        } else {
            $loguserqry = Staff::where('id',$loguserid)->first();
            $logusername = $loguserqry->firstname.' '.$loguserqry->lastname;
        }
        $log = new Logactivity;
        $log->subject = $logusername.' '.$logsubject;
        $log->url = $logurl;
        $log->method = $logmethod;
        $log->ip = $logip;
        $log->agent = $logagent;
        $log->user_id = $loguserid;
        $log->staff_name = $logusername;
		$log->branch_id ='0';
     $log->save();
	 return redirect("invoice-list")->withSuccess('Refunded successfully');    
		   
	  }
    
}
