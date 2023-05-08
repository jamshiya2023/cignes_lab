<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\OrganismSetup;

class OrganismSetupController extends Controller
{
    public function organismsetupview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $organismsetup = OrganismSetup::select('id','organism','status')
            ->orderBy('id','desc')
            ->get();
            //return view('master_organism');
            return view('master_organism_setup', ['organism' => $organismsetup]);
        }
        return redirect("/")->withError('You do not have access');
    }
    public function organismsetupadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $organism = new OrganismSetup;
            $organism->organism = $request->input('organismname');
            $organism->status = '1';
            $organism->staffid = $userId;
            $organism->branchid = '0';        
            $organism->save();
            return redirect("organism-setup")->withSuccess('Test organism added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }
    public function editorganismsetupview(Request $request)
    {         
       $id = $request->id;
       $organism = OrganismSetup::where('id',$id)
                ->select('id','organism')
                ->first();
       return Response($organism);
    }

    public function organismsetupedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $organism = OrganismSetup::find($id);
        $organism->organism = $request->input('organismnameedit');
        $organism->update();
        return redirect("organism-setup")->withSuccess('Test organism updated successfully');    
    }

    // BLOCKING AND UNBLOCKING Organism STARTS HERE
    public function block(Request $request, $id)
    {
        $organism = OrganismSetup::find($id);
        $organism->status = '0';        
        $organism->update();
        return redirect("organism-setup")->withSuccess('Test organism blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $organism = OrganismSetup::find($id);
        $organism->status = '1';        
        $organism->update();
        return redirect("organism-setup")->withSuccess('Test organism unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING Organism ENDS HERE 

}
