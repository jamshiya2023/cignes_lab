@extends('layout.maintemplate')
@section('content')

<style>
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

                <div class="row g-4">

                    <div class="col-lg-8 col-md-8 col-sm-12">
                        
                    <form class="row g-3" id="newregistration" name="newregistration" method="post" enctype="multipart/form-data" action="{{ route('registration.add') }}" >                            
                    @csrf
                        <div class="card">
                            
                            <div class="card-header">
                                <h6 class="card-title mb-0">Patient Registration (New / Existing)</h6> <h6 style="color: red;">* (Mandatory field)</h6>
                            </div>

                                @if(\Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    {{ \Session::get('success') }}
                                </div>
                                @endif
                            <div class="card-body">
                                <div class="row g-4">
                                    <div class="col-sm-12">
                                        <label class="form-label">Name <span class="red"> *</span></label>
                                        <input type="text" class="form-control form-control-lg" name="fname" id="fname">
                                        <div id="customernamelist"></div>  
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="namealert" style="display:none ;">Please enter name</div>    

                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <label class="form-label">Contact Number <span class="red"> *</span></label>
                                        <!--<input type="text" class="form-control form-control-lg" name="phone" id="phone">-->
                                        <input type="number" class="form-control form-control-lg" max="10" name="phone" id="phone">
                                        <div id="customerphonelist"></div> 
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="phonealert" style="display:none ;">Please enter contact number</div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <label class="form-label">Iqama Number <span class="red"> *</span></label>
                                        <!--<input type="text" class="form-control form-control-lg" name="phone" id="phone">-->
                                        <input type="number" class="form-control form-control-lg"  name="iqama" id="iqama">
                                        <div id="customeriqamalist"></div> 
                                        
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <label class="form-label">Street / Place <span class="red"> *</span></label>
                                        <input type="text" class="form-control form-control-lg" name="place" id="place">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="placealert" style="display:none ;">Please enter street / place</div>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control form-control-lg" name="email" id="email">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="emailalert" style="display:none ;"></div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <label class="form-label">Gender <span class="red"> *</span></label>
                                        <select class="form-select form-select-lg"  name="gender" id="gender">
                                            <option value="">- Select -</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="genderalert" style="display:none ;">Please select gender</div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                        <label class="form-label">Date of Birth <span class="red"> *</span></label>
                                        <input type="text" class="form-control form-control-lg" name="dob" id="dob" onChange="agecal()">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="dobalert" style="display:none ;">Please enter date of birth</div>
                                    </div>
  <script>
   function agecal(){
	   var total = document.getElementById('dob').value;
      const byear = String(total).slice(-4); 
     var date = new Date();
   var current_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+ date.getDate();
    const datecurrent = String(current_date).slice(0, 4); 
     const first2Num = Number(datecurrent); 
      var age = first2Num-byear;
   $('#age').val(age);
   }
</script>                                  
                                    <div class="col-sm-4">
                                        <label class="form-label">Age</label>
                                        <input type="text" class="form-control form-control-lg" name="age" id="age" readonly> 
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="agealert" style="display:none ;">Invalid age! Please re-enter</div>
                                        
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="form-label">Marital Status <span class="red">*</span></label>
                                        <select class="form-select form-select-lg"  name="maritalstatus" id="maritalstatus">
                                            <option value="">- Select -</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Widowed">Widowed</option>                                             
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="maritalstatusalert" style="display:none ;">Please select marital status</div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Blood Group</label>
                                        <!--<input type="text" class="form-control form-control-lg" name="bloodgroup" id="bloodgroup" >-->
                                          <select class="form-select form-select-lg"  name="bloodgroup" id="bloodgroup">
                <option value="">- Select -</option>
                    
                 <option value="A positive">A positive</option>
                 <option value="A negative">A negative</option>
                 <option value="B positive">B positive</option>
                 <option value="B negative">B negative</option>
                 <option value="AB positive">AB positive</option>
                 <option value="AB negative">AB negative</option>
                 <option value="O positive">O positive</option>
                  <option value="O negative">O negative</option>                          
              </select>  
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="form-label">Emergency Contact Number</label>
                                        <input type="text" class="form-control form-control-lg" name="emergencyno" id="emergencyno">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="emailalert" style="display:none ;"></div>
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="form-label">Present Symptoms / Health Issues</label>
                                        <textarea class="form-control form-control-lg" rows="7"  name="healthissue" id="healthissue" style="resize:none;"></textarea>
                                    </div>

                                    <div class="col-sm-4">
                                        <label class="form-label">Address Line 1 <span class="red"> *</span></label>
                                        <input type="text" class="form-control form-control-lg" name="addresslineone" id="addresslineone" >
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="addonealert" style="display:none ;">Please enter address</div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Address Line 2</label>
                                        <input type="text" class="form-control form-control-lg" name="addresslinetwo" id="addresslinetwo">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">City </label>
                                        <input type="text" class="form-control form-control-lg" name="city" id="city">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Pincode</label>
                                        <input type="text" class="form-control form-control-lg" name="pincode" id="pincode">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label">Country <span class="red"> *</span></label>
                                        <select class="form-select form-select-lg"  name="country" id="country">
                                            <option value="">- Select -</option>
                                            @foreach ($countrylist as $country)
                                            <option value="{{$country->id}}" {{ ($country->country_name == 'Saudi Arabia') ? 'selected' : '' }}>{{$country->country_name}} </option>
                                            @endforeach
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="countryalert" style="display:none ;">Please select country</div>
                                    </div>
                                   
                                    <div class="col-sm-4">
                                        <label class="form-label">Register From</label>
                                        <select class="form-select form-select-lg"  name="regfrom" id="regfrom">
                                            <option value="0" selected>Head Office</option>
                                            @foreach ($branchlist as $branch)
                                            <option value="{{$branch->id}}">{{$branch->branchname}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 mt-3">
                                            <label class="form-label" style="margin-bottom: 0rem;"><strong>Insurance Details</strong></label>
                                    </div>
                                     <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                                        <label class="form-label">Insurance Provider<span class="red"> *</span></label>
                                        <select class="form-select form-select-lg"  name="insuranceprovider" id="insuranceprovider">
                                                    <option value="">- Select -</option>
                                                        
                                                     @foreach ($master_insurance as $insurance)
                                                <option value="{{$insurance->id}}">{{$insurance->insurance_name}} </option>
                                                @endforeach
                                      
                                </select>     
                                 <div class="alert-danger pt-1 pb-1 px-1 py-1" id="provideralert" style="display:none ;">Please select insurance provider</div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                                        <label class="form-label">Insurance Number</label>
                                        <input type="text" class="form-control form-control-lg" name="insuranceno" id="insuranceno">
                                    </div>
                                   
                                    <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                                        <label class="form-label">Policy Number</label>
                                        <input type="text" class="form-control form-control-lg" name="insurancecardno" id="insurancecardno">
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-12 mt-3">
                                        <label class="form-label">Expiry Date</label>
                                        <input type="text" class="form-control form-control-lg" name="insuranceexpirydate" id="insuranceexpirydate">
                                    </div>


                                </div>    


                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                                            <label class="form-label" style="margin-bottom: 0rem;"><strong>ID Proof (Documents)</strong></label>
                                    </div>


                                    <table id="tabledocumentlist" class="table card-table table-hover align-middle mb-1 mt-0" style="width: 100%; display:none;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Document Type</th>
                                                <th>Document Number</th>
                                                <th>Expiry Date</th>
                                                <!--<th class="text-center">Attachment</th>-->
                                                <!--<th class="text-center">Actions</th>                                            -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                         </tbody>
                                    </table>
                                </div>


<div id="docaddrow">

                                <div class="row" > 
                                    <div class="col-lg-4 col-md-4 mt-3">
                                        <label class="form-label">Document Type <span class="red">*</span></label>
                                        <select class="form-select form-select-lg" name="documenttype" id="documenttype">
                                            <option value="">- Please Select -</option>
                                          
                                            @foreach ($documenttypelist as $documenttype)
                                            <option value="{{$documenttype->id}}">{{$documenttype->documenttype}}</option>
                                            @endforeach
                                          
                                        </select>
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="documenttypealert" style="display:none ;">Please select</div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 mt-3">
                                        <label class="form-label">Document Number <span class="red">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="documentnumber" id="documentnumber">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="documentnumberalert" style="display:none ;">Please enter</div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 mt-3">
                                        <label class="form-label">Document Expiry Date <span class="red">*</span></label>
                                        <input type="date" class="form-control form-control-lg" name="docexpirydate" id="docexpirydate">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="docexpirydatealert" style="display:none ;">Please enter </div>
                                    </div>
                                    
                                    
                                  
                                    
                                    
                                    
                                    
                                    
                                    <div class="col-lg-7 col-md-7 mt-3">
                                        <label class="form-label">Attach File <span class="red" > *(Allowed:.jpg\.jpeg\.png\.gif\.pdf)</span></label>
                                        <input type="file" class="form-control" name="docattachement" id="docattachement" accept=".pdf" onchange="return documentAttachValidation();">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="docattachementalert" style="display:none ;"></div>
                                    </div>

                                    <div class="col-lg-5 col-md-5 mt-5">
                                    <input type="hidden" class="form-control form-control-lg" name="tempcustid" id="tempcustid" value = "{{ uniqid() }}">
                                        <a style="cursor:pointer;" class="btn btn-primary mt-3" onclick="documentsValidation();">Save & Add More</a>
                                    </div>
                                </div>

</div>


                                <div class="alert-danger pt-1 pb-1 px-1 py-1 mt-2" id="idproofalert"  style="display:none ;">Please upload id proof details</div>
                                <div class="row mt-5">
                                    <div class="col-sm-12">
                                        <label class="form-label">Please add tests<span class="red">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="testsearch" id="testsearch" placeholder="Search test here" >
                                        <div id="searchResultList"></div>      
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1 mt-2" id="testlistalert"  style="display:none ;">Please add tests</div>
                                    </div>
                                </div>  




                                <div class="row" >
                                    <div class="col-lg-6 col-md-6 col-sm-12 mt-3" id="testheading" style="display:none;">
                                            <label class="form-label">Selected Tests</label>
                                    </div>


                                    <table id="tableselectedtest" class="table card-table table-hover align-middle mb-1 mt-0" style="display:none;">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Action</th>  
                                                <th>Test</th>
                                                <th class="text-center">Unit Price</th>
                                                <th class="text-center">Discount</th>
                                                <th class="text-center">VAT</th>
                                                <th class="text-center">Total</th>
                                                                                          
                                            </tr>
                                        </thead>
                                        <tbody id="testresult"></tbody>
                                         <tfoot>
                                            <tr>
                                                <td></td>
                                                <td><strong>Total</strong></td>
                                                <td class="text-end" id="totalunitprice"><strong>SR 0</strong></td>                                                
                                                <td class="text-end" id="totaldiscount"><strong>SR 0</strong></td>
                                                <input type="hidden" id="hiddentotaldiscount" name="hiddentotaldiscount" value="">
                                                <td class="text-end" id="totaltax"><strong>SR 0</strong></td>
                                                <input type="hidden" id="hiddentotaltax" name="hiddentotaltax" value="">
                                                <td class="text-end" id="totalsubtotal"><strong>SR 0</strong></td>
                                                <input type="hidden" id="hiddentotalsubtotal" name="hiddentotalsubtotal" value="">
                                            </tr>

                                            <tr>
                                            <td colspan="4"></td>
                                            <td><strong>Sub Total</strong></td>
                                            <td class="text-end" id="finalpricetotal"><strong>SR 0.00</strong></td>
                                            </tr>

                                            <tr>
                                            <td colspan="4"></td>
                                            <td><strong>VAT</strong></td>
                                            <td class="text-end" id="finaltaxtotal"><strong>SR 0.00</strong></td>
                                            </tr>

                                            <tr>
                                            <td colspan="4"></td>
                                            <td><strong>Discount</strong></td>
                                            <td class="text-end" id="finaldiscounttotal"><strong>SR 0.00</strong></td>
                                            </tr>

                                            <tr>
                                            <td colspan="4"></td>
                                            <td><strong>Total</strong></td>
                                            <td class="text-end" id="finaltotal"><strong>SR 0.00</strong></td>
                                            </tr>

                                            
                                        </tfoot>
                                    </table>
                                </div>
                                
                                
                                
                                
                            </div>

<!-- PAYMENT MODAL STARTS HERE -->

 <div class="modal fade" id="payment" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closesinglenormalrange"></button>
            </div>

           <div class="modal-body">
    <div class="col-sm-4">
        <label class="form-check-label" for="flexCheckDefault">Paid Status</label>
    </div>  
    
                <input type="radio" name="paymnet" value="full" onChange="getValue(this)">Full payment<br> 
                <input type="radio" name="paymnet" value="partial" onChange="getValue(this)"> Partial Payment<br> 

                    <div id="full_payment" style="display:none;">
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
                                                <input type="text" class="form-control form-control-lg" name="paidamount" id="totalamont"> 
                                                <div class="alert-danger pt-1 pb-1 px-1 py-1" id="paidamountalert" style="display:none ;">Please enter amount</div>  
                                            </div>

                                            <div class="col-sm-12"> 
                                            <a style="cursor:pointer;" class="btn btn-primary" onclick="finalsubmission();">Save</a>
                                            <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">Cancel</button>  
                                            </div>
                                               
                                            
                                                
                                        </div>

            </div>
            
            
            <div id="partial_payment" style="display:none;">
                    <div class="col-sm-4">
                        <label class="form-check-label" for="flexCheckDefault">Payment data method</label>
                    </div>  
                    <div class="col-sm-8" > 
                        <select class="form-select form-select-lg" name="div1" id="div1">
                            <option value="0">- Please Select -</option>                                            
                            @foreach ($paymentmethods as $paymentmethod)
                                <option value="{{$paymentmethod->id}}">{{$paymentmethod->paymentmethod}}</option>
                            @endforeach                                          
                        </select>
                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="paymentmethodalert" style="display:none;">Please select payment method</div>  
                    </div>

            
                    <div class="col-sm-4">
                        <label class="form-check-label" for="flexCheckDefault">Amount Paid</label>
                    </div>  
                    <div class="col-sm-8"> 
                        <input type="text" class="form-control form-control-lg" name="div2" id="div2" > 
                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="paidamountalert" style="display:none;">Please enter amount</div>  
                    </div><br>
                    <div>
                        <button type="button" class="btn btn-info" onclick="myFunction();">Save&Add</button>
                    </div>
                    <br><br>
                    
                     <div class="col-sm-12"> 
                        <a style="cursor:pointer;" class="btn btn-primary" onclick="finalsubmission_new();" >Save partial payment</a>
                        <button type="button" class="btn btn-default" data-bs-dismiss="modal" aria-label="Close">Cancel</button>  
                    </div>
            </div>
            
            
        </div>
    </div>
</div>
</div>
<!-- PAYMENT MODAL ENDS HERE -->



                            
                            <div class="card-footer">
                                <a style="cursor:pointer;" class="btn btn-primary" onclick="formValidation();">Save</a>
                                <button type="submit" class="btn btn-default">Cancel</button>
                            </div>
                        </div> 
                        
                        
                        </form>
                            
                        
                    </div>
                    
                    
                    <div class="col-lg-4 col-md-4 col-sm-12">
                    	<div class="card" >
                            <div class="card-header">
                                <h6 class="card-title mb-0">Recent Tests</h6>
                            </div>
                        
                            <div class="card-body" >
                                    <div class="row g-4" id="recenttests" style="display:none;">
                                  
                                    </div>
                            </div>           
                    	</div> 
                    </div>
                    
                </div> <!-- .row end -->

            </div>
        </div>
                            <!-- <div class="modal fade" id="ViewRecentTestsModal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" >Tests Includes</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" id="modalBody">
    
                                        </div>
                                    </div>
                                </div>
                            </div> -->



<!--  VIEW STARTS HERE -->

                        <div class="modal fade" id="ViewRecentTestsModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="invoicenumber">Invoice #INV0011</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body custom_scroll">
                                        <table class="table table-borderless mb-0">
                                            <tbody>
                                                <tr>
                                                    <td class="text-first" id="registerdate" style="padding:0rem .6rem"> </td>
                                                    <td class="text-end" id="registertime" style="padding:0rem .6rem"> </td>
                                                    
                                                </tr>
                                                <tr>
                                                <td class="text-first" id="registerstaff" style="padding:.8rem .6rem 0rem">Registered By: <strong>Jaison</strong> </td>
                                                <td class="text-end" id="discountstaff" style="padding:.8rem .6rem 0rem">Discount Applied By: <strong>Jaison</strong> </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="padding:.8rem .6rem .2rem"><strong>Customer Details</strong> 
                                                </tr>

                                                <tr>
                                                    <td id="customerdetailsdiv" style="padding:0rem .6rem"> </td>
                                                    <td class="text-end" colspan="2" id="contactdetails"> </td>
                                                </tr>
                                                <tr>
                                                <td colspan="2" style="padding:.8rem .6rem 0rem"><strong>Tests Includes</strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <table class="table table-borderless table-striped mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center" style="width:5%">#</th>
                                                                    <th class="text-first" style="width:35%">Test Name</th>
                                                                    <th class="text-end" style="width:35%">Unit Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id=modelbody> </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

<!-- VIEW ENDS HERE -->





                            
<script src="{!! asset('assets/plugin/jquery/3.3.1/jquery.min.js') !!}"></script>
<script>

// SEARCH BY CUSTOMER NAME STARTS HERE     
$(document).ready(function(){
    $('#fname').keyup(function(){ 
        //alert('working');
        var fname = $(this).val();
        if(fname != '')
        {
            var token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ route('autocomplete.customername') }}",
                method:"POST",
                data:{fname:fname, _token:token},
                success:function(data){
                    $('#customernamelist').fadeIn();  
                    $('#customernamelist').html(data);
                }
            });
        } else {
            $('#customernamelist').fadeOut();  
            $('#customernamelist').html('');
                $('#phone').val('');
                $('#place').val('');
                $('#email').val('');
                //$('#gender').prop('selectedIndex',0);
                $('#gender option[value=""]').attr("selected", "selected");                
                $('#dob').val('');
                $('#age').val('');
                $('#maritalstatus option[value=""]').attr("selected", "selected");
                $('#bloodgroup').val('');
                $('#emergencyno').val('');   
                $('#healthissue').val('');                              
                $('#addresslineone').val('');
                $('#addresslinetwo').val('');
                $('#city').val('');
                $('#pincode').val('');
                $('#country').prop('selectedIndex',190);  // seleced saudi arabia
                $('#regfrom').prop('selectedIndex',0);
                $('#insuranceno').val('');
                $('#insuranceprovider').val('');
                $('#insurancecardno').val('');
                $('#insuranceexpirydate').val('');
                

                

                document.getElementById('tabledocumentlist').style.display = 'none';
                document.getElementById('docaddrow').style.display = 'block';
                $('#tabledocumentlist tbody').append('');


        }


    });

    $(document).on('click', '.custname', function(){  

        var custid = $(this).attr('id');
        var customertoken = $('input[name="_token"]').val();
        //alert($(this).text());
        //$('#fname').val($(this).text()); 
        $('#customernamelist').fadeOut();
        $('#customerphonelist').fadeOut();
        $('#customeriqamalist').fadeOut();
        
       // customerphonelist
        //alert(custid);
        $.ajax({

            url:'{{ route("autocomplete.registration") }}',
            method:'POST',
            data:{custid:custid, _token:customertoken},
            success:function(regidata){
               // alert('sdfsdf'); return false;
                //alert('Response cust id => '+regidata.custid);
                
                $('#fname').val(regidata.custname);
                $('#phone').val(regidata.custphone);
                $('#place').val(regidata.custplace);
                $('#email').val(regidata.custemail);
                $('#gender option[value="'+regidata.custgender+'"]').attr("selected", "selected");
               // $('#gender').prop('selectedIndex',regidata.custgender);
                $('#dob').val(regidata.custdob);
                $('#age').val(regidata.custage);
                $('#addresslineone').val(regidata.custaddone);
                $('#addresslinetwo').val(regidata.custaddtwo);
                $('#city').val(regidata.custcity);
                $('#pincode').val(regidata.custpincode);
                $('#country option[value="'+regidata.custcountry+'"]').attr("selected", "selected");
                $('#regfrom option[value="'+regidata.custregfrom+'"]').attr("selected", "selected");

                
                $('#maritalstatus option[value="'+regidata.custmaritalstatus+'"]').attr("selected", "selected");
                $('#bloodgroup').val(regidata.custbloodgroup);
                $('#emergencyno').val(regidata.custemergencyno);   
                $('#healthissue').val(regidata.custhealthissue);

                $('#insuranceno').val(regidata.custinsuranceno);
                $('#insuranceprovider').val(regidata.custinsuranceprovider);
                $('#insurancecardno').val(regidata.custinsurancecardno);
                $('#insuranceexpirydate').val(regidata.custinsuranceexpirydate);

                document.getElementById('tabledocumentlist').style.display = 'block';
                document.getElementById('docaddrow').style.display = 'none';
               //$('#docaddrow').hide();
                var dochtml ="";
                var num;
                $.each(regidata.custdocuments, function( index, doc ) {
                var num = index+1;     
                 dochtml +='<tr><td>'+num+'</td><td>'+doc.documenttype+'</td><td>'+doc.documentnumber+'</td><td>'+doc.documentexpirydate+'</td><td class="text-center"><div class="btn btn-link btn-sm text-success tooltips"><i class="fa fa-eye"></i><span class="tooltiptext"><img src="{{ url("uploads") }}/'+doc.documentfilename+'" width="120" height="auto"></span></div></td><td class="text-center" style="opacity:0.3"><i class="fa fa-trash"></i></td></tr>';
                });
                $('#tabledocumentlist tbody').html(dochtml);
                $('#recenttests').show();
                var recenttesthtml = '<div class="col-sm-6 mt-1"><label class="form-label"><strong>Invoice</strong></label></div><div class="col-sm-6 mt-1"><label class="form-label"><strong>Visiting History</strong></label></div>';
                $.each(regidata.custpreinvoice, function( index, previousresult ) {                  
                    recenttesthtml +='<div class="col-sm-6 mt-1"><label class="form-label">'+previousresult.invoice_number+'</label></div><div class="col-sm-6 mt-1"><label class="form-label"><a onclick="invoicedetails('+previousresult.id+');" class="btn btn-sm bg-success text-white">View</a>&nbsp;&nbsp;<a class="btn btn-sm bg-success text-white addtoregi" id="addtoregbtn'+previousresult.id+'" onclick="addtoregister('+previousresult.id+')">Add To Registration</a></label></div>';
                });

                $('#recenttests').html(recenttesthtml);
                
                
                
                
            }


        });


    });



});    
// SEARCH BY CUSTOMER NAME ENDS HERE

