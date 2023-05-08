@extends('layout.maintemplate')
@section('content')

<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">

                <div class="row g-2 row-deck">
                <!-- SINGLE TEST STARTS HERE -->
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title m-0">Single Tests</h6>
                                <a href="{{ url('/add-single-test') }}" class="btn btn-primary">Add Single Test</a> 
                            </div>
                            
                            
                            @if(Session::has('singletestsuccess'))
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    {{ Session::get('singletestsuccess') }}
                                </div>
                            @endif
                            

                            <div class="card-body">
                                <table id="" class="table card-table table-hover align-middle mb-0 test" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Test Name</th> 
                                            <th>Category</th> 
											<th>Primary Price</th>
                                            <th>Secondary Price</th>	
                                            <th>Normal Range</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach ($singletest as $test)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$test->testname}}</td>
                                            <td>{{$test->category}}</td>
                                            <td>{{$test->primaryprice}}</td>
                                            <td>{{ isset($test->secondaryprice) ? $test->secondaryprice : '-NA-' }}</td>
                                             <td><button type="button" class="btn btn-primary btn-sm" onclick="viewnormalrange('{{$test->id}}')" >Click To View</button></td>

                                            <td>
                                            <a href="{{'update-singletest/'.$test->id}}" class="btn btn-link btn-sm text-secondry" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit" aria-label="Edit">
                                                    <i class="fa fa-edit" style="color:#555CB8;"></i>
                                            </a>
                                            
                                            <!-- <a href="" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" aria-label="Delete">
                                                    <i class="fa fa-trash"></i>
                                            </a>     -->

                                            </td>
                                        </tr>
                                        @php
                                        $i++;
                                        @endphp

                                        @endforeach

                                        
                                        
                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="singlenormalrange" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">(Test Name)) Normal Range</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closesinglenormalrange"></button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="row g-4">
                                            <div class="d-flex justify-content-between mb-3">
                                            <div class="form-check form-check-inline">                                                    
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <strong>Age Limit</strong>
                                                        </label>
                                                </div>
                                                <div class="form-check form-check-inline">                                                    
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <strong>General</strong>
                                                        </label>
                                                </div>
                                                <div class="form-check form-check-inline">        
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        <strong>Male</strong>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        <strong>Female</strong>
                                                    </label>
                                                </div>
                                            </div>
                                                
                                        </div>
                                        <!-- append starts here -->
                                        <div class="row g-4" id="viewsingletest">
                                              

                                                
                                                                                         
                                        </div>
                                        <!-- append starts here -->
                                        


                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- SINGLE TEST LISTING ENDS HERE -->
                    
                    
                    
                </div> <!-- .row end -->

            </div>
        </div>


    
    <script src="{!! asset('assets/plugin/jquery/3.3.1/jquery.min.js') !!}"></script>
    <script>
     function viewnormalrange(id){
    // alert(id);  

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  
      $.ajax({
        type: 'POST',
        url: "{{ 'normalrangeview' }}",
        data: {id: id},
       
        success:function(data){
          // console.log(data);
          // alert('working');
        //  alert($data);

          $.each(data,function(key,value){
         
$('#viewsingletest').append('<div class="d-flex justify-content-between mb-3" ><div class="form-check form-check-inline"><label class="form-check-label" for="flexCheckDefault"><span class="text-normal d-flex large mb-1">'+value.agefrom+'-'+value.ageto+'</span></label></div><div class="form-check form-check-inline"><label class="form-check-label" for="flexCheckDefault"><span class="text-normal d-flex large mb-1">'+value.generalrange+'</span></label></div><div class="form-check form-check-inline"><label class="form-check-label" for="flexCheckDefault"><span class="text-normal d-flex large mb-1">'+value.malerange+'</span></label></div><div class="form-check form-check-inline"><label class="form-check-label" for="flexCheckDefault"><span class="text-normal d-flex large mb-1">'+value.femalerange +'</span></label></div> </div>');
          })

          $('#singlenormalrange').modal('show');
        }
        
    });

  // return false;
}

$('#closesinglenormalrange').click(function(){
    $('#viewsingletest').html("");
});

</script>




<script>
     function viewsingletests(id){
    // alert(id);  
   
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  
       $.ajax({
        type: 'POST',
        url: "{{ 'singletestview' }}",
        data: {id: id},
       
        success:function(data){
           // console.log(data);
        //    alert('working');
        // alert(data);exit();
        
        $.each(data,function(key,value){
            $('#profiletestviewlist').append('<span class="text-normal d-flex large mb-1">'+value.testname+'</span>'); 
            //<span class="text-normal d-flex large mb-1">Single Test1</span> 
        // alert(value.testname);
        $('#profiletests').modal('show');
        })

             
}
});
     }


     $('#closeprofiletest').click(function(){
    $('#profiletestviewlist').html("");
});
</script>
<script src="{!! asset('assets/js/bundle/dataTables.bundle.js') !!}"></script>
<script>
    // project data table
    $('.test').addClass('nowrap').dataTable({
      

      responsive: true,
     
    });
    
    
  </script>
<script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
@endsection
