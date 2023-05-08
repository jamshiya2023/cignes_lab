@extends('layout.maintest_template')
@section('content')
<style>
.red {
    color: #FF0000;
} 

.new1{padding-top: 20px;}

.btn-secondary {
  color: #fff;
  background-color: var(--primary-color);
  border-color: var(--primary-color);
}

.btn-secondary3 {
  color: #fff;
  background-color: #aeaeae;
  border-color: #aeaeae;
}

</style>
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">

                   
                <div class="row g-4">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Edit Single Test</h6>  <h6 style="color: red;">* (Mandatory field)</h6>
                            </div>
<form class="row g-3" id="addsingletestform" name="addsingletestform" method="post" action="{{ url('edit-singletest/'.$singletestlist->id) }}">                            
@csrf
                            <div class="card-body">
                                <div class="row g-4">
                                  
                                 <!-- FORM STARTS HERE -->
  
                                    
                                    <div class="col-sm-3">
                                        <label class="form-label">Test Name<span class="red"> *</span></label>
                                        <input type="text" class="form-control form-control-lg" name="testname" value="{{$singletestlist->testname}}">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="testnamealert" style="display:none ;">Please enter test name</div>
                                    </div>
                                     <div class="col-sm-3">
                                    <label class="form-label">Container</label>
                                    <select class="form-select form-select-lg"   name="containers" id="containers">
                                <option value="0">- Please Select -</option>
                                    @foreach ($containers as $contain)
                                <option value="{{$contain->id}}">{{$contain->container_name}}</option>
                                    @endforeach                                          
                                    </select>
                                    </div>
							
                                    
                                    <div class="col-sm-3">
                                        <label class="form-label">Category<span class="red"> *</span></label>
                                        <select id="testcategory" class="form-select form-select-lg" tabindex="-98" name="testcategory">
                                            <option value="">- Please Select -</option>
                                            @foreach ($testcategory as $testcateg)
                                            <option value="{{$testcateg->id}}" {{ ( $testcateg->id == $singletestlist->testcategory) ? 'selected' : '' }}>{{$testcateg->testcategory}}</option>
                                            @endforeach
                                        </select>                                        
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="categoryalert" style="display:none ;">Please select category</div>
                                        
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <label class="form-label">Price (Primary)<span class="red"> *</span></label>
                                        
                                        <input type="number" class="form-control form-control-lg" name="primaryprice" id="primaryprice" value="{{$singletestlist->primaryprice}}">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="primarypricealert" style="display:none ;">Please enter primary price</div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="form-label">Price (Secondary) </label>
                                        <input type="number" class="form-control form-control-lg" name="secondaryprice" id="secondaryprice" value="{{$singletestlist->secondaryprice}}" >
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="secondarypricealert" style="display:none ;"></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="form-label">Tax<span class="red"> *</span></label>
                                        <select id="taxname" class="form-select form-select-lg" tabindex="-98" name="taxname">
                                           <option value="">-- Please Select --</option>   
                                            @foreach ($taxes as $tax)
                                            <option value="{{$tax->id}}" {{ ( $tax->id == $singletestlist->tax_id) ? 'selected' : '' }}>{{$tax->taxname}}</option>
                                            @endforeach
                                        </select>                                        
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="taxalert" style="display:none ;">Please select tax</div>
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="form-label">Tax Method<span class="red"> *</span></label>
                                        <select id="tax" class="form-select form-select-lg" name="taxmethod">
                                            <option value="">-- Please Select --</option>                                            
                                            <option value="exclusive" {{ ( $singletestlist->tax_method == 'exclusive') ? 'selected' : '' }}>Exclusive</option>
                                            <option value="inclusive" {{ ( $singletestlist->tax_method == 'inclusive') ? 'selected' : '' }}>Inclusive</option>
                                            
                                        </select>                                        
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="taxmethodalert" style="display:none ;">Please select tax method</div>
                                        
                                    </div>
                                    
                                    
                                    
                                    <div class="col-lg-12">
                                        <label class="form-label">Normal Range</label>
                                        
                                     
                                        
                                        
                                    </div>




                                    <table id="tablenormalrangelist" class="table card-table table-hover align-middle mb-1 mt-0" style="width: 100%; display:block" >
                                    <thead>
                                        <tr>
                                            <th style="width:220px;">#</th>
                                            <th style="width:220px;">Age</th>
                                            <th style="width:220px;">General</th>
                                            <th style="width:220px;">Male</th>
                                            <th style="width:220px;">Female</th>
                                            <th style="width:220px;">Actions</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
