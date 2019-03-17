<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/OlegOKovalyov/rsa_wp_plugin
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
	 * Create new database table during plugin activation
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		global $wpdb;
		$table_name = $wpdb->prefix . 'rsa_table';

		if( $wpdb->get_var("SHOW TABLES LIKE 'rsa_table'") != $table_name ) {

		    // Table not in database. Create new table
		    $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";
			
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
		else {

		}
	}

}