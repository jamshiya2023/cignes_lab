<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\TestMethod;

class TestMethodController extends Controller
{
    public function testmethodview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $testmethods = TestMethod::select('id','testmethod','testmethod_arabic','status')
            ->orderBy('id','desc')
            ->get();
            //return view('master_testmethod');
            return view('master_test_method', ['testmethods' => $testmethods]);
        }
        return redirect("/")->withError('You do not have access');
    }
    public function testmethodadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $testmethod = new TestMethod;
            $testmethod->testmethod = $request->input('testmethodname');
            $testmethod->testmethod_arabic = $request->input('arabictestmethodname');
            $testmethod->status = '1';
            $testmethod->staffid = $userId;
            $testmethod->branchid = '0';        
            $testmethod->save();
            return redirect("test-method")->withSuccess('Test method added successfully');
        }
        return redirect("/")->withError('You do not have access');
    }
    public function edittestmethodview(Request $request)
    {         
       $id = $request->id;
       $testmethod = TestMethod::where('id',$id)
                ->select('id','testmethod','testmethod_arabic')
                ->first();
       return Response($testmethod);
    }

    public function testmethodedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $testmethod = TestMethod::find($id);
        $testmethod->testmethod = $request->input('testmethodnameedit');
        $testmethod->testmethod_arabic = $request->input('arabictestmethodnameedit');
        $testmethod->update();
        return redirect("test-method")->withSuccess('Test method updated successfully');    
    }

    // BLOCKING AND UNBLOCKING Test method STARTS HERE
    public function block(Request $request, $id)
    {
        $testmethod = TestMethod::find($id);
        $testmethod->status = '0';        
        $testmethod->update();
        return redirect("test-method")->withSuccess('Test method blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $testmethod = TestMethod::find($id);
        $testmethod->status = '1';        
        $testmethod->update();
        return redirect("test-method")->withSuccess('Test method unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING Test method ENDS HERE 
}
