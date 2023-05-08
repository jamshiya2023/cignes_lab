@extends('layout.maintemplate')
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
                                <h6 class="card-title m-0">Staff Lists</h6> <a href="{{ url('/add-staff') }}" class="btn btn-primary">Add Staff</a>
                                
                            </div>
                                @if(\Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    {{ \Session::get('success') }}
                                </div>
                                @endif
                            <div class="card-body">
                                <table id="staffs" class="table card-table table-hover align-middle mb-0" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Staff Name</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Designation</th>
                                            <th>Username</th>
                                            <th class="text-center">Change Password</th>
                                            <th class="text-center">ID Proof</th>
                                            <th class="text-center">Branch</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($staffdetails as $key => $staff)
                                    
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <?php
                                                    if($staff->profilepicture) { ?>
                                                    <img src="{{ url('uploads/'.$staff->profilepicture) }}" class="avatar rounded-circle me-3 mt-2" alt="Profile Picture">
                                                    <?php }  else {?>
                                                        <img src="{{ url('assets/images/profile.png') }}" class="avatar rounded-circle me-3 mt-2" alt="Profile Picture">
                                                    <?php } ?>
                                                    <div>
                                                        <div class="fw-bold">{{ $staff->firstname }} {{ $staff->lastname }}</div>
                                                        <span class="small text-muted">{{ $staff->contactnumber }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $staff->email }}</td>
                                            <td>{{ $staff->departmentname }}</td>
                                            <td>{{ $staff->designationname }}</td>
                                            <td>EMP{{ $staff->staffcode }}</td>
                                            <td class="text-center"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#logincredentials{{ $staff->id }}">Click to Change</button></td>
                                            <td class="text-center"><button type="button" class="btn btn-primary btn-sm" onclick="proofview('{{$staff->id}}')">Click to View</button></td>
                                            <td class="text-center"><button type="button" class="btn btn-primary btn-sm" onclick="branchview('{{$staff->id}}')">Assign to Branch</button></td>
                                            <td class="text-center">
                                                <a href="{{ 'edit-staff/'.$staff->id }}" class="btn btn-link btn-sm text-secondry" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit" aria-label="Edit">
                                                    <i class="fa fa-edit" style="color:#555CB8;"></i>
                                                </a>
                                                <?php if($staff->status =='1') { ?> 
                                                <a href="{{ 'block-staff/'.$staff->id }}"  onclick="return confirm('Do you want to block this staff?')" class="btn btn-link btn-sm text-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Active" aria-label="Active">
                                                    <i class="fa fa-ban" style="color:#198754;"></i>
                                                    
                                                </a>
                                                <?php } else { ?>
                                                    <a href="{{ 'unblock-staff/'.$staff->id }}" onclick="return confirm('Do you want to unblock this staff?')" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Blocked" aria-label="Blocked">
                                                    <i class="fa fa-circle" style="color:#d63384;"></i>
                                                </a>
                                                <?php } ?>    

                                                <!-- <a href="" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" aria-label="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a> -->
                                            </td>
                                        </tr>
                              

                                        <!-- Modal Login Credentials-->
                            <div class="modal fade" id="logincredentials{{ $staff->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Change Password</h5>
                                            <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="passclose"></button>-->
                                            <button type="button" class="btn-close" onclick="modalclose('{{ $staff->id }}');"></button>           
                                        </div>
                                        <div class="modal-body">
                                        <div class="alert-success pt-1 pb-1 px-1 py-1 mb-2 text-center" id="passwordupdatealert{{ $staff->id }}" style="display:none ;">Password has been changed successfully</div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <div class="form-check form-check-inline">                                                    
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        New Password 
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">                                                    
                                                <input type="text" class="form-control form-control-lg" name="newpassword{{ $staff->id }}" id="newpassword{{ $staff->id }}">
                                                <div class="alert-danger pt-1 pb-1 px-1 py-1" id="newpasswordalert{{ $staff->id }}" style="display:none ;">Please enter new password</div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <div class="form-check form-check-inline">                                                    
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Confirm Password 
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">                                                    
                                                <input type="text" class="form-control form-control-lg" name="confirmpassword{{ $staff->id }}" id="confirmpassword{{ $staff->id }}">
                                                <div class="alert-danger pt-1 pb-1 px-1 py-1" id="confirmpasswordalert{{ $staff->id }}" style="display:none ;">Please enter confirm password</div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between mb-3">
                                            <div class="form-check form-check-inline">                                                    
                                                    &nbsp;
                                                </div>
                                                <div class="form-check form-check-inline">                                                    
                                                    <a class="btn btn-primary" onclick="changepassword('{{ $staff->id }}');">Change Password</a>
                                                </div>
                                                
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                                                    


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
<form class="row g-3" name="assignbranch" method="post" action="{{ route('branchstaff.edit') }}">                            
@csrf
<div class="modal fade" id="branch" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Assign To Branch</h5>
                                            <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="passclose"></button>-->
                                            <button type="button" class="btn-close" id="branchclose"></button>           
                                        </div>
                                        <div class="modal-body">
                                        
                                            <div class="d-flex justify-content-between mb-3">
                                                
                                                <!-- <div class="form-check form-check-inline ">    -->
                                                <div class="col-md-12 ">  
                                                    <label class="form-check-label mb-2" for="flexCheckDefault">
                                                       Branches
                                                    </label>                                                 
                                                    <select class="form-select form-select-lg" name="branchname" id="branchname" >
                                                    </select>
                                                    <div class="alert-danger pt-1 pb-1 px-1 py-1" id="branchnamealert" style="display:none ;">Please select branch</div>
                                                </div>
                                            </div>
                                            

                                            <div class="d-flex justify-content-between mb-3">
                                            <div class="form-check form-check-inline">                                                    
                                                    &nbsp;
                                                    <input type="hidden" class="form-control form-control-lg" name="hiddenid" id="hiddenid"  >
                                                </div>
                                                <div class="form-check form-check-inline">                                                    
                                                    <a class="btn btn-primary" onclick="savebranch();">Save</a>
                                                </div>
                                                
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
</form>

                                                    <!-- BRANCH ASSIGN TO STAFF ENDS HERE -->

        <!--Modal ID Proof Starts Here-->
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
        <!-- Modal ID Proof Ends Here --> 



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
                url: "{{ 'proof' }}",
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
    <script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
@endsection
