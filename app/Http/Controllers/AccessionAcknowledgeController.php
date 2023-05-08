<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\Testresult;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\RejectReason;
use App\Models\SampleStatusDetails;

use App\Models\AllTests;
use App\Models\Staff;
use App\Models\Logactivity;
use App\Models\Customer;

class AccessionAcknowledgeController extends Controller
{
    public function viewaccessionacknowledge()
    {       if(Auth::check()){        
                /*$sampledata = Registration::join('customer','registration.cust_id','=','customer.id')
                                    ->join('testresult','registration.id','=','testresult.reg_id')
                                    ->select('customer.name as customername', 'customer.phone as customerphone', 'customer.place as customerplace', 'registration.id as regid', 'registration.registerdate as regdate', 'registration.registertime as regtime')
                                    ->orderBy('registration.id', 'DESC')
                                    ->where('testresult.status','collected')
                                    ->distinct('registration.id')
                                    ->get();
                                    */

                $sampledata = DB::table('registration')
                    ->join('customer','customer.id','=','registration.cust_id')
                    ->join('testresult','registration.id','=','testresult.reg_id')
                    ->select('registration.id as regid', 'customer.name as customername', 'customer.phone as customerphone', 'customer.place as customerplace', 'registration.registerdate as regdate', 'registration.registertime as regtime', DB::raw('SUM(testresult.status = "rejected") rejected'), DB::raw('SUM(testresult.status = "notcollected") notcollected'), DB::raw('SUM(testresult.status = "pending") pending'), DB::raw('SUM(testresult.status = "collected") collected'), DB::raw('SUM(testresult.status = "accepted") accepted'))
                    ->orderBy('registration.id', 'DESC')
                    ->where('testresult.status','notcollected')
                    ->orWhere('testresult.status','pending')
                    ->orWhere('testresult.status','rejected')
                    ->orWhere('testresult.status','collected')
                    ->orWhere('testresult.status','accepted')
                    ->groupBy('registration.id')
                    ->get();                    
                                    //->toSql();

                                    //dd($sampledata);    
                
                return view('accession_acknowledge', ['sampledata' => $sampledata]);

            }
            return redirect("/")->withError('You do not have access');
    }
    
    public function searchaccessionacknowledge(Request $request){
        
          
         $status = $request->status;
         $rno =    $request->registration_number;
         $date =   $request->date;
         $customer = $request->customer;
      
        $sampledata =DB::table('customer')
                    ->join('registration','registration.cust_id','=','customer.id')
                    ->join('testresult','registration.id','=','testresult.reg_id');
		   
		  
		    if($rno){
			   $sampledata = $sampledata->where('registration.id','like',"%$rno%"); 
            }
			
 		if($date){
  			   $sampledata = $sampledata->where('registration.registerdate','like',"%$date%"); 
            }
		   
		 	if($customer){
			   $sampledata = $sampledata->where('customer.name','like',"%$customer%"); 
	          }
		 
			$sampledata = $sampledata->select('registration.id as regid', 'customer.name as customername', 'customer.phone as customerphone', 
                    'customer.place as customerplace', 'registration.registerdate as regdate', 'registration.registertime as regtime', 
                    DB::raw('SUM(testresult.status = "rejected") rejected'), DB::raw('SUM(testresult.status = "notcollected") notcollected'),
                    DB::raw('SUM(testresult.status = "pending") pending'), DB::raw('SUM(testresult.status = "collected") collected'),
                    DB::raw('SUM(testresult.status = "accepted") accepted'))
                      ->get(); 
			 //  dd($sampledata);die();
		 return view('accession_acknowledge', ['sampledata' => $sampledata]);
            
                   
    }

