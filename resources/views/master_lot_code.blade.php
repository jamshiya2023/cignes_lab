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
    
    

		<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">
                <div class="row">
                	<div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">
                   		<!-- COL 3 STARTS HERE -->
                        	<div class="row">
                                @include('layout.sidemenu')
                                
                            </div>
                        
                        
                        <!-- COL 3 ENDS HERE -->                    
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                    <!--COL 8 STARTS HERE -->
							<div class="row g-2 row-deck">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="card-title m-0">Lot Code</h6><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-sample-type">Add Lot Code</a>
                                            
                                        </div>
                                        @if(\Session::get('success'))
                                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                            {{ \Session::get('success') }}
                                        </div>
                                        @endif
                                        <div class="card-body">
                                        
                                            <table id="lot-code" class="table card-table table-hover align-middle mb-0" style="width: 100%;">
                                            
                                                <thead>
                                                    <tr>
                                                        <th style="width:3%">#</th>
                                                        <th style="width:22%">Control Name</th>
                                                        <th style="width:22%">Lot Code</th>
                                                        <th style="width:22%">Const. Mean</th>
                                                        <th style="width:22%">Const. SD</th>                                                       
                                                        <th style="width:9%" class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                             
                                                <tbody >
                                                @foreach($lotcode as $key => $value)
                                                    <tr >
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{ $value->controlname }}</td>
                                                        <td>{{ $value->lotcode}}</td>
                                                        <td>{{ $value->const_mean}}</td>
                                                        <td>{{ $value->const_sd}}</td>                                                       
                                                        </td>
                                                        <td class="text-center">
                                                            <a  onclick="editview('{{ $value->id }}');"class="btn btn-link btn-sm text-secondry" data-bs-toggle="modal" data-bs-target="#edit-sample-type{{ $value->id }}">
                                                                <i class="fa fa-edit" style="color:#555CB8;"></i>
                                                            </a>

                                                            <?php if($value->status =='1') { ?> 
                                                            <a href="{{ 'block-lot-code/'.$value->id }}"  onclick="return confirm('Do you want to block this lot code?')" class="btn btn-link btn-sm text-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Active" aria-label="Active">
                                                                <i class="fa fa-ban" style="color:#198754;"></i>                                                                
                                                            </a>
                                                            <?php } else { ?>
                                                                <a href="{{ 'unblock-lot-code/'.$value->id }}" onclick="return confirm('Do you want to unblock this lot code?')" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Blocked" aria-label="Blocked">
                                                                <i class="fa fa-circle" style="color:#d63384;"></i>
                                                            </a>
                                                            <?php } ?>  

                                                            <!-- <a href="" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" aria-label="Delete">
                                                                <i class="fa fa-trash"></i>
                                                            </a> -->
                                                        </td>
                                                    </tr>
                                                    
                    

                    @endforeach

                                                    
                                                </tbody>
                                            </table>
                                            
                                        </div>
            
                                        <!-- Modal -->
                                        
                                        
                                    </div>
                                </div>
                        </div> 
                        
                        
                            <!-- ADD MODAL STARTS HERE -->
                            <form class="row g-3" id="addlotcode" name="addlotcode" method="post" action="{{ route('lotcode.add') }}">                            
                                @csrf
                                <div class="modal fade" id="add-sample-type" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Lot Code</h5>
                                                <button type="button" id="add-modal-close-x" class="btn-close"></button>
                                            </div>
                                            <div class="modal-body custom_scroll">
                                                <div class="row g-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Control Name <span class="red">*</span></label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="controlname" id="controlname" >
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="controlnamealert" style="display:none ;">Please enter control name </div>                                                
                                                    </div>                                    
                                                <!-- </div>  

                                                <div class="row g-4"> -->
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Lot Code <span class="red">*</span></label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="lotcode" id="lotcode" >
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="lotcodealert" style="display:none ;">Please enter lot code </div>                                                
                                                    </div>                                    
                                                </div>
                                                
                                                <div class="row g-4">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Const. Mean</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="constmean" id="constmean" >
                                                        <!-- <div class="alert-danger pt-1 pb-1 px-1 py-1" id="lotcodealert" style="display:none ;">Please enter lot code </div> -->
                                                    </div>                                    
                                                <!-- </div>

                                                <div class="row g-4"> -->
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Const. SD</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="constsd" id="constsd" >
                                                        <!-- <div class="alert-danger pt-1 pb-1 px-1 py-1" id="controlnamealert" style="display:none ;">Please enter control name </div> -->
                                                    </div>                                    
                                                </div>

                                                


                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-primary" onclick="addlotcodeValidation();">Save</a>
                                                <button type="button" id="add-modal-close"class="btn btn-secondary">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- ADD MODAL ENDS HERE -->


                            <!-- EDIT POPUP STARTS HERE -->
                            <form class="row g-3" name="editlotcode" method="post" action="{{ route('lotcode.edit') }}">                            
                                @csrf
                                <div class="modal fade" id="edit-sample-type" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Lot Code</h5>
                                                <button type="button" id="edit-modal-close-x" class="btn-close"></button>
                                            </div>
                                            <div class="modal-body custom_scroll">
                                                <div class="row g-4">
                                                    <div class="col-sm-12">
                                                        <label class="form-label">Control Name <span class="red">*</span></label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="controlnameedit" id="controlnameedit" >
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="controlnameeditalert" style="display:none ;">Please enter control name </div>                                                
                                                    </div>                                    
                                                </div>  

                                                <div class="row g-4">
                                                    <div class="col-sm-12">
                                                        <label class="form-label">Lot Code <span class="red">*</span></label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="lotcodeedit" id="lotcodeedit" >
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="lotcodeeditalert" style="display:none ;">Please enter lot code </div>                                                
                                                    </div>                                    
                                                </div>
                                                
                                                <div class="row g-4">
                                                    <div class="col-sm-12">
                                                        <label class="form-label">Const. Mean</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="constmeanedit" id="constmeanedit" >
                                                        <!-- <div class="alert-danger pt-1 pb-1 px-1 py-1" id="lotcodealert" style="display:none ;">Please enter lot code </div> -->
                                                    </div>                                    
                                                </div>

                                                <div class="row g-4">
                                                    <div class="col-sm-12">
                                                        <label class="form-label">Const. SD</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="constsdedit" id="constsdedit" >
                                                        <!-- <div class="alert-danger pt-1 pb-1 px-1 py-1" id="controlnamealert" style="display:none ;">Please enter control name </div> -->
                                                    </div>                                    
                                                </div>

                                                


                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" class="form-control form-control-lg" name="hiddenid" id="hiddenid"  >
                                                <a class="btn btn-primary" onclick="editlotcodeValidation();">Save</a>
                                                <button type="button" id="edit-modal-close"class="btn btn-secondary">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    <!-- EDIT POPUP ENDS HERE -->
                    <!-- COL 8 ENDS HERE --> 
                    </div>
                    
                    
                    
                </div>
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
    $(document).ready(function () {
        $('#edit-sample-type,#add-sample-type').modal({
            backdrop: 'static',
            keyboard: false
        })
   });
    $('#add-modal-close-x, #add-modal-close').click(function() {
        $('#controlname').val('');
        $('#controlnamealert').hide();
        $('#lotcode').val('');
        $('#lotcodealert').hide();
        $('#constmean').val('');
        $('#constmean').val('');
        $('#add-sample-type').modal('hide');
    });

    $('#edit-modal-close-x, #edit-modal-close').click(function() {
        $('#controlnameeditalert').hide();
        $('#lotcodeeditalert').hide();
        $('#edit-sample-type').modal('hide');
    });

   
    function addlotcodeValidation() {
        document.getElementById('controlnamealert').style.display = 'none';
        if(document.addlotcode.controlname.value == ''){
            document.getElementById('controlnamealert').style.display = 'block';  
            document.addlotcode.controlname.focus(); 
            return false;     
        }
        if(document.addlotcode.lotcode.value == ''){
            document.getElementById('lotcodealert').style.display = 'block';  
            document.addlotcode.lotcode.focus(); 
            return false;     
        }
    document.addlotcode.submit();
    return true;
    }
    
    function editview(id){
        var token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ 'view-lot-code' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            success: function(response){
                $('#controlnameedit').val(response.controlname);
                $('#lotcodeedit').val(response.lotcode);
                $('#constmeanedit').val(response.const_mean);
                $('#constsdedit').val(response.const_sd);
                $('#hiddenid').val(response.id);
                $('#edit-sample-type').modal('show');
            }
        });

    }

    function editlotcodeValidation() {
        if(document.editlotcode.controlnameedit.value == ''){
            document.getElementById('controlnamealertedit').style.display = 'block';  
            document.editlotcode.controlnameedit.focus(); 
            return false;     
        }
        if(document.editlotcode.lotcodeedit.value == ''){
            document.getElementById('lotcodeeditalert').style.display = 'block';  
            document.editlotcode.lotcodeedit.focus(); 
            return false;     
        }
    document.editlotcode.submit();
    return true;
    }
    </script>
    
<script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
@endsection