<!-- for loop starts here -->
                        @php
                        $i=1;
                        @endphp
                        @foreach ($normalrangelist as $normalrange)

                                    <tr>
                                        <td>{{$i}}</td><td>{{$normalrange->agefrom}} - {{$normalrange->ageto}}</td>
                                        <td>{{$normalrange->generalrange}}</td><td>{{$normalrange->malerange}}</td>
                                        <td>{{ !empty($normalrange->femalerange) ? $normalrange->femalerange : '-NA-' }}</td>
                                        <td>
                                           <a  onclick="editview('{{ $normalrange->id }}','{{$normalrange->singletest_id}}');"class="btn btn-link btn-sm text-secondry" data-bs-toggle="modal" data-bs-target="#edit-range-type{{ $normalrange->id }}">
                                                                <i class="fa fa-edit" style="color:#555CB8;"></i>
                                           </a>
                                        </td>
                                        <!--<td><a class="btn btn-primary badge" onclick="return deletedoc('{{$normalrange->id}}','{{$normalrange->singletest_id}}',this);">Remove</a></td>-->
                                    </tr>
                        @php
                        $i=$i+1;
                        @endphp                               
                        @endforeach
                                    <!-- for loop ends here -->                                        
                                    </tbody>
                                    </table>



                                    <div class="col-lg-2 mt-0">
                                        <label class="form-label">Age From</label>
                                        <input type="text" class="form-control form-control-lg" name="agefrom" id="agefrom">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="agefromalert" style="display:none ;">Please enter age from</div>
                                    </div>
                                    <div class="col-lg-2 mt-0">
                                        <label class="form-label">Age To</label>
                                        <input type="text" class="form-control form-control-lg" name="ageto" id="ageto">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="agetoalert" style="display:none ;">Please enter age to</div>
                                    </div>
                                    <div class="col-lg-2 mt-0">
                                        <label class="form-label">General</label>
                                        <input type="text" class="form-control form-control-lg"  name="generalrange" id="generalrange">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="generalrangealert" style="display:none ;">Please enter general range</div>

                                    </div>
                                    <div class="col-lg-2 mt-0">
                                        <label class="form-label">Male</label>
                                        <input type="text" class="form-control form-control-lg" name="malerange" id="malerange">
                                    </div>
                                    <div class="col-lg-2 mt-0">
                                        <label class="form-label">Female</label>
                                        <input type="text" class="form-control form-control-lg" name="femalerange" id="femalerange">
                                    </div>
                                    <div class="col-lg-2 mt-5">
                                        
                                        <a style="cursor:pointer;" class="btn btn-primary" onclick="normalRangeValidation('{{$singletestlist->id}}');">+ Add More</a>
                                    </div>
                                    
                                    
                                </div>




                                
                            </div>


                            <div class="card-footer">
                               
                                <a style="cursor:pointer;" class="btn btn-primary" onclick="formValidation();">Save</a>
                                <button type="submit" class="btn btn-default">Cancel</button>
                            </div>
