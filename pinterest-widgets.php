<?php
/**
 * Pinterest Widgets
 *
 * @package   PW
 * @author    Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 * @license   GPL-2.0+
 * @link      http://pinterestplugin.com
 * @copyright 2014 Phil Derksen
 *
 * @wordpress-plugin
 * Plugin Name: Pinterest Widgets
 * Plugin URI: http://pinterestplugin.com/pinterest-widgets-wordpress-plugin/
 * Description: Easily add a Pinterest Follow Button, Pin Widget, Board Widget and Profile Widget to your site. Includes shortcodes.
 * Version: 1.0.0
 * Author: Phil Derksen
 * Author URI: http://philderksen.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

// Admin class included here because widgets need both admin and public side so we need this here until we come up with a better solution
require_once( plugin_dir_path( __FILE__ ) . 'admin/class-pinterest-widgets-admin.php' );
	
add_action( 'plugins_loaded', array( 'Pinterest_Widgets_Admin', 'get_instance' ) );


require_once( plugin_dir_path( __FILE__ ) . 'public/class-pinterest-widgets.php' );

// Get instance of our plugin
add_action( 'plugins_loaded', array( 'Pinterest_Widgets', 'get_instance' ) );

