<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\Testresult;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\SampleStatusDetails;
use App\Models\RejectReason;
use App\Models\AllTests;
use App\Models\Staff;
use App\Models\Logactivity;
use App\Models\Customer;



class SampleCollectionsController extends Controller
{
    public function viewsamplecollections()
    {       if(Auth::check()){    
            $sampledata = DB::table('registration')
                ->join('customer','customer.id','=','registration.cust_id')
                ->join('testresult','registration.id','=','testresult.reg_id')
                ->leftjoin('staff','staff.id','=','registration.staffid')
                ->select('registration.id as regid', 'staff.firstname as stafffirstname', 'staff.lastname as stafflastname', 'customer.name as customername', 'customer.phone as customerphone', 'customer.place as customerplace', 'registration.registerdate as regdate', 'registration.registertime as regtime', DB::raw('SUM(testresult.status = "rejected") rejected'), DB::raw('SUM(testresult.status = "notcollected") notcollected'), DB::raw('SUM(testresult.status = "pending") pending'), DB::raw('SUM(testresult.status = "collected") collected'), DB::raw('SUM(testresult.status = "accepted") accepted'))
                ->orderBy('registration.id', 'DESC')
                ->where('testresult.status','notcollected')
                ->orWhere('testresult.status','pending')
                ->orWhere('testresult.status','rejected')
                ->orWhere('testresult.status','collected')
                ->orWhere('testresult.status','accepted')
                ->groupBy('registration.id') 
                ->get();
               return view('samplecollection', ['sampledata' => $sampledata,'frmdate'=>'','todate'=>'','customer'=>'','registerno'=>'','phone'=>'']);
            }
            return redirect("/")->withError('You do not have access');
    }

    public function searchsamplecollection(Request $request)
    {
        $frmdate = $request->searchfrmdate;
        $todate = $request->searchtodate;
        $customer = $request->searchcustomer;
        $registerno = $request->searchregister; 
        $phone=$request->searchphone;
        
     
       

        $sampledata = DB::table('registration')
                ->join('customer','customer.id','=','registration.cust_id')
                ->join('testresult','registration.id','=','testresult.reg_id')
                ->leftjoin('staff','staff.id','=','registration.staffid');
        
        $sampledata = $sampledata->select('registration.id as regid', 'staff.firstname as stafffirstname','registration.emergencynumber as phone', 'staff.lastname as stafflastname', 'customer.name as customername', 'customer.phone as customerphone', 'customer.place as customerplace', 'registration.registerdate as regdate', 'registration.registertime as regtime', DB::raw('SUM(testresult.status = "rejected") rejected'), DB::raw('SUM(testresult.status = "notcollected") notcollected'), DB::raw('SUM(testresult.status = "pending") pending'), DB::raw('SUM(testresult.status = "collected") collected'), DB::raw('SUM(testresult.status = "accepted") accepted'))
                ->orderBy('registration.id', 'DESC');

                /*->where('testresult.status','notcollected')
                ->orWhere('testresult.status','pending')
                ->orWhere('testresult.status','rejected')
                ->orWhere('testresult.status','collected')
                ->orWhere('testresult.status','accepted');*/
        if($frmdate){
            $sampledata = $sampledata->where('registration.registerdate','>=',$frmdate);      
        }
        if($todate){
            $sampledata = $sampledata->where('registration.registerdate','<=',$todate);
        }
        if($customer) {
            $sampledata = $sampledata->where('customer.name','like',"%$customer%"); 
        }
        if($registerno) {
                    $sampledata = $sampledata->where('registration.id','=',"$registerno"); 
        }
        if($phone){
            
            //   dd($phone);die();
            
            $sampledata = $sampledata->where('registration.emergencynumber', 'like', "%$phone%");

          
            // $sampledata = $sampledata->where('registration.emergencynumber','=',"$phone"); 
            //  dd($sampledata);die;
        }
        $sampledata = $sampledata->groupBy('registration.id')->get();
               return view('samplecollection', ['sampledata' => $sampledata,'frmdate'=>$frmdate,'todate'=>$todate,'customer'=>$customer,'registerno'=>$registerno,'phone'=>$phone]);

    }

    public function samplecollectionupdate(Request $request){
        $registerid = $request->input('id');
        $testlists = Testresult::join('alltests','alltests.id','=','testresult.test_id')
        ->leftjoin('master_reject_reason','master_reject_reason.id','=','testresult.reject_reason')
        ->select('testresult.id as id', 'testresult.status as status', 'master_reject_reason.rejectreason as rejectionreason', 'testresult.reg_id as rid', 'alltests.testname as testname', 'testresult.sample_collection_note as samplecollectionnote')
            ->where(function($query){
                $query->where('testresult.status','=','pending')
                ->orWhere('testresult.status','=','notcollected')
                ->orWhere('testresult.status','=','rejected');
         })
        ->where('testresult.reg_id',$registerid)
        ->get();
        $reasons = RejectReason::where('status',1)->select('id as reasonid','rejectreason as reasonname')->get();
        //->toSql();
        $datas['testlists'] = $testlists;
        $datas['reasons'] = $reasons;
        $datas['rid'] = $registerid;
        return response()->json($datas);
    }
    
