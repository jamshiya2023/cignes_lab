<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\LeadUpdate;
use App\Models\MasterLeadStatus;
use DB;
use App\Http\Controllers\Controller;



class LeadUpdateController extends Controller
{
  
     
    

    public function addupdatelead(Request $request)
{
    $itempurchase= new LeadUpdate;
  
    $itempurchase->update_note = $request->updatenote;
    $itempurchase->update_time= $request->updatecontacttime;
    $itempurchase->update_date= $request->updatecontactdate;
    $itempurchase->update_status= $request->leadstatusupdate;
    $itempurchase->save();
    return redirect("list-lead")->withSuccess('Lead Update added successfully');

}



}
