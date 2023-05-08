@extends('layout.maintest_template')
@section('content')
<style>
.red {
    color: #FF0000;
} 
</style>
<div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-3">
            <div class="container-fluid">

                   
                <div class="row g-4">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Add Single Test</h6>   <h6 style="color: red;">* (Mandatory field)</h6>
                            </div>
<form class="row g-3" id="addsingletestform" name="addsingletestform" method="post" action="{{ route('singletest.add') }}">                            
@csrf
                            <div class="card-body">
                                <div class="row g-4">
                                     <div class="col-sm-3">
                                        <label class="form-label">Test Name<span class="red"> *</span></label>
                                        <input type="text" class="form-control form-control-lg" name="testname" >
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
                                    <label class="form-label">Category <span class="red"> *</span></label>
                                                <select class="form-select form-select-lg"   name="testcategory" id="testcategory" tabindex="-98">
                                            <option value="">- Please Select -</option>
                                        @foreach ($testcategory as $testcateg)
                                            <option value="{{$testcateg->id}}">{{$testcateg->testcategory}}</option>
                                        @endforeach                                          
                                                </select>
                                                <div class="alert-danger pt-1 pb-1 px-1 py-1" id="categoryalert" style="display:none ;">Please select category</div>
                                    </div>
                                 <!-- FORM STARTS HERE -->
  
                                    
                                                    
                                    <div class="col-sm-3">
                                        <label class="form-label">Price (Primary)<span class="red"> *</span></label>
                                        
                                        <input type="number" class="form-control form-control-lg" name="primaryprice" id="primaryprice" value="">
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="primarypricealert" style="display:none ;">Please enter primary price</div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="form-label">Price (Secondary) </label>
                                        <input type="number" class="form-control form-control-lg" name="secondaryprice" id="secondaryprice" value="" >
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="secondarypricealert" style="display:none ;"></div>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="form-label">Tax<span class="red"> *</span></label>
                                        <select id="taxname" class="form-select form-select-lg" tabindex="-98" name="taxname">
                                            <option value="">-- Please Select --</option>
                                            @foreach ($taxes as $tax)
                                            <option value="{{$tax->id}}">{{$tax->taxname}}</option>
                                            @endforeach
                                        </select>                                            
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="taxalert" style="display:none ;">Please select tax</div>
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="form-label">Tax Method<span class="red"> *</span></label>
                                        <select id="tax" class="form-select form-select-lg" name="taxmethod">
                                            <option value="">-- Please Select --</option>                                            
                                            <option value="exclusive">Exclusive</option>
                                            <option value="inclusive">Inclusive</option>
                                            
                                        </select>                                        
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="taxmethodalert" style="display:none ;">Please select tax method</div>
                                        
                                    </div>
                                    
                                     <div class="col-sm-3">
                                        <label class="form-label">Units<span class="red"> *</span></label>
                                        <select id="tax" class="form-select form-select-lg" name="units">
                                            <option value="">-- Please Select --</option>  
                                            @foreach($labunit as $lab)
                                            <option value="{{$lab->id}}">{{$lab->labunit_name}}</option>
                                              @endforeach
                                            
                                        </select>                                        
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="taxmethodalert" style="display:none ;">Please select Unit</div>
                                        
                                    </div>
                                    
                                     <div class="col-sm-3">
                                        <label class="form-label">Tubes<span class="red"> *</span></label>
                                        <select id="tax" class="form-select form-select-lg" name="tubes">
                                            <option value="">-- Please Select --</option>  
                                            @foreach($tube as $tubes)
                                            <option value="{{$tubes->id}}">{{$tubes->tube_name}}</option>
                                              @endforeach
                                            
                                        </select>                                        
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="taxmethodalert" style="display:none ;">Please select Tube</div>
                                        
                                    </div>
                                    
                                     <div class="col-sm-3">
                                        <label class="form-label">Parameter<span class="red"> *</span></label>
                                        <select id="tax" class="form-select form-select-lg" name="parameter">
                                            <option value="">-- Please Select --</option>  
                                            @foreach($parameter as $para_meter)
                                            <option value="{{$para_meter->parameter_name}}">{{$para_meter->parameter_name}}</option>
                                              @endforeach
                                            
                                        </select>                                        
                                        <div class="alert-danger pt-1 pb-1 px-1 py-1" id="taxmethodalert" style="display:none ;">Please select Parameter</div>
                                        
                                    </div>
                                    
                                
                                    
                                    <div class="col-lg-12">
                                        <label class="form-label">Normal Range</label>
                                    </div>
                                    


                                    <table id="normalrange" class="table card-table table-hover align-middle mb-1 mt-0" style="width: 100%; display:none" >
                                    <thead>
                                        <tr>
                                           <th style="width:270px;">#</th>
                                            <th style="width:270px;">Age</th>
                                            <th style="width:270px;">General</th>
                                            <th style="width:270px;">Male</th>
                                            <th style="width:270px;">Female</th>
                                            <!--<th>Actions</th>                                           
                                            -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                    </tbody>
                                    </table>


 
                                        <div class="card-body"> 
                                              <div class="col-sm-12">
                                              	<div class="row"> 
