@extends('layout.maintemplate')
@section('content')
<style>
    .sidemenu{
        border: 1px dashed var(--border-color);
        list-style: none;
        border-radius: .75rem;
        padding: 0 1rem;
        font-size: 1rem;
        background:#fff;
    }

    .sidemenu .m-link {
        color: var(--color-600);
        align-items: center;
        padding: 10px 0;
    }

    .sidemenu .m-link, .sidemenu .ms-link {
        display: flex;
    }


    .sidemenu .sub-menu {
        transition: ease 0.2s;
        list-style: none;
        position: relative;
        padding-left: 34px;
        margin-bottom: 10px;
    }

    .sidemenu .sub-menu::before {
        background-color: var(--secondary-color);
        content: "";
        position: absolute;
        height: 100%;
        width: 1px;
        left: 10px;
        top: 0;
    }

    .sidemenu .ms-link:hover, .sidemenu .ms-link.active {
        color: var(--secondary-color);
    }

    .sidemenu .ms-link {
        color: var(--color-600);
        position: relative;
        padding: 4px 0!important;
        font-size: 15px;
    }



    .sidemenu .m-link:hover::before, .sidemenu .m-link.active::before, .sidemenu .ms-link:hover::before, .sidemenu .ms-link.active::before {
        display: block;
    }


    .sidemenu .ms-link::before{
        background-color: var(--secondary-color);
        content: "";
        display: none;
        position: absolute;
        height: 9px;
        width: 9px;
        left: -28px;
        top: 10px;
        border-radius: 10px;
    }

    .sidemenu > li {
        border-bottom: 1px dashed var(--border-color);
    }

    .sidemenu li a span .ms-auto {
        margin-left: !important;
    }
    .red {
        color:#f00;
    }
    </style>
    
     <!-- <link rel="stylesheet" href="{!! asset('assets/css/selectize.bootstrap3.min.css') !!}"> -->

    <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">

                <div class="row g-4">

                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Add Purchase</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-sm-4">
                                        <label class="form-label">Invoice No</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here">
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="form-label">Date <span class="red">*</span></label>
                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here">
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="form-label">Warehouse <span class="red">*</span></label>
                                        <select class="form-select form-select-lg" tabindex="-98">
                                            <option value="">- Select -</option>
                                            <option value="10">Warehouse name 1</option>
                                            <option value="20">Warehouse name 2</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="form-label">Status <span class="red">*</span></label>
                                        <select class="form-select form-select-lg" tabindex="-98">
                                            <option value="">- Select -</option>
                                            <option value="received">Received</option>
                                            <option value="pending">Pending</option>
                                            <option value="ordered">Ordered</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <label class="form-label">Attach Document</label>
                                        <input type="file" class="form-control form-control-lg">
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <label class="form-label">Supplier (Please select these before adding any product)</label>
                                                <select id="select-state" placeholder="Pick a supplier...">
                                                <option value="">Pick a supplier...</option>
                                                <option value="10">Warehouse name 1</option>
                                                <option value="20">Warehouse name 2</option>
                                                <option value="20">Warehouse name 3</option>    
                                                </select>
                                            </div>
                                            <div class="col-sm-1"><a style="cursor:pointer;" class="btn btn-primary mt-5" ><i class="fa fa-eye"></i></a> <a style="cursor:pointer;" class="btn btn-primary mt-5" ><i class="fa fa-plus"></i></a></div>
                                            

                                            <div class="col-sm-5">
                                                <label class="form-label">Add products to order list</label>
                                                <input type="text" class="form-control form-control-lg" placeholder="Search products here">
                                            </div>
                                            <div class="col-sm-1"><a style="cursor:pointer;" class="btn btn-primary mt-5" ><i class="fa fa-plus"></i></a></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                            <label class="form-label"><strong>Order Items</strong></label>
                                    </div>


                                    <table id="tableselectedtest" class="table card-table table-hover align-middle mb-1 mt-0">
                                        <thead>
                                            <tr>
                                                  
                                                <th width="70%">Product Name</th>
                                                <th width="5%">Net Unit Cost</th>
                                                <th class="text-center" width="5%">Quantity</th>
                                                <th width="5%">Discount</th>
                                                <th width="5%">Product Tax</th>
                                                <th width="5%">Subtotal (SAR) </th>
                                                <th class="text-center" width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tr>                                            
                                            <td>Discardit II Syringe</td>
                                            <td class="text-end">62.00</td>
                                            <td class="text-center"><input type="text" class="form-control form-control-sm text-center" value="1" style="width:50px;"></td>
                                            <td class="text-end">0.00</td>
                                            <td class="text-end">46.25</td>
                                            <td class="text-end">100.00</td>
                                            <td class="text-center"><span class="btn btn-link btn-sm text-danger delete" ><i class="fa fa-trash"></i></span></td>
                                        </tr>

                                        <tr>                                            
                                            <td>Discardit II Syringe</td>
                                            <td class="text-end">62.00</td>
                                            <td class="text-center"><input type="text" class="form-control form-control-sm text-center" value="1" style="width:50px;"></td>
                                            <td class="text-end">0.00</td>
                                            <td class="text-end">46.25</td>
                                            <td class="text-end">100.00</td>
                                            <td class="text-center"><span class="btn btn-link btn-sm text-danger delete" ><i class="fa fa-trash"></i></span></td>
                                        </tr>

                                        <tr>                                            
                                            <td>Discardit II Syringe</td>
                                            <td class="text-end">62.00</td>
                                            <td class="text-center"><input type="text" class="form-control form-control-sm text-center" value="1" style="width:50px;"></td>
                                            <td class="text-end">0.00</td>
                                            <td class="text-end">46.25</td>
                                            <td class="text-end">100.00</td>
                                            <td class="text-center"><span class="btn btn-link btn-sm text-danger delete" ><i class="fa fa-trash"></i></span></td>
                                        </tr>
                                        
                                        <tr>
                                            
                                            <td class="text-end"><strong>Total</strong></td>
                                            <td class="text-end"><strong>SR 1500</strong></td>
                                            <td class="text-center"><strong>1</strong></td>   
                                            <td class="text-end"><strong>SR 1500</strong></td>                                            
                                            <td class="text-end"><strong>SR 150</strong></td>
                                            <td class="text-end"><strong>SR 1650</strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>


                                    <div class="col-sm-3">
                                        <label class="form-label">Order VAT</label>
                                        <select class="form-select form-select-lg" tabindex="-98">
                                            <option value="">- Select -</option>
                                            <option value="10">50%</option>
                                            <option value="20">Flat 20</option>
                                        </select>
                                    </div>

                                    
                                    <div class="col-sm-3">
                                        <label class="form-label">Discount (5/5%)</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here">
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="form-label">Payment Term</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here">
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="form-label">Paying by <span class="red">*</span></label>
                                        <select class="form-select form-select-lg" tabindex="-98">
                                            <option value="">- Select -</option>
                                            <option value="10">Cash</option>
                                            <option value="20">Card</option>
                                        </select>
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="form-label">Note</label>
                                        <textarea class="form-control form-control-lg" style="resize:none;" rows="8"></textarea>
                                    </div>

                                    
                                    
                                    
                                    
                                </div>
                                
                                




                                
                                
                                
                                
                                
                            </div>
                            
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="submit" class="btn btn-default">Cancel</button>
                            </div>
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
    <link rel="stylesheet" href="{!! asset('assets/css/select2.min.css') !!}">
    <script src="{!! asset('assets/js/standalone/select2.min.js') !!}"></script>

   
    
<script>
    var jq = jQuery.noConflict();
jq(document).ready(function () {
    jq("#select-state").select2();
  });
function formValidation() 
{
    

    document.getElementById('taxnamealert').style.display = 'none';
    document.getElementById('taxratealert').style.display = 'none';
    document.getElementById('taxtypealert').style.display = 'none';
    
    
    
    if(document.addtax.taxname.value == ''){
        document.getElementById('taxnamealert').style.display = 'block'; 
        document.addtax.taxname.focus();  
        return false;     
    }else if(document.addtax.taxrate.value == ''){
        document.getElementById('taxratealert').style.display = 'block'; 
        document.addtax.taxrate.focus();  
        return false;     
    }else if(document.addtax.taxtype.value == ''){
        document.getElementById('taxtypealert').style.display = 'block'; 
        document.addtax.taxtype.focus();  
        return false;     
    }
document.addtax.submit();
return true;
}

</script>






<script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
  
@endsection