// VIEW INVOICE DETAILS STARTS HERE 
function invoicedetails(invid){
    var intoken = $('input[name="_token"]').val();
    $.ajax({
        url:"{{ route('autocomplete.viewinvoice') }}",
        method:"POST",
        data:{invoiceid:invid, _token:intoken},
        success:function(invdata){
            //var cust = invdata.customerdetails;
            //alert(cust.invoiceno); return false;
            var invoicehtml = '';
            var invoicenumber = '';
            var registerdate = '';
            var registertime = ''; 
            var customerdetailshtml =''; 
            var contactdetailshtml= '';      
            var num;
            $('#ViewRecentTestsModal').modal('show');
            $.each(invdata.invoicedetails, function( index, indetails ) { 
               // num = num+1;
               num = index+1;
                invoicehtml +='<tr><td class="text-center">'+num+'</td><td class="text-first">'+indetails.name+'</td> <td class="text-end">SR '+indetails.testrate+'</td></tr>';             
                //invoicehtml +='<div class="d-flex justify-content-between mb-1"><label class="form-check-label" for="flexCheckDefault"><strong>'+indetails.name+'</strong></label></div>';
            });
            document.getElementById('modelbody').innerHTML = invoicehtml;

            $.each(invdata.customerdetails, function( index, customer ) { 
                invoicenumber ='Invoice #'+customer.invoiceno;     
                registerdate = 'Visited Date : <strong>'+customer.registrationdate+'</strong>';
                registertime = 'Visited Time : <strong>'+customer.registrationtime+'</strong>';  
                customerdetailshtml = '<div class="fs-6 mb-1">'+customer.name+'</div><div >'+customer.addressone+'</div><div>'+customer.addrestwo+'</div><div>'+customer.place+', '+customer.city+'</div><div>'+customer.country+' - '+customer.pincode+'</div>';            
                contactdetailshtml = '<div></div><div>Email: '+customer.email+'</div><div>Phone: '+customer.phone+'</div>';
            });
            
            document.getElementById('invoicenumber').innerHTML = invoicenumber;
            document.getElementById('registerdate').innerHTML = registerdate;
            document.getElementById('registertime').innerHTML = registertime;
            document.getElementById('customerdetailsdiv').innerHTML = customerdetailshtml;
            document.getElementById('contactdetails').innerHTML = contactdetailshtml;     
            
            
            
            

        }
    });
}
// VIEW INVOICE DETAILS ENDS HERE



