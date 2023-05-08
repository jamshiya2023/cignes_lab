<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tube;

class TubeController extends Controller
{
    public function tubelist()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $tubes = Tube::select('id','tube_name','tube_name_arabic','tube_serial_no','status')
            ->orderBy('id','desc')
            ->get();
            return view('master_tube', ['tubes' => $tubes]);
        }
        return redirect("/")->withError('You do not have access');
    }

    public function tubeadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $tube = new Tube;                  
            $tube->tube_name        = $request->input('tubename');
            $tube->tube_name_arabic = $request->input('arabictubename');
            $tube->tube_serial_no   = $request->input('tubeno');
            $tube->status = '1';
            $tube->save();
            return redirect("tube")->withSuccess('Tube added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }

    public function viewtube(Request $request)
    {
        $id = $request->id;
        $tube =Tube::where('id',$id)
                ->select('id','tube_name','tube_name_arabic','tube_serial_no')
                ->first();
                return Response($tube);
    }

    public function tubeedit(Request $request){
        $id = $request->input('hiddenid');
        $tube=Tube::find($id);        
        $tube->tube_name=$request->input('tubenameedit');
        $tube->tube_name_arabic=$request->input('arabictubenameedit');
        $tube->tube_serial_no=$request->input('tubenoedit');
        $tube->update();
        return redirect("tube")->withSuccess('Tube updated successfully');
    }

    public function block(Request $request,$id)
    {
        $tube = Tube::find($id);
        $tube->status = '0';
        $tube->update();
        return redirect("tube")->withSuccess('Tube blocked successfully');
    }
    public function unblock(Request $request,$id)
    {   
        $tube= Tube::find($id);
        $tube->status = '1';
        $tube->update();
        return redirect("tube")->withSuccess('Tube unblocked successfully');
    }
}
