@extends('layout.mainregister')
@section('content')
<style>
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
                                <h6 class="card-title m-0">Client Portal</h6>
                                
                            </div>
                            <div class="card-body">
                                <table id="myAllDoctor" class="table card-table table-hover align-middle mb-0 test" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Contact Number</th>
                                            <th>Email</th>
                                            <th>Place</th>
                                            <th>Details</th>
                                            <!-- <th class="text-center">Actions</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clientdata as $key => $value)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $value->name }}</td>
                                            <td>{{ $value->phone }}</td>
                                            <td>{{ $value->email }}</td>
                                            <td>{{ $value->place }}</td>
                                            
                                            
                                            <td><a style="cursor:pointer;" onclick="viewdetails({{ $value->id }});" class="btn btn-sm bg-dark text-white">View</a></td>
                                            <!-- <td class="text-center">
                                                <a href="#" class="btn btn-link btn-sm text-secondry" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit" aria-label="Edit">
                                                    <i class="fa fa-edit" style="color:#555CB8;"></i>
                                                </a>
                                                
                                                <a href="#"  onclick="return confirm('Do you want to block this designation?')" class="btn btn-link btn-sm text-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Active" aria-label="Active">
                                                    <i class="fa fa-ban" style="color:#198754;"></i>
                                                    
                                                </a>
                                                
                                                <a href="" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" aria-label="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td> -->
                                        </tr>
                                        @endforeach    
                                        
                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal -->
                            
                            <!-- VIEW INVOICE MODAL STARTS HERE -->
                        <div class="modal fade" id="view" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Customer Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body custom_scroll"  id="printable">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                
                                                <tr>
                                                    <td id="customerdetails">
                                                        
                                                        <!-- <div class="fs-6 fw-bold mb-1">Jaison Peter </div>
                                                        <div>Contact Number: +966 50 524 0523</div>
                                                        <div>Emergency Contact: +966 50 524 0523</div>
                                                        <div>Email: info@cignes.com.pl</div>
                                                        <div>Blood Group: AB +ve</div>
                                                        <div>Gender: AB +ve</div> -->
                                                        
                                                        
                                                    </td>
                                                    <td class="text-end" id="customeraddress">
                                                        <!-- <div class="fs-6 fw-bold mb-1">&nbsp;</div>
                                                        <div>7272 Abi Dhar Al Ghaffari</div>
                                                        <div>Ar Rabwah Dist.</div>
                                                        <div>Unit No 2, Riyadh 12834 - 3236</div>
                                                        <div>Kingdom of Saudi Arabia</div>
                                                        <div>Date of Birth: 08-08-1982, Age: 40</div> -->
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2" id="insurancedetails">
                                                        
                                                    </td>
                                                </tr>
                                                
                                               
                                                <tr>
                                                    <td colspan="2" id="documentdetails">
                                                    <!-- <div class="fs-6 fw-bold mb-1">ID Proof (Documents)</div>
                                                        <table class="table table-borderless table-striped mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-first" style="width:25%">Document Type</th>
                                                                    <th class="text-first" style="width:25%">Document Number</th>
                                                                    <th class="text-first" style="width:25%">Document Expiry Date</th>
                                                                    <th class="text-first" style="width:25%">Attachment</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-first">Passport</td>
                                                                    <td class="text-first">J4569879</td>
                                                                    <td class="text-first">12/12/2025</td>
                                                                    <td class="text-first">View</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-first">Passport</td>
                                                                    <td class="text-first">J4569879</td>
                                                                    <td class="text-first">12/12/2025</td>
                                                                    <td class="text-first">View</td>
                                                                </tr>
                                                                
                                                                
                                                                
                                                            </tbody>
                                                        </table> -->
                                                    </td>
                                                </tr>
                                                
                                                
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" onclick="printInvoice()"><i class="fa fa-print me-2"></i>Print</button>
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



        <div class="modal fade" id="CreateNew" tabindex="-1">
        <div class="modal-dialog modal-dialog-vertical modal-dialog-scrollable">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title">Setup new project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="progress bg-transparent" style="height: 3px;">
                    <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: 20%;"></div>
                </div>
                <div class="modal-body custom_scroll">
                    <ul class="nav nav-tabs tab-card border-0 fs-6" role="tablist">
                        <li class="nav-item flex-fill text-center"><a class="nav-link active" href="#step1" data-bs-toggle="tab" data-bs-step="1">1. Project</a></li>
                        <li class="nav-item flex-fill text-center"><a class="nav-link" href="#step2" data-bs-toggle="tab" data-bs-step="3">2. Team</a></li>
                        <li class="nav-item flex-fill text-center"><a class="nav-link" href="#step3" data-bs-toggle="tab" data-bs-step="4">3. File</a></li>
                        <li class="nav-item flex-fill text-center"><a class="nav-link" href="#step4" data-bs-toggle="tab" data-bs-step="5">4. Completed</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="step1">
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h6 class="card-title mb-1">Project Type</h6>
                                    <p class="text-muted small">If you need more info, please check out <a href="#">FAQ Page</a></p>
                                    <!-- Custome redio input -->
                                    <div class="c_radio d-flex flex-md-wrap">
                                        <label class="m-1 w-100" for="Personal">
                                            <input type="radio" name="plan" id="Personal" checked />
                                            <span class="card">
                                                <span class="card-body d-flex p-3">
                                                    <svg class="avatar" viewBox="0 0 16 16">
                                                        <path class="fill-muted" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                    </svg>
                                                    <span class="ms-3">
                                                        <span class="h6 d-flex mb-1">Personal Project</span>
                                                        <span class="text-muted">For smaller business, with simple salaries and pay schedules.</span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                        <label class="m-1 w-100" for="Team">
                                            <input type="radio" name="plan" id="Team"/>
                                            <span class="card">
                                                <span class="card-body d-flex p-3">
                                                    <svg class="avatar" viewBox="0 0 16 16">
                                                        <path class="fill-muted" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                                        <path class="fill-muted" fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                                                        <path class="fill-muted" d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                                    </svg>
                                                    <span class="ms-3">
                                                        <span class="h6 d-flex mb-1">Team Project</span>
                                                        <span class="text-muted">For growing business who wants to create a rewarding place to work.</span>
                                                    </span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h6 class="card-title mb-1">Project Details</h6>
                                    <p class="text-muted small">It is a long established fact that a reader will be distracted by Luno.</p>
                                    <div class="form-floating mb-2">
                                        <select class="form-select">
                                        <option selected>Open this select menu</option>
                                        <option value="1">Lucid</option>
                                        <option value="2">LUNO</option>
                                        <option value="3">Luno</option>
                                        </select>
                                        <label>Choose a Customer *</label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input type="text" class="form-control" placeholder="Project name">
                                        <label>Project name *</label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <textarea class="form-control" placeholder="Add project details" style="height: 100px"></textarea>
                                        <label>Add project details</label>
                                    </div>
                                    <div class="form-floating mb-2">
                                        <input type="date" class="form-control">
                                        <label>Enter release Date *</label>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="text-muted">Allow Notifications *</div>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="allow_phone" value="option1">
                                                <label class="form-check-label" for="allow_phone">Phone</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="allow_email" value="option2">
                                                <label class="form-check-label" for="allow_email">Email</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-lg bg-secondary text-light next text-uppercase">Add People</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="step2">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title mb-1">Build a Team</h6>
                                    <p class="text-muted small">If you need more info, please check out <a href="#">Project Guidelines</a></p>
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" placeholder="Invite Teammates">
                                        <label>Invite Teammates</label>
                                    </div>
                                    <h6 class="card-title mb-1">Team Members</h6>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="list-group6" checked="">
                                        <label class="form-check-label text-muted" for="list-group6">Adding Users by Team Members</label>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush list-group-custom custom_scroll mb-0" style="height: 300px;">
                                    <li class="list-group-item d-flex align-items-center">
                                        <img class="avatar rounded" src="assets/images/xs/avatar1.jpg" alt="">
                                        <div class="flex-fill ms-2">
                                            <div class="h6 mb-0">Chris Fox</div>
                                            <small class="text-muted">Angular Developer</small>
                                        </div>
                                        <select class="form-select rounded-pill form-select-sm w120">
                                            <option value="1">Owner</option>
                                            <option value="2">Can Edit</option>
                                            <option value="3">Guest</option>
                                        </select>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <img class="avatar rounded" src="assets/images/xs/avatar2.jpg" alt="">
                                        <div class="flex-fill ms-2">
                                            <div class="h6 mb-0">Joge Lucky</div>
                                            <small class="text-muted">ReactJs Developer</small>
                                        </div>
                                        <select class="form-select rounded-pill form-select-sm w120">
                                            <option value="1">Owner</option>
                                            <option value="2">Can Edit</option>
                                            <option value="3">Guest</option>
                                        </select>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <img class="avatar rounded" src="assets/images/xs/avatar3.jpg" alt="">
                                        <div class="flex-fill ms-2">
                                            <div class="h6 mb-0">Chris Fox</div>
                                            <small class="text-muted">NodeJs Developer</small>
                                        </div>
                                        <select class="form-select rounded-pill form-select-sm w120">
                                            <option value="1">Owner</option>
                                            <option value="2">Can Edit</option>
                                            <option value="3">Guest</option>
                                        </select>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <img class="avatar rounded" src="assets/images/xs/avatar4.jpg" alt="">
                                        <div class="flex-fill ms-2">
                                            <div class="h6 mb-0">Chris Fox</div>
                                            <small class="text-muted">Sr. Designer</small>
                                        </div>
                                        <select class="form-select rounded-pill form-select-sm w120">
                                            <option value="1">Owner</option>
                                            <option value="2">Can Edit</option>
                                            <option value="3">Guest</option>
                                        </select>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <img class="avatar rounded" src="assets/images/xs/avatar5.jpg" alt="">
                                        <div class="flex-fill ms-2">
                                            <div class="h6 mb-0">Chris Fox</div>
                                            <small class="text-muted">Designer</small>
                                        </div>
                                        <select class="form-select rounded-pill form-select-sm w120">
                                            <option value="1">Owner</option>
                                            <option value="2">Can Edit</option>
                                            <option value="3">Guest</option>
                                        </select>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <img class="avatar rounded" src="assets/images/xs/avatar6.jpg" alt="">
                                        <div class="flex-fill ms-2">
                                            <div class="h6 mb-0">Chris Fox</div>
                                            <small class="text-muted">Front-End Developer</small>
                                        </div>
                                        <select class="form-select rounded-pill form-select-sm w120">
                                            <option value="1">Owner</option>
                                            <option value="2">Can Edit</option>
                                            <option value="3">Guest</option>
                                        </select>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <img class="avatar rounded" src="assets/images/xs/avatar7.jpg" alt="">
                                        <div class="flex-fill ms-2">
                                            <div class="h6 mb-0">Chris Fox</div>
                                            <small class="text-muted">QA</small>
                                        </div>
                                        <select class="form-select rounded-pill form-select-sm w120">
                                            <option value="1">Owner</option>
                                            <option value="2">Can Edit</option>
                                            <option value="3">Guest</option>
                                        </select>
                                    </li>
                                    <li class="list-group-item d-flex align-items-center">
                                        <img class="avatar rounded" src="assets/images/xs/avatar8.jpg" alt="">
                                        <div class="flex-fill ms-2">
                                            <div class="h6 mb-0">Chris Fox</div>
                                            <small class="text-muted">Laravel Developer</small>
                                        </div>
                                        <select class="form-select rounded-pill form-select-sm w120">
                                            <option value="1">Owner</option>
                                            <option value="2">Can Edit</option>
                                            <option value="3">Guest</option>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-lg bg-secondary text-light next text-uppercase">Select Files</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="step3">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h6 class="card-title mb-1">Upload Files</h6>
                                    <div class="mb-4">
                                        <label class="form-label small">Upload up to 10 files</label>
                                        <input class="form-control" type="file" multiple>
                                    </div>
                                    <span>Already Uploaded File</span>
                                </div>
                                <ul class="list-group list-group-flush list-group-custom custom_scroll mb-0" style="height: 300px;">
                                    <li class="list-group-item py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar rounded no-thumbnail"><i class="fa fa-file-pdf-o text-danger"></i></div>
                                            <div class="flex-fill ms-3 text-truncate">
                                                <p class="mb-0 color-800">Annual Sales Report 2018-19</p>
                                                <small class="text-muted">.pdf, 5.3 MB</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar rounded no-thumbnail"><i class="fa fa-file-excel-o text-success"></i></div>
                                            <div class="flex-fill ms-3 text-truncate">
                                                <p class="mb-0 color-800">Complete Product Sheet</p>
                                                <small class="text-muted">.xls, 2.1 MB</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar rounded no-thumbnail"><i class="fa fa-file-word-o text-info"></i></div>
                                            <div class="flex-fill ms-3 text-truncate">
                                                <p class="mb-0 color-800">Marketing Guidelines</p>
                                                <small class="text-muted">.doc, 2.3 MB</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar rounded no-thumbnail"><i class="fa fa-file-zip-o"></i></div>
                                            <div class="flex-fill ms-3 text-truncate">
                                                <p class="mb-0 color-800">Brand Photography</p>
                                                <small class="text-muted">.zip, 30.5 MB</small>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-lg bg-secondary text-light next text-uppercase">Advanced Options</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="step4">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="card-title mb-1">Project Created!</h4>
                                    <span class="text-muted">If you need more info, please check how to create project</span>
                                </div>
                                <div class="card-body">
                                    <button class="btn btn-lg bg-light first text-uppercase">Cretae new project</button>
                                    <button class="btn btn-lg bg-secondary text-light text-uppercase">View project</button>
                                </div>
                                <div class="card-body">
                                    <img class="img-fluid" src="assets/images/project-team.svg" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{!! asset('assets/plugin/jquery/3.3.1/jquery.min.js') !!}"></script>

