@extends('layout.maintemplate')
@section('content')
<style>
.modal-lg, .modal-xl {
  max-width: 90%!important;
}
.collecteddate{ z-index:99999 !important; }
</style>

<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">
                <div class="row g-2 row-deck">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title m-0">Accession / Acknowledge</h6>
                                
                            </div>
                             <div class="card-body">
								  <form class="row g-3"    method="post"  action="{{('accessionacknowledge.search')}}" >                            
                    @csrf	
                                        <div class="col-md-3">
                                        <label class="form-label"> Status </label>
                                        <Select class="form-control form-control-lg" name="status" id="">
                                            <option>--Select--</option>
                                            <option value="collected">Collected</option>
                                            <option value="pending">Pending</option>
                                            <option value="rejected">Rejected</option>
                                         </Select>
                                        </div>
								<div class="col-md-3">
                                        <label class="form-label"> Registration No </label>
                                        <input type="text" class="form-control form-control-lg" name="registration_number" id="">
                                        </div>
								<div class="col-md-3">
                                        <label class="form-label"> Date  </label>
                                        <input type="date" class="form-control form-control-lg" name="date" id="">
                                         </div>
								<div class="col-md-3">
                                        <label class="form-label"> Customer Name </label>
                                        <input type="text" class="form-control form-control-lg" name="customer" id="">
                                         </div>
							<!--	<div class="col-md-2">
                                        <label class="form-label"> Staff </label>
                                        <input type="text" class="form-control form-control-lg" name="staff" id="">
                                         </div> -->
								<div class="col-md-2">
                                       <input type="submit" class="btn btn-primary" name="search" id="search">
                                          </div>
									</form>
                                   </div>
                            <div class="card-body">
                                <table id="tblacknowledge" class="table card-table table-hover align-middle mb-0 test" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Reg Id</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Place</th>
                                            <th class="text-center">Date & Time</th> 
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sampledata as $data)
                                        @php 
                                        if($data->collected != 0) {
                                        $total = ($data->rejected + $data->notcollected + $data->pending + $data->collected + $data->accepted);
                                        $remaining = ($data->rejected + $data->notcollected + $data->pending);
                                        if($total > 1) { $samplestatus = 'Samples'; } else { $samplestatus = 'Sample'; }

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
                                            <td class="text-center"><span class="btn btn-sm bg-dark text-white" id="statuscount{{$data->regid}}" style="padding: .10rem .5rem; width:200px;"> Pending {{$remaining}} of {{$total}} {{$samplestatus}}</span></td>
                                            <td class="text-center"><a class="btn btn-sm bg-success text-white" onclick = "sampleupdates({{$data->regid}})">Update</a>  <!--<a class="btn btn-sm bg-dark text-white" onclick="viewdetails({{$data->regid}});">View</a>--></td>
                                        </tr>
                                        @php 
                                        }
                                        @endphp   
                                        


                                        <!-- COLLECTION STATUS UPDATES STARTS HERE -->
                       
                                        



<!-- COLLECTION STATUS UPDATED ENDS HERE -->


                                        @endforeach
                                        
                                        
                                        
                                        
                                        
                                    </tbody>
                                </table>
                            </div>


                            <form class="row g-3" id="samplecollectionform" name="samplecollectionform" method="post" action="{{ route('samplecollection.add') }}">                            
@csrf
                       <div class="modal fade" id="collection" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Accession / Acknowledge  # <span id="headid"></span></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div id="samplealert">
                                        
                                    </div>    

                                    <div class="modal-body custom_scroll">
                                    <table id="acknowlegeupdate" class="table card-table table-hover align-middle mb-0" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Test Name</th>
                                            <th class="text-center">Collected Status</th>
                                            <th class="text-center">Collected Date & Time</th>
                                            <th class="text-center">Received Date & Time</th>                                            
                                            <th class="text-center">Collection Note</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Reject Reason</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tblcollectionpopup">
                                    
                                        
                                    </tbody>
                                    </table>


                                           
                                    </div>
                                    <!-- <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>


                        
</form>
                            <!-- Modal -->

                            <div class="modal fade" id="viewdetails" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modaltitle">View Details  # </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="
                                        "></button>
                                    </div>
                                    <div class="modal-body custom_scroll">
                                    <div class="row g-4">
                                    <div class="col-sm-12">
                                        <label class="form-label">Confirmation Note</label>
                                        <p id = "note"></p>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="form-label">Date</label>
                                                <p id="notedate"></p>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">Time</label>
                                                <p id="notetime"></p>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-label">Status</label>
                                                <p id="notestatus"></p>
                                            </div>
                                        </div>
                                    </div>


                                    
                                </div>
                                
                                    </div>
                                    <div class="modal-footer">
                                        
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

