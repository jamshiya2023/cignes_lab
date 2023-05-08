<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Menu;
use App\Models\Legaldocuments;
use App\Models\Staff;
use App\Models\Staffdocuments;
use App\Models\Permission;
use App\Models\Admin;
use App\Models\Branch;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Logactivity;
use DB;
//use Input;

class StaffController extends Controller
{
   
    // LIST ALL STAFFS STARTS HERE
    public function viewstaff()
    {
        if(Auth::check()){
            $userId = Auth::id();
            //dd($userId);
/*
            $branches = Branch::select('id as branchid','branchname')
            ->orderBy('id','desc')
            ->get();
*/
            $staffdetails = Staff::select('staff.*', 'departments.department_name as departmentname', 'designation.designation_name as designationname')
                ->join('departments', 'departments.id', '=', 'staff.department_id')
                ->join('designation', 'designation.id', '=', 'staff.designation_id')
                ->get();
            //return view('staffs', compact('staffdetails'));
            return view('staffs', ['staffdetails' => $staffdetails]);

        }
        return redirect("/")->withError('You do not have access');
    }
    // LIST ALL STAFFS STARTS HERE
    // CHANGE PASSWORD STARTS HERE
    public function changestaffpassword(Request $request)
    {
        $staff_id = $request->id;
        $pass = Hash::make($request->newvalue);;
        $staff = Admin::where('staff_id', $staff_id)
            ->update(['password' => $pass]);
        $data['success'] = 1;
        return response()->json($data);
    }

    // CHANGE PASSWORD ENDS HERE

    // PROOF VIEW POPUP STARTS HERE 

    public function proofview(Request $request)
    {
         
       $staff_id = $request->id;
       $proofs = Staffdocuments::join('legaldocuments', 'staffdocuments.documenttype_id', '=', 'legaldocuments.id')
                ->where('staffdocuments.staff_id',$staff_id)
                ->where('staffdocuments.status','1') 
                ->select('staffdocuments.*','legaldocuments.documenttype as documentname')
                ->get();
       return Response($proofs);
    }
    // PROOF VIEW POPUP ENDS HERE 
    // BLOCKING AND UNBLOCKING STAFF STARTS HERE
    public function blockstaff(Request $request, $id)
    {
        $designation = Staff::find($id);
        $designation->status = '0';        
        $designation->update();

        // LOG ACTIVITY STARTS HERE 
        $staffname = Staff::where('id',$id)->select('firstname','lastname')->first();
        $loguserid = Auth::user()->staff_id;
        $logbranchid = Auth::user()->branchid;
        $logurl = url()->current();
        $logip = request()->ip();
        $logmethod =  request()->method();
        $logagent = $request->header('User-Agent');
        $logsubject = "blocked staff ".$staffname->firstname." ".$staffname->lastname;
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
        return redirect("staffs")->withSuccess('Staff blocked successfully');
    }

