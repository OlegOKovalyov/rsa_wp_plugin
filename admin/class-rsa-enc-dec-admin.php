<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/OlegOKovalyov/rsa_wp_plugin
 * @since      1.0.0
 *
 * @package    Rsa_Enc_Dec
 * @subpackage Rsa_Enc_Dec/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks for enqueue 
 * the admin-specific stylesheet and JavaScript, functions for an options page 
 * under the Settings submenu and its functionality.
 *
 * @package    Rsa_Enc_Dec
 * @subpackage Rsa_Enc_Dec/admin
 * @author     Oleg Kovalyov <koa2003@ukr.net>
 */
class Rsa_Enc_Dec_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $rsa_enc_dec    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'rsa_enc_dec';	

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $rsa_enc_dec       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->option_name, plugin_dir_url( __FILE__ ) . 'css/rsa-enc-dec-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->option_name, plugin_dir_url( __FILE__ ) . 'js/rsa-enc-dec-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function add_options_page() {
	
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Rsa-Enc-Dec Plugin Settings', 'rsa-enc-dec' ),
			__( 'Rsa-Enc-Dec', 'rsa-enc-dec' ),
			'manage_options',
			$this->option_name,
			array( $this, 'display_options_page' )
		);
	
	}

	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function display_options_page() {
		include_once 'partials/rsa-enc-dec-admin-display.php';
	}

	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.0.0
	 */	
	public function register_setting() {

		// Add a General section
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', 'rsa-enc-dec' ),
			array( $this, $this->option_name . '_general_cb' ),
			$this->plugin_name
		);

		add_settings_field(
			$this->option_name . '_position',
			__( 'Text position', 'rsa-enc-dec' ),
			array( $this, $this->option_name . '_position_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_position' )
		);

		add_settings_field(
			$this->option_name . '_day',
			__( 'Post is outdated after', 'rsa-enc-dec' ),
			array( $this, $this->option_name . '_day_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_day' )
		);
		register_setting( $this->plugin_name, $this->option_name . '_position', array( $this, $this->option_name . '_sanitize_position' ) );
		register_setting( $this->plugin_name, $this->option_name . '_day', 'intval' );

	 }

	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function rsa_enc_dec_general_cb() {
		echo '<p>' . __( 'Please change the settings accordingly.', 'rsa-enc-dec' ) . '</p>';
	}

	/**
	 * Render the radio input field for position option
	 *
	 * @since  1.0.0
	 */
	public function rsa_enc_dec_position_cb() {
		$position = get_option( $this->option_name . '_position' );
		?>
			<fieldset>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_position' ?>" id="<?php echo $this->option_name . '_position' ?>" value="before" <?php checked( $position, 'before' ); ?>>
					<?php _e( 'Before the content', 'rsa-enc-dec' ); ?>
				</label>
				<br>
				<label>
					<input type="radio" name="<?php echo $this->option_name . '_position' ?>" value="after" <?php checked( $position, 'after' ); ?>>
					<?php _e( 'After the content', 'rsa-enc-dec' ); ?>
				</label>
			</fieldset>
		<?php
	}

	/**
	 * Render the threshold day input for this plugin
	 *
	 * @since  1.0.0
	 */
	public function rsa_enc_dec_day_cb() {
		$day = get_option( $this->option_name . '_day' );
		echo '<input type="text" name="' . $this->option_name . '_day' . '" id="' . $this->option_name . '_day' . '" value="' . $day . '"> ' . __( 'days', 'rsa-enc-dec' );
	}

	/**
	 * Sanitize the text position value before being saved to database
	 *
	 * @param  string $position $_POST value
	 * @since  1.0.0
	 * @return string           Sanitized value
	 */
	public function rsa_enc_dec_sanitize_position( $position ) {
		if ( in_array( $position, array( 'before', 'after' ), true ) ) {
	        return $position;
	    }
	}

}


