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
    </style>
    
    
@csrf
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
                                            <h6 class="card-title m-0">Parameter Setup</h6><a href="{{ url('/add-parameter') }}" class="btn btn-primary">Add Parameter</a>
                                            
                                        </div>
                                        @if(\Session::get('success'))
                                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                            {{ \Session::get('success') }}
                                        </div>
                                        @endif
                                        <div class="card-body">
                                        
                                            <table id="tblmasterparameter" class="table card-table table-hover align-middle mb-0" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width:3%">#</th>
                                                        <th style="width:45%">Parameters</th>
                                                        <th style="width:45%">Parameters (Arabic)</th>
                                                        <th style="width:7%"class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($parameters as $key => $value)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{ $value->parameter_name }}</td>
                                                        <td>
                                                            @php if($value->parameter_name_arabic)  { $arabicname = $value->parameter_name_arabic; } else { $arabicname = '-NA-'; } @endphp
                                                        {{ $arabicname }}</td>
                                                        <td class="text-center">
                                                            <a onclick="viewparameter('{{$value->id }}');" class="btn btn-link btn-sm text-secondry" aria-label="View"> 
                                                                <i class="fa fa-eye" style="color:#2966ca;"></i>
                                                            </a>
                                                            
                                                            <a href="{{ 'edit-parameter/'.$value->id }}" class="btn btn-link btn-sm text-secondry"><i class="fa fa-edit" style="color:#555CB8;"></i>
                                                            </a>

                                                            <?php if($value->status =='1') { ?> 
                                                            <a href="{{ 'block-parameter/'.$value->id }}"  onclick="return confirm('Do you want to block this parameter?')" class="btn btn-link btn-sm text-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Active" aria-label="Active">
                                                                <i class="fa fa-ban" style="color:#198754;"></i>                                                                
                                                            </a>
                                                            <?php } else { ?>
                                                                <a href="{{ 'unblock-parameter/'.$value->id }}" onclick="return confirm('Do you want to unblock this parameter?')" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Blocked" aria-label="Blocked">
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
                                        
                                        
                          <div class="modal fade" id="parameterview" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modaltitle">Parameter Details </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body custom_scroll">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td colspan="3">Parameter Name : <strong><span id="pname"></span></strong></th>
                                                </tr>
                                                <tr>
                                                    <td >Short Code : <strong><span id="pshortcode"></span></strong></th>
                                                    <td colspan="2">LIS Parameter Code : <strong><span id="pcode"></span></strong></td>

                                                </tr>
                                                <tr>
                                                    <td>Label / Heading : <strong><span id="plabel"></span></strong></th>
                                                    <td colspan="2">Final Result : <strong><span id="pfinalresult"></span></strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="background-color:#e4e7e6">
                                                        <h6 class="card-title" style="margin-bottom:0px;">Parameter - Equipment - Method Mapping</h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Equipment / Machine : <strong><span id="pequipment"></span></strong></th>
                                                    <td colspan="2">Equipment Test ID : <strong><span id="pequipmentid"></span></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Result Value : <strong><span id="presultvalue"></span></strong></th>
                                                    <td>Duration : <strong><span id="pduration"></span></strong></td>
                                                    <td>Equation : <strong><span id="pequation"></span></strong></td>
                                                </tr>
                                                <tr>
                                                    <td>Method : <strong><span id="pmethod"></span></strong></th>
                                                    <td>Decimal Nos : <strong><span id="pdecimal"></span></strong></td>
                                                    <td>Unit : <strong><span id="punit"></span></strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" style="background-color:#e4e7e6">
                                                        <h6 class="card-title" style="margin-bottom:0px;">Reference Ranges</h6>
                                                    </td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <td colspan="3">
                                                        <table class="table table-bordered">
                                                          <thead>
                                                          <tr>
                                                          <th colspan="6" class="text-center">Age Limit</th>
                                                          <th colspan="9" class="text-center">Normal Value</th>
                                                          </tr>
                                                            <tr>
                                                               <th colspan="3" style="width:200px;" class="text-center">Lower </th>
                                                               <th colspan="3" style="width:200px;" class="text-center">Upper</th>
                                                               <th colspan="2" style="width:200px;" class="text-center">Male </th>
                                                               <th style="width:50px;" class="text-center">Min</th>
                                                               <th style="width:50px;" class="text-center">Max</th>
                                                               <th colspan="2" style="width:200px;" class="text-center">Female</th>
                                                               <th style="width:50px;" class="text-center">Min</th>
                                                               <th style="width:50px;" class="text-center">Max</th>
                                                        
                                                            </tr>
                                                          </thead>
                                                          <tbody id="refrangebody">   
                                                        
                                                           <tr>
                                                                <td colspan="3" class="text-center" valign="middle">>= 0 Days</td>
                                                                <td colspan="3" class="text-center" valign="middle">< 10 Days</td>
                                                                <td colspan="2" class="text-center" valign="middle">0-10</td>
                                                                <td valign="middle" class="text-center">0</td>
                                                                <td valign="middle" class="text-center">10</td>
                                                                <td colspan="2" class="text-center" valign="middle">0-20</td>
                                                                <td class="text-center" valign="middle">0</td>
                                                                <td class="text-center" valign="middle">20</td>
                                                                
                                                            </tr>
                                                        
                                                          </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
            
                                        <!-- Modal -->
                                        
                                        
                                    </div>
                                </div>
                        </div> 
                        
                      

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
        $('#parameterview').modal({
            backdrop: 'static',
            keyboard: false
        })
   });                                                                

    function viewparameter(id){
        var token = $('input[name="_token"]').val();
        //var tokendel = document.querySelector('meta[name="csrf-token"]').getAttribute("content");  
        //alert(token); return false;
        //alert(id);
		//$('#parameterview').modal('show');
        $.ajax({
            url:"{{ 'view-parameter' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            success: function(response){
                var pname;
                var pshortcode;
                var pcode;
                var plabel;
                var pfinalresult;
                var pequipment;
                var pequipmentid;
                var presultvalue;
                var pduration;
                var pequation;
                var pmethod;
                var pdecimal;
                var punit;
                var refrangehtml = "";

                pname = response.parameter.parameter_name;
                if($.trim(response.parameter.short_code) == ''){ pshortcode = '-NA-'; } else { pshortcode = response.parameter.short_code; }
                if($.trim(response.parameter.lis_parameter_code) == ''){ pcode = '-NA-'; } else { pcode = response.parameter.lis_parameter_code; }
                if($.trim(response.parameter.label_heading) == ''){ plabel = '-NA-'; } else { plabel = response.parameter.label_heading; }
                if($.trim(response.parameter.final_result) == ''){ pfinalresult = '-NA-'; } else { pfinalresult = response.parameter.final_result; }
                if($.trim(response.parameter.machine_name) == ''){ pequipment = '-NA-'; } else { pequipment = response.parameter.machine_name; }
                if($.trim(response.parameter.equipment_test_id) == ''){ pequipmentid = '-NA-'; } else { pequipmentid = response.parameter.equipment_test_id; }
                if($.trim(response.parameter.result_value) == ''){ presultvalue = '-NA-'; } else { presultvalue = response.parameter.result_value; }
                if($.trim(response.parameter.duration) == ''){ pduration = '-NA-'; } else { pduration = response.parameter.duration; }
                if($.trim(response.parameter.equation) == ''){ pequation = '-NA-'; } else { pequation = response.parameter.equation; }
                if($.trim(response.parameter.testmethod) == ''){ pmethod = '-NA-'; } else { pmethod = response.parameter.testmethod; }
                if($.trim(response.parameter.decimal_nos) == ''){ pdecimal = '-NA-'; } else { pdecimal = response.parameter.decimal_nos; }
                if($.trim(response.parameter.labunit_name) == ''){ punit = '-NA-'; } else { punit = response.parameter.labunit_name; }


                $('#pname').html(pname);
                $('#pshortcode').html(pshortcode);
                $('#pcode').html(pcode);
                $('#plabel').html(capitalizeFirstLetter(plabel));
                $('#pfinalresult').html(capitalizeFirstLetter(pfinalresult));
                $('#pequipment').html(pequipment);
                $('#pequipmentid').html(pequipmentid);
                $('#presultvalue').html(capitalizeFirstLetter(presultvalue));
                $('#pduration').html(pduration);
                $('#pequation').html(pequation);
                $('#pmethod').html(pmethod);
                $('#pdecimal').html(pdecimal);
                $('#punit').html(punit);


                $.each(response.referenceranges, function( index, referencerange ) {
                    refrangehtml += '<tr><td colspan="3" class="text-center" valign="middle">'+referencerange.lowertype+' '+referencerange.lowervalue+' '+referencerange.lowerchronological+'</td><td colspan="3" class="text-center" valign="middle">'+referencerange.highertype+' '+referencerange.highervalue+' '+referencerange.higherchronological+'</td><td colspan="2" class="text-center" valign="middle">'+referencerange.malevalue+'</td><td valign="middle" class="text-center">'+referencerange.minmalevalue+'</td><td valign="middle" class="text-center">'+referencerange.maxmalevalue+'</td><td colspan="2" class="text-center" valign="middle">'+referencerange.femalevalue+'</td><td class="text-center" valign="middle">'+referencerange.minfemalevalue+'</td><td class="text-center" valign="middle">'+referencerange.maxfemalevalue+'</td></tr>';
                });
                
                $('#refrangebody').html(refrangehtml);
                $('#parameterview').modal('show');
            }
        });
    } 
   
    function addparameterValidation() {
        document.getElementById('parameternamealert').style.display = 'none';
        if(document.addparameter.parametername.value == ''){
            document.getElementById('parameternamealert').style.display = 'block';  
            document.addparameter.parametername.focus(); 
            return false;     
        }
    document.addparameter.submit();
    return true;
    }
    
    /*function editview(id){
        var token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ 'view-parameter' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            success: function(response){
                $('#parameternameedit').val(response.parameter_name);
                $('#hiddenid').val(response.id);
                $('#edit-sample-type').modal('show');
            }
        });

    }*/

    function editparameterValidation() {
        if(document.editparameter.parameternameedit.value == ''){
            document.getElementById('parameternamealertedit').style.display = 'block';  
            document.editparameter.parameternameedit.focus(); 
            return false;     
        }
    document.editparameter.submit();
    return true;
    }


    function capitalizeFirstLetter(string){
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    </script>
      
<script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
@endsection
