<?php

/**
 * Pinterest Widgets
 *
 * @package   PW
 * @author    Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license   GPL-2.0+
 * @link      http://pinplugins.com
 * @copyright 2014-2015 Phil Derksen
 *
 * @wordpress-plugin
 * Plugin Name: Pinterest Widgets
 * Plugin URI: http://pinplugins.com/pinterest-widgets-wordpress-plugin/
 * Description: Easily add a Pinterest Follow Button, Pin Widget, Board Widget and Profile Widget to your site. Includes shortcodes.
 * Version: 1.0.6.1
 * Author: Phil Derksen
 * Author URI: http://philderksen.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/pderksen/WP-Pinterest-Widgets
 * Text Domain: pw
 * Domain Path: /languages/
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'PW_MAIN_FILE' ) ) {
	define ( 'PW_MAIN_FILE', __FILE__ );
}


if ( ! defined( 'PW_DIR_PATH' ) ) {
	define( 'PW_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

// Admin class included here because widgets need both admin and public side so we need this here until we come up with a better solution
require_once( plugin_dir_path( __FILE__ ) . 'admin/class-pinterest-widgets-admin.php' );

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
register_activation_hook( __FILE__, array( 'Pinterest_Widgets_Admin', 'activate' ) );

// Get admin instance
add_action( 'plugins_loaded', array( 'Pinterest_Widgets_Admin', 'get_instance' ) );


require_once( plugin_dir_path( __FILE__ ) . 'public/class-pinterest-widgets.php' );

// Get instance of our plugin
add_action( 'plugins_loaded', array( 'Pinterest_Widgets', 'get_instance' ) );
