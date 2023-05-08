<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\Testresult;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Registration;


class SampleRejectedController extends Controller
{
    //

    public function viewsamplerejected()
    {       if(Auth::check()){        
                $sampledata = Registration::join('customer','registration.cust_id','=','customer.id')
                                    ->join('testresult','registration.id','=','testresult.reg_id')
                                    ->select('customer.name as customername', 'customer.phone as customerphone', 'customer.place as customerplace', 'registration.id as regid', 'registration.registerdate as regdate', 'registration.registertime as regtime')
                                    ->orderBy('registration.id', 'DESC')
                                    ->where('testresult.status','rejected')
                                    //->orWhere('testresult.status','pending')
                                    //->orWhere('testresult.status','rejected')
                                    ->distinct('registration.id') 
                                    ->get();
                                    //->toSql();

                                    //dd($sampledata);    
                return view('sample_rejected', ['sampledata' => $sampledata]);
            }
            return redirect("/")->withError('You do not have access');
    }

    public function samplerejectionpopupview(Request $request){
        /*$registerid = $request->input('id');
        $testlists = Testresult::join('alltests','alltests.id','=','testresult.test_id')
        ->leftjoin('master_reject_reason','master_reject_reason.id','=','testresult.reject_reason')
        ->join('staff','staff.id','=','testresult.staff_id')
        ->join('registration','registration.id','=','testresult.reg_id')
        ->join('country','country.id','=','registration.country')
        ->join('customer','customer.id','=','registration.cust_id')
        ->select('testresult.id as id', 'testresult.status as status', 'master_reject_reason.rejectreason as rejectreason','testresult.reject_note as rejectnote','testresult.reg_id as rid', 'alltests.testname as testname', 'staff.firstname as fname','staff.lastname as lname', 'registration.registerdate as registerdate', 'registration.add_line_one as addone', 'registration.add_line_two as addtwo', 'registration.city as city', 'registration.pincode as pincode', 'customer.email as email', 'customer.phone as phone', 'customer.place as place', 'customer.name as custname', 'country.country_name as country')
            ->where(function($query){
                $query->where('testresult.status','=','rejected');
                //->orWhere('testresult.status','=','notcollected')
                //->orWhere('testresult.status','=','rejected');
         })
        ->where('testresult.reg_id',$registerid) 
        ->get();
        //->toSql();
        $datas['testlists'] = $testlists;
        return response()->json($datas);*/

        $registerid = $request->input('id');
        $testlists = Testresult::join('alltests','alltests.id','=','testresult.test_id')
        ->leftjoin('master_reject_reason','master_reject_reason.id','=','testresult.reject_reason')
        ->leftjoin('staff','staff.id','=','testresult.staff_id')
        ->leftjoin('registration','registration.id','=','testresult.reg_id')
        ->leftjoin('country','country.id','=','registration.country')
        ->leftjoin('customer','customer.id','=','registration.cust_id')
        
        ->select('customer.place as place','customer.phone as phone','customer.email as email','customer.name as custname','country.country_name as country','registration.registerdate','registration.registertime','registration.add_line_one as addone','registration.add_line_two as addtwo','registration.city as city','registration.pincode as pincode','staff.firstname as fname','staff.lastname as lname','testresult.id as id', 'testresult.status as status', 'master_reject_reason.rejectreason as rejectionreason' , 'testresult.reject_note as rejectnote', 'testresult.reg_id as rid', 'alltests.testname as testname')
            ->where(function($query){
                $query->where('testresult.status','=','rejected');
               // ->orWhere('testresult.status','=','notcollected')
                //->orWhere('testresult.status','=','rejected');
         })
        ->where('testresult.reg_id',$registerid)
        ->get();
        //->toSql();
        $datas['testlists'] = $testlists;
        $datas['rid'] = $registerid;
        return response()->json($datas);
    }

    
}
