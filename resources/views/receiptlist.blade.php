@extends('layout.mainregister')
@section('content')

<!-- start: page body -->
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
    <div class="container-fluid">
        <div class="row g-2 row-deck">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6 class="card-title m-0">Receipt List</h6>
                    </div>
                    <div class="card-body">
                        <div class="row bg-light pt-3 mb-3" style="border-radius: 5px;">
                            <h6 class="card-title mb-2">Filter By</h6>
                            <form class="row g-3 m-0" id="searchform" name="searchform" method="post" action="">
                                @csrf
                                <div class="row g-4 mb-3 mt-0">
                                    <div class="col-sm-2 mt-1">
                                        <label class="form-label">From Date</label>
                                        <input type="text" class="form-control form-control-lg searchdate" name="searchfrmdate" value="{{$frmdate}}" />
                                        <!-- <div class="alert-danger pt-1 pb-1 px-1 py-1" id="frmdatealert" style="display:none ;">Please enter tax name</div> -->
                                    </div>

                                    <div class="col-sm-2 mt-1">
                                        <label class="form-label">To Date</label>
                                        <input type="text" class="form-control form-control-lg searchdate" name="searchtodate" value="{{$todate}}" />
                                    </div>

                                    <div class="col-sm-2 mt-1">
                                        <label class="form-label">Customer Name</label>
                                        <input type="text" class="form-control form-control-lg" name="searchcustomer" value="{{$customer}}" />
                                    </div>

                                    <div class="col-sm-2 mt-1">
                                        <label class="form-label">Invoice No</label>
                                        <input type="text" class="form-control form-control-lg" name="searchinvoice" value="{{$invoiceno}}" />
                                    </div>

                                    <div class="col-sm-2 mt-1">
                                        <label class="form-label">Voucher No</label>
                                        <input type="text" class="form-control form-control-lg" name="searchvoucher" value="{{$voucherno}}" />
                                    </div>

                                    <div class="col-sm-2 mt-1">
                                        <a style="cursor: pointer;" class="btn btn-primary mt-5" onclick="formSearch();">Search</a>
                                        <a href="{{ url('/receipt-list') }}" class="btn btn-dark mt-5 text-white">Clear</a>
                                    </div>

                                    <div class="col-sm-10 m-0">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="searchalert" style="display: none;">Please enter any one of the above fields</div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <table id="receiptlist" class="table card-table table-hover align-middle mb-0 receipt" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice No</th>
                                    <th>Customer Name</th>
                                    <th>Voucher No</th>
                                    <th>Voucher Date & Time</th>
                                    <th>Received By</th>
                                    <th class="text-center">Total Amount</th>
                                    <th class="text-center">Paid Amount</th>
                                    <th class="text-center">Balance</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($receiptlist as $key => $value) @php $date = $value->paydate; $receptdate = explode('-', $date); $year = $receptdate[0]; $month = $receptdate[1]; $day = $receptdate[2]; $monthName = date("M",
                                mktime(0, 0, 0, $month, 10)); @endphp

                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><a style="cursor: pointer;" onclick="viewreceipt({{$value->id}})">{{$value->invoiceno}}</a></td>
                                    <td>{{$value->customername}}</td>
                                    <td>{{$value->vouchernumber}}</td>
                                    <td>{{ $monthName }} {{ $day }}, {{ $year }} {{ $value->paytime }}</td>
                                    <td>{{ $value->firstname }} {{ $value->lastname }}</td>
                                    <td class="text-end">SR {{ $value->totalamt }}</td>
                                    <td class="text-end">SR {{ $value->paidamt }}</td>
                                    <td class="text-end"><strong>SR {{ $value->balanceamount }}</strong></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-sm bg-dark text-white" title="View Receipt" onclick="viewreceipt({{$value->id}})">View</button>
                                        <!--<a href="#" class="btn btn-sm bg-success text-white" title="Print Receipt">Print</a>-->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal -->
                    <!-- VIEW INVOICE MODAL STARTS HERE -->
                    <div class="modal fade" id="viewreceipt" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Voucher # REC<span id="receiptno"></span></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body custom_scroll" id="printable">
                                    <div class="col-md-12">
                                        <div class="text-center" style="text-align: center;padding-bottom: 20px;">
                                            <span class="fs-6 fw-bold mb-1">Cignes Lab App</span><br>
                                            <span>7272 Abi Dhar Al Ghaffari</span><br>
                                            <span>Ar Rabwah Dist.</span><br>
                                            <span>Unit No 2, Riyadh 12834 - 3236</span><br>
                                            <span>Kingdom of Saudi Arabia</span><br>
                                            <span>Email: info@cignes.com</span><br>
                                            <span>Phone: +966 50 524 0523</span>
                                        </div>
                                    </div>
                                    <table class="table table-borderless mb-0" style="width: 100%;">
                                        <tbody>
                                            <!--<tr>
                                                    <td>
                                                    <div class="fs-6 fw-bold mb-1">Cignes Lab App </div>
                                                        <div>7272 Abi Dhar Al Ghaffari</div>
                                                        <div>Ar Rabwah Dist.</div>
                                                        <div>Unit No 2, Riyadh 12834 - 3236</div>
                                                        <div>Kingdom of Saudi Arabia</div>
                                                        
                                                    </td>
                                                    <td class="text-end">
                                                        
                                                        <div>Logo Here</div>
                                                        <div>Email: info@cignes.com.pl</div>
                                                        <div>Phone: +966 50 524 0523</div>
                                                    </td>
                                                </tr>-->

                                            <tr>
                                                <td style="border-color: #c1c1c1;color: #525252;padding: 0.8rem 0.6rem;border: 1px solid #eee !important;">
                                                    Voucher Date & Time <strong style="font-weight: bolder;"><span id="datentime"></span></strong>
                                                </td>
                                                <td class="text-end" style="text-align: right !important;padding: 0.8rem 0.6rem;border-color: #c1c1c1;border: 1px solid #eee !important;">
                                                    <span class="text-success" style="color: #198754 !important;"> <strong>Status:</strong> Paid</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="2" style="border-color: #c1c1c1;color: #525252;padding: 0.8rem 0.6rem;border: 1px solid #eee !important;">
                                                    <p>Received from Mr./M/s. <span id="customername"></span>. The sum of SR <span id="receviedamt"></span> by <span id="paymenttype"></span></p>
                                                    <p>For payment of Invoice #<span id="invoice"></span></p>
                                                    <p>Received by <span id="receivedby"></span></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-color: #c1c1c1;color: #525252;padding: 0.8rem 0.6rem;border: 1px solid #eee !important;">
                                                    <p>
                                                        Total Amount: <strong style="font-weight: bolder;"><span id="totalamt"></span></strong>
                                                    </p>
                                                </td>
                                                <td style="border-color: #c1c1c1;color: #525252;padding: 0.8rem 0.6rem;border: 1px solid #eee !important;">
                                                    <p>
                                                        Balance Due: <strong style="font-weight: bolder;"><span id="balanceamt"></span></strong>
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="printInvoice()"><i class="fa fa-print me-2"></i>Print</button>
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