<script type="text/javascript">
function viewdetails(id){
    var customerdetailshtml="";
    var customeraddresshtml="";
    var emergencynumberhtml="";
    var insurancedetailshtml="";
    var documenthtml="";
    var documentslist="";

	/*alert(id); 
	$('#view').modal('show');
	return false;*/
	var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
	$.ajax({
        url:"{{'view-client'}}",
        type: 'POST',
        data: { 
            id:id,
            _token:token
        },
        success: function(response){
            $('#view').modal('show');
			
            $.each(response.customerdetails, function( index, customer ) {
                if(customer.emergencynumber == null || customer.emergencynumber == undefined){ emergencynumberhtml = ''; } else { emergencynumberhtml = '<div>Emergency Contact: '+customer.emergencynumber+'</div>'; }
                if(customer.add_line_one == null || customer.add_line_one == undefined){ add_line_one = ''; } else { add_line_one = '<div>'+customer.add_line_one+'</div>'; }
                if(customer.add_line_two == null || customer.add_line_two == undefined){ add_line_two = ''; } else { add_line_two = '<div>'+customer.add_line_two+'</div>'; }
                if(customer.customerplace == null || customer.customerplace == undefined){ customerplace = ''; } else { customerplace = customer.customerplace+', '; }
                if(customer.pincode == null || customer.pincode == undefined){ pincode = ''; } else { pincode = ' - '+customer.pincode; }
                if(customer.city == null || customer.city == undefined){ city = ''; } else { city = customer.city; }
                if(customer.dob == null || customer.dob == undefined){ dob = ''; } else { dob = 'Date of Birth: '+customer.dob+', '; }
                if(customer.age == null || customer.age == undefined){ age = ''; } else { age = 'Age: '+customer.age; }
                customerdetailshtml = '<div class="fs-6 fw-bold mb-1">'+customer.customername+'</div><div>Contact Number: '+customer.customerphone+'</div>'+emergencynumberhtml+'<div>Email: '+customer.customeremail+'</div><div>Blood Group: '+customer.bloodgroup+'</div><div>Gender: '+customer.gender+'</div>';
                customeraddresshtml = '<div class="fs-6 fw-bold mb-1">&nbsp;</div>'+add_line_one+''+add_line_two+'<div>'+customerplace+' '+city+'</div><div>'+customer.countryname+''+pincode+'</div><div>'+dob+''+age+'</div>';   
                if(customer.insuranceno == null || customer.insuranceno == undefined){
                    insurancedetailshtml = ''; 
                } else {
                insurancedetailshtml = '<div class="fs-6 fw-bold mb-1">Insurance Details</div><table class="table table-borderless table-striped mb-0"><thead><tr><th class="text-first" style="width:25%">Insurance Number</th><th class="text-first" style="width:25%">Insurance Provider</th><th class="text-first" style="width:25%">Card Number</th><th class="text-first" style="width:25%">Expiry Date</th></tr></thead><tbody><tr><td class="text-first">'+customer.insuranceno+'</td><td class="text-first">'+customer.insuranceprovider+'</td><td class="text-first">'+customer.insurancecardno+'</td><td class="text-first">'+customer.insuranceexpirydate+'</td></tr></tbody></table>';
                }

            }); 

            $.each(response.customerdocuments, function( index, docu ) {
                //documentslist += '<tr><td class="text-first">'+docu.proofname+'</td></tr>';
                documentslist += '<tr><td class="text-first">'+docu.documenttype+'</td><td class="text-first">'+docu.documentnumber+'</td><td class="text-first">'+docu.documentexpirydate+'</td><td class="text-center"><div class="btn btn-link btn-sm text-success tooltips">Preview</i><span class="tooltiptext"><img src="{{ url("uploads") }}/'+docu.documentfilename+'" width="120" height="auto"></span></div></td></tr>'; 
            });
            //documenthtml = '<div class="fs-6 fw-bold mb-1">ID Proof (Documents)</div><table class="table table-borderless table-striped mb-0"><thead><tr><th class="text-first" style="width:25%">Document Type</th><th class="text-first" style="width:25%">Document Number</th><th class="text-first" style="width:25%">Document Expiry Date</th><th class="text-first" style="width:25%">Attachment</th></tr></thead><tbody>'+documentslist+'</tbody></table>';
            //alert(doccount);
            var doccount = response.documentcounts;
            if(doccount == 0) {
                documenthtml ="";
            }   else {
                documenthtml ='<div class="fs-6 fw-bold mb-1">ID Proof (Documents)</div><table class="table table-borderless table-striped mb-0"><thead><tr><th class="text-first" style="width:25%">Document Type</th><th class="text-first" style="width:25%">Document Number</th><th class="text-first" style="width:25%">Document Expiry Date</th><th class="text-center" style="width:25%">Attachment</th></tr></thead><tbody>'+documentslist+'</tbody></table>';
                //documenthtml = '<div class="fs-6 fw-bold mb-1">ID Proof (Documents)</div><table class="table table-borderless table-striped mb-0"><thead><tr><th class="text-first" style="width:25%">Document Type</th><th class="text-first" style="width:25%">Document Number</th><th class="text-first" style="width:25%">Document Expiry Date</th><th class="text-first" style="width:25%">Attachment</th></tr></thead><tbody>'+documentslist+'</tbody></table>';
            }
                
            
            //alert(response.documentcounts);
            $('#documentdetails').html(documenthtml);
            $('#customerdetails').html(customerdetailshtml);
            $('#customeraddress').html(customeraddresshtml);
            $('#insurancedetails').html(insurancedetailshtml);
            
            
            
		}

        
    });
	
}
</script>
    <script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
    
