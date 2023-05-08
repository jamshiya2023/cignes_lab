<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Country;

class CountryController extends Controller
{
    public function countryview()
    {
        if(Auth::check()){
            $country = Country::select('id','country_name','status')
            ->orderBy('country_name','asc')
            ->get();
            return view('master_country', ['countries' => $country]);
        }
        return redirect("/")->withError('You do not have access');
    }
    public function countryadd(Request $request)
    {
        if(Auth::check()){
            $country = new Country;
            $country->country_name = $request->input('countryname');
            $country->status = '1';
            $country->save();
            return redirect("country")->withSuccess('Country added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }
    public function editcountryview(Request $request)
    {         
       $id = $request->id;
       $country = Country::where('id',$id)
                ->select('id','country_name')
                ->first();
       return Response($country);
    }

    public function countryedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $country = Country::find($id);
        $country->country_name = $request->input('countrynameedit');
        $country->update();
        return redirect("country")->withSuccess('Country updated successfully');    
    }

    // BLOCKING AND UNBLOCKING COUNTRY STARTS HERE
    public function block(Request $request, $id)
    {
        $country = Country::find($id);
        $country->status = '0';        
        $country->update();
        return redirect("country")->withSuccess('Country blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $country = Country::find($id);
        $country->status = '1';        
        $country->update();
        return redirect("country")->withSuccess('Country unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING COUNTRY ENDS HERE 

}