// SEARCH BY CUSTOMER PHONE STARTS HERE     
$(document).ready(function(){
    $('#phone').keyup(function(){ 
        //alert('working');
        var phone = $(this).val();
        if(phone != '')
        {
            var token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ route('autocomplete.phone') }}",
                method:"POST",
                data:{phone:phone, _token:token},
                success:function(data){
                    $('#customerphonelist').fadeIn();  
                    $('#customerphonelist').html(data);
                }
            });
        } else {
            $('#customerphonelist').fadeOut();  
            $('#customerphonelist').html('');
                $('#fname').val('');
                $('#place').val('');
                $('#email').val('');
                $('#gender').prop('selectedIndex',0);
                $('#dob').val('');
                $('#age').val('');
                $('#addresslineone').val('');
                $('#addresslinetwo').val('');
                $('#city').val('');
                $('#pincode').val('');
                $('#country').prop('selectedIndex',190);  // seleced saudi arabia
                $('#regfrom').prop('selectedIndex',0);
                document.getElementById('tabledocumentlist').style.display = 'none';
                document.getElementById('docaddrow').style.display = 'block';
                $('#tabledocumentlist tbody').append('');


        }


    });

});    
// SEARCH BY CUSTOMER PHONE ENDS HERE

// SEARCHING STARTS HERE
$(document).ready(function(){
 $('#testsearch').keyup(function(){ 
        var query = $(this).val();
       // alert (query);
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();

         $.ajax({
          url:"{{ route('autocomplete.searchresult') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
            $('#searchResultList').fadeIn();  
            $('#searchResultList').html(data);
          }
         });
        } else {
            $('#searchResultList').fadeOut();  
            $('#searchResultList').html('');
        }
    });

    $(document).on('click', '.testname', function(){  
        //testname
        var testid = $(this).attr('id');
      var listtoken = $('input[name="_token"]').val();
           
        $('#testsearch').val($(this).text()); 
        document.getElementById('testsearch').select(); 
        $('#searchResultList').fadeOut();
        
        $.ajax({
            url:'{{ route("autocomplete.testslistresult") }}',
            method:'POST',
            data:{id:testid, _token:listtoken},
            success:function(testdata){
               // alert(testdata.taxmethod);
               // return false;
                var calculateTax;
                var calculateAmount;
                var unitprice;
                var taxAmt;
                var subtotal; 
                var roundedunitprice;
                var roundedsubtotal;
                var taxmethod = testdata.taxmethod;
                var taxtype = testdata.taxtype;
                var tax = Number(testdata.taxrate);
                var roundedsubtotalprice;
                var roundedtotaltax;
                var roundedtotalprice;
                //alert(tax);
                //return false;

                var price = Number(testdata.primaryprice);
                if(taxmethod == 'inclusive' && taxtype == 'fixed'){
                    unitprice =   (price-tax);                    
                    subtotal  = (unitprice+tax);
                    roundedunitprice = unitprice.toFixed(2);
                    taxAmt = tax.toFixed(2);
                    roundedsubtotal = subtotal.toFixed(2);
                    //alert('inclusive -> tax->'+taxAmt+' unitprice->'+roundedunitprice+' Subtotal->'+roundedsubtotal);
                    //return false;
                }else if(taxmethod == 'exclusive' && taxtype == 'fixed'){
                    unitprice  =  price;
                    
                    taxAmt = tax;                    
                    subtotal  = (unitprice+tax);
                    roundedunitprice = unitprice.toFixed(2);
                    taxAmt = tax.toFixed(2);
                    roundedsubtotal = subtotal.toFixed(2);
                    //alert('exclusive -> tax->'+taxAmt+' unitprice->'+roundedunitprice+' Subtotal->'+roundedsubtotal);
                    //return false;

                }else if(taxmethod == 'inclusive' && taxtype == 'percentage'){

                    calculateTax = (100+tax);
                    calculateAmount = (price*100);
                    actualPrice    =   (calculateAmount/calculateTax);
                    taxAmt = (price-actualPrice);
                   
                    unitprice = actualPrice;
                   
                    taxAmt = taxAmt;
                    subtotal = (unitprice+taxAmt);
                    roundedunitprice = unitprice.toFixed(2);
                    taxAmt = taxAmt.toFixed(2);
                    roundedsubtotal = subtotal.toFixed(2);
                    //alert('inclusive -> tax->'+taxAmt+' unitprice->'+roundedunitprice+' Subtotal->'+roundedsubtotal);
                    //return false;
                } else {

                    
                    calculateAmount = (price*tax);
                    taxAmt    =   (calculateAmount/100);
                    unitprice = price;
                    subtotal = (unitprice+taxAmt);
                    taxAmt = taxAmt.toFixed(2);
                    roundedunitprice = unitprice.toFixed(2);
                    roundedsubtotal = subtotal.toFixed(2);
                    //alert(calculateAmount+'tax->'+taxAmt+' unitprice->'+roundedunitprice+' Subtotal->'+roundedsubtotal);
                    //return false;

                }

                
                var testname = testdata.testname;
                
                //var subtotal = parseInt(price+tax);

                var testid = testdata.testid;    
                var searchListTable = document.getElementById('tableselectedtest').getElementsByTagName('tbody')[0];
                var alllistnums = searchListTable.rows.length;
                var listcounts = alllistnums+1;
                var listtrhtml='<tr><td class="text-center"><span class="btn btn-link btn-sm text-danger remove" ><i class="fa fa-trash"></i></span></td><td>'+testname+'<input type="hidden" name="inputtestid[]" value="'+testid+'"></td><td class="text-end">SR <span class="price">'+roundedunitprice+'</span><input type="hidden" name="inputunitprice[]" value="'+roundedunitprice+'"></td><td class="text-center"><select class="form-select form-select-sm"><option value="0">Nil</option></select><input type="hidden" name="inputdiscount[]" value="0"></td><td class="text-end">SR <span class="tax">'+taxAmt+'</span><input type="hidden" name="inputtax[]" value="'+taxAmt+'"></td><td class="text-end">SR <span class="subtotal">'+roundedsubtotal+'</span><input type="hidden" name="inputsubtotal[]" value="'+roundedsubtotal+'"></td></tr>';
                var newListRow = searchListTable.insertRow(searchListTable.rows.length);

                if(document.getElementById('tableselectedtest').style.display == 'none'){
                    document.getElementById('testheading').style.display = 'block';
                    document.getElementById('tableselectedtest').style.display = 'block';
                    newListRow.innerHTML = listtrhtml;
                } else {
                    newListRow.innerHTML = listtrhtml;
                }
                // TOTAL TAX CALCULATE STARTS HERE 
                var totaltax = 0;
                $('.tax').each(function(index){
                    var eachtax = $(this).text();
                    var taxValue = Number(eachtax);
                    totaltax += taxValue;
                    roundedtotaltax = totaltax.toFixed(2);
                });
                $('#totaltax').html('<strong>SR '+roundedtotaltax+'</strong>');
                $('#hiddentotaltax').val(roundedtotaltax);
                // TOTAL TAX CALCULATE ENDS HERE 

                // TOTAL PRICE CALCULATE STARTS HERE 
                var totalprice = 0;
                $('.price').each(function(index){
                    var eachprice = $(this).text();
                    var priceValue = Number(eachprice);
                    totalprice += priceValue;
                    roundedtotalprice = totalprice.toFixed(2);
                });
                $('#totalunitprice').html('<strong>SR '+roundedtotalprice+'</strong>');
                // TOTAL PRICE CALCULTE ENDS HERE

                // TOTAL SUBTOTAL STARTS HERE
                var subtotalprice = 0;
                $('.subtotal').each(function(index){
                    var eachsubtotal = $(this).text();
                    var subtotalValue = Number(eachsubtotal);
                    subtotalprice += subtotalValue;
                    roundedsubtotalprice = subtotalprice.toFixed(2);
                });
                $('#totalsubtotal').html('<strong>SR '+roundedsubtotalprice+'</strong>');    
                $('#hiddentotalsubtotal').val(roundedsubtotalprice);
                $('#hiddentotaldiscount').val('0');
                $('#finalpricetotal').html('<strong>SR '+roundedtotalprice+'</strong>'); 
                $('#finaltaxtotal').html('<strong>SR '+roundedtotaltax+'</strong>'); 
                $('#finaldiscounttotal').html('<strong>SR 0.00</strong>'); 
                $('#finaltotal').html('<strong>SR '+roundedsubtotalprice+'</strong>'); 
                
                
                
                // TOTAL SUBTOTAL ENDS HERE
                
                
            }


        });
        
    });  

});

