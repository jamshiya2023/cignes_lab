<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class BranchController extends Controller
{
    public function branchview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $countries = Country::where('status',1)->get();
            $branchs = Branch::select('id','branchname','vatnumber','status')
            ->orderBy('id','desc')
            ->get();
            return view('master_branch', ['branchs' => $branchs,'countries' => $countries]);
        }
        return redirect("/")->withError('You do not have access');
    }
    public function branchadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $branch = new Branch;
            
           if($request->file('branchlogo')) {
            $branchlogo = $request->file('branchlogo');
            $branchlogoname = 'branchlogo'.time().'.'.$request->branchlogo->extension();
            $request->branchlogo->move('uploads', $branchlogoname); 
           } else {
            $branchlogoname = '';
           }
           
            $branch->branchname     = $request->input('branchname');
            $branch->vatnumber      = $request->input('vatnumber');
            $branch->crnumber       = $request->input('crnumber');
            $branch->branchlogo     = $branchlogoname;
            $branch->contactnumber  = $request->input('contactnumber');
            $branch->email          = $request->input('email');
            $branch->address_one    = $request->input('addone');
            $branch->address_two    = $request->input('addtwo');
            $branch->countryid      = $request->input('countryname');
            $branch->stateid        = $request->input('statename');
            $branch->cityid         = $request->input('cityname');
            $branch->pincode        = $request->input('postalcode');
            $branch->status = '1';
            $branch->save();
            return redirect("branch")->withSuccess('Branch added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }
    public function editbranchview(Request $request)
    {         
       $id = $request->id;
       $branches = Branch::where('id',$id)->select('*')
                ->get();

       $branch = Branch::where('id',$id)->select('*')
                ->first();
                
       $country = Country::where('status',1)->get();
       $state = State::where('country_id',$branch->countryid)->where('status',1)->select('id as statid','state_name as statesname')->get();
       $city = City::where('state_id',$branch->stateid)->where('status',1)->select('id as ctyid','city_name as citiesname')->get();
        $data['branches'] = $branches;
        $data['cities'] = $city;
        $data['states'] = $state;
        $data['countries'] = $country;
       return Response($data);
    }

    public function branchedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $branch = Branch::find($id);
        $logoqry = Branch::where('id',$id)->select('branchlogo')->first();
        if($request->file('branchlogoedit')) {
            $branchlogo = $request->file('branchlogoedit');
            $branchlogoname = 'branchlogo'.time().'.'.$request->branchlogoedit->extension();
            $request->branchlogoedit->move('uploads', $branchlogoname); 
            unlink("uploads/".$logoqry->branchlogo);
           } else {
            $branchlogoname = $logoqry->branchlogo;
           }

        $branch->branchname     = $request->input('branchnameedit');
        $branch->vatnumber      = $request->input('vatnumberedit');
        $branch->crnumber       = $request->input('crnumberedit');
        $branch->branchlogo     = $branchlogoname;
        $branch->contactnumber  = $request->input('contactnumberedit');
        $branch->email          = $request->input('emailedit');
        $branch->address_one    = $request->input('addoneedit');
        $branch->address_two    = $request->input('addtwoedit');
        $branch->countryid      = $request->input('countrynameedit');
        $branch->stateid        = $request->input('statenameedit');
        $branch->cityid         = $request->input('citynameedit');
        $branch->pincode        = $request->input('postalcodeedit');

        $branch->update();
        return redirect("branch")->withSuccess('Branch updated successfully');    
    }

    // BLOCKING AND UNBLOCKING Payment method STARTS HERE
    public function block(Request $request, $id)
    {
        $branch = Branch::find($id);
        $branch->status = '0';        
        $branch->update();
        return redirect("branch")->withSuccess('Branch blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $branch = Branch::find($id);
        $branch->status = '1';        
        $branch->update();
        return redirect("branch")->withSuccess('Branch unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING Payment method ENDS HERE  

    public function loadstate(Request $request){
        $countryid = $request->id;
        $state = State::where('country_id',$countryid)
                ->where('status',1)
                ->select('id as sid','state_name as statename')
                ->get();
                $datas['states'] = $state;
                return Response($datas);

    }

    public function loadcity(Request $request){
        $stateid = $request->id;
        $city = City::where('state_id',$stateid)
                ->where('status',1)
                ->select('id as cityid','city_name as cityname')
                ->get();
                $datas['cities'] = $city;
                return Response($datas);

    }
}
