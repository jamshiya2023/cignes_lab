<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Legaldocuments;
use App\Models\Customerdocuments;
use App\Models\Registration;
use App\Models\Customer;
use App\Models\Country;
use App\Models\AllTests;
use App\Models\Invoicedetails;
use App\Models\Invoice;
use App\Models\Transactions; 
use App\Models\PaymentMethod;
use App\Models\Testresult;
use App\Models\Branch;
use DB;
use App\Models\Staff;
use App\Models\Logactivity;
use App\Models\MasterInsurance;



use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function newregistration()
    {
        if(Auth::check()){
            $master_insurance=MasterInsurance::all();
            $documenttype = Legaldocuments::where("status", "=", 1)->get();
            //$countrylist = Country::all();
            $countrylist = Country::where("status","=",1)->get();
            $branchlist = Branch::where("status","=",1)->get();
            $paymentmethod = PaymentMethod::where("status", "=", 1)->get();
            return view('registration', [
                'documenttypelist' => $documenttype,
                'countrylist' => $countrylist,
                'branchlist' => $branchlist,
                'paymentmethods' => $paymentmethod,
                'master_insurance'=>$master_insurance
            ]);
        }
        return redirect("/")->withError('You do not have access');
    }
 
  public function registrationlist()
          {
          $CustomerDetails = Customer:: join('registration','customer.id','=','registration.cust_id')
          ->orderBy("registration.id", "desc")
          ->get();
          return view('registrationlist')->with('CustomerDetails', $CustomerDetails);    
        }
    public function editregistration($id)
				{


                  if(Auth::check()){
			 
                      $testdetails = DB::table('registration')
                     ->select('invoice.id','invoice.reg_id','invoice.totalamt','invoice.totaltax','invoicedetails.test_discount','invoicedetails.test_subtotal','alltests.primaryprice','alltests.testname','tax.taxrate')
				     ->join('invoice', 'registration.id','=','invoice.reg_id')
                     ->join('invoicedetails', 'invoice.id','=','invoicedetails.invoice_id')
					 ->join('alltests', 'invoicedetails.test_name','=','alltests.id')
					 ->join('tax', 'alltests.tax_id','=','tax.id')
					 ->where('registration.cust_id','=', $id)
                     ->get(); 
					 $testdetailscount = count($testdetails);
				 
            $existingdocuments = Customerdocuments::leftJoin('legaldocuments', 'legaldocuments.id','=','customerdocuments.documenttype_id')
                    ->where('customerdocuments.cust_id','=', $id)
                    ->where('customerdocuments.status','=', '1')
                    ->select('customerdocuments.*','legaldocuments.documenttype')
                    ->get(); 
            $existingdocumentscount = count($existingdocuments);
           
		   
                $CustomerDetails = Customer:: join('registration','customer.id','=','registration.cust_id')
                ->join('invoice','registration.id','=','invoice.reg_id')
                 ->join('master_insurance','registration.insuranceprovider','=','master_insurance.id')
              ->where('registration.cust_id',$id)
              ->get();
			   
			  $doccount = Customerdocuments::where('cust_id',$id)->get();
			  $documenttype = Legaldocuments::where("status", "=", 1)->get();
              $countrylist = Country::where("status","=",1)->get();
              $branchlist = Branch::where("status","=",1)->get();
              $paymentmethod = PaymentMethod::where("status", "=", 1)->get();
  
		   return view('editregistration', [
                'documenttypelist' => $documenttype,
                'countrylist' => $countrylist,
                'branchlist' => $branchlist,
                'paymentmethods' => $paymentmethod,
                'CustomerDetails'=>$CustomerDetails,
                'doccount'=>$doccount,
				'existingdocuments'=>$existingdocuments,
				'existingdocumentscount'=>$existingdocumentscount,
				 'testdetails'=>$testdetails,  
				 'testdetailscount'=>$testdetailscount
				 ]);
              }
        return redirect("/")->withError('You do not have access');
                
             }
             
      public function deleteregistration(Request $request, $id){
	 	
		$loguserid = Auth::user()->staff_id;
	    $logbranchid = Auth::user()->branchid;
        $logurl = url()->current();
        $logip = request()->ip();
        $logmethod =  request()->method();
	 	$logagent = $request->header('User-Agent');
        $logsubject = "Delete - Registration";
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
			
			
		  $registration = DB::table('registration')->where('registration.id','=', $id)->get();
		


		$invoice = DB::table('invoice')->where('invoice.reg_id','=', $id)->get(); 
			 foreach($invoice as $inv)	$inid = $inv->id;		
		    $invoicedetails = DB::table('invoicedetails')->where('invoicedetails.invoice_id','=', $inid)->get(); 
			 $registration = DB::table('registration')->where('registration.id','=', $id)->delete();
			  $invoice = DB::table('invoice')->where('invoice.reg_id','=', $id)->delete();
			   $invoicedetails = DB::table('invoicedetails')->where('invoicedetails.invoice_id','=', $inid)->delete();		 
			
			   return redirect("registration.list")->withSuccess('Registration Deleted Successfully');
		 }
		 
   public function proofreg(Request $request)
         {
           $cid = $request->id;
        // $doccount = Customerdocuments::where('cust_id',$cid)->get();
           $doccount = Customerdocuments::join('legaldocuments', 'customerdocuments.documenttype_id', '=', 'legaldocuments.id')
                ->where('customerdocuments.cust_id',$cid)
                ->select('customerdocuments.*','legaldocuments.documenttype as documentname')
                ->get(); 
	     return Response($doccount);
         }
     public function delete_documents(Request $request){
        $user = DB::table('customerdocuments')->where('id',$request->id)->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data Deleted'
             ]
             );
            }     
     public function searchlist(Request $request)
    {
		$rno = $request->registration_number;
     $date = $request->date;
     $customer_name = $request->customer_name;

     $invoice_number = $request->invoice_number;
	 
	 
		$CustomerDetails = Customer:: join('registration','customer.id','=','registration.cust_id')
									->join('invoice','registration.id','=','invoice.reg_id');
		    if($rno){
			   $CustomerDetails = $CustomerDetails->where('registration.id','like',"%$rno%"); 
            }
			
			if($date){
			   $CustomerDetails = $CustomerDetails->where('registration.registerdate','like',"%$date%"); 
           }
		   
			if($customer_name){ 
			   $CustomerDetails = $CustomerDetails->where('customer.name','like',"%$customer_name%"); 
            }
			if($invoice_number){
			   $CustomerDetails = $CustomerDetails->where('invoice.invoice_number','like',"%$invoice_number%"); 
            }
			
			 $CustomerDetails = $CustomerDetails->select('registration.id as id','registration.cust_id as cust_id','customer.name as name','customer.phone as phone','registration.age as age','registration.bloodgroup as bloodgroup','registration.add_line_one as add_line_one','registration.registerdate as registerdate')
             ->get(); 
			  
		 return view('registrationlist')->with('CustomerDetails', $CustomerDetails);   
		  
    }
    public function updateregistration(Request $request, $id)
        {
		  
		$customername = $request['fname'];
	    $customeremail = $request['email'];
        $customerphone = str_replace(' ', '', $request['phone']); // Remove the space from the name
        $customerplace = $request['place'];
        
		$customergender = $request['gender'];
	    $customerdob = $request['dob'];
        $customerage = $request['age'];
        $customeraddresslineone = $request['addresslineone'];
        $customeraddresslinetwo = $request['addresslinetwo'];
        $customercity = $request['city'];
        $customerpincode = $request['pincode'];
        $customercountry = $request['country']; 
        $customerregfrom = $request['regfrom'];
        $customermaritalstatus = $request['maritalstatus'];
        $customerbloodgroup = $request['bloodgroup'];
        $customeremergencyno = $request['emergencyno'];
        $customerhealthissue = $request['healthissue'];
        $customerinsuranceno = $request['insuranceno'];
        $customerinsuranceprovider = $request['insuranceprovider'];
        $customerinsurancecardno = $request['insurancecardno'];
        $customerinsuranceexpirydate = $request['insuranceexpirydate'];
        $totaldiscount = $request['hiddentotaldiscount'];
        $totalsubtotal = $request['hiddentotalsubtotal'];
        $totaltax = $request['hiddentotaltax'];
        $paymentmethod = $request['paymentmethod'];
		   if($request['paidamount']!='') {
            $paidamount =  number_format((float)$request['paidamount'], 2, '.', '');
        } else {
            $paidamount = '0.00';
        }
        //dd('paid amt=>'.$paidamount);
        $balanceamt = $totalsubtotal-$paidamount;

 
        $roundbalanceamt = number_format((float)$balanceamt, 2, '.', '');

        if($roundbalanceamt == '0.00'){
            $paymenttype = 'paid';
        } else if($roundbalanceamt == $totalsubtotal){
            $paymenttype = 'credit';
        } else {
            $paymenttype = 'partial';
        }
		
		$registration = Registration::find($id);
		$registration->gender = $customergender;
        $registration->dob = $customerdob;
        $registration->age = $customerage;
		$registration->maritalstatus = $customermaritalstatus;
        $registration->bloodgroup = $customerbloodgroup;
        $registration->emergencynumber = $customeremergencyno;
		$registration->healthissue = $customerhealthissue;
        $registration->add_line_one = $customeraddresslineone;
        $registration->add_line_two = $customeraddresslinetwo;
        $registration->city = $customercity;  
        $registration->pincode = $customerpincode;
        $registration->country = $customercountry;
        $registration->registerfrom = $customerregfrom;
        $registration->registerdate = date('Y-m-d');
        $registration->registertime = date("h:i:s A");
        $registration->status = '1';
        $registration->sample_status  = 'pending';
        $registration->insuranceno = $customerinsuranceno;
        $registration->insuranceprovider = $customerinsuranceprovider;
        $registration->insurancecardno = $customerinsurancecardno;
        $registration->insuranceexpirydate = $customerinsuranceexpirydate;
        $registration->staffid = Auth::user()->staff_id;
	    $registration->update(); 
	
	$regitable = DB::table('registration')
                     ->where('id','=', $id)
                     ->get(); 
	
	 foreach($regitable as $reg)
	 
	 $custid = $reg->cust_id;
		
		  $customerusername = $customerphone; // username
        $name = str_replace(' ', '', $customername); // Remove the space from the name
        $passname = strtolower(substr($name, 0, 4));  // First 4 characters of name        
        $passmob = strtolower(substr($customerphone, -4));  // Last 4 digits of phone
        $customerpass = $passname.$passmob; // Password
        
        $existcustcount = Customer::where('name',$customername)->where('phone',$customerphone)->count();
 
       $customer = Customer::find($custid);
	  // dd($customerplace);die();
        if($existcustcount == 0) {
        $customer->username = $customerusername;
        $customer->password = Hash::make($customerpass);
        $customer->name = $customername;
        $customer->email = $customeremail;
        $customer->phone = $customerphone;
        $customer->place = $customerplace;
        $customer->status = '1';
        $customer->update(); 
		
		} else {
            $existcustqry = Customer::where('name',$customername)->where('phone',$customerphone)->first();
            $customerlastid = $existcustqry->id;
        }
		
		
		//dd($customerlastid);die();
		//CUSTOMER DETAILS STORE TO CUSTOMER TBL ENDS HERE 

        // UPDATE THE CUSTOMER ID IN THE CUSTOMER DOCUMENTS  STARTS HERE      
       // $update_doc_details = array('cust_id' => $customerlastid);    
		
		//dd($update_doc_details);die();
      //  $custidupdate = Customerdocuments::where('cust_id', $customerlastid)->update($update_doc_details);
        // UPDATE THE CUSTOMER ID IN THE CUSTOMER DOCUMENTS  ENDS HERE 
 
		
      

 // INVOICE GENERATING AND INVOICE DETAILS STORING STARTS HERE 
        $invoice = new Invoice();
        $count = Invoice::count();
       
        if($count>0){
			
			//dd("haiiiiii");die();
            $latestinvoice = Invoice::latest('id')->first();
            $lastinvnumber = $latestinvoice->invoice_number ;
            $incrementinvnumber = ($lastinvnumber+1);
            $invoicenumber = str_pad($incrementinvnumber, 6, "0", STR_PAD_LEFT);
        } else 
        {
			
			//dd("kooooooooooiiiiiiii");die();
            $invoicenumber = '000001';
        }
        
        $invoice->invoice_number = $invoicenumber;
      //$invoice->reg_id = ;
        $invoice->totaldiscount = $totaldiscount;
        $invoice->totalamt = $totalsubtotal;
        $invoice->totaltax = $totaltax;
        $invoice->paidamt = $paidamount;
        $invoice->balanceamt = $roundbalanceamt;
        $invoice->paymentstatus = $paymenttype;
        $invoice->paymentmethod = $paymentmethod;              
        $invoice->update();
        $invoicelastid = $invoice->id; 
		$inrid = $request->inputtestid;
          // dd($inrid);die();
    if($inrid == "null"){
	
	 $inrid = $request->inputtestid;
       //  dd($inrid);die();
	
}
   else {

   /* foreach($request->inputtestid as $index => $tests) {
            $invoicedetails = new Invoicedetails();
            $invoicedetails->invoice_id = $invoicelastid;
            $invoicedetails->test_name = $request->inputtestid[$index];
            $invoicedetails->test_unitprice = $request->inputunitprice[$index];
            $invoicedetails->test_discount = $request->inputdiscount[$index];
            $invoicedetails->test_tax_amount = $request->inputtax[$index];
            $invoicedetails->test_subtotal = $request->inputsubtotal[$index];
            $invoicedetails->update();
 

            // STORE TO TEST RESULT STARTS HERE 
            $restresult = new Testresult();
            $restresult->cust_id = $customerlastid;
            $restresult->reg_id = $registrationlastid;
            $restresult->test_id = $request->inputtestid[$index];
            $restresult->staff_id = Auth::user()->staff_id;
            $restresult->branch_id = Auth::user()->branchid;
            $restresult->status = 'notcollected';
            $restresult->update();

            // STORE TO TEST RESULT ENDS HERE
        } */
	}

		
         return redirect("registration.list")->withSuccess('Registration updated successfully');    
     }        
    // CUSTOMER DOCUMENTS ADDING SECTION STARTS HERE 

    public function customeradddocuments(Request $request){
        // LOG ACTIVITY STARTS HERE 
        $loguserid = Auth::user()->staff_id;
        $logbranchid = Auth::user()->branchid;
        $logurl = url()->current();
        $logip = request()->ip();
        $logmethod =  request()->method();
        $logagent = $request->header('User-Agent');
        $logsubject = "uploaded customer document";
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


        $documents = new Customerdocuments;        
        $file = $request->file('file');
        $documenttype = $request->input('dtype');
        $documentnumber = $request->input('dnumber');
        $documentexpirydate = $request->input('dexpirydate');
        $tempcustid = $request->input('token');
        $documentName = 'custdoc_'.time().'.'.$request->file->extension();  
        $request->file->move('uploads', $documentName);
        // $file->move(public_path('uploads'), $documentName);
        
        $documents->cust_id = $tempcustid;
        $documents->documenttype_id = $documenttype;
        $documents->documentnumber = $documentnumber;
        $documents->documentexpirydate = $documentexpirydate;
        $documents->documentfilename = $documentName;
        $documents->status = '1';
        $documents->save(); 
        $lastid = $documents->id;
        $responseDocuments = Customerdocuments::select('*')->where('id', $lastid)->first();
        $doctype = Legaldocuments::select('documenttype')->where('id', $responseDocuments->documenttype_id)->first();       
        $data['documentid'] = $responseDocuments->id;
        $data['documenttype'] = $doctype->documenttype;
        $data['documentnumber'] = $responseDocuments->documentnumber;
        $data['documentexpirydate'] = $responseDocuments->documentexpirydate;
        $data['documentfile'] = $responseDocuments->documentfilename;
        $data['success'] = 1;
        return response()->json($data);
    }

    // CUSTOMER DOCUMENTS ADDING SECTION ENDS HERE 

    // CUSTOMER DOCUMENTS DELETING SECTION STARTS HERE
    public function customerdeletedocuments(Request $request){

        // LOG ACTIVITY STARTS HERE 
        $loguserid = Auth::user()->staff_id;
        $logbranchid = Auth::user()->branchid;
        $logurl = url()->current();
        $logip = request()->ip();
        $logmethod =  request()->method();
        $logagent = $request->header('User-Agent');
        $logsubject = "deleted customer document";
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

        $id = $request->input('id');
        $stid = $request->input('custid');
        $image = Customerdocuments::find($id); 
        unlink("uploads/".$image->documentfilename);
        $res=Customerdocuments::where('id',$id)->delete();
        $doccount = Customerdocuments::where('cust_id',$stid)->count();
        $data['success'] = 1;  
        $data['doccount'] = $doccount;           
        return response()->json($data);
    }
    // CUSTOMER DOCUMENTS DELETING SECTION ENDS HERE

    // TESTS SEARCHING AND LISTING STARTS HERE 
    function searchresult(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');      
            // fetching result from single table starts here
            $count = AllTests::where('testname', 'LIKE', "%{$query}%")->where('status','1')->count();
            if($count>0){
            $data = AllTests::where('testname', 'LIKE', "%{$query}%")
                            ->where('status','1')
                            ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
                foreach($data as $row)
                {
                    $output .= '<li class="testname" style="margin-left:1rem;" id='.$row->id.'>'.$row->testname.'</li>';
                }
            $output .= '</ul>';
            } else {
                $output = ''; 
            }
            echo $output;
        }
    }

    // TEST SEARCHING AND LISTING ENDS HERE


    // CUSTOMER NAME SEARCHING AND LISTING STARTS HERE 
    function customernamesearch(Request $request)
    {
        if($request->get('fname'))
        {
            $query = $request->get('fname');      
            // fetching result from single table starts here
            $count = Customer::where('name', 'LIKE', "%{$query}%")->where('status','1')->count();
            if($count>0){
            $data = Customer::where('name', 'LIKE', "%{$query}%")
                                ->where('status','1')
                                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
                foreach($data as $row)
                {
                    $output .= '<li class="custname" style="margin-left:1rem;" id='.$row->id.'>'.$row->name.'-'.$row->phone.'</li>';
                }
                    $output .= '</ul>';            
            } else {
                $output = '';
            }
            echo $output;
        }
    }


    // CUSTOMER NAME SEARCHING AND LISTING STARTS HERE 
    function customerphonesearch(Request $request)
    {
        if($request->get('phone'))
        {
            $query = $request->get('phone');      
            // fetching result from single table starts here
            $count = Customer::where('phone', 'LIKE', "%{$query}%")->where('status','1')->count();
            if($count>0){
            $data = Customer::where('phone', 'LIKE', "%{$query}%")
                                ->where('status','1')
                               ->get();
                    $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
                foreach($data as $row)
                {
                    $output .= '<li class="custname" style="margin-left:1rem;" id='.$row->id.'>'.$row->phone.'</li>';
                }
                    $output .= '</ul>';            
            } else {
                $output = '';
            }
            echo $output;
        }
    }



    // INVOICE LISTING AND  PAYMENT CALCULATE STARTS HERE 
    function testslistresult(Request $request)
    {
        $id = $request->input('id');
        //$listTestQry = AllTests::where('id',$id)->first();
        $listTestQry = AllTests:: join('tax','alltests.tax_id','=','tax.id')->where('alltests.id',$id)->first(['alltests.*','tax.taxrate as taxrate','tax.taxtype as taxtype']);
        $listtestdata['testid'] = $listTestQry->id;
        $listtestdata['testname'] = $listTestQry->testname;
        $listtestdata['primaryprice'] = $listTestQry->primaryprice;
        $listtestdata['secondaryprice'] = $listTestQry->secondaryprice;
        $listtestdata['taxrate'] = $listTestQry->taxrate;
        $listtestdata['taxtype'] = $listTestQry->taxtype;
        $listtestdata['taxmethod'] = $listTestQry->tax_method;
        return response()->json($listtestdata);
    }
    // INVOICE LISTING AND  PAYMENT CALCULATE ENDS HERE 

    // REGISTRATION DETAILS STORE TO TABLES  STARTS HERE 

    function addregistration(Request $request){        
        $tempcustid = $request['tempcustid'];
       //CUSTOMER DETAILS STORE TO CUSTOMER TBL STARTS HERE 
        $customer = new Customer;
        $customername = $request['fname'];
        $customeremail = $request['email'];
        $customerphone = str_replace(' ', '', $request['phone']); // Remove the space from the name
        $customerplace = $request['place'];
        $customergender = $request['gender'];
        $customerdob = $request['dob'];
        $customerage = $request['age'];
        $customeraddresslineone = $request['addresslineone'];
        $customeraddresslinetwo = $request['addresslinetwo'];
        $customercity = $request['city'];
        $customerpincode = $request['pincode'];
        $customercountry = $request['country'];
        $customerregfrom = $request['regfrom'];
        $customermaritalstatus = $request['maritalstatus'];
        $customerbloodgroup = $request['bloodgroup'];
        $customeremergencyno = $request['emergencyno'];
        $customerhealthissue = $request['healthissue'];
        $customerinsuranceno = $request['insuranceno'];
        $customerinsuranceprovider = $request['insuranceprovider'];
        $customerinsurancecardno = $request['insurancecardno'];
        $customerinsuranceexpirydate = $request['insuranceexpirydate'];
        $totaldiscount = $request['hiddentotaldiscount'];
        $totalsubtotal = $request['hiddentotalsubtotal'];
        $totaltax = $request['hiddentotaltax'];
        $paymentmethod = $request['paymentmethod'];
        //$paymenttype = $request['paymenttype'];
        
        if($request['paidamount']!='') {
            $paidamount =  number_format((float)$request['paidamount'], 2, '.', '');
        } else {
            $paidamount = '0.00';
        }
        //dd('paid amt=>'.$paidamount);
        $balanceamt = $totalsubtotal-$paidamount;


        $roundbalanceamt = number_format((float)$balanceamt, 2, '.', '');

        if($roundbalanceamt == '0.00'){
            $paymenttype = 'paid';
        }else if($roundbalanceamt == $totalsubtotal){
            $paymenttype = 'credit';
        }else {
            $paymenttype = 'partial';
        }

        $customerusername = $customerphone; // username
        $name = str_replace(' ', '', $customername); // Remove the space from the name
        $passname = strtolower(substr($name, 0, 4));  // First 4 characters of name        
        $passmob = strtolower(substr($customerphone, -4));  // Last 4 digits of phone
        $customerpass = $passname.$passmob; // Password
        
        $existcustcount = Customer::where('name',$customername)->where('phone',$customerphone)->count();

       // dd($existcustcount);
        if($existcustcount == 0) {
        $customer->username = $customerusername;
        $customer->password = Hash::make($customerpass);
        $customer->name = $customername;
        $customer->email = $customeremail;
        $customer->phone = $customerphone;
        $customer->place = $customerplace;
        $customer->status = '1';
        $customer->save(); 
        $customerlastid = $customer->id; 
        } else {
            $existcustqry = Customer::where('name',$customername)->where('phone',$customerphone)->first();
            $customerlastid = $existcustqry->id;
        }
        //CUSTOMER DETAILS STORE TO CUSTOMER TBL ENDS HERE 

        // UPDATE THE CUSTOMER ID IN THE CUSTOMER DOCUMENTS  STARTS HERE      
        $update_doc_details = array('cust_id' => $customerlastid);    
        $custidupdate = Customerdocuments::where('cust_id', $tempcustid)->update($update_doc_details);
        // UPDATE THE CUSTOMER ID IN THE CUSTOMER DOCUMENTS  ENDS HERE            

        // REGISTRATION DETAILS STORE TO REGISTRATION TBL STARTS HERE 
        $registration = new Registration;
        $registration->cust_id = $customerlastid;
        $registration->gender = $customergender;
        $registration->dob = $customerdob;
        $registration->age = $customerage;
        $registration->add_line_one = $customeraddresslineone;
        $registration->add_line_two = $customeraddresslinetwo;
        $registration->city = $customercity;
        $registration->pincode = $customerpincode;
        $registration->country = $customercountry;
        $registration->registerfrom = $customerregfrom;
        $registration->registerdate = date('Y-m-d');
        $registration->registertime = date("h:i:s A");
        $registration->status = '1';
        $registration->sample_status  = 'pending';


        $registration->maritalstatus = $customermaritalstatus;
        $registration->bloodgroup = $customerbloodgroup;
        $registration->emergencynumber = $customeremergencyno;
        $registration->healthissue = $customerhealthissue;
        $registration->insuranceno = $customerinsuranceno;
        $registration->insuranceprovider = $customerinsuranceprovider;
        $registration->insurancecardno = $customerinsurancecardno;
        $registration->insuranceexpirydate = $customerinsuranceexpirydate;
        $registration->staffid = Auth::user()->staff_id;
        

        $registration->save(); 
        $registrationlastid = $registration->id;
        
        // LOG ACTIVITY STARTS HERE 
        $loguserid = Auth::user()->staff_id;
        $logbranchid = Auth::user()->branchid;
        $logurl = url()->current();
        $logip = request()->ip();
        $logmethod =  request()->method();
        $logagent = $request->header('User-Agent');
        if($loguserid == '0') {
            $logusername = 'Super admin';
        } else {
            $loguserqry = Staff::where('id',$loguserid)->first();
            $logusername = $loguserqry->firstname.' '.$loguserqry->lastname;
        }
        $logsubject = "registered new customer named ".$customername;
        
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

        // REGISTRATION DETAILS STORE TO REGISTRATION TBL ENDS HERE


        // INVOICE GENERATING AND INVOICE DETAILS STORING STARTS HERE 
        $invoice = new Invoice();
        $count = Invoice::count();
       
        if($count>0){
            $latestinvoice = Invoice::latest('id')->first();
            $lastinvnumber = $latestinvoice->invoice_number ;
            $incrementinvnumber = ($lastinvnumber+1);
            $invoicenumber = str_pad($incrementinvnumber, 6, "0", STR_PAD_LEFT);
        } else 
        {
            $invoicenumber = '000001';
        }

        $invoice->invoice_number = $invoicenumber;
        $invoice->reg_id = $registrationlastid;
        $invoice->totaldiscount = $totaldiscount;
        $invoice->totalamt = $totalsubtotal;
        $invoice->totaltax = $totaltax;
        $invoice->paidamt = $paidamount;
        $invoice->balanceamt = $roundbalanceamt;
        $invoice->paymentstatus = $paymenttype;
        $invoice->paymentmethod = $paymentmethod;              
        $invoice->save();
        $invoicelastid = $invoice->id; 

        foreach($request->inputtestid as $index => $tests) {
            $invoicedetails = new Invoicedetails();
            $invoicedetails->invoice_id = $invoicelastid;
            $invoicedetails->test_name = $request->inputtestid[$index];
            $invoicedetails->test_unitprice = $request->inputunitprice[$index];
            $invoicedetails->test_discount = $request->inputdiscount[$index];
            $invoicedetails->test_tax_amount = $request->inputtax[$index];
            $invoicedetails->test_subtotal = $request->inputsubtotal[$index];
            $invoicedetails->save();


            // STORE TO TEST RESULT STARTS HERE 
            $restresult = new Testresult();
            $restresult->cust_id = $customerlastid;
            $restresult->reg_id = $registrationlastid;
            $restresult->test_id = $request->inputtestid[$index];
            $restresult->staff_id = Auth::user()->staff_id;
            $restresult->branch_id = Auth::user()->branchid;
            $restresult->status = 'notcollected';
            $restresult->save();

            // STORE TO TEST RESULT ENDS HERE
        }


        if($paymenttype == 'paid' || $paymenttype == 'partial') {
            if($paymenttype == 'paid') {
                $paymethod = 'full payment';
            } else 
            { 
                $paymethod = 'partial payment';
            }
            // LOG ACTIVITY STARTS HERE 
            $loguserid = Auth::user()->staff_id;
            $logbranchid = Auth::user()->branchid;
            $logurl = url()->current();
            $logip = request()->ip();
            $logmethod =  request()->method();
            $logagent = $request->header('User-Agent');
            if($loguserid == '0') {
                $logusername = 'Super admin';
            } else {
                $loguserqry = Staff::where('id',$loguserid)->first();
                $logusername = $loguserqry->firstname.' '.$loguserqry->lastname;
            }
            $logsubject = "collected ".$paymethod." from ".$customername;
            
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



            $transaction = new Transactions();
            
            $vouchercount = Transactions::count();
       
        if($vouchercount>0){
            $latestvoucher= Transactions::latest('id')->first();
            $lastvouchernumber = $latestvoucher->voucher_number ;
            $incrementvouchernumber = ($lastvouchernumber+1);
            $vouchernumber = str_pad($incrementvouchernumber, 6, "0", STR_PAD_LEFT);
        } else 
        {
            $vouchernumber = '000001';
        }
            $transaction->voucher_number = $vouchernumber;
            $transaction->invoice_id = $invoicelastid;
            $transaction->category  = 'registration';
            $transaction->transaction_type  = 'income';
            $transaction->paidamount = $paidamount;
            $transaction->balanceamount = $roundbalanceamt;
            $transaction->paymentmethod = $paymentmethod; 
            $transaction->paymentdate = date('Y-m-d');
            $transaction->paymenttime = date('H:i a');
            //$transaction->staff_id = Auth::user()->staff_id;
            $transaction->staff_id = '3';
            $transaction->branchid = Auth::user()->branchid;  
            $transaction->save();

        }

        // INVOICE GENERATING AND INVOICE DETAILS STORING ENDS HERE
        
     
        //dd($customerpass);
        // return redirect("registration")->withSuccess('Registration completed successfully');  
        return redirect('registerinvoice/'.$registrationlastid); 



    }

    // REGISTRATION DETAILS STORE TO DB ENDS HERE 


    //  AUTO COMPLETE REGISTRATION STARTS HERE 
    function autocompleteregistration(Request $request){
        $custid = $request['custid'];

        $CustomerDetails = Customer:: join('registration','customer.id','=','registration.cust_id')
        ->where('customer.id',$custid)
        ->first(['registration.*','customer.name as name','customer.email as email','customer.phone as phone','customer.place as place']);
       
        $custdocuments = Customerdocuments::join('legaldocuments','customerdocuments.documenttype_id','=','legaldocuments.id')
        ->where('cust_id',$custid)
        ->select('legaldocuments.documenttype','customerdocuments.documentnumber','customerdocuments.documentexpirydate','customerdocuments.documentexpirydate','customerdocuments.documentfilename')
        ->get();


        $preinvoicelist = Registration:: join('invoice','registration.id','=','invoice.reg_id')
        ->where('registration.cust_id',$custid)
        ->select('invoice.id','invoice.invoice_number')
        ->orderBy('invoice.id', 'DESC')
        ->take(5)
        ->get();

        $custdata['custid'] = $custid;
        $custdata['custname'] = $CustomerDetails->name;
        $custdata['custemail'] = $CustomerDetails->email;
        $custdata['custphone'] = $CustomerDetails->phone;
        $custdata['custplace'] = $CustomerDetails->place;

        $custdata['custgender'] = $CustomerDetails->gender;
        $custdata['custage'] = $CustomerDetails->age;
        $custdata['custdob'] = $CustomerDetails->dob;
        $custdata['custaddone'] = $CustomerDetails->add_line_one;
        $custdata['custaddtwo'] = $CustomerDetails->add_line_two;
        $custdata['custcity'] = $CustomerDetails->city;
        $custdata['custpincode'] = $CustomerDetails->pincode;
        $custdata['custcountry'] = $CustomerDetails->country;
        $custdata['custregfrom'] = $CustomerDetails->registerfrom;
        $custdata['custdocuments'] = $custdocuments;
        $custdata['custpreinvoice'] = $preinvoicelist;

        $custdata['custmaritalstatus'] = $CustomerDetails->maritalstatus;
        $custdata['custbloodgroup'] = $CustomerDetails->bloodgroup;
        $custdata['custemergencyno'] = $CustomerDetails->emergencynumber;
        $custdata['custhealthissue'] = $CustomerDetails->healthissue;
        $custdata['custinsuranceno'] = $CustomerDetails->insuranceno;
        $custdata['custinsuranceprovider'] = $CustomerDetails->insuranceprovider;
        $custdata['custinsurancecardno'] = $CustomerDetails->insurancecardno;
        $custdata['custinsuranceexpirydate'] = $CustomerDetails->insuranceexpirydate;
       
        return response()->json($custdata);

    }

    // AUTO COMPLETE REGISTRATION ENDS HERE


    

    function viewpreviousinvoice(Request $request){
        $invoiceid = $request['invoiceid'];
        //$invoicedetails  = Invoicedetails::join ('alltests','alltests.id','=','invoicedetails.test_name')->where('invoicedetails.invoice_id',$invoiceid)->get('alltests.testname as name');
        $invoicedetails  = Invoicedetails::join ('alltests','alltests.id','=','invoicedetails.test_name')
        ->where('invoicedetails.invoice_id',$invoiceid)
        ->select('alltests.testname as name','invoicedetails.test_unitprice as testrate')
        ->get('alltests.testname as name');

        $customerdetails = Invoice::join ('registration','invoice.reg_id','=','registration.id')
        ->join('country','registration.country','=','country.id')
        ->join('customer','registration.cust_id','=','customer.id')
        ->select('invoice.invoice_number as invoiceno','customer.name as name','customer.phone as phone','customer.place as place','customer.email as email','registration.add_line_one as addressone','registration.add_line_two as addrestwo','registration.city as city','registration.registerdate as registrationdate','registration.registertime as registrationtime','registration.pincode as pincode','country.country_name as country')
        ->where('invoice.id',$invoiceid)
        ->get();
        $invdata['invoicedetails'] = $invoicedetails;
        $invdata['customerdetails'] = $customerdetails;
        return response()->json($invdata);


    }


    // ADD TO REGISTER STAFTS HERE 
    function addtoregister(Request $request){
        $invoiceid = $request['invoiceid'];
        $invoicedetails  = Invoicedetails::join ('alltests','alltests.id','=','invoicedetails.test_name')
        ->join('tax','alltests.tax_id','=','tax.id')
        ->where('invoicedetails.invoice_id',$invoiceid)
        ->select('alltests.testname as testname','alltests.tax_method as taxmethod','alltests.primaryprice','alltests.id as testid','tax.taxtype','tax.taxrate')
        ->get();
        $invdata['invoicedetails'] = $invoicedetails;
        return response()->json($invdata);

    }


    // ADD TO REGISTER ENDS HERE 
    
    public function invoicelist($registrationlastid)
    {
		 
        if(Auth::check()){
            $userId = Auth::id();
            $invoicelist = Invoice::join('registration','invoice.reg_id','=','registration.id')
            ->join('customer','registration.cust_id','=','customer.id')
			   //->join('invoicedetails','invoice.id','=','invoicedetails.invoice_id')
			    //->join('alltests','invoicedetails.test_name','=','alltests.id')
	            ->select('invoice.*','customer.name as name','customer.phone as mob','registration.registerdate as date','registration.registertime as time','registration.add_line_one as address','customer.username as user')
          //   ->select('invoice.*','customer.name as name','registration.registerdate as date','registration.registertime as time','alltests.testname as testname','alltests.primaryprice as primaryprice','invoicedetails.test_unitprice as test_unitprice','invoicedetails.test_discount as test_discount','invoicedetails.test_tax_amount as test_tax_amount','invoicedetails.test_subtotal as test_subtotal')
   
			->where('registration.id','=', $registrationlastid)
			->orderBy('invoice.id','desc')
            ->get();
            
            $itemlist = Invoice::join('registration','invoice.reg_id','=','registration.id')
            ->join('customer','registration.cust_id','=','customer.id')
			->join('invoicedetails','invoice.id','=','invoicedetails.invoice_id')
			->join('alltests','invoicedetails.test_name','=','alltests.id')
	        ->select('invoice.*','alltests.testname as testname','invoicedetails.test_unitprice as price','invoicedetails.test_discount as discount','invoicedetails.test_tax_amount as taxamount','invoicedetails.test_subtotal as total')
          
			->where('registration.id','=', $registrationlastid)
			->orderBy('invoice.id','desc')
            ->get();
	        $paymentmethod = PaymentMethod::where("status", "=", 1)->get();
			 //dd($paymentmethod);die();
            return view('registerinvoice', ['itemlist' => $itemlist,'paymentmethods' => $paymentmethod,'invoicelist' => $invoicelist, 'frmdate'=>'', 'todate'=>'', 'customer'=>'', 'invoiceno'=>'', 'status'=>'']);
        }
        return redirect("/")->withError('You do not have access');
    }
    
    
     public function viewdoc(Request $request)
    {
        $id = $request->id;
        $test = Customerdocuments::leftJoin('legaldocuments', 'legaldocuments.id','=','customerdocuments.documenttype_id')->where('customerdocuments.id','=', $id)->select('customerdocuments.*','legaldocuments.documenttype')->first(); 
        // $test = Customerdocuments::select('documentnumber,documentexpirydate')->where('id', $id)->first();  
                return Response($test);
    }
    
    public function docedit(Request $request){
        $id = $request->input('hiddenid');
        $custid = $request->input('testid');
        
        $documents = Customerdocuments::find($id);     
        
        
        // $documents = new Customerdocuments;        
        // $file = $request->input('file');
        // // print_r($file); die();
        // $documenttype = $request->input('doc_type');
        // $documentnumber = $request->input('doc_number');
        // $documentexpirydate = $request->input('exp_date');
        
        // $documentName = $request->input('file');  
        // $file->move(public_path('uploads'), $documentName);
        // // $request->file->move('uploads', $documentName);
        
        
        // $documents->documenttype_id = $documenttype;
        // $documents->documentnumber = $documentnumber;
        // $documents->documentexpirydate = $documentexpirydate;
        // $documents->documentfilename = $documentName;
        // $documents->status = '1';
        // $documents->update(); 
        


        $documents = Customerdocuments::find($id);             
        $file = $request->file('file');
        $documenttype = $request->input('doc_type');
        $documentnumber = $request->input('doc_number');
        $documentexpirydate = $request->input('exp_date');
        $tempcustid = $request->input('token');
        $documentName = 'custdoc_'.time().'.'.$request->file->extension();  
        $request->file->move('uploads', $documentName);
        // $file->move(public_path('uploads'), $documentName);
        
        $documents->cust_id = $tempcustid;
        $documents->documenttype_id = $documenttype;
        $documents->documentnumber = $documentnumber;
        $documents->documentexpirydate = $documentexpirydate;
        $documents->documentfilename = $documentName;
        $documents->status = '1';
        $documents->update(); 
        
        return redirect("edit-registration/".$custid);
    }
    
    
    public function addpayment(Request $request)
{
        $transaction = new Transactions();
        $vouchercount = Transactions::count();
       
        if($vouchercount>0){
            $latestvoucher= Transactions::latest('id')->first();
            $lastvouchernumber = $latestvoucher->voucher_number ;
            $incrementvouchernumber = ($lastvouchernumber+1);
            $vouchernumber = str_pad($incrementvouchernumber, 6, "0", STR_PAD_LEFT);
        } else 
        {
            $vouchernumber = '000001';
        }
            $transaction->voucher_number = $vouchernumber;
            $transaction->invoice_id = $invoicelastid;
            $transaction->category  = 'registration';
            $transaction->transaction_type  = 'income';
            $transaction->paidamount = $paidamount;
            $transaction->balanceamount = $roundbalanceamt;
            $transaction->paymentmethod = $paymentmethod; 
            $transaction->paymentdate = date('Y-m-d');
            $transaction->paymenttime = date('H:i a');
            //$transaction->staff_id = Auth::user()->staff_id;
            $transaction->staff_id = '3';
            $transaction->branchid = Auth::user()->branchid;  
            $transaction->save();

        
        
        
        
        $paymentmethod = $request->input('paymentmethod');
        $payamount = $request->input('totalamont');
        //  $sid = $request->input('sid');  
            
            
            
            $payment->save(); 
            $payment->paymentmethod = $payment;
            $payment->totalamont = $payamount;  

         $lastid = $payment->id;
        $responseDocuments = Transactions::select('*')->where('id', $lastid)->first();

         $data['id'] = $responseDocuments->id;
            $data['paymentmethod'] = $responseDocuments->paymentmethod;
            $data['totalamont'] = $responseDocuments->totalamont;

            $data['success'] = 1;
                return response()->json($data);
}

// CUSTOMER IQAMA SEARCHING AND LISTING STARTS HERE 
    function customeriqamasearch(Request $request)
    {
        if($request->get('iqama'))
        {
            $query = $request->get('iqama');      
            // fetching result from single table starts here
            $count = Customerdocuments::where('documentnumber', 'LIKE', "%{$query}%")->where('status','1')->count();
            
            if($count>0){
            $data = Customerdocuments::where('documentnumber', 'LIKE', "%{$query}%")
                               ->where('status','1')
                               ->get();
                    $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
                foreach($data as $row)
                {
                    $output .= '<li class="custname" style="margin-left:1rem;" id='.$row->id.'>'.$row->documentnumber.'</li>';
                }
                    $output .= '</ul>';            
            } else {
                $output = '';
            }
            echo $output;
        }
    }
    
    
}