<script src="{!! asset('assets/plugin/jquery/3.3.1/jquery.min.js') !!}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#viewreceipt").modal({
            backdrop: "static",
            keyboard: false,
        });
    });

    function formSearch() {
        document.getElementById("searchalert").style.display = "none";

        if (
            document.searchform.searchfrmdate.value != "" ||
            document.searchform.searchtodate.value != "" ||
            document.searchform.searchcustomer.value != "" ||
            document.searchform.searchinvoice.value != "" ||
            document.searchform.searchvoucher.value != ""
        ) {
            document.searchform.submit();
        } else {
            document.getElementById("searchalert").style.display = "block";
            return false;
        }
    }

    function viewreceipt(id) {
        //alert(id);
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        $.ajax({
            url: "{{'view-receipt'}}",
            type: "POST",
            data: {
                id: id,
                _token: token,
            },
            success: function (response) {
                var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                var paiddate = response.paydate;
                var datearray = paiddate.split("-");

                var year = datearray[0];
                var month = datearray[1];
                var day = datearray[2];
                var monthname = getMonthName(month);
                var receiptdate = monthname + " " + day + ", " + year + " " + response.paytime;
                $("#datentime").html(receiptdate);
                $("#customername").html(response.customername);
                $("#invoice").html(response.invoiceno);
                $("#receivedby").html(response.firstname + " " + response.lastname);
                $("#receviedamt").html(response.paidamt);
                $("#totalamt").html(response.totalamt);
                $("#balanceamt").html(response.balanceamount);
                $("#paymenttype").html(response.paymenttype);
                $("#receiptno").html(response.vouchernumber);

                $("#viewreceipt").modal("show");
            },
            // $('#datentime').html(rdate);
        });
    }
    function getMonthName(month) {
        const d = new Date();
        d.setMonth(month - 1);
        const monthName = d.toLocaleString("default", { month: "long" });
        return monthName;
    }
</script>


<script src="{!! asset('assets/bundles/flatpickr.bundle.js') !!}"></script>
<script>
    $(function () {
        $("body").delegate(".searchdate", "focusin", function () {
            $(this).flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                //dateFormat: "d-M-Y",
                //time24hr:false
                //defaultDate: "2020-11-26 14:30 PM"
            });
        });
    });
</script>

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
    $('.receipt').addClass('nowrap').dataTable({
      

      responsive: true,
     
    });
    
    
  </script>
   <script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
@endsection
