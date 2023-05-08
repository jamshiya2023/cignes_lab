<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\TestCategory;

class TestCategoryController extends Controller
{
    public function testcategoryview()
    {
        if(Auth::check()){
            $userId = Auth::id();
            $testcategory = TestCategory::select('id','testcategory','testcategory_arabic','status','ordering')
            ->orderBy('ordering','asc')
            ->get();
            $ordering = TestCategory::select('ordering')->orderBy('ordering','asc')->get();
           // dd($ordering);
            return view('master_test_category', ['testcategory' => $testcategory, 'ordering' => $ordering]);
        }
        return redirect("/")->withError('You do not have access');
    }
    public function testcategoryadd(Request $request)
    {
        if(Auth::check()){
            $userId = Auth::id();
            $order = 0;
            $testcategory = new TestCategory;
            $testcategory->testcategory = $request->input('testcategoryname');
            $testcategory->testcategory_arabic = $request->input('arabictestcategoryname');
            $testcategory->status = '1';
            $testcategory->staffid = $userId;
            $testcategory->branchid = '0';   
            $testcategory->ordering = $order;     
            $savecategory = $testcategory->save();
                if($savecategory){
                    $records = TestCategory::get();
                        foreach($records as $row) {
                            $neworder = $row->ordering+1;
                            TestCategory::where('ordering', $row->ordering)
                                ->update([
                                    'ordering' => $neworder
                                    ]);

                            /*$table = new TestCategory;
                            $table->ordering = $row->ordering+1;
                            $table->update();*/
                            //$order++;
                        }
                    return redirect("test-category")->withSuccess('Test category added successfully');
                }
        }
        return redirect("/")->withError('You do not have access');
    }

    public function orderingupdate(Request $request){


        $id = $request->id;
        $newid = $request->cid;
  
        $currentorder = TestCategory::find($id);
        TestCategory::where('ordering', $newid)
                                ->update([
                                    'ordering' => $currentorder->ordering    
        ]);  
        TestCategory::where('id', $id)
                                ->update([
                                    'ordering' => $newid
                                    ]);

/*if($currentorderupdate && $neworderupdate) { */
               // return redirect("test-category")->withSuccess('Test category order updated successfully');
//}

                                  


//dd($currentorder->ordering);

    }
    public function edittestcategoryview(Request $request)
    {         
       $id = $request->id;
       $testcategory = TestCategory::where('id',$id)
                ->select('id','testcategory','testcategory_arabic')
                ->first();
       return Response($testcategory);
    }

    public function testcategoryedit(Request $request)
    { 
        $id = $request->input('hiddenid');
        $testcategory = TestCategory::find($id);
        $testcategory->testcategory = $request->input('testcategorynameedit');
        $testcategory->testcategory_arabic = $request->input('arabictestcategorynameedit');
        $testcategory->update();
        return redirect("test-category")->withSuccess('Test category updated successfully');    
    }

    // BLOCKING AND UNBLOCKING TEST CATEGORY STARTS HERE
    public function block(Request $request, $id)
    {
        $testcategory = TestCategory::find($id);
        $testcategory->status = '0';        
        $testcategory->update();
        return redirect("test-category")->withSuccess('Test category blocked successfully');
    }

    public function unblock(Request $request, $id)
    {
        $testcategory = TestCategory::find($id);
        $testcategory->status = '1';        
        $testcategory->update();
        return redirect("test-category")->withSuccess('Test category unblocked successfully');
    }
    // BLOCKING AND UNBLOCKING TEST CATEGORY ENDS HERE 


}