</form>
                        </div>
                    </div>
                    
                </div> <!-- .row end -->

            </div>
        </div>


         <!-- EDIT tube POPUP STARTS HERE -->
        <form class="row g-3" id="editrange" name="editrange"  method="post" action="{{ route('range.edit') }}" >                             
                @csrf 
               
   
                    <div class="modal fade" id="edit-range-type" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Normal Range</h5>
                                    <button type="button" id="edit-modal-close-x" class="btn-close"></button>
                                </div>
                                <br><br>
                                <div class="modal-body custom_scroll">
                                    <div class="row g-4 new1">
                                      <div class="col-lg-2 mt-0">
                                        <label class="form-label">Age From</label>
                                        <input type="number" class="form-control form-control-lg" name="agefrom" id="agefrom1">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="agefromalert" style="display:none ;">Please enter age from</div>
                                    </div>
                                    <div class="col-lg-2 mt-0">
                                        <label class="form-label">Age To</label>
                                        <input type="number" class="form-control form-control-lg" name="ageto" id="ageto1">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="agetoalert" style="display:none ;">Please enter age to</div>
                                    </div>
                                    <div class="col-lg-2 mt-0">
                                        <label class="form-label">General</label>
                                        <input type="number" class="form-control form-control-lg"  name="generalrange" id="generalrange1">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="generalrangealert" style="display:none ;">Please enter general range</div>

                                    </div>
                                    <div class="col-lg-2 mt-0">
                                        <label class="form-label">Male</label>
                                        <input type="number" class="form-control form-control-lg" name="malerange" id="malerange1">
                                    </div>
                                    <div class="col-lg-2 mt-0">
                                        <label class="form-label">Female</label>
                                        <input type="number" class="form-control form-control-lg" name="femalerange" id="femalerange1">
                                    </div>
                                    </div>
                                </div>
                            <div class="modal-footer">
                            <input type="hidden" class="form-control form-control-lg" id="hiddenid" name="hiddenid" >
                            <input type="hidden" class="form-control form-control-lg" id="testid" name="testid" >
                                        <button type="submit" id="edit-modal-close" class="btn btn-secondary" >save</button>
                                        <button type="button" id="edit-modal-close" class="btn btn-secondary3">Cancel</button>
                                        
                                        
                            </div>
                        </div>
                    </div>
                </div>


            </form> 

            <!--  EDIT CATEGORY ENDS HERE-->
    <script src="{!! asset('assets/plugin/jquery/3.3.1/jquery.min.js') !!}"></script>
<script>
    // ADD SINGLE TEST FORM VALIDATION STARTS HERE
function formValidation() 
{

    //alert('working'); exit();
    document.getElementById('testnamealert').style.display = 'none';
    document.getElementById('categoryalert').style.display = 'none'; 
    document.getElementById('primarypricealert').style.display = 'none'; 
    document.getElementById('secondarypricealert').style.display = 'none'; 
    document.getElementById('taxalert').style.display = 'none'; 
    document.getElementById('taxmethodalert').style.display = 'none'; 

    if(document.addsingletestform.testname.value == ''){
        document.getElementById('testnamealert').style.display = 'block'; 
        document.addsingletestform.testname.focus();  
        return false;     
    }else if(document.addsingletestform.testcategory.value == ''){
        document.getElementById('categoryalert').style.display = 'block'; 
        document.addsingletestform.testcategory.focus();  
        return false;     
    }
    else if(document.addsingletestform.primaryprice.value == ''){
        document.getElementById('primarypricealert').style.display = 'block'; 
        document.addsingletestform.primaryprice.focus();  
        return false;     
    }else if(IsNumeric(document.addsingletestform.primaryprice.value)==false){
        document.getElementById('primarypricealert').style.display = 'block'; 
        document.getElementById("primarypricealert").innerHTML="Invalid primary price! Please re-enter";
        document.addsingletestform.primaryprice.select();
        document.addsingletestform.primaryprice.focus(); 
        return false;
    }else if(document.addsingletestform.secondaryprice.value !=''){
    
            if(IsNumeric(document.addsingletestform.secondaryprice.value)==false){
                document.getElementById('secondarypricealert').style.display = 'block'; 
                document.getElementById("secondarypricealert").innerHTML="Invalid secondary price! Please re-enter";
                document.addsingletestform.secondaryprice.select();
                document.addsingletestform.secondaryprice.focus(); 
                return false;
            }
    }else if(document.addsingletestform.taxname.value == ''){
        alert('tax value'+document.addsingletestform.taxname.value);
        document.getElementById('taxalert').style.display = 'block';         
        return false;     
    }else if(document.addsingletestform.taxmethod.value == ''){
        document.getElementById('taxmethodalert').style.display = 'block'; 
        document.addsingletestform.taxmethod.focus();  
        return false;     
    }

    document.addsingletestform.submit();    
return true;
}

// ADD SINGLE TEST FORM VALIDATION ENDS HERE

// ADD SINGLE TEST NORMAL RANGE FORM VALIDATION STARTS HERE

