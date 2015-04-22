<?php

/**
 * Represents the view for the Board Widget widget
 *
 * @package    PW
 * @subpackage admin/includes
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PW_Board_Widget extends WP_Widget {
	
	/**
	 * Create the new Pinterest Board Widget in the admin
	 *
	 * @since     1.0.0
	 * @modified  1.0.1
	 */
	public function __construct() {
		parent::__construct(
			'pw_board_widget',
			__( 'Pinterest Board Widget', 'pw' ),
			array(
				'description'	=>	__( 'Add a Pinterest Board Widget to any widget area.', 'pw' )
			)
		);
		
		if ( is_active_widget( false, false, $this->id_base ) ) {
			// Load JS
			add_action( 'wp_enqueue_scripts', array( $this, 'load_script' ) );
		}
	}
	
	function load_script() { 
		wp_enqueue_script( 'pinterest-pinit-js' );
	}
	
	/**
	 * Return public facing code for the Pinterest Board Widget
	 *
	 * @since     1.0.0
	 *
	 * @return    string
	 */
	public function widget( $args, $instance ) {
		
		extract( $args );
		
		$title      = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$board_url  = ( ! empty( $instance['board_url'] ) ? $instance['board_url'] : 'http://www.pinterest.com/pinterest/pin-pets/' );
		$board_size = $instance['board_size'];
		$custom_sizes = array();
		
		if( $board_size == 'custom' ) {
			$custom_sizes = array( 
				'width'       => ( ! empty( $instance['custom_width'] ) ? $instance['custom_width'] : '' ),
				'height'      => ( ! empty( $instance['custom_height'] ) ? $instance['custom_height'] : '' ),
				'board_width' => ( ! empty( $instance['custom_board_width'] ) ? $instance['custom_board_width'] : '' )
			);
		}
		
		echo $before_widget;
		
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
        }
		
		$html = '<div class="pw-wrap pw-widget pw-board-widget">' . pw_widget_boards( $board_url, '', $board_size, $custom_sizes, 'embedBoard' ) . '</div>';
		
		do_action( 'pw_board_widget_before' );
		
		echo apply_filters( 'pw_board_widget_html', $html );
		
		do_action( 'pw_board_widget_after' );
		
		echo $after_widget;
	}
	
	/**
	 * Save and return updated widget settings
	 *
	 * @since     1.0.0
	 *
	 * @return    array		new instance for the widget settings
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		// Update the form when saved
		$instance['title']      = strip_tags( $new_instance['title'] );
		$instance['board_url']  = strip_tags( $new_instance['board_url'] );
		$instance['board_size'] = $new_instance['board_size'];
		// Update custom size options
		$instance['custom_width']       = ( strip_tags( $new_instance['custom_width'] ) >= 60 ? $new_instance['custom_width'] : '' );
		$instance['custom_height']      = ( strip_tags( $new_instance['custom_height'] ) >= 60 ? $new_instance['custom_height'] : '' );
		$instance['custom_board_width'] = ( strip_tags( $new_instance['custom_board_width'] ) >= 130 ? $new_instance['custom_board_width'] : '' );
		
		
		return $instance;
	}
	
	/**
	 * Widget form output for Pinterest Board Widget
	 *
	 * @since     1.0.0
	 *
	 */
	public function form( $instance ) {
        // Widget form
		$default = array(
			'title'              => '',
			'board_url'          => '',
			'board_size'         => 'sidebar',
			'custom_width'       => '',
			'custom_height'      => '',
			'custom_board_width' => ''
		);
		
		$instance = wp_parse_args( (array) $instance, $default );
		
		$title      = strip_tags( $instance['title'] );
		$board_url  = strip_tags( $instance['board_url'] );
		$board_size = strip_tags( $instance['board_size'] );
		// custom sizes
		$custom_width       = strip_tags( $instance['custom_width'] );
		$custom_height      = strip_tags( $instance['custom_height'] );
		$custom_board_width = strip_tags( $instance['custom_board_width'] );
		
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional):', 'pw' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'board_url' ); ?>"><?php _e( 'Pinterest Board URL:', 'pw' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'board_url' ); ?>" name="<?php echo $this->get_field_name( 'board_url' ); ?>" type="text" value="<?php echo esc_attr( $board_url ); ?>" placeholder="http://www.pinterest.com/pinterest/pin-pets/" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'board_size' ); ?>"><?php _e( 'Board Size:', 'pw' ); ?></label><br />
			<select name="<?php echo $this->get_field_name( 'board_size' ); ?>" id="<?php echo $this->get_field_id( 'board_size' ); ?>">
				<option value="square" <?php selected( $instance['board_size'], 'square' ); ?>><?php _e( 'Square', 'pw' ); ?></option>
				<option value="sidebar" <?php selected( $instance['board_size'], 'sidebar' ); ?>><?php _e( 'Sidebar', 'pw' ); ?></option>
				<option value="header" <?php selected( $instance['board_size'], 'header' ); ?>><?php _e( 'Header', 'pw' ); ?></option>
				<option value="custom" <?php selected( $instance['board_size'], 'custom' ); ?>><?php _e( 'Custom', 'pw' ); ?></option>
			</select>
		</p>
		<p>
			<?php _e( 'The following values are used only with a \'Custom\' board size', 'pw' ); ?>:
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_width' ); ?>"><?php _e( 'Image Width:', 'pw' ); ?></label><br />
			<input class="widefat" id="<?php echo $this->get_field_id( 'custom_width' ); ?>" name="<?php echo $this->get_field_name( 'custom_width' ); ?>" type="number" value="<?php echo esc_attr( $custom_width ); ?>" placeholder="min:60; leave blank for 92" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_height' ); ?>"><?php _e( 'Board Height:', 'pw' ); ?></label><br />
			<input class="widefat" id="<?php echo $this->get_field_id( 'custom_height' ); ?>" name="<?php echo $this->get_field_name( 'custom_height' ); ?>" type="number" value="<?php echo esc_attr( $custom_height ); ?>" placeholder="min:60; leave blank for 175" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_board_width' ); ?>"><?php _e( 'Board Width:', 'pw' ); ?></label><br />
			<input class="widefat" id="<?php echo $this->get_field_id( 'custom_board_width' ); ?>" name="<?php echo $this->get_field_name( 'custom_board_width' ); ?>" type="number" value="<?php echo esc_attr( $custom_board_width ); ?>" placeholder="min:130; leave blank for auto" />
		</p>
		
		<?php
	}
}

add_action( 'widgets_init', create_function( '', 'register_widget("PW_Board_Widget");' ) );


