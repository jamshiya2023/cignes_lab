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
    .expirydate{ z-index:99999 !important; }
    </style>

    
       <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">
				<div class="row">
                	
                    <!--COL 9 STARTS HERE -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    
                    	<div class="row g-4"> 
                <form class="row g-3" id="editlead" name="editlead" method="post" action="{{ url('update-lead') }}">                            
                @csrf


                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Edit  Lead</h6>
                            </div>

                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <label class="form-label">lead title <span class="red">*</span></label>
                                        <!-- <input type="text" class="form-control form-control-lg" placeholder="Enter here"> -->
                                        <input type="text" class="form-control form-control-lg" name="leadtitle" value="{{$itempurchases->lead_title}}" > 
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="leadtitlealert" style="display:none ;">Please enter lead title</div>                                      
                                       
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Contact Name <span class='red'>*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="contactname" value="{{$itempurchases->contact_name}}" >
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="contactnamealert" style="display:none ;">Please enter contact name</div>
                                    </div> 

                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Contact Number <span class='red'>*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="contactnumber" value="{{$itempurchases->contact_number}}" >
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="contactnumberalert" style="display:none ;">Please enter contact number</div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">lead status<span class="red">*</span></label>
                                        <select class="form-select form-select-lg" name="leadstatus" id="leadstatus">
                                            <option value="">--Please Select--</option>
                                            @foreach ($leadstatus as $liststatus)
                                            <option value="{{$liststatus->id}}"{{ ( $liststatus->id == $itempurchases->level_status) ? 'selected' : '' }}>{{$liststatus->leadstatus_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="leadstatusalert" style="display:none ;">Please enter leadstatus</div>

                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">lead source</label>
                                        <select class="form-select form-select-lg" name="leadsource" id="leadsource">
                                            <option value="">--Please Select--</option>
                                            @foreach ($leadsource as $listsource)
                                            <option value="{{$listsource->id}}">{{$listsource->leadsource_name}}</option>
                                            @endforeach

                                          
                                        </select>

                                    </div>
                                    


                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control form-control-lg" name="emailedit" id="emailedit" value="{{$itempurchases->email}}" >
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="emaileditalert" style="display:none ;">Please enter email id</div>
                                    </div>
                                    

                                    <div class="col-sm-6">
                                    <label class="form-label">Note </label>                          
                                        <input type="text" class="form-control form-control-lg" name="note" value="{{$itempurchases->note}}" > 
                                            
                                        </div>
                                    
      
                                        
                                       

                                        <div class="col-sm-6">                             
            <div>            
            <div class="row">
                <?php 
            // date_default_timezone_set('Asia/Kolkata');
            //  $date = date('h:i:s'); 
             ?>
            <!-- <div class="col-sm-6">  -->
            <div class="col-sm-6">

            
                <label class="form-label">Contact time</label><span class="red">*</span>
                <input type="time" class="form-control" name="contacttime" id="" value="{{$itempurchases->contact_time}}" >
                <!-- <input type="text"  class="form-control form-control-lg" name="contacttime"  >  -->
                <div class="alert-danger pt-1 pb-1 px-1 py-1" id="contacttimealert" style="display:none ;">Please enter contact time</div>                                 
                </label>     
            </div>  
                
                   <div class="col-sm-6">
                <label class="form-label">Contact date </label><span class="red">*</span>
                <input type="date"  class="form-control form-control-lg" name="contactdate" id="" value="{{$itempurchases->contact_date}}"> 
                <div class="alert-danger pt-1 pb-1 px-1 py-1" id="contactdatealert" style="display:none ;">Please enter contact date</div>                                 
            </div>  

          
        </div>                    
            </div>
                       
        </div>
                <?php
                date_default_timezone_set('Asia/Kolkata');
                $date = date('h:i:s');
                $date1= date('Y-m-d');
                 ?> 
                 <input type="hidden" value="<?php echo $date; ?>" class="form-control form-control-lg" name="currenttime" id="currenttime" > 
                 <input type="hidden" value="<?php echo $date1; ?>" class="form-control form-control-lg" name="currentdate" id="currentdate" > 

       
      
       

         <div class="col-sm-6">
        <label class="form-label">Assigned Staffs<span class="red">*</span></label>
        <select class="form-select form-select-lg" name="assignedstaff" id="assignedstaff" value="{{$itempurchases->assigned_staffs}}">
        <option value="">--Please Select--</option>
      
        @foreach ($leadstaff as $liststaff)
        <option value="{{$liststaff->id }}"{{ ( $liststaff->id == $itempurchases->assigned_staffs) ? 'selected' : '' }}>{{$liststaff->firstname}}</option>
         @endforeach

        
         </select>
        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="assignedstaffalert" style="display:none ;">Please enter assigned staffs</div>                                
         </div>


         </div>                                 
        </div>                            

                            
                            <div class="card-footer">
                    
                            <input type="hidden" name="hiddenid" value="{{$itempurchases->id}}">
                            <a style="cursor:pointer;" class="btn btn-primary" onclick="formValidation();">Save</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                            </div>
                        </div>
                    </div>
                    
                    </form>
                    
                    
                    
                    
                </div>
                    
                    </div>
                    <!--COL 9 ENDS HERE -->
                
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
<script>
function formValidation() 
{
    
    
    var emails = document.getElementById('emailedit');
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    document.getElementById('leadtitlealert').style.display = 'none';
     document.getElementById('contactnamealert').style.display = 'none';
     document.getElementById('contactnumberalert').style.display = 'none';
    document.getElementById('leadstatusalert').style.display = 'none';
     document.getElementById('emaileditalert').style.display = 'none';
     document.getElementById('contactdatealert').style.display = 'none';
     document.getElementById('contacttimealert').style.display = 'none';
    document.getElementById('assignedstaffalert').style.display = 'none';
    
    
      if(document.editlead.leadtitle.value == ''){
        document.getElementById('leadtitlealert').style.display = 'block'; 
        document.editlead.leadtitle.focus();  
        return false;  
      }


      if(document.editlead.contactname.value == ''){
        document.getElementById('contactnamealert').style.display = 'block'; 
        document.editlead.contactname.focus();  
        return false;  
      }
      if(document.editlead.contactnumber.value == ''){
        document.getElementById('contactnumberalert').style.display = 'block'; 
        document.editlead.contactnumber.focus();  
        return false;     
    } 
     if(IsNumeric(document.editlead.contactnumber.value)==false){
        document.getElementById('contactnumberalert').style.display = 'block'; 
        document.getElementById("contactnumberalert").innerHTML="Invalid contact number! Please re-enter";
        document.editlead.contactnumber.select();
        document.editlead.contactnumber.focus(); 
        return false;
    }if(document.editlead.leadstatus.value == ''){
        document.getElementById('leadstatusalert').style.display = 'block'; 
        document.editlead.leadstatus.focus();  
        return false;  
}if(document.editlead.contacttime.value == ''){
        document.getElementById('contacttimealert').style.display = 'block'; 
        document.editlead.contacttime.focus();  
        return false; 

    }if(document.editlead.contactdate.value == ''){
        document.getElementById('contactdatealert').style.display = 'block'; 
        document.editlead.contactdate.focus();  
        return false; 
    }if(document.editlead.assignedstaff.value == ''){
        document.getElementById('assignedstaffalert').style.display = 'block'; 
        document.editlead.assignedstaff.focus();  
        return false; 
    }


    if(document.editlead.emailedit.value != ''){

     if (!filter.test(emails.value)) {
    
    document.getElementById('emaileditalert').style.display = 'block'; 
    document.getElementById("emaileditalert").innerHTML="Invalid email address! Please re-enter";
    document.editlead.emailedit.select();
    document.editlead.emailedit.focus();
    return false;
}
}    

document.editlead.submit();    
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








    <script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>


<!-- <script>
    flatpickr(".expirydate", {
      dateFormat: "d-m-Y",
      minDate: "today",
      
    });
/*$(function() {
    $("body").delegate(".collecteddate", "focusin", function(){
        $(this).flatpickr({
            enableTime: true,
            dateFormat: "d-m-Y h:i K",
            //time24hr:false
            //defaultDate: "2020-11-26 14:30 PM" 
            
            
        });
    });
*/
</script> -->


@endsection
