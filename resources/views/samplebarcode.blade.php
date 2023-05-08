



 <div class="modal fade" id="barcodemodel" tabindex="-1">
                     <div class="modal-dialog">
                        <div class="modal-content">
                           <div class="modal-header">
						    
                              <h5 class="modal-title">Barcode </h5>
							   
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closesinglenormalrange"></button>
                           </div>
                           <div class="modal-body">
                              <div class="row g-4">
                                 
                                 <div class="col-sm-8">
                                    
                                    <div class="pt-1 pb-1 px-1 py-1" id="paymentmethodalert">
									 <svg id="code39"></svg></div>
									 
                                 </div>
                                 
                                 
                                 <div class="col-sm-12"> 
                                    <a style="cursor:pointer;" id="printButton" class="btn btn-primary" onclick="myFunction()">Print</a>
                                       </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
				  
				  

 
 <script src="{!! asset('assets/js/JsBarcode.all.js') !!}"></script>
 <script>
 
 function barcodedetails(id){
    
    var ids = id;
    
   // document.getElementsByName("total").value =  ids;  
    //  alert(ss);  
   $('#hiddenid').val(ids);
   /*JsBarcode("#code39", "1234", {
  format: "pharmacode",
  lineColor: "#0aa",
  width: 4,
  height: 40,
  displayValue: false
});*/
    JsBarcode("#code39", ids, {format: "code39", width: 1.2, height:40 });
   $('#barcodemodel').modal('show');
}

function myFunction() {
      document.getElementById("printButton").hidden = true;
      window.print();
      document.getElementById("printButton").hidden = false;
    }
  
    
</script>				  