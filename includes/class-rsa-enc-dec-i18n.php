<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/OlegOKovalyov/rsa_wp_plugin
 * @since      1.0.0
 *
 * @package    Rsa_Enc_Dec
 * @subpackage Rsa_Enc_Dec/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Rsa_Enc_Dec
 * @subpackage Rsa_Enc_Dec/includes
 * @author     Oleg Kovalyov <koa2003@ukr.net>
 */
class Rsa_Enc_Dec_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'rsa-enc-dec',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}