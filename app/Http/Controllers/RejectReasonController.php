<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\RejectReason;

class RejectReasonController extends Controller
{
    public function rejectreasonview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $rejectreasons = RejectReason::select('id','rejectreason','status')
            ->orderBy('id','desc')
            ->get();
            return view('master_reject_reason', ['rejectreasons' => $rejectreasons]);
        }
        return redirect("/")->withError('You do not have access');
    }
    public function rejectreasonadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $rejectreason = new RejectReason;
            $rejectreason->rejectreason = $request->input('rejectreasonname');
            $rejectreason->status = '1';
            $rejectreason->staffid = $userId;
            $rejectreason->branchid = '0';        
            $rejectreason->save();
            return redirect("reject-reason")->withSuccess('Reject reason added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }
    public function editrejectreasonview(Request $request)
    {         
       $id = $request->id;
       $rejectreason = RejectReason::where('id',$id)
                ->select('id','rejectreason')
                ->first();
       return Response($rejectreason);
    }

    public function rejectreasonedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $rejectreason = RejectReason::find($id);
        $rejectreason->rejectreason = $request->input('rejectreasonnameedit');
        $rejectreason->update();
        return redirect("reject-reason")->withSuccess('Reject reason updated successfully');    
    }

    // BLOCKING AND UNBLOCKING REJECT REASON STARTS HERE
    public function block(Request $request, $id)
    {
        $rejectreason = RejectReason::find($id);
        $rejectreason->status = '0';        
        $rejectreason->update();
        return redirect("reject-reason")->withSuccess('Reject reason blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $rejectreason = rejectreason::find($id);
        $rejectreason->status = '1';        
        $rejectreason->update();
        return redirect("reject-reason")->withSuccess('Reject reason unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING REJECT REASON ENDS HERE 

}
