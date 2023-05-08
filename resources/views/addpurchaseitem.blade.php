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
                	<!-- COL 3 STARTS HERE -->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12">                   		
                        <div class="row">
                            @include('layout.sidemenu')
                        </div>                                            
                    </div>
                    <!-- COL 3 ENDS HERE -->
                    <!--COL 9 STARTS HERE -->
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12">
                    
                    	<div class="row g-4"> 
                <form class="row g-3" id="addpurchase" name="addpurchase" method="post" action="{{ route('purchase.add') }}">                            
                @csrf


                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Add Purchase Item</h6>
                            </div>

                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-sm-6">
                                        <label class="form-label">Item Name <span class="red">*</span></label>
                                        <!-- <input type="text" class="form-control form-control-lg" placeholder="Enter here"> -->
                                        <input type="text" class="form-control form-control-lg" name="itemname" id="itemname" > 
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="itemnamealert" style="display:none ;">Please enter item name</div>                                      
                                       
                                    </div>

                                    <div class="col-sm-6 text-end">
                                            <label class="form-label">Item Name (Arabic)</label>                                        
                                            <input type="text" dir="rtl" class="form-control form-control-lg" name="itemnamearabic" id="itemnamearabic" > 
                                       
                                        </div>    

                                    <div class="col-sm-6">
                                        <label class="form-label">Serial Number</label>
                                        <input type="text" class="form-control form-control-lg" name="serialnumber" id="serialnumber" > 

                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Item Code <span class="red">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="itemcode" id="itemcode" > 
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="itemcodealert" style="display:none ;">Please enter item code</div>                                
                                        
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Category <span class="red">*</span></label>                                     
                                        <select  name="categoryid" id="categoryid"  onchange="loadsubcategory(this.value)" placeholder="--Please Select--">
                                            <option value="">--Please Select--</option>
                                            @foreach ($categoryname as $listcategory)
                                            <option value="{{$listcategory->id}}">{{$listcategory->cat_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="categoryidalert" style="display:none ;">Please select category</div>
                                    </div>
                                    


                                    <div class="col-sm-6">
                                        <label class="form-label">Sub Category </label>                          
                                            <select name="subcategoryid" id="subcategoryname" placeholder="--Please Select--">
                                                    <option value="">--Please Select--</option> 
                                            </select>
                                    </div>

                                    

                                    <div class="col-sm-6">
                                        <label class="form-label">Brand <span class="red">*</span></label>
                                        <select name="brandid" id="brandid" placeholder="--Please Select--">
                                            <option value="">--Please Select--</option>
                                            @foreach ($brandname as $listbrand)
                                            <option value="{{$listbrand->id}}">{{$listbrand->brand_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="brandidalert" style="display:none ;">Please select brand</div>
                                        </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Warehouse <span class="red">*</span></label>                          
                                            <select name="warehousename" id="warehousename" placeholder="--Please Select--">
                                                    <option value="">--Please Select--</option> 
                                                    @foreach ($warehousename as $listwarehouse)
                                                    <option value="{{$listwarehouse->id}}">{{$listwarehouse->warehouse_name}}</option>
                                                    @endforeach
                                            </select>
                                            <div class="alert-danger pt-1 pb-1 px-1 py-1" id="warehousealert" style="display:none ;">Please select warehouse</div>
                                    </div>    

                                    <div class="col-sm-6">
                                        <label class="form-label">Item Cost <span class="red">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="itemcost" id="itemcost" > 
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="itemcostalert" style="display:none ;">Please enter item cost</div>                                 
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Selling Price <span class="red">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="sellingprice" id="sellingprice" > 
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="sellingpricealert" style="display:none ;">Please enter selling price</div>                                
                                        <!-- <input type="text" class="form-control form-control-lg" placeholder="Enter here"> -->
                                    </div>



                                     <div class="col-sm-6">
                                        <label class="form-label">Item VAT </label>
                                        <select name="taxid" id="taxid" placeholder="--Please Select--">
                                            <option value="">--Please Select--</option>
                                            @foreach ($taxname as $listtax)
                                            <option value="{{$listtax->id}}">{{$listtax->taxname}}</option>
                                            @endforeach
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="taxidalert" style="display:none ;">Please select VAT </div>
                                    </div> 


                                    <div class="col-sm-6">
                                        <label class="form-label">VAT Method </label>
                                        <select class="form-select form-select-lg" tabindex="-98" id="vatmethod" name="vatmethod"> 
                                        <!-- <input type="text" class="form-control form-control-lg" id="vatmethod" name="vatmethod">  -->
                                            <option value="">--Please Select--</option>
                                            <option value="exclusive">Exclusive</option>
                                            <option value="inclusive">Inclusive</option>
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="vatmethodalert" style="display:none ;">Please select VAT method</div>                                
                                    </div>


                                    <div class="col-sm-6">
                                        <label class="form-label">Expiry Date</label>
                                         <input type="text" class="form-control form-control-lg flatpickr expirydate flatpickr-input" name="expirydate" id="expirydate"> 
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="expirydatealert" style="display:none ;">Please enter expiry date</div>                                
                                    </div>

                                    
                                    <div class="col-sm-6">
                                        <label class="form-label">Unit <span class="red">*</span></label>
                                        <select name="unitid" id="unitid" placeholder="--Please Select--">
                                            <option value="">--Please Select--</option>
                                            @foreach ($unitname as $listunit)
                                            <option value="{{$listunit->id}}">{{$listunit->unit_name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="unitidalert" style="display:none ;">Please select unit</div>
                                    </div>

                                    
                                    <div class="col-sm-6">
                                        <label class="form-label">Opening Stock</label>
                                        <input type="text" class="form-control form-control-lg" name="openingstock" id="openingstock" > 

                                        <!-- <input type="text" class="form-control form-control-lg" placeholder="Enter here"> -->
                                    </div>

                                    

                                </div>                         
                                
                                
                                
                            </div>
                            
                            <div class="card-footer">
                                <!-- <button type="submit" class="btn btn-primary">Save</button> -->

                                <a style="cursor:pointer;" class="btn btn-primary" onclick="formValidation();">Save</a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
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
    <link rel="stylesheet" href="{!! asset('assets/css/select2.min.css') !!}">
    <script src="{!! asset('assets/js/standalone/select2.min.js') !!}"></script>
    <script type="text/javascript">
    var jq = jQuery.noConflict();
    jq(document).ready(function () {
        jq("#categoryid,#subcategoryname,#brandid,#taxid,#unitid,#warehousename").select2();
    });
    </script>
<script type="text/javascript">
function formValidation() 
{
    

    document.getElementById('itemnamealert').style.display = 'none';
     document.getElementById('itemcodealert').style.display = 'none';
     document.getElementById('categoryidalert').style.display = 'none';
     document.getElementById('brandidalert').style.display = 'none';
     document.getElementById('warehousealert').style.display = 'none';
     document.getElementById('itemcostalert').style.display = 'none';
     document.getElementById('sellingpricealert').style.display = 'none';
     document.getElementById('taxidalert').style.display = 'none';
     document.getElementById('vatmethodalert').style.display = 'none';
      document.getElementById('unitidalert').style.display = 'none';
    
    
    
    if(document.addpurchase.itemname.value == ''){
        document.getElementById('itemnamealert').style.display = 'block'; 
        document.addpurchase.itemname.focus();  
        return false;     
    } if(document.addpurchase.itemcode.value == ''){
        document.getElementById('itemcodealert').style.display = 'block'; 
        document.addpurchase.itemcode.focus();  
        return false;     
    } if(document.addpurchase.categoryid.value == ''){
        document.getElementById('categoryidalert').style.display = 'block'; 
        document.addpurchase.categoryid.focus();  
        return false;  

    } if(document.addpurchase.brandid.value == ''){
        document.getElementById('brandidalert').style.display = 'block'; 
       document.addpurchase.brandid.focus();  
        return false; 
    } if(document.addpurchase.warehousename.value == ''){
        document.getElementById('warehousealert').style.display = 'block'; 
        document.addpurchase.warehousename.focus();  
        return false; 
    } if(document.addpurchase.itemcost.value == ''){
        document.getElementById('itemcostalert').style.display = 'block'; 
        document.addpurchase.itemcost.focus();  
        return false;     
    } if(IsNumeric(document.addpurchase.itemcost.value)==false){
        document.getElementById('itemcostalert').style.display = 'block'; 
        document.getElementById("itemcostalert").innerHTML="Invalid item cost! Please re-enter";
        document.addpurchase.itemcost.select();
        document.addpurchase.itemcost.focus(); 
        return false;
    } if(document.addpurchase.sellingprice.value == ''){
        document.getElementById('sellingpricealert').style.display = 'block'; 
        document.addpurchase.sellingprice.focus();  
        return false;     
    } if(IsNumeric(document.addpurchase.sellingprice.value)==false){
        document.getElementById('sellingpricealert').style.display = 'block'; 
        document.getElementById("sellingpricealert").innerHTML="Invalid selling price! Please re-enter";
        document.addpurchase.sellingprice.select();
        document.addpurchase.sellingprice.focus(); 
        return false;
    }
    
    if(document.addpurchase.taxid.value != '')
    if(document.addpurchase.vatmethod.value == ''){
        document.getElementById('vatmethodalert').style.display = 'block'; 
        document.addpurchase.vatmethod.focus();  
        return false;
    }
     if(document.addpurchase.unitid.value == ''){
        document.getElementById('unitidalert').style.display = 'block'; 
        document.addpurchase.unitid.focus();  
        return false; 
    }

    
document.addpurchase.submit();
return true;
};

function loadsubcategory(id){
        var token = $('input[name="_token"]').val();
        //alert('countryid->'+id);
        //statename
        $.ajax({
            url:"{{ 'load-subcategory' }}",
            type: 'POST',
            data: { 
                id:id,
                _token:token
            },
            success: function(response){
              
                var subcategoryhtml = "";
                var subcategoryname;
                
                
                subcategoryhtml = '<option value="">- Please Select -</option>';
                $.each(response.subcategories, function( index, subcategory) {                 
                    subcategoryhtml += '<option value="'+subcategory.sid+'">'+subcategory.subcategoryname+'</option>'; 
                });                
                $('#subcategoryname').html(subcategoryhtml); 
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

</script>







    <script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>

    <script src="{!! asset('assets/bundles/flatpickr.bundle.js') !!}"></script>
<script>
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
</script>
@endsection
