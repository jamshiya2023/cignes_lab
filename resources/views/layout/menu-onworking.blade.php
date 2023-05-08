<div class="sidebar p-2 py-md-3">
        <div class="container-fluid">
            <!-- sidebar: title-->
            
            <!-- sidebar: Create new -->
            
            <!-- sidebar: menu list -->
            <div class="main-menu flex-grow-1">

                <ul class="menu-list">
                @foreach ($menulist as $menu)
                
                @if($menu->id == '1')
                    <li><a class="m-link active" href="{{ $menu->slug_url }}"><i class="{{$menu->menuicon}}"></i><span>{{$menu->menu_name}}</span></a></li>
                    @else
                   
                    <li class="collapsed">
                        <a class="m-link " data-bs-toggle="collapse" data-bs-target="#menu-Dashboard" href="#">
                            <i class="fa fa-users"></i>
                            <span class="ms-2">{{$menu->menu_name}} =>  {{$menu->id}}</span>
                            <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                        </a>
                            
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="menu-Dashboard">
                        @foreach($menu->childs as $child) 
                        @if($child->permission->viewmenu == 1)  
                        <li><a class="ms-link" href="">{{ $child->menu_name }} - {{$child->permission->viewmenu}}</a></li>                        
                        @endif
                        @endforeach
    
                        <?php //foreach ($submenulist as $submenu) {   ?>
                            <!-- <li><a class="ms-link" href="">dasdasd</a></li> -->
                        <?php //}    ?>
                        </ul>
                    </li>
                    @endif
                @endforeach    
