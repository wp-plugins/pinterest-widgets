<?php
/**
 * Define public facing class.
 *
 * @package    PW
 * @subpackage public
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Pinterest_Widgets {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.5';

	/**
	 * Unique identifier for this plugin.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'pinterest-widgets';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;
	
	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin 
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );
		
		// Add public scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}
	
	/**
	 * Enqueue necessary scripts
	 *
	 * @since     1.0.0
	 *
	*/
	public function enqueue_scripts() {
		
		global $pw_options, $post;
		
		$content = $post->post_content;
		
		$loadJS = false;
		
		// Need to check if there are any widgets or shortcodes before loading the JS so that we only add JS if needed
		// Check for shortcodes
		if( has_shortcode( $content, 'pin_follow' ) || has_shortcode( $content, 'pin_widget' ) || has_shortcode( $content, 'pin_board' ) || has_shortcode( $content, 'pin_profile' ) ) {
			$loadJS = true;
		}
		
		// Check for widgets
		if( is_active_widget( false, false, 'pw_board_widget', true ) || is_active_widget( false, false, 'pw_follow_button_widget', true ) || 
				is_active_widget( false, false, 'pw_pin_widget', true ) || is_active_widget( false, false, 'pw_profile_widget', true ) ) {
			$loadJS = true;
		}
		
		if( wp_script_is( 'pib-async-script-loader', 'enqueued' ) ) {
			$loadJS = false;
		}
		
		if( $loadJS ) {
			// Enqueue pinit.js
			if( empty( $pw_options['no_pinit_js'] ) ) {
				wp_enqueue_script( 'pinterest-pinit-js', '//assets.pinterest.com/js/pinit.js', array(), null, true );
			}
		}
	}
	
	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
}
