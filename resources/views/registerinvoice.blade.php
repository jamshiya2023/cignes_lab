@extends('layout.maintemplate')
@section('content')
<style>
   .red {
   color:#f00;
   }
   .text-red{
       color:red;
   }
   .searchdate{ z-index:99999 !important; }
</style>
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
   <div class="container-fluid">
      <div class="row g-2 row-deck">
          
         <div class="col-xl-12">
             
            <div class="card">
                @foreach($invoicelist as $key => $list)
               <div class="card-header pb-0">
                  <h6 class="card-title m-0">Invoice #{{$list->invoice_number}}</h6>
               </div>
               @endforeach
                <button id="button" class="btn btn-xs btn-default no-print pull-right" style="margin-right:15px;" onclick="window.print();">
                    <i class="fa fa-print"></i> Print
                </button>
               <div class="card-body">
                  
                  @if(\Session::get('success'))
                  <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                     {{\Session::get('success')}}
                  </div>
                  @endif
                   
                   <div class="modal-body custom_scroll">
                           <table class="table table-borderless mb-0">
                              <tbody>
                                 <tr>
                                    @foreach($invoicelist as $key => $list)
                                    <td>
                                    <div class="fs-6 fw-bold mb-1">{{$list->created_at}}</div>
                                    </td>
                                    <td class="text-end">
                                        <?php if($list->paymentstatus == 'credit') { ?>
                                        <span class="btn btn-sm  text-red" style="padding: .10rem .5rem; width:125px; cursor:text;"><strong>Status:</strong> Not Paid</span>
                                        <?php } else if($list->paymentstatus == 'paid') { ?>
                                        <span class="btn btn-sm  text-red" style="padding: .10rem .5rem; width:125px; cursor:text;"><strong>Status:</strong> Paid</span>
                                        <?php } 
                                        else if($list->paymentstatus == 'partial') { ?>
                                        <span class="btn btn-sm  text-red" style="padding: .10rem .5rem; width:125px; cursor:text;"><strong>Status:</strong> Partially Paid</span>
                                       <?php }  ?>
                                    </td>
                                    @endforeach
                                 </tr>
                                 <tr>
                                    <td>
                                       <div>From:</div>
                                       <div class="fs-6 fw-bold mb-1">Cignes Lab App </div>
                                       <div>7272 Abi Dhar Al Ghaffari</div>
                                       <div>Email: info@cignes.com.pl</div>
                                       <div>Phone: +966 50 524 0523</div>
                                    </td>
                                    @foreach($invoicelist as $key => $list)
                                    <td class="text-end">
                                       <div>To:</div>
                                       <div class="fs-6 fw-bold mb-1">{{$list->name}}</div>
                                       <div>{{$list->address}}</div>
                                       <div>{{$list->mob}}</div>
                                       <div class="fs-6 fw-bold mb-1">Username:{{$list->user}}</div>
                                      
                                    </td>
                                 @endforeach
                                 </tr>
                                 <tr>
                                    <td colspan="2">
                                       <table class="table table-borderless table-striped mb-0">
                                          <thead>
                                             <tr>
                                                <th style="text-align: center; font-size:16px;" style="width:5%">#</th> 
                                                <th style="text-align: center; font-size:16px;" style="width:30%">Test</th>
                                                <th style="text-align: center;  font-size:16px;" style="width:15%">Unit Price</th>
                                                <th style="text-align: center; font-size:16px;" style="width:15%">Discount</th>
                                                <th style="text-align: center; font-size:16px;" style="width:15%">Tax</th>
                                                <th style="text-align: center; font-size:16px;" style="width:15%">Paid Amount</th>
                                               
                                             </tr>
                                          </thead>
                                          @php
                                          $sum=0;
                                          @endphp
                                          @foreach($itemlist as $key => $list)
                                          <tbody>
                                              <th style="text-align: center;font-size:14px;">{{ ++$key }}</th>
                                              <th style="text-align: center;font-size:14px;">{{$list->testname}}</th>
                                              <th style="text-align: center;font-size:14px;">{{$list->price}}</th>
                                              <th style="text-align: center;font-size:14px;">{{$list->discount}}</th>
                                              <th style="text-align: center;font-size:14px;">{{$list->taxamount}}</th>
                                              <th style="text-align: center;font-size:14px;">{{$list->total}}</th>
                                              
                                          </tbody>
                                          
                                          @php
                                          $qty = $list->price;
                                          $tax = $list->totaltax;
                                          $discount = $list->totaldiscount;
                                          $total = $list->totalamt;
                                          $paid = $list->paidamt;
                                          $balance = $list->balanceamt;
                                          $sum+=$qty;
                                          @endphp
                                          @endforeach
                                          <tbody>
                                                <tr>
                                                <td colspan="4">
                                                   <!--<h6>Terms &amp; Condition</h6>-->
                                                   <!--<p class="text-muted">You know, being a test pilot isn't always the healthiest<br/> business in the world. We predict too much for the next<br/> year and yet far too little for the next 100.</p>-->
                                                </td>
                                                <td colspan="3">
                                                   <table class="table table-borderless mb-0">
                                                      <tbody>
                                                         <tr>
                                                            <td><strong>Total Unit Price</strong></td>
                                                            <td class="text-end" style="text-align:left!important;">{{$sum}} SR <span id="test_unitprice"></span></td>
                                                         </tr>
                                                         <tr>
                                                            <td><strong>Tax </strong></td>
                                                            <td class="text-end"  style="text-align:left!important;">{{$tax}} SR <span id="test_tax_amount"></span></td>
                                                         </tr>
                                                         <tr>
                                                            <td><strong>Discount </strong></td>
                                                            <td class="text-end"  style="text-align:left!important;">{{$discount}} SR <span id="test_tax_amount"></span></td>
                                                         </tr>
                                                         <tr>
                                                            <td><strong>Total</strong></td>
                                                            <td class="text-end"  style="text-align:left!important;"><strong>{{$total}} SR <span id="test_subtotal"></span></strong></td>
                                                         </tr>
                                                         <tr>
                                                            <td><strong style="color:green;">Paid</strong></td>
                                                            <td class="text-end" style="color:green; text-align:left!important;"><strong>{{$paid}} SR <span id="test_subtotal"></span></strong></td>
                                                         </tr>
                                                         <tr>
                                                            <td><strong  style="color:red;">Balance</strong></td>
                                                            <td class="text-end"  style="color:red; text-align:left!important;"><strong>{{$balance}} SR <span id="test_subtotal"></span></strong></td>
                                                         </tr>
                                                         
                                                      </tbody>
                                                   </table>
                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           
                       
                                
                               
                        


                                            
                          
                        </div>
                        
                         
               </div>
   
            </div>
         </div>
      </div>
      <!-- .row end -->
   </div>
