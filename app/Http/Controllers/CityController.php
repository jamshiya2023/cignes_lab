<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\City;

class CityController extends Controller
{
    public function cityview()
    {
        if(Auth::check()){
            $country = Country::select('id','country_name')
            ->where('status',1)
            ->orderBy('country_name','asc')
            ->get();
            $city = City::join('country','country.id','=','city.country_id')
            ->join('state','state.id','=','city.state_id')
            ->select('country.country_name as countryname','state.state_name as statename', 'city.id as id', 'city.city_name as cityname','city.status as status')
            ->orderBy('id','asc')
            ->get();

            return view('master_city', [
                'countries' => $country,
                'cities' => $city 
            ]);
        }
        return redirect("/")->withError('You do not have access');
    }
    public function cityadd(Request $request)
    {
        if(Auth::check()){
            $city = new City;
            $city->country_id = $request->input('countryname');
            $city->state_id = $request->input('statename');
            $city->city_name = $request->input('cityname');
            $city->status = '1';
            $city->save();
            return redirect("city")->withSuccess('City added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }
    public function editcityview(Request $request)
    {         
       $id = $request->id;
       $city = City::join('country','country.id','=','city.country_id')
                ->join('state','state.id','=','city.state_id')
                ->where('city.id',$id)
                ->select('city.id as cityid','city.country_id as countryid','city.state_id as stateid','city.city_name')
                ->first();
       $country = Country::select('id as cid','country_name')
                    ->get(); 
       /*$state = State:: join('city','city.state_id','=','state.id')
       ->select('state.id as sid','state.state_name as state')
       ->distinct('state.id')
       ->get(); 
       */  
      $state = State:: where('country_id',$city->countryid)
      ->select('state.id as sid','state.state_name as state')
      ->get();          
        $datas['cityid'] = $city->cityid;
        $datas['countryid'] = $city->countryid;
        $datas['stateid'] = $city->stateid;
        $datas['cityname'] = $city->city_name;
        $datas['states'] = $state;
        $datas['countries'] = $country;
                           
       return Response($datas);
    }

    public function cityedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        //dd($id);
        $city = City::find($id);
        $city->country_id = $request->input('countrynameedit');
        $city->state_id = $request->input('statenameedit');
        $city->city_name = $request->input('citynameedit');
        $city->update();
        return redirect("city")->withSuccess('City updated successfully');    
    }

    // BLOCKING AND UNBLOCKING STATE STARTS HERE
    public function block(Request $request, $id)
    {
        $city = City::find($id);
        $city->status = '0';        
        $city->update();
        return redirect("city")->withSuccess('City blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $city = City::find($id);
        $city->status = '1';        
        $city->update();
        return redirect("city")->withSuccess('City unblocked successfully');
    }

    public function loadstate(Request $request){
        $countryid = $request->id;
        $state = State::where('country_id',$countryid)
                ->where('status',1)
                ->select('id as sid','state_name as statename')
                ->get();
                $datas['states'] = $state;
                return Response($datas);

    }
}
