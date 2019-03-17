<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/OlegOKovalyov/rsa_wp_plugin
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
 * @author     Oleg Kovalyov <koa2003@ukr.net>
 */
class Rsa_Enc_Dec_Deactivator {

	/**
	 * Drop plugin's database table during plugin deactivation
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		global $wpdb;
	    $table_name = $wpdb->prefix . 'rsa_table';
	    $sql = "DROP TABLE IF EXISTS $table_name";
	    $wpdb->query($sql);
	}

}