</div>






<div class="col-sm-12"> 
    <center>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal">
            PAY NOW
        </button>
    </center>
    <!--<button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">Cancel</button> -->
</div>




<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          
           <div class="row g-4">

                                        <div class="col-sm-4">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                Payment Method
                                                </label>
                                            </div>  
                                            <div class="col-sm-8"> 
                                            <select class="form-select form-select-lg" name="paymentmethod" id="paymentmethod">
                                                <option value="0">- Please Select -</option>                                            
                                                @foreach ($paymentmethods as $paymentmethod)
                                                <option value="{{$paymentmethod->id}}">{{$paymentmethod->paymentmethod}}</option>
                                                @endforeach                                          
                                            </select>
                                            <div class="alert-danger pt-1 pb-1 px-1 py-1" id="paymentmethodalert" style="display:none ;">Please select payment method</div>  
                                            </div>

                                        <div class="col-sm-4">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                Amount Paid
                                                </label>
                                            </div>  
                                            <div class="col-sm-8"> 
                                                <input type="text" class="form-control form-control-lg" name="paidamount" id="totalamont" value="{{$total}}"> 
                                                <div class="alert-danger pt-1 pb-1 px-1 py-1" id="paidamountalert" style="display:none ;">Please enter amount</div>  
                                            </div>

                                            
                                            </div>
                                        
                                    <input type="checkbox" name="morePayments" id="morePayments" value="1" onclick="finalsubmission2();">


          
          
          
          
          
          
        <!-- Payment form goes here -->
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" id="saveButton" onclick="finalsubmission();">Save</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script src="{!! asset('assets/plugin/jquery/3.3.1/jquery.min.js') !!}"></script>
<script type="text/javascript">
   $(document).ready(function () {
       $('#invoice_detail,#payment').modal({
           backdrop: 'static',
           keyboard: false
       })
   });
   
</script>    
  
<script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
<script src="{!! asset('assets/bundles/flatpickr.bundle.js') !!}"></script>
<script>
   $(function() {
       $("body").delegate(".searchdate", "focusin", function(){
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
<script>
    <script>
    // Show modal when the button is clicked
    function formValidation() {
        $('#paymentModal').modal('show');
        
        
}

    
</script>


<script>
function finalsubmission() {
  // Retrieve the selected payment method
  const paymentMethod = document.getElementById("paymentmethod").value;
  // Retrieve the amount paid
  const paidAmount = document.getElementById("totalamont").value;

  // Validate the form fields
  if (paymentMethod === "0") {
    document.getElementById("paymentmethodalert").style.display = "block";
    return;
  }
  if (!paidAmount) {
    document.getElementById("paidamountalert").style.display = "block";
    return;
  }

  // Disable the submit button to prevent multiple clicks
  document.getElementById("saveButton").disabled = true;

  // Make an AJAX request to submit the form data to the server
  // (insert your AJAX code here)

  // Close the modal
  const modal = document.getElementById("paymentModal");
  const modalInstance = bootstrap.Modal.getInstance(modal);
  modalInstance.hide();
}

function finalsubmission2() {
  // Toggle the visibility of the "morePayments" section
  const morePayments = document.getElementById("morePayments");
  const section = document.getElementById("morePaymentsSection");
  if (morePayments.checked) {
    section.style.display = "block";
  } else {
    section.style.display = "none";
  }
}

</script>




<script>
    function resetPaymentForm() {
  document.getElementById("paymentmethod").value = "0";
  document.getElementById("totalamont").value = "";
}

</script>
<script>
    function finalsubmission() {
  if (document.getElementById("morePayments").checked) {
    resetPaymentForm();
    $('#paymentModal').modal('show');
  } else {
    document.forms["paymentForm"].submit();
  }
}

</script>








@endsection