    public function unblockstaff(Request $request, $id)
    {
        $designation = Staff::find($id);
        $designation->status = '1';        
        $designation->update();

        // LOG ACTIVITY STARTS HERE 
        $staffname = Staff::where('id',$id)->select('firstname','lastname')->first();
        $loguserid = Auth::user()->staff_id;
        $logbranchid = Auth::user()->branchid;
        $logurl = url()->current();
        $logip = request()->ip();
        $logmethod =  request()->method();
        $logagent = $request->header('User-Agent');
        $logsubject = "unblocked staff ".$staffname->firstname." ".$staffname->lastname;
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
        return redirect("staffs")->withSuccess('Staff unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING STAFF ENDS HERE 

    //ADD STAFFS VIEW PAGE STARTS HERE 
    public function viewaddstaff()
    {
        if(Auth::check()){
          
            $departmentlist = Department::where("status", "=", 1)->get();
            //$menulist = Menu::where("status", "=", 1)->get();
            $menulist = Menu::where('parent_id', '=', 0)->where('status','=', 1)->get();
           // $childcount = Menu::where('parent_id', 0)->withCount('childs')->get();

            //$childcount = Menu::where('parent_id', 0)->get();

            $menus = $menulist->loadCount('childs');
            //echo $counts; exit();
            //dd($counts);
/*
           $menulist = Menu::select('menu.id as id, menu.parent_id, child.id as childid,  menu.title')
           ->join('menu as child','child.parent_id','=','menu.id')
           ->where('menu.parent_id','=',0)
           ->get();
*/
           //dd($menulist);
           
           /*$menulist = DB::table('menus')
                ->select('menus.id, menus.parent_id, menus.title')
                ->join('menus child', 'child.parent_id', '=', 'menus.id')
                ->where('menus.parent_id','=',0)
                ->get();*/
           $documenttype = Legaldocuments::where("status", "=", 1)->get();
            return view('addstaff', [
                'departments' => $departmentlist,
                'menulist' => $menus,
                'documenttypelist' => $documenttype
            ]);
        }
        return redirect("/")->withError('You do not have access');
    }
     //ADD STAFFS VIEW PAGE STARTS HERE

     // DESIGNATION LISTING DEPENDS ON DEPARTMENTS IN DROPDOWN STARTS HERE 

     public function designationdropdown(Request $request)
     {
          
        $depart_id = $request->department_id;
        $designations = Designation::select('id','designation_name')
                ->where('department_id',$depart_id)
                ->where('status','1') 
                ->get();
        return Response($designations);
     }
     // DESIGNATION LISTING DEPENDS ON DEPARTMENTS IN  DROPDOWN ENDS HERE 



    //STAFF DETAILS STORE TO DATABASE STARTS HERE
    public function addstaff(Request $request)
    { 
       //dd($request->all());
       $tempcustid = $request['tempcustid'];
        $staff = new Staff;
        $count = Staff::count();
       
        if($count>0){
            $lateststaffdetails = Staff::latest('id')->first();
            $laststaffcode = $lateststaffdetails->staffcode;
            $incrementstaffcode = ($laststaffcode+1);
            $staffcode = str_pad($incrementstaffcode, 6, "0", STR_PAD_LEFT);
        } else 
        {
            $staffcode = '000001';
        }

        
        if($request->file('profilepic') ==''){
            $profilepic = '';
        }else {
            $profileImageName = 'pro_'.$request['firstname'].'_'.time().'.'.$request->profilepic->extension();  
            $request->profilepic->move('uploads', $profileImageName);
            $profilepic = $profileImageName;
        }
        if($request->file('signature') ==''){
            $signature = '';
        }else {
            $signatureImageName = 'sig_'.$request['firstname'].'_'.time().'.'.$request->signature->extension();  
            $request->signature->move('uploads', $signatureImageName);
            $signature = $signatureImageName;
        }

        $staff->staffcode = $staffcode;
        $staff->firstname = isset($request['firstname']) ? $request['firstname'] : '';
        $staff->lastname = isset($request['lastname']) ? $request['lastname'] : '';
        $staff->department_id = isset($request['department']) ? $request['department'] : '';
        $staff->designation_id = isset($request['designation']) ? $request['designation'] : '';
        $staff->gender = isset($request['gender']) ? $request['gender'] : '';
        $staff->dateofbirth = isset($request['dateofbirth']) ? $request['dateofbirth'] : '';
        $staff->qualification = isset($request['qualification']) ? $request['qualification'] : '';
        $staff->email = isset($request['email']) ? $request['email'] : '';
        $staff->contactnumber = isset($request['contactnumber']) ? $request['contactnumber'] : '';
        $staff->specialist = isset($request['specialist']) ? $request['specialist'] : '';
        $staff->profilepicture = $profilepic;
        $staff->signature = $signature;
        $staff->details = isset($request['details']) ? $request['details'] : '';
        
        $staff->status = '1';
        $staff->save(); 
        $stafflastid = $staff->id; 
        // USER NAME AND PASSWORD SAVE TO  USER TABLE STARTS HERE
        $users = new Admin;
        $name = str_replace(' ', '', $request['firstname']);
        $firstname = strtolower(substr($name, 0, 4));  // abcd
        //$newpassword = Str::random(8);
        $newpassword = $firstname.$staffcode;
        //echo $newpassword; exit();
        $users->username = 'EMP'.$staffcode;
        $users->password = Hash::make($newpassword);
        $users->email = isset($request['email']) ? $request['email'] : '';
        $users->role = '3';
        $users->staff_id = $stafflastid;
        $users->status = '1';
        $users->save(); 
        // USER NAME AND PASSWORD SAVE TO  USER TABLE ENDS HERE

        // PERMISSION ASSIGNED TO STAFF STARTS HERE
        $menuid = $request->input('menuid');
        $parentid = $request->input('parentid');
        $menuview = $request->input('menuview');
        $menuadd = $request->input('menuadd');
        $menuedit = $request->input('menuedit');
        $menublock = $request->input('menublock');
        $menudelete = $request->input('menudelete');

        foreach ($menuid as $index => $menu) {
            $permissions = new Permission;
            $permissions->staff_id = $stafflastid;
            $permissions->menu_id = $menu;
            $permissions->parentid = $parentid[$index];

            //if($menuview[$index] || $menuadd[$index] || $menuedit[$index] || $menublock[$index] || $menudelete[$index]) {
                $permissions->viewmenu = $menuview[$index];
                $permissions->addmenu = $menuadd[$index];
                $permissions->editmenu = $menuedit[$index];
                $permissions->blockmenu = $menublock[$index];
                $permissions->deletemenu = $menudelete[$index];
                $permissions->status = '1';
                $permissions->save(); 
            //}

        }

        //PERMISSION ASSIGNED TO STAFF ENDS HERE

        // UPDATE THE STAFF ID IN THE STAFF DOCUMENTS  STARTS HERE         
        $update_details = array('staff_id' => $stafflastid);    
        $staffidupdate = Staffdocuments::where('staff_id', $tempcustid)->update($update_details);
        // UPDATE THE STAFF ID IN THE STAFF DOCUMENTS  ENDS HERE 

        // LOG ACTIVITY STARTS HERE 
        $stafffirstname = isset($request['firstname']) ? $request['firstname'] : '';
        $stafflastname = isset($request['lastname']) ? $request['lastname'] : '';
        $loguserid = Auth::user()->staff_id;
        $logbranchid = Auth::user()->branchid;
        $logurl = url()->current();
        $logip = request()->ip();
        $logmethod =  request()->method();
        $logagent = $request->header('User-Agent');
        $logsubject = "added new staff ".$stafffirstname." ".$stafflastname;
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

        return redirect("staffs")->withSuccess('Staff added successfully');    
    }
    //STAFF DETAILS STORE TO DATABASE ENDS HERE

    // STAFF DOCUMENTS ADDING SECTION STARTS HERE 

    public function adddocuments(Request $request){
            $staffdocuments = new Staffdocuments;
            $tempstaffid = $request->input('token');
            $file = $request->file('file');
            $documenttype = $request->input('dtype');
            $documentnumber = $request->input('dnumber');
            $documentexpirydate = $request->input('dexpirydate');
            $documentName = 'document_'.time().'.'.$request->file->extension();  
            $request->file->move('uploads', $documentName);
           // $docnewname = 

            $staffdocuments->staff_id = $tempstaffid;
            $staffdocuments->documenttype_id = $documenttype;
            $staffdocuments->documentnumber = $documentnumber;
            $staffdocuments->documentexpirydate = $documentexpirydate;
            $staffdocuments->documentfilename = $documentName;
            $staffdocuments->status = '1';
            $staffdocuments->save(); 

            // LOG ACTIVITY STARTS HERE 
            $loguserid = Auth::user()->staff_id;
            $logbranchid = Auth::user()->branchid;
            $logurl = url()->current();
            $logip = request()->ip();
            $logmethod =  request()->method();
            $logagent = $request->header('User-Agent');
            $logsubject = "uploaded staff document";
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

            $lastid = $staffdocuments->id;
            $responseDocuments = Staffdocuments::select('*')->where('id', $lastid)->first();
            $doctype = Legaldocuments::select('documenttype')->where('id', $responseDocuments->documenttype_id)->first();
           
            $data['documentid'] = $responseDocuments->id;
            $data['documenttype'] = $doctype->documenttype;
            $data['documentnumber'] = $responseDocuments->documentnumber;
            $data['documentexpirydate'] = $responseDocuments->documentexpirydate;
            $data['documentfile'] = $responseDocuments->documentfilename;
            $data['success'] = 1;
            return response()->json($data);

    }

    // STAFF DOCUMENT ADDING SECTION ENDS HERE

    public function deletedocuments(Request $request){

        $id = $request->input('id');
        $stid = $request->input('sid');
        //print 'id->'.$id;
        //print '<br>stid->'.$stid;  
        //exit();
        $image = Staffdocuments::find($id); 
        unlink("uploads/".$image->documentfilename);
        $res=Staffdocuments::where('id',$id)->delete();
        // LOG ACTIVITY STARTS HERE 
        $loguserid = Auth::user()->staff_id;
        $logbranchid = Auth::user()->branchid;
        $logurl = url()->current();
        $logip = request()->ip();
        $logmethod =  request()->method();
        $logagent = $request->header('User-Agent');
        $logsubject = "deleted staff document";
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



        $doccount = Staffdocuments::where('staff_id',$stid)->count();
        $data['success'] = 1;  
        $data['doccount'] = $doccount;           
        return response()->json($data);
            //$data['success'] = 1;
    }

   

    public function editstaff($id)
    {
        if(Auth::check()){
            /*$designation = Designation::join('departments', 'designation.department_id', '=', 'departments.id')
               ->where('designation.id', $id)
               ->first(['designation.*','departments.department_name']);
        return view('editdepartment', compact('designation'));*/
            $staffdetails = Staff::where("id", "=", $id)->first();
            //->first(['*']);
            $departmentlist = Department::where("status", "=", 1)->get();
            //$menulist = Menu::where("status", "=", 1)->get();
            $documenttype = Legaldocuments::where("status", "=", 1)->get();
            //$selectedpermissions = Permission:: where("staff_id", "=", $id)->get();

            $did = $staffdetails->department_id;
            $designation = Designation::where("department_id", "=", $did)->get();
                    
            //$menulist = Menu::where('parent_id', '=', 0)->get();    
            $menulist = Menu::where('parent_id', '=', 0)->with('permission')->get();    
            // Menus listing not exist in the  permission table starts here      
            //$permissionids = Permission::where('staff_id',$id)->pluck('menu_id');
            //$balancemenu = Menu::whereNotIn('id', $permissionids)->select('*')->get();
            // Menus listing not exist in the  permission table starts here

            $existingdocuments = Staffdocuments::leftJoin('legaldocuments', 'legaldocuments.id','=','staffdocuments.documenttype_id')
                    ->where('staffdocuments.staff_id','=', $id)
                    ->where('staffdocuments.status','=', '1')
                    ->select('staffdocuments.*','legaldocuments.documenttype')
                    ->get();
            $existingdocumentscount = count($existingdocuments);
           
            return view('editstaff', [
                'staff' => $staffdetails,
                'departments' => $departmentlist,
                'menulist' => $menulist,
                'documenttypelist' => $documenttype,
                'existingdocuments' => $existingdocuments,
                'designations' => $designation,
                'existingdocumentscount' => $existingdocumentscount            
            ]);

         }
         return redirect("/")->withError('You do not have access');
    }


     //STAFF DETAILS STORE TO DATABASE STARTS HERE
     public function updatestaff(Request $request, $id)
     { 
        //$editid = $request['eid'];
         //$staff = new Staff;
         $staff = Staff::find($id);
        // $staffdetails = Staff::where('id','=',$id)->first();
         $profilepicture = $staff->profilepicture;
         $signaturepicture = $staff->signature;
            // echo 'department->'.$request['department']; exit();     
         if($request->file('profilepic') ==''){
             $profilepic = $profilepicture;
         }else {
             $profileImageName = 'pro_'.$request['firstname'].'_'.time().'.'.$request->profilepic->extension();  
             $request->profilepic->move('uploads', $profileImageName);
             $profilepic = $profileImageName;
         }
         if($request->file('signature') ==''){
             $signature = $signaturepicture;
         }else {
             $signatureImageName = 'sig_'.$request['firstname'].'_'.time().'.'.$request->signature->extension();  
             $request->signature->move('uploads', $signatureImageName);
             $signature = $signatureImageName;
         }
         
         $staff->staffcode = $request['staffcode'];
         $staff->firstname = isset($request['firstname']) ? $request['firstname'] : '';
         $staff->lastname = isset($request['lastname']) ? $request['lastname'] : '';
         $staff->department_id = isset($request['department']) ? $request['department'] : '';
         $staff->designation_id = isset($request['designation']) ? $request['designation'] : '';
         $staff->gender = isset($request['gender']) ? $request['gender'] : '';
         $staff->dateofbirth = isset($request['dateofbirth']) ? $request['dateofbirth'] : '';
         $staff->qualification = isset($request['qualification']) ? $request['qualification'] : '';
         $staff->email = isset($request['email']) ? $request['email'] : '';
         $staff->contactnumber = isset($request['contactnumber']) ? $request['contactnumber'] : '';
         $staff->specialist = isset($request['specialist']) ? $request['specialist'] : '';
         $staff->profilepicture = $profilepic;
         $staff->signature = $signature;
         $staff->details = isset($request['details']) ? $request['details'] : '';
         $staff->update();
         
         // PERMISSION ASSIGNED TO STAFF STARTS HERE
         $permissiondetails = Permission::where('staff_id','=',$id)->get();
         $permissioncount = count($permissiondetails);
         if($permissioncount>0) {
            $permissiondelete=Permission::where('staff_id',$id)->delete();          
         }
         
         $menuid = $request->input('menuid');
         $menuview = $request->input('menuview');
         $menuadd = $request->input('menuadd');
         $menuedit = $request->input('menuedit');
         $menublock = $request->input('menublock');
         $menudelete = $request->input('menudelete');
 
         foreach ($menuid as $index => $menu) {
             $permissions = new Permission;
             $permissions->staff_id = $id;
             $permissions->menu_id = $menu;            
             $permissions->viewmenu = $menuview[$index];
             $permissions->addmenu = $menuadd[$index];
             $permissions->editmenu = $menuedit[$index];
             $permissions->blockmenu = $menublock[$index];
             $permissions->deletemenu = $menudelete[$index];
             $permissions->status = '1';
             $permissions->save(); 
         
         }
 
 
         //dd($request->all());
         //PERMISSION ASSIGNED TO STAFF ENDS HERE
 
         // UPDATE THE STAFF ID IN THE STAFF DOCUMENTS  STARTS HERE         
         $update_details = array('staff_id' => $id);    
         $staffidupdate = Staffdocuments::where('staff_id', '0')->update($update_details);
         // UPDATE THE STAFF ID IN THE STAFF DOCUMENTS  ENDS HERE 




         // LOG ACTIVITY STARTS HERE 
         $staffname = Staff::where('id',$id)->select('firstname','lastname')->first();
         $loguserid = Auth::user()->staff_id;
         $logbranchid = Auth::user()->branchid;
         $logurl = url()->current();
         $logip = request()->ip();
         $logmethod =  request()->method();
         $logagent = $request->header('User-Agent');
         $logsubject = "updated staff ".$staffname->firstname." ".$staffname->lastname;
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
 
         return redirect("staffs")->withSuccess('Staff updated successfully');    
     }
     //STAFF DETAILS STORE TO DATABASE ENDS HERE    

     public function branchview(Request $request)
     {  
        $staffid = $request->id;
        $branches = Branch::select('id as bid','branchname')->get(); 
        $staffbranches = Admin::select('branchid','staff_id')->where('staff_id',$staffid)->get();
        $datas['staffbranches'] = $staffbranches;
        $datas['branches'] = $branches;
       return Response($datas);
     }

     public function branchviewedit(Request $request)
    { 
        $staffid = $request->input('hiddenid');
        $staffname = Staff::where('id',$staffid)->select('firstname','lastname')->first();
        
        $branchid = $request->input('branchname');
        $branchname = Branch::where('id',$branchid)->select('branchname')->first();
        //$branch->update();
        $branchup = Admin::where('staff_id',$staffid)->update(['branchid'=>$branchid]);

        // LOG ACTIVITY STARTS HERE 
        $loguserid = Auth::user()->staff_id;
        $logbranchid = Auth::user()->branchid;
        $logurl = url()->current();
        $logip = request()->ip();
        $logmethod =  request()->method();
        $logagent = $request->header('User-Agent');
        $logsubject = "assigned ".$branchname->branchname." branch to ".$staffname->firstname.' '.$staffname->lastname;
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
        return redirect("staffs")->withSuccess('Branch assigned successfully');    
    }

     //

}
