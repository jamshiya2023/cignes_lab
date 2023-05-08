<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Invoicedetails;
use App\Models\PaymentMethod;
use App\Models\Transactions;

class FinanceInvoiceController extends Controller
{
    public function financeinvoicelistview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $invoicelist = Invoice::join('registration','invoice.reg_id','=','registration.id')
            ->join('customer','registration.cust_id','=','customer.id')
            ->select('invoice.*','customer.name as name','customer.phone as phone','customer.place as place','registration.registerdate as date','registration.registertime as time')
            ->orderBy('invoice.id','desc')
            ->get();
            return view('invoicelist', ['invoicelist' => $invoicelist]);
        }
        return redirect("/")->withError('You do not have access');
    }

    public function financeviewinvoicelist(Request $request)
    {         
       $id = $request->id;
       $customerdetails = Invoice::join('registration','invoice.reg_id','=','registration.id')
                ->join('customer','registration.cust_id','=','customer.id')
                ->join('country','registration.country','=','country.id')
                ->select('invoice.*','customer.name as name','customer.phone as phone','customer.place as place','customer.email as email','registration.registerdate as date','registration.registertime as time','registration.add_line_one as addone','registration.add_line_two as addtwo','registration.city as city','registration.pincode as pincode','country.country_name as country')
                ->where('invoice.id',$id)
                ->get();
        $invoicedetails = Invoicedetails::join('alltests','alltests.id','=','invoicedetails.test_name')
                ->where('invoice_id',$id)
                ->select('alltests.testname as testname','invoicedetails.test_unitprice as unitprice','invoicedetails.test_discount as discount','invoicedetails.test_tax_amount as tax','invoicedetails.test_subtotal as subtotal')
                ->get();        
                $invdata['invoicedetails'] = $invoicedetails;
                $invdata['customerdetails'] = $customerdetails;
       return Response($invdata);
    }


    public function financeviewpayment(Request $request)
    {
        $id = $request->id;
        $paymentdetails = Invoice:: where('id',$id)->select('id as invid','invoice_number','totalamt','paidamt','balanceamt')->get();
        $paymentmethods = PaymentMethod::where("status", "=", 1)->select('id','paymentmethod')->get();
        $invdata['paymentdetails'] = $paymentdetails;
        $invdata['paymentmethods'] = $paymentmethods;
        return Response($invdata);
    }

    function financepaymentupdate(Request $request){        
        $id = $request['hiddenid'];
        $invid = $request['hiddeninvoiceid'];
        $paymentmethod = $request['paymentmethod'];
        $paidamt =  number_format((float)$request['paidamount'], 2, '.', '');

        $updatepayment = Invoice::find($id);
        $grandtotal = $updatepayment->totalamt;
        $previouspaid = $updatepayment->paidamt;
        $previousbalance = $updatepayment->balanceamt;
        $totalpaid = $previouspaid+$paidamt;
        $currentbalance = $grandtotal-$totalpaid;
        $roundtotalpaid = number_format((float)$totalpaid, 2, '.', '');
        $roundbalanceamt = number_format((float)$currentbalance, 2, '.', '');
        if($roundbalanceamt == '0.00'){
            $paymenttype = 'paid';
        }else {
            $paymenttype = 'partial';
        }
        
        $updatepayment->paidamt = $roundtotalpaid;
        $updatepayment->balanceamt = $roundbalanceamt;
        $updatepayment->paymentstatus = $paymenttype;
        $updatepayment->paymentmethod = $paymentmethod;
        $updatepayment->update();
        
        $transaction = new Transactions();
        $transaction->invoice_id = $invid;
        $transaction->category  = 'registration';
        $transaction->transaction_type  = 'income';
        $transaction->paidamount = $paidamt;
        $transaction->save();

        return redirect("invoice-list")->withSuccess('Payment updated successfully');
    }

}