<script type="text/javascript">
    function printInvoice() {
        // printJS('printable', 'html')

        let printFrame = document.createElement("iframe");
        let printableElement = document.getElementById("printable");
        //
        // // printframe.setattribute("style", "visibility: hidden; height: 0; width: 0; position: absolute;")
        printFrame.setAttribute("id", "printjs");
        printFrame.srcdoc = "<html><head><title>document</title></head><body style='margin: 5px;'>" + printableElement.outerHTML + "<style>@page { size: A4; }";

        document.body.appendChild(printFrame);

        let iframeElement = document.getElementById("printjs");
        iframeElement.focus();
        iframeElement.contentWindow.print();
        //
        // printframe.contentwindow.print()
        //
        // my_window = window.open('', 'mywindow', 'status=1,width=350,height=150');
        // my_window.document.write('<html><head><title>Print Me</title></head>');
        // my_window.document.write('<body onafterprint="self.close()">');
        // my_window.document.write(printablEelement.innerHTML);
        // my_window.document.write('</body></html>');
        // my_window.print();
    }
</script>
<script src="{!! asset('assets/js/bundle/dataTables.bundle.js') !!}"></script>
        <script>
    // project data table
    $('.test').addClass('nowrap').dataTable({
      

      responsive: true,
     
    });
    
    
  </script>
@endsection
