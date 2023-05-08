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
</style>
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
   <div class="container-fluid">
      <div class="row">
         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <!--COL 8 STARTS HERE -->
            <div class="row g-2 row-deck">
               <div class="col-xl-12">
                  <div class="card">
                     <div class="card-header">
                        <h6 class="card-title m-0">Expense</h6>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-sample-type">Add Expense</a>
                     </div>
                     @if(\Session::get('success'))
                     <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                        {{ \Session::get('success') }}
                     </div>
                     @endif
                     <div class="card-body">
                        <table id="payment-method" class="table card-table table-hover align-middle mb-0" style="width: 100%;">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Expense Category</th>
                                 <th>Title</th>
                                 <th>Date</th>
                                 <th>Amount</th>
                                 <th>Note</th>
                                 <th style="width:7%"class="text-center">Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($expense as $value)
                              <tr>
							   
                                 <td>#</td>
                                 <td>{{ $value->expensecategory}}</td>
                                 <td>{{ $value->title}}</td>
                                 <td>{{ $value->date}}</td>
                                 <td>{{ $value->amount}}</td>
                                 <td>{{ $value->note}}</td>
                                 <td class="text-center">
                                 <!-----   <a  onclick="editview('{{$value->id}}');"class="btn btn-link btn-sm text-secondry" data-bs-toggle="modal"  data-bs-target="#edit-sample-type{{ $value->id }}">
                                    <i class="fa fa-edit" style="color:#555CB8;"></i>
                                    </a>---->
                                    <a href="{{'delete-expense/'.$value->id}}"  onclick="return confirm('Do you want to delete this Expense?')" class="btn btn-link btn-sm text-delete" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" aria-label="Active">
                                        <i class="fa fa-trash" style="color:#198754;"></i>                                                                
                                    </a>
                                    <a  onclick="viewexpense('{{ $value->id }}');"class="btn btn-link btn-sm text-secondry" data-bs-toggle="modal" data-bs-target="#viewexpense{{$value->id}}">
                                        <i class="fa fa-eye" style="color:#555CB8;"></i>
                                    </a>
                                    <!-- <a href="" class="btn btn-link btn-sm text-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete" aria-label="Delete">
                                       <i class="fa fa-trash"></i>
                                       </a> -->
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                     <!-- Modal -->
                  </div>
               </div>
            </div>
            <!-- ADD MODAL STARTS HERE -->
            <form class="row g-3" id="addexpense" name="addexpense" method="post" action="{{ route('addexpense.add') }}">
               @csrf
               <div class="modal fade" id="add-sample-type" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-scrollable">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Add Expense</h5>
                           <button type="button" id="add-modal-close-x" class="btn-close"></button>
                        </div>
                        <div class="modal-body custom_scroll">
                           <div class="row g-12">
                              <div class="col-sm-6">
                                 <label class="form-label">Expense Category <span class="red">*</span></label>
                                 <select class="form-select form-select-lg" tabindex="-98" name="expensecategory" id="">
                                     <option value="">- Please Select -</option>
								   @foreach ($expensecategorys as $category)
                                    <option value="{{$category->id}}">{{$category->expensecategory}}</option>
                                    @endforeach
                                 </select>
                                 <div class="alert-danger pt-1 pb-1 px-1 py-1" id="expensecategoryalert" style="display:none ;">Please select Expense Category </div>
                              </div>
                              <div class="col-sm-6">
                                 <label class="form-label">Title <span class="red">*</span></label>
                                 <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="title" id="" >
                                 <div class="alert-danger pt-1 pb-1 px-1 py-1" id="titlealert" style="display:none ;">Please enter Title </div>
                              </div>
                           </div>
                           <div class="row g-12">
                              <div class="col-sm-6">
                                 <label class="form-label">Amount <span class="red">*</span></label>
                                 <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="amount" id="" >
                                 <div class="alert-danger pt-1 pb-1 px-1 py-1" id="amountalert" style="display:none ;">Please enter Amount </div>
                              </div>
                              <div class="col-sm-6">
                                 <label class="form-label">Note </label>
                                 <textarea  class="form-control form-control-lg" placeholder="Enter here" name="note" id="" ></textarea>
                              </div>
                           </div>
                           <div class="row g-12">
                              <div class="col-sm-6">
                                 <label class="form-label">Date <span class="red">*</span></label>
                                 <input type="date" class="form-control form-control-lg" placeholder="Enter here" name="date" id="" >
                                 <div class="alert-danger pt-1 pb-1 px-1 py-1" id="datealert" style="display:none ;">Please enter Payment Date</div>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <a class="btn btn-primary" onclick="addexpenseValidation();">Save</a>
                           <button type="button" id="add-modal-close"class="btn btn-secondary">Cancel</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
            <!-- ADD MODAL ENDS HERE -->
            <!-- EDIT POPUP STARTS HERE -->
            <form class="row g-3" name="editpaymentmethod" method="post" action="{{ route('paymentmethod.edit') }}">
               @csrf
               <div class="modal fade" id="edit-sample-type" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-scrollable">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Expense Edit</h5>
                           <button type="button" id="edit-modal-close-x" class="btn-close"></button>
                        </div>
                         <div class="modal-body custom_scroll">
                           <div class="row g-12">
                              <div class="col-sm-6">
                                 <label class="form-label">Expense Category <span class="red">*</span></label>
                                 <select class="form-select form-select-lg" tabindex="-98" name="categoryeditid" id="categoryeditid">
                                    <option value="">- Please Select -</option>
                                    @foreach ($expensecategorys as $category)
                                    <option value="{{$category->id}}">{{$category->expensecategory}}</option>
                                    @endforeach
                                 </select>
                                 <div class="alert-danger pt-1 pb-1 px-1 py-1" id="expensecategoryalert" style="display:none ;">Please select Expense Category </div>
                              </div>
                              <div class="col-sm-6">
                                 <label class="form-label">Title <span id="title"></span> <span class="red">*</span></label>
                                 <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="title" id="title" >
                                 <div class="alert-danger pt-1 pb-1 px-1 py-1" id="titlealert" style="display:none ;">Please enter Title </div>
                              </div>
                           </div>
                       <div class="row g-12">
                        <div class="col-sm-6">
                        <label class="form-label">Amount <span class="red">*</span></label>
                        <input type="text" class="form-control form-control-lg" placeholder="Enter here" name="amount" id="" >
                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="amountalert" style="display:none ;">Please enter Amount</div>
                        </div>
                              <div class="col-sm-6">
                                 <label class="form-label">Note <span id="title"></span></label>
                                 <textarea  class="form-control form-control-lg" placeholder="Enter here" name="note"><span id="notes"></span></textarea>
                              </div>
                           </div>
                           <div class="row g-12">
                              <div class="col-sm-6">
                                 <label class="form-label">Date <span class="red">*</span></label>
                                 <input type="date" class="form-control form-control-lg" placeholder="Enter here" name="date" id="" >
                                 <div class="alert-danger pt-1 pb-1 px-1 py-1" id="datealert" style="display:none ;">Please enter Payment Date</div>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <a class="btn btn-primary" onclick="editpaymentmethodValidation();">Save</a>
                           <button type="button" id="edit-modal-close"class="btn btn-secondary">Cancel</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
            <!-- EDIT POPUP ENDS HERE -->
           <!---VIEW AND PRINT DATA--->
		     <div class="modal fade" id="viewexpense" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-scrollable expense_modal">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title">Expense Details<span id="invoice_number"></span></h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body custom_scroll" id="printable" style="padding: 1rem;">
                            <div class="col-md-12 date_section">
                                <div class="text-end" style="text-align: right !important;">
                                    <span class="text-success" style="color: rgb(25 135 84) !important;"> <strong>Date:</strong>  <span id="date"></span></span>
                                </div>
                            </div>
                            <table class="table table-borderless table-striped mb-0" style="border-color: #c1c1c1;margin-top: 20px !important;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:20%;text-transform: uppercase;font-size: 14px;color: #252525;padding: 0.5rem 0.5rem;font-weight: bolder;background: #eee !important;-webkit-print-color-adjust:exact !important;">Expense Category</th>
                                        <th class="text-center" style="width:15%;text-transform: uppercase;font-size: 14px;color: #252525;padding: 0.5rem 0.5rem;font-weight: bolder;background: #eee !important;-webkit-print-color-adjust:exact !important;">Title</th>
                                        <th class="text-center" style="width:15%;text-transform: uppercase;font-size: 14px;color: #252525;padding: 0.5rem 0.5rem;font-weight: bolder;background: #eee !important;-webkit-print-color-adjust:exact !important;">Amount</th>
                                        <th class="text-center" style="width:15%;text-transform: uppercase;font-size: 14px;color: #252525;padding: 0.5rem 0.5rem;font-weight: bolder;background: #eee !important;-webkit-print-color-adjust:exact !important;">Note</th>           
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
										<td class="text-center" id="expensecategory" style="color: #363535;padding: 0.5rem 0.5rem;text-align:center;border: 1px solid #eee !important;"></td>
										<td class="text-center" id="titles" style="color: #363535;padding: 0.5rem 0.5rem;border: 1px solid #eee !important;"></td>
                                        <td class="text-center" id="amounts" style="color: #363535;padding: 0.5rem 0.5rem;border: 1px solid #eee !important;"></td>
                                        <td class="text-center" id="note" style="color: #363535;padding: 0.5rem 0.5rem;border: 1px solid #eee !important;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                        <div class="modal-footer">
                            <a class="btn btn-sm bg-success text-white" onclick="printBarcode()"><i class="fa fa-print me-2"></i>Print</a> 
                        </div> 
                     </div>
                  </div>
               </div>
		   <!---VIEW AND PRINT DATA--->
		   
         </div>
      </div>
   </div>
