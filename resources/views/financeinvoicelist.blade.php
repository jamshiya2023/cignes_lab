@extends('layout.maintemplate')
@section('content')

<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">

                <div class="row g-2 row-deck">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title m-0">Invoice List</h6>
                                
                            </div>
                            @if(\Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    {{ \Session::get('success') }}
                                </div>
                                @endif
                            <div class="card-body">
                                <table id="invoice-list" class="table card-table table-hover align-middle mb-0" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width:10%">Invoice No</th>
                                            <th style="width:10%">Invoice Date</th>
                                            <th style="width:30%">Name</th>
                                            <th style="width:10%">Total</th>
                                            <th style="width:10%">VAT</th>
                                            <th style="width:10%">Paid</th>
                                            <th style="width:10%">Balance</th>
                                            <th style="width:10%" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($invoicelist as $key => $invoice)
                                    @php
                                    if($invoice->balanceamt == '0.00') { $balanceamout = '00.00'; } else { $balanceamout = $invoice->balanceamt;}
                                    @endphp
                                        <tr>
                                            <td>INV-{{$invoice->invoice_number}}</td>
                                            <td>{{$invoice->date}}</td>
                                            <td>{{$invoice->name}}</td>
                                            <td>SR {{$invoice->totalamt}}</td>
                                            <td>SR {{$invoice->totaltax}}</td>
                                            <td>SR {{$invoice->paidamt}}</td>
                                            <td>SR {{$balanceamout}}</td>
                                            
                                            <td style="text-align:center;">
                                            @php
                                            if($invoice->paymentstatus != 'paid'){
                                            @endphp    
                                             <button type="button" class="btn btn-sm bg-success text-white"  title="Pay Now" onclick="paynow('{{$invoice->id}}');">Pay Now</button>
                                            @php
                                            }
                                            @endphp
                                             <button type="button" class="btn btn-sm bg-dark text-white"  title="View Invoice" onclick="viewinvoice('{{$invoice->id}}');">View</button>
                                            
                                        </td>
                                        </tr>
                                    @endforeach    
                                        
                                        
                                        
                                        
                                        
                                        
                                    </tbody>
                                    </table>
                            </div>

                            <!-- Modal -->
<!-- VIEW INVOICE MODAL STARTS HERE -->
                        
                        <div id="printThis">
                        <div class="modal fade" id="invoice_detail" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modaltitle"> </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body custom_scroll">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td id="invoicedate"> </th>
                                                    <td class="text-end" id="status"> </td>
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
                                                                    <th class="text-center" style="width:35%">Test</th>
                                                                    <th class="text-end" style="width:15%">Unit Price</th>
                                                                    <th class="text-end" style="width:15%">Discount</th>
                                                                    <th class="text-end" style="width:15%">Tax</th>
                                                                    <th class="text-end" style="width:15%">Sub Total</th>
                                                                    <!--<th class="text-end" colspan="2">Rate</th>-->
                                                                </tr>
                                                            </thead>
                                                            <tbody id="modelbody">
                                                                
                                                            </tbody>
                                                            <tfoot id="modelfoot">
                                                            <tr>
                                                                <td colspan="3">
                                                                    <h6>Terms &amp; Condition</h6>
                                                                    <p class="text-muted">You know, being a test pilot isnt always the healthiest business in the world. We predict too much for the next year and yet far too little for the next 10.</p>
                                                                </td>
                                                                <td colspan="3">
                                                                    <table class="table table-borderless mb-0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td ><strong>Sub Total</strong></td>
                                                                                <td class="text-end" id='totalunitprice'></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td ><strong>VAT</strong></td>
                                                                                <td class="text-end" id="totaltax"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td ><strong>Discount</strong></td>
                                                                                <td class="text-end" id="totaldiscount"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td ><strong>Total</strong></td>
                                                                                <td class="text-end" id="finaltotal"></td>
                                                                            </tr>
                                                                            <tr id="paidamount">
                                                                                
                                                                            </tr>
                                                                            <tr id="balanceamount">
                                                                                
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            </tfoot>
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
                        </div> 
                        
                        <!-- PRINT DIV ENDS HERE -->
<!-- VIEW INVOICE MODAL ENDS HERE -->  




<!-- PAYMENT MODAL STARTS HERE -->
<form class="row g-3" id="paymentupdateform" name="paymentupdateform" method="post"  action="{{ route('financepayment.update') }}" >                            
@csrf

<div class="modal fade" id="payment" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Payment of Invoice# INV-<span id="invoicenumber"></span></h5>
                                            <button type="button" class="btn-close" id="payment-update-close-x" ></button>
                                        </div>
                                        <div class="modal-body">


                                        <div class="row g-4">
                                            <div class="col-sm-4">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                Total Amount 
                                                </label>
                                            </div>
                                            <div class="col-sm-8" id="totalamt"> 
                                                <strong> 500.00</strong>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-check-label text-success" for="flexCheckDefault">
                                                Paid Amount 
                                                </label>
                                            </div>
                                            <div class="col-sm-8 text-success" id="paidamt"> 
                                                
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-check-label text-danger" for="flexCheckDefault">
                                                Balance Amount 
                                                </label>
                                            </div>
                                            <div class="col-sm-8 text-danger" id="balanceamt"> 
                                                
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                Payment Method
                                                </label>
                                            </div>  
                                            <div class="col-sm-8"> 
                                            <select class="form-select form-select-lg" name="paymentmethod" id="paymentmethod">
                                            </select>
                                            <div class="alert-danger pt-1 pb-1 px-1 py-1" id="paymentmethodalert" style="display:none ;">Please select payment method</div>    
                                            </div>

                                            <div class="col-sm-4">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                Amount Paid
                                                </label>
                                            </div>  
                                            <div class="col-sm-8"> 
                                                <input type="text" class="form-control form-control-lg" name="paidamount" id="txtpaidamount"> 
                                                <div class="alert-danger pt-1 pb-1 px-1 py-1" id="paidamountalert" style="display:none ;">Please enter amount</div>  
                                            </div>

                                            <div class="col-sm-12"> 
                                            <input type="hidden" id="hiddenbalanceamt" name="hiddenbalanceamt" value="">
                                            <input type="hidden" id="hiddenid" name="hiddenid" value=""> 
                                            <input type="hidden" id="hiddeninvoiceid" name="hiddeninvoiceid" value="">    
                                            <a style="cursor:pointer;" class="btn btn-primary" onclick="paymentupdatevalidation();">Save</a>
                                            <button type="button" class="btn btn-default" id="payment-update-close"  >Cancel</button>  
                                            </div>                                             
                                            
                                                
                                        </div>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

</form>

<!-- PAYMENT MODAL ENDS HERE -->
                            
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
  
/* PRINT STARTS HERE */

/* PRINT ENDS HERE */
function paymentupdatevalidation(){
    document.getElementById('paymentmethodalert').style.display = 'none';
    document.getElementById('paidamountalert').style.display = 'none';
    if(document.paymentupdateform.paymentmethod.value =='')
    {
        document.getElementById('paymentmethodalert').style.display = 'block';
        return false;
    }
    if(document.paymentupdateform.paidamount.value =='')
    {
        document.getElementById('paidamountalert').style.display = 'block';
        return false;
    }
    

    if (parseFloat(document.paymentupdateform.paidamount.value) > parseFloat(+document.paymentupdateform.hiddenbalanceamt.value))
    {
        document.getElementById('paidamountalert').style.display = 'block';
        document.getElementById('paidamountalert').innerHTML = 'Paid amount is greater than balance amount.';
        document.newregistration.paidamount.select();
        return false;
    }
    
    document.paymentupdateform.submit();
    return true;
}

function paynow(id){
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    $.ajax({
        url:"{{'view-payment-finance'}}",
        type: 'POST',
        data: { 
            id:id,
            _token:token
        },
        success: function(response){
            var invnumber;
            var totalamt;
            var paidamt;
            var balanceamt;
            var roundtotalamt;
            var roundpaidamt;
            var roundbalanceamt;
            var hiddenid;
            //var paymethodhtml="";
            var paymethodhtml = "";
            $('#payment').modal('show');
           
            $.each(response.paymentdetails, function( index, paydetails ) {
                hiddenid = paydetails.invid; 
                invnumber = paydetails.invoice_number;
                totalamt = Number(paydetails.totalamt);
                paidamt = Number(paydetails.paidamt);
                balanceamt = Number(paydetails.balanceamt);
            });
            roundtotalamt = totalamt.toFixed(2);
            roundpaidamt = paidamt.toFixed(2);
            roundbalanceamt = balanceamt.toFixed(2);
            $('#hiddenid').val(hiddenid);
            $('#hiddeninvoiceid').val(invnumber);            
            $('#hiddenbalanceamt').val(roundbalanceamt);
            $('#invoicenumber').html(invnumber);
            $('#totalamt').html('<strong>SR '+roundtotalamt+'</strong>');
            $('#paidamt').html('<strong>SR '+roundpaidamt+'</strong>');
            $('#balanceamt').html('<strong>SR '+roundbalanceamt+'</strong>');
            paymethodhtml = '<option value="">- Please Select -</option>';
            $.each(response.paymentmethods, function( index, paymethod) { 
                
                paymethodhtml += '<option value="'+paymethod.id+'">'+paymethod.paymentmethod+'</option>';            
               
            });
            $('#paymentmethod').html(paymethodhtml);            
            
            
        }
    });



    

}

function viewinvoice(id){
   // var token = $('input[name="_token"]').val();
    var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    $.ajax({
        url:"{{'view-invoice'}}",
        type: 'POST',
        data: { 
            id:id,
            _token:token
        },
        success: function(response){
            var paymentstatus;
            var statushtml;
            var invoicenumber;
            var registerdate;
            var customerdetailshtml=''; 
            var invoicehtml='';
            var num;
            var tax;
            var unitprice;
            var subtotal;
            var discount;
            var unitpricetotal = 0;
            var taxtotal = 0;
            var discounttotal = 0;
            var finaltotal = 0;
            var paidamt;
            var balanceamt; 

            var addonehtml;
            var addtwohtml;
            var placehtml;
            var cityhtml;
            var pincodehtml;
            
            $('#invoice_detail').modal('show');
           
            $.each(response.invoicedetails, function( index, indetails ) { 
                num = index+1;
                unitprice = Number(indetails.unitprice);
                unitpricetotal += unitprice;
                tax = Number(indetails.tax);
                taxtotal += tax;
                discount = Number(indetails.discount);
                discounttotal += discount;
                subtotal = Number(indetails.subtotal);
                finaltotal += subtotal;                
                invoicehtml +='<tr><td class="text-center">'+num+'</td><td class="text-center">'+indetails.testname+'</td><td class="text-end">SR '+indetails.unitprice+'</td><td class="text-end">SR '+indetails.discount+'</td><td class="text-end">SR '+indetails.tax+'</td><td class="text-end">SR '+indetails.subtotal+'</td></tr>';             
            });
            var roundunitpricetotal = unitpricetotal.toFixed(2);
            var roundtaxtotal = taxtotal.toFixed(2);
            var roundfinaltotal = finaltotal.toFixed(2);
            var rounddiscounttotal = discounttotal.toFixed(2);
            document.getElementById('modelbody').innerHTML = invoicehtml;
            

            $.each(response.customerdetails, function( index, customer ) { 
                paymentstatus = customer.paymentstatus;
                invoicenumber = customer.invoice_number;   
                paidamt = customer.paidamt;
                balanceamt = customer.balanceamt;  
                registerdate = '<strong>'+customer.date+'</strong>';
                if(customer.addone == null || customer.addone == undefined){ addonehtml = ''; } else { addonehtml = customer.addone; }
                if(customer.addtwo == null || customer.addtwo == undefined){ addtwohtml = ''; } else { addtwohtml = customer.addtwo+','; }
                if(customer.place == null || customer.place == undefined){ placehtml = ''; } else { placehtml = customer.place; }
                if(customer.city == null || customer.city == undefined){ cityhtml = ''; } else { cityhtml = customer.city+','; }
                if(customer.pincode == null || customer.pincode == undefined){ pincodehtml = ''; } else { pincodehtml = '- '+customer.pincode; }
                customerdetailshtml = '<div>To:</div><div class="fs-6 fw-bold mb-1">'+customer.name+'</div><div>'+addonehtml+'</div><div>'+addtwohtml+' '+placehtml+'</div><div>'+cityhtml+' '+customer.country+' '+pincodehtml+'</div><div>Email: '+customer.email+'</div><div>Phone: '+customer.phone+'</div>';            
               
            });
            if(paymentstatus == 'paid'){
                statushtml = '<span class="text-success"> <strong>Status:</strong> Paid</span>';
                $('#paidamount').html('');
                $('#balanceamount').html(''); 
            } else if(paymentstatus == 'partial'){
                statushtml = '<span class="text-info"> <strong>Status:</strong> Partially Paid</span>';   
                $('#paidamount').html('<td ><strong>Paid</strong></td><td class="text-end"><strong>SR '+paidamt+'</strong></td>');
                $('#balanceamount').html('<td ><strong>Balance</strong></td><td class="text-end"><strong>SR '+balanceamt+'</strong></td>'); 
            } else {
                statushtml = '<span class="text-danger"> <strong>Status:</strong> Not Paid</span>'; 
                $('#paidamount').html('<td class="text-success"><strong>Paid</strong></td><td class="text-end text-success  "><strong>SR '+paidamt+'</strong></td>');
                $('#balanceamount').html('<td class="text-danger"><strong>Balance</strong></td><td class="text-end text-danger"><strong>SR '+balanceamt+'</strong></td>'); 
            }
            //$('#modelfoot').html('<tr><td colspan="3"><h6>Terms &amp; Condition</h6><p class="text-muted">You know, being a test pilot isnt always the healthiest business in the world. We predict too much for the next year and yet far too little for the next 10.</p></td><td colspan="3"><table class="table table-borderless mb-0"><tbody><tr><td ><strong>Total Unit Price</strong></td><td class="text-end">SR '+unittotal+'</td></tr><tr><td ><strong>Tax </strong></td><td class="text-end">SR 22.50</td></tr><tr><td ><strong>Total</strong></td><td class="text-end"><strong>SR 422.50</strong></td></tr></tbody></table></td></tr>');
            
            $('#totalunitprice').html('<strong>SR '+roundunitpricetotal+'</strong>');
            $('#totaltax').html('<strong>SR '+roundtaxtotal+'</strong>');
            $('#totaldiscount').html('<strong>SR '+rounddiscounttotal+'</strong>');
            $('#finaltotal').html('<strong>SR '+roundfinaltotal+'</strong>');             
            $('#modaltitle').html('Invoice# INV-'+invoicenumber);
            $('#invoicedate').html('Date <strong>'+registerdate+'</strong>');
            $('#status').html(statushtml);
            $('#customeraddress').html(customerdetailshtml);


            
        }
    });

}


$('#payment-update-close-x, #payment-update-close').click(function() {
        $('#txtpaidamount').val('');
        //$('#regfrom').prop('selectedIndex',0);
        $('#paidamountalert').hide();
        $('#paymentmethodalert').hide();
        
        //$('#statenamealert').hide();
        $('#payment').modal('hide');
    });

</script>

<script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>


@endsection
