<?php
/*
 * Plugin Name: Rsa-Enc-Dec
 * Description: RSA-encription and RSA-decription with public and private keys
 * Author URI:  https://github.com/OlegOKovalyov/
 * Author:      Oleg Kovalyov
 * Version:     1.0.0
 * License:     GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'RSA_ENC_DEC_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rsa-enc-dec-activator.php
 */
function activate_rsa_enc_dec() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rsa-enc-dec-activator.php';
	Rsa_Enc_Dec_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rsa-enc-dec-deactivator.php
 */
function deactivate_rsa_enc_dec() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rsa-enc-dec-deactivator.php';
	Rsa_Enc_Dec_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rsa_enc_dec' );
register_deactivation_hook( __FILE__, 'deactivate_rsa_enc_dec' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rsa-enc-dec.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rsa_enc_dec() {

	$plugin = new Rsa_Enc_Dec();
	$plugin->run();

}
run_rsa_enc_dec();