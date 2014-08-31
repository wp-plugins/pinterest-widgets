<?php

/*************************
 * FILTER HOOKS
 ************************/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Modify the HTML output of the Follow Button shortcode
 * 
 * @since 1.0.1
 */
function test_pw_follow_button_shortcode_html( $html ) {
	return '<div style="border: 5px solid #f00; padding: 15px;">' . $html . '</div>';
}
add_filter( 'pw_follow_button_shortcode_html', 'test_pw_follow_button_shortcode_html' );


/**
 * Insert before the Follow Button shortcode HTML
 * 
 * @since 1.0.1
 */
function test_pw_follow_button_shortcode_before( $before_html ) {
	return '<p>Before Follow Button</p>';
}
add_filter( 'pw_follow_button_shortcode_before', 'test_pw_follow_button_shortcode_before' );


/**
 * Insert after the Follow Button shortcode HTML
 * 
 * @since 1.0.1
 */
function test_pw_follow_button_shortcode_after( $after_html ) {
	return '<p>After Follow Button</p>';
}
add_filter( 'pw_follow_button_shortcode_after', 'test_pw_follow_button_shortcode_after' );


/**
 * Insert before the Pin Widget shortcode HTML
 * 
 * @since 1.0.1
 */
function test_pw_pin_widget_shortcode_before( $before_html ) {
	return '<p>Before Pin Widget</p>';
}
add_filter( 'pw_pin_widget_shortcode_before', 'test_pw_pin_widget_shortcode_before' );


/**
 * Modify the HTML output of the Pin Widget shortcode
 * 
 * @since 1.0.1
 */
function test_pw_pin_widget_shortcode_html( $html ) {
	return '<div style="border: 5px solid #f00; padding: 15px;">' . $html . '</div>';
}
add_filter( 'pw_pin_widget_shortcode_html', 'test_pw_pin_widget_shortcode_html' );


/**
 * Insert after the Pin Widget shortcode HTML
 * 
 * @since 1.0.1
 */
function test_pw_pin_widget_shortcode_after( $after_html ) {
	return '<p>After Pin Widget</p>';
}
add_filter( 'pw_pin_widget_shortcode_after', 'test_pw_pin_widget_shortcode_after' );


/**
 * Insert before the Board Widget shortcode HTML
 * 
 * @since 1.0.1
 */
function test_pw_board_widget_shortcode_before( $before_html ) {
	return '<p>Before Board Widget</p>';
}
add_filter( 'pw_board_widget_shortcode_before', 'test_pw_board_widget_shortcode_before' );


/**
 * Modify the output HTML of the Board Widget shortcode
 * 
 * @since 1.0.1
 */
function test_pw_board_widget_shortcode_html( $html ) {
	return '<div style="border: 5px solid #f00; padding: 15px;">' . $html . '</div>';
}
add_filter( 'pw_board_widget_shortcode_html', 'test_pw_board_widget_shortcode_html' );


/**
 * Insert after the Board Widget shortcode HTML
 * 
 * @since 1.0.1
 */
function test_pw_board_widget_shortcode_after( $after_html ) {
	return '<p>After Board Widget</p>';
}
add_filter( 'pw_board_widget_shortcode_after', 'test_pw_board_widget_shortcode_after' );


/**
 * Insert before the Profile Widget shortcode HTML
 * 
 * @since 1.0.1
 */
function test_pw_profile_shortcode_before( $before_html ) {
	return '<p>Before Profile</p>';
}
add_filter( 'pw_profile_shortcode_before', 'test_pw_profile_shortcode_before' );


/**
 * Modify the Profile Widget shortcode HTML
 * 
 * @since 1.0.1
 */
function test_pw_profile_shortcode_html( $html ) {
	return '<div style="border: 5px solid #f00; padding: 15px;">' . $html . '</div>';
}
add_filter( 'pw_profile_shortcode_html', 'test_pw_profile_shortcode_html' );


