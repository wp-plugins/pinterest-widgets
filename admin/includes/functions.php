<?php

/**
 * Define plugin reusable functions.
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
 * Return the HTML output for the Pinterest Pin Widget
 *
 * @since     1.0.0
 *
 * @return    string
 */
function pw_pin_link( $url, $label, $action ) {
	
	$pin_link = '<a data-pin-do="' . $action . '" href="' . esc_attr( $url ) . '">' . $label . '</a>';
	
	return $pin_link;
}

/**
 * Return the HTML output for the Pinterest Follow Button
 *
 * @since     1.0.0
 *
 * @return    string
 */
function pw_pin_follow( $username, $label ) {
	
	$pin_follow = '<a data-pin-do="buttonFollow" href="http://www.pinterest.com/' . esc_attr( $username ) . '/">' . $label . '</a>';
	
	return $pin_follow;
}

/**
 * Return the HTML output for the Pinterest Profile Widget or Pinterest Board Widget
 *
 * @since     1.0.0
 *
 * @return    string
 */
function pw_widget_boards( $url, $label, $size, $custom_sizes, $action ) {
	
	// Default size options based on option "Square" from Pinterest
	$scale_width  = 80;
	$scale_height = 320;
	$board_width  = 400;
	
	// Change sizes if sidebar option is selected
	if( $size == 'sidebar' ) {
		$scale_width  = 60;
		$scale_height = 800;
		$board_width  = 150;
	}
	
	// Change sizes if header option is selected
	if( $size == 'header' ) {
		$scale_width  = 115;
		$scale_height = 120;
		$board_width  = 900;
	}
	
	// Custom sizes
	if( $size == 'custom' ) {
		// We need to check each item to make sure it is above the minimum value required by Pinterest and if not set to blank so it doesn't get output
		$scale_width  = ( $custom_sizes['width'] >= 60 ? $custom_sizes['width'] : '' );
		$scale_height = ( $custom_sizes['height'] >= 60 ? $custom_sizes['height'] : '' );
		$board_width  = ( $custom_sizes['board_width'] >= 130 ? $custom_sizes['board_width'] : '' );
	}
	
	if( $action == 'embedUser' ) {
		$url = "http://www.pinterest.com/" . $url;
	}
	
	$widget  = '<a data-pin-do="' . $action . '"';
	$widget .= 'href="' . esc_attr( $url ) . '"';
	$widget .= ( ! empty( $scale_width ) ? 'data-pin-scale-width="' . $scale_width . '"' : '' );
	$widget .= ( ! empty( $scale_height ) ? 'data-pin-scale-height="' . $scale_height . '"' : '' );
	// if the board_width is empty then it has been set to 'auto' so we need to leave the data-pin-board-width attribute completely out
	$widget .= ( ! empty( $board_width ) ? 'data-pin-board-width="' . $board_width . '"' : '' );
	$widget .= '>' . $label . '</a>';
	
	return $widget;
}

/**
 * Google Analytics campaign URL.
 *
 * @since     1.0.3
 *
 * @param   string  $base_url Plain URL to navigate to
 * @param   string  $source   GA "source" tracking value
 * @param   string  $medium   GA "medium" tracking value
 * @param   string  $campaign GA "campaign" tracking value
 * @return  string  $url     Full Google Analytics campaign URL
 */
function pw_ga_campaign_url( $base_url, $source, $medium, $campaign ) {
	// $medium examples: 'sidebar_link', 'banner_image'

	$url = esc_url( add_query_arg( array(
		'utm_source'   => $source,
		'utm_medium'   => $medium,
		'utm_campaign' => $campaign
	), $base_url ) );

	return $url;
}

/**
 * Render RSS items from pinplugins.com in unordered list.
 * http://codex.wordpress.org/Function_Reference/fetch_feed
 * Based on pib_rss_news() in Pin it button plugin.
 *
 * @since   1.0.0
 */

function pw_rss_news() {
	// Get RSS Feed(s).
	include_once( ABSPATH . WPINC . '/feed.php' );

	// Get a SimplePie feed object from the specified feed source.
	$rss = fetch_feed( PINPLUGIN_BASE_URL . 'feed/' );

	if ( ! is_wp_error( $rss ) ) {
		// Checks that the object is created correctly.
		// Figure out how many total items there are, but limit it to 5.
		$maxitems = $rss->get_item_quantity( 3 );

		// Build an array of all the items, starting with element 0 (first element).
		$rss_items = $rss->get_items( 0, $maxitems );
	}
	?>

	<ul>
		<?php if ($maxitems == 0): ?>
			<li><?php _e( 'No items.', 'pw' ); ?></li>
		<?php else: ?>
			<?php
			// Loop through each feed item and display each item as a hyperlink.
			foreach ( $rss_items as $item ): ?>
				<?php $post_url = esc_url( add_query_arg( array(

					// Google Analytics campaign URL
					'utm_source'   => 'pinterest_widgets',
					'utm_medium'   => 'sidebar_link',
					'utm_campaign' => 'blog_post_link'

				), $item->get_permalink() ) ); ?>

				<li>
					&raquo; <a href="<?php echo $post_url; ?>" target="_blank"><?php echo esc_html( $item->get_title() ); ?></a>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
	</ul>

<?php
}

/**
 * Check if the "Pin It" Button Pro plugin is active.
 *
 * @since   1.0.1
 *
 * @return  boolean
 */
function pw_is_pib_pro_active() {
	return class_exists( 'Pinterest_Pin_It_Button_Pro' );
}