// tableselectedtest

$('#tableselectedtest').on('click', '.remove', function () {
    var confirmalert = confirm("Are you sure to delete?");
        if (confirmalert == true) {

                

            //var child = $(this).closest('tr').nextAll();
            $(this).closest('tr').remove();

            
            $('#testsearch').val(''); 

            // TOTAL TAX CALCULATE STARTS HERE 
                var totaltax = 0;
                $('.tax').each(function(index){
                    //var roundtotaltax;
                    var eachtax = $(this).text();
                    var taxValue = Number(eachtax);
                    totaltax += taxValue;
                    roundedtotaltax = totaltax.toFixed(2);
                    //roundtotaltax = totaltax.toFixed(2);
                });
                $('#totaltax').html('<strong>SR '+totaltax.toFixed(2)+'</strong>');
                $('#hiddentotaltax').val(totaltax);
                // TOTAL TAX CALCULATE ENDS HERE 

                // TOTAL PRICE CALCULATE STARTS HERE 
                var totalprice = 0;
                $('.price').each(function(index){
                    var eachprice = $(this).text();
                    var priceValue = parseInt(eachprice);
                    totalprice += priceValue;
                    roundedtotalprice = totalprice.toFixed(2);
                });
                $('#totalunitprice').html('<strong>SR '+totalprice.toFixed(2)+'</strong>');
                // TOTAL PRICE CALCULTE ENDS HERE

                // TOTAL SUBTOTAL STARTS HERE
                var subtotalprice = 0;
                $('.subtotal').each(function(index){
                    var eachsubtotal = $(this).text();
                    var subtotalValue = parseInt(eachsubtotal);
                    subtotalprice += subtotalValue;
                    roundedsubtotalprice = subtotalprice.toFixed(2);
                });
                $('#totalsubtotal').html('<strong>SR '+subtotalprice.toFixed(2)+'</strong>');
                $('#hiddentotalsubtotal').val(subtotalprice);
                $('#hiddentotaldiscount').val('0');


                $('#totalsubtotal').html('<strong>SR '+roundedsubtotalprice+'</strong>');    
                $('#hiddentotalsubtotal').val(roundedsubtotalprice);
                $('#hiddentotaldiscount').val('0');
                $('#finalpricetotal').html('<strong>SR '+roundedtotalprice+'</strong>'); 
                $('#finaltaxtotal').html('<strong>SR '+roundedtotaltax+'</strong>'); 
                $('#finaldiscounttotal').html('<strong>SR 0.00</strong>'); 
                $('#finaltotal').html('<strong>SR '+roundedsubtotalprice+'</strong>');


/*
                $('#totalsubtotal').html('<strong>SR '+subtotalprice+'</strong>');    
                $('#hiddentotalsubtotal').val(subtotalprice);
                $('#hiddentotaldiscount').val('0');
                $('#finalpricetotal').html('<strong>SR '+roundedtotalprice+'</strong>'); 
                $('#finaltaxtotal').html('<strong>SR '+roundedtotaltax+'</strong>'); 
                $('#finaldiscounttotal').html('<strong>SR 0.00</strong>'); 
                $('#finaltotal').html('<strong>SR '+subtotalprice+'</strong>'); 
*/




                var listtable = document.getElementById('tableselectedtest').getElementsByTagName('tbody')[0];
                    var rowslisttable = listtable.rows.length;

                if(rowslisttable == '0'){
                    document.getElementById('testheading').style.display = 'none';
                    document.getElementById('tableselectedtest').style.display = 'none';
                }
            



        }
 
});