<!-- VIEW INVOICE MODAL STARTS HERE -->
                        <div class="modal fade" id="invoice_detail" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Invoice #RA0011</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body custom_scroll">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        Invoice <strong>01/April/2022</strong>
                                                    </th>
                                                    <td class="text-end">
                                                        <span class="text-success"> <strong>Status:</strong> Paid</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div>From:</div>
                                                        <div class="fs-6 fw-bold mb-1">Cignes </div>
                                                        <div>Madalinskiego 8</div>
                                                        <div>71-101 Szczecin, Poland</div>
                                                        <div>Email: info@cignes.com.pl</div>
                                                        <div>Phone: +48 444 666 3333</div>
                                                    </td>
                                                    <td class="text-end">
                                                        <div>To:</div>
                                                        <div class="fs-6 fw-bold mb-1">Bob Mart</div>
                                                        <div>Attn: Daniel Marek</div>
                                                        <div>43-190 Mikolow, Poland</div>
                                                        <div>Email: marek@daniel.com</div>
                                                        <div>Phone: +48 123 456 789</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <table class="table table-borderless table-striped mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">#</th>
                                                                    <th>Test</th>
                                                                    <th class="text-end" colspan="2">Rate</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center">1</td>
                                                                    <td>LDL</td>
                                                                    <td class="text-end" colspan="2">$999,00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-center">2</td>
                                                                    <td>HDL</td>
                                                                    <td class="text-end" colspan="2">$150,00</td>

                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3">
                                                                        <h6>Terms &amp; Condition</h6>
                                                                        <p class="text-muted">You know, being a test pilot isn't always the healthiest business in the world. We predict too much for the next year and yet far too little for the next 10.</p>
                                                                    </td>
                                                                    <td colspan="3">
                                                                        <table class="table table-borderless mb-0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td ><strong>Subtotal</strong></td>
                                                                                    <td class="text-end">$8.497,00</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td ><strong>VAT (10%)</strong></td>
                                                                                    <td class="text-end">$679,76</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td ><strong>Total</strong></td>
                                                                                    <td class="text-end"><strong>$7.477,36</strong></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
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
        $('#collection').modal({
            backdrop: 'static',
            keyboard: false
        })
   });
</script>
<script type='text/javascript' src="{!! asset('assets/bundles/jquery.inputmask.bundle.js') !!}"></script>
<script>
var $j = jQuery.noConflict();
$j(document).ready(function(){
        $j('#docexpirydate').inputmask('99/99/9999',{placeholder:"dd/mm/yyyy"});
});

