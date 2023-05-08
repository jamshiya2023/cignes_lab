<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\MasterLeadStatus;
use App\Models\MaterLeadSource;
use App\Models\Lead;
use App\Models\Staff;
use App\Models\Department;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;





class LeadsController extends Controller
{
    public function viewaddlead()
    {
        if(Auth::check()){ 

            $leadstatus = MasterLeadStatus::select('*')->get();
            $leadsource = MaterLeadSource::select('*')->get();
            $leaddepartment = Department::select('*')->where('department_name','=','Call Center')->get();
            foreach ($leaddepartment as $listdepatment)
            $did= $listdepatment->id;
            $leadstaff = Staff::select('*')->where('department_id','=',$did)->get();
            
          

            return view('addlead',compact('leadstatus','leadsource','leadstaff'));
    }
    return redirect("/")->withError('You do not have access');

} 


    public function viewleadlist()
    {
       
        if(Auth::check()){  

        $itempurchases = Lead::join('master_lead_status','master_lead_status.id','=','leads.level_status')
        ->leftjoin('master_lead_source', 'master_lead_source.id', '=', 'leads.level_source')
        ->join('staff','staff.id','=','leads.assigned_staffs')
        ->join('users','users.staff_id', '=' ,'leads.user')
        ->orderBy('leads.id','DESC')
        ->select('leads.*','master_lead_status.leadstatus_name','master_lead_source.leadsource_name','users.username','staff.firstname')
        ->get();
       
        $leadstatusupdate = MasterLeadStatus::select('*')->get();


        return view('leadlist',compact('itempurchases','leadstatusupdate'));
        }    
    
        return redirect("/")->withError('You do not have access');
    }




    public function addlead(Request $request)
    {
        
 
        // if($loguserid == '0') {
        //            $logusername = 'Super admin';
        //        } else {
        //            $loguserqry = Lead::where('id',$loguserid)->first();
        //            $logusername = $loguserqry->username;

        //        }
               
            //  $log->user_id = $loguserid;
            //  $log->staff_name = $logusername;
            //  dd($logusername);die();
            $loguserid = Auth::user()->staff_id;
            
     $itempurchase= new Lead;
     $itempurchase->lead_title = $request->leadtitle;
     $itempurchase->contact_name = $request->contactname;
     $itempurchase->contact_number = $request->contactnumber;
     $itempurchase->level_status = $request->leadstatus ;
     $itempurchase->level_source = $request->leadsource;
     $itempurchase->email= $request->email;
     $itempurchase->note = $request->note;
     $itempurchase->contact_date= $request->contactdate;
     $itempurchase->contact_time= $request->contacttime;
     $itempurchase->current_date= $request->currenttime;
     $itempurchase->current_time= $request->currentdate;
     $itempurchase->assigned_staffs= $request->assignedstaff;
     $itempurchase->user= $request->assignedstaff;
     $itempurchase->status = '1';
     $itempurchase->save();
    
    
     return redirect("list-lead")->withSuccess('Lead Item added successfully');
    
    
    }

    public function editlead($id)
    {
    //    dd($id);
         $itempurchases=Lead::where('leads.id',$id)
         ->first();
         $leadstatus = MasterLeadStatus::select('*')->get();
         $leadsource = MaterLeadSource::select('*')->get();
         $leaddepartment = Department::select('*')->where('department_name','=','Call Center')->get();
            foreach ($leaddepartment as $listdepatment)
            $did= $listdepatment->id;
            $leadstaff = Staff::select('*')->where('department_id','=',$did)->get();
         
        return view('editlead' ,compact('itempurchases','leadstatus','leadsource','leadstaff'));
    }


    public function updatelead(Request $request)
    {
        $id = $request->hiddenid;
        
        $itempurchases = Lead::find($id);
        //  dd($itempurchases);die();
        
      
        $itempurchases->lead_title = $request->input('leadtitle');  
        $itempurchases->contact_name = $request->input('contactname');  
        $itempurchases->contact_number=$request->input('contactnumber');
        $itempurchases->level_status=$request->input('leadstatus');
        $itempurchases->level_source=$request->input('leadsource');
        $itempurchases->email=$request->input('emailedit');
        $itempurchases->note=$request->input('note');
        $itempurchases->contact_time=$request->input('contacttime');
        $itempurchases->contact_date=$request->input('contactdate');
        $itempurchases->assigned_staffs=$request->input('assignedstaff');
       
        $itempurchases->update();
        return redirect("list-lead")->withSuccess('Lead updated successfully');

    }
   

    
    public function leadview(Request $request)
    {   
                
            
            $id = $request->id;      
            $itempurchases = Lead::where('leads.id',$id) 
              ->join('master_lead_status','master_lead_status.id','=','leads.level_status')
              ->leftjoin('master_lead_source','master_lead_source.id','=','leads.level_source')
              ->join('staff','staff.id','=','leads.assigned_staffs')
              ->join('users','users.staff_id', '=' ,'leads.user')

             ->select('leads.*','master_lead_status.leadstatus_name as leadstatus','master_lead_source.leadsource_name as leadsource','staff.firstname','users.username')
                
                //'master_lead_source.leadsource_name','users.username','staff.firstname')

                  ->first();
                return Response($itempurchases);
}



public function viewupdatelead()
{
    if(Auth::check()){
        $leadstatus = MasterLeadStatus::select('*')->get();
        return view('leadlist',compact('leadstatus'));

     }
    
    return redirect("/")->withError('You do not have access');

}


 public function addupdatelead(Request $request)
 {
 $category= new lead_update;
$category->update_note = $request->updatenote;
 $category->update_date = $request->updatecontactdate;
 $category->update_time = $request->updatecontacttime;
 $category->status = '1';
 $category->save();
 return redirect("list-lead")->with('Updatesuccess', "Update added successfully");
}


public function blocklead(Request $request,$id)
{
     $itempurchases = Lead::find($id);
     $itempurchases->status = '0';
     $itempurchases->update();
    //  return redirect("list-lead")->with('WareHousesuccess', "Warehouse blocked successfully");
     return redirect("list-lead")->withSuccess('Lead Item blocked successfully');

}
public function unblocklead(Request $request,$id)
{   
     $itempurchases= Lead::find($id);
     $itempurchases->status = '1';
     $itempurchases->update();
    //  return redirect("list-lead")->with('WareHousesuccess', "Warehouse unblocked successfully");
     return redirect("list-lead")->withSuccess('Lead Item blocked successfully');

}


}
