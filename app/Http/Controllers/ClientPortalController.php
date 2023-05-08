<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customerdocuments;
use App\Models\Registration;
use App\Models\Customer;

class ClientPortalController extends Controller
{
    public function clientportalview()
    {       if(Auth::check()){   
        $clientdata = Customer::where('status',1)
        ->select('id','name','email','phone','place')
        ->get();    
                
                                    /*->toSql();
                                    dd($clientdata); */   
                //return view('clientportal');
                return view('clientportal', ['clientdata' => $clientdata]);
            }
            return redirect("/")->withError('You do not have access');
    }


    public function viewclientdetails(Request $request)
    {         
       $id = $request->id;
       $customerdetails = Registration::join('customer','registration.cust_id','=','customer.id')
            ->join('country','country.id','=','registration.country')
            ->select('registration.gender','registration.dob','registration.age','registration.bloodgroup','registration.emergencynumber','registration.add_line_one','registration.add_line_two','registration.city','registration.pincode','registration.insuranceno','registration.insuranceprovider','registration.insurancecardno','registration.insuranceexpirydate','customer.name as customername', 'customer.email as customeremail', 'customer.phone as customerphone', 'customer.place as customerplace','country.country_name as countryname')
            ->where('registration.cust_id','=',$id)
            ->distinct('registration.cust_id')
            ->get();
                            $customerdocuments = Customerdocuments::join('legaldocuments','legaldocuments.id','=','customerdocuments.documenttype_id')
                             ->select('customerdocuments.documentnumber','customerdocuments.documentexpirydate','customerdocuments.documentfilename', 'legaldocuments.documenttype')
                             ->where('customerdocuments.cust_id','=',$id)
                             ->get();

                             $documentcount = Customerdocuments::join('legaldocuments','legaldocuments.id','=','customerdocuments.documenttype_id')
                             ->select('customerdocuments.documentnumber','customerdocuments.documentexpirydate','customerdocuments.documentfilename', 'legaldocuments.documenttype')
                             ->where('customerdocuments.cust_id','=',$id)
                             ->count();
                             
                             

       /*$customerdetails = Invoice::join('registration','invoice.reg_id','=','registration.id')
                ->join('customer','registration.cust_id','=','customer.id')
                ->join('country','registration.country','=','country.id')
                ->select('invoice.*','customer.name as name','customer.phone as phone','customer.place as place','customer.email as email','registration.registerdate as date','registration.registertime as time','registration.add_line_one as addone','registration.add_line_two as addtwo','registration.city as city','registration.pincode as pincode','country.country_name as country')
                ->where('invoice.id',$id)
                ->get();
        $invoicedetails = Invoicedetails::join('alltests','alltests.id','=','invoicedetails.test_name')
                ->where('invoice_id',$id)
                ->select('alltests.testname as testname','invoicedetails.test_unitprice as unitprice','invoicedetails.test_discount as discount','invoicedetails.test_tax_amount as tax','invoicedetails.test_subtotal as subtotal')
                ->get();        
                $invdata['invoicedetails'] = $invoicedetails;*/
                $invdata['customerdetails'] = $customerdetails;
                $invdata['customerdocuments'] = $customerdocuments;
                $invdata['documentcounts'] = $documentcount;
       return Response($invdata);
    }
}
