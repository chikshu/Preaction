<?php
/*
Plugin Name: Preaction Applicants
Plugin URI: http://web1.kindlebit.com/DEVELOPMENT/Preaction/
Description: This plugin allows you to register Applicants and view their information
Author: Shikha
Text Domain: preaction
Version: 1.0
Author URI: 
*/


//////////////////////// Define Constants ////////////////////////
if (!defined("WP_Preaction_DIR")) define("WP_Preaction_DIR", plugin_dir_path(__FILE__));


////////////////////// Functions for Returning Table Names ////////////////
function Applicator_tbl()
{
	global $wpdb;
	return $wpdb->prefix."Applicator";
}
function KitBox_tbl()
{
	global $wpdb;
	return $wpdb->prefix."KitBox";
}

//add custum user field
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
add_action( 'user_new_form', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields( $user ) { ?>


	<table class="form-table">

		<tr>
			<th><label for="pcno">Priority Customer Number</label></th>

			<td>
				<input type="text" name="pcno" id="pcno" value="<?php echo esc_attr( get_the_author_meta( 'pcno', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Priority Customer Number.</span>
			</td>
		</tr>

	</table>
<?php }

//save custum user field
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
add_action( 'user_register', 'my_save_extra_profile_fields' );
function my_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_usermeta( $user_id, 'pcno', $_POST['pcno'] );
	
}

/////////////////////// Function for add the install script //////////////
if(!function_exists("plugin_install_script_for_preaction")) {
	function plugin_install_script_for_preaction() {
			if(file_exists(WP_Preaction_DIR . "/lib/install_script.php"))
				{
					include WP_Preaction_DIR . "/lib/install_script.php";
					 
				}
								global $wpdb;
							 /*----- Applicator form --------------------------*/
								$the_page_title = 'Applicator registration form';
								$the_page_name = ' Applicator registration form';

								// the menu entry...
								delete_option("Applicator_from_plugin_page_title");
								add_option("Applicator_from_plugin_page_title", $the_page_title, '', 'yes');
								// the slug...
								delete_option("Applicator_from_plugin_page_name");
								add_option("Applicator_from_plugin_page_name", $the_page_name, '', 'yes');
								// the id...
								delete_option("Applicator_from_plugin_page_id");
								add_option("Applicator_from_plugin_page_id", '0', '', 'yes');

								$the_page = get_page_by_title( $the_page_title );

								if ( ! $the_page ) {

									// Create post object
									$_page = array();
									$_page['post_title'] = $the_page_title;
									$_page['post_content'] = "[applicator-form]";
									$_page['post_status'] = 'publish';
									$_page['post_type'] = 'page';
									$_page['comment_status'] = 'closed';
									$_page['ping_status'] = 'closed';
									$_page['post_name'] = $the_page_title;
									$_page['post_category'] = array(1); // the default 'Uncatrgorised'

									// Insert the post into the database
									$the_page_id = wp_insert_post( $_page );

								}
								else {
									// the plugin may have been previously active and the page may just be trashed...

									$the_page_id = $the_page->ID;

									//make sure the page is not trashed...
									$the_page->post_status = 'publish';
									$the_page_id = wp_update_post( $the_page );

								}

								delete_option( 'Applicator_form_plugin_page_id' );
								add_option( 'Applicator_form_plugin_page_id', $the_page_id );
					
						/*----- Activation form --------------------------*/
						
								$the_page_title1 = 'Applicator activation form';
								$the_page_name1 = ' Applicator activation form';

								// the menu entry...
								delete_option("Applicator_from_plugin_page_title");
								add_option("Applicator_from_plugin_page_title", $the_page_title1, '', 'yes');
								// the slug...
								delete_option("Applicator_from_plugin_page_name");
								add_option("Applicator_from_plugin_page_name", $the_page_name1, '', 'yes');
								// the id...
								delete_option("Applicator_from_plugin_page_id");
								add_option("Applicator_from_plugin_page_id", '0', '', 'yes');

								$the_page1 = get_page_by_title( $the_page_title1 );

								if ( ! $the_page1 ) {

									// Create post object
									$_page1 = array();
									$_page1['post_title'] = $the_page_title1;
									$_page1['post_content'] = "[activation-form]";
									$_page1['post_status'] = 'publish';
									$_page1['post_type'] = 'page';
									$_page1['comment_status'] = 'closed';
									$_page1['ping_status'] = 'closed';
									$_page1['post_name'] = $the_page_title1;
									$_page1['post_category'] = array(1); // the default 'Uncatrgorised'

									// Insert the post into the database
									$the_page_id1 = wp_insert_post( $_page1 );

								}
								else {
									// the plugin may have been previously active and the page may just be trashed...

									$the_page_id1 = $the_page1->ID;

									//make sure the page is not trashed...
									$the_page1->post_status = 'publish';
									$the_page_id1 = wp_update_post( $the_page1 );

								}

								delete_option( 'Applicator_form_plugin_page_id' );
								add_option( 'Applicator_form_plugin_page_id', $the_page_id1 );
					
			}
			
}
 function applicator_registration_form()
 {
	include(WP_Preaction_DIR. "/views/applicator_form.php");
	
 }
	
add_shortcode('applicator-form','applicator_registration_form');

 function applicator_activation_form()
 {
	include(WP_Preaction_DIR. "/views/activation_form.php");
	
 }
	
add_shortcode('activation-form','applicator_activation_form');

