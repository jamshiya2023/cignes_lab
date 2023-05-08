<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;

class StateController extends Controller
{
    public function stateview()
    {
        if(Auth::check()){
            $country = Country::select('id','country_name')
            ->where('status',1)
            ->orderBy('country_name','asc')
            ->get();
            $state = State::join('country','country.id','=','state.country_id')->select('state.id as id','state.state_name','state.status as status','country.country_name as countryname')
            ->orderBy('id','asc')
            ->get();

            return view('master_state', [
                'countries' => $country,
                'state' => $state
            ]);
        }
        return redirect("/")->withError('You do not have access');
    }
    public function stateadd(Request $request)
    {
        if(Auth::check()){
            $state = new State;
            $state->country_id = $request->input('countryname');
            $state->state_name = $request->input('statename');
            $state->status = '1';
            $state->save();
            return redirect("state")->withSuccess('State added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }
    public function editstateview(Request $request)
    {         
       $id = $request->id;
       $state = State::where('id',$id)
                ->select('id as sid','country_id','state_name')
                ->get();
       $country = Country::select('id as cid','country_name')
                    ->get(); 
        $datas['states'] = $state;
        $datas['countries'] = $country;
                           
       return Response($datas);
    }

    public function stateedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $country = State::find($id);
        $country->country_id = $request->input('countrynameedit');
        $country->state_name = $request->input('statenameedit');
        $country->update();
        return redirect("state")->withSuccess('State updated successfully');    
    }

    // BLOCKING AND UNBLOCKING STATE STARTS HERE
    public function block(Request $request, $id)
    {
        $state = State::find($id);
        $state->status = '0';        
        $state->update();
        return redirect("state")->withSuccess('State blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $state = State::find($id);
        $state->status = '1';        
        $state->update();
        return redirect("state")->withSuccess('State unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING STATE ENDS HERE 
}
