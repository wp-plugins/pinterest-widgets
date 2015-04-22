<?php

/**
 * Represents the view for the Follow Button Widget
 *
 * @package    PW
 * @subpackage admin/includes
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PW_Follow_Button_Widget extends WP_Widget {
	
	/**
	 * Create the new Pinterest Follow Button Widget in the admin
	 *
	 * @since     1.0.0
	 *
	 */
	public function __construct() {
		parent::__construct(
			'pw_follow_button_widget',
			__( 'Pinterest Follow Button', 'pw' ),
			array(
				'description'	=>	__( 'Add a Pinterest Follow Button to any widget area.', 'pw' )
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
	 * Return public facing code for the Pinterest Follow Button Widget
	 *
	 * @since     1.0.0
	 * @modified  1.0.1
	 * 
	 * @return    string
	 */
	public function widget( $args, $instance ) {
		
		extract( $args );
		
		$title        = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		// If the user saved empty values then we will send the defaults to the function
		$pin_username = ( ! empty( $instance['pin_username'] ) ? $instance['pin_username'] : 'pinterest' );
		$button_label = ( ! empty( $instance['button_label'] ) ? $instance['button_label'] : 'Follow me on Pinterest' );
		
		echo $before_widget;
		
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
        }
		
		$html = '<div class="pw-wrap pw-widget pw-follow-button-widget">' . pw_pin_follow( $pin_username, $button_label ) . '</div>';
		
		do_action( 'pw_follow_button_before' );
		
		echo apply_filters( 'pw_follow_button_html', $html );
		
		do_action( 'pw_follow_button_after' );
		
		
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
		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['pin_username'] = strip_tags( $new_instance['pin_username'] );
		$instance['button_label'] = strip_tags( $new_instance['button_label'] );
        
		return $instance;
	}
	
	/**
	 * Widget form output for Pinterest Follow Button Widget
	 *
	 * @since     1.0.0
	 *
	 */
	public function form( $instance ) {
        // Widget form
		
		$default = array(
			'title'        => '',
			'pin_username' => '',
			'button_label' => ''
		);
        
		$instance = wp_parse_args( (array) $instance, $default );
		
		$title        = strip_tags( $instance['title'] );
		$pin_username = strip_tags( $instance['pin_username'] );
		$button_label = strip_tags( $instance['button_label'] );
		
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional):', 'pw' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'pin_username' ); ?>"><?php _e( 'Pinterest Username:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'pin_username' ); ?>" name="<?php echo $this->get_field_name( 'pin_username' ); ?>" type="text" value="<?php echo esc_attr( $pin_username ); ?>" placeholder="pinterest" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'button_label' ); ?>"><?php _e( 'Button Label:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'button_label' ); ?>" name="<?php echo $this->get_field_name( 'button_label' ); ?>" type="text" value="<?php echo esc_attr( $button_label ); ?>" placeholder="Follow me on Pinterest" />
		</p>
		
		<?php
	}
}

add_action( 'widgets_init', create_function( '', 'register_widget("PW_Follow_Button_Widget");' ) );