if(isset($_POST['uemail']))
{
	global $wpdb;
		$table_name = $wpdb->prefix."Applicator";
			
		 $sno= $_POST['a-sno'];
		 $name= $_POST['name'];
		 $email= $_POST['uemail'];
		 $clinic=$_POST['clinic-name'];
		 $distributor = $_POST['distributor-name'];
		 $other = $_POST['other-detail'];
		 $activation_date= date("m/d/Y");
		 $act_time= date("h:i:sa");
		 $ip = $_SERVER['REMOTE_ADDR'];
		 $activated = 'false';
		 $min_con   = '20';
		
			$myrows = $wpdb->get_results( "SELECT * FROM ".$table_name. " where `Email`='".$email."' or `serialNumber`='".$sno."'");
			
			if(!empty($myrows)){
				//print_r($myrows);
				echo "Applicator already exist!";
			 }else{
				
			 $data=array(
			'serialNumber' => $sno,
			'FulleName' => $name,
			'Email' => $email, 
			'ClinicName'=>  $clinic,
			'DistributorName'=> $distributor,
			'OtherDetail' => $other,
			'ActivationDate' =>$activation_date,
			'ActivationTime' => $act_time,
			'ActivationIP' =>  $ip,
			'ActivatedSatus'=> $activated,
			'MinimumConsumption'=>$min_con
		   );
		
		$insert_query=$wpdb->insert($table_name,$data);
		if($insert_query){
			$encodeString =convert_uuencode($sno);
			$encodeString =base64_encode($encodeString);
			echo "Applicator added! Confirmation mail has been sent to your Email";
			$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."applicator-activation-form?id=" . $encodeString;
			
			$msg = "Click the link:";
			$msg .=$actual_link;
			
			// Always set content-type when sending HTML email
		//$headers = "MIME-Version: 1.0" . "\r\n";
		//$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers = "From: myplace@example.com\r\n";
		$headers .= "Reply-To: myplace2@example.com\r\n";
		$headers .= "Return-Path: myplace@example.com\r\n";
		$headers .= "CC: sombodyelse@example.com\r\n";
		$headers .= "BCC: hidden@example.com\r\n";
		
		  $sub = "Confirmation Mail";
			// More headers
		
			
			mail($email,$sub,$msg,$headers);
			}else{
			echo "Applicator not added!";
			}
 }

exit;
}

						////////////activation page//////////////
if(isset($_POST['ac-sno'])){

$ac_sn = $_POST['ac-sno'];
$kitBox = $_POST['KitBox'];
$activation_date= date("m/d/Y");
$act_time= date("h:i:sa");
$ip = $_SERVER['REMOTE_ADDR'];

		global $wpdb;
		$table_name = $wpdb->prefix."KitBox";
		$table_name1 = $wpdb->prefix."Applicator";
		//$myrows = $wpdb->get_results( "SELECT * FROM ".$table_name. " where `KitBoxSN`='".$kitBox."' or `ApplicatorSN`='".$ac_sn."'");
		$myrows = $wpdb->get_results( "SELECT * FROM ".$table_name. " where `KitBoxSN`='".$kitBox."'");
		$myrow = $wpdb->get_results( "SELECT * FROM ".$table_name1. " where `serialNumber`='".$ac_sn."'");
		
		if(!empty($myrow)){
			if($kitBox != ''){
			//serial number already exist
			$email = $myrow[0]->Email;
				if(!empty($myrows)){ // check if kit box already exist
				
					if($myrows[0]->KitBoxSN == $kitBox){
						echo "KitBox";
					}
				}
				 else{
						
					$data=array(
					'ApplicatorSN' => $ac_sn,
					'KitBoxSN' => $kitBox,
					'ActivationDate' => $activation_date, 
					'ActivationTime'=> $act_time,
					'ActivationIP' =>  $ip
					);
					$insert_query=$wpdb->insert($table_name,$data);
					if($insert_query){
						//echo "inserted";
						$msg = "Here the consumption code:";
						$msg .=" 11111";
						
						$headers = "From: myplace@example.com\r\n";
						$headers .= "Reply-To: myplace2@example.com\r\n";
						$headers .= "Return-Path: myplace@example.com\r\n";
						$headers .= "CC: sombodyelse@example.com\r\n";
						$headers .= "BCC: hidden@example.com\r\n";
						
						$sub = "Consumption Code";
						
						// minimum consumption flow
						$qry= $wpdb->get_results( "SELECT * FROM ".$table_name. " where `ApplicatorSN`='".$ac_sn."'");
						
						$activated_kitbox = count($qry);
						$min_con = $myrow[0]->MinimumConsumption;
						$picesInBox = 20;
						$days= 30;
						$activatedDate = $myrow[0]->ActivationDate;
						//in timestamp
						$activatedDate = strtotime($activatedDate);
						 
						$presentDate = date("m/d/Y");
						//in timestamp
						$presentDate = strtotime($presentDate);
						$time=abs($presentDate-$activatedDate);
						$Totaldays = floor($time/86400);

						$con = (($activated_kitbox )*($picesInBox) * ($days))/($Totaldays);							
							if($con > $min_con)
							{
								
								if(mail($email,$sub,$msg,$headers)){
										echo "consumption_code";
								}
							}else{
							
							echo "no_consumption";	
								$i =count($qry);
								$val = 1;
								if($val < 20){
									$i = $i+1;
									$val =  (($i )*($picesInBox) * ($days))/($Totaldays);
									echo "$$".$i;
								}
							
										
							}
							// end cunsumption code
					}else{
						echo "not inserted";
					}
			}
		}
		}else{
			$encodeString =convert_uuencode($ac_sn);
			$encodeString =base64_encode($encodeString);
			echo "New aplicator&&".$encodeString;
			
		}
		
exit;
}

///////////////////////////////////  Call Hooks   /////////////////////////////////////////////////////

// activation Hook called for installation_for_preaction
register_activation_hook(__FILE__, "plugin_install_script_for_preaction");


?>
