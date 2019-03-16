<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Rsa_Enc_Dec
 * @subpackage Rsa_Enc_Dec/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Rsa_Enc_Dec
 * @subpackage Rsa_Enc_Dec/includes
 * @author     Your Name <email@example.com>
 */
class Rsa_Enc_Dec_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		global $wpdb;
	    $table_name = $wpdb->prefix . 'rsa_table';
	    $sql = "DROP TABLE IF EXISTS $table_name";
	    $wpdb->query($sql);
	    // delete_option('e34s_time_card_version');

	}

}