<!--    
                <li><a class="m-link active" href="{{ url('/dashboard') }}"><i class="fa fa-home"></i><span>My Dashboard</span></a></li>

                    <li class="collapsed">
                        <a class="m-link " data-bs-toggle="collapse" data-bs-target="#menu-Dashboard" href="#">
                            <i class="fa fa-users"></i>
                            <span class="ms-2">Departments</span>
                            <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                        </a>
        
                        <ul class="sub-menu collapse" id="menu-Dashboard">
                            <li><a class="ms-link" href="{{ url('/departments') }}">All Departments</a></li>
                            <li><a class="ms-link" href="{{ url('/add-department') }}">Add Department</a></li>
                            
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-Staff" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                                <path class="fill-secondary" d="M15 14C15 14 16 14 16 13C16 12 15 9 11 9C7 9 6 12 6 13C6 14 7 14 7 14H15ZM7.022 13C7.01461 12.999 7.00727 12.9976 7 12.996C7.001 12.732 7.167 11.966 7.76 11.276C8.312 10.629 9.282 10 11 10C12.717 10 13.687 10.63 14.24 11.276C14.833 11.966 14.998 12.733 15 12.996L14.992 12.998C14.9874 12.9988 14.9827 12.9995 14.978 13H7.022ZM11 7C11.5304 7 12.0391 6.78929 12.4142 6.41421C12.7893 6.03914 13 5.53043 13 5C13 4.46957 12.7893 3.96086 12.4142 3.58579C12.0391 3.21071 11.5304 3 11 3C10.4696 3 9.96086 3.21071 9.58579 3.58579C9.21071 3.96086 9 4.46957 9 5C9 5.53043 9.21071 6.03914 9.58579 6.41421C9.96086 6.78929 10.4696 7 11 7ZM14 5C14 5.39397 13.9224 5.78407 13.7716 6.14805C13.6209 6.51203 13.3999 6.84274 13.1213 7.12132C12.8427 7.3999 12.512 7.62087 12.1481 7.77164C11.7841 7.9224 11.394 8 11 8C10.606 8 10.2159 7.9224 9.85195 7.77164C9.48797 7.62087 9.15725 7.3999 8.87868 7.12132C8.6001 6.84274 8.37913 6.51203 8.22836 6.14805C8.0776 5.78407 8 5.39397 8 5C8 4.20435 8.31607 3.44129 8.87868 2.87868C9.44129 2.31607 10.2044 2 11 2C11.7956 2 12.5587 2.31607 13.1213 2.87868C13.6839 3.44129 14 4.20435 14 5Z"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.216 14C5.06776 13.6878 4.99382 13.3455 5 13C5 11.645 5.68 10.25 6.936 9.28C6.30909 9.08684 5.65595 8.99237 5 9C1 9 0 12 0 13C0 14 1 14 1 14H5.216Z"/>
                                <path d="M4.5 8C5.16304 8 5.79893 7.73661 6.26777 7.26777C6.73661 6.79893 7 6.16304 7 5.5C7 4.83696 6.73661 4.20107 6.26777 3.73223C5.79893 3.26339 5.16304 3 4.5 3C3.83696 3 3.20107 3.26339 2.73223 3.73223C2.26339 4.20107 2 4.83696 2 5.5C2 6.16304 2.26339 6.79893 2.73223 7.26777C3.20107 7.73661 3.83696 8 4.5 8Z"/>
                            </svg>
                            <span class="ms-2">Staff</span>
                            <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                        </a>
        
                        <ul class="sub-menu collapse" id="menu-Staff">
                            <li><a class="ms-link" href="{{ url('/staffs') }}">All Staffs</a></li>
                            <li><a class="ms-link" href="{{ url('/add-staff') }}">Add Staff</a></li>
                            
                        </ul>
                    </li>

                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-Test" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="currentColor" viewBox="0 0 16 16">
                                <path class="fill-secondary" d="M3 4.5C3 4.36739 3.05268 4.24021 3.14645 4.14645C3.24021 4.05268 3.36739 4 3.5 4H9.5C9.63261 4 9.75979 4.05268 9.85355 4.14645C9.94732 4.24021 10 4.36739 10 4.5C10 4.63261 9.94732 4.75979 9.85355 4.85355C9.75979 4.94732 9.63261 5 9.5 5H3.5C3.36739 5 3.24021 4.94732 3.14645 4.85355C3.05268 4.75979 3 4.63261 3 4.5ZM3 6.5C3 6.36739 3.05268 6.24021 3.14645 6.14645C3.24021 6.05268 3.36739 6 3.5 6H9.5C9.63261 6 9.75979 6.05268 9.85355 6.14645C9.94732 6.24021 10 6.36739 10 6.5C10 6.63261 9.94732 6.75979 9.85355 6.85355C9.75979 6.94732 9.63261 7 9.5 7H3.5C3.36739 7 3.24021 6.94732 3.14645 6.85355C3.05268 6.75979 3 6.63261 3 6.5ZM3 8.5C3 8.36739 3.05268 8.24021 3.14645 8.14645C3.24021 8.05268 3.36739 8 3.5 8H9.5C9.63261 8 9.75979 8.05268 9.85355 8.14645C9.94732 8.24021 10 8.36739 10 8.5C10 8.63261 9.94732 8.75979 9.85355 8.85355C9.75979 8.94732 9.63261 9 9.5 9H3.5C3.36739 9 3.24021 8.94732 3.14645 8.85355C3.05268 8.75979 3 8.63261 3 8.5ZM3 10.5C3 10.3674 3.05268 10.2402 3.14645 10.1464C3.24021 10.0527 3.36739 10 3.5 10H9.5C9.63261 10 9.75979 10.0527 9.85355 10.1464C9.94732 10.2402 10 10.3674 10 10.5C10 10.6326 9.94732 10.7598 9.85355 10.8536C9.75979 10.9473 9.63261 11 9.5 11H3.5C3.36739 11 3.24021 10.9473 3.14645 10.8536C3.05268 10.7598 3 10.6326 3 10.5ZM3 12.5C3 12.3674 3.05268 12.2402 3.14645 12.1464C3.24021 12.0527 3.36739 12 3.5 12H9.5C9.63261 12 9.75979 12.0527 9.85355 12.1464C9.94732 12.2402 10 12.3674 10 12.5C10 12.6326 9.94732 12.7598 9.85355 12.8536C9.75979 12.9473 9.63261 13 9.5 13H3.5C3.36739 13 3.24021 12.9473 3.14645 12.8536C3.05268 12.7598 3 12.6326 3 12.5ZM11.5 4C11.3674 4 11.2402 4.05268 11.1464 4.14645C11.0527 4.24021 11 4.36739 11 4.5C11 4.63261 11.0527 4.75979 11.1464 4.85355C11.2402 4.94732 11.3674 5 11.5 5H12.5C12.6326 5 12.7598 4.94732 12.8536 4.85355C12.9473 4.75979 13 4.63261 13 4.5C13 4.36739 12.9473 4.24021 12.8536 4.14645C12.7598 4.05268 12.6326 4 12.5 4H11.5ZM11.5 6C11.3674 6 11.2402 6.05268 11.1464 6.14645C11.0527 6.24021 11 6.36739 11 6.5C11 6.63261 11.0527 6.75979 11.1464 6.85355C11.2402 6.94732 11.3674 7 11.5 7H12.5C12.6326 7 12.7598 6.94732 12.8536 6.85355C12.9473 6.75979 13 6.63261 13 6.5C13 6.36739 12.9473 6.24021 12.8536 6.14645C12.7598 6.05268 12.6326 6 12.5 6H11.5ZM11.5 8C11.3674 8 11.2402 8.05268 11.1464 8.14645C11.0527 8.24021 11 8.36739 11 8.5C11 8.63261 11.0527 8.75979 11.1464 8.85355C11.2402 8.94732 11.3674 9 11.5 9H12.5C12.6326 9 12.7598 8.94732 12.8536 8.85355C12.9473 8.75979 13 8.63261 13 8.5C13 8.36739 12.9473 8.24021 12.8536 8.14645C12.7598 8.05268 12.6326 8 12.5 8H11.5ZM11.5 10C11.3674 10 11.2402 10.0527 11.1464 10.1464C11.0527 10.2402 11 10.3674 11 10.5C11 10.6326 11.0527 10.7598 11.1464 10.8536C11.2402 10.9473 11.3674 11 11.5 11H12.5C12.6326 11 12.7598 10.9473 12.8536 10.8536C12.9473 10.7598 13 10.6326 13 10.5C13 10.3674 12.9473 10.2402 12.8536 10.1464C12.7598 10.0527 12.6326 10 12.5 10H11.5ZM11.5 12C11.3674 12 11.2402 12.0527 11.1464 12.1464C11.0527 12.2402 11 12.3674 11 12.5C11 12.6326 11.0527 12.7598 11.1464 12.8536C11.2402 12.9473 11.3674 13 11.5 13H12.5C12.6326 13 12.7598 12.9473 12.8536 12.8536C12.9473 12.7598 13 12.6326 13 12.5C13 12.3674 12.9473 12.2402 12.8536 12.1464C12.7598 12.0527 12.6326 12 12.5 12H11.5Z"/>
                                <path d="M2.354 0.645978C2.29798 0.589911 2.22943 0.547966 2.154 0.523602C2.07858 0.499238 1.99845 0.493154 1.92021 0.505852C1.84197 0.518549 1.76787 0.549665 1.70403 0.596631C1.64018 0.643598 1.58842 0.70507 1.553 0.775978L1.053 1.77598C1.01815 1.84551 1.00001 1.92221 1 1.99998V15H0.5C0.367392 15 0.240215 15.0527 0.146447 15.1464C0.0526784 15.2402 0 15.3674 0 15.5C0 15.6326 0.0526784 15.7598 0.146447 15.8535C0.240215 15.9473 0.367392 16 0.5 16H15.5C15.6326 16 15.7598 15.9473 15.8536 15.8535C15.9473 15.7598 16 15.6326 16 15.5C16 15.3674 15.9473 15.2402 15.8536 15.1464C15.7598 15.0527 15.6326 15 15.5 15H15V1.99998C15 1.92221 14.9818 1.84551 14.947 1.77598L14.447 0.775978C14.4115 0.705251 14.3598 0.643947 14.296 0.597106C14.2323 0.550265 14.1583 0.519224 14.0802 0.506534C14.0021 0.493843 13.9221 0.499867 13.8468 0.524108C13.7715 0.548349 13.703 0.590117 13.647 0.645978L13 1.29298L12.354 0.645978C12.3076 0.599415 12.2524 0.562472 12.1916 0.537266C12.1309 0.512059 12.0658 0.499084 12 0.499084C11.9342 0.499084 11.8691 0.512059 11.8084 0.537266C11.7476 0.562472 11.6924 0.599415 11.646 0.645978L11 1.29298L10.354 0.645978C10.3076 0.599415 10.2524 0.562472 10.1916 0.537266C10.1309 0.512059 10.0658 0.499084 10 0.499084C9.93423 0.499084 9.86911 0.512059 9.80837 0.537266C9.74762 0.562472 9.69245 0.599415 9.646 0.645978L9 1.29298L8.354 0.645978C8.30755 0.599415 8.25238 0.562472 8.19163 0.537266C8.13089 0.512059 8.06577 0.499084 8 0.499084C7.93423 0.499084 7.86911 0.512059 7.80837 0.537266C7.74762 0.562472 7.69245 0.599415 7.646 0.645978L7 1.29298L6.354 0.645978C6.30755 0.599415 6.25238 0.562472 6.19163 0.537266C6.13089 0.512059 6.06577 0.499084 6 0.499084C5.93423 0.499084 5.86911 0.512059 5.80837 0.537266C5.74762 0.562472 5.69245 0.599415 5.646 0.645978L5 1.29298L4.354 0.645978C4.30755 0.599415 4.25238 0.562472 4.19163 0.537266C4.13089 0.512059 4.06577 0.499084 4 0.499084C3.93423 0.499084 3.86911 0.512059 3.80837 0.537266C3.74762 0.562472 3.69245 0.599415 3.646 0.645978L3 1.29298L2.354 0.645978ZM2.137 1.84398L2.647 2.35398C2.74076 2.44771 2.86792 2.50037 3.0005 2.50037C3.13308 2.50037 3.26024 2.44771 3.354 2.35398L4 1.70698L4.646 2.35398C4.69245 2.40054 4.74762 2.43748 4.80837 2.46269C4.86911 2.4879 4.93423 2.50087 5 2.50087C5.06577 2.50087 5.13089 2.4879 5.19163 2.46269C5.25238 2.43748 5.30755 2.40054 5.354 2.35398L6 1.70698L6.646 2.35398C6.69245 2.40054 6.74762 2.43748 6.80837 2.46269C6.86911 2.4879 6.93423 2.50087 7 2.50087C7.06577 2.50087 7.13089 2.4879 7.19163 2.46269C7.25238 2.43748 7.30755 2.40054 7.354 2.35398L8 1.70698L8.646 2.35398C8.69245 2.40054 8.74762 2.43748 8.80837 2.46269C8.86911 2.4879 8.93423 2.50087 9 2.50087C9.06577 2.50087 9.13089 2.4879 9.19163 2.46269C9.25238 2.43748 9.30755 2.40054 9.354 2.35398L10 1.70698L10.646 2.35398C10.6924 2.40054 10.7476 2.43748 10.8084 2.46269C10.8691 2.4879 10.9342 2.50087 11 2.50087C11.0658 2.50087 11.1309 2.4879 11.1916 2.46269C11.2524 2.43748 11.3076 2.40054 11.354 2.35398L12 1.70698L12.646 2.35398C12.6924 2.40054 12.7476 2.43748 12.8084 2.46269C12.8691 2.4879 12.9342 2.50087 13 2.50087C13.0658 2.50087 13.1309 2.4879 13.1916 2.46269C13.2524 2.43748 13.3076 2.40054 13.354 2.35398L13.863 1.84398L14 2.11798V15H2V2.11798L2.137 1.84398Z"/>
                            </svg>
                            <span class="ms-2">Test</span>
                            <span class="arrow fa fa-angle-right ms-auto text-end"></span>
                        </a>
        
                        <ul class="sub-menu collapse" id="menu-Test">
                            <li><a class="ms-link" href="{{ url('/alltest') }}">Single / Profile Tests</a></li>
                            <li><a class="ms-link" href="{{ url('/add-single-test') }}">Add Single Test</a></li>
                            <li><a class="ms-link" href="{{ url('/add-profile-test') }}">Add Profile Test</a></li>
                            
                        </ul>
                    </li>
-->
                   
<!-- MENU AND SUB MENUS STARTS HERE -->

                    
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