/**
 * Insert after the Profile Widget shortcode HTML
 * 
 * @since 1.0.1
 */
function test_pw_profile_shortcode_after( $after_html ) {
	return '<p>After Profile</p>';
}
add_filter( 'pw_profile_shortcode_after', 'test_pw_profile_shortcode_after' );


/**
 * Modify the Board Widget widget HTML
 * 
 * @since 1.0.1
 */
function test_pw_board_widget_html( $html ) {
	return '<div style="border: 5px solid #f00; padding: 15px;">' . $html . '</div>';
}
add_filter( 'pw_board_widget_html', 'test_pw_board_widget_html' );


/**
 * Modify the Follow Button widget HTML
 * 
 * @since 1.0.1
 */
function test_pw_follow_button_html( $html ) {
	return '<div style="border: 5px solid #f00; padding: 15px;">' . $html . '</div>';
}
add_filter( 'pw_follow_button_html', 'test_pw_follow_button_html' );


/**
 * Modify the Pin Widget widget HTML
 * 
 * @since 1.0.1
 */
function test_pw_pin_widget_html( $html ) {
	return '<div style="border: 5px solid #f00; padding: 15px;">' . $html . '</div>';
}
add_filter( 'pw_pin_widget_html', 'test_pw_pin_widget_html' );


/**
 * Modify the Profile Widget widget HTML
 * 
 * @since 1.0.1
 */
function test_pw_profile_widget_html( $html ) {
	return '<div style="border: 5px solid #f00; padding: 15px;">' . $html . '</div>';
}
add_filter( 'pw_profile_widget_html', 'test_pw_profile_widget_html' );


/*************************
 * ACTION HOOKS
 ************************/

/**
 * Insert before the Board Widget widget HTML
 * 
 * @since 1.0.1
 */
function test_pw_board_widget_before() {
	echo '<p>Before Board Widget</p>';
}
add_action( 'pw_board_widget_before', 'test_pw_board_widget_before' );


/**
 * Insert after the Board Widget widget HTML
 * 
 * @since 1.0.1
 */
function test_pw_board_widget_after() {
	echo '<p>After Board Widget</p>';
}
add_action( 'pw_board_widget_after', 'test_pw_board_widget_after' );


/**
 * Insert before the Follow Button widget HTML
 * 
 * @since 1.0.1
 */
function test_pw_follow_button_before() {
	echo '<p>Before Follow Button</p>';
}
add_action( 'pw_follow_button_before', 'test_pw_follow_button_before' );


/**
 * Insert after the Follow Button widget HTML
 * 
 * @since 1.0.1
 */
function test_pw_follow_button_after() {
	echo '<p>After Follow Button</p>';
}
add_action( 'pw_follow_button_after', 'test_pw_follow_button_after' );


/**
 * Insert before the Pin Widget widget HTML
 * 
 * @since 1.0.1
 */
function test_pw_pin_widget_before() {
	echo '<p>Before Pin WIdget</p>';
}
add_action( 'pw_pin_widget_before', 'test_pw_pin_widget_before' );


/**
 * Insert after the Pin Widget widget HTML
 * 
 * @since 1.0.1
 */
function test_pw_pin_widget_after() {
	echo '<p>After Pin Widget</p>';
}
add_action( 'pw_pin_widget_after', 'test_pw_pin_widget_after' );


/**
 * Insert before the Profile Widget widget HTML
 * 
 * @since 1.0.1
 */
function test_pw_profile_widget_before() {
	echo '<p>Before Profile Widget</p>';
}
add_action( 'pw_profile_widget_before', 'test_pw_profile_widget_before' );


/**
 * Insert after the Profile Widget widget HTML
 * 
 * @since 1.0.1
 */
function test_pw_profile_widget_after() {
	echo '<p>After Profile Widget</p>';
}
add_action( 'pw_profile_widget_after', 'test_pw_profile_widget_after' );

