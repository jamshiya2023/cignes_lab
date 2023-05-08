@extends('layout.maintest_template')
@section('content')

<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">

                <div class="row g-2 row-deck">
                
                    <!-- PROFILE TEST LISTING STARTS HERE -->
                    
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title m-0">Profile Tests</h6>
                                <a href="{{ url('/add-profile-test') }}" class="btn btn-primary">Add Profile Test</a>
                            </div>


                            @if(Session::has('profiletestsuccess'))
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    {{ Session::get('profiletestsuccess') }}
                                </div>
                            @endif


                            <div class="card-body">
                                <table id="profiletest" class="table card-table table-hover align-middle mb-0 profiletest" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Profile Name</th>
                                            <th>Primary Price</th>
                                            <th>Secondary Price</th>
                                            <th>Tests Includes</th>                                            
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @php
                                    $j=1;
                                    @endphp
                                    @foreach ($profiletest as $profile)
                                        <tr>
                                            <td>{{$j}}</td>
                                            <td>{{$profile->testname}}</td>
                                            <td>{{$profile->primaryprice}}</td>
                                            <td>{{ isset($profile->secondaryprice) ? $profile->secondaryprice : '-NA-' }}</td>
                                          
                                             <td><button type="button" class="btn btn-primary btn-sm" onclick="viewsingletests('{{$profile->singletestids}}')" >Click To View</button></td>


                                             <td>
                                            <a href="{{'update-profiletest/'.$profile->id}}" class="btn btn-link btn-sm text-secondry" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit" aria-label="Edit">
                                                    <i class="fa fa-edit" style="color:#555CB8;"></i>
                                            </a>
                                    
                                            <!-- <a href="#" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" aria-label="Delete">
                                                    <i class="fa fa-trash"></i>
                                            </a>     -->
                                            </td>
                                        </tr>

                                        @php
                                        $j++;
                                        @endphp
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal -->

                            <div class="modal fade" id="profiletests" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tests Includes</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeprofiletest"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-between mb-2">
                                                
                                            <div class="form-check form-check-inline">                                                    
                                                    <label class="form-check-label" for="flexCheckDefault" id="profiletestviewlist">
                                                    
                                                    
                                                    </label>
                                                </div>

                                            </div>



                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    
                    <!-- PROFILE TEST LISTING ENDS HERE -->
                    
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
    $('.profiletest').addClass('nowrap').dataTable({
      

      responsive: true,
     
    });
    
    
  </script>


    
    
    
    <script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
@endsection
