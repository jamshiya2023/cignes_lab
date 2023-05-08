@extends('layout.maintest_template')
@section('content')

<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
    <div class="container-fluid">
        <div class="row g-2 row-deck">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title m-0">Test Result</h6>
                    </div>
                    <div class="card-body">
                        <table id="billing" class="table card-table table-hover align-middle mb-0 bill" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sample No</th>
                                    <th>Reg No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Place</th>
                                    <th>Date</th>
                                    <th style="text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($testlist as $test)
                                <tr>
                                    <td>{{$test->sampleid}}<input type="hidden" id="sampleid" name="sampleid" value="{{$test->sampleid}}" /></td>
                                    <td>{{$test->id}}</td>
                                    <td>{{$test->name}}</td>
                                    <td>{{$test->phone}}</td>
                                    <td>{{$test->place}}</td>
                                    <td>{{$test->registerdate}}</td>
                                    <td style="text-align: center;">
                                        @foreach ($reporttest as $repo) @if ($repo->test_sample_id == $test->sampleid) @else

                                        <a class="btn btn-sm bg-success text-white" title="Update" onclick="updatetest({{$test->sampleid}})">Update</a>
                                        @endif @endforeach
                                        <!--<a class="btn btn-sm bg-success text-white"  title="Update" onclick = "updatetest({{$test->sampleid}})">Update</a>-->

                                        <a class="btn btn-sm bg-success text-white" title="View / Print" onclick="viewtest({{$test->sampleid}})">View / Print</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <script>
                        function viewtest(id) {
                            // var samid = document.getElementById("sampleid").value;
                            var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                            $.ajax({
                                url: "{{'testlist-view'}}",
                                type: "POST",
                                data: {
                                    id: id,
                                    _token: token,
                                },
                                success: function (response) {
                                    $("#teztlist").modal("show");
                                    var testlist = "";
                                    var num = 0;

                                    $.each(response.testlists, function (index, tests) {
                                        num = num + 1;
                                        testlist += '<tr><td style="text-align: center;padding: 0.8rem 0.6rem;color: #525252;border-color: #c1c1c1;">' + tests.testname + '</td><td style="text-align: center;padding: 0.8rem 0.6rem;color: #525252;border-color: #c1c1c1;"> ' + tests.result + 'mg/dl</td><td style="text-align: center;padding: 0.8rem 0.6rem;color: #525252;border-color: #c1c1c1;">' + tests.generalrange + "</td></tr>";
                                    });
                                    $("#rids").html(response.rid);
                                    $("#names").html(response.name);
                                    $("#date").html(response.date);
                                    $("#name").html(response.name);
                                    $("#email").html(response.email);
                                    $("#address").html(response.address);
                                    $("#place").html(response.place);
                                    $("#phone").html(response.phone);
                                    $("#testname").html(response.testname);
                                    //$('#sampleids').val(samid);

                                    $("#samplealert").html("");
                                    $("#teztlists").html(testlist);
                                },
                            });
                        }

                        function updatetest(id) {
                            var samid = document.getElementById("sampleid").value;

                            var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                            $.ajax({
                                url: "{{'testdetails-view'}}",
                                type: "POST",
                                data: {
                                    id: id,
                                    _token: token,
                                },
                                success: function (response) {
                                    $("#updateresult").modal("show");
                                    var testlist = "";

                                    var num = 0;

                                    $.each(response.testlists, function (index, tests) {
                                        num = num + 1;
                                        testlist +=
                                            '<tr><td class="text-center">' +
                                            tests.testname +
                                            '</td><td class="text-center"><input type="text"  name="normalrange_min" class="form-control form-control-lg"></td> <td class="text-center">' +
                                            tests.generalrange +
                                            "</td></tr>";
                                    });

                                    $("#namez").html(response.name);
                                    $("#dates").html(response.date);
                                    $("#nam").html(response.name);
                                    $("#emails").html(response.email);
                                    $("#addresss").html(response.address);
                                    $("#places").html(response.place);
                                    $("#phones").html(response.phone);
                                    $("#testname").html(response.testname);
                                    $("#sampleids").val(samid);
                                    $("#samplealert").html("");
                                    $("#tblcollectionpopup").html(testlist);
                                },
                            });
                        }
                    </script>

                    <!------------------------>
                    <div class="modal fade" id="teztlist" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Report- <span id="names"></span></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body custom_scroll" id="printable">
                                    <div class="row" style="display: inline-flex;width: 100%;">
                                        <div class="col-md-6" style="width: 50%;">
                                            <div style="margin-bottom: 15px;">
                                                <img src="" alt="logo">
                                            </div>
                                            <!--<span>To:</span>-->
                                            <div style="width: 100%;">Patient: <span style="font-weight:bold;">Joan</span></div>
                                            <div style="width: 100%;">
                                                <span>SID No.: <span style="font-weight:bold;">123456</span></span>
                                                <span style="float: right;">Age/Sex: <span style="font-weight:bold;">12/Male</span></span>
                                            </div>
                                            <div style="width: 100%;">Referrer: <span style="font-weight:bold;">Self</span></div>
                                        </div>
                                        <div class="col-md-6" style="width: 50%;text-align: right;">                
                                            <!--<div>From:</div>-->
                                            <div style="margin-bottom: 15px;font-size:12px;">
                                                <span class="mb-1" style="font-weight:bold;">Cignes Lab App</span><br>
                                                <span>7272 Abi Dhar Al Ghaffari, Ar Rabwah Dist.</span><br>
                                                <span>Unit No 2, Riyadh 12834 - 3236, KSA</span><br>
                                                <span>Email: info@cignes.com</span><br>
                                                <span>Phone: +966 50 524 0523</span>
                                            </div>
                                            <div style="text-align:center;">
                                                <span style="font-weight: bold;">Pateilent ID: 122345</span>
                                            </div>
                                            <div style="">
                                                <img src="https://static.vecteezy.com/system/resources/thumbnails/005/449/913/small/barcode-on-white-background-illustration-vector.jpg" style="width:50%;">
                                            </div>
                                            <div style="text-align: right;font-size:12px;">
                                                <span>Sample Coll Dt/time: 31/10/2022, 09:10</span><br>
                                                <span>Sample Rec Dt/time: 31/10/2022, 11:10</span><br>
                                                <span>Auth Dt/time: 31/10/2022, 04:10</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="display: inline-flex;width: 100%;">
                                        <div class="col-md-6">
                                            <strong><span id="dates"></span></strong>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="text-end"></span>
                                        </div>
                                    </div>
                                    <table class="table table-borderless mb-0" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <!---<th class="text-center" style="width:5%">#</th>--->
                                                <th style="width: 35%;text-align: center;background: #eee !important;text-transform: uppercase;text-align: center;color: #252525;padding: 0.8rem 0.6rem;font-weight: bolder !important;-webkit-print-color-adjust: exact !important;">Test</th>
                                                <th style="width: 35%;text-align: center;background: #eee !important;text-transform: uppercase;text-align: center;color: #252525;padding: 0.8rem 0.6rem;font-weight: bolder !important;-webkit-print-color-adjust: exact !important;">Test Result</th>
                                                <th style="width: 30%;text-align: center;background: #eee !important;text-transform: uppercase;text-align: center;color: #252525;padding: 0.8rem 0.6rem;font-weight: bolder !important;-webkit-print-color-adjust: exact !important;">Normal Range</th>
                                            </tr>
                                        </thead>
                                        <tbody id="teztlists"></tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="printInvoice()"><i class="fa fa-print me-2"></i>Print</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!------------------------>

                    <!-- Modal -->
                    <!-- UPDATE RESULT STARTS HERE -->
                    <form class="row g-3" method="post" action="{{ url('addtestresult') }}">
                        @csrf
                        <div class="modal fade" id="updateresult" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Resultt - <span id="nam"></span></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body custom_scroll">
                                        <input type="hidden" id="sampleids" name="sampleidss" />
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        <strong><span id="dates"></span></strong>
                                                    </th>
                                                    <td class="text-end"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div>From:</div>
                                                        <div class="fs-6 fw-bold mb-1">Cignes Lab App</div>
                                                        <div>7272 Abi Dhar Al Ghaffari</div>
                                                        <div>Ar Rabwah Dist.</div>
                                                        <div>Unit No 2, Riyadh 12834 - 3236</div>
                                                        <div>Kingdom of Saudi Arabia</div>
                                                        <div>Email: info@cignes.com.pl</div>
                                                        <div>Phone: +966 50 524 0523</div>
                                                    </td>
                                                    <td class="text-end">
                                                        <div>To:</div>
                                                        <div class="fs-6 fw-bold mb-1"><span id="namez"></span></div>
                                                        <div><span id="addresss"></span></div>
                                                        <div><span id="places"></span></div>
                                                        <div>Email: <span id="emails"></span></div>
                                                        <div>Phone: <span id="phones"></span></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <table class="table table-borderless table-striped mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center" style="width: 15%;">Test</th>
                                                                    <th class="text-center" style="width: 15%;">Test Result</th>
                                                                    <th class="text-center" style="width: 15%;">Normal Range</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tblcollectionpopup"></tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" value="submit">Submit</button>
                                        <!----<button type="button" class="btn btn-primary"><i class="fa fa-hard-disk me-2"></i>Save</button>---->
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- UPDATE RESULTS ENDS HERE -->

                    <!-- VIEW INVOICE MODAL STARTS HERE -->
                    <div class="modal fade" id="invoice_detail" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Report - Andew Jon</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body custom_scroll">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <strong>01/April/2022</strong>
                                                </td>
                                                <td class="text-end"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div>From:</div>
                                                    <div class="fs-6 fw-bold mb-1">Cignes Lab App</div>
                                                    <div>7272 Abi Dhar Al Ghaffari</div>
                                                    <div>Ar Rabwah Dist.</div>
                                                    <div>Unit No 2, Riyadh 12834 - 3236</div>
                                                    <div>Kingdom of Saudi Arabia</div>
                                                    <div>Email: info@cignes.com.pl</div>
                                                    <div>Phone: +966 50 524 0523</div>
                                                </td>
                                                <td class="text-end">
                                                    <div>To:</div>
                                                    <div class="fs-6 fw-bold mb-1">Andew Jon</div>
                                                    <div>Attn: Daniel Marek</div>
                                                    <div>43-190 Mikolow, Poland</div>
                                                    <div>Email: mart@andewjon.com</div>
                                                    <div>Phone: +48 123 456 789</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <table class="table table-borderless table-striped mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" style="width: 5%;">#</th>
                                                                <th class="text-center" style="width: 35%;">Test</th>

                                                                <th class="text-center" style="width: 15%;">Test Result</th>
                                                                <th class="text-center" style="width: 15%;">Units</th>
                                                                <th class="text-center" style="width: 15%;">Normal Range</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-center">1</td>
                                                                <td class="text-center">VLDL Cholesterol</td>
                                                                <td class="text-center">150mg/dL</td>
                                                                <td class="text-center">mg/dL</td>
                                                                <td class="text-center">200mg/dL</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center">2</td>
                                                                <td class="text-center">LDL</td>
                                                                <td class="text-center">100mg/dL</td>
                                                                <td class="text-center">mg/dL</td>
                                                                <td class="text-center">200mg/dL</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-print me-2"></i>Print</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- VIEW INVOICE MODAL ENDS HERE -->
                </div>
            </div>
        </div>
        <!-- .row end -->
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
                                                    <path class="fill-muted" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                                </svg>
                                                <span class="ms-3">
                                                    <span class="h6 d-flex mb-1">Personal Project</span>
                                                    <span class="text-muted">For smaller business, with simple salaries and pay schedules.</span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                    <label class="m-1 w-100" for="Team">
                                        <input type="radio" name="plan" id="Team" />
                                        <span class="card">
                                            <span class="card-body d-flex p-3">
                                                <svg class="avatar" viewBox="0 0 16 16">
                                                    <path class="fill-muted" d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                                    <path class="fill-muted" fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                                                    <path class="fill-muted" d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
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
                                    <input type="text" class="form-control" placeholder="Project name" />
                                    <label>Project name *</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <textarea class="form-control" placeholder="Add project details" style="height: 100px;"></textarea>
                                    <label>Add project details</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="date" class="form-control" />
                                    <label>Enter release Date *</label>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="text-muted">Allow Notifications *</div>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="allow_phone" value="option1" />
                                            <label class="form-check-label" for="allow_phone">Phone</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="allow_email" value="option2" />
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
                                    <input type="text" class="form-control" placeholder="Invite Teammates" />
                                    <label>Invite Teammates</label>
                                </div>
                                <h6 class="card-title mb-1">Team Members</h6>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="list-group6" checked="" />
                                    <label class="form-check-label text-muted" for="list-group6">Adding Users by Team Members</label>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush list-group-custom custom_scroll mb-0" style="height: 300px;">
                                <li class="list-group-item d-flex align-items-center">
                                    <img class="avatar rounded" src="assets/images/xs/avatar1.jpg" alt="" />
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
                                    <img class="avatar rounded" src="assets/images/xs/avatar2.jpg" alt="" />
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
                                    <img class="avatar rounded" src="assets/images/xs/avatar3.jpg" alt="" />
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
                                    <img class="avatar rounded" src="assets/images/xs/avatar4.jpg" alt="" />
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
                                    <img class="avatar rounded" src="assets/images/xs/avatar5.jpg" alt="" />
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
                                    <img class="avatar rounded" src="assets/images/xs/avatar6.jpg" alt="" />
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
                                    <img class="avatar rounded" src="assets/images/xs/avatar7.jpg" alt="" />
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
                                    <img class="avatar rounded" src="assets/images/xs/avatar8.jpg" alt="" />
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
                                    <input class="form-control" type="file" multiple />
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
<script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>

