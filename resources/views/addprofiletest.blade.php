@extends('layout.maintemplate')
@section('content')
<style>
.red {
    color: #FF0000;
} 
</style>
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">

                <div class="row g-4">
                    <div class="col-lg-12 col-md-12 col-sm-12">
<form class="row g-3" id="addprofiletestform" name="addprofiletestform" method="post" action="{{ route('profiletest.add') }}">                               
@csrf
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Add Profile Test</h6> <h6 style="color: red;">* (Mandatory field)</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-sm-3">
                                        <label class="form-label">Profile Name<span class="red"> *</span></label>
                                        <input type="text" class="form-control form-control-lg" name="profilename">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="profilenamealert" style="display:none ;">Please enter profile name</div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="form-label">Price (Primary)<span class="red"> *</span></label>
                                        <input type="text" class="form-control form-control-lg" name="primaryprice" id="primaryprice" value="" >
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="primarypricealert" style="display:none ;">Please enter primary price</div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="form-label">Price (Secondary)</label>
                                        <input type="text" class="form-control form-control-lg"  name="secondaryprice" id="secondaryprice" value="">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="secondarypricealert" style="display:none ;"></div>
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="form-label">Tax<span class="red"> *</span></label>
                                        <select id="taxname" class="form-select form-select-lg" tabindex="-98" name="taxname">
                                            <option value="">-- Please Select --</option>
                                            @foreach ($taxes as $tax)
                                            <option value="{{$tax->id}}">{{$tax->taxname}}</option>
                                            @endforeach
                                        </select>                                        
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="taxalert" style="display:none ;">Please select tax</div>
                                        
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="form-label">Tax Method<span class="red"> *</span></label>
                                        <select id="tax" class="form-select form-select-lg" tabindex="-98" name="taxmethod">
                                            <option value="">-- Please Select --</option>
                                            
                                            <option value="exclusive">Exclusive</option>
                                            <option value="inclusive">Inclusive</option>
                                            
                                        </select>                                        
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="taxmethodalert" style="display:none ;">Please select tax method</div>
                                        
                                    </div>
                                </div>




                                
                            </div>

                            <div class="card-body">
                                <div class="row g-4" id="singletestcheckbox">
                                   
                                    <label class="form-label mb-1">Experimentation</label>
                                    <label style="margin-top:0px!important;"><div class="alert-danger pt-1 pb-1 px-1 py-1" id="singletestalert" style="display:none; width:50%">Please select any single test </div></label>
                                        @foreach ($singletest as $test)
                                        <div class="col-sm-2 mt-2">
                                        <input type="checkbox" class="singletest" name="singletest[]" value="{{$test->id}}"> {{$test->testname}}
                                        </div>
                                        @endforeach   
                                        
                                       
                                    </div>     
                                        
                                        <div class="row g-4 ">
                                        <div class="col-sm-2" style="margin-top:50px;">
                                            <!--<a style="cursor:pointer;" class="btn btn-primary badge" data-bs-toggle="modal" data-bs-target="#addnewtest">+ Add New Test</a> -->
                                        </div>
                                        </div>
                                
                            </div>

                            



                            <div class="card-footer">

                            <a style="cursor:pointer;" class="btn btn-primary" onclick="return formValidation();">Save</a>
                                <button type="submit" class="btn btn-default">Cancel</button>


                            </div>


                        </div>



                        <div class="modal fade" id="addnewtest" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Additional Test to Profile</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-between mb-3">
                                                <div class="form-check form-check-inline">
                                                    
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                    Test Name                                                        
                                                    </label>
                                                    <input type="text" class="form-control form-control-lg" name="singletestname" id="singletestname" >
                                                    <div class="alert-danger pt-1 pb-1 px-1 py-1" id="singletestnamealert" style="display:none ;">Please enter test name</div>
                                                    </div>
                                                </div>



                                
                                            <div class="d-flex justify-content-between mb-3">
                                                <div class="form-check form-check-inline">
                                                    
                                                <a style="cursor:pointer;" class="btn btn-primary" onclick="validationsingle();">Save</a>
                                                

                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
