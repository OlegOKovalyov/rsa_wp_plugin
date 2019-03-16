<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Rsa_Enc_Dec
 * @subpackage Rsa_Enc_Dec/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Rsa_Enc_Dec
 * @subpackage rsa_enc_dec/includes
 * @author     Oleg Kovalyov <koa2003@ukr.net>
 */
class Rsa_Enc_Dec_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		global $wpdb;
		$table_name = $wpdb->prefix . 'rsa_table';

		if( $wpdb->get_var("SHOW TABLES LIKE 'rsa_table'") != $table_name ) {

		    //table not in database. Create new table
		    $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

		 //    $sql = "CREATE TABLE " . $table_name . " (
			// 	id mediumint(9) NOT NULL AUTO_INCREMENT,
			// 	time bigint(11) DEFAULT '0' NOT NULL,
			// 	name tinytext NOT NULL,
			// 	text text NOT NULL,
			// 	url VARCHAR(55) NOT NULL,
			// 	UNIQUE KEY id (id)
			// )
			// {$charset_collate};";
			
		    $sql = "CREATE TABLE " . $table_name . " (
				id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
				rsastrings VARBINARY(8000) NOT NULL,
				publickeys TEXT NOT NULL,
				privatkeys TEXT NOT NULL,
				strings TEXT NOT NULL,
				UNIQUE KEY id (id)
			)
			{$charset_collate};";			

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		 
		}
		else{
			// echo 'Database has not been created. It already existed.';
			// wp_die(__('Database ' . $table_name . ' already exists!'));
		}
	}

}