// SEARCHING ENDS HERE 



function addtoregister(invid){
    //alert(invid);
    var intoken = $('input[name="_token"]').val();
    $.ajax({
        url:"{{ route('autocomplete.addtoregister') }}",
        method:"POST",
        data:{invoiceid:invid, _token:intoken},
        success:function(invdata){
            //$('#addtoregbtn'+invid).toggleClass("bg-danger");
           
            var listtrhtml = '';
            var calculateTax;
            var calculateAmount;
            var unitprice;
            var taxAmt;
            var subtotal;
            var roundedunitprice;
            var roundedsubtotal;
            var taxmethod;
            var taxtype;
            var tax;
            var roundedsubtotalprice;
            var roundedtotaltax;            
            var roundedtotalprice;
            var price;

            var testname;
            var testid;  

            $.each(invdata.invoicedetails, function( index, indetails ) {   
                taxmethod = indetails.taxmethod;
                taxtype = indetails.taxtype;
                tax = Number(indetails.taxrate);
                price = Number(indetails.primaryprice);
                if(taxmethod == 'inclusive' && taxtype == 'fixed'){
                    unitprice =   (price-tax);                    
                    subtotal  = (unitprice+tax);
                    roundedunitprice = unitprice.toFixed(2);
                    taxAmt = tax.toFixed(2);
                    roundedsubtotal = subtotal.toFixed(2);
                    //alert('inclusive -> tax->'+taxAmt+' unitprice->'+roundedunitprice+' Subtotal->'+roundedsubtotal);
                    //return false;
                }else if(taxmethod == 'exclusive' && taxtype == 'fixed'){
                    unitprice  =  price;
                    
                    taxAmt = tax;                    
                    subtotal  = (unitprice+tax);
                    roundedunitprice = unitprice.toFixed(2);
                    taxAmt = tax.toFixed(2);
                    roundedsubtotal = subtotal.toFixed(2);
                    //alert('exclusive -> tax->'+taxAmt+' unitprice->'+roundedunitprice+' Subtotal->'+roundedsubtotal);
                    //return false;

                }else if(taxmethod == 'inclusive' && taxtype == 'percentage'){

                    calculateTax = (100+tax);
                    calculateAmount = (price*100);
                    actualPrice    =   (calculateAmount/calculateTax);
                    taxAmt = (price-actualPrice);
                   
                    unitprice = actualPrice;
                   
                    taxAmt = taxAmt;
                    subtotal = (unitprice+taxAmt);
                    roundedunitprice = unitprice.toFixed(2);
                    taxAmt = taxAmt.toFixed(2);
                    roundedsubtotal = subtotal.toFixed(2);
                    //alert('inclusive -> tax->'+taxAmt+' unitprice->'+roundedunitprice+' Subtotal->'+roundedsubtotal);
                    //return false;
                } else {

                    
                    calculateAmount = (price*tax);
                    taxAmt    =   (calculateAmount/100);
                    unitprice = price;
                    subtotal = (unitprice+taxAmt);
                    taxAmt = taxAmt.toFixed(2);
                    roundedunitprice = unitprice.toFixed(2);
                    roundedsubtotal = subtotal.toFixed(2);
                    //alert(calculateAmount+'tax->'+taxAmt+' unitprice->'+roundedunitprice+' Subtotal->'+roundedsubtotal);
                    //return false;

                }
                testname = indetails.testname;
                testid = indetails.testid;  

                listtrhtml +='<tr><td class="text-center"><span class="btn btn-link btn-sm text-danger remove" ><i class="fa fa-trash"></i></span></td><td>'+testname+'<input type="hidden" name="inputtestid[]" value="'+testid+'"></td><td class="text-end">SR <span class="price">'+roundedunitprice+'</span><input type="hidden" name="inputunitprice[]" value="'+roundedunitprice+'"></td><td class="text-center"><select class="form-select form-select-sm"><option value="0">Nil</option></select><input type="hidden" name="inputdiscount[]" value="0"></td><td class="text-end">SR <span class="tax">'+taxAmt+'</span><input type="hidden" name="inputtax[]" value="'+taxAmt+'"></td><td class="text-end">SR <span class="subtotal">'+roundedsubtotal+'</span><input type="hidden" name="inputsubtotal[]" value="'+roundedsubtotal+'"></td></tr>';
            });
           
            if(document.getElementById('tableselectedtest').style.display == 'none'){
              //  alert('none');
                    document.getElementById('testheading').style.display = 'block';
                    document.getElementById('tableselectedtest').style.display = 'block';
                   // newListRow.innerHTML = listtrhtml;
                   
                   document.getElementById('testresult').innerHTML = listtrhtml;
                } else {
                   // newListRow.innerHTML = listtrhtml;
                   document.getElementById('testresult').innerHTML = listtrhtml;
                }

                var totaltax = 0;
                $('.tax').each(function(index){
                    var eachtax = $(this).text();
                    var taxValue = Number(eachtax);
                    totaltax += taxValue;
                    roundedtotaltax = totaltax.toFixed(2);
                });
                $('#totaltax').html('<strong>SR '+roundedtotaltax+'</strong>');
                $('#hiddentotaltax').val(roundedtotaltax);
                // TOTAL TAX CALCULATE ENDS HERE 

                // TOTAL PRICE CALCULATE STARTS HERE 
                var totalprice = 0;
                $('.price').each(function(index){
                    var eachprice = $(this).text();
                    var priceValue = Number(eachprice);
                    totalprice += priceValue;
                    roundedtotalprice = totalprice.toFixed(2);
                });
                $('#totalunitprice').html('<strong>SR '+roundedtotalprice+'</strong>');
                // TOTAL PRICE CALCULTE ENDS HERE

                // TOTAL SUBTOTAL STARTS HERE
                var subtotalprice = 0;
                $('.subtotal').each(function(index){
                    var eachsubtotal = $(this).text();
                    var subtotalValue = Number(eachsubtotal);
                    subtotalprice += subtotalValue;
                    roundedsubtotalprice = subtotalprice.toFixed(2);
                });
                $('#totalsubtotal').html('<strong>SR '+roundedsubtotalprice+'</strong>');    
                $('#hiddentotalsubtotal').val(roundedsubtotalprice);
                $('#hiddentotaldiscount').val('0');
                $('#finalpricetotal').html('<strong>SR '+roundedtotalprice+'</strong>'); 
                $('#finaltaxtotal').html('<strong>SR '+roundedtotaltax+'</strong>'); 
                $('#finaldiscounttotal').html('<strong>SR 0.00</strong>'); 
                $('#finaltotal').html('<strong>SR '+roundedsubtotalprice+'</strong>');

                $('.addtoregi').removeClass('bg-danger').addClass('bg-success');
                $('#addtoregbtn'+invid).toggleClass("bg-danger");
                 
                

           

        }
    });

}

