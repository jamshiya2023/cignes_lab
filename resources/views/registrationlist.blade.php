@extends('layout.mainregister')
@section('content')
<style>
.red {
    color: #FF0000;
} 
.tooltips {
  position: relative;
  display: inline-block;
}

.tooltips .tooltiptext {
  visibility: hidden;
  width: 130px;
  background-color: #00ac9a;
  color: #fff;
  text-align: center;
  border-radius: 0px;
  padding: 5px 3px;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -60px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltips .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -10px;
  border-width: 10px;
  border-style: solid;
  border-color: #00ac9a transparent transparent transparent;
}

.tooltips:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">
                <div class="row g-2 row-deck">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title m-0">Registration Lists</h6>
                                <br>
                                <div class="row col-md-12">
								  <form class="row g-3"   method="post"  action="{{('search.list') }}" >                            
                                 @csrf
								<div class="col-md-3">
                                        <label class="form-label"> Registration No </label>
                                        <input type="text" class="form-control form-control-lg" name="registration_number" id="search">
                                        </div>
									<div class="col-md-3">
                                        <label class="form-label"> Date  </label>
                                        <input type="date" class="form-control form-control-lg" name="date" id="search">
                                         </div>
								<div class="col-md-3">
                                        <label class="form-label"> Customer Name </label>
                                        <input type="text" class="form-control form-control-lg" name="customer_name" id="search">
                                         </div>
									<div class="col-md-3">
                                        <label class="form-label"> Invoice No </label>
                                        <input type="text" class="form-control form-control-lg" name="invoice_number" id="search">
                                         </div>
									<div class="col-md-3">
                                       <input type="submit" class="btn btn-primary" name="search" id="search">
                                          </div>
									</form>
                                   </div>
                                <!-- <a href="{{ url('/add-staff') }}" class="btn btn-primary">button</a> -->
                                
                            </div>
                                @if(\Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    {{ \Session::get('success') }}
                                </div>
                                @endif
                            <div class="card-body">
                                <table id="staffs" class="table card-table table-hover align-middle mb-0 test" style="width: 100%;">
                                    <thead>
                                    <tr>
                                            <th>Customer Id</th>
                                             <th class="text-center">Registration Number</th>
                                              <th class="text-center">Registration Date</th>
                                            <th>Name </th>
                                            <th>Contact Number </th>
                                            <th>Place</th>
                                            <!--<th>Address</th>-->
                                           
                                           
                                            <th class="text-center">Bloodgroup</th>
                                            <!-- <th class="text-center">Paid</th> -->
                                            <!-- <th class="text-center">Balance</th> -->
                                            <!-- <th class="text-center">Payment Status</th>   
											-->
											 <th class="text-center">Id Proof</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                    @foreach($CustomerDetails as $Customer)
                                        <tr>
                                            <td>{{ $Customer->cust_id}}</td>
                                            <td>{{ $Customer->id}}</td>
                                            <td>{{ $Customer->registerdate}}</td> 
                                            <td>{{ $Customer->name}}</td>
                                            <td>{{ $Customer->phone}}</td>
                                            <td>{{ $Customer->place}}</td>
                                            <!--<td>{{ $Customer->add_line_one}}  </td>-->
                                          
                                          
                                            <td class="text-center">{{ $Customer->bloodgroup}}</td>
                                             
											 <td class="text-center"><button type="button" class="btn btn-primary btn-sm" onclick="proofview('{{$Customer->cust_id}}')">Click to View</button></td>
                                          
											<td class="text-center">
                                               
											 <a href="{{'edit-registration/'.$Customer->cust_id }}" class="btn btn-link btn-sm text-secondry" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit" aria-label="Edit">
                                                    <i class="fa fa-edit" style="color:#555CB8;"></i>
                                                </a>

											    <a href="{{'delete-registration/'.$Customer->id}}" onclick="return confirm('Do you want to Delete this Registration?')" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" aria-label="Delete">
                                                    <i class="fa fa-circle" style="color:#d63384;"></i>
                                                </a>
                                                </td>
                                        </tr>
                                        @endforeach
                                 </tbody>
                                </table>
                            </div>

                            


                            
                            
                        </div>
                    </div>
                </div> <!-- .row end -->

            </div>
        </div>


<!-- BRANCH ASSIGN TO STAFF STARTS HERE -->
 
                            <div class="modal fade" id="proofmodal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">ID Proof / Documents Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeproofmodal"></button>
                                        </div>
                                        <div class="modal-body" id="proofview"></div>
                                    </div>
                                </div>
                            </div>
                                                    <!-- BRANCH ASSIGN TO STAFF ENDS HERE -->

        <!--Modal ID Proof Starts Here-->
  <script type="text/javascript">
$('#search').on('keyup',function(){
$value=$(this).val();
$.ajax({
type : 'get',
url : '{{URL::to('search')}}',
data:{'search':$value},
success:function(data){
$('tbody').html(data);
}
});
})
</script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>      
    <script src="{!! asset('assets/plugin/jquery/3.3.1/jquery.min.js') !!}"></script>

    
    <script>
        function changepassword(staffid){
          // alert(staffid); exit();
           var newpassword = $('#newpassword'+staffid).val();
           var confirmpassword = $('#confirmpassword'+staffid).val();
           document.getElementById('newpasswordalert'+staffid).style.display = 'none'; 
           document.getElementById('confirmpasswordalert'+staffid).style.display = 'none'; 
           if(newpassword == ''){
              // alert('working');
                document.getElementById('newpasswordalert'+staffid).style.display = 'block'; 
                $('#newpassword'+staffid).focus();  
                return false;     
            } else if(confirmpassword == ''){
                document.getElementById('confirmpasswordalert'+staffid).style.display = 'block'; 
                $('#confirmpassword'+staffid).focus(); 
                return false;     
            } else if(newpassword != confirmpassword){
                document.getElementById('confirmpasswordalert'+staffid).style.display = 'block'; 
                document.getElementById('confirmpasswordalert'+staffid).innerHTML = 'Both passwords are mismatch';
                $('#confirmpassword'+staffid).focus(); 
                $('#confirmpassword'+staffid).select(); 
                //confirmpassword.focus();
               // confirmpassword.select();
               return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{'authupdate'}}",
                type: 'POST',
                data: { 
                    id: staffid,
                    newvalue: confirmpassword 
                    },
                success: function(response){           
                    if(response.success == 1){      
                        document.getElementById('passwordupdatealert'+staffid).style.display = 'block';
                        $('#newpassword'+staffid).val('');
                        $('#confirmpassword'+staffid).val('');
                    }

                }
            });
        }
        function modalclose(id) {
            $('#newpassword'+id).val('');
            $('#confirmpassword'+id).val('');
            document.getElementById('passwordupdatealert'+id).style.display = 'none';
            $("#logincredentials"+id).modal('hide');
        }

    
        
        function proofview(id) 
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                url: "{{ 'proofreg' }}",
                type: 'POST',
                data: { id: id },
                success: function(data)
                {
                    $.each(data,function(key, value){                        
                        $('#proofview').append('<div class="d-flex justify-content-between mb-3"><div class="form-check form-check-inline"><label class="form-check-label" for="flexCheckDefault"><strong>'+value.documentname+'</strong> - '+value.documentnumber+'  <span class="text-danger d-flex large">Expired on '+value.documentexpirydate+'</span></label></div><div><a href="" class="tooltips">View <span class="tooltiptext"><img src="{{ url("uploads") }}/'+value.documentfilename+'" width="120" height="auto"></span></a></div></div>');
                    })
                    $('#proofmodal').modal('show');
                }
            });


        }



        //closeproofmodal
        $( "#closeproofmodal" ).click(function() {
            $("#proofview").html("");
        });
        function branchview(id){
            //alert(id);
            /*return false;*/

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                url: "{{ 'branch-view' }}",
                type: 'POST',
                data: { id: id },
                success: function(response)
                {
                    $('#branch').modal('show');
                    var branchhtml = '';
                    var hiddenid;
                    branchhtml = '<option value="">- Please Select -</option>';
                    $.each(response.branches, function( index, branch) {                 
                        branchhtml += '<option value="'+branch.bid+'">'+branch.branchname+'</option>'; 
                });                
                    $('#branchname').html(branchhtml); 
                    $.each(response.staffbranches, function( index, staffbranch ) {
                    staffbranchid = staffbranch.branchid
                    hiddenid = staffbranch.staff_id; 
                });
                    $('#hiddenid').val(hiddenid); 
                    $('#branchname option[value="'+staffbranchid+'"]').attr("selected", "selected");
                   
                }
            });

        }
        // BRANCH POPUP CLOSE STARTS HERE 
        $( "#branchclose" ).click(function() {
            $("#branchname").html("");
            $("#branch").modal('hide');
        });
        // BRANCH POPUP CLOSE ENDS HERE

        // BRANCH UPDATE STARTS HERE 
        
        function savebranch() {
            if(document.assignbranch.branchname.value == ''){
                document.getElementById('branchnamealert').style.display = 'block';  
                document.assignbranch.branchname.focus(); 
                return false;     
            }
        document.assignbranch.submit();
        return true;
        }

        /// BRANCH UPDATE ENDS HERE


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
