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

                <div class="row g-4">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Update Staff</h6>
                            </div>
                            <div class="card-body pt-0">
                            <div class="row g-4">

                    <!-- FORM STARTS HERE -->
<form class="row g-3" id="addstaff" name="addstaff" method="post" enctype="multipart/form-data" action="{{ url('edit-staff/'.$staff->id) }}">                            
                @csrf
               
                <input type="hidden" name="staffcode" value="{{$staff->staffcode}}">

                <div class="col-lg-7 col-md-7 col-sm-12">
                                
                        <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">First Name <span class='red'>*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="firstname" value="{{$staff->firstname}}" >
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="firstnamealert" style="display:none ;">Please enter first name</div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Last Name <span class='red'>*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="lastname" value="{{$staff->lastname}}">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="lastnamealert" style="display:none ;">Please enter last name</div>
                                    </div>
                        </div> 
                        <div class="row">                                   
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Department <span class='red'>*</span></label>
                                        <select class="form-select form-select-lg" name="department" id="department">
                                            <option value="">- Please Select -</option>
                                            @foreach ($departments as $department)
                                                                                       
                                            <option value="{{$department->id}}" {{ ( $department->id == $staff->department_id) ? 'selected' : '' }}>{{$department->department_name}}</option>
                                            @endforeach                                            
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="departmentalert" style="display:none ;">Please select department</div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Designation <span class='red'>*</span></label>
                                        <select class="form-select form-select-lg" tabindex="-98" name="designation" id="designation">
                                            @foreach ($designations as $designation)
                                            <option value="{{$designation->id}}" {{ ( $designation->id == $staff->designation_id) ? 'selected' : '' }}>{{$designation->designation_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="designationalert" style="display:none ;">Please select designation</div>
                                    </div>
                        </div>
                        <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Gender <span class='red'>*</span></label>
                                        <select class="form-select form-select-lg" tabindex="-98" name="gender" id="gender">
                                            <option value="">- Please Select -</option>
                                            <option value="Male" {{ ( $staff->gender == 'Male') ? 'selected' : '' }}>Male</option>
                                            <option value="Female"  {{ ( $staff->gender == 'Female') ? 'selected' : '' }}>Female</option>
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="genderalert" style="display:none ;">Please select gender</div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Date of Birth <span class='red'>*</span></label>
                                        <input id="dateofbirth" name="dateofbirth" type="text" class="form-control form-control-lg" value="{{$staff->dateofbirth}}">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="dobalert" style="display:none ;">Please enter date of birth</div>
                                    </div>
                        </div>
                        <div class="row">                                  
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Email <span class='red'>*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="email" id="email" value="{{$staff->email}}" >
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="emailalert" style="display:none ;">Please enter email id</div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Contact Number <span class='red'>*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="contactnumber" id="contactnumber" value="{{$staff->contactnumber}}">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="phonealert" style="display:none ;">Please enter contact number</div>
                                    </div>
                        </div> 
                        <div class="row">                                    
                        <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Qualifications</label>
                                        <input type="text" class="form-control form-control-lg" name="qualification" value="{{$staff->qualification}}">
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Specialist (Optional)</label>
                                        <input type="text" class="form-control form-control-lg" name="specialist" value="{{$staff->specialist}}">
                                    </div>
                        </div>
                        <div class="row">
                                    
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Profile Picture</label> 
                                        @if($staff->profilepicture)
                                        <a style="float:right" class="tooltips">View<span class="tooltiptext"><img src="{{ url('uploads') }}/{{$staff->profilepicture}}" width="120" height="auto"></span></a>
                                        @endif
                                        <input type="file" class="form-control" name="profilepic" id="profilepic" onchange="return profilepicValidation();">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="profilepicalert" style="display:none ;">Please upload only image file</div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">Signature</label>
                                        @if($staff->signature)
                                        <a style="float:right" class="tooltips">View<span class="tooltiptext"><img src="{{ url('uploads') }}/{{$staff->signature}}" width="120" height="auto"></span></a>
                                        @endif
                                        <input type="file" class="form-control" name="signature" id="signature"  onchange="return signatureValidation();">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="signaturealert" style="display:none ;">Please upload only image file</div>
                                    </div>
                        </div>
                        <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                        <label class="form-label">ID Proof (Documents)</label>
                                    </div>

                                @if($existingdocumentscount>0) 
                                <table id="tabledocumentlist" class="table card-table table-hover align-middle mb-1 mt-0" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Document Type</th>
                                            <th>Document Number</th>
                                            <th>Expiry Date</th>
                                            <th class="text-center">Attachment</th>
                                            <th class="text-center">Actions</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody id="doclistbody">
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach($existingdocuments as $existingdocs)
                                    
                                            <tr><td>{{$i}}</td><td>{{$existingdocs->documenttype}}</td><td>{{$existingdocs->documentnumber}}</td><td>{{$existingdocs->documentexpirydate}} </td><td class="text-center"><div class="btn btn-link btn-sm text-success tooltips"><i class="fa fa-eye"></i><span class="tooltiptext"><img src="{{ url('uploads') }}/{{$existingdocs->documentfilename}}" width="120" height="auto"></span></div></td><td class="text-center"><span class="btn btn-link btn-sm text-danger delete" onclick="return deletedoc('{{$existingdocs->staff_id}}','{{$existingdocs->id}}',this);"><i class="fa fa-trash"></i></span></td></tr>
                                    @php
                                    $i= $i+1;
                                    @endphp
                                    @endforeach
                                    </tbody>
                                    </table>
                                @else
                                <table id="tabledocumentlist" class="table card-table table-hover align-middle mb-1 mt-0" style="width: 100%; display:none;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Document Type</th>
                                            <th>Document Number</th>
                                            <th>Expiry Date</th>
                                            <th class="text-center">Attachment</th>
                                            <th class="text-center">Actions</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody id="doclistbody">
                                    </tbody>
                                    </table>      
                                @endif    
                        </div>
                        <div class="row"> 
                                    <div class="col-lg-2 col-md-2 mt-3">
                                        <label class="form-label">Document Type <span class="red">*</span></label>
                                        <select class="form-select form-select-lg" tabindex="-98" name="documenttype" id="documenttype">
                                            <option value="">- Please Select -</option>
                                            @foreach ($documenttypelist as $documenttype)
                                            <option value="{{$documenttype->id}}">{{$documenttype->documenttype}}</option>
                                            @endforeach
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="documenttypealert" style="display:none ;">Please select</div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 mt-3">
                                        <label class="form-label">Document Number <span class="red">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="documentnumber" id="documentnumber">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="documentnumberalert" style="display:none ;">Please enter</div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 mt-3">
                                        <label class="form-label">Document Expiry Date <span class="red">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="docexpirydate" id="docexpirydate">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="docexpirydatealert" style="display:none ;">Please enter </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 mt-3">
                                        <label class="form-label">Attach File <span class="red">*</span></label>
                                        <input type="file" class="form-control" name="docattachement" id="docattachement" onchange="return documentAttachValidation();">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="docattachementalert" style="display:none ;"></div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 mt-3">
                                        <a style="cursor:pointer;" class="btn btn-primary mt-2" onclick="documentsValidation();">Save & Add More</a>
                                    </div>
                        </div>
                        <div class="row">

                                    <div class="col-sm-12 mt-3">
                                        <label class="form-label">Details</label>
                                        <textarea rows="4" class="form-control no-resize" name="details">{{$staff->details}}</textarea>
                                    </div>
                        </div>

                                </div>

                            <div class="col-lg-5 col-md-5 col-sm-12">
                            <h6 class="card-title mb-0">Menu Permissions <span class="red">*</span>( Select All <input type="checkbox" id="select-all" class="form-check-input mt-0" name="selectall"> )</h6>
                            <div class="alert-danger pt-1 pb-1 px-1 py-1" id="permissionalert" style="display:none ;">Please assign permission to atleast one menu</div>
                            <table id="documentlist" class="table card-table table-hover align-middle mb-1 mt-5" style="width: 100%;" >
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th class="text-center">View</th>
                                            <th class="text-center">Add</th>
                                            <th class="text-center">Edit</th>
                                            <th class="text-center">Block</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                                                      
                                    @php $i = 0; @endphp
                                    @foreach ($menulist as $menu)
                                    <tr>
                                    @if($menu->id == '1')
                                    <td>{{$menu->menu_name}}<input type="hidden" name="menuid[]" value="{{$menu->id}}"></td>  
                                    <td class="text-center">
                                                <input type="hidden" name="menuview[{{$i}}]" value="0">
                                                <input type="checkbox" class="form-check-input menucheckbox" name="menuview[{{$i}}]" value="1" {{ ($menu->permission->viewmenu == '1') ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="menuadd[{{$i}}]" value="0">
                                                <input type="checkbox" class="form-check-input menucheckbox" name="menuadd[{{$i}}]" value="1" {{ ( $menu->permission->addmenu == '1') ? 'checked' : '' }}>
                                                
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="menuedit[{{$i}}]" value="0">
                                                <input type="checkbox" class="form-check-input menucheckbox" name="menuedit[{{$i}}]" value="1" {{ ( $menu->permission->editmenu == '1') ? 'checked' : '' }}>
                                            
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="menublock[{{$i}}]" value="0">
                                                <input type="checkbox" class="form-check-input menucheckbox" name="menublock[{{$i}}]" value="1" {{ ( $menu->permission->blockmenu == '1') ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="menudelete[{{$i}}]" value="0">
                                                <input type="checkbox" class="form-check-input menucheckbox" name="menudelete[{{$i}}]" value="1" {{ ( $menu->permission->deletemenu == '1') ? 'checked' : '' }}>
                                            </td>
                                    @else
                                    <td colspan="6"><strong>{{$menu->menu_name}}</strong></td>        
                                    @endif
                                    </tr>
                                     
                                        @foreach($menu->childs as $child) 
                                        @php  $i = $i+1; @endphp
                                        <tr>
                                            <td>    
                                            {{ $child->menu_name }}  <input type="hidden" name="menuid[]" value="{{$child->id}}">
                                            </td>                                        
                                            <td class="text-center">
                                                <input type="hidden" name="menuview[{{$i}}]" value="0">
                                                <input type="checkbox" class="form-check-input menucheckbox" name="menuview[{{$i}}]" value="1" {{ ($child->permission->viewmenu == '1') ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="menuadd[{{$i}}]" value="0">
                                                <input type="checkbox" class="form-check-input menucheckbox" name="menuadd[{{$i}}]" value="1" {{ ( $child->permission->addmenu == '1') ? 'checked' : '' }}>
                                                
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="menuedit[{{$i}}]" value="0">
                                                <input type="checkbox" class="form-check-input menucheckbox" name="menuedit[{{$i}}]" value="1" {{ ( $child->permission->editmenu == '1') ? 'checked' : '' }}>
                                            
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="menublock[{{$i}}]" value="0">
                                                <input type="checkbox" class="form-check-input menucheckbox" name="menublock[{{$i}}]" value="1" {{ ( $child->permission->blockmenu == '1') ? 'checked' : '' }}>
                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="menudelete[{{$i}}]" value="0">
                                                <input type="checkbox" class="form-check-input menucheckbox" name="menudelete[{{$i}}]" value="1" {{ ( $child->permission->deletemenu == '1') ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                        @endforeach
                                       
                                    @endforeach
                                        
                                    </tbody>
                                
                                </table>

                        </div>

                            </div>
                            <div class="card-footer mt-5" >
                            <a style="cursor:pointer;" class="btn btn-primary" onclick="formValidation();">Save</a>
                            <a style="cursor:pointer;" class="btn btn-default">Cancel</a>
                            </div>
                        </div>
                    </div>

</form>
                    <!-- FORM ENDS HERE -->
                    
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
<script>
document.getElementById('select-all').onclick = function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}
</script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<script src="{!! asset('assets/plugin/jquery/3.3.1/jquery.min.js') !!}"></script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
$('#department').on('change',function(e) {
    //alert('working');
var department_id = e.target.value;
$.ajax({
url:"{{ '../designation' }}",
type:"POST",
data: {
    department_id: department_id
},
beforeSend: function() {
            $('#designation').append('<option value="">- Loading -</option>');
},
success:function (data) {
    $('#designation').empty();
    $('#designation').append('<option value="">- Please Select -</option>');
    $.each(data,function(key, value){
    $('#designation').append('<option value="'+value.id+'">'+value.designation_name+'</option>');
})
}
})
});
});

// DOCUMENT ADDING STARTS HERE
    function documentsValidation() 
    {
    document.getElementById('documenttypealert').style.display = 'none'; 
    document.getElementById('documentnumberalert').style.display = 'none';
    document.getElementById('docexpirydatealert').style.display = 'none';

    if(document.addstaff.documenttype.value == ''){
        document.getElementById('documenttypealert').style.display = 'block'; 
        document.addstaff.documenttype.focus();  
        return false;     
    } else if(document.addstaff.documentnumber.value == ''){
        document.getElementById('documentnumberalert').style.display = 'block'; 
        document.addstaff.documentnumber.focus();  
        return false;     
    } else if(document.addstaff.docexpirydate.value == ''){
        document.getElementById('docexpirydatealert').style.display = 'block'; 
        document.addstaff.docexpirydate.focus();  
        return false;     
    } else if(document.getElementById('docattachement').files.length == 0 ){
                document.getElementById('docattachementalert').style.display = 'block';
                document.getElementById('docattachementalert').innerHTML = 'Select image';
                return false;
    } else {
                var fileInput = document.getElementById('docattachement');
                var filePath = fileInput.value;
                // Allowing file type
                var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                    if (!allowedExtensions.exec(filePath)) {
                        //alert('Invalid file type');
                        //fileInput.value = '';
                        document.getElementById('docattachementalert').style.display = 'block';
                        document.getElementById('docattachementalert').innerHTML = 'Upload only image';
                        return false;
                    } 
    }

    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    var files = $('#docattachement')[0].files;
    var dtype = $('#documenttype').val();
    var dnumber= $('#documentnumber').val();
    var dexpirydate= $('#docexpirydate').val();


    var fd = new FormData();
    
         // Append data 
         fd.append('file',files[0]);
         fd.append('_token',CSRF_TOKEN);
         fd.append('dtype',dtype);
         fd.append('dnumber',dnumber);
         fd.append('dexpirydate',dexpirydate);
    // var filename  = files[0];
         $.ajax({
            url:"{{ 'documentadd' }}",
           method: 'POST',
           data: fd,
           contentType: false,
           processData: false,
           dataType: 'json',
           success: function(response){
               //alert(response.success);
            if(response.success == 1){ // Uploaded successfully
                //alert(response.documenttype);
                $("#docattachement").val('');
                $("#documenttype").val('');
                $("#documentnumber").val('');
                $("#docexpirydate").val('');

                var tableRef = document.getElementById('tabledocumentlist').getElementsByTagName('tbody')[0];
                var nums = tableRef.rows.length;
                var counts = nums+1;
               
                //var nums = ((tableRef.rows.length)+1);
                var myHtmlContent='<tr><td>'+counts+'</td><td>'+response.documenttype+'</td><td>'+response.documentnumber+'</td><td>'+response.documentexpirydate+'</td><td class="text-center"><div class="btn btn-link btn-sm text-success tooltips"><i class="fa fa-eye"></i><span class="tooltiptext"><img src="{{ url("uploads") }}/'+response.documentfile+'" width="120" height="auto"></span></div></td><td class="text-center"><span class="btn btn-link btn-sm text-danger delete" onclick="return deletedoc(0,'+response.documentid+',this);"><i class="fa fa-trash"></i></span></td></tr>';
                
                var newRow = tableRef.insertRow(tableRef.rows.length);

                if(document.getElementById('tabledocumentlist').style.display == 'none'){
                document.getElementById('tabledocumentlist').style.display = 'block';
                    newRow.innerHTML = myHtmlContent;
                } else {
                    newRow.innerHTML = myHtmlContent;
                }
            }

           }, error: function(response){
              console.log("error : " + JSON.stringify(response) );
           }

        });

    
}
// DOCUMENTS ADDING ENDS HERE


// Delete 
function deletedoc(stid,deleteid,trid){
  //var el = this;
 
  // Delete id
 // var stid = '0';
 
//alert(stid+'->'+deleteid+''+trid); exit();
  var confirmalert = confirm("Are you sure to delete?");
  if (confirmalert == true) {
     // AJAX Request
     $.ajax({
        url:"{{ 'documentremove' }}",
       type: 'POST',
       data: { 
           id:deleteid,
           sid:stid
         },
       success: function(response){
           
        if(response.success == 1){      
            // HIDE TABLE IF NOT RECORDS FOUND STARTS HERE
           // alert('response->'+response.doccount);
            //exit();
            if(response.doccount == 0 ){
                document.getElementById('tabledocumentlist').style.display = 'none';
            }        
            // HIDE TABLE IF NOT RECORDS FOUND ENDS HERE
            // REMOVE CORRESPONDING COLUMN AFTER DELETE
                $tr= $(trid).closest("tr");
                $tr.find('td').fadeOut(700, function () {
                $tr.remove();    
            });

        }else{
        alert('Invalid ID.');
        }

       }
     });
  }

}
</script>


<script>
function formValidation() 
{
    var selected_data = 0;
    var chks = document.getElementsByClassName("menucheckbox");
        
    var emails = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    
    for (var i = 0; i < chks.length; i++) {
            if (chks[i].checked) {
                selected_data++;
            }
        }
    

    document.getElementById('firstnamealert').style.display = 'none';
    document.getElementById('lastnamealert').style.display = 'none';
    document.getElementById('departmentalert').style.display = 'none';
    document.getElementById('designationalert').style.display = 'none';
    document.getElementById('genderalert').style.display = 'none'; 
    document.getElementById('dobalert').style.display = 'none'; 
    document.getElementById('emailalert').style.display = 'none';
    document.getElementById('phonealert').style.display = 'none'; 
    document.getElementById('profilepicalert').style.display = 'none'; 
    document.getElementById('signaturealert').style.display = 'none';
    document.getElementById('permissionalert').style.display = 'none'; 
    
    
    if(document.addstaff.firstname.value == ''){
        document.getElementById('firstnamealert').style.display = 'block'; 
        document.addstaff.firstname.focus();  
        return false;     
    }else if(document.addstaff.lastname.value == ''){
        document.getElementById('lastnamealert').style.display = 'block'; 
        document.addstaff.lastname.focus();  
        return false;     
    }else if(document.addstaff.department.value == ''){
        document.getElementById('departmentalert').style.display = 'block'; 
        document.addstaff.department.focus();  
        return false;     
    }else if(document.addstaff.designation.value == ''){
        document.getElementById('designationalert').style.display = 'block'; 
        document.addstaff.designation.focus();  
        return false;     
    }else if(document.addstaff.gender.value == ''){
        document.getElementById('genderalert').style.display = 'block'; 
        document.addstaff.gender.focus();  
        return false;     
    }else if(document.addstaff.dateofbirth.value == ''){
        document.getElementById('dobalert').style.display = 'block'; 
        document.addstaff.dateofbirth.focus();  
        return false;     
    }else if(document.addstaff.email.value == ''){
        document.getElementById('emailalert').style.display = 'block'; 
        document.addstaff.email.focus();  
        return false;     
    }else if (!filter.test(emails.value)) {
            //document.addstaff.email.value=''
            document.getElementById('emailalert').style.display = 'block'; 
            document.getElementById("emailalert").innerHTML="Invalid email address! Please re-enter";
            document.addstaff.email.select();
            document.addstaff.email.focus();
            return false;
    }else if(document.addstaff.contactnumber.value == ''){
        document.getElementById('phonealert').style.display = 'block'; 
        document.addstaff.contactnumber.focus();  
        return false;     
    } else if(IsNumeric(document.addstaff.contactnumber.value)==false){
        document.getElementById('phonealert').style.display = 'block'; 
        document.getElementById("phonealert").innerHTML="Invalid contact number! Please re-enter";
        document.addstaff.contactnumber.select();
        document.addstaff.contactnumber.focus(); 
        return false;
    } else if (selected_data == 0) {
            //alert("Please select CheckBoxe(s).");
            document.addstaff.selectall.focus();
            //document.getElementById("documentlist").focus();
            
            document.getElementById('permissionalert').style.display = 'block';             
            return false;
    } 

    //alert(chks.length); 
    //exit();



document.addstaff.submit();
return true;
}

// PROFILE PICTURE VALIDATION STARTS HERE
function profilepicValidation() {
    var fileInput = document.getElementById('profilepic');
    var filePath = fileInput.value;
    // Allowing file type
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
                document.getElementById('profilepicalert').style.display = 'block'; 
                return false;
            } else {
                document.getElementById('profilepicalert').style.display = 'none'; 
            }
}
// PROFILE PICTURE VALIDATION ENDS HERE

// SIGNATURE VALIDATIONS STARTS HERE 
function signatureValidation() {
    var fileInput = document.getElementById('signature');
    var filePath = fileInput.value;
    // Allowing file type
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
               //alert('Invalid file type');
                //fileInput.value = '';
                document.getElementById('signaturealert').style.display = 'block'; 
                return false;
            } else {
                document.getElementById('signaturealert').style.display = 'none'; 
            }
}
//SIGNATURE VALIDATION ENDS HERE
// Documents details adding scripts starts here 




// DOCUMENT ATTACHMENT FILE STARTS HERE 
function documentAttachValidation() {
    var fileInput = document.getElementById('docattachement');
    var filePath = fileInput.value;
    // Allowing file type
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(filePath)) {
               //alert('Invalid file type');
                //fileInput.value = '';
                document.getElementById('docattachementalert').style.display = 'block'; 
                return false;
            } else {
                document.getElementById('docattachementalert').style.display = 'none'; 
            }
}
// DOCUMENT ATTACHMENT FILE ENDS HERE 




// NUMBER VALIDATION 

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

<script type='text/javascript' src="{!! asset('assets/bundles/jquery.inputmask.bundle.js') !!}"></script>
<script>
    var $j = jQuery.noConflict();    
    $j(document).ready(function(){
            $j('#dateofbirth').inputmask('99/99/9999',{placeholder:"dd/mm/yyyy"});
            $j('#docexpirydate').inputmask('99/99/9999',{placeholder:"dd/mm/yyyy"});
    });
</script>
<script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
@endsection
