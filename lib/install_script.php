<?php

////////////////// function for create the table /////////////////
if(!function_exists("create_Applicator_tbl"))
{
	function create_Applicator_tbl()
		{
			global $wpdb;
			$table_name = Applicator_tbl();	
			$charset_collate = $wpdb->get_charset_collate();
				$sql = "CREATE TABLE $table_name (
					id mediumint(9) NOT NULL AUTO_INCREMENT,
					serialNumber TEXT NOT NULL,
					Email VARCHAR(55) NOT NULL,
					FulleName VARCHAR(55) NOT NULL,
					ClinicName VARCHAR(55) NOT NULL,
					DistributorName VARCHAR(55) NOT NULL,
					OtherDetail TEXT NOT NULL,
					ActivationDate VARCHAR(55) NOT NULL,
					ActivationTime VARCHAR(55) NOT NULL,
					ActivationIP TEXT(55) NOT NULL,
					ActivatedSatus VARCHAR(55) NOT NULL,
					MinimumConsumption INT(55) NOT NULL,
					UNIQUE KEY id (id)		
				) $charset_collate;";		
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
}
if(!function_exists("create_KitBox_tbl"))
{
	function create_KitBox_tbl()
		{
			global $wpdb;
			$table_name = KitBox_tbl();	
			$charset_collate = $wpdb->get_charset_collate();
				$sql = "CREATE TABLE $table_name (
					id mediumint(9) NOT NULL AUTO_INCREMENT,
					KitBoxSN VARCHAR(55) NOT NULL,
					ApplicatorSN VARCHAR(55) NOT NULL,
					ActivationDate VARCHAR(55) NOT NULL,
					ActivationTime VARCHAR(55) NOT NULL,
					ActivationIP TEXT(55) NOT NULL,
					UNIQUE KEY id (id)		
				) $charset_collate;";		
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
}

global $wpdb;
if (count($wpdb->get_var("SHOW TABLES LIKE '" . Applicator_tbl() . "'")) == 0)
	{
		create_Applicator_tbl();
	}
if (count($wpdb->get_var("SHOW TABLES LIKE '" . KitBox_tbl() . "'")) == 0)
	{
		create_KitBox_tbl();
	}

	
?>