<table class="table table-bordered" style="margin-bottom:0px;">
  <thead>
  <tr>
  <th colspan="6" class="text-center">Age Limit</th>
  <th colspan="9" class="text-center">Normal Value</th>
  
  
  </tr>
    <tr>
       <th colspan="3" style="width:100px;" class="text-center">Lower </th>
       <th colspan="3" style="width:100px;" class="text-center">Upper</th>
       <th colspan="2" style="width:200px;" class="text-center">Male </th>
       <th style="width:50px;" class="text-center">Min</th>
       <th style="width:50px;" class="text-center">Max</th>
       <th colspan="2" style="width:200px;" class="text-center">Female</th>
       <th style="width:50px;" class="text-center">Min</th>
       <th style="width:50px;" class="text-center">Max</th>
       <th style="width:50px;" class="text-center">&nbsp;</th>
    </tr>
    <tr>    	
    	<th style="width:80px; background-color: #daeef3;color: black; text-align: center;">
        <select style="padding:5px 2px;" class="form-select form-select-lg" name="lowertype" id="lowertype">
            <option value=">="> >= </option>
        </select>
        </th>
		<th style="width: 70px; background-color: #daeef3;color: black; text-align: center;">
        	<input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="lowervalue" id="lowervalue">
        </th>
  		<th style="width: 90px; background-color: #daeef3;color: black; text-align: center;">
        <select style="padding:5px 2px;" class="form-select form-select-lg" name="lowerchronological" id="lowerchronological">
            <option value="Days"> Days </option>
            <option value="Months"> Months </option>
            <option value="Years"> Years </option>
        </select>
        </th>
        
  		<th style="width: 80px; background-color: #daeef3;color: black; text-align: center;">
        <select style="padding:5px 2px;" class="form-select form-select-lg" name="highertype" id="highertype">
        <option value="<"> < </option>
        </select>
        </th>
		<th style="width: 70px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="highervalue" id="highervalue">
        </th>
  		<th style="width: 90px; background-color: #daeef3;color: black; text-align: center;">
        <select style="padding:5px 2px;" class="form-select form-select-lg" name="higherchronological" id="higherchronological">
        <option value="Days"> Days </option>
        <option value="Months"> Months </option>
        <option value="Years"> Years </option>
        </select>
        </th>
        
        <th colspan="2" style="width:100px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="malevalue" id="malevalue"></th>
		<th style="width: 70px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="minmalevalue" id="minmalevalue"></th>
        <th style="width: 70px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="maxmalevalue" id="maxmalevalue">
        </th>
        
  		<th colspan="2" style="width: 100px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="femalevalue" id="femalevalue"></th>
        <th style="width: 70px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="minfemalevalue" id="minfemalevalue"></th>
        <th style="width: 70px; background-color: #daeef3;color: black; text-align: center;">
        <input type="text" class="form-control form-control-lg" style="padding:5px 7px;" name="maxfemalevalue" id="maxfemalevalue"></th>
        <th style="width:100px; background-color: #daeef3;color: black; text-align: center; padding-bottom:15px;"><a onclick="addreferencerange();" class="btn-sm btn-info" style="text-transform:capitalize; font-weight:600; cursor:pointer;">Add More</a></th>
  		
    </tr>
  </thead>
</table> 
<div class="alert-danger pt-1 pb-1 px-1 py-1" id="referencerangealert" style="display:none;" >Please add reference range</div>