function sampleupdates(id){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    //alert('regid->'+id+'token->'+token); return false;
    $.ajax({
        url:"{{'accession-acknowledge-view'}}",
        type: 'POST',
        data: { 
            id:id,
            _token:token
        },
        success: function(response){
            $('#collection').modal('show');
            var testlist = "";
            var num = 1;
            var teststatus;
            var statushtml;
            var rejectreason="NA";
            var samplecollectionnote;
            var reasonhtml = "";
            var dates;
            var collecteddates;
            var months;
            var year;
            var day;
            var cdate;
            var monthname;
            var fdate;
            var time;
            var timeformat;


            var receviedfulldate;
            var rdate;
            var rtime;
            var rtimeformat;
            var recevieddates;
            var rday;
            var rmonths;
            var ryear;
            var recevieddates;
            var rmonthname;


          reasonhtml = '<option value="">--Please Select--</option>';
          $.each(response.reasons, function( index, reason ) {
            reasonhtml += '<option value="'+reason.reasonid+'">'+reason.reasonname+'</option>';
          });  
            $.each(response.testlists, function( index, tests ) {
                num = num+index;
                teststatus = tests.status;
                
                if(tests.collectionnote == null || tests.collectionnote == undefined){
                    samplecollectionnote = '-NA-';
                } else {
                    samplecollectionnote = tests.collectionnote;
                }
                
                cdate = tests.collectiondate.split(" ");    
                fdate = cdate[0];
                ftime = cdate[1];
                timeformat = cdate[2].toLowerCase();
                dates = fdate.split("-");                
                day = dates[0];
                months = dates[1];
                year = dates[2];
                collecteddates =  year+'-'+months+'-'+day;
                monthname = new Date(collecteddates).toLocaleString('en-us',{month:'short'});

                receviedfulldate = tests.recevieddate.split(" "); 
                rdate = receviedfulldate[0];
                rtime = receviedfulldate[1];
                rtimeformat = receviedfulldate[2].toLowerCase();
                recevieddates = rdate.split("-"); 
                rday = recevieddates[0];
                rmonths = recevieddates[1];
                ryear = recevieddates[2];
                recevieddates =  ryear+'-'+rmonths+'-'+rday;
                rmonthname = new Date(recevieddates).toLocaleString('en-us',{month:'short'});                

                if(teststatus == 'collected'){ statushtml = '<span class="btn btn-sm bg-success text-white" style="padding: .10rem .5rem; width:100px;">Collected</span>';} 
                testlist += '<tr><td style="width:3%">'+num+'</td><td style="width:10%">'+tests.testname+'</td><td class="text-center" style="width:10%">'+statushtml+'</td><td class="text-center" style="width:10%">'+monthname+' '+day+', '+year+' '+ftime+' '+timeformat+'</td><td class="text-center" style="width:10%">'+rmonthname+' '+rday+', '+ryear+' '+rtime+' '+rtimeformat+'</td><td style="width:20%">'+samplecollectionnote+'</td><td style="width:20%"><select class="form-select form-select-lg" name="collectionstatus" id="collectionstatus'+tests.id+'" onchange="accessionstatus(this.value,'+tests.id+')"><option value="">--Please Select--</option><option value="accepted">Accepted</option><option value="rejected">Rejected</option></select><div class="alert-danger pt-1 pb-1 px-1 py-1" id="collectionstatusalert'+tests.id+'" style="display:none ;">Please select status</div></td><td><select class="form-select form-select-lg" name="rejectreason" id="rejectreason'+tests.id+'" style="resize:none; display:none;">'+reasonhtml+'</select><textarea class="form-control form-control-lg mt-1" name="rejectionnote" id="rejectionnote'+tests.id+'" style="resize:none; display:none;" placeholder="Enter rejection reason"></textarea><div class="alert-danger pt-1 pb-1 px-1 py-1" id="rejectreasonalert'+tests.id+'" style="display:none ;">Please select reason</div></td><td style="width:7%"><input type="hidden" id="hidregid'+tests.id+'" value="'+tests.rid+'"><a class="btn btn-sm bg-success text-white" id="'+tests.id+'" onclick="collectionupdate(this.id)">Save</a></td></tr>';
            });
            
            $('#headid').html(response.rid);
            $('#samplealert').html('');
            $('#tblcollectionpopup').html(testlist);
            
            
        }
    });


   

} 