</div>
<script src="{!! asset('assets/plugin/jquery/3.3.1/jquery.min.js') !!}"></script>
<script type="text/javascript">

 function printBarcode() {
     // printJS('printable', 'html')

     let printFrame = document.createElement("iframe")
     let printableElement = document.getElementById("printable")
     //
     // // printframe.setattribute("style", "visibility: hidden; height: 0; width: 0; position: absolute;")
     printFrame.setAttribute("id", "printjs")
     printFrame.srcdoc = "<html><head><title>document</title></head><body style='margin: 5px;'>" +
       printableElement.outerHTML + "<style>@page { size: A4; }"

     document.body.appendChild(printFrame)

     let iframeElement = document.getElementById("printjs")
     iframeElement.focus()
     iframeElement.contentWindow.print()
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
 function viewexpense(id){
                      var token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                        $.ajax(
					  {
                          url:"{{'view-expense'}}", 
                          type: 'POST',
                          data: {
                              id:id,
                              _token:token
                          },
                          success: function(response){
                              $('#viewexpense').modal('show');
                  			  var testlist = "";
                            var num = 0;  
                             
                              $.each(response.testlists, function(index, tests) {
                                   num = num+1;    
                            
                  			   testlist += '<tr><td class="text-center">'+tests.expensecategory+'</td><td class="text-center">'+tests.title+'</td><td class="text-end">'+tests.amount+'</td><td class="text-end">'+tests.note+'</td><td class="text-end">'+tests.date+'</td></tr>';     
                              });
							   
							  $('#date').html(response.date);
							    $('#expensecategory').html(response.expensecategory);
							  $('#note').html(response.note);
							 $('#amounts').html(response.amount);
							 $('#titles').html(response.title);
							  
							 //  $('#paymentstatus').html(response.paymentstatus);
                              $('#samplealert').html('');
                              $('#tblexpensedetails').html(testlist);
                               
                          }
                      });   
                       }
					   
					   
					   
		/*#-==============='================'================'================='=============='==============-#*/		   
               
	
   $(document).ready(function () {
       $('#edit-sample-type,#add-sample-type').modal({
           backdrop: 'static',
           keyboard: false
       })
   });
   
   $('#add-modal-close-x, #add-modal-close').click(function() {
       $('#expensecategory').val('');
       $('#expensecategoryalert').hide();
	   $('#title').val('');
       $('#titlealert').hide();  
	   $('#amount').val('');
       $('#amountalert').hide(); 
	   
	   
       $('#add-sample-type').modal('hide');
   });
   
   $('#edit-modal-close-x, #edit-modal-close').click(function() {
       $('#paymentmethodnamealertedit').hide();
       $('#edit-sample-type').modal('hide');
   });
   
   
   function addexpenseValidation() {
       document.getElementById('expensecategoryalert').style.display = 'none';
       document.getElementById('titlealert').style.display = 'none';
      document.getElementById('amountalert').style.display = 'none';
       document.getElementById('datealert').style.display = 'none';
      

	  if(document.addexpense.expensecategory.value == ''){
           document.getElementById('expensecategoryalert').style.display = 'block';  
           document.addexpense.expensecategory.focus(); 
           return false;     
       }
	   if(document.addexpense.title.value == ''){
           document.getElementById('titlealert').style.display = 'block';  
           document.addexpense.title.focus(); 
           return false;     
       }
	   if(document.addexpense.amount.value == ''){
           document.getElementById('amountalert').style.display = 'block';  
           document.addexpense.amount.focus(); 
           return false;     
       }
	     if(document.addexpense.date.value == ''){
           document.getElementById('datealert').style.display = 'block';  
           document.addexpense.date.focus(); 
           return false;     
       }
   document.addexpense.submit();
   return true;
   }
   
    
   function editview(id){
       var token = $('input[name="_token"]').val();
       $.ajax({
           url:"{{'view-edit-expense'}}",
           type: 'POST',
           data: {
               id:id,
               _token:token
			   
           },
           success: function(response){
              /* $('#expensecategory').val(response.expensecategory);
			     $('#title').val(response.title);
				    $('#date').val(response.date);
					   $('#note').val(response.note);
					      $('#amount').val(response.amount);
						      
               $('#hiddenid').val(response.id);
               $('#edit-sample-type').modal('show');
			   */

   // $('#title').val(response.title);
    //$('#arabicsubcategorynameedit').val(response.subcat_name_arabic);
   // $('#subhiddenid').val(response.id);
    //$('#categoryeditid').val(response.cat_id);
     $('#hiddenid').val(response.id);
	   $('#categoryeditid').val(response.id);
               $('#edit-sample-type').modal('show');


    var subhidden;
    var categoryhtml ="";
    var title;
    
    $('#edit-subsample-type').modal('show');
    categoryhtml = '<option value="">-Please Select -</option>';
    $.each(response.expensecategories,function(index,expensecate){

        categoryhtml += '<option value="'+expensecate.id+'">'+expensecate.expensecategory+'</option>';
    });

    $('#categoryeditid').html(categoryhtml);
    $.each(response.expenses,function(index,expense) {
       
       subhidden = expense.id;
            title = expense.title;
		      date = expense.date;
		       note = expense.note;
		      amount = expense.amount;
  expense_category_id = expense.expense_category_id;
    });

    $('#titles').val(title); 
     $('#date').val(date);
      $('#note').val(note); 
       $('#amount').val(amount);
 	
    $('#exhiddenid').val(subhidden);
    $('#categoryeditid option[value="'+expense_category_id+'"]').attr("selected", "selected");
 			 
           }
       });
      }
   function editpaymentmethodValidation() {
       if(document.editpaymentmethod.paymentmethodnameedit.value == ''){
           document.getElementById('paymentmethodnamealertedit').style.display = 'block';  
           document.editpaymentmethod.paymentmethodnameedit.focus(); 
           return false;     
       }
   document.editpaymentmethod.submit();
   return true;
   }
</script>
<script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>

@endsection