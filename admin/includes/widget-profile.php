<?php

/**
 * Represents the view for the Profile Widget widget
 *
 * @package    PW
 * @subpackage admin/includes
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PW_Profile_Widget extends WP_Widget {
	
	/**
	 * Create the new Pinterest Profile Widget in the admin
	 *
	 * @since     1.0.0
	 *
	 */
	public function __construct() {
		parent::__construct(
			'pw_profile_widget',
			__( 'Pinterest Profile Widget', 'pw' ),
			array(
				'description'	=>	__( 'Add a Pinterest Profile Widget to any widget area.', 'pw' )
			)
		);
	}
	
	/**
	 * Return public facing code for the Pinterest Profile Widget
	 *
	 * @since     1.0.0
	 * @modified  1.0.1
	 * 
	 * @return    string
	 */
	public function widget( $args, $instance ) {
		// public facing widget code
		extract( $args );
		
		$title               = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$pin_username        = ( ! empty( $instance['pin_username'] ) ? $instance['pin_username'] : 'pinterest' );
		$profile_widget_size = $instance['profile_widget_size'];
		$custom_sizes = array();
		
		if( $profile_widget_size == 'custom' ) {
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
		
		$html = '<div class="pw-wrap pw-widget pw-profile-widget">' . pw_widget_boards( $pin_username, '', $profile_widget_size, $custom_sizes, 'embedUser' ) . '</div>';
		
		do_action( 'pw_profile_widget_before' );
		
		echo apply_filters( 'pw_profile_widget_html', $html );
		
		do_action( 'pw_profile_widget_after' );
		
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
		$instance['title']               = strip_tags( $new_instance['title'] );
		$instance['pin_username']        = strip_tags( $new_instance['pin_username'] );
		$instance['profile_widget_size'] = $new_instance['profile_widget_size'];
		// Update custom size options
		$instance['custom_width']       = ( strip_tags( $new_instance['custom_width'] ) >= 60 ? $new_instance['custom_width'] : '' );
		$instance['custom_height']      = ( strip_tags( $new_instance['custom_height'] ) >= 60 ? $new_instance['custom_height'] : '' );
		$instance['custom_board_width'] = ( strip_tags( $new_instance['custom_board_width'] ) >= 130 ? $new_instance['custom_board_width'] : '' );
		
		
		return $instance;
	}
	
	/**
	 * Widget form output for Pinterest Profile Widget
	 *
	 * @since     1.0.0
	 *
	 */
	public function form( $instance ) {
        // Widget form
		$default = array(
			'title'               => '',
			'pin_username'        => '',
			'profile_widget_size' => 'sidebar',
			'custom_width'        => '',
			'custom_height'       => '',
			'custom_board_width'  => ''
		);
		
		$instance = wp_parse_args( (array) $instance, $default );
		
		$title               = strip_tags( $instance['title'] );
		$pin_username        = strip_tags( $instance['pin_username'] );
		$profile_widget_size = strip_tags( $instance['profile_widget_size'] );
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
			<label for="<?php echo $this->get_field_id( 'pin_username' ); ?>"><?php _e( 'Pinterest Username:', 'pw' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'pin_username' ); ?>" name="<?php echo $this->get_field_name( 'pin_username' ); ?>" type="text" value="<?php echo esc_attr( $pin_username ); ?>" placeholder="pinterest" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'profile_widget_size' ); ?>"><?php _e( 'Widget Size:', 'pw' ); ?></label><br />
			<select name="<?php echo $this->get_field_name( 'profile_widget_size' ); ?>" id="<?php echo $this->get_field_id( 'profile_widget_size' ); ?>">
				<option value="square" <?php selected( $instance['profile_widget_size'], 'square' ); ?>><?php _e( 'Square', 'pw' ); ?></option>
				<option value="sidebar" <?php selected( $instance['profile_widget_size'], 'sidebar' ); ?>><?php _e( 'Sidebar', 'pw' ); ?></option>
				<option value="header" <?php selected( $instance['profile_widget_size'], 'header' ); ?>><?php _e( 'Header', 'pw' ); ?></option>
				<option value="custom" <?php selected( $instance['profile_widget_size'], 'custom' ); ?>><?php _e( 'Custom', 'pw' ); ?></option>
			</select>
		</p>
		<p>
			<?php _e( 'The following values are used only with a \'Custom\' widget size', 'pw' ); ?>:
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
			<input class="widefat" id="<?php echo $this->get_field_id( 'custom_board_width' ); ?>" name="<?php echo $this->get_field_name( 'custom_board_width' ); ?>" type="number" value="<?php echo esc_attr( $custom_board_width ); ?>" placeholder="min:130 leave blank for auto" />
		</p>
		
		<?php
	}
}

add_action( 'widgets_init', create_function( '', 'register_widget("PW_Profile_Widget");' ) );