<table class="table table-bordered mt-3" id="tblreferencelist" style="display:none;">
  <thead>
  <tr>
  <th colspan="6" class="text-center">Age Limit</th>
  <th colspan="9" class="text-center">Normal Value</th>
  </tr>
    <tr>
       <th colspan="3" style="width:200px;" class="text-center">Lower </th>
       <th colspan="3" style="width:200px;" class="text-center">Upper</th>
       <th colspan="2" style="width:200px;" class="text-center">Male </th>
       <th style="width:50px;" class="text-center">Min</th>
       <th style="width:50px;" class="text-center">Max</th>
       <th colspan="2" style="width:200px;" class="text-center">Female</th>
       <th style="width:50px;" class="text-center">Min</th>
       <th style="width:50px;" class="text-center">Max</th>
       <th style="width:100px;" class="text-center">Action</th>
    </tr>
  </thead>
  <tbody> </tbody>
</table>                                            
                                              	</div>
                                              </div>  
                                              

                                                                                     
                                        </div>
                                    
                                      <div class="row g-4">
                                   <!-- FORM STARTS HERE 
                                   <div class="col-sm-4">
                                        <label class="form-label">Parameter</label>
                                       <select class="form-select form-select-lg SlectBox" multiple="multiple" name="parameters[]" id="parameters">
                                        @foreach ($parameter as $params)
                                       <option value="{{$params->id}}">{{$params->parameter_name}}</option>
                                       @endforeach                                          
                                    </select>
                                        
                                    </div>----->
                                   
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
    }
    else if(document.addsingletestform.testcategory.value == ''){
        document.getElementById('categoryalert').style.display = 'block'; 
        document.addsingletestform.testcategory.focus();  
        return false;     
    }
    else if(document.addsingletestform.primaryprice.value == ''){
        document.getElementById('primarypricealert').style.display = 'block'; 
        document.addsingletestform.primaryprice.focus();  
        return false;     
    } else if(IsNumeric(document.addsingletestform.primaryprice.value)==false){
        document.getElementById('primarypricealert').style.display = 'block'; 
        document.getElementById("primarypricealert").innerHTML="Invalid primary price! Please re-enter";
        document.addsingletestform.primaryprice.select();
        document.addsingletestform.primaryprice.focus(); 
        return false;
    }

    else if(document.addsingletestform.secondaryprice.value !=''){
    
            if(IsNumeric(document.addsingletestform.secondaryprice.value)==false){
                document.getElementById('secondarypricealert').style.display = 'block'; 
                document.getElementById("secondarypricealert").innerHTML="Invalid secondary price! Please re-enter";
                document.addsingletestform.secondaryprice.select();
                document.addsingletestform.secondaryprice.focus(); 
                return false;
            }
    }else if(document.addsingletestform.taxname.value == ''){
        document.getElementById('taxalert').style.display = 'block'; 
        document.addsingletestform.taxname.focus();  
        return false;     
    }
    else if(document.addsingletestform.taxmethod.value == ''){
        document.getElementById('taxmethodalert').style.display = 'block'; 
        document.addsingletestform.taxmethod.focus();  
        return false;     
    }

    document.addsingletestform.submit();    
return true;
}

// ADD SINGLE TEST FORM VALIDATION ENDS HERE

// ADD SINGLE TEST NORMAL RANGE FORM VALIDATION STARTS HERE

function normalRangeValidation () 
{
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
    var sid = '0';
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

                var tableRef = document.getElementById('normalrange').getElementsByTagName('tbody')[0];
                var nums = tableRef.rows.length;
                var counts = nums+1;
              // alert(response.singletest_id+'->'+response.agefrom);
               //exit();
                //var nums = ((tableRef.rows.length)+1);


                var myHtmlContent='<tr><td>'+counts+'</td><td>'+response.agefrom+' - '+response.ageto+'</td><td>'+response.generalrange+'</td><td>'+response.malerange+'</td><td>'+response.femalerange+'</td></tr>';
                
                
                var newRow = tableRef.insertRow(tableRef.rows.length);


                if(document.getElementById('normalrange').style.display == 'none'){
                document.getElementById('normalrange').style.display = 'block';
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



function deletedoc(deleteid,trid){
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
       data: { id:deleteid },
       success: function(response){
       //alert(response.success); exit();    
        if(response.success == 1){      
            // HIDE TABLE IF NOT RECORDS FOUND STARTS HERE
            if(response.doccount == 0 ){
                document.getElementById('normalrange').style.display = 'none';
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











@endsection
