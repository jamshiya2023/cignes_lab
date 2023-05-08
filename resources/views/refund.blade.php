@extends('layout.mainregister')
@section('content')
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
   <div class="container-fluid">
      <div class="row g-2 row-deck">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-header">
                  <h6 class="card-title m-0">Invoice</h6>
                    </div>
                      <div class="card-body">
                        <table id="billing" class="table card-table table-hover align-middle mb-0 bill" style="width: 100%;">
                          <thead>
                            <tr>
                           <th>Invoice No</th>
                           <th>Name</th>
                           <th>Phone</th>
                           <th>Test Name</th>
                           <th>Subtotal</th>
                           <th>Invoice Date</th>
                           <!--<th style="text-align:center;">Actions</th>-->
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($testdetails as $test)
                        <tr>
                           <td> {{$test->invoice_number}}</td>
                           <td> {{$test->name}}</td>
                           <td> {{$test->phone}}</td>
                           <td> {{$test->testname}}</td>
                           <td> {{$test->test_subtotal}}</td>
                           <td> {{$test->created_at}}</td>
                           <!--<td style="text-align:center;">-->
                           <!--   <button type="button" class="btn btn-sm bg-success text-white"  title="Refund" data-bs-toggle="modal" data-bs-target="#invoice_detail">Refund</button>-->
                           <!--</td>-->
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <form class="row g-3" action="{{ url('refundpaymentadd') }}"   id="refundpayment" name="refundpayment" method="Post" >
                  @csrf
                  @foreach ($testdetails as $test)   
                  <input type="hidden"  value="{{$test->test_subtotal}}" id="subtotal" name="subtotal" > 
                  <input type="hidden"  value="{{$test->invoice_number}}" name="invoice_id" > 
                  @endforeach
                  <div class="modal fade" id="invoice_detail" tabindex="-1">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title">Refund Payment</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closesinglenormalrange"></button>
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
                                    Refund Amount 
                                    </label>
                                 </div>
                                 <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-lg" name="paidamount" required> 
                                    <div class="alert-danger pt-1 pb-1 px-1 py-1" id="paidamountalert" style="display:none ;">Please enter amount</div>
                                 </div>
                                 <div class="col-sm-12"> 
                                    <a style="cursor:pointer;" class="btn btn-primary" onclick="finalsubmission();">Save</a>
                                    <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">Cancel</button>  
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- .row end -->
   </div>
</div>
<script type='text/javascript'>
   function finalsubmission() {
       var paidamt = Number(document.refundpayment.paidamount.value); 
       var finalpaidamt = paidamt.toFixed(2);
       // var subtotals = Number(document.refundpayment.subtotal.value);
   	   var subtotals = document.getElementById('subtotal').value; 
   //alert(paidamt);die();
       document.getElementById('paymentmethodalert').style.display = 'none';
       document.getElementById('paidamountalert').style.display = 'none';
      
    if(document.refundpayment.paidamount.value == "")
       {
           document.getElementById('paidamountalert').style.display = 'block';
           return false;
       }
      if(document.refundpayment.paymentmethod.value == "0")
       {
           document.getElementById('paymentmethodalert').style.display = 'block';
           return false;
       }
	   
	  if(document.refundpayment.paymentmethod.value =='0' && document.refundpayment.paidamount.value !='')
       {
           document.getElementById('paymentmethodalert').style.display = 'block';
           return false;
       }
     /*  if(document.refundpayment.paymentmethod.value !='0' && document.refundpayment.paidamount.value =='')
       {
           document.getElementById('paidamountalert').style.display = 'block';
           return false;
       }
    
   	if((document.refundpayment.paidamount.value !='') &&  (IsNumeric(document.refundpayment.paidamount.value)==false)){
               document.getElementById('paidamountalert').style.display = 'block'; 
               document.getElementById("paidamountalert").innerHTML="Invalid amount number! Please re-enter";
               document.refundpayment.paidamount.select();
               document.refundpayment.paidamount.focus(); 
               return false;
           } */
   		 
       if(document.refundpayment.paymentmethod.value !='0' && finalpaidamt > document.getElementById('subtotal').value){
           document.getElementById('paidamountalert').style.display = 'block';
           document.getElementById('paidamountalert').innerHTML = 'Paid amount is greater than total amount. Please re-enter!';
           document.refundpayment.paidamount.select();
           return false;
       }
    
        
       document.refundpayment.submit();  
       return true;
   }
      
</script>
<script src="{!! asset('assets/plugin/jquery/3.3.1/jquery.min.js') !!}"></script>
<script src="{!! asset('assets/js/bundle/dataTables.bundle.js') !!}"></script>
        <script>
    // project data table
    $('.bill').addClass('nowrap').dataTable({
      

      responsive: true,
     
    });
    
    
  </script>
<script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
@endsection