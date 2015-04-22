<?php

/**
 * Register all settings needed for the Settings API.
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
 * Register all settings for the plugin
 *
 * @since     1.0.0
 *
 */
function pw_register_settings() {
	$pw_settings = array(

		/* General Settings */
		'general' => array(
			'no_pinit_js' => array(
				'id'   => 'no_pinit_js',
				'name' => __( 'Disable <code>pinit.js</code>', 'pw' ),
				'desc' => __( 'Disable output of <code>pinit.js</code>, the JavaScript file for all widgets from Pinterest.', 'pw' ) .
					'<p class="description">' . __( 'Check this option if you have <code>pinit.js</code> referenced in another plugin, widget or your theme. ' .
						'Ouputting <code>pinit.js</code> more than once on a page can cause conflicts.', 'pw' ) . '</p>',
				'type' => 'checkbox'
			),
			'always_enqueue' => array(
				'id'   => 'always_enqueue',
				'name' => __( 'Always Enqueue Scripts & Styles', 'pw' ),
				'desc' => __( 'Enqueue this plugin\'s scripts and styles on every post and page.', 'pw' ) . '<br/>' .
				          '<p class="description">' . __( 'Useful if using shortcodes in widgets or other non-standard locations.', 'pw' ) . '</p>',
				'type' => 'checkbox'
			),
			'uninstall_save_settings' => array(
				'id'   => 'uninstall_save_settings',
				'name' => __( 'Save Settings', 'pw' ),
				'desc' => __( 'Save your settings when uninstalling this plugin. Useful when upgrading or re-installing.', 'pw' ),
				'type' => 'checkbox'
			)
		)
	);

	/* If the options do not exist then create them for each section */
	if ( false == get_option( 'pw_settings_general' ) ) {
		add_option( 'pw_settings_general' );
	}

	/* Add the General Settings section */
	add_settings_section(
		'pw_settings_general',
		__( 'General Settings', 'pw' ),
		'__return_false',
		'pw_settings_general'
	);

	foreach ( $pw_settings['general'] as $option ) {
		add_settings_field(
			'pw_settings_general[' . $option['id'] . ']',
			$option['name'],
			function_exists( 'pw_' . $option['type'] . '_callback' ) ? 'pw_' . $option['type'] . '_callback' : 'pw_missing_callback',
			'pw_settings_general',
			'pw_settings_general',
			pw_get_settings_field_args( $option, 'general' )
		);
	}

	/* Register all settings or we will get an error when trying to save */
	register_setting( 'pw_settings_general',         'pw_settings_general',         'pw_settings_sanitize' );

}
add_action( 'admin_init', 'pw_register_settings' );

/*
 * Return generic add_settings_field $args parameter array.
 *
 * @since     1.0.0
 *
 * @param   string  $option   Single settings option key.
 * @param   string  $section  Section of settings apge.
 * @return  array             $args parameter to use with add_settings_field call.
 */
function pw_get_settings_field_args( $option, $section ) {
	$settings_args = array(
		'id'      => $option['id'],
		'desc'    => $option['desc'],
		'name'    => $option['name'],
		'section' => $section,
		'size'    => isset( $option['size'] ) ? $option['size'] : null,
		'options' => isset( $option['options'] ) ? $option['options'] : '',
		'std'     => isset( $option['std'] ) ? $option['std'] : ''
	);

	// Link label to input using 'label_for' argument if text, textarea, password, select, or variations of.
	// Just add to existing settings args array if needed.
	if ( in_array( $option['type'], array( 'text', 'select', 'textarea', 'password', 'number' ) ) ) {
		$settings_args = array_merge( $settings_args, array( 'label_for' => 'pw_settings_' . $section . '[' . $option['id'] . ']' ) );
	}

	return $settings_args;
}


/*
 * Single checkbox callback function
 * 
 * @since 1.0.0
 * 
 */
function pw_checkbox_callback( $args ) {
	global $pw_options;

	$checked = isset( $pw_options[$args['id']] ) ? checked( 1, $pw_options[$args['id']], false ) : '';
	$html = "\n" . '<input type="checkbox" id="pw_settings_' . $args['section'] . '[' . $args['id'] . ']" name="pw_settings_' . $args['section'] . '[' . $args['id'] . ']" value="1" ' . $checked . '/>' . "\n";

	// Render description text directly to the right in a label if it exists.
	if ( ! empty( $args['desc'] ) )
		$html .= '<label for="pw_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>' . "\n";

	echo $html;
}


/*
 * Function we can use to sanitize the input data and return it when saving options
 * 
 * @since 1.0.0
 * 
 */
function pw_settings_sanitize( $input ) {
	add_settings_error( 'pw-notices', '', '', '' );
	return $input;
}

/*
 *  Default callback function if correct one does not exist
 * 
 * @since 1.0.0
 * 
 */
function pw_missing_callback( $args ) {
	printf( __( 'The callback function used for the <strong>%s</strong> setting is missing.', 'pw' ), $args['id'] );
}

/*
 * Function used to return an array of all of the plugin settings
 * 
 * @since 1.0.0
 * 
 * @return array
 * 
 */
function pw_get_settings() {
	
	if( ! get_option( 'pw_has_run' ) ) {
		
		$general = get_option( 'pw_settings_general' );
		
		$general['uninstall_save_settings'] = 1;
		$general['always_enqueue']          = 1;
		
		update_option( 'pw_settings_general', $general );
		
		add_option( 'pw_has_run', 1 );
	}

	$general_settings         = is_array( get_option( 'pw_settings_general' ) ) ? get_option( 'pw_settings_general' )  : array();

	return array_merge( $general_settings );
}