function normalRangeValidation (sid) 
{
    //alert(sid); exit();
    document.getElementById('agefromalert').style.display = 'none'; 
    document.getElementById('agetoalert').style.display = 'none';
    document.getElementById('generalrangealert').style.display = 'none';

    if(document.addsingletestform.agefrom.value == ''){
        document.getElementById('agefromalert').style.display = 'block'; 
        document.addsingletestform.agefrom.focus();  
        return false;     
    } else if(document.addsingletestform.ageto.value == ''){
        document.getElementById('agetoalert').style.display = 'block'; 
        document.addsingletestform.ageto.focus();  
        return false;     
    } else if(document.addsingletestform.generalrange.value == ''){
        document.getElementById('generalrangealert').style.display = 'block'; 
        document.addsingletestform.generalrange.focus();  
        return false;     
    }

    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    var agefrom = $('#agefrom').val();
    var ageto = $('#ageto').val();
    var generalrange = $('#generalrange').val();
    var malerange = $('#malerange').val();
    var femalerange = $('#femalerange').val();

//alert(CSRF_TOKEN);
    var normalrange = new FormData();
    
    // Append data 
    
    normalrange.append('_token',CSRF_TOKEN);
    normalrange.append('agefrom',agefrom);
    normalrange.append('ageto',ageto);
    normalrange.append('generalrange',generalrange);
    normalrange.append('malerange',malerange);
    normalrange.append('femalerange',femalerange);
    normalrange.append('sid',sid);

// var filename  = files[0];
// var filename  = files[0];
    $.ajax({
           url:"{{ 'rangesadd' }}", 
           method: 'POST',
           data: normalrange,
           contentType: false,
           processData: false,
           dataType: 'json',
           success: function(response){
               //alert(response.success);
                if(response.success == 1){ // Uploaded successfully
                   // alert(response.success);

                $("#agefrom").val('');
                $("#ageto").val('');
                $("#generalrange").val('');
                $("#malerange").val('');                
                $("#femalerange").val('');

                var tableRef = document.getElementById('tablenormalrangelist').getElementsByTagName('tbody')[0];
                var nums = tableRef.rows.length;
                var counts = nums+1;
              // alert(response.singletest_id+'->'+response.agefrom);
               //exit();
                //var nums = ((tableRef.rows.length)+1);


                var myHtmlContent='<tr><td>'+counts+'</td><td>'+response.agefrom+' - '+response.ageto+'</td><td>'+response.generalrange+'</td><td>'+response.malerange+'</td><td>'+response.femalerange+'</td><td><a class="btn btn-link btn-sm text-secondry" onclick="editview('+response.id+','+sid+',this);"><i class="fa fa-edit" style="color:#555CB8;"></i></a></td></tr>';
                
                
                var newRow = tableRef.insertRow(tableRef.rows.length);


                if(document.getElementById('tablenormalrangelist').style.display == 'none'){
                document.getElementById('tablenormalrangelist').style.display = 'block';
                    newRow.innerHTML = myHtmlContent;
                } else {
                    newRow.innerHTML = myHtmlContent;
                }


        
                }
           }

           });

        }
// DOCUMENTS ADDING ENDS HERE

// ADD SINGLE TEST NORMAL RANGE FORM VALIDATION ENDS HERE



function deletedoc(deleteid,sid,trid){
  //var el = this;
 
  // Delete id
 // var deleteid = $(this).data('id');
 
//alert(deleteid); exit();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  var confirmalert = confirm("Are you sure to delete?");
  if (confirmalert == true) {
     // AJAX Request
     $.ajax({
        url:"{{ 'normalrangedelete' }}",
       type: 'POST',
       data: { id:deleteid, sid:sid },
       success: function(response){
           
       //alert(response.success); exit();    
        if(response.success == 1){      
            // HIDE TABLE IF NOT RECORDS FOUND STARTS HERE
            if(response.doccount == '0' ){
                //alert(response.doccount); exit();
                document.getElementById('tablenormalrangelist').style.display = 'none';
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
        function editview(id,sid){
            
        var token = $('input[name="_token"]').val();
        $.ajax({
        url:"{{ route('test.view')}}",
        type : 'POST',
        data:{
            id:id,
            sid:sid,
            _token:token
        },
        success:function(response){
           
            $('#agefrom1').val(response.agefrom);
            $('#ageto1').val(response.ageto);
            $('#generalrange1').val(response.generalrange);
            $('#malerange1').val(response.malerange);
            $('#femalerange1').val(response.femalerange);
            $('#hiddenid').val(response.id);
            $('#testid').val(response.singletest_id);
            $('#edit-range-type').modal('show');
            }
        });
            
        }
        $('#edit-modal-close-x, #edit-modal-close').click(function() {
                $('#edit-range-type').modal('hide');
            });
        </script>





<script src="{!! asset('assets/bundles/libscripts.bundle.js') !!}"></script>

@endsection