</script>





<script type='text/javascript' src="{!! asset('assets/bundles/jquery.inputmask.bundle.js') !!}"></script>
<script>
var $j = jQuery.noConflict();
//var $k = jQuery.noConflict();
$j(document).ready(function(){
        $j('#docexpirydate').inputmask('99/99/9999',{placeholder:"dd/mm/yyyy"});
        $j('#dob').inputmask('99/99/9999',{placeholder:"dd/mm/yyyy"});
        $j('#insuranceexpirydate').inputmask('99/99/9999',{placeholder:"dd/mm/yyyy"});
});

/*
$k(document).ready(function(){
    $k('#payment').modal({backdrop: 'static', keyboard: false}); 
    //$('#payment').openModal({dismissible:false});
});
*/
</script>



<script>
function finalsubmission() {
       var paidamt = Number(document.newregistration.paidamount.value);
    var finalpaidamt = paidamt.toFixed(2);
    //alert(document.newregistration.paidamount.value.toFixed(2));
    //return false;
    
    document.getElementById('paymentmethodalert').style.display = 'none';
    document.getElementById('paidamountalert').style.display = 'none';
    if(document.newregistration.paymentmethod.value =='0' && document.newregistration.paidamount.value !='')
    {
        document.getElementById('paymentmethodalert').style.display = 'block';
        return false;
    }
    if(document.newregistration.paymentmethod.value !='0' && document.newregistration.paidamount.value =='')
    {
        document.getElementById('paidamountalert').style.display = 'block';
        return false;
    } if((document.newregistration.paidamount.value !='') &&  (IsNumeric(document.newregistration.paidamount.value)==false)){
            document.getElementById('paidamountalert').style.display = 'block'; 
            document.getElementById("paidamountalert").innerHTML="Invalid amount number! Please re-enter";
            document.newregistration.paidamount.select();
            document.newregistration.paidamount.focus(); 
            return false;
        }
    if(document.newregistration.paymentmethod.value !='0' && finalpaidamt > document.newregistration.hiddentotalsubtotal.value){
        document.getElementById('paidamountalert').style.display = 'block';
        document.getElementById('paidamountalert').innerHTML = 'Paid amount is greater than total amount. Please re-enter!';
        document.newregistration.paidamount.select();
        return false;
    }
     
     
    //  document.newregistration.paidamount.disabled = true;
    //  document.newregistration.submit();

    document.newregistration.submit();  
    return true;

}


