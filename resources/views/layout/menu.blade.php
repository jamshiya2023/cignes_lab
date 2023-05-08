<div class="sidebar p-2 py-md-3">
        <div class="container-fluid">
            <!-- sidebar: title-->
            
            <!-- sidebar: Create new -->
            
            <!-- sidebar: menu list -->
            <div class="main-menu flex-grow-1">

                <ul class="menu-list">
                    
                    <li><a class="m-link" href="{{ url('/dashboard') }}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
                    
                    <li class="collapsed"> 
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#frontdesk" style="cursor:pointer;">
                            <i class="fa fa-desktop"></i>
                            <span class="ms-2">Front Desk</span>
                            <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                        </a>
        
                        
                        <ul class="sub-menu collapse" id="frontdesk">
                        <li><a class="ms-link" href="{{ url('/registration') }}">Registration</a></li>
                         <li><a class="ms-link" href="{{ url('/registration.list') }}">Registration List</a></li>
                            <li class="collapsed">
                                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#regbilling" style="cursor:pointer;"><span>Billing</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>
        
                                
                                <ul class="sub-menu collapse" id="regbilling">
                                    <!-- <li><a class="ms-link" href="#">Billing</a></li> -->
                                    <li><a class="ms-link" href="{{ url('/invoice-list') }}">Invoice List</a></li>
                                    <li><a class="ms-link" href="{{ url('/receipt-list') }}">Receipt List</a></li>
                               <!--<li><a class="ms-link" href="{{ url('/refunds') }}">Refund</a></li> -->
                                    <li><a class="ms-link" href="{{ url('/refund') }}">Credit Note</a></li>
                                    <!-- <li><a class="ms-link" href="#">Advance Refund </a></li> -->
                                    
                                </ul>
                            </li>
                            <!--<li><a class="ms-link" href="#">Print Report</a></li>-->
                            <li><a class="ms-link" href="{{ url('/sample-rejection') }}">Sample Rejection</a></li>
                            <li><a class="ms-link" href="{{ url('/client-portal') }}">Client Portal</a></li>
                            <!--<li><a class="ms-link" href="{{ url('/referral-acknowledgement') }}">Referral Acknowledgement</a></li>-->
                        </ul>
                    </li>


                    <li class="collapsed"> 
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#laboratory" style="cursor:pointer;">
                            <i class="fa fa-flask"></i>
                            <span class="ms-2">Laboratory</span>
                            <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                        </a>
                        <ul class="sub-menu collapse" id="laboratory">
                        	<li><a class="ms-link" href="{{ url('/sample') }}">Sample Collection</a></li>
                            <!-- <li><a class="ms-link" href="#">Sample Transfer</a></li> -->
                            <li><a class="ms-link" href="{{ url('/test-result') }}">Test Result</a></li>
                            <!-- <li><a class="ms-link" href="#" >Microbiology</a></li> -->
                            <li><a class="ms-link" href="{{ url('/accession-acknowledge') }}">Accession/Acknowledge</a></li>
                        </ul>
                    </li>

                    <li class="collapsed"> 
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#hr" style="cursor:pointer;">
                            <i class="fa fa-users"></i>
                            <span class="ms-2">HR</span>
                            <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                        </a>
                        <ul class="sub-menu collapse" id="hr">
                        	 <li><a class="ms-link" href="{{ url('/departments') }}">Departments</a></li> 
                            <li><a class="ms-link" href="{{ url('/staffs') }}">Staffs</a></li>
                        </ul>
                    </li>
                    
                    <li class="collapsed"> 
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#inventory" style="cursor:pointer;">
                            <i class="fa fa-list-alt"></i>
                            <span class="ms-2">Inventory</span>
                            <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                        </a>
                        <ul class="sub-menu collapse" id="inventory">
                        	
                            <li class="collapsed">
                                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#purchase" style="cursor:pointer;"><span>Purchase</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>
                                <ul class="sub-menu collapse" id="purchase">
                                    <li><a class="ms-link" href="{{ url('/purchase-list') }}">Purchase List</a></li>
                                </ul>
                            </li>
                            <li><a class="ms-link" href="{{ url('/stock-list') }}">Stock List</a></li>
                            <li><a class="ms-link" href="#">Stock Transfer</a></li>
                            <li><a class="ms-link" href="#">Stock Report</a></li>
                            <li class="collapsed">
                                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#assetmanagement" style="cursor:pointer;"><span>Asset Management</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>
                                <ul class="sub-menu collapse" id="assetmanagement">
                                    <li><a class="ms-link" href="#">Add Asset</a></li>
                                    <li><a class="ms-link" href="#">Assign to Staff</a></li>
                                    <li><a class="ms-link" href="#">Asset List</a></li>
                                </ul>
                            </li>
                            
                            <li><a class="ms-link" href="#">Purchase Approval</a></li>
                               <li class="collapsed">
                                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#itempurchase" style="cursor:pointer;"><span>Item Purchase</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>
                              
                                <ul class="sub-menu collapse" id="itempurchase">
                                <li><a class="ms-link" href="{{ url('/add-purchase-item') }}">Add Item</a></li>
                                <li><a class="ms-link" href="{{ url('/item-purchase-list') }}"> Items List </a></li>

                                </ul>
                            </li>
                            
                        </ul>
                    </li>


                    <li class="collapsed"> 
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#finance" style="cursor:pointer;">
                            <i class="fa fa-line-chart"></i>
                            <span class="ms-2">Finance</span>
                            <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                        </a>
                        <ul class="sub-menu collapse" id="finance">
                            <li class="collapsed">
                                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#finabilling" style="cursor:pointer;"><span>Billing</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>
                                <ul class="sub-menu collapse" id="finabilling">
                                    <li><a class="ms-link" href="{{ url('/invoice-finance') }}">Invoice List</a></li>
                                    <li><a class="ms-link" href="#">Receipt List</a></li>
                                   
                                   
                                   <li><a class="ms-link" href="#">Refund</a></li>
                                    <li><a class="ms-link" href="#">Credit Note</a></li>
                                     <li><a class="ms-link" href="#">Advance Refund</a></li> 
                                    <li><a class="ms-link" href="#">Total Discount</a></li>
                                </ul>
                            </li>
                            
                            <li class="collapsed">
                                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#finapurchase" style="cursor:pointer;"><span>Purchase</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>
                                <ul class="sub-menu collapse" id="finapurchase">
                                    <li><a class="ms-link" href="{{ url('/purchase-list') }}">Purchase List</a></li>
                                    <li><a class="ms-link" href="#">Purchase Approval</a></li>
                                    <li><a class="ms-link" href="#">Pending Report</a></li>
                                </ul>
                            </li>
                            
                            <li class="collapsed">
                                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#finaexpense" style="cursor:pointer;"><span>Expense</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>
                                <ul class="sub-menu collapse" id="finaexpense">
                                    <li><a class="ms-link" href="{{ url('/expense-list') }}">Expense List</a></li>
                                    <li><a class="ms-link" href="#">Expense Approval</a></li>
                                    <li><a class="ms-link" href="#">Expense Report</a></li>
                                </ul>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="collapsed"> 
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#callcenter" style="cursor:pointer;">
                            <i class="fa fa-phone"></i>
                            <span class="ms-2">Call Center</span>
                            <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                        </a>
                        <ul class="sub-menu collapse" id="callcenter">
                        <li><a class="ms-link" href="{{ url('/add-lead') }}">Add lead</a></li>
                        <li><a class="ms-link" href="{{ url('/list-lead') }}">list  lead</a></li>

                        </ul>
                    </li>

                    <li><a class="m-link" href="{{ url('/audit-trail') }}"><i class="fa fa-bar-chart"></i><span>Audit Trail</span></a></li>
                    <li><a class="m-link" href="#"><i class="fa fa-search"></i><span>Quality Management</span></a></li>


                    <li class="collapsed"> 
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#configuration" style="cursor:pointer;">
                            <i class="fa fa-cog"></i>
                            <span class="ms-2">Configuration</span>
                            <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                        </a>
                        <ul class="sub-menu collapse" id="configuration">
                            <li><a class="ms-link" href="{{ url('/departments')}}">Master Setup</a></li>
                           <li class="collapsed">
                                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#configuration" style="cursor:pointer;"><span>Manage Tests</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>
                                <ul class="sub-menu collapse" id="configuration">
                                    <li><a class="ms-link" href="{{url('/singletest')}}">Single Test</a></li>
                                    <li><a class="ms-link" href="{{url('/profiletest')}}">Profile Test</a></li>
                                </ul>
                            </li>
                            <!--<li><a class="ms-link" href="#">Expense Category</a></li> -->
                            
                            
                            
                        </ul>
                    </li>
                    
                    
                    
                    
                    
                    

                    
                </ul>
                
            </div>
            <!-- sidebar: footer link -->

            <ul class="menu-list nav navbar-nav flex-row text-center">
                <li class="nav-item flex-fill p-2">
                    <a class="d-inline-block w-100 color-400" href="#" data-bs-toggle="modal" data-bs-target="#ScheduleModal" title="My Schedule">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                            <path class="fill-secondary" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
                            <path class="fill-secondary" d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"/>
                        </svg>
                    </a>
                </li>
                <li class="nav-item flex-fill p-2">
                    <a class="d-inline-block w-100 color-400" href="#" data-bs-toggle="modal" data-bs-target="#MynotesModal" title="My notes">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                            <path class="fill-secondary" d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1H1.5z"/>
                            <path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2h-11zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5v-11zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293L10 14.793z"/>
                        </svg>
                    </a>
                </li>
                <li class="nav-item flex-fill p-2">
                    <a class="d-inline-block w-100 color-400" href="#" data-bs-toggle="modal" data-bs-target="#RecentChat">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path class="fill-secondary" d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </a>
                <li class="nav-item flex-fill p-2">
                    <a class="d-inline-block w-100 color-400" href="#" title="sign-out">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M7.5 1v7h1V1h-1z"/>
                            <path class="fill-secondary" d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"/>
                        </svg>
                    </a>
                </li>
            </ul>
            
        </div>
    </div>