    public function updateviewsamplecollections(Request $request)
    {
        $id = $request->input('id'); 
        $registerid = $request->input('reg');
        $status = $request->input('status');
        $collecteddate = $request->input('cdate');
        $receiveddate = $request->input('rdate');
        $collectionnote = $request->input('cnote');
        $rejreason = $request->input('rejreason');
        $rejnote = $request->input('rejnote');

//dd($request->input('cnote'));
        
     
        $upquery = Testresult::where('id',$id)
        ->update([
            'sample_collection_note'=> $collectionnote,
            'sample_collected_date_time'=> $collecteddate,
            'sample_received_date_time'=> $receiveddate,
            'reject_reason'=> $rejreason,
            'reject_note'=> $rejnote,
            'status'=>$status,
            'staff_id'=>Auth::user()->staff_id,
            'branch_id'=>Auth::user()->branchid,
            ]);



           if($upquery) { 


            $testdetails = Testresult::where('id',$id)->select('cust_id','reg_id','test_id','status')->first();                                    
            //dd($testdetails);
            // LOG ACTIVITY STARTS HERE 
            $logtest = AllTests::where('id',$testdetails->test_id)->select('testname')->first(); 
            $logcustomer = Customer::where('id',$testdetails->cust_id)->select('name')->first();
            if($status == 'collected')
            {
                $logstatus = "collected sample for".$logtest->testname." test of ".$logcustomer->name;
            } else {
                $logstatus = "moved the status of ".$logtest->testname." test's of ".$logcustomer->name." to pending status";
            }
            
            $loguserid = Auth::user()->staff_id;
            $logbranchid = Auth::user()->branchid;
            $logurl = url()->current();
            $logip = request()->ip();
            $logmethod =  request()->method();
            $logagent = $request->header('User-Agent');
            $logsubject = $logstatus;
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
            $log->branch_id = $logbranchid;
            $log->save();       
            // LOG ACTIVITY ENDS HERE  

            $samplestatus = new SampleStatusDetails;
            $samplestatus->cust_id = $testdetails->cust_id;
            $samplestatus->reg_id = $testdetails->reg_id;
            $samplestatus->test_id = $testdetails->test_id;
            $samplestatus->sample_collection_note = $collectionnote;
            $samplestatus->sample_collected_date_time = $collecteddate;
            $samplestatus->sample_received_date_time = $receiveddate;
            $samplestatus->collection_status = $status;
            $samplestatus->staff_id = $loguserid;
            $samplestatus->branch_id = $logbranchid;
            $samplestatus->save();


            $testlists = Testresult::join('alltests','alltests.id','=','testresult.test_id')
                    ->leftjoin('master_reject_reason','master_reject_reason.id','=','testresult.reject_reason')
                    ->select('testresult.id as id', 'testresult.status as status', 'testresult.sample_collection_note as samplecollectionnote', 'master_reject_reason.rejectreason as rejectionreason', 'testresult.reg_id as rid', 'alltests.testname as testname')
                    ->where(function($query){
                        $query->where('testresult.status','=','pending')
                        ->orWhere('testresult.status','=','notcollected')
                        ->orWhere('testresult.status','=','rejected');
                })
                ->where('testresult.reg_id',$registerid)
                ->get();
            
            
            $sampledatacounts = DB::table('registration')
            ->join('customer','customer.id','=','registration.cust_id')
            ->join('testresult','registration.id','=','testresult.reg_id')
            ->select('registration.id as regid', DB::raw('SUM(testresult.status = "rejected") rejected'), DB::raw('SUM(testresult.status = "notcollected") notcollected'), DB::raw('SUM(testresult.status = "pending") pending'), DB::raw('SUM(testresult.status = "collected") collected'), DB::raw('SUM(testresult.status = "accepted") accepted'))
            ->orderBy('registration.id', 'DESC')
            ->where('testresult.reg_id',$registerid)
            ->groupBy('registration.id') 
            ->get();

            $reasons = RejectReason::where('status',1)->select('id as reasonid','rejectreason as reasonname')->get();
                
        // dd($testdetails->status);
                    $datas['tests'] = $testlists;
                    $datas['sampledatacounts'] = $sampledatacounts;
                    $datas['upstatus'] = $testdetails->status;
                    $datas['reasons'] = $reasons;
                   // $datas['remains'] = $remaincount;
                   // $datas['total'] = $totalcount;
                    //$datas['remains'] = array(['cnum'=>$count]);
                    return response()->json($datas);               
           } 
    }



    public function updateviewdetails(Request $request)
    {
        
        $id = $request->input('id'); 
        // $data['success'] = $note;
        // $time = $request->input('samplenote');
        //  $date = date('d-m-Y');
        // $time = date('h:i:s A');
     
        $viewquery = Registration::where('id',$id)->first();
            $note = $viewquery->collection_note;
            $notedate = $viewquery->date;
            $notetime = $viewquery->time;
            $notestatus = $viewquery->sample_status;
            $id = $viewquery->id;
            
           if($viewquery) {
            $data['success'] = 1;
            $data['res'] = $id;
            $data['note'] = $note;
            $data['notedate'] = $notedate;
            $data['notetime'] = $notetime;
            $data['notestatus'] = $notestatus;

           } else {

           $data['success'] = 0;
            }
        

            
        //return redirect("/")>withSuccess('SampleCollection updated successfully');
    
    return response()->json($data);
    }

}