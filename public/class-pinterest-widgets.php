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
	const VERSION = '1.0.6';

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
		add_action( 'init', array( $this, 'enqueue_scripts' ) );
		
		// Load scripts when posts load so we know if we need to include them or not
		add_filter( 'the_posts', array( $this, 'load_scripts' ) );
	}
	
	function load_scripts( $posts ) {
		
		if ( empty( $posts ) ) {
			return $posts;
		}
		
		foreach ( $posts as $post ) {
			if ( strpos( $post->post_content, '[pin_follow' ) !== false || 
				strpos( $post->post_content, '[pin_widget' ) !== false || 
				strpos( $post->post_content, '[pin_board' ) !== false ||
				strpos( $post->post_content, '[pin_profile' ) !== false ) {
				// Load JS
				wp_enqueue_script( 'pinterest-pinit-js' );
				
				break;
			}
		}

		return $posts;
	}
	
	/**
	 * Enqueue necessary scripts
	 *
	 * @since     1.0.0
	 *
	*/
	public function enqueue_scripts() {
		//if( ! wp_script_is( 'pib-async-script-loader', 'enqueued' ) ) {
			wp_register_script( 'pinterest-pinit-js', '//assets.pinterest.com/js/pinit.js', array(), self::VERSION, true );
		//}
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
