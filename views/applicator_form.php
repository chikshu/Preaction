<?php
if(isset($_REQUEST['id'])){
 $id = base64_decode($_REQUEST['id']);
 $decodeString = convert_uudecode($id);
 }else{
		$decodeString = '';
 }
 ?>
<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>

<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso">
 <div class="container-fluid">
  <div class="row">
	 <!-- <h2>Applicator Registration Form</h2>-->
   <div class="col-md-6 col-sm-6 col-xs-12">
    <form method="post" action="">
		<div class="form-group form-group-lg">
        <label class="control-label " for="name">
         Applicator Serial number
        </label>
        <input class="form-control" id="sno" name="a-sno" type="text" maxlength="7" value="<?php echo $decodeString;?>"   <?php if($decodeString != ''){ ?> readonly <?php }?>/>
       </div>
     <div class="form-group form-group-lg">
      <label class="control-label " for="name">
       Full Name
      </label>
      <input class="form-control" id="name" name="name" type="text" required />
     </div>
     <div class="form-group form-group-lg">
      <label class="control-label " for="email">
       Email
      </label>
      <input class="form-control" id="email" name="uemail" type="text"/>
     </div>
     <div class="form-group form-group-lg">
      <label class="control-label " for="clinic-name">
       Clinic Name
      </label>
      <input class="form-control" id="clinic-name" name="clinic-name" type="text"required />
     </div>
     <div class="form-group form-group-lg">
      <label class="control-label " for="distributor-name">
       Distributor Name
      </label>
      <input class="form-control" id="distributor-name" name="distributor-name" type="text" required />
     </div>
     <div class="form-group form-group-lg">
      <label class="control-label " for="other-detail">
       Other Deatils
      </label>
      <textarea class="form-control" cols="40" id="other-detail" name="other-detail" rows="10"></textarea>
     </div>
     <!--div class="form-group form-group-lg">
      <label class="control-label " for="act-date">
       Activation Date
      </label>
      <input class="form-control" id="act-date" name="act-date" placeholder="MM/DD/YYYY" type="text" required />
     </div>
     <div class="form-group form-group-lg">
      <label class="control-label " for="act-time">
       Activation Time
      </label>
      <input class="form-control" id="act-time" name="act-time" type="text" required />
     </div-->
     <!--div class="form-group form-group-lg">
      <label class="control-label " for="act-ip">
       Activation IP
      </label>
      <input class="form-control" id="act-ip" name="act-ip" type="text" required />
     </div>
     <div class="form-group" id="div_radio">
      <label class="control-label " for="radio">
       Activated ?
      </label>
      <div class="">
       <label class="radio-inline">
        <input name="active" type="radio" value="Yes"/>
        Yes
       </label>
       <label class="radio-inline">
        <input name="active" type="radio" value="No"/>
        No
       </label>
      </div>
     </div-->
     <div class="form-group form-group-lg">
      <label class="control-label " for="min-con-no">
       Minimum consumption
      </label>
      <input class="form-control" id="min-consumption-no" name="min-con-no" type="number" required />
     </div>
     <div class="form-group">
      <div>
       <button id="frmSubmit" class="btn btn-primary btn-lg" name="submit" type="submit">
        Submit
       </button>
      </div>
     </div>
    </form>
   </div>
  </div>
 </div>
</div>

<script type="text/javascript">
   jQuery('body').on('change','#sno', function(e){
	e.preventDefault();
	var sno_prefix = jQuery('#sno').val().substr(0,2);
	if(sno_prefix.match(/^(AD|ad|Ad|aD)/)){
		
	}else{
		
		alert('Value should be Start with AD and of 7 characters');
		jQuery('#sno').val('');
		jQuery('#sno').focus();
	}
	});
	jQuery('body').on('click','#frmSubmit', function(e){
		e.preventDefault();
	 var sno = jQuery('#sno').val();
	 var email = jQuery('#email').val();
	// var form = jQuery("form").serialize();
	 //alert(form);
		jQuery.ajax({
                    
                    type: "post",
                    data:jQuery("form").serialize(),
                    url: '',
                    success: function (response) {
					 alert(response);
					 jQuery("form").trigger("reset");
					}
				});
	});
</script>
