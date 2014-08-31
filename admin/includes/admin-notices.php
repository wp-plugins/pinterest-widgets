<?php

/**
 *  Admin settings page update notices.
 *
 * @package    PW
 * @subpackage admin/includes
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add save settings message for admin settings
 *
 * @since     1.0.0
 *
 */
function pw_register_admin_notices() { 
	
	if ( ( isset( $_GET['page'] ) && 'pinterest-widgets' == $_GET['page'] ) && ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) ) {
		add_settings_error( 'pw-notices', 'pw-general-updated', __( 'Settings updated.', 'pw' ), 'updated' );
	}

}
add_action( 'admin_notices', 'pw_register_admin_notices' );
