<?php

/**
 * Define plugin shortcodes.
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
 * Process and return shortcode for Pinterest Follow Button
 *
 * @since     1.0.0
 * @modified  1.0.1
 *
 * @return    string
 */
function pw_follow_button( $attr ) {
	
	extract( shortcode_atts( array(
					'username' => 'pinterest',
					'label'    => 'Follow me on Pinterest'
				), $attr ) );
	
	$before_html = '';
	$html        = '<div class="pw-wrap pw-shortcode">' . pw_pin_follow( $username, $label ) . '</div>';
	$after_html  = '';
	
	$before_html = apply_filters( 'pw_follow_button_shortcode_before', $before_html );
	$html        = apply_filters( 'pw_follow_button_shortcode_html', $html );
	$after_html  = apply_filters( 'pw_follow_button_shortcode_after', $after_html );
	
	return $before_html . $html . $after_html;
}
add_shortcode( 'pin_follow', 'pw_follow_button' );

/**
 * Process and return shortcode for Pinterest Pin Widget
 *
 * @since     1.0.0
 * @modified  1.0.1
 * 
 * @return    string
 */
function pw_pin_widget( $attr ) {
	
	extract( shortcode_atts( array(
					'url'   => 'http://www.pinterest.com/pin/99360735500167749/'
				), $attr ) );
	
	$before_html = '';
	$html        = '<div class="pw-wrap pw-shortcode">' . pw_pin_link( $url, '', 'embedPin' ) . '</div>';
	$after_html  = '';
	
	$before_html = apply_filters( 'pw_pin_widget_shortcode_before', $before_html );
	$html        = apply_filters( 'pw_pin_widget_shortcode_html', $html );
	$after_html  = apply_filters( 'pw_pin_widget_shortcode_after', $after_html );
	
	return $before_html . $html . $after_html;
}
add_shortcode( 'pin_widget', 'pw_pin_widget' );

/**
 * Process and return shortcode for Pinterest Board Widget
 *
 * @since     1.0.0
 * @modified  1.0.1
 * 
 * @return    string
 */
function pw_board_widget( $attr ) {
	
	extract( shortcode_atts( array(
					'url'          => 'http://www.pinterest.com/pinterest/pin-pets/',
					'size'         => 'square',
					'image_width'  => '',
					'board_height' => '',
					'board_width'  => ''
				), $attr ) );
	
	$custom_sizes = array();
	
	if( $size == 'custom' ) {
		$custom_sizes = array(
			'width'       => $image_width,
			'height'      => $board_height,
			'board_width' => $board_width
		);
	}
	
	$before_html = '';
	$html        = '<div class="pw-wrap pw-shortcode">' . pw_widget_boards( $url, '', $size, $custom_sizes, 'embedBoard' ) . '</div>';
	$after_html  = '';
	
	$before_html = apply_filters( 'pw_board_widget_shortcode_before', $before_html );
	$html        = apply_filters( 'pw_board_widget_shortcode_html', $html );
	$after_html  = apply_filters( 'pw_board_widget_shortcode_after', $after_html );
	
	
	return $before_html . $html . $after_html;
}
add_shortcode( 'pin_board', 'pw_board_widget' );

/**
 * Process and return shortcode for Pinterest Profile Widget
 *
 * @since     1.0.0
 * @modified  1.0.1
 * 
 * @return    string
 */
function pw_profile_widget( $attr ) {
	
	extract( shortcode_atts( array(
					'username' => 'pinterest',
					'size'     => 'square',
					'image_width'  => '',
					'board_height' => '',
					'board_width'  => ''
				), $attr ) );
	
	$custom_sizes = array();
	
	if( $size == 'custom' ) {
		$custom_sizes = array(
			'width'       => $image_width,
			'height'      => $board_height,
			'board_width' => $board_width
		);
	}
	
	$before_html = '';
	$html        = '<div class="pw-wrap pw-shortcode">' . pw_widget_boards( $username, '', $size, $custom_sizes, 'embedUser' ) . '</div>';
	$after_html  = '';
	
	$before_html = apply_filters( 'pw_profile_shortcode_before', $before_html );
	$html        = apply_filters( 'pw_profile_shortcode_html', $html );
	$after_html  = apply_filters( 'pw_profile_shortcode_after', $after_html );
	
	return $before_html . $html . $after_html;
}
add_shortcode( 'pin_profile', 'pw_profile_widget' );