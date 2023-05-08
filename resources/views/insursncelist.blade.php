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

        <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">  
            <div class="container-fluid">
                <div class="row">
                    <!-- COL 3 STARTS HERE -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">                   		
                        <div class="row">
                            @include('layout.sidemenu')
                        </div>                                            
                    </div>
                    <!-- COL 3 ENDS HERE -->
                    <!--COL 9 STARTS HERE -->
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">

                    <div class="row g-2 row-deck">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title m-0">Insurance</h6> <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-insurance">Add Insurance</a>
                                
                            </div>
                          
                                @if(\Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    {{ \Session::get('success') }}
                                </div>
                                @endif
                            <div class="card-body">
                                <table id="department" class="table card-table table-hover align-middle mb-0" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Insurance Name</th>
                                                                                        
                                            <th class="text-center">Created Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                    $i=1;
                                    @endphp
                                    @foreach ($insurance as $houses)
                                        <tr>
                                            <td>{{$houses->id}}</td>
                                         
                                            <td>{{$houses->insurance_name }}</td>
                                            <td>{{$houses->created_at}}</td>
                                            

                                           
                                            <!-- <td class="text-center"> -->

                                               <td class="text-center">
                                            <a  onclick="editview('{{$houses->id }}');"class="btn btn-link btn-sm text-secondry" data-bs-toggle="modal" data-bs-target="#view-master-insurance{{ $houses->id }}"> 
                                                    <i class="fa fa-edit" style="color:#555CB8;"></i>
                                                </a>

                                                


                                                <a  onclick="viewwarehouse('{{$houses->id }}');"class="btn btn-link btn-sm text-secondry" data-bs-toggle="modal" data-bs-target="#view-sample-type{{ $houses->id }}" aria-label="View"> 
                                                    <i class="fa fa-eye" style="color:#2966ca;"></i>
                                                </a>
                                                
                                                <?php if($houses->status == '1') { ?>
                                                <a href="{{ 'block-master-warehouse/'.$houses->id }}" onclick="return confirm('Do you want to block this warehouse?')" class="btn btn-link btn-sm text-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Active" aria-label="Active">
                                                <i class="fa fa-ban" style="color:#198754;"></i>
                                             </a>

                                             <?php } else { ?>
                                                <a href="{{ 'unblock-master-warehouse/'.$houses->id }}" onclick="return confirm('Do you want to unblock this warehouse?')" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Blocked" aria-label="Blocked">
                                                <i class="fa fa-circle" style="color:#d63384;"></i>
                                             </a>

                                             <?php } ?>
                                                
                                               
                                            </td>
                                        </tr>
                                    @php
                                    $i=$i+1;
                                    @endphp  
                                    @endforeach
                                        
                                        
                                        
                                    </tbody>
                                </table>
                            </div>

                            <!-- modal start -->


 <div class="modal fade" id="insurancelist" tabindex="-1">

<div class="modal-dialog modal-lg-view">

    <div class="modal-content">

        <div class="modal-header">
        <h5 class="modal-title">Insurance Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeinsurance"></button>
    </div>

            <div class="modal-body custom_scroll">
            <table class="table table-borderless mb-0">
            <tbody>
                <tr>

                    <td>
                    <strong> Insurance Name : </strong><span id="insurancename"></span>
                    </td>
                    <td>
                        <strong> Insurance Name Arabic : </strong><span id="insurance_name"></span>
                    </td>
                </tr>

              
                 


              

               
            </tbody>
        </table>
        </div>
        
    </div>
</div>
</div>

                            <!-- modal end -->



                            <form class="row g-3" id="addinsurance" name="addinsurance" method="post" action="{{ route('master.insurance') }}">                        
                            @csrf 
                            <div class="modal fade" id="add-insurance" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Insurance</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body custom_scroll">
                                        <div class="row g-4">
                                        <div class="col-sm-6">
                                            <label class="form-label">Insurance Name <span style="color:#f00">*</span></label>                                        
                                            <input type="text" class="form-control form-control-lg" name="name" id="name" > 
                                            <div class="alert-danger pt-1 pb-1 px-1 py-1" id="namealert" style="display:none ;">Please enter name</div>                                      
                                        </div>
                                        </div>
                                        <div class="row g-4 mt-2">
                                       
                                      

                                    </div>                                
                                        </div>
                                        <div class="modal-footer">
                                        <a style="cursor:pointer;" class="btn btn-primary" onclick="formValidation();">Save</a>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- end modal add insurance -->

                           
                            
                            
                         </div> 
                    </div>
               
                </div> 
                <!-- .row end -->






                    </div>
                    <!--COL 9 ENDS HERE -->



                
                

                </div>
            </div>
        </div>

        <!-- edit Insurance start -->

         <form class="row g-3" id="editinsurance" name="editinsurance"  method="post" action="{{ route('insurance.edit') }}">                        
                            @csrf 
                            <div class="modal fade" id="edit-insurance" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Insurance</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body custom_scroll">
                                        <div class="row g-4">
                                        <div class="col-sm-6">
                                            <label class="form-label">Insurance Name <span style="color:#f00">*</span></label>                                        
                                            <input type="text" class="form-control form-control-lg" name="nameedit" id="nameedit" > 
                                            <div class="alert-danger pt-1 pb-1 px-1 py-1" id="nameeditalert" style="display:none ;">Please enter name</div>                                      
                                        
                                        </div>

                                      
                                       
                                        
                                        
                                    
                                       
                                        <div class="col-sm-6">
                                   
                                    
                                   
                                       

                                       
                                    
                                        

                                        <div class="row g-4 mt-2">
                                        
                                        
                                      
                                    </div>                                
                                        </div>
                                        <div class="modal-footer">
                                        <a style="cursor:pointer;" class="btn btn-primary" onclick="formeditValidation();">Save</a>
                                        <input type="hidden" class="form-control form-control-lg" id="hiddenid" name="hiddenid" >
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 

        <!-- end Insurence edit -->



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
                                    Custome redio input
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
    <script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>

    <script type="text/javascript">
var jq = jQuery.noConflict();
jq('#countryname, #statename, #cityname, #countrynameedit, #statenameedit, #citynameedit').each(function() { 
    jq(this).select2({ dropdownParent: jq(this).parent()});
});



</script>
    <script type="text/javascript">
    $(document).ready(function () {
        $('#add-insurance,#editinsurance,#insurancelist').modal({
            backdrop: 'static',
            keyboard: false
        })
   });
    $('#edit-modal-close-x,#edit-modal-close').click(function(){
        $('#editinsurance').hide();
        $('#editinsurance').modal('hide');
    });

    

function formValidation() {
  // Get the input value
  var insuranceName = $('#name').val();

  // Check if the insurance name is empty
  if (insuranceName.trim() === '') {
    // Show the error message
    $('#namealert').show();
  } else {
    // Hide the error message
    $('#namealert').hide();

    // Submit the form
    $('#addinsurance').submit();
  }
}


function loadstate(id){
        var token = $('input[name="_token"]').val();
        //alert('countryid->'+id);
        //statename
        $.ajax({
            url:"{{ 'load-state' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            success: function(response){
              
                var statehtml = "";
                var statename;
                
                
                statehtml = '<option value="">--Please Select--</option>';
                $.each(response.states, function( index, state) {                 
                    statehtml += '<option value="'+state.sid+'">'+state.statename+'</option>'; 
                });                
                $('#statename').html(statehtml); 
            }
        });
    }
    function loadstateedit(id){
        //alert(id); return false;
        var token = $('input[name="_token"]').val();
        //alert('countryid->'+id);
        //statename
        $.ajax({
            url:"{{ 'load-state' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            success: function(response){
                var statehtml = "";
                var statename;
                var cityhtml="";
                cityhtml = '<option value="">--Please Select--</option>';
                statehtml = '<option value="">--Please Select--</option>';
                $.each(response.states, function( index, state) {                 
                    statehtml += '<option value="'+state.sid+'">'+state.statename+'</option>'; 
                });                
                $('#statenameedit').html(statehtml); 
                $('#citynameedit').html(cityhtml);
            }
        });
    }

    



    function loadcity(id){
        //alert(id);
        //return false;
        var token = $('input[name="_token"]').val();
        //alert('countryid->'+id);
        //statename
        $.ajax({
            url:"{{ 'load-city' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            success: function(response){
               
                var cityhtml = "";         
                
                cityhtml = '<option value="">--Please Select--</option>';
                $.each(response.cities, function( index, city) {                 
                    cityhtml += '<option value="'+city.sid+'">'+city.cityname+'</option>'; 
                });                
                $('#cityname').html(cityhtml); 
            }
        });
    }

    function loadcityedit(id){
        // alert(id); return false;
        var token = $('input[name="_token"]').val();
        //alert('countryid->'+id);
        //statename
        $.ajax({
            url:"{{ 'load-city' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            success: function(response){                
                var cityhtml = "";             
                
                cityhtml = '<option value="">--Please Select--</option>';
                $.each(response.cities, function( index, city) {                 
                    cityhtml += '<option value="'+city.sid+'">'+city.cityname+'</option>'; 
                });                
                $('#citynameedit').html(cityhtml); 
            }
        });
    }



    function editview(id){
       alert(id);
        var token = $('input[name="_token"]').val();
        /*alert(token);
        return false;*/
        $.ajax({
            url:"{{ 'view-master-insurance' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            
            success: function(response){
                var name;
                // var namearabic;
                // var contactnumber;
                // var email;
                // var code;
                // var countryname;
                // var cityname;
                // var statename;
                // var address;
                // var addressarabic;
                // var warehousecityid;
                var hiddenid;

                $.each(response.insurance, function( index, insurance ) {
                    name  =insurance.insurance_name;                                  
                                                     
                    hiddenid = insurance.id;

                });
               
                $('#nameedit').val(name);
                // $('#namearabicedit').val(namearabic);


                // $('#contactnumberedit').val(contactnumber);
                // $('#emailedit').val(email);
                // $('#codeedit').val(code);
 
                // $('#addressedit').val(address);
                // $('#addressarabicedit').val(addressarabic);
                $('#hiddenid').val(hiddenid);
                $('#edit-insurance').modal('show');






                
                var countryhtml = "";
                var statehtml = "";
                var statename;
                var stateid;
              
                var cityname;


                $('#editinsurance').modal('show');

               
                $('#statenameedit').html(statehtml); 

                 cityhtml = '<option value="">--Please Select--</option>';
                 $.each(response.cities, function( index, city) {                 
                     cityhtml += '<option value="'+city.cityid+'">'+city.city_name+'</option>'; 
                 });
                 $('#citynameedit').html(cityhtml); 
                
                
                
                
                $.each(response.cities, function( index, city ) {
                    hiddenid = city.cityid; 
                    countryid = city.countryid;
                    stateid = city.stateid
                    cityname = city.city_name               
                });
               // $('#statenameedit').val(statename); 
               
               // $('#citynameedit').val(cityname);
                
                //alert(countryname); return false;
                
                            
                $('#countrynameedit option[value="'+countryname+'"]').attr("selected", "selected");
                $('#statenameedit option[value="'+statename+'"]').attr("selected", "selected");
                $('#citynameedit option[value="'+warehousecityid+'"]').attr("selected", "selected");
                 

                //$('#gender option[value="'+regidata.custgender+'"]').attr("selected", "selected");
            }
        });

    }

    




    function formeditValidation() {

        var emails = document.getElementById('emailedit');
    
        // alert(emails);
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    document.getElementById('nameeditalert').style.display = 'none';
    document.getElementById('emaileditalert').style.display = 'none';    
    document.getElementById('contactnumbereditalert').style.display = 'none'; 
    document.getElementById('statenameeditalert').style.display = 'none'; 
    document.getElementById('citynameeditalert').style.display = 'none'; 

    if(document.editinsurance.nameedit.value == ''){
        document.getElementById('nameeditalert').style.display = 'block'; 
        document.editinsurance.nameedit.focus();  
        return false;
     }
      

     if(document.editinsurance.contactnumberedit.value != ''){
     if(IsNumeric(document.editinsurance.contactnumberedit.value)==false){
        document.getElementById('contactnumbereditalert').style.display = 'block'; 
        document.getElementById("contactnumbereditalert").innerHTML="Invalid contact number! Please re-enter";
        document.editinsurance.contactnumberedit.select();
        document.editinsurance.contactnumberedit.focus(); 
        return false;
    }
}

  
        if(document.editinsurance.countrynameedit.value != ''){
            
            if(document.editinsurance.statenameedit.value == ''){
            document.getElementById('statenameeditalert').style.display = 'block';  
            document.editinsurance.statenameedit.focus(); 
            return false;     
        }
        if(document.editinsurance.citynameedit.value == ''){
            document.getElementById('citynameeditalert').style.display = 'block';  
            document.editinsurance.citynameedit.focus(); 
            return false;     
        }  
        }

        if(document.editinsurance.emailedit.value != ''){

if (!filter.test(emails.value)) {
    //document.addstaff.email.value=''
    document.getElementById('emaileditalert').style.display = 'block'; 
    document.getElementById("emaileditalert").innerHTML="Invalid email address! Please re-enter";
    document.editinsurance.emailedit.select();
    document.editinsurance.emailedit.focus();
    return false;
}


}    
    document.editinsurance.submit();
    return true;
 
};

