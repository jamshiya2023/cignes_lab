@extends('layout.mainregister')
@section('content')
<style>
.modal-lg, .modal-xl {
  max-width: 80%!important;
}

</style>

<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">

                <div class="row g-2 row-deck">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title m-0">Sample Rejection</h6>
                                
                            </div>
                            <div class="card-body">
                                <table id="tblsamplereject" class="table card-table table-hover align-middle mb-0 test" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Reg Id</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Place</th>
                                            <th class="text-center">Register Date & Time</th>
                                            
                                            <!-- <th style="text-align:center;"> Collection Status</th> -->
                                            <th style="text-align:center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sampledata as $data)
                                        @php 
                                        $date = $data->regdate;
                                        $receptdate = explode('-', $date);
                                        $day   = $receptdate[2];
                                        $month = $receptdate[1]; 
                                        $year  = $receptdate[0];  
                                        $monthname = date("M", mktime(0, 0, 0, $month, 10)); 
                                        $time = $data->regtime;
                                        $recepttime = explode(':', $time);
                                        $timeformat = explode(' ', $recepttime[2]);

                                        @endphp
                                        <tr>
                                            <td>{{$data->regid}}</td>
                                            <td>{{$data->customername}}</td>
                                            <td>{{$data->customerphone}}</td>
                                            <td>{{$data->customerplace}}</td>
                                            <td class="text-center">{{ $monthname}} {{ $day }}, {{ $year }} {{$recepttime[0]}}:{{$recepttime[1]}} {{strtolower($timeformat[1])}}</td>
                                            
                                           
                                            <td style="text-align:center;"><a class="btn btn-sm bg-dark text-white" onclick="viewdetails({{$data->regid}});">View</a></td>
                                           




                                            
                                        </tr>
                                       


                                        <!-- COLLECTION STATUS UPDATES STARTS HERE -->
                       
                                        



<!-- COLLECTION STATUS UPDATED ENDS HERE -->


                                        @endforeach
                                        
                                        
                                        
                                        
                                        
                                    </tbody>
                                </table>
                            </div>


                            <!-- Modal -->


<!-- VIEW INVOICE MODAL STARTS HERE -->
                        
                            <div class="modal fade" id="invoice_detail" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modaltitle">Rejected Details # <span id="headid"></span></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body custom_scroll">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td id="invoicedate"></th>
                                                    <td class="text-end" id="status"><span class="text-danger"> <strong>Status:</strong> Rejected</span> </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div>From:</div>
                                                        <div class="fs-6 fw-bold mb-1">Cignes Lab App </div>
                                                        <div>7272 Abi Dhar Al Ghaffari</div>
                                                        <div>Ar Rabwah Dist.</div>
                                                        <div>Unit No 2, Riyadh 12834 - 3236</div>
                                                        <div>Kingdom of Saudi Arabia</div>
                                                        <div>Email: info@cignes.com.pl</div>
                                                        <div>Phone: +966 50 524 0523</div>
                                                    </td>
                                                    <td class="text-end" id="customeraddress"> </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <table class="table table-borderless table-striped mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center" style="width:5%">#</th>
                                                                    <th class="text-first" style="width:20%">Test Name</th>
                                                                    <th class="text-first" style="width:20%">Rejected By</th>
                                                                    <th class="text-first" style="width:20%">Rejected Reason</th>
                                                                    <th class="text-first" style="width:35%">Note</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="modelbody"> 
                                                            
                                                            </tbody>
                                                            
                                                            </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary"><i class="fa fa-print me-2"></i>Print</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>


<!-- VIEW INVOICE MODAL ENDS HERE -->                            
                            
                        </div>
                    </div>
                </div> <!-- .row end -->

            </div>
        </div>
                            <div class="modal fade" id="ViewRecentTestsModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Invoice-12345 Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-between mb-1">
                                                <div class="form-check form-check-inline">                                                   
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        <strong>LDL</strong>
                                                    </label>
                                                </div>                                                
                                            </div>
                                            
                                            <div class="d-flex justify-content-between mb-1">
                                                <div class="form-check form-check-inline">                                                   
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        <strong>Triglycerides </strong>
                                                    </label>
                                                </div>                                                
                                            </div>
                                            
                                            <div class="d-flex justify-content-between mb-1">
                                                <div class="form-check form-check-inline">                                                   
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        <strong>HDL</strong>
                                                    </label>
                                                </div>                                                
                                            </div>
                                            
                                            <div class="d-flex justify-content-between mb-1">
                                                <div class="form-check form-check-inline">                                                   
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        <strong>Profile Test Two</strong>
                                                    </label>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<script src="{!! asset('assets/plugin/jquery/3.3.1/jquery.min.js') !!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#invoice_detail').modal({
            backdrop: 'static',
            keyboard: false
        })
   });
