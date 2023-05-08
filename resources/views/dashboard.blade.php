@extends('layout.maintemplate')
@section('content')


<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">

                <div class="row g-3 row-deck">

                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 ">
                        <div class="card text-center wellcome-back" style="background-position: 100% 100%;background-size: 360px auto; ')">
                            <div class="card-body">
                                <h4 class="card-title mt-4">Welcome To E Lab Application!!</h4>
                                <!-- <p class="card-text fs-6 mb-4">If you are going to use a passage of Lorem Ipsum, you need to be sure anything embarrassing.</p> -->
                                
                            </div>
                        </div>
                    </div>

                    <div class="row row-cols-xxl-5 row-cols-xxl-4 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-3 mb-3 row-deck">
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-address-book fa-lg"></i></div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="small text-uppercase">New Patients </div>
                                    <div><span class="h6 mb-0 fw-bold">25</span> <!--<small class="text-success">+34%</small>--></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-product-hunt fa-lg"></i></div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="small text-uppercase">Total Booking</div>
                                    <div><span class="h6 mb-0 fw-bold">180</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-briefcase fa-lg"></i></div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="small text-uppercase">Pending Booking</div>
                                    <div><span class="h6 mb-0 fw-bold text-danger">80</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-briefcase fa-lg"></i></div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="small text-uppercase">Closed Booking</div>
                                    <div><span class="h6 mb-0 fw-bold text-success">100</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-dollar fa-lg"></i>
                                </div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="small text-uppercase">Pending Invoice</div>
                                    <div><span class="h6 mb-0 fw-bold">25</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-dollar fa-lg"></i>
                                </div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="small text-uppercase">Total's Turn over</div>
                                    <div><small>SAR</small> <span class="h6 mb-0 fw-bold">8,925</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-file-text fa-lg"></i></div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="small text-uppercase">Contracts closed</div>
                                    <div><span class="h6 mb-0 fw-bold">25</span> <small class="text-danger">-12%</small></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-user-plus fa-lg"></i></div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="small text-uppercase">Active Staffs</div>
                                    <div><span class="h6 mb-0 fw-bold">11</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-copy fa-lg"></i></div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="small text-uppercase">Branch Payouts</div>
                                    <div><small>SAR</small> <span class="h6 mb-0 fw-bold">23000</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-money fa-lg"></i></div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="small text-uppercase">Total Expenses</div>
                                    <div><span class="h6 mb-0 fw-bold">$2,908</span> <small class="text-danger">-6%</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar rounded-circle no-thumbnail bg-light"><i class="fa fa-money fa-lg"></i></div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <div class="small text-uppercase">Avg Contract Value</div>
                                    <div><span class="h6 mb-0 fw-bold">$4,580</span> <small class="text-danger">-10%</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                    
                    
                    <div class="col-xxl-9 col-xl-8 col-lg-8 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title m-0">Weekly Sales</h6>
                                
                            </div>
                            <div class="card-body pt-0">
                                <div class="px-4 py-3 d-flex flex-row align-items-center bg-light rounded-4">
                                    <!-- <div>
                                        <h6 class="mb-0 fw-bold">$3,056</h6>
                                        <small class="text-muted">Rate</small>
                                    </div>
                                    <div class="ms-lg-5 ms-md-4 ms-3">
                                        <h6 class="mb-0 fw-bold">$1,998</h6>
                                        <small class="text-muted">Value</small>
                                    </div> -->
                                    <!-- <div class="d-none d-sm-block ms-auto">
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1">
                                            <label class="btn btn-secondary" for="btnradio1">Week</label>

                                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2">
                                            <label class="btn btn-secondary" for="btnradio2">Month</label>

                                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" checked="">
                                            <label class="btn btn-secondary" for="btnradio3">Year</label>
                                        </div>
                                    </div> -->
                                </div>
                                <div id="apex-AudienceOverview"></div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-xxl-3 col-xl-6 col-lg-12 col-md-6">
                        <div class="row g-3 row-deck">
                            <div class="col-xxl-12 col-xl-12 col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title d-flex justify-content-between align-items-center">Connection Request<span class="badge bg-primary">20 min ago</span></h6>
                                        <div class="d-flex align-items-center my-4">
                                            <img class="avatar xl rounded" src="assets/images/profile_av.png" alt="">
                                            <div class="flex-fill ms-3">
                                                <div class="h5 mb-1">Hossein Shams</div>
                                                <span class="text-muted">21 mutual connections</span>
                                                <span class="text-muted">Senior Go Developer at Facebook</span>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <a href="#" class="btn mx-1 btn-light-primary flex-grow-1"><i class="fa fa-check me-2"></i>Accept</a>
                                            <a href="#" class="btn mx-1 btn-light-danger flex-grow-1"><i class="fa fa-close me-2"></i>Ignore</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-12 col-xl-12 col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fa fa-google fa-2x"></i>
                                        <div class="ms-3">
                                            <h5 class="mb-0">Google Calendar</h5>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted">See your teams availability while scheduling meeting and interviews. <a href="#">Learn more...</a></p>
                                        <div class="btn-group mt-3">
                                            <input type="radio" class="btn-check" name="gc-btnradio" id="gc-btnradio1" checked="">
                                            <label class="btn btn-outline-primary" for="gc-btnradio1">Enabled</label>
                                            
                                            <input type="radio" class="btn-check" name="gc-btnradio" id="gc-btnradio2">
                                            <label class="btn btn-outline-primary" for="gc-btnradio2">Disabled</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-xxl-3 col-xl-6 col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Sessions by Device</h6>
                            </div>
                            <div class="card-body">
                                <div class="bg-light rounded-4 d-flex text-center">
                                    <div class="p-2 flex-fill">
                                        <span class="text-muted">Desktop</span>
                                        <h5>1.08K</h5>
                                        <small class="text-success"><i class="fa fa-angle-up"></i> 1.03%</small>
                                    </div>
                                    <div class="p-2 flex-fill">
                                        <span class="text-muted">Mobile</span>
                                        <h5>3.20K</h5>
                                        <small class="text-danger"><i class="fa fa-angle-down"></i> 1.63%</small>
                                    </div>
                                    <div class="p-2 flex-fill">
                                        <span class="text-muted">Tablet</span>
                                        <h5>8.18K</h5>
                                        <small class="text-success"><i class="fa fa-angle-up"></i> 4.33%</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="apex-SessionsbyDevice"></div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-xxl-6 col-xl-12 col-lg-8 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title m-0">Social Media Traffic</h6>
                                <div class="dropdown morphing scale-left">
                                    <button class="btn btn-sm btn-link text-muted d-none d-sm-inline-block" type="button"><i class="fa fa-download"></i></button>
                                    <button class="btn btn-sm btn-link text-muted d-none d-sm-inline-block" type="button"><i class="fa fa-external-link"></i></button>
                                    <a href="#" class="more-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                    <ul class="dropdown-menu shadow border-0 p-2">
                                        <li><a class="dropdown-item" href="#">File Info</a></li>
                                        <li><a class="dropdown-item" href="#">Copy to</a></li>
                                        <li><a class="dropdown-item" href="#">Move to</a></li>
                                        <li><a class="dropdown-item" href="#">Rename</a></li>
                                        <li><a class="dropdown-item" href="#">Block</a></li>
                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="apex-SocialMediaTraffic"></div>
                            </div>
                        </div>
                    </div> -->
                </div> <!-- .row end -->

            </div>
        </div>
        <script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
@endsection
