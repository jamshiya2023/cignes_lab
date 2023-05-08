<?php

 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Registration;
use App\Models\Invoice;
use App\Models\Parameter;
use App\Models\Normalrange;
use App\Models\Testresult;
use App\Models\TestReport;
use App\Models\Staff;
use App\Models\Logactivity;
use App\Models\SampleStatusDetails;
 
class TestController extends Controller
{
      public function testview()
       {
            if(Auth::check()){
             $userId = Auth::id();
           
	  $testlist = Invoice::join('registration','invoice.reg_id','=','registration.id')
            ->join('customer','registration.cust_id','=','customer.id')
			  ->join('sample_status_details','registration.id','=','sample_status_details.reg_id')
              // ->where('sample_status_details.collection_status','accepted')
			    ->select('sample_status_details.id as sampleid','registration.id','customer.name','customer.phone','customer.place','registration.registerdate')
			    ->orderBy('sample_status_details.id','desc')
                 ->get();
                 
       foreach($testlist as $pract)
				
				{
					$regid = $pract->id;
					
				}
				
				$reporttest = Testreport::where('reg_id',$regid)->get();          
            return view('testresult',['testlist'=>$testlist,'reporttest'=>$reporttest]);
        }
         return redirect("/")->withError('You do not have access');
     }
	  
	 public function testlist_view(Request $request){
      
	  $sampleid = $request->input('id');
	   $testlists = Registration:: join('invoice','registration.id','=','invoice.reg_id')
			->join('customer','registration.cust_id','=','customer.id')
			->join('testresult','registration.id','=','testresult.reg_id')
			->join('sample_status_details','registration.id','=','sample_status_details.reg_id')
			->join('alltests','sample_status_details.test_id','=','alltests.id')
			->join('normalranges','alltests.id','=','normalranges.singletest_id')
			 ->join('testreport','sample_status_details.id','=','testreport.test_sample_id')
				
            ->where('sample_status_details.id',$sampleid)
            ->select('testreport.result','normalranges.malerange','normalranges.generalrange','registration.id as rid','alltests.id as sid','alltests.testname','registration.gender','registration.id','customer.name','customer.phone','customer.email','registration.add_line_one','customer.place','registration.registerdate','testresult.status')
            ->get();
			
	 foreach($testlists as $test){
		  $rid = $test->rid;
		  $name = $test->name;
		  $email = $test->email;
		  $address = $test->add_line_one;
		  $phone = $test->phone;
		  $place = $test->place;
		  $testname = $test->testname;
		  $parameters = $test->parameter_id;
		  $sid = $test->sid;
		  $gender = $test->gender;
		  $femalerange = $test->femalerange;
		  $malerange = $test->malerange;
		  $registerdate = $test->registerdate;
		   
		  
	 }
	    
		// $datas['parameters'] = $paraname; 
		   $datas['testlists'] = $testlists; 
	       $datas['rid'] = $rid; 
           $datas['name'] = $name; 
		   $datas['address'] = $address;   
	       $datas['email'] = $email; 
		   $datas['phone'] = $phone; 
		   $datas['place'] = $place; 
		   $datas['date'] = $registerdate; 
		   $datas['testname'] = $testname; 
		   
	  return response()->json($datas);  
		
	 }
	 
	 
	 public function testdetails_view(Request $request){
      
	  $sampleid = $request->input('id');
	   $testlists = Registration:: join('invoice','registration.id','=','invoice.reg_id')
	   	    ->join('customer','registration.cust_id','=','customer.id')
			->join('testresult','registration.id','=','testresult.reg_id')
			->join('sample_status_details','registration.id','=','sample_status_details.reg_id')
			->join('alltests','sample_status_details.test_id','=','alltests.id')
		 	->join('normalranges','alltests.id','=','normalranges.singletest_id')
		 
		    ->where('sample_status_details.id',$sampleid)
            ->select('normalranges.malerange','normalranges.generalrange','registration.id as rid','alltests.id as sid','alltests.testname','registration.gender','registration.id','customer.name','customer.phone','customer.email','registration.add_line_one','customer.place','registration.registerdate','testresult.status')
           	->orderBy('sample_status_details.id','desc')
            ->get();
			
	 foreach($testlists as $test){
		  $sid =  $test->sid;
		  $rid  =  $test->rid;
		  $name  =  $test->name;
		  $email  =  $test->email;
		  $phone   =  $test->phone;
		  $place    =  $test->place;
		  $testname  =  $test->testname;
		  $address    =  $test->add_line_one;
		  $parameters  =  $test->parameter_id;
		        $gender = $test->gender;
		    $femalerange = $test->femalerange;
		       $malerange = $test->malerange;
		     $registerdate = $test->registerdate;
	 }
	  	/*
	 
	  $normalrange = Normalrange::where('id',$sid)->get();
	 foreach($normalrange as $range)
	 
	 {
		$generalrange = $range->generalrange;
		$malerange = $range->malerange;
        $femalerange = $range->femalerange;
		 		
		
	 }
 if($gender =='Male')
	 {
		 $daterange = $range->malerange;
		 
	 }
	 else if($gender =='Female')
	  {
		  $daterange =$range->femalerange;
		 
	   }
	  
	 
  $testlists['daterange'] = $daterange;
	 */
	 //return $query->result();
	 /* $params = json_decode($parameters);
		  $size = count($params); 
		     $g = array();	 
		  for ($i = 0; $i < $size; $i++){
		    $g = $params[$i];
			
			  $parameters = Parameter::where('id',$g)->get();
  		foreach($parameters as $paramz)
		{
			$paraname['id'][] = $paramz->id;
			$paraname['name'][] = $paramz->parameter_name;
			
		}
		
		} */
		// $datas['parameters'] = $paraname; 
		   $datas['testlists'] = $testlists; 
	       $datas['rid'] = $rid; 
           $datas['name'] = $name; 
		   $datas['address'] = $address;   
	       $datas['email'] = $email; 
		   $datas['phone'] = $phone; 
		   $datas['place'] = $place; 
		   $datas['date'] = $registerdate; 
		   $datas['testname'] = $testname; 
		   
	  return response()->json($datas);  
		
	 }
	   function addtestresult(Request $request)
       {
		   $sampleid = $request->sampleidss;
		   
		  $samplez = SampleStatusDetails::where('id',$sampleid)->get();
		    
		   foreach($samplez as $sample)
		   {
			  $regid= $sample->reg_id;
			 $testid=  $sample->test_id;
		   }
		    
		   $invoicez = Invoice::where('reg_id',$regid)->get();
		   foreach($invoicez as $invoice)
		   {
			  $invoiceid= $invoice->id;
			  
		   }
		   
		 // dd($invoicez);die();
	   $testresult = new Testreport;
        $testresult->reg_id = $regid;
		 $testresult->invoice_id = $invoiceid;
		  $testresult->test_id = $testid;  
		   $testresult->test_sample_id = $sampleid;
            $testresult->result = $request['normalrange_min'];
             //$testresult->normalrage_max = $request['normalrange_max'];
              $testresult->status = '1';
               $testresult->save();
                 $loguserid = Auth::user()->staff_id;
	           $logbranchid = Auth::user()->branchid;
              $logurl = url()->current();
             $logip = request()->ip();
            $logmethod =  request()->method();
           $logagent = $request->header('User-Agent');
          $logsubject = "Test Result";
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
		
		
		$SampleStatusDetails = SampleStatusDetails::find($sampleid);
		$SampleStatusDetails->collection_status  = 'update result';
		 $SampleStatusDetails->update();
		
	 return redirect("test-result")->withSuccess('Test Result Added successfully');    
		  
	  }
	      
		  public function testreports()
       {
            if(Auth::check()){
             $userId = Auth::id();
           
	        $testreport = Invoice::join('registration','invoice.reg_id','=','registration.id')
            ->join('customer','registration.cust_id','=','customer.id')
			  ->join('sample_status_details','registration.id','=','sample_status_details.reg_id')
                ->join('testreport','sample_status_details.id','=','testreport.test_sample_id')
				->where('sample_status_details.collection_status','accepted')
			     ->select('sample_status_details.id as sampleid','registration.id','customer.name','customer.phone','customer.place','registration.registerdate')
                  ->get();
             return view('testreport',['testreport'=>$testreport]);
        }
         return redirect("/")->withError('You do not have access');
     }
		  
	 public function invoice_refundview33(Request $request){
        $registerid = $request->input('id');
		  
		$testlists = Invoice::join('registration','invoice.reg_id','=','registration.id')
            ->join('customer','registration.cust_id','=','customer.id')
			  ->join('invoicedetails','invoice.id','=','invoicedetails.invoice_id')
			   ->join('alltests','invoicedetails.test_name','=','alltests.id')
			    ->where('invoice.reg_id',$registerid)
                ->select('invoice.*','customer.name as name','registration.registerdate as date','registration.registertime as time','alltests.testname as testname','alltests.primaryprice as primaryprice','invoicedetails.test_unitprice as test_unitprice','invoicedetails.test_discount as test_discount','invoicedetails.test_tax_amount as test_tax_amount','invoicedetails.test_subtotal as test_subtotal','invoicedetails.test_name as test_name','invoicedetails.id as ind_id')
                ->orderBy('invoice.id','desc')
            ->get();
			$unitprice = array();
			 foreach ($testlists as $invoice){
			$invoice_number = $invoice->invoice_number;
			$paymentstatus = $invoice->paymentstatus;
			$date = $invoice->date;
			 
			  $unitprice[] = $invoice->test_unitprice;
			 $tax_amount[] = $invoice->test_tax_amount;
			   $subtotal[] = $invoice->test_subtotal;
			 }
			  $test_unitprice = array_sum($unitprice);  
														 
	   $test_tax_amount = array_sum($tax_amount); 
	    $test_subtotal = array_sum($subtotal); 
         $datas['testlists'] = $testlists; 
          $datas['test_unitprice'] = $test_unitprice; 
		   $datas['test_tax_amount'] = $test_tax_amount; 
		    $datas['test_subtotal'] = $test_subtotal; 
		     $datas['invoice_number'] = $invoice_number; 
		      $datas['date'] = $date;
		       $datas['paymentstatus'] = $paymentstatus;
		  
        return response()->json($datas);  
    }
}