<script type="text/javascript">
    function printInvoice() {
        // printJS('printable', 'html')

        let printFrame = document.createElement("iframe");
        let printableElement = document.getElementById("printable");
        //
        // // printframe.setattribute("style", "visibility: hidden; height: 0; width: 0; position: absolute;")
        printFrame.setAttribute("id", "printjs");
        printFrame.srcdoc = "<html><head><title>document</title></head><body style='margin: 5px;'>" + printableElement.outerHTML + "<style>@page { size: A4; }";

        document.body.appendChild(printFrame);

        let iframeElement = document.getElementById("printjs");
        iframeElement.focus();
        iframeElement.contentWindow.print();
        //
        // printframe.contentwindow.print()
        //
        // my_window = window.open('', 'mywindow', 'status=1,width=350,height=150');
        // my_window.document.write('<html><head><title>Print Me</title></head>');
        // my_window.document.write('<body onafterprint="self.close()">');
        // my_window.document.write(printablEelement.innerHTML);
        // my_window.document.write('</body></html>');
        // my_window.print();
    }
</script>
<script src="{!! asset('assets/js/bundle/dataTables.bundle.js') !!}"></script>
  <script>
    // project data table
    $('.bill').addClass('nowrap').dataTable({
      

      responsive: true,
     
    });
    
    
  </script>
@endsection
