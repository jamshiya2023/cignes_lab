<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use DB;
use Illuminate\Http\Request;
use Hash;
use Mail;

class ForgotPasswordController extends Controller
{
  
   public function postforgotpassword33(Request $request)
    {
       $request->validate([
        'email' => 'required|email',
    ],
    [
     'email.required'=> 'Please enter your email address', 
     'email.email'=> 'Invalid email addresss! Please re-enter'
    ]
 );
 $email = $request->email;

 //$users = DB::table('users')->select('username','email')->where('email',$email)->get();
// $countQry = Admin::where('email','=',$email)->get();
 
$countQry = Admin::where('email','=',$request->email)->get();
$count = count($countQry);
 
if($count>0){
    $emailquery = Admin::select('username','email','password')->where('email','=',$request->email)->first();
    $usename = $emailquery->username;
    $dbemail = $emailquery->email;

 $pass = $emailquery->password;
   
} else {

   $dbemail ="null";
}
//$sdf =  Crypt::decrypt($pass); 
 //$sdf = Hash::decode($pass);
  // dd($dbemail);die();
 //$tomail = $dbemail;
    $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message){
         $message->to('kcsmithesh@gmail.com','Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from('smithcignes@gmail.com','Virat Gandhi');
      });
	 // dd($dbemail);die();
	   echo "HTML Email Sent. Check your inbox.";
  
 if($dbemail == $email)
{
 
return redirect('confirm-password')->with('foremail',$request->email);



} else {

     
    return redirect("/")->withError('You do not have access');
}
 
    }
  
  
   public function postforgotpassword(Request $request) 
    {
       
    $request->validate([
        'email' => 'required|email',
    ],
    [
     'email.required'=> 'Please enter your email address', 
     'email.email'=> 'Invalid email addresss! Please re-enter'
    ]
 );
 $email = $request->email;

  
 
$countQry = Admin::where('email','=',$request->email)->get();
$count = count($countQry);
 
if($count>0){
    $emailquery = Admin::select('username','email')->where('email','=',$request->email)->first();
    $usename = $emailquery->username;
    $dbemail = $emailquery->email;


   
} else {

   $dbemail ="null";
}
 
 if($dbemail == $email)
{
  
return redirect('confirm-password')->with('foremail',$request->email);



} else {

    
 
    return redirect("/")->withError('You do not have access');
}
 
    }
    public function viewforgotpassword()
    {
        return view('forgotpassword');
    }

    public function postforgotpassword2(Request $request)
    {
      
    $request->validate([
        'useemail' => 'required|email',
    ],
    [
     'useemail.required'=> 'Please enter your email address', 
     'useemail.email'=> 'Invalid email addresss! Please re-enter'
    ]
 );

 
 

// dd($emailquery->username);
// 

$countQry = Admin::where('email','=',$request->useemail)->get();
$count = count($countQry);
//echo $count;
//exit();
//condotion
if($count>0){
    $emailquery = Admin::select('username')->where('email','=',$request->useemail)->first();
    $usename = $emailquery->username;
} else {
    $usename = '';

}



 if($usename ==='superadmin')
{
     //echo 'uesrname->'.$emailquery->username; exit();


//  return redirect()->intended('confirm-password');
return redirect('confirm-password')->with('foremail',$request->useemail);



} else {

    //echo "not worjking "; exit();
 
    return redirect("/")->withError('You do not have access');
}



 //$wordCount = count($emailquery);


// dd($emailquery);
// dd($username);



    //  dd($request->emailaddress);
    }

    public function viewconfirmpassword()
    {
        return view('confirmpassword');
    }

    
    public function updatepassword(Request $request)
    {

         $useremail = $request->foremail;
         $confirmpass = $request->confirmpass;
         $newpassword = Hash::make($confirmpass);

         Admin::where('email', $useremail)
              ->where('id',1)
              ->where('username','superadmin')
              ->where('role',1)
              ->update(['password' => $newpassword]);

              return redirect("/")->withSuccess('Your password updated successfully');


    }
    
}
