<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Rsa_Enc_Dec
 * @subpackage Rsa_Enc_Dec/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rsa_Enc_Dec
 * @subpackage Rsa_Enc_Dec/public
 * @author     Oleg Kovalyov <koa2003@ukr.net>
 */

class Rsa_Enc_Dec_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $rsa_enc_dec    The ID of this plugin.
	 */
	private $rsa_enc_dec;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $rsa_enc_dec       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $rsa_enc_dec, $version ) {

		$this->rsa_enc_dec = $rsa_enc_dec;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rsa_Enc_Dec_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rsa_Enc_Dec_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->rsa_enc_dec, plugin_dir_url( __FILE__ ) . 'css/rsa-enc-dec-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rsa_Enc_Dec_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rsa_Enc_Dec_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->rsa_enc_dec, plugin_dir_url( __FILE__ ) . 'js/rsa-enc-dec-public.js', array( 'jquery' ), $this->version, false );

	}

	public function the_content( $post_content ) {

		if ( is_main_query() && is_singular('page') ) {
			$position  = get_option( 'rsa_enc_dec_position', 'before' );
			$days      = (int) get_option( 'rsa_enc_dec_notice_day', 0 );
			$date_now  = new DateTime( current_time('mysql') );
			$date_old  = new DateTime( get_the_modified_time('Y-m-d H:i:s') );
			$date_diff = $date_old->diff( $date_now );
			if ( $date_diff->days > $days ) {
				$class = 'is-outdated';
			} else {
				$class = 'is-fresh';
			}

add_shortcode( 'rsa_tag', array( 'Rsa_Core', 'rsa_string_show' ) );

// global $wpdb;
// echo '<pre>';
// var_dump($wpdb);
// echo '</pre>';

			//create keys
			// Rsa_Core::createKeyPair(1024);
			//Text to encrypt
			// $text = "A secret lies here, send the text via a secure mode";
			// echo 'Text : ' . $text . '<br><br>';
			 
			// $secureText = Rsa_Core::encryptText($text);
			// echo 'Encrypted : ' . $secureText . '<br><br>';
			 
			// $decrypted_text =  Rsa_Core::decryptText($secureText);
			// echo 'Decrypted Text : ' . $decrypted_text . '<br><br>';

			// Filter the text
			$notice = sprintf(
						_n(
							'This post was last updated %s day ago.',
							'This post was last updated %s days ago.',
							$date_diff->days,
							'rsa-enc-dec'
						),
						$date_diff->days
					);

			// Add the class
			$notice = '<div class="rsa-enc-dec %s">' . $notice . '</div>';
			$notice = sprintf( $notice, $class );

			if ( 'after' == $position ) {
				$post_content .= $notice;
			} else {
				$post_content = $notice . $post_content;
			}
		}

        return $post_content;
	}


	// public function rsa_core( $post_content ) {
		//create keys
		// Rsa_Core::createKeyPair(1024);
		 
		//Text to encrypt
		// $text = "A secret lies here, send the text via a secure mode";
		// echo 'Text : '.$text;
		 
		// $secureText = Rsa_Core::encryptText($text);
		// echo 'Encrypted : '.$secureText;
		 
		// $decrypted_text =  Rsa_Core::decryptText($secureText);
		// echo 'Decrypted Text : '.$decrypted_text;

	// }
}