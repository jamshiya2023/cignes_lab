<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function paymentmethodview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $paymentmethods = PaymentMethod::select('id','paymentmethod','status')
            ->orderBy('id','desc')
            ->get();
            return view('master_payment_method', ['paymentmethods' => $paymentmethods]);
        }
        return redirect("/")->withError('You do not have access');
    }
    public function paymentmethodadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $paymentmethod = new PaymentMethod;
            $paymentmethod->paymentmethod = $request->input('paymentmethodname');
            $paymentmethod->status = '1';
            $paymentmethod->staffid = $userId;
            $paymentmethod->branchid = '0';        
            $paymentmethod->save();
            return redirect("payment-method")->withSuccess('Payment method added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }
    public function editpaymentmethodview(Request $request)
    {         
       $id = $request->id;
       $paymentmethod = PaymentMethod::where('id',$id)
                ->select('id','paymentmethod')
                ->first();
       return Response($paymentmethod);
    }

    public function paymentmethodedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $paymentmethod = PaymentMethod::find($id);
        $paymentmethod->paymentmethod = $request->input('paymentmethodnameedit');
        $paymentmethod->update();
        return redirect("payment-method")->withSuccess('Payment method updated successfully');    
    }

    // BLOCKING AND UNBLOCKING Payment method STARTS HERE
    public function block(Request $request, $id)
    {
        $paymentmethod = PaymentMethod::find($id);
        $paymentmethod->status = '0';        
        $paymentmethod->update();
        return redirect("payment-method")->withSuccess('Payment method blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $paymentmethod = PaymentMethod::find($id);
        $paymentmethod->status = '1';        
        $paymentmethod->update();
        return redirect("payment-method")->withSuccess('Payment method unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING Payment method ENDS HERE  
}
