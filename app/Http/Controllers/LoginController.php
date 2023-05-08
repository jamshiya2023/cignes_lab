<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

// Additional uses
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;

use \Crypt;
use App\Models\User;

use App\Models\Menu;
use App\Models\Permission;
use App\Models\Staff;
use App\Models\Logactivity;

//use Illuminate\Support\Facades\Route;


class LoginController extends Controller
{
    public function username()
    {
        return 'username';
    }
    // Default login page view
    public function index()
    {      
      if(Auth::user()) { 
        return redirect()->intended('dashboard');
      } else {
        return view('login'); 
      } 
    } 

    // Login section 

    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],
        [   'username.required'=>'Please enter your username',
            'password.required'=>'Please enter your password',  
        ]    
    );
    $remember_me = $request->input('remember_me') ? true : false; 
    $remember_me = $request->remember_me;
    //dd($remember_me);
    if($remember_me===null){
            if (isset($_COOKIE["log_user"])) {
                unset($_COOKIE["log_user"]);
                setcookie('log_user', '', time() - (86400 * 30));
            }
            if(isset($_COOKIE["log_pass"])){
                unset($_COOKIE["log_pass"]);
                setcookie('log_pass', '', time() - (86400 * 30));
            }

    } else {
        setcookie('log_user',$request->username, time() + (86400 * 30));
        setcookie('log_pass',$request->password, time() + (86400 * 30));
    }
    //die();
    //dd($remember_me);
    $credentials = $request->only('username', 'password');
    if (Auth::attempt($credentials, $remember_me)) {
            // LOG ACTIVITY STARTS HERE 
            $loguserid = Auth::user()->staff_id;
            $logbranchid = Auth::user()->branchid;
            $logurl = url()->current();
            $logip = request()->ip();
            $logmethod =  request()->method();
            $logagent = $request->header('User-Agent');
            $logsubject = "login successfully";
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

        return redirect()->intended('dashboard');
    }
    return redirect("/")->withError('You have entered invalid username or password');        
    }

    // Authentication checking for access dashboard
    public function dashboard()
    {
        if(Auth::check()){
            

            //$menus = Menu::where('parent_id', '=', 0)->with('menus')->where('staff_id','=',$userId)->get();   
            //$menus = Menu::where('parent_id', '=', 0)->with('menus')->get(); 
           // $menus=Permission::with('menus')->where('staff_id', $userId)->get();
            //dd($menus);
            return view('dashboard');
        }
        return redirect("/")->withError('You do not have access');
    }

    // Logout
    public function logout(Request $request) {
        // LOG ACTIVITY STARTS HERE 
        $loguserid = Auth::user()->staff_id;
        $logbranchid = Auth::user()->branchid;
        $logurl = url()->current();
        $logip = request()->ip();
        $logmethod =  request()->method();
        $logagent = $request->header('User-Agent');
        $logsubject = "logout successfully";
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

        Session::flush();
        Auth::logout();
        return redirect("/")->withSuccess('You have been logged out successfully');
    }
}
