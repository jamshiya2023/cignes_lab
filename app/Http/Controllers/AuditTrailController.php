<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Logactivity;
use Illuminate\Http\Request;

class AuditTrailController extends Controller
{
    public function audittraillist(){
        if(Auth::check()){  
            $logactivities = Logactivity::orderBy('id','DESC')->get();             
            return view('audittrail', ['logactivities' => $logactivities]);
        }
        return redirect("/")->withError('You do not have access');
    }

    public function viewaudittrail(Request $request){ 
        $id = $request->id;
        $logactivities = Logactivity::where('id',$id)->select('id','subject','url','method','ip','agent','staff_name','created_at')->first(); 
        $datentime = explode(" ", $logactivities->created_at);
        $date = $datentime[0];
        $time = $datentime[1];
        $datas['logactivities'] = $logactivities;
        $datas['crdate'] = $date;
        $datas['crtime'] = $time;
        return Response($datas);
    }
}
