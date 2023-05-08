<div class="main-menu flex-grow-1">
    <ul class="menu-list sidemenu">
        <li class="divider py-2 lh-sm"><span class="small">MASTER SETUP</span></li>
        <li class="collapsed">
            <a class="m-link active" data-bs-toggle="collapse" data-bs-target="#master" href="#">
                <i class="fa fa-cog"></i>
                <span class="ms-2">Master</span>
                <span class="arrow fa fa-angle-right ms-auto text-end"></span>
            </a>                    
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse {{ (request()->is('warehouse','tube','container','machine','branch','departments','add-department','tax','add-tax','payment-method','income-category','expense-category','country','state','city')) ? 'show' : '' }} {{ (request()->segment(1) == 'edit-department') ? 'show' : '' }} {{ (request()->segment(1) == 'edit-tax') ? 'show' : '' }}" id="master">
                <li><a class="ms-link {{ (request()->is('departments','add-department','edit-department')) ? 'active' : '' }} {{ (request()->segment(1) == 'edit-department') ? 'active' : '' }}" href="{{ url('/departments') }}">Departments</a></li>
                <li><a class="ms-link {{ (request()->is('tax','add-tax')) ? 'active' : '' }} {{ (request()->segment(1) == 'edit-tax') ? 'active' : '' }}" href="{{ url('/tax') }}">Tax</a></li>
                <li><a class="ms-link {{ (request()->is('payment-method')) ? 'active' : '' }}" href="{{ url('/payment-method') }}">Payment Method</a></li>
                <li><a class="ms-link {{ (request()->is('income-category')) ? 'active' : '' }}" href="{{ url('/income-category') }}">Income Category</a></li>
                <li><a class="ms-link {{ (request()->is('expense-category')) ? 'active' : '' }}" href="{{ url('/expense-category') }}">Expense Category</a></li>
                
                <li class="collapsed">
                                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#nationality" style="cursor:pointer;"><span>Nationality</span> <span class="arrow fa fa-angle-right ms-auto text-end"></span></a>
                                <ul class="sub-menu collapse  {{ (request()->is('country','state','city')) ? 'show' : '' }}" id="nationality">
                                    <li><a class="ms-link {{ (request()->is('country')) ? 'active' : '' }}" href="{{ url('/country') }}">Country</a></li>
                                    <li><a class="ms-link {{ (request()->is('state')) ? 'active' : '' }}" href="{{ url('/state') }}">State</a></li>
                                    <li><a class="ms-link {{ (request()->is('city')) ? 'active' : '' }}" href="{{ url('/city') }}">City</a></li>
                                </ul>
                </li>
                <li><a class="ms-link {{ (request()->is('branch')) ? 'active' : '' }}" href="{{ url('/branch') }}">Branches</a></li>
                <li><a class="ms-link {{ (request()->is('warehouse')) ? 'active' : '' }}" href="{{ url('/warehouse') }}">Warehouse</a></li>
                 <li><a class="ms-link {{ (request()->is('Insurance')) ? 'active' : '' }}" href="{{ url('/Insurance') }}">Insurance</a></li>
                <li><a class="ms-link {{ (request()->is('machine')) ? 'active' : '' }}" href="{{ url('/machine') }}">Machines</a></li>
                <li><a class="ms-link {{ (request()->is('tube')) ? 'active' : '' }}" href="{{ url('/tube') }}">Tubes</a></li>
                <li><a class="ms-link {{ (request()->is('container')) ? 'active' : '' }}" href="{{ url('/container') }}">Containers</a></li>
                
            </ul>
        </li> 

        <li class="collapsed">
            <a class="m-link active" data-bs-toggle="collapse" data-bs-target="#laboratory-master" href="#">
                <i class="fa fa-flask"></i>
                <span class="ms-2">Laboratory Master</span>
                <span class="arrow fa fa-angle-right ms-auto text-end"></span>
            </a>                    
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse {{ (request()->is('sample-type','lab-unit','reject-reason','test-category','test-method','lot-code','organism-setup','sensitivity','parameter-setup','add-parameter','edit-parameter*')) ? 'show' : '' }}" id="laboratory-master">
                <li><a class="ms-link {{ (request()->is('sample-type')) ? 'active' : '' }}" href="{{ url('/sample-type') }}">Sample Type</a></li>
                <li><a class="ms-link {{ (request()->is('lab-unit')) ? 'active' : '' }}" href="{{ url('/lab-unit') }}">Lab Unit</a></li>
                <li><a class="ms-link {{ (request()->is('reject-reason')) ? 'active' : '' }}" href="{{ url('/reject-reason') }}">Reject Reason</a></li>
                <li><a class="ms-link {{ (request()->is('test-category')) ? 'active' : '' }}" href="{{ url('/test-category') }}">Test Category</a></li>                
                <li><a class="ms-link {{ (request()->is('test-method')) ? 'active' : '' }}" href="{{ url('/test-method') }}">Test  Method</a></li>
                <li><a class="ms-link {{ (request()->is('lot-code')) ? 'active' : '' }}" href="{{ url('/lot-code') }}">Lot Code</a></li>
                <li><a class="ms-link {{ (request()->is('organism-setup')) ? 'active' : '' }}" href="{{ url('/organism-setup') }}">Organism Setup</a></li>
                <li><a class="ms-link {{ (request()->is('sensitivity')) ? 'active' : '' }}" href="{{ url('/sensitivity') }}">Sensitivity</a></li>
                <li><a class="ms-link {{ (request()->is('parameter-setup','add-parameter','edit-parameter*')) ? 'active' : '' }}" href="{{url('/parameter-setup')}}" >Parameter Setup</a></li>
                <!--<li><a class="ms-link" href="#" style="color:#fa7070">Investigation Master</a></li>
                <li><a class="ms-link" href="#" style="color:#fa7070">Investigation Setup</a></li>                
                <li><a class="ms-link" href="#" style="color:#fa7070">Modality Mapping</a></li>
                <li><a class="ms-link" href="#" style="color:#fa7070">Antibiotic Grouping</a></li>
                <li><a class="ms-link" href="#" style="color:#fa7070">Colonieus Setup</a></li>
                <li><a class="ms-link" href="#" style="color:#fa7070">Test Medium Setup</a></li>-->
                
                <!-- <li><a class="ms-link {{ (request()->is('user-department')) ? 'active' : '' }}" href="{{ url('/user-department') }}">User Department</a></li> -->
            </ul>
        </li>   
        
        <li class="collapsed">
            <a class="m-link active" data-bs-toggle="collapse" data-bs-target="#inventory-master" href="#">
                <i class="fa fa-flask"></i>
                <span class="ms-2">Inventory Master</span>
                <span class="arrow fa fa-angle-right ms-auto text-end"></span>
            </a>                    
            <!-- Menu: Sub menu ul -->
            <ul class="sub-menu collapse {{ (request()->is('purchase-category','master-brand','master-unit','master-supplier','item-purchase-list','add-purchase-item','edit-purchase-item*')) ? 'show' : '' }}" id="inventory-master">
                <li><a class="ms-link {{ (request()->is('purchase-category')) ? 'active' : '' }}" href="{{ url('/purchase-category') }}">Item Category/Sub Category</a></li>
                <li><a class="ms-link {{ (request()->is('master-brand')) ? 'active' : '' }}" href="{{ url('/master-brand') }}">Brand</a></li>
                <li><a class="ms-link {{ (request()->is('master-unit')) ? 'active' : '' }}" href="{{ url('/master-unit') }}">Unit</a></li>
                <li><a class="ms-link {{ (request()->is('master-supplier')) ? 'active' : '' }}" href="{{ url('/master-supplier') }}">Supplier</a></li>
                <li><a class="ms-link {{ (request()->is('item-purchase-list','add-purchase-item','edit-purchase-item*')) ? 'active' : '' }}" href="{{ url('/item-purchase-list') }}">Purchase Items</a></li>
                
                <!-- <li><a class="ms-link" href="#" style="color:#fa7070">Test Medium Setup</a></li> -->
                
                
            </ul>
        </li>  
    </ul>                    
</div>