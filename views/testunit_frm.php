<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		
	</head>
	<body>
		<div class="error_log">
			<div class="Form_title"><h2><?php echo __("Test_Unit", 'priority-api'); ?><?php _e("Test_Unit", 'priority-api'); ?></h2></div>				
				<table class="form-table" style="background:#ccc;margin-top:20px;">	
					<form action="" method="post" id="send_dt">
					<input type="hidden">
						<tr>
							<td>XML</td>
							<td><textarea name="xmldata" placeholder="Enter your xml.." style="height:180px;width:500px;"></textarea></td>
						</tr>
						<tr>
							<td>InterfaceName</td>
							<td><input type="text" name="interface" placeholder=""></td>
						</tr>
						<tr>
							<td><input type="submit" name="post_data" value="InterfaceIn" class="btn"></td>
							<td><input type="submit" name="post_data2" value="InterfaceOut" class="btn"></td>
						</tr>
					</form>	
					<tr class="api_response" style="display:none;">
						<td>API Response</td>
						<td>
							<div><textarea style="height:180px;width:500px;"></textarea></div>
						</td>
					</tr>										
				</table> 			
		</div>
		<script>		
		jQuery('#send_dt').on('submit', function (e) {
             jQuery(".btn").removeClass('active-btn');
			var submit = jQuery(this.id).context.activeElement;
			var check_btn = submit.name;   
			if(check_btn == 'post_data'){
				var interface_tp = 'InterfaceIn';
			} else {
				var interface_tp = 'InterfaceOut';
			}
			//alert(interface_tp);
			 e.preventDefault();
			//return false;
			jQuery("#loader_img").show();
			jQuery.ajax({ 
				 data: jQuery('#send_dt').serialize()+ '&interface_type='+interface_tp, 
				 type: 'post',
				 url: '',
				 success: function(data) {
					  
					 // alert(data);
					  console.log(data);
					  // location.reload();
					  jQuery(".api_response").show();
					  jQuery(".api_response textarea").val(data);
					  //jQuery(submit).attr('class','active-btn');
					  jQuery(submit).addClass('active-btn');
					}
			});
		});
</script>
	</body>
</html>
<?php

?>


	
	