</form>





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
    <script>
    // ADD PROFILE TEST FORM VALIDATION STARTS HERE
function validationsingle(){

    // alert('working'); exit();
    document.getElementById('singletestnamealert').style.display = 'none';

    
    if(document.addprofiletestform.singletestname.value == ''){
        document.getElementById('singletestnamealert').style.display = 'block'; 
        document.addprofiletestform.singletestname.focus();  
        return false;     
    }
    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    var singletestname = $('#singletestname').val();
    //alert(CSRF_TOKEN);
    var singletest = new FormData();

    singletest.append('_token',CSRF_TOKEN);
    singletest.append('singletestname',singletestname);  

    
// var filename  = files[0];
// var filename  = files[0];

$.ajax({
           url:"{{ 'additionaltestadd' }}", 
           method: 'POST',
           data: singletest,
           contentType: false,
           processData: false,
           dataType: 'json',
           success: function(response){
 //alert('id->'+response.sid+'name->'+response.singletestname);exit();
            if(response.success == 1){ // Uploaded successfully
            //alert($("#singletestcheckbox"));
                var myHtmlContent='<div class="col-sm-2 mt-2"><input type="checkbox" name="singletest[]" value="'+response.sid+'" checked> '+response.singletestname+' </div>';
                //
                $('#addnewtest').modal('hide');
             $("#singletestcheckbox").append(myHtmlContent);
               //$( "#singletestcheckbox" ).append( "<p>Test</p>" );
               //alert(myHtmlContent);
               


            }
           }

        }); 
        
    }
function formValidation() 
{

    //alert('working'); exit();
var singletestcheckbox = 0;
var chks = document.getElementsByClassName('singletest');

for(var i=0; i < chks.length; i++){
    if(chks[i].checked){
        singletestcheckbox++;
    }


}

    document.getElementById('profilenamealert').style.display = 'none';
    document.getElementById('primarypricealert').style.display = 'none'; 
    document.getElementById('secondarypricealert').style.display = 'none';
    document.getElementById('singletestalert').style.display = 'none';
    document.getElementById('taxalert').style.display = 'none'; 
    document.getElementById('taxmethodalert').style.display = 'none'; 

    if(document.addprofiletestform.profilename.value == ''){
        document.getElementById('profilenamealert').style.display = 'block'; 
        document.addprofiletestform.profilename.focus();  
        return false;     
    }
    else if(document.addprofiletestform.primaryprice.value == ''){
        document.getElementById('primarypricealert').style.display = 'block'; 
        document.addprofiletestform.primaryprice.focus();  
        return false;     
    } else if(IsNumeric(document.addprofiletestform.primaryprice.value)==false){
        document.getElementById('primarypricealert').style.display = 'block'; 
        document.getElementById("primarypricealert").innerHTML="Invalid primary price! Please re-enter";
        document.addprofiletestform.primaryprice.select();
        document.addprofiletestform.primaryprice.focus(); 
        return false;
    } else if(document.addprofiletestform.taxname.value == ''){
        document.getElementById('taxalert').style.display = 'block'; 
        document.addprofiletestform.taxname.focus();  
        return false;     
    } else if(document.addprofiletestform.taxmethod.value == ''){
        document.getElementById('taxmethodalert').style.display = 'block'; 
        document.addprofiletestform.taxmethod.focus();  
        return false;     
    } else if(singletestcheckbox == 0){
        document.getElementById('singletestalert').style.display = 'block';       
        return false;
    } else if(document.addprofiletestform.secondaryprice.value !=''){
    
            if(IsNumeric(document.addprofiletestform.secondaryprice.value)==false){
                document.getElementById('secondarypricealert').style.display = 'block'; 
                document.getElementById("secondarypricealert").innerHTML="Invalid secondary price! Please re-enter";
                document.addprofiletestform.secondaryprice.select();
                document.addprofiletestform.secondaryprice.focus(); 
                return false;
            }
    } 


    document.addprofiletestform.submit();    
return true;
}

// ADD PROFILE TEST FORM VALIDATION ENDS HERE
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
    
@endsection