function formValidation() 
{   
   /* $('#payment').modal('show');
    return false;  */

    document.getElementById('namealert').style.display = 'none';
    document.getElementById('phonealert').style.display = 'none';
    document.getElementById('placealert').style.display = 'none';
    document.getElementById('emailalert').style.display = 'none';    
    document.getElementById('genderalert').style.display = 'none';
    document.getElementById('dobalert').style.display = 'none';
    document.getElementById('agealert').style.display = 'none';
    document.getElementById('maritalstatusalert').style.display = 'none';
    document.getElementById('addonealert').style.display = 'none';
    document.getElementById('countryalert').style.display = 'none';
    document.getElementById('provideralert').style.display = 'none'; 
    document.getElementById('idproofalert').style.display = 'none';
    document.getElementById('testlistalert').style.display = 'none';
    document.getElementById('documenttypealert').style.display = 'none'; 
    document.getElementById('documentnumberalert').style.display = 'none';
    document.getElementById('docexpirydatealert').style.display = 'none';
    document.getElementById('docattachementalert').style.display = 'none'; 
    
    var doctable = document.getElementById('tabledocumentlist').getElementsByTagName('tbody')[0];
    var doctbltr = doctable.rows.length;

    var testlisttable =  document.getElementById('tableselectedtest').getElementsByTagName('tbody')[0];
    var testlisttbltr = testlisttable.rows.length;

	    if(document.newregistration.fname.value == ''){
        	document.getElementById('namealert').style.display = 'block'; 
        	document.newregistration.fname.focus();  
        	return false;     
    	} if(document.newregistration.phone.value == ''){
        	document.getElementById('phonealert').style.display = 'block'; 
        	document.newregistration.phone.focus();  
        	return false;     
    	}  if(IsNumeric(document.newregistration.phone.value)==false){
            document.getElementById('phonealert').style.display = 'block'; 
            document.getElementById("phonealert").innerHTML="Invalid contact number! Please re-enter";
            document.newregistration.phone.select();
            document.newregistration.phone.focus(); 
            return false;
        }  if(document.newregistration.place.value == ''){
        	document.getElementById('placealert').style.display = 'block'; 
        	document.newregistration.place.focus();  
        	return false;     
        }  if(document.newregistration.email.value != '') {
            var emails = document.getElementById('email');
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!filter.test(emails.value)) {
                document.getElementById('emailalert').style.display = 'block'; 
                document.getElementById("emailalert").innerHTML="Invalid email address! Please re-enter";
                document.newregistration.email.select();
                document.newregistration.email.focus();
                return false;
            } 
        }  if(document.newregistration.gender.value == ''){
        	document.getElementById('genderalert').style.display = 'block'; 
        	document.newregistration.gender.focus();  
        	return false;     
    	}  if(document.newregistration.dob.value == ''){
        	document.getElementById('dobalert').style.display = 'block'; 
        	document.newregistration.dob.focus();  
        	return false;     
    	}  if((document.newregistration.age.value != '') && (IsNumeric(document.newregistration.age.value)==false)){
                document.getElementById('agealert').style.display = 'block'; 
                document.getElementById("agealert").innerHTML="Invalid age! Please re-enter";
                document.newregistration.age.select();
                document.newregistration.age.focus(); 
            return false;
    	} if((document.newregistration.age.value != '') && (document.newregistration.age.value > 130)){
                document.getElementById('agealert').style.display = 'block'; 
                document.getElementById("agealert").innerHTML="Invalid age! Please re-enter";
                document.newregistration.age.select();
                document.newregistration.age.focus(); 
            return false;
    	} if(document.newregistration.maritalstatus.value == ''){
        	document.getElementById('maritalstatusalert').style.display = 'block'; 
        	document.newregistration.maritalstatus.focus();  
        	return false;     
    	} if(document.newregistration.addresslineone.value == ''){
        	document.getElementById('addonealert').style.display = 'block'; 
        	document.newregistration.addresslineone.focus();  
        	return false;     
    	}  if(document.newregistration.country.value == ''){
        	document.getElementById('countryalert').style.display = 'block'; 
        	document.newregistration.country.focus();  
        	return false;     
    	}if(document.newregistration.insuranceprovider.value == ''){
        	document.getElementById('provideralert').style.display = 'block'; 
        	document.newregistration.insuranceprovider.focus();  
        	return false;     
    	}
    	if(doctbltr == 0){
            //alert('asdasd'+doctbltr);

            document.getElementById('idproofalert').style.display = 'block'; 
        	//document.newregistration.country.focus();  
        	return false; 
        } if(testlisttbltr == 0) {
            document.getElementById('testlistalert').style.display = 'block'; 
            return false;
        }
       // alert(doctbltr);
//return false;
   //document.newregistration.submit();  
    var total = document.getElementById("finaltotal").innerText;
   
   var myArray = total.split("SR");
   var strval = myArray.join("");
    
   var strval = myArray.join("");
    $('#totalamont').val(strval);
    // $('#payment').modal('show');
    document.newregistration.submit();  
    return false;   
}


// DOCUMENT ATTACHMENT FILE STARTS HERE 
function documentAttachValidation() {
   
    var fileInput = document.getElementById('docattachement');
    var filePath = fileInput.value;
    // Allowing file type
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|.pdf)$/i;
            if (!allowedExtensions.exec(filePath)) {
               //alert('Invalid file type');
                //fileInput.value = '';
                document.getElementById('docattachementalert').style.display = 'block'; 
                document.getElementById('docattachementalert').innerHTML = 'Upload only image';
                return false;
            } else {
                document.getElementById('docattachementalert').style.display = 'none'; 
            }
}
// DOCUMENT ATTACHMENT FILE ENDS HERE


// DOCUMENT ADDING STARTS HERE
function documentsValidation() 
    {
        document.getElementById('idproofalert').style.display = 'none';
        document.getElementById('documenttypealert').style.display = 'none'; 
        document.getElementById('documentnumberalert').style.display = 'none';
        document.getElementById('docexpirydatealert').style.display = 'none';
        document.getElementById('docattachementalert').style.display = 'none'; 


    if(document.newregistration.documenttype.value == ''){
        document.getElementById('documenttypealert').style.display = 'block'; 
        document.newregistration.documenttype.focus();  
        return false;     
    } else if(document.newregistration.documentnumber.value == ''){
        document.getElementById('documentnumberalert').style.display = 'block'; 
        document.newregistration.documentnumber.focus();  
        return false;     
    } else if(document.newregistration.docexpirydate.value == ''){
        document.getElementById('docexpirydatealert').style.display = 'block'; 
        document.newregistration.docexpirydate.focus();  
        return false;     
    } else if(document.getElementById('docattachement').files.length == 0 ){
                document.getElementById('docattachementalert').style.display = 'block';
                document.getElementById('docattachementalert').innerHTML = 'Upload only image';
                return false;
    } else {
        
                var fileInput = document.getElementById('docattachement');
                var filePath = fileInput.value;
                // Allowing file type
                var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|.pdf)$/i;
                    if (!allowedExtensions.exec(filePath)) {
                        document.getElementById('docattachementalert').style.display = 'block';
                        document.getElementById('docattachementalert').innerHTML = 'Upload only image';
                        return false;
                    } 
    }

    var tokenadd = document.querySelector('meta[name="csrf-token"]').getAttribute("content"); 
    var files = $('#docattachement')[0].files;
    var dtype = $('#documenttype').val();
    var dnumber= $('#documentnumber').val();
    var dexpirydate= $('#docexpirydate').val();
    var tempcustid= $('#tempcustid').val();

    var fd = new FormData();
    
         // Append data 
         fd.append('file',files[0]);
         fd.append('_token',tokenadd);
         fd.append('dtype',dtype);
         fd.append('dnumber',dnumber);
         fd.append('dexpirydate',dexpirydate);
         fd.append('token',tempcustid);
    // var filename  = files[0];
         $.ajax({
            url:"{{ 'custdocumentadd' }}",
           method: 'POST',
           data: fd,
           contentType: false,
           processData: false,
           dataType: 'json',
           success: function(response){
               //alert(response.success);
            if(response.success == 1){ // Uploaded successfully
                //alert(response.documenttype);
                $("#docattachement").val('');
                $("#documenttype").val('');
                $("#documentnumber").val('');
                $("#docexpirydate").val('');

                var tableRef = document.getElementById('tabledocumentlist').getElementsByTagName('tbody')[0];
                var nums = tableRef.rows.length;
                var counts = nums+1;
               
                //var nums = ((tableRef.rows.length)+1);
                //  var myHtmlContent='<tr><td>'+counts+'</td><td style="width:200px;">'+response.documenttype+'</td><td style="width:250px;">'+response.documentnumber+'</td><td style="width:250px;">'+response.documentexpirydate+'</td><td class="text-center"><div class="btn btn-link btn-sm text-success tooltips"><i class="fa fa-eye"></i><span class="tooltiptext"><img src="{{ url("uploads") }}/'+response.documentfile+'" width="120" height="auto"></span></div></td><td class="text-center"><span class="btn btn-link btn-sm text-danger delete" onclick="return deletedoc(0,'+response.documentid+',this);"><i class="fa fa-trash"></i></span></td></tr>';
                var myHtmlContent='<tr><td>'+counts+'</td><td style="width:200px;">'+response.documenttype+'</td><td style="width:250px;">'+response.documentnumber+'</td><td style="width:250px;">'+response.documentexpirydate+'</td></tr>';
                
                var newRow = tableRef.insertRow(tableRef.rows.length);

                if(document.getElementById('tabledocumentlist').style.display == 'none'){
                document.getElementById('tabledocumentlist').style.display = 'block';
                    newRow.innerHTML = myHtmlContent;
                } else {
                    newRow.innerHTML = myHtmlContent;
                }
            }

           }, error: function(response){
              console.log("error : " + JSON.stringify(response) );
           }

        });

    
}
// DOCUMENTS ADDING ENDS HERE

