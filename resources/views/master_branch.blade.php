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
                                            <h6 class="card-title m-0">Branches</h6><a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-sample-type">Add Branch</a>
                                            
                                        </div>
                                        @if(\Session::get('success'))
                                        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                            {{ \Session::get('success') }}
                                        </div>
                                        @endif
                                        <div class="card-body">
                                        
                                            <table id="tblbranch" class="table card-table table-hover align-middle mb-0" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width:3%">#</th>
                                                        <th style="width:50%">Branch</th>
                                                        <th style="width:40%">VAT Number</th>

                                                        <th style="width:7%"class="text-center">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($branchs as $key => $value)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{ $value->branchname }}</td>
                                                        <td>{{ $value->vatnumber }}</td>
                                                        <td class="text-center">
                                                            <a  onclick="editview('{{ $value->id }}');"class="btn btn-link btn-sm text-secondry">
                                                                <i class="fa fa-edit" style="color:#555CB8;"></i>
                                                            </a>

                                                            <?php if($value->status =='1') { ?> 
                                                            <a href="{{ 'block-branch/'.$value->id }}"  onclick="return confirm('Do you want to block this branch?')" class="btn btn-link btn-sm text-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Active" aria-label="Active">
                                                                <i class="fa fa-ban" style="color:#198754;"></i>                                                                
                                                            </a>
                                                            <?php } else { ?>
                                                                <a href="{{ 'unblock-branch/'.$value->id }}" onclick="return confirm('Do you want to unblock this branch?')" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Blocked" aria-label="Blocked">
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
                            <form class="row g-3" id="addbranch" name="addbranch" method="post" enctype="multipart/form-data" action="{{ route('branch.add') }}">                            
                                @csrf
                                <div class="modal fade" id="add-sample-type" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Branch</h5>
                                                <button type="button" id="add-modal-close-x" class="btn-close"></button>
                                            </div>
                                            <div class="modal-body custom_scroll">
                                                <div class="row g-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Branch Name <span class="red">*</span></label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="branchname" id="branchname" >
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="branchnamealert" style="display:none ;">Please enter branch name</div>                                                
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <label class="form-label">VAT Number <span class="red">*</span></label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="vatnumber" id="vatnumber" >
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="vatnumberalert" style="display:none ;">Please enter VAT number</div>                                                
                                                    </div>

                                                </div> 
                                                <div class="row g-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">CR Number</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="crnumber" id="crnumber" >
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Branch Logo</label>
                                                        <input type="file" class="form-control form-control-lg" name="branchlogo" id="branchlogo" onchange="return logoValidation();">
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="branchlogoalert" style="display:none ;"> </div>                                                
                                                    </div>
                                                </div> 

                                                <div class="row g-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Address 1</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="addone" id="addone" >
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Address 2</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="addtwo" id="addtwo" >
                                                    </div>
                                                </div>

                                                <div class="row g-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Country</label>
                                                        <select class="form-select form-select-lg" name="countryname" id="countryname" onchange="loadstate(this.value)">
                                                            <option value="">-- Please Select --</option>
                                                            @foreach ($countries as $value)
                                                            <option value="{{ $value->id }}">{{ $value->country_name }}</option>  
                                                            @endforeach                                         
                                                        </select>
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="countryalert" style="display:none ;">Please select country </div>                                                
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <label class="form-label">State</label>
                                                        <select class="form-select form-select-lg" name="statename" id="statename" onchange="loadcity(this.value)">
                                                        <option value="">-- Please Select --</option>
                                                        </select>
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="statealert" style="display:none ;">Please select state </div>                                                
                                                    </div>
                                                </div>

                                                <div class="row g-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">City</label>
                                                        <select class="form-select form-select-lg" name="cityname" id="cityname">
                                                        <option value="">-- Please Select --</option>
                                                        </select>
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="cityalert" style="display:none ;">Please select city</div>                                                
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Postal Code</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="postalcode" id="postalcode" >
                                                                                                      
                                                    </div>
                                                </div>

                                                <div class="row g-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Contact Number</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="contactnumber" id="contactnumber" >
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="contactnumberalert" style="display:none ;"></div>                                                
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="email" id="email" >
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="emailalert" style="display:none ;"></div>                                                
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <a class="btn btn-primary" onclick="addbranchValidation();">Save</a>
                                                <button type="button" id="add-modal-close"class="btn btn-secondary">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- ADD MODAL ENDS HERE -->


                            <!-- EDIT POPUP STARTS HERE -->
                            <form class="row g-3" name="editbranch" method="post" enctype="multipart/form-data" action="{{ route('branch.edit') }}">                            
                                @csrf
                                <div class="modal fade" id="edit-sample-type" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Branch</h5>
                                                <button type="button" id="edit-modal-close-x" class="btn-close"></button>
                                            </div>
                                            <div class="modal-body custom_scroll">
                                                <div class="row g-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Branch Name <span class="red">*</span></label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="branchnameedit" id="branchnameedit" >
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="branchnameeditalert" style="display:none ;">Please enter branch name</div>                                                
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <label class="form-label">VAT Number <span class="red">*</span></label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="vatnumberedit" id="vatnumberedit" >
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="vatnumbereditalert" style="display:none ;">Please enter VAT number</div>                                                
                                                    </div>

                                                </div> 
                                                <div class="row g-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">CR Number</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="crnumberedit" id="crnumberedit" >
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Branch Logo <span id="logoview"></span></label>
                                                        <input type="file" class="form-control form-control-lg" name="branchlogoedit" id="branchlogoedit" onchange="return logoValidation();">
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="branchlogoeditalert" style="display:none ;"> </div>                                                
                                                    </div>
                                                </div> 

                                                <div class="row g-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Address 1</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="addoneedit" id="addoneedit" >
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Address 2</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="addtwoedit" id="addtwoedit" >
                                                    </div>
                                                </div>

                                                <div class="row g-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Country</label>
                                                        <select class="form-select form-select-lg" name="countrynameedit" id="countrynameedit" onchange="loadstateedit(this.value)">
                                                        </select>
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="countryeditalert" style="display:none ;">Please select country </div>                                                
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <label class="form-label">State</label>
                                                        <select class="form-select form-select-lg" name="statenameedit" id="statenameedit" onchange="loadcityedit(this.value)">
                                                        <option value="">-- Please Select --</option>
                                                        </select>
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="stateeditalert" style="display:none ;">Please select state </div>                                                
                                                    </div>
                                                </div>

                                                <div class="row g-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">City</label>
                                                        <select class="form-select form-select-lg" name="citynameedit" id="citynameedit">
                                                        <option value="">-- Please Select --</option>
                                                        </select>
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="cityeditalert" style="display:none ;">Please select city</div>                                                
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Postal Code</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="postalcodeedit" id="postalcodeedit" >
                                                                                                      
                                                    </div>
                                                </div>

                                                <div class="row g-4 mb-2">
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Contact Number</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="contactnumberedit" id="contactnumberedit" >
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="contactnumbereditalert" style="display:none ;"></div>                                                
                                                    </div>
                                                    
                                                    <div class="col-sm-6">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="emailedit" id="emailedit" >
                                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="emaileditalert" style="display:none ;"></div>                                                
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" class="form-control form-control-lg" name="hiddenid" id="hiddenid"  >
                                                <a class="btn btn-primary" onclick="editbranchValidation();">Save</a>
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
        // DOCUMENT ATTACHMENT FILE STARTS HERE 
        function logoValidation() {
        
        var fileInput = document.getElementById('branchlogo');
        var filePath = fileInput.value;
        // Allowing file type
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                if (!allowedExtensions.exec(filePath)) {
                    //alert('Invalid file type');
                    //fileInput.value = '';
                    document.getElementById('branchlogoalert').style.display = 'block'; 
                    document.getElementById('branchlogoalert').innerHTML = 'Upload only image';
                    return false;
                } else {
                    document.getElementById('branchlogoalert').style.display = 'none'; 
                }
        }
        // DOCUMENT ATTACHMENT FILE ENDS HERE


    $('#add-modal-close-x, #add-modal-close').click(function() {
        $('#branchname').val('');
        $('#branchnamealert').hide();
        $('#add-sample-type').modal('hide');
    });

    $('#edit-modal-close-x, #edit-modal-close').click(function() {
        $('#branchnamealertedit').hide();
        $('#edit-sample-type').modal('hide');
    });

   
    function addbranchValidation() {
        document.getElementById('branchnamealert').style.display = 'none';
        document.getElementById('vatnumberalert').style.display = 'none';
        document.getElementById('emailalert').style.display = 'none'; 
        document.getElementById('contactnumberalert').style.display = 'none';
        document.getElementById('statealert').style.display = 'none'; 
        document.getElementById('cityalert').style.display = 'none';
        if(document.addbranch.branchname.value == ''){
            document.getElementById('branchnamealert').style.display = 'block';  
            document.addbranch.branchname.focus(); 
            return false;     
        }
        if(document.addbranch.vatnumber.value == ''){
            document.getElementById('vatnumberalert').style.display = 'block';  
            document.addbranch.vatnumber.focus(); 
            return false;     
        }
        if(document.addbranch.countryname.value != ''){
            if(document.addbranch.statename.value == ''){
                document.getElementById('statealert').style.display = 'block';  
                document.addbranch.statename.focus(); 
                return false;
            }
            if(document.addbranch.cityname.value == ''){
                document.getElementById('cityalert').style.display = 'block';  
                document.addbranch.cityname.focus(); 
                return false;
            } 
        }
        if(document.addbranch.contactnumber.value !=''){
            if(IsNumeric(document.addbranch.contactnumber.value)==false){
                document.getElementById('contactnumberalert').style.display = 'block'; 
                document.getElementById("contactnumberalert").innerHTML="Invalid contact number! Please re-enter";
                document.addbranch.contactnumber.select();
                document.addbranch.contactnumber.focus(); 
                return false;
            }
        }
        if(document.addbranch.email.value != '') {
            var emails = document.getElementById('email');
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(emails.value)) {
                document.getElementById('emailalert').style.display = 'block'; 
                document.getElementById("emailalert").innerHTML="Invalid email address! Please re-enter";
                document.addbranch.email.select();
                document.addbranch.email.focus();
                return false;
            } 
        }

        

    document.addbranch.submit();
    return true;
    }
    
    function editview(id){
        var token = $('input[name="_token"]').val();
        var brname;
        var brvatnumber;
        var brcrnumber;
        var brbranchlogo;
        var brcontactnumber;
        var bremail;
        var braddressone;
        var braddresstwo;
        var brpincode;
        var brid;
        var brcountry;
        var brstate;
        var brcity;
        var countryhtml = "";
        var statehtml = "";
        var cityhtml = "";

        $.ajax({
            url:"{{ 'view-branch' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            success: function(response){
                countryhtml = '<option value="">- Please Select -</option>';
                $.each(response.countries, function( index, country) {                 
                    countryhtml += '<option value="'+country.id+'">'+country.country_name+'</option>';   
                });
                $('#countrynameedit').html(countryhtml); 

                statehtml = '<option value="">- Please Select -</option>';
                $.each(response.states, function( index, state) {                 
                    statehtml += '<option value="'+state.statid+'">'+state.statesname+'</option>';   
                });
                $('#statenameedit').html(statehtml); 

                cityhtml = '<option value="">- Please Select -</option>';
                $.each(response.cities, function( index, city) {                 
                    cityhtml += '<option value="'+city.ctyid+'">'+city.citiesname+'</option>';   
                });
                $('#citynameedit').html(cityhtml); 

                $.each(response.branches, function( index, branch) {                 
                    brname = branch.branchname;
                    brvatnumber = branch.vatnumber;
                    brcrnumber = branch.crnumber;
                    brbranchlogo = branch.branchlogo;
                    brcontactnumber = branch.contactnumber;
                    bremail = branch.email;
                    braddressone = branch.address_one;
                    braddresstwo = branch.address_two;
                    brpincode = branch.pincode;
                    brid = branch.id;
                    brcountry= branch.countryid;
                    brstate = branch.stateid;
                    brcity = branch.cityid;
                }); 
                
                $('#branchnameedit').val(brname);
                $('#vatnumberedit').val(brvatnumber);
                $('#crnumberedit').val(brcrnumber);
                $('#logoview').html('<div class="btn btn-link btn-sm text-success tooltips text-end">View Logo<span class="tooltiptext"><img src="{{ url("uploads") }}/'+brbranchlogo+'" width="120" height="auto"></span></div>');
                $('#contactnumberedit').val(brcontactnumber);
                $('#emailedit').val(bremail);
                $('#addoneedit').val(braddressone);
                $('#addtwoedit').val(braddresstwo);
                $('#postalcodeedit').val(brpincode);
                $('#hiddenid').val(brid);
                $('#countrynameedit option[value="'+brcountry+'"]').attr("selected", "selected");
                $('#statenameedit option[value="'+brstate+'"]').attr("selected", "selected");
                $('#citynameedit option[value="'+brcity+'"]').attr("selected", "selected");
                $('#edit-sample-type').modal('show');
            }
        });

    }

    function editbranchValidation() {
        document.getElementById('branchnameeditalert').style.display = 'none';
        document.getElementById('vatnumbereditalert').style.display = 'none';
        document.getElementById('emaileditalert').style.display = 'none'; 
        document.getElementById('contactnumbereditalert').style.display = 'none';
        document.getElementById('stateeditalert').style.display = 'none'; 
        document.getElementById('cityeditalert').style.display = 'none';
        if(document.editbranch.branchnameedit.value == ''){
            document.getElementById('branchnameeditalert').style.display = 'block';  
            document.editbranch.branchnameedit.focus(); 
            return false;     
        }
        if(document.editbranch.vatnumberedit.value == ''){
            document.getElementById('vatnumbereditalert').style.display = 'block';  
            document.editbranch.vatnumberedit.focus(); 
            return false;     
        }
        if(document.editbranch.countrynameedit.value != ''){
            if(document.editbranch.statenameedit.value == ''){
                document.getElementById('stateeditalert').style.display = 'block';  
                document.editbranch.statenameedit.focus(); 
                return false;
            }
            if(document.editbranch.citynameedit.value == ''){
                document.getElementById('cityeditalert').style.display = 'block';  
                document.editbranch.cityname.focus(); 
                return false;
            } 
        }
        if(document.editbranch.contactnumberedit.value !=''){
            if(IsNumeric(document.editbranch.contactnumberedit.value)==false){
                document.getElementById('contactnumbereditalert').style.display = 'block'; 
                document.getElementById("contactnumbereditalert").innerHTML="Invalid contact number! Please re-enter";
                document.editbranch.contactnumberedit.select();
                document.editbranch.contactnumberedit.focus(); 
                return false;
            }
        }
        if(document.editbranch.emailedit.value != '') {
            var emails = document.getElementById('emailedit');
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(emails.value)) {
                document.getElementById('emaileditalert').style.display = 'block'; 
                document.getElementById("emaileditalert").innerHTML="Invalid email address! Please re-enter";
                document.editbranch.emailedit.select();
                document.editbranch.emailedit.focus();
                return false;
            } 
        }


    document.editbranch.submit();
    return true;
    }


    function loadstate(id){
        var token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ 'load-state-branch' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            success: function(response){
                var statehtml = "";
                var cityhtml = "";
                var statename;
                cityhtml = '<option value="">- Please Select -</option>';
                statehtml = '<option value="">- Please Select -</option>';
                $.each(response.states, function( index, state) {                 
                    statehtml += '<option value="'+state.sid+'">'+state.statename+'</option>'; 
                });                
                $('#statename').html(statehtml);
                $('#cityname').html(cityhtml); 
            }
        });
    }

    function loadcity(id){
        var token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ 'load-city-branch' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            success: function(response){
                var cityhtml = "";
                var cityname;
                
                cityhtml = '<option value="">- Please Select -</option>';
                $.each(response.cities, function( index, city) {                 
                    cityhtml += '<option value="'+city.cityid+'">'+city.cityname+'</option>'; 
                });                
                $('#cityname').html(cityhtml); 
            }
        });
    }


    function loadstateedit(id){
        var token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ 'load-state-branch' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            success: function(response){
                var statehtml = "";
                var cityhtml = "";
                var statename;
                cityhtml = '<option value="">- Please Select -</option>';
                statehtml = '<option value="">- Please Select -</option>';
                $.each(response.states, function( index, state) {                 
                    statehtml += '<option value="'+state.sid+'">'+state.statename+'</option>'; 
                });                
                $('#statenameedit').html(statehtml);
                $('#citynameedit').html(cityhtml); 
            }
        });
    }

    function loadcityedit(id){
        var token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ 'load-city-branch' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            success: function(response){
                var cityhtml = "";
                var cityname;
                
                cityhtml = '<option value="">- Please Select -</option>';
                $.each(response.cities, function( index, city) {                 
                    cityhtml += '<option value="'+city.cityid+'">'+city.cityname+'</option>'; 
                });                
                $('#citynameedit').html(cityhtml); 
            }
        });
    }

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