function collectionupdate(id){
    var collectionstatusval = $('#collectionstatus'+id).val();
   // alert(collectionstatusval); return false;
    var rejectionnote = $('#rejectionnote'+id).val();
    var rejectreasonval = $('#rejectreason'+id).val();
    
    var regid = $('#hidregid'+id).val();
    //alert(regid); return false;
    document.getElementById('collectionstatusalert'+id).style.display = 'none';
    document.getElementById('rejectreasonalert'+id).style.display = 'none';
   // document.getElementById('collecteddatealert'+id).style.display = 'none';
   // document.getElementById('receiveddatealert'+id).style.display = 'none';

    if(collectionstatusval == ''){
        document.getElementById('collectionstatusalert'+id).style.display = 'block'; 
        return false;
    }
    if(collectionstatusval == 'rejected'){
        if(rejectreasonval == ''){
            document.getElementById('rejectreasonalert'+id).style.display = 'block'; 
            return false;
        }
    }
    
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content"); 
        $.ajax({
                    url:"{{ 'accession-acknowledge' }}",
                    type: 'POST',
                    data: { 
                        id:id,
                        reg:regid,
                        status:collectionstatusval,
                        rejectionreason:rejectreasonval,
                        rejectionnote:rejectionnote,
                        _token:token
                    },
                    success: function(response){
                        
                        var testlist = "";
                        var num = 1;
                        var teststatus;
                        var statushtml;
                        var rejectreason="NA";
                        var samplecollectionnote;
                        var reasonhtml = "";
                        var alertmsg ="";
                        var monthname;
                        var date;
                        var collecteddate;
                        var months;
                        var year;
                        var day;
                        reasonhtml = '<option value="">--Please Select--</option>';
                        $.each(response.reasons, function( index, reason ) {
                        reasonhtml += '<option value="'+reason.reasonid+'">'+reason.reasonname+'</option>';
                        }); 
                        $.each(response.tests, function( index, test ) {

                            
                            date = test.collectiondate.split("-");
                            day = date[0];
                            months = date[1];
                            year = date[2];
                            collecteddate =  date[2]+'-'+months+'-'+year;
                            monthname = new Date(collecteddate).toLocaleString('en-us',{month:'short'})

                                num = num+index;
                                teststatus = test.status;
                
                                if(test.collectionnote == null || test.collectionnote == undefined){
                                    samplecollectionnote = '-NA-';
                                } else {
                                    samplecollectionnote = test.collectionnote;
                                }
                                if(teststatus == 'collected'){ statushtml = '<span class="btn btn-sm bg-success text-white" style="padding: .10rem .5rem; width:100px;">Collected</span>';} 
                               testlist += '<tr><td style="width:3%">'+num+'</td><td style="width:10%">'+test.testname+'</td><td class="text-center">'+statushtml+'</td><td class="text-center" style="width:10%">'+monthname+' '+test.collectiondate+'</td><td class="text-center" style="width:10%">'+test.recevieddate+'</td><td style="width:20%">'+samplecollectionnote+'</td><td style="width:20%"><select class="form-select form-select-lg" name="collectionstatus" id="collectionstatus'+test.id+'" onchange="accessionstatus(this.value,'+test.id+')"><option value="">--Please Select--</option><option value="accepted">Accepted</option><option value="rejected">Rejected</option></select><div class="alert-danger pt-1 pb-1 px-1 py-1" id="collectionstatusalert'+test.id+'" style="display:none ;">Please select status</div></td><td><select class="form-select form-select-lg" name="rejectreason" id="rejectreason'+test.id+'" style="resize:none; display:none;">'+reasonhtml+'</select><textarea class="form-control form-control-lg mt-1" name="rejectionnote" id="rejectionnote'+test.id+'" style="resize:none; display:none;" placeholder="Enter rejection reason"></textarea><div class="alert-danger pt-1 pb-1 px-1 py-1" id="rejectreasonalert'+test.id+'" style="display:none ;">Please select reason</div></td><td style="width:7%"><input type="hidden" id="hidregid'+test.id+'" value="'+test.rid+'"><a class="btn btn-sm bg-success text-white" id="'+test.id+'" onclick="collectionupdate(this.id)">Save</a></td></tr>';
                            });
                            if(response.msg == 'accepted') { 
                                alertmsg = '<div class="alert-success  text-center mt-2 mx-auto" role="alert" style="padding: 0.3rem 2.5rem; border-radius:3px;">Sample accepted successfully</div>';
                            } else {
                                alertmsg = '<div class="alert-danger  text-center mt-2 mx-auto" role="alert" style="padding: 0.3rem 2.5rem; border-radius:3px;">Sample rejected successfully</div>';
                            }
                            var alerthtml = alertmsg;
                            var counts = response.remains;
                            //alert(counts);
                            if(counts =='0'){
                                $('#samplealert').html('');
                                $('#collection').modal('hide');
                                window.location.reload();

                            } else {
                                $('#samplealert').html(alerthtml);
                                $('#tblcollectionpopup').html(testlist);
                            }
                        
                        
                        }
            });
    
}

function accessionstatus(optvalue,id){
    //alert(optvalue+'->'+id);
    if(optvalue == 'rejected'){
        $('#rejectreason'+id).show();
        $('#rejectionnote'+id).show();        
    } else {
        $('#rejectreason'+id).hide();
        $('#rejectionnote'+id).val('');
        $('#rejectionnote'+id).hide();
    }
}

    function viewdetails(id){
    // alert(id);
    var note;
    var notestatus;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
       // url:"{{ 'viewnote' }}",
       url:"{{ route('samplecollection.view') }}",
       type: 'POST',
       data: { 
            id:id
            
            },
       success: function(response){


     
        if(response.note == null )
        {
            note='-NA-';
        }else{
            note=response.note;
        }

        if(response.notestatus == 'confirmed'){
            notestatus = 'Confirmed';
        }
        $('#modaltitle').html('View Details # '+response.res);
        $('#note').html(note);
        $('#notedate').html(response.notedate);
        $('#notetime').html(response.notetime);
        $('#notestatus').html(notestatus);


         $('#viewdetails').modal('show');
         //
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
