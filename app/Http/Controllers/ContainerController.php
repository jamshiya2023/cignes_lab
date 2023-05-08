<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Container;

class ContainerController extends Controller
{
    public function containerlist()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $containers = Container::select('id','container_name','container_name_arabic','container_serial_no','status')
            ->orderBy('id','desc')
            ->get();
            return view('master_container', ['containers' => $containers]);
        }
        return redirect("/")->withError('You do not have access');
    }

    public function containeradd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $container = new Container;                  
            $container->container_name          = $request->input('containername');
            $container->container_name_arabic   = $request->input('arabiccontainername');
            $container->container_serial_no     = $request->input('containerno');
            $container->status = '1';
            $container->save();
            return redirect("container")->withSuccess('Container added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }

    public function viewcontainer(Request $request)
    {
        $id = $request->id;
        $container =Container::where('id',$id)
                ->select('id','container_name','container_name_arabic','container_serial_no')
                ->first();
                return Response($container);
    }

    public function containeredit(Request $request){
        $id = $request->input('hiddenid');
        $container=Container::find($id);        
        $container->container_name=$request->input('containernameedit');
        $container->container_name_arabic=$request->input('arabiccontainernameedit');
        $container->container_serial_no=$request->input('containernoedit');
        $container->update();
        return redirect("container")->withSuccess('Container updated successfully');
    }

    public function block(Request $request,$id)
    {
        $container = Container::find($id);
        $container->status = '0';
        $container->update();
        return redirect("container")->withSuccess('Container blocked successfully');
    }
    public function unblock(Request $request,$id)
    {   
        $container= Container::find($id);
        $container->status = '1';
        $container->update();
        return redirect("container")->withSuccess('Container unblocked successfully');
    }
}
