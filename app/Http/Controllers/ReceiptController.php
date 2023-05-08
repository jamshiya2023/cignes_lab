<?php


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
use App\Models\Branch;
//use \NumberFormatter;


class ReceiptController extends Controller
{
    public function receiptlistview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $receipts = Transactions::join('invoice','invoice.id','=','transactions.invoice_id')
            ->join('staff','staff.id','=','transactions.staff_id')
            ->join('registration','registration.id','=','invoice.reg_id')
            ->join('customer','customer.id','=','registration.cust_id')
            ->select('transactions.id as id','transactions.paidamount as paidamt','transactions.paymentdate as paydate','transactions.paymenttime as paytime','transactions.balanceamount as balanceamount','transactions.voucher_number as vouchernumber','invoice.invoice_number as invoiceno','invoice.totalamt as totalamt','staff.firstname','staff.lastname','invoice.reg_id','customer.name as customername')
            ->where('transactions.category','=','registration')
            ->orderBy('transactions.id','desc')
            ->get();            
            return view('receiptlist', ['receiptlist' => $receipts, 'frmdate'=>'', 'todate'=>'', 'customer'=>'', 'invoiceno'=>'', 'voucherno'=>'']);
        }
        return redirect("/")->withError('You do not have access');
    }

    public function searchreceiptlist(Request $request)
    {
        $frmdate = $request->searchfrmdate;
        $todate = $request->searchtodate;
        $customer = $request->searchcustomer;
        $invoiceno = $request->searchinvoice;
        //dd($invoiceno);
        $voucherno = $request->searchvoucher;

            $receipts = Transactions::join('invoice','invoice.id','=','transactions.invoice_id')
                    ->join('staff','staff.id','=','transactions.staff_id')
                    ->join('registration','registration.id','=','invoice.reg_id')
                    ->join('customer','customer.id','=','registration.cust_id');
            if($frmdate){
                $receipts = $receipts->where('transactions.paymentdate','>=',$frmdate);
            }
            if($todate){
                $receipts = $receipts->where('transactions.paymentdate','<=',$todate);
            }
            if($customer) {
                $receipts = $receipts->where('customer.name','like',"%$customer%"); 
            }
            if($invoiceno) {
                $receipts = $receipts->where('invoice.invoice_number','like',"%$invoiceno%"); 
            }
            if($voucherno) {
                $receipts = $receipts->where('transactions.voucher_number','like',"%$voucherno%"); 
            }
                $receipts = $receipts->select('transactions.id as id','transactions.paidamount as paidamt','transactions.paymentdate as paydate','transactions.paymenttime as paytime','transactions.balanceamount as balanceamount','transactions.voucher_number as vouchernumber','invoice.invoice_number as invoiceno','invoice.totalamt as totalamt','staff.firstname','staff.lastname','invoice.reg_id','customer.name as customername')
            ->where('transactions.category','=','registration')
            ->orderBy('transactions.id','desc')
            ->get(); 
            
            return view('receiptlist', [
                'receiptlist' => $receipts, 
                'frmdate'=>$frmdate, 
                'todate'=>$todate, 
                'customer'=>$customer, 
                'invoiceno'=>$invoiceno, 
                'voucherno'=>$voucherno
            ]);

    }




    public function viewrecepits(Request $request){
         
        $id = $request->id;
       // $receipts = Transactions::where('id','=',$id)->get();

        $receipts = Transactions::join('invoice','invoice.id','=','transactions.invoice_id')
            ->join('staff','staff.id','=','transactions.staff_id')
            ->join('registration','registration.id','=','invoice.reg_id')
            ->join('customer','customer.id','=','registration.cust_id')
            ->join('master_payment_method','master_payment_method.id','=','transactions.paymentmethod')
            ->select('transactions.id as id','transactions.paidamount as paidamt','transactions.paymentdate as paydate','transactions.paymenttime as paytime','transactions.balanceamount as balanceamount','transactions.voucher_number as vouchernumber','invoice.invoice_number as invoiceno','invoice.totalamt as totalamt','staff.firstname','staff.lastname','invoice.reg_id','customer.name as customername','master_payment_method.paymentmethod as paymenttype')
            ->where('transactions.id','=',$id)
            ->orderBy('transactions.id','desc')
            ->first();  
        //$invdata['receipts'] = $receipts;
        return Response($receipts);
        
    }
}
