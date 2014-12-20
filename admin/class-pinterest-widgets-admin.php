<?php
/**
 * Define plugin admin class.
 *
 * @package    PW
 * @subpackage admin
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class Pinterest_Widgets_Admin {

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
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {
		
		$this->setup_constants();

		$plugin = Pinterest_Widgets::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();
		
		// Load the plugin text domain for translations
		//add_action( 'plugins_loaded', array( $this, 'plugin_textdomain' ) );
		$this->plugin_textdomain();
		
		// Load admin style sheets.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );
		
		// Make sure we load our include files
		add_action( 'init', array( $this, 'includes' ), 0 );
		
		// Check WP version
		add_action( 'admin_init', array( $this, 'check_wp_version' ) );
		
		// Add admin notice after plugin activation. Also check if should be hidden.
		add_action( 'admin_notices', array( $this, 'admin_install_notice' ) );
	}
	
	/**
	 * Load the plugin text domain
	 * 
	 * @since 1.0.3
	 */
	function plugin_textdomain() {
		
		load_plugin_textdomain(
			'pw',
			false,
			dirname( plugin_basename( PW_MAIN_FILE ) ) . '/languages/'
		);
	}
	
	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    2.0.0
	 */
	public static function activate() {
		update_option( 'pw_show_admin_install_notice', 1 );
	}
	
	public function admin_install_notice() {
		// Exit all of this is stored value is false/0 or not set.
		if ( false == get_option( 'pw_show_admin_install_notice' ) )
			return;

		// Delete stored value if "hide" button click detected (custom querystring value set to 1).
		// or if on a PIB admin page. Then exit.
		if ( ! empty( $_REQUEST['pw-dismiss-install-nag'] ) || $this->viewing_this_plugin() || get_current_screen()->id == 'widgets' ) {
			delete_option( 'pw_show_admin_install_notice' );
			return;
		}

		// At this point show install notice. Show it only on the plugin screen.
		if( get_current_screen()->id == 'plugins' ) {
			include_once( 'views/admin-install-notice.php' );
		}
	}
	
	public function setup_constants() {
		if( ! defined( 'PINPLUGIN_BASE_URL' ) ) {
			define( 'PINPLUGIN_BASE_URL', 'http://pinplugins.com/' );
		}
	}
	
	/**
	 * Make sure user has the minimum required version of WordPress installed to use the plugin
	 * 
	 * @since 1.0.0
	 */
	public function check_wp_version() {
		global $wp_version;
		$required_wp_version = '3.8.5';
		
		if ( version_compare( $wp_version, $required_wp_version, '<' ) ) {
			deactivate_plugins( PW_MAIN_FILE ); 
			wp_die( sprintf( __( $this->get_plugin_title() . ' requires WordPress version <strong>' . $required_wp_version . '</strong> to run properly. ' .
				'Please update WordPress before reactivating this plugin. <a href="%s">Return to Plugins</a>.', 'pw' ), get_admin_url( '', 'plugins.php' ) ) );
		}
	}
	
	/**
	 * Include all necessary files
	 *
	 * @since     1.0.0
	 *
	 */
	public function includes() {
		// Setup global options and load plugin settings
		global $pw_options;
		
		include_once( 'includes/register-settings.php' );
		
		$pw_options = pw_get_settings();
		
		// include admin notices
		include_once( 'includes/admin-notices.php' );
		
		// include our plugin wide functions
		include_once( 'includes/functions.php' );
		
		// include our Follow Button widget code
		include_once( 'includes/widget-follow-button.php' );
		
		// include our Pin Widget widget code
		include_once( 'includes/widget-pin.php' );
		
		// include our Profile Widget widget code 
		include_once( 'includes/widget-profile.php' );
		
		// include our Board Widget widget code
		include_once( 'includes/widget-board.php' );
		
		// include our shortcodes file
		include_once( 'includes/shortcodes.php' );
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

	/**
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 */
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();

		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			// Plugin admin CSS. Tack on plugin version.
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Pinterest_Widgets::VERSION );
		}
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
		$this->plugin_screen_hook_suffix = add_submenu_page(
			'options-general.php',
			$this->get_plugin_title() . __( ' Settings', 'pw' ),
			__( 'Pinterest Widgets', 'pw' ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);
		/*
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Page Title', $this->plugin_slug ),
			__( 'Menu Text', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);
		*/
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}
	
	/**
	 * Get the plugin title
	 *
	 * @since     1.0.0
	 *
	 */
	function get_plugin_title() {
		return __( 'Pinterest Widgets', 'pw' );
	}
	
	/**
	 * Check if viewing one of this plugin's admin pages.
	 *
	 * @since   2.0.0
	 *
	 * @return  bool
	 */
	private function viewing_this_plugin() {
		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return false;
		}

		$screen = get_current_screen();

		if ( $screen->id == $this->plugin_screen_hook_suffix ) {
			return true;
		} else {
			return false;
		}
	}

}
