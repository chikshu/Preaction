<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
include '../../../../wp-config.php';
global $wpdb;
$table_name = $wpdb->prefix."Applicator";
$sno = $_POST['sno'];
$email = $_POST['email'];
if($sno != ''  || $email !=''){
$myrows = $wpdb->get_results( "SELECT * FROM ".$table_name. " where `Email`='".$email."' or `serialNumber`='".$sno."'");
if($myrows > 0 ){
	echo "already exist";
	}else{
	echo "insert";
	}
}
?>
