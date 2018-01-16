<?php 
	if(isset($_REQUEST['id'])){
	$sn=base64_decode($_REQUEST['id']);
	$decodeString = convert_uudecode($sn);
	global $wpdb;
	$table_name = $wpdb->prefix."Applicator";
	$wpdb->update( 
						$table_name, 
						array( 
							'ActivatedSatus' =>  'true' 
							), 
						array( 'serialNumber' => $decodeString )			 
	);
	}else{
		$decodeString = '';
	}

//echo $decodeString;
?>
<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>
<style>
h2.post-title {
display:none;
}
h2.reg-title {
  background-image: url("http://test.enerjet-med.com/wp-content/uploads/2016/09/sliders_website2_banners4.jpg");
  background-repeat: no-repeat;
  background-size: 100% 90%;
  color: #fff;
  font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
  font-size: 30px;
  height: 181px;
  letter-spacing: 2px;
  padding: 35px 50px 0;
}
.registratorformm label {
  font-weight: 500 !important;
}
.registratorformm input {
  font-size: 15px !important;
}

button#acfrmSubmit {
  background-color: #cf9b29;
  border:0px solid #000 !important;
  box-shadow: 0 0 0 !important;
  min-height: 40px;
  padding: 0;
  width: 100px;
  border-radius:0px;
}
</style>
<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<h2 class="reg-title">Activate Your System</h2>
<div class="bootstrap-iso">
 <div class="container">
  <div class="row">
	 <!-- <h2>Applicator Registration Form</h2>-->
   <div class="col-md-12 col-sm-6 col-xs-12">
    <form method="post" action="" class="registratorformm"> 
		<div class="form-group form-group-lg col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <label class="control-label " for="name">
        Please insert your Console S/N (without letters AP)
        </label>
        <input class="form-control" id="sn" name="ac-sno" maxlength="7" placeholder="Console Serial Number (e.g. APxxxxx)" type="text" value="<?php echo $decodeString; ?>" <?php if($decodeString != ''){ ?> readonly <?php }?> required />
       </div>
     <div class="form-group form-group-lg col-lg-6 col-md-6 col-sm-12 col-xs-12" >
      <label class="control-label " for="name">
       Please insert your Kit Box Serial Number
      </label>
      <input class="form-control" id="name" name="KitBox" placeholder="Kit Box Serial Number" type="text" required />
     </div>
     
     <div class="form-group form-group-lg col-lg-6 col-md-6 col-sm-12 col-xs-12" id="codebox" style="display:none">
      <label class="control-label " for="name">
      Code: 
      </label>
      <input class="form-control" id="code" name="code" type="text" value="" readonly />
      <span> For more Information Check Email</span>
     </div>
     
     <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" >
      <div class="pull-right">
       <button id="acfrmSubmit" class="btn btn-primary btn-lg" name="submit" type="submit">
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
	
	jQuery('body').on('click','#acfrmSubmit', function(e){
	 e.preventDefault();

		jQuery.ajax({
                    
                    type: "post",
                    data:jQuery("form").serialize(),
                   // data:{form:form},
                    url: '',
                    success: function (response) {
					//alert(response);
					console.log(response);
					var res = response.split("$$");
					console.log("code and res -"+res);
					 if(res[0] == 'consumption_code'){
						 jQuery('#codebox').show();
						 var code = res[1].toUpperCase();
						 jQuery('#code').val(code);
						 setTimeout(function(){
							 window.location = window.location.protocol + "//" + window.location.host + "/"+"thank-you/"; 
							 
							  }, 5000);
						
						}else if(res[0] == "no_consumption"){
							
							alert('Minimum consumption was not met.');
							setTimeout(function(){
							 window.location = window.location.protocol + "//" + window.location.host + "/"+"thank-you/"; 
							 
							  }, 5000);
							}
					else if(response == 'KitBox'){
						 alert('KitBox already Activated');
						}
					 else{
						var nres = response.split("&&");
					 if(nres[0] == 'New aplicator'){
						 window.location = window.location.protocol + "//" + window.location.host + "/"+"applicator-registration-form/?id="+nres[1];
					  }
					}
					 //jQuery("form").trigger("reset");
					}
				});
	});
</script>