</script>
<script type='text/javascript' src="{!! asset('assets/bundles/jquery.inputmask.bundle.js') !!}"></script>
<script>

function viewdetails(id){
     //alert(id); return false;
    // $('#invoice_detail').modal('show');
    // return false;
     var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    //alert('regid->'+id+'token->'+token); return false;
    $.ajax({
        url:"{{'sample-rejection-view'}}",
        type: 'POST',
        data: { 
            id:id,
            _token:token
        },
        success: function(response){
            $('#invoice_detail').modal('show');
          var testlist = "";
          var num = 1;
          var teststatus;
          var rejectreason="NA";
          var samplecollectionnote;
          var customerdetailshtml='';
          var registerdate;
          var registertime;
          var addonehtml;
          var addtwohtml;
          var placehtml;
          var cityhtml;
          var pincodehtml; 
          var emailhtml;
          var phonehtml;
          var date;
          var day;
          var month;            
          var year;
          var time;
          var rejreasonhtml;
          var rejnotehtml;
          //var dates;
          var monthname;
          
            $.each(response.testlists, function( index, tests ) {
                num = num+index;
                teststatus = tests.status;
                if($.trim(tests.addone) == ''){ addonehtml = ''; } else { addonehtml = tests.addone; }
                if($.trim(tests.addtwo) == ''){ addtwohtml = ''; } else { addtwohtml = tests.addtwo+','; }
                if($.trim(tests.place) == ''){ placehtml = ''; } else { placehtml = tests.place; }
                if($.trim(tests.city) == ''){ cityhtml = ''; } else { cityhtml = tests.city+','; }
                if($.trim(tests.pincode) == ''){ pincodehtml = ''; } else { pincodehtml = tests.pincode; }
                if($.trim(tests.email) == ''){ emailhtml = ''; } else { emailhtml = 'Email: '+tests.email; }
                if($.trim(tests.phone) == ''){ phonehtml = ''; } else { phonehtml = 'Phone: '+tests.phone; }
                if($.trim(tests.rejectionreason) == ''){ rejreasonhtml = '-NA-'; } else { rejreasonhtml = tests.rejectionreason; }
                if($.trim(tests.rejectnote) == ''){ rejnotehtml = '-NA-'; } else { rejnotehtml = tests.rejectnote; }

                registerdate = tests.registerdate;
                registertime = tests.registertime;
                time = registertime.split(":");
                timeformat = time[2].split(" ");
                
                monthname = new Date(registerdate).toLocaleString('en-us',{month:'short'})
                date = registerdate.split("-");
                day = date[2];
                month = date[1];
                year = date[0];
                
                testlist += '<tr><td class="text-center" style="width:5%">'+num+'</td><td class="text-first" style="width:15%">'+tests.testname+'</td><td class="text-first" style="width:15%">'+tests.fname+' '+tests.lname+'</td><td style="width:15%" class="text-first">'+rejreasonhtml+'</td><td style="width:50%" class="text-first">'+rejnotehtml+'</td></tr>';
                customerdetailshtml = '<div>To:</div><div class="fs-6 fw-bold mb-1">'+tests.custname+'</div><div>'+addonehtml+'</div><div>'+addtwohtml+' '+placehtml+'</div><div>'+cityhtml+' '+tests.country+' '+pincodehtml+'</div><div>'+emailhtml+'</div><div>'+phonehtml+'</div>';

            });
            
            
            $('#invoicedate').html('Register Date <strong>'+monthname+' '+day+', '+year+' '+time[0]+':'+time[1]+' '+timeformat[1]+'</strong>'); 
            $('#headid').html(response.rid);
            $('#customeraddress').html(customerdetailshtml);
            $('#modelbody').html(testlist);
            
            
        }
    });
}
 



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
