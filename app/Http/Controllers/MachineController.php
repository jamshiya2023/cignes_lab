<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Machine;

class MachineController extends Controller
{
    public function machinelist()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $machines = Machine::select('id','machine_name','machine_name_arabic','machine_serial_no','status')
            ->orderBy('id','desc')
            ->get();
            return view('master_machine', ['machines' => $machines]);
        }
        return redirect("/")->withError('You do not have access');
    }

    public function machineadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $machine = new Machine;                  
            $machine->machine_name      = $request->input('machinename');
            $machine->machine_name_arabic      = $request->input('arabicmachinename');
            $machine->machine_serial_no = $request->input('machineno');
            $machine->status = '1';
            $machine->save();
            return redirect("machine")->withSuccess('Machine added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }

    public function viewmachine(Request $request)
    {
        $id = $request->id;
        $machine =Machine::where('id',$id)
                ->select('id','machine_name','machine_name_arabic','machine_serial_no')
                ->first();
                return Response($machine);
    }

    public function machineedit(Request $request){
        $id = $request->input('hiddenid');
        $machine=Machine::find($id);        
        $machine->machine_name=$request->input('machinenameedit');
        $machine->machine_name_arabic=$request->input('arabicmachinenameedit');
        $machine->machine_serial_no=$request->input('machinenoedit');
        $machine->update();
        return redirect("machine")->withSuccess('Machine updated successfully');
    }

    public function block(Request $request,$id)
    {
        $machine = Machine::find($id);
        $machine->status = '0';
        $machine->update();
        return redirect("machine")->withSuccess('Machine blocked successfully');
    }
    public function unblock(Request $request,$id)
    {   
        $machine= Machine::find($id);
        $machine->status = '1';
        $machine->update();
        return redirect("machine")->withSuccess('Machine unblocked successfully');
    }
}
