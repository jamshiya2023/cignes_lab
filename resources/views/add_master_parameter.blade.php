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
<form class="row g-3" id="addparameter" name="addparameter" method="post" action="{{ route('parameter.add') }}">                            
@csrf 
<div id="parameterdiv">

                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header" style="padding-bottom:0px;">
                                            <h6 class="card-title m-0">Add Parameter</h6>
                                            
                                        </div>
                                       
                                        <div class="card-body">                                      	
                                            
                                            <div class="row g-4">
                                                <div class="col-sm-6">
                                                    <label class="form-label">Parameter Name <span class="red">*</span></label>
                                                    <input type="text" class="form-control form-control-lg" name="parametername" id="parametername" placeholder="Enter here">
                                                    <div class="alert-danger pt-1 pb-1 px-1 py-1" id="parameternamealert" style="display:none ;">Please enter parameter name</div>
                                                </div>
                                                <div class="col-sm-6 text-end">
                                                    <label class="form-label">Parameter Name (Arabic)</label>
                                                    <input type="text" dir="rtl" class="form-control form-control-lg" name="arabicparametername" id="arabicparametername">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">Short Code</label>
                                                    <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="parametershortcode" id="parametershortcode">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">LIS Parameter Code</label>
                                                    <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="parameterliscode" id="parameterliscode">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">Label / Heading</label><br />
                                                    <input type="radio" class="form-check-input" name="labelheading" value="yes"> 
                                                    <label for="finalresult">Yes</label>
                                                    <input type="radio" class="form-check-input" name="labelheading" value="no" checked> 
                                                    <label for="finalresult">No</label>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <label class="form-label mb-3">Final Result</label><br />
                                                    <input type="radio" class="form-check-input" name="finalresult" value="yes" checked> 
                                                    <label for="finalresult">Yes</label>
                                                    <input type="radio" class="form-check-input" name="finalresult" value="no" > 
                                                    <label for="finalresult">No</label>
                                                </div>
                                 
                                			</div>

                                            
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                    
                                <div class="col-xl-12 mt-2" >
                                    <div class="card">
                                        <div class="card-header" style="padding-bottom:0px;">
                                            <h6 class="card-title m-0">Parameter - Equipment - Method Mapping</h6>                                            
                                        </div>
                                       
                                        <div class="card-body">                                      	
                                            
                                            <div class="row g-4">
                                                <div class="col-sm-6">
                                                    <label class="form-label">Equipment / Machine</label>
                                                    <select name="equipment" id="equipment" placeholder="-- Please Select --">
                                                        <option value="">-- Please Select--</option>
                                                        @foreach ($machines as $equipment)
                                                        <option value="{{ $equipment->machineid }}">{{ $equipment->machine_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">Equipment Test ID</label>
                                                    <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="equipmenttestid" id="equipmenttestid" >
                                                </div>
                                                                                                
                                                <div class="col-sm-3">
                                                    <label class="form-label">Result Value</label>
                                                    <select class="form-select form-select-lg" name="resultvalue" id="resultvalue">
                                                        <option value="">-- Please Select --</option>
                                                        <option value="alphabets">Alphabets</option>
                                                        <option value="numbers">Numbers</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="form-label">Duration</label>
                                                    <input type="text" class="form-control form-control-lg" placeholder="Enter duration in hours" name="duration" id="duration">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">Equation</label>
                                                    <select class="form-select form-select-lg" name="equation" id="equation" >
                                                        <option value="">-- Please Select --</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label class="form-label">Method</label>
                                                    <select name="parametermethod" id="parametermethod" placeholder="-- Please Select --">
                                                        <option value="">-- Please Select --</option>
                                                        @foreach ($testmethods as $method)
                                                        <option value="{{ $method->testmethodid }}">{{ $method->testmethod }}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="form-label">Decimal Nos</label>
                                                    <select class="form-select form-select-lg" name="decimalnos" id="decimalnos" >
                                                        <option value="">-- Please Select --</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3">
                                                    <label class="form-label">Unit</label>
                                                    <select name="parameterunit" id="parameterunit"  placeholder="-- Please Select --">
                                                        <option value="">-- Please Select --</option>
                                                        @foreach ($units as $unit)
                                                        <option value="{{ $unit->unitid }}">{{ $unit->labunit_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                <div class="col-sm-12 pb-3 pt-2" style="background-color:#ebebeb">
                                                	<div class="row">  
                                                        <div class="col-sm-3">
                                                            <label class="form-label">Code</label>
                                                            <input type="text" class="form-control form-control-lg" placeholder="Enter here">
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="form-label">Unit</label>
                                                            <select class="form-select form-select-lg" >
                                                                <option value="">-- Please Select --</option>
                                                                @foreach ($units as $unitvalue)
                                                                <option value="{{ $unitvalue->unitid }}">{{ $unitvalue->labunit_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="form-label">Operator</label>
                                                            <select class="form-select form-select-lg" >
                                                                <option value="">-- Please Select --</option>
                                                                <option value="10">Plus</option>
                                                                <option value="20">Minus</option>
                                                                <option value="20">Multiple</option>
                                                                <option value="20">Divide</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="form-label">Value</label>
                                                            <input type="text" class="form-control form-control-lg" placeholder="Enter here">
                                                        </div>
                                                    </div>    
                                                </div>  
                                			</div>                                            
                                        </div>
                                        
                                        <div class="card-footer text-end">
                                            <a href="#" class="btn btn-primary disabled">Previous</a>
	                                        <a class="btn btn-primary" onclick="next();">Next</a>
                                        </div>
                                        
                                    </div>
                                </div> 

</div>
 
                               
                                
                                <div class="col-xl-12" id="referencerangediv" style="display:none;">
                                    <div class="card">
                                        <div class="card-header" style="padding-bottom:0px;">
                                            <h6 class="card-title m-0">Reference Range</h6>                                            
                                        </div>
                                        
                                        
                                       
                                        <div class="card-body"> 
                                              <div class="col-sm-12">
                                              	<div class="row"> 
<table class="table table-bordered" style="margin-bottom:0px;">
  <thead>
  <tr>
  <th colspan="6" class="text-center">Age Limit</th>
  <th colspan="9" class="text-center">Normal Value</th>
  
  
  </tr>
    <tr>
       <th colspan="3" style="width:100px;" class="text-center">Lower </th>
       <th colspan="3" style="width:100px;" class="text-center">Upper</th>
       <th colspan="2" style="width:200px;" class="text-center">Male </th>
       <th style="width:50px;" class="text-center">Min</th>
       <th style="width:50px;" class="text-center">Max</th>
       <th colspan="2" style="width:200px;" class="text-center">Female</th>
       <th style="width:50px;" class="text-center">Min</th>
       <th style="width:50px;" class="text-center">Max</th>
       <th style="width:50px;" class="text-center">&nbsp;</th>
    </tr>
    <tr>    	
    	<th style="width:80px; background-color: #daeef3;color: black; text-align: center;">
        <select style="padding:5px 2px;" class="form-select form-select-lg" name="lowertype" id="lowertype">
            <option value=">="> >= </option>
        </select>
        </th>
		<th style="width: 70px; background-color: #daeef3;color: black; text-align: center;">
        	<input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="lowervalue" id="lowervalue">
        </th>
  		<th style="width: 90px; background-color: #daeef3;color: black; text-align: center;">
        <select style="padding:5px 2px;" class="form-select form-select-lg" name="lowerchronological" id="lowerchronological">
            <option value="Days"> Days </option>
            <option value="Months"> Months </option>
            <option value="Years"> Years </option>
        </select>
        </th>
        
  		<th style="width: 80px; background-color: #daeef3;color: black; text-align: center;">
        <select style="padding:5px 2px;" class="form-select form-select-lg" name="highertype" id="highertype">
        <option value="<"> < </option>
        </select>
        </th>
		<th style="width: 70px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="highervalue" id="highervalue">
        </th>
  		<th style="width: 90px; background-color: #daeef3;color: black; text-align: center;">
        <select style="padding:5px 2px;" class="form-select form-select-lg" name="higherchronological" id="higherchronological">
        <option value="Days"> Days </option>
        <option value="Months"> Months </option>
        <option value="Years"> Years </option>
        </select>
        </th>
        
        <th colspan="2" style="width:100px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="malevalue" id="malevalue"></th>
		<th style="width: 70px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="minmalevalue" id="minmalevalue"></th>
        <th style="width: 70px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="maxmalevalue" id="maxmalevalue">
        </th>
        
  		<th colspan="2" style="width: 100px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="femalevalue" id="femalevalue"></th>
        <th style="width: 70px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="minfemalevalue" id="minfemalevalue"></th>
        <th style="width: 70px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="maxfemalevalue" id="maxfemalevalue"></th>
        <th style="width:100px; background-color: #daeef3;color: black; text-align: center; padding-bottom:15px;"><a onclick="addreferencerange();" class="btn-sm btn-dark" style="text-transform:capitalize; font-weight:600; cursor:pointer;">Add More</a></th>
  		
    </tr>
  </thead>
</table> 
<div class="alert-danger pt-1 pb-1 px-1 py-1" id="referencerangealert" style="display:none;" >Please add reference range</div>


<table class="table table-bordered mt-3" id="tblreferencelist" style="display:none;">
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
       <th style="width:100px;" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody> </tbody>
</table>                                            
                                              	</div>
                                              </div>  
                                              

                                                                                     
                                        </div>
                                        
                                        <div class="card-footer text-end">
                                        	<a class="btn btn-primary" onclick="previous();">Previous</a>
                                            <a class="btn btn-primary" onclick="finalsave();">Save</a>
                                        </div>
                                        
                                    </div>
                                </div>
                        </div>
</form>              
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
<link rel="stylesheet" href="{!! asset('assets/css/select2.min.css') !!}">
<script src="{!! asset('assets/js/standalone/select2.min.js') !!}"></script>
<script type="text/javascript">
var jq = jQuery.noConflict();
jq(document).ready(function () {
    jq("#equipment,#parametermethod,#parameterunit").select2();
  });
</script>


    <script type="text/javascript">
function next() {
    document.getElementById('parameternamealert').style.display = 'none'; 
    if(document.addparameter.parametername.value == ''){
		document.getElementById('parameternamealert').style.display = 'block'; 
		document.addparameter.parametername.focus(); 
        return false;
	}

	$('#parameterdiv').hide();
	$('#referencerangediv').toggle(300);

}
function previous() {
	document.getElementById('referencerangealert').style.display = 'none';
	$('#referencerangediv').hide();
	$('#parameterdiv').toggle(300);
}

function addreferencerange(){
    document.getElementById('referencerangealert').style.display = 'none';	
	document.getElementById("lowertype").style.borderColor = "#bfbfbf";
	document.getElementById("lowervalue").style.borderColor = "#bfbfbf";
	document.getElementById("lowerchronological").style.borderColor = "#bfbfbf";
	document.getElementById("highertype").style.borderColor = "#bfbfbf";	
	document.getElementById("highervalue").style.borderColor = "#bfbfbf";
	document.getElementById("higherchronological").style.borderColor = "#bfbfbf";
	document.getElementById("malevalue").style.borderColor = "#bfbfbf";
	document.getElementById("minmalevalue").style.borderColor = "#bfbfbf";
	document.getElementById("maxmalevalue").style.borderColor = "#bfbfbf";
	document.getElementById("femalevalue").style.borderColor = "#bfbfbf";
	document.getElementById("minfemalevalue").style.borderColor = "#bfbfbf";
	document.getElementById("maxfemalevalue").style.borderColor = "#bfbfbf";
	
	
	if(document.addparameter.lowertype.value == ''){
		document.getElementById("lowertype").style.borderColor = "#f00";
		document.addparameter.lowertype.focus(); 
        return false;
	}
	if(document.addparameter.lowervalue.value == ''){
		document.getElementById("lowervalue").style.borderColor = "#f00";
		document.addparameter.lowervalue.focus(); 
        return false;
	}
	
	if(document.addparameter.lowerchronological.value == ''){
		document.getElementById("lowerchronological").style.borderColor = "#f00";
		document.addparameter.lowervalue.focus(); 
        return false;
	}
	
	if(document.addparameter.highertype.value == ''){
		document.getElementById("highertype").style.borderColor = "#f00";
		document.addparameter.highertype.focus(); 
        return false;
	}
	if(document.addparameter.highervalue.value == ''){
		document.getElementById("highervalue").style.borderColor = "#f00";
		document.addparameter.highervalue.focus(); 
        return false;
	}
	if(document.addparameter.higherchronological.value == ''){
		document.getElementById("higherchronological").style.borderColor = "#f00";
		document.addparameter.higherchronological.focus(); 
        return false;
	}
	if(document.addparameter.malevalue.value == ''){
		document.getElementById("malevalue").style.borderColor = "#f00";
		document.addparameter.malevalue.focus(); 
        return false;
	}
	if(document.addparameter.minmalevalue.value == ''){
		document.getElementById("minmalevalue").style.borderColor = "#f00";
		document.addparameter.minmalevalue.focus(); 
        return false;
	}
	if(document.addparameter.maxmalevalue.value == ''){
		document.getElementById("maxmalevalue").style.borderColor = "#f00";
		document.addparameter.maxmalevalue.focus(); 
        return false;
	}
	if(document.addparameter.femalevalue.value == ''){
		document.getElementById("femalevalue").style.borderColor = "#f00";
		document.addparameter.femalevalue.focus(); 
        return false;
	}
	if(document.addparameter.minfemalevalue.value == ''){
		document.getElementById("minfemalevalue").style.borderColor = "#f00";
		document.addparameter.minfemalevalue.focus(); 
        return false;
	}
	if(document.addparameter.maxfemalevalue.value == ''){
		document.getElementById("maxfemalevalue").style.borderColor = "#f00";
		document.addparameter.maxfemalevalue.focus(); 
        return false;
	}
	
	var lowertype = $("#lowertype").val();
	var lowervalue = $("#lowervalue").val();
	var lowerchronological = $("#lowerchronological").val();
	var highertype = $("#highertype").val();
	var highervalue = $("#highervalue").val();
	var higherchronological = $("#higherchronological").val();
	var malevalue = $("#malevalue").val();
	var minmalevalue = $("#minmalevalue").val();
	var maxmalevalue = $("#maxmalevalue").val();
	var femalevalue = $("#femalevalue").val();
	var minfemalevalue = $("#minfemalevalue").val();
	var maxfemalevalue = $("#maxfemalevalue").val();

	var tablereference = document.getElementById('tblreferencelist').getElementsByTagName('tbody')[0];
	var numrows = tablereference.rows.length;
	var myHtmlContent= '<tr><td colspan="3" class="text-center" valign="middle">'+lowertype+' '+lowervalue+' '+lowerchronological+'<input type="hidden" name="lowertypehidden[]" value="'+lowertype+'"><input type="hidden" name="lowervaluehidden[]" value="'+lowervalue+'"><input type="hidden" name="lowerchronologicalhidden[]" value="'+lowerchronological+'"></td><td colspan="3" class="text-center" valign="middle">'+highertype+' '+highervalue+' '+higherchronological+'<input type="hidden" name="highertypehidden[]" value="'+highertype+'"><input type="hidden" name="highervaluehidden[]" value="'+highervalue+'"><input type="hidden" name="higherchronologicalhidden[]" value="'+higherchronological+'"></td><td colspan="2" class="text-center" valign="middle">'+malevalue+'<input type="hidden" name="malevaluehidden[]" value="'+malevalue+'"></td><td valign="middle" class="text-center">'+minmalevalue+'<input type="hidden" name="minmalevaluehidden[]" value="'+minmalevalue+'"></td><td valign="middle" class="text-center">'+maxmalevalue+'<input type="hidden" name="maxmalevaluehidden[]" value="'+maxmalevalue+'"></td><td colspan="2" class="text-center" valign="middle">'+femalevalue+'<input type="hidden" name="femalevaluehidden[]" value="'+femalevalue+'"></td><td class="text-center" valign="middle">'+minfemalevalue+'<input type="hidden" name="minfemalevaluehidden[]" value="'+minfemalevalue+'"></td><td class="text-center" valign="middle">'+maxfemalevalue+'<input type="hidden" name="maxfemalevaluehidden[]" value="'+maxfemalevalue+'"></td><td class="text-center"><a style="cursor:pointer" class="btn btn-link btn-sm text-danger" onclick="remove(this)"><i class="fa fa-trash"></i></a></td></tr>';
	var newRow = tablereference.insertRow(tablereference.rows.length);
    

    if(document.getElementById('tblreferencelist').style.display == 'none'){
        document.getElementById('tblreferencelist').style.display = 'block';
        newRow.innerHTML = myHtmlContent;
        
        $("#lowertype").val(">=").attr("selected","selected");
	    $("#lowervalue").val('');
        $("#lowerchronological").val("Days").attr("selected","selected");
        
        $("#highertype").val("<").attr("selected","selected"); 
	    $("#highervalue").val('');
	    $("#higherchronological").val("Days").attr("selected","selected");
	    
        $("#malevalue").val('');
	    $("#minmalevalue").val('');
	    $("#maxmalevalue").val('');
	    $("#femalevalue").val('');
	    $("#minfemalevalue").val('');
	    $("#maxfemalevalue").val('');
    } else {
        newRow.innerHTML = myHtmlContent;
        $("#lowertype").val(">=").attr("selected","selected");
	    $("#lowervalue").val('');
        $("#lowerchronological").val("Days").attr("selected","selected");
        
        $("#highertype").val("<").attr("selected","selected"); 
	    $("#highervalue").val('');
	    $("#higherchronological").val("Days").attr("selected","selected");
	    
        $("#malevalue").val('');
	    $("#minmalevalue").val('');
	    $("#maxmalevalue").val('');
	    $("#femalevalue").val('');
	    $("#minfemalevalue").val('');
	    $("#maxfemalevalue").val('');
    }
}

function remove(r){
    var referencetbl = document.getElementById('tblreferencelist').getElementsByTagName('tbody')[0];
    var tblrows = referencetbl.rows.length;    
    var result = confirm("Are sure you want to delete?");
    if (result) {
        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("tblreferencelist").deleteRow(i);
        if(tblrows == '1') {
            document.getElementById('tblreferencelist').style.display = 'none';            
        }
    }
}


function finalsave(){
	var referencerangetable = document.getElementById('tblreferencelist').getElementsByTagName('tbody')[0];
    var reftbltr = referencerangetable.rows.length;
    //alert(reftbltr);
	if(reftbltr == 0){
		document.getElementById('referencerangealert').style.display = 'block';	
        return false;
	}
    document.addparameter.submit();

}
/*
    $('#add-modal-close-x, #add-modal-close').click(function() {
        $('#parametername').val('');
        $('#parameternamealert').hide();
        $('#add-sample-type').modal('hide');
    });

    $('#edit-modal-close-x, #edit-modal-close').click(function() {
        $('#parameternamealertedit').hide();
        $('#edit-sample-type').modal('hide');
    });
*/

    </script>
      
<script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
@endsection
