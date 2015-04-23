<?php



/**
 * Main GCE Upgrade function. Call this and branch of from here depending on what we need to do
 * 
 * @since 2.0.0
 */
function pw_upgrade() {
	
	$existing_version = get_option( 'pw_version' );
	
	// Check if under version 2 and run the v2 upgrade if we are
	if( version_compare( $existing_version, '1.0.6', '<' ) && false === get_option( 'pw_upgrade_has_run' ) ) {
		pw_106_upgrade();
	}
	
	update_option( 'pw_version', Pinterest_Widgets::get_plugin_version() );
	
	add_option( 'pw_upgrade_has_run', 1 );
}
add_action( 'init', 'pw_upgrade', 1 );

function pw_106_upgrade() {
	
	$general = get_option( 'pw_settings_general' );
	
	$general['always_enqueue'] = 1;
	
	update_option( 'pw_settings_general', $general );
}