// DOCUMENT DELETING STARTS HERE  
function deletedoc(cid,deleteid,trid){
    var tokendel = document.querySelector('meta[name="csrf-token"]').getAttribute("content");  
    var confirmalert = confirm("Are you sure to delete?");
    if (confirmalert == true) {
        // AJAX Request
        $.ajax({
            url:"{{ 'custdocumentdelete' }}",
            type: 'POST',
            data: { 
                id:deleteid,
                custid:cid,
                _token:tokendel
            },
            success: function(response){
                
                if(response.success == 1){      
                    // HIDE TABLE IF NOT RECORDS FOUND STARTS HERE
                    if(response.doccount == 0 ){
                        document.getElementById('tabledocumentlist').style.display = 'none';
                    }        
                    // HIDE TABLE IF NOT RECORDS FOUND ENDS HERE
                    // REMOVE CORRESPONDING COLUMN AFTER DELETE
                        $tr= $(trid).closest("tr");
                        $tr.find('td').fadeOut(700, function () {
                        $tr.remove();    
                    });

                }else{
                alert('Invalid ID.');
                }

            }
        });
    }

}
// DOCUMENT DELETING STARTS HERE  







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

<script>
  function myFunction() {
      
    //   alert("hiiiii");
      
            var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            var paymentmethod = $('#paymentmethod').val();
            var payamount= $('#totalamont').val();
            
            var fd = new FormData();
            fd.append('paymentmethod',paymentmethod);
            fd.append('totalamont',totalamont);
            
        $.ajax({
              url:"{{ 'paymentadd' }}",
              method: 'POST',
              data: fd,
              contentType: false,
              processData: false,
              dataType: 'json',
              success: function(response){
                  
               
               
          }
        });
    
        }
</script>
<script>

  function createOrUpdateGrid() {
  // Create or update the grid using jQuery
  $('#grid-container').empty(); // Clear the grid if it already exists
  var grid = $('<table>').attr('id', 'myGrid').addClass('table');
  var header = $('<thead>').append($('<tr>').append($('<th>').text('Column 1')).append($('<th>').text('Column 2')));
  var body = $('<tbody>').append($('<tr>').append($('<td>').text('Row 1 Column 1')).append($('<td>').text('Row 1 Column 2')).append($('<tr>').append($('<td>').text('Row 2 Column 1')).append($('<td>').text('Row 2 Column 2'))));
  grid.append(header).append(body);
  $('#grid-container').append(grid);
}

</script>



<script>
  $(document).ready(function() {
  $('#add-button').click(function() {
    var grid = $('<div class="grid"></div>');
    $('#payment').append(grid);
  });
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#fullypaid').change(function() {
            if ($(this).is(':checked')) {
                $('#div1').show();
                $('#div2').show();
            } else {
                $('#div1').hide();
                $('#div2').hide();
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#partiallypaid').change(function() {
            if ($(this).is(':checked')) {
                $('#divnew').show();
                $('#divnew1').show();
            } else {
                $('#divnew').hide();
                $('#divnew1').hide();
            }
        });
    });
</script>





<script type="text/javascript">
function getValue(x) {
  if(x.value == 'full'){
    document.getElementById("full_payment").style.display = 'block';
    document.getElementById("partial_payment").style.display = 'none'; 
  }
  else{
    document.getElementById("partial_payment").style.display = 'block';
    document.getElementById("full_payment").style.display = 'none';
  }
}


</script>

<script>
    function finalsubmission_new() {
        
        // alert("save");
//     var paidamt = Number(document.newregistration.paidamount.value);
//     var finalpaidamt = paidamt.toFixed(2);
//     //alert(document.newregistration.paidamount.value.toFixed(2));
//     //return false;
    
//     document.getElementById('paymentmethodalert').style.display = 'none';
//     document.getElementById('paidamountalert').style.display = 'none';
//     if(document.newregistration.paymentmethod.value =='0' && document.newregistration.paidamount.value !='')
//     {
//         document.getElementById('paymentmethodalert').style.display = 'block';
//         return false;
//     }
//     if(document.newregistration.paymentmethod.value !='0' && document.newregistration.paidamount.value =='')
//     {
//         document.getElementById('paidamountalert').style.display = 'block';
//         return false;
//     } if((document.newregistration.paidamount.value !='') &&  (IsNumeric(document.newregistration.paidamount.value)==false)){
//             document.getElementById('paidamountalert').style.display = 'block'; 
//             document.getElementById("paidamountalert").innerHTML="Invalid amount number! Please re-enter";
//             document.newregistration.paidamount.select();
//             document.newregistration.paidamount.focus(); 
//             return false;
//         }
//     if(document.newregistration.paymentmethod.value !='0' && finalpaidamt > document.newregistration.hiddentotalsubtotal.value){
//         document.getElementById('paidamountalert').style.display = 'block';
//         document.getElementById('paidamountalert').innerHTML = 'Paid amount is greater than total amount. Please re-enter!';
//         document.newregistration.paidamount.select();
//         return false;
//     }
// /* 
//     if(document.newregistration.paymenttype.value =='partial' && document.newregistration.paidamount.value =='')
//     {
//         document.getElementById('paidamountalert').innerHTML = 'Please enter amount';
//         document.getElementById('paidamountalert').style.display = 'block';
//         return false;
//     }
// */
     
//     document.newregistration.submit();  
//     return true;

}


// SEARCH BY CUSTOMER IQAMA STARTS HERE     
$(document).ready(function(){
    $('#iqama').keyup(function(){ 
        //alert('working');
        var iqama = $(this).val();
        if(iqama != '')
        {
            var token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ route('autocomplete.iqama') }}",
                method:"POST",
                data:{iqama:iqama, _token:token},
                success:function(data){
                    $('#customeriqamalist').fadeIn();  
                    $('#customeriqamalist').html(data);
                }
            });
        } else {
            $('#customeriqamalist').fadeOut();  
            $('#customeriqamalist').html('');
                $('#fname').val('');
                $('#place').val('');
                $('#email').val('');
                $('#gender').prop('selectedIndex',0);
                $('#dob').val('');
                $('#age').val('');
                $('#addresslineone').val('');
                $('#addresslinetwo').val('');
                $('#city').val('');
                $('#pincode').val('');
                $('#country').prop('selectedIndex',190);  // seleced saudi arabia
                $('#regfrom').prop('selectedIndex',0);
                document.getElementById('tabledocumentlist').style.display = 'none';
                document.getElementById('docaddrow').style.display = 'block';
                $('#tabledocumentlist tbody').append('');


        }


    });

});    
// SEARCH BY CUSTOMER IQAMA ENDS HERE

</script>




<script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>
@endsection