    public function accessionacknowledgepopupview(Request $request){
        $registerid = $request->input('id');
        $testlists = Testresult::join('alltests','alltests.id','=','testresult.test_id')
        ->select('testresult.id as id', 'testresult.status as status', 'testresult.sample_collection_note as collectionnote', 'testresult.sample_collected_date_time as collectiondate', 'testresult.sample_received_date_time as recevieddate', 'testresult.reject_reason as rejectionreason', 'testresult.reg_id as rid', 'alltests.testname as testname')
            ->where(function($query){
                $query->where('testresult.status','=','collected');
                //->orWhere('testresult.status','=','notcollected')
                //->orWhere('testresult.status','=','rejected');
         })
        ->where('testresult.reg_id',$registerid)
        ->get();
        //->toSql();

        $reasons = RejectReason::where('status',1)->select('id as reasonid','rejectreason as reasonname')->get();
        $datas['testlists'] = $testlists;
        $datas['reasons'] = $reasons;
        $datas['rid'] = $registerid;
        return response()->json($datas);
    }


    public function updateaccessionacknowledge(Request $request)
    {
        $id = $request->input('id'); 
        $registerid = $request->input('reg');
        $status = $request->input('status');
        $rejectionreason = $request->input('rejectionreason');
        $collectionnote = $request->input('rejectionnote');

        $upquery = Testresult::where('id',$id)
        ->update([
            'reject_reason'=> $rejectionreason,
            'reject_note'=> $collectionnote,
            'status'=>$status,
            'staff_id'=>Auth::user()->staff_id,
            'branch_id'=>Auth::user()->branchid,

            ]);



           if($upquery) { 
            
            $testdetails = Testresult::where('id',$id)->select('cust_id','reg_id','test_id')->first(); 
            
            // LOG ACTIVITY STARTS HERE 
            $logtest = AllTests::where('id',$testdetails->test_id)->select('testname')->first(); 
            $logcustomer = Customer::where('id',$testdetails->cust_id)->select('name')->first();
            $loguserid = Auth::user()->staff_id;
            $logbranchid = Auth::user()->branchid;
            $logurl = url()->current();
            $logip = request()->ip();
            $logmethod =  request()->method();
            $logagent = $request->header('User-Agent');
            $logsubject = $status." sample for ".$logtest->testname." test of ".$logcustomer->name;
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
            $samplestatus->reject_reason = $rejectionreason;
            $samplestatus->reject_note = $collectionnote;
            $samplestatus->sample_rejected_date_time = date('d-m-Y h:i A');
            $samplestatus->collection_status = $status;
            $samplestatus->staff_id = $loguserid;
            $samplestatus->branch_id = $logbranchid;
            $samplestatus->save(); 










            $testlists = Testresult::join('alltests','alltests.id','=','testresult.test_id')
            ->select('testresult.id as id', 'testresult.status as status', 'testresult.sample_collection_note as collectionnote', 'testresult.sample_collected_date_time as collectiondate', 'testresult.sample_received_date_time as recevieddate', 'testresult.reject_reason as rejectionreason', 'testresult.reg_id as rid', 'alltests.testname as testname')
                    ->where(function($query){
                        $query->where('testresult.status','=','collected');
                        //->orWhere('testresult.status','=','notcollected')
                        //->orWhere('testresult.status','=','rejected');
                })
                ->where('testresult.reg_id',$registerid)
                ->get();

            $count = Testresult::join('alltests','alltests.id','=','testresult.test_id')
                    ->where(function($query){
                        $query->where('testresult.status','=','collected');
                        //->orWhere('testresult.status','=','notcollected')
                        //->orWhere('testresult.status','=','rejected');
                })
                ->where('testresult.reg_id',$registerid)->count();  
                
                $reasons = RejectReason::where('status',1)->select('id as reasonid','rejectreason as reasonname')->get();
         
                    $datas['tests'] = $testlists;
                    $datas['remains'] = $count;
                    $datas['reasons'] = $reasons;
                    $datas['msg'] = $status;
                    return response()->json($datas);
               
           } 
        
    
    
    }

}
