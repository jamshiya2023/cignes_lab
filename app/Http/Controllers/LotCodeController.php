<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\LotCode;

class LotCodeController extends Controller
{
    public function lotcodeview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $lotcode = LotCode::select('*')
            ->orderBy('id','desc')
            ->get();
            return view('master_lot_code', ['lotcode' => $lotcode]);
        }
        return redirect("/")->withError('You do not have access');
    }

    public function lotcodeadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $lotcode = new LotCode;
            $lotcode->controlname = $request->input('controlname');
            $lotcode->lotcode = $request->input('lotcode');
            $lotcode->const_mean = $request->input('constmean');
            $lotcode->const_sd = $request->input('constsd');
            $lotcode->status = '1';
            $lotcode->staffid = $userId;
            $lotcode->branchid = '0';        
            $lotcode->save();
            return redirect("lot-code")->withSuccess('Lot code added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }

    public function editlotcodeview(Request $request)
    {         
       $id = $request->id;
       $lotcode = LotCode::where('id',$id)
                ->select('id','controlname','lotcode','const_mean','const_sd')
                ->first();
       return Response($lotcode);
    }

    public function lotcodeedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $lotcode = LotCode::find($id);
        $lotcode->controlname = $request->input('controlnameedit');
        $lotcode->lotcode = $request->input('lotcodeedit');
        $lotcode->const_mean = $request->input('constmeanedit');
        $lotcode->const_sd = $request->input('constsdedit');
        $lotcode->update();
        return redirect("lot-code")->withSuccess('Lot code updated successfully');    
    }

    // BLOCKING AND UNBLOCKING LOT CODE STARTS HERE
    public function block(Request $request, $id)
    {
        $lotcode = LotCode::find($id);
        $lotcode->status = '0';        
        $lotcode->update();
        return redirect("lot-code")->withSuccess('Lot code blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $lotcode = LotCode::find($id);
        $lotcode->status = '1';        
        $lotcode->update();
        return redirect("lot-code")->withSuccess('Lot code unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING LOT CODE ENDS HERE 
}