function IsNumeric(strString)
{
   var strValidChars = "0123456789-+(). ";
   var strChar;
   var blnResult = true;
   if (strString.length == 0) return false;
   for (i = 0; i < strString.length && blnResult == true; i++)
      {
      strChar = strString.charAt(i);
      if (strValidChars.indexOf(strChar) == -1)
            {
             blnResult = false;
            }
      }
   return blnResult;
}

</script>



<script>
     function viewwarehouse(id){
    // alert(id);  
   
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  
        $.ajax({
         type: 'POST',
        url: "{{ 'warehouseview' }}",
         data: {id: id},
        //  alert(id);
         success:function(data){
          //  alert(data.contact_name_arabic); return false;

 var warehousearabic;
 var statenames;
 var citynames;
 var countrynames;
 var contactnumber;
 var emails;
 var codes;
 var addresses;
 var addressesarabic;


 var warehouse_name_arabic=data.warehouse_name_arabic;
 var warehousename=data.warehouse_name;
 var address= data.address;
 var address_arabic= data.address_arabic;
 var contact_number= data.contact_number;
 var country= data.countryname;
 var state= data.statename;
 var city= data.cityname;
 var email = data.email;
 var code = data.contact_number;
 var code = data.code;

       
        


        if($.trim(warehouse_name_arabic) == ''){
            
            warehousearabic = '-NA-';
        } else {
            warehousearabic = warehouse_name_arabic;
        }

       

        if($.trim(state) == ''){
            
            statenames = '-NA-';
        } else {
            statenames = state;
        }

        if($.trim(country) == ''){
            
            countrynames = '-NA-';
        } else {
            countrynames = country;
        }

        if($.trim(city) == ''){
            
            citynames = '-NA-';
        } else {
            citynames = city;
        }
        

       

        if($.trim(email) == ''){
            
            emails = '-NA-';
        } else {
            emails = email;
        }


        if($.trim(code) == ''){
            
            codes = '-NA-';
        } else {
            codes = code;
        }


        if($.trim(address_arabic) == ''){
            
            addressesarabic = '-NA-';
        } else {
            addressesarabic = address_arabic;
        }

        if($.trim(contact_number) == ''){
            
            contactnumber = '-NA-';
        } else {
            contactnumber = contact_number;
        }
        
        if($.trim(address) == ''){
            
            addresses = '-NA-';
        } else {
            addresses = address;
        }
       
        
        
        
 $('#insurancelist').modal('show');




 $('#warehousename').html(warehousename);
  $('#warehousenamearabic').html(warehousearabic);
 $('#emailid').html(emails);
  $('#codeid').html(codes);
  $('#addressid').html(addresses);
  $('#countryid').html(countrynames);
  $('#addressarabicid').html(addressesarabic);
 $('#contactnumberid').html(contactnumber);
 
 $('#stateid').html(statenames);
 $('#cityid').html(citynames);


        
            
            
}
});
      }
    

     $('#closewarehouseview').click(function(){
    $('#warehouseviewlist').html("");
});
</script>

<script>
function editview(id) {
    // Implement your logic for edit functionality here
    console.log("Edit option clicked for ID: " + id);
    // You can use the id parameter to identify the specific row or record to be edited
    // For example, you can make an AJAX call to fetch the data for editing and display it in a modal or a form
}
</script>









@endsection
