<?php
/**
 * Represents the view for the admin settings page
 *
 * @package    PW
 * @subpackage admin/views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="wrap">
	<div id="pw-settings">
		<div id="pw-settings-content">
			
			<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

			<p>
				<?php _e( 'Go to Appearance', 'pw' ); ?> &rarr; <a href="<?php echo admin_url( 'widgets.php' ); ?>">Widgets</a>
				<?php _e( 'to add Pinterest widgets to your sidebar and other widget areas.', 'pw' ); ?>
			</p>

			<form method="post" action="options.php">
				<?php
					// Show our settings before any help
					settings_fields( 'pw_settings_general' );
					do_settings_sections( 'pw_settings_general' );

					submit_button();
				?>
			</form>
			
			<h2><?php _e( 'Shortcode Help', 'pw' ); ?></h2>
			
			<!-- Follow Button Shortcode Help -->

			<h3 class="title"><?php _e( 'Follow Button', 'pw' ); ?></h3>

			<p>
				<?php _e( 'Use the shortcode', 'pw' ); ?> <code>[pin_follow]</code> <?php _e( 'to display the Pinterest Follow Button within your content.', 'pw' ); ?>
			</p>
			<p>
				<?php _e( 'Use the function', 'pw' ); ?> <code><?php echo htmlentities( '<?php echo do_shortcode(\'[pin_follow]\'); ?>' ); ?></code>
				<?php _e( 'to display within template or theme files.', 'pw' ); ?>
			</p>

			<h4><?php _e( 'Available Attributes', 'pw' ); ?></h4>

			<table class="widefat importers" cellspacing="0">
				<thead>
				<tr>
					<th><?php _e( 'Attribute', 'pw' ); ?></th>
					<th><?php _e( 'Description', 'pw' ); ?></th>
					<th><?php _e( 'Default', 'pw' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>username</td>
					<td><?php _e( 'Your Pinterest username', 'pw' ); ?></td>
					<td>pinterest</td>
				</tr>
				<tr>
					<td>label</td>
					<td><?php _e( 'The text for the button label', 'pw' ); ?></td>
					<td>Follow me on Pinterest</td>
				</tr>
				</tbody>
			</table>
			
			<h4><?php _e( 'Examples', 'pw' ); ?></h4>

			<ul class="ul-disc">
				<li><code>[pin_follow username="pinterest" label="Click to Follow Pinterest!"]</code></li>
			</ul>
			
			<!-- Pin Widget Shortcode Help -->

			<h3 class="title"><?php _e( 'Pin Widget', 'pw' ); ?></h3>

			<p>
				<?php _e( 'Use the shortcode', 'pw' ); ?> <code>[pin_widget]</code> <?php _e( 'to display the Pin Widget within your content.', 'pw' ); ?>
			</p>
			<p>
				<?php _e( 'Use the function', 'pw' ); ?> <code><?php echo htmlentities( '<?php echo do_shortcode(\'[pin_widget]\'); ?>' ); ?></code>
				<?php _e( 'to display within template or theme files.', 'pw' ); ?>
			</p>

			<h4><?php _e( 'Available Attributes', 'pw' ); ?></h4>

			<table class="widefat importers" cellspacing="0">
				<thead>
				<tr>
					<th><?php _e( 'Attribute', 'pw' ); ?></th>
					<th><?php _e( 'Description', 'pw' ); ?></th>
					<th><?php _e( 'Default', 'pw' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>url</td>
					<td><?php _e( 'The Pinterest pin URL you want to display', 'pw' ); ?></td>
					<td>http://www.pinterest.com/pin/99360735500167749/</td>
				</tr>
				</tbody>
			</table>
			
			<h4><?php _e( 'Examples', 'pw' ); ?></h4>

			<ul class="ul-disc">
				<li><code>[pin_widget url="http://www.pinterest.com/pin/99360735500167749/"]</code></li>
			</ul>
			
			<!-- Pin Board Widget Shortcode Help -->

			<h3 class="title"><?php _e( 'Board Widget', 'pw' ); ?></h3>

			<p>
				<?php _e( 'Use the shortcode', 'pw' ); ?> <code>[pin_board]</code> <?php _e( 'to display the Board Widget within your content.', 'pw' ); ?>
			</p>
			<p>
				<?php _e( 'Use the function', 'pw' ); ?> <code><?php echo htmlentities( '<?php echo do_shortcode(\'[pin_board]\'); ?>' ); ?></code>
				<?php _e( 'to display within template or theme files.', 'pw' ); ?>
			</p>

			<h4><?php _e( 'Available Attributes', 'pw' ); ?></h4>

			<table class="widefat importers" cellspacing="0">
				<thead>
				<tr>
					<th><?php _e( 'Attribute', 'pw' ); ?></th>
					<th><?php _e( 'Description', 'pw' ); ?></th>
					<th><?php _e( 'Choices', 'pw' ); ?></th>
					<th><?php _e( 'Default', 'pw' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>url</td>
					<td><?php _e( 'The Pinterest board URL you want to display', 'pw' ); ?></td>
					<td><?php _e( 'Any Pinterest board URL', 'pw' ); ?></td>
					<td>http://www.pinterest.com/pinterest/pin-pets/</td>
				</tr>
				<tr>
					<td>size</td>
					<td><?php _e( 'The size of the board', 'pw' ); ?></td>
					<td>square, sidebar, header, custom</td>
					<td>square</td>
				</tr>
				<tr>
					<td colspan="4">
						<strong><?php _e( 'The following options only take effect when size is set to custom, otherwise they will be ignored.', 'pw' ); ?></strong>
					</td>
				</tr>
				<tr>
					<td>image_width</td>
					<td><?php _e( 'The size of the images on the board', 'pw' ); ?></td>
					<td><?php _e( 'Any number greater than', 'pw' ); ?> 60</td>
					<td>92</td>
				</tr>
				<tr>
					<td>board_height</td>
					<td><?php _e( 'The height of the board', 'pw' ); ?></td>
					<td><?php _e( 'Any number greater than', 'pw' ); ?> 60</td>
					<td>175</td>
				</tr>
				<tr>
					<td>board_width</td>
					<td><?php _e( 'The width of the board', 'pw' ); ?></td>
					<td><?php _e( 'Any number greater than', 'pw' ); ?> 130</td>
					<td>auto</td>
				</tr>
				</tbody>
			</table>
			
			<h4><?php _e( 'Examples', 'pw' ); ?></h4>

			<ul class="ul-disc">
				<li><code>[pin_board url="http://www.pinterest.com/pinterest/pin-pets/"]</code></li>
				<li><code>[pin_board url="http://www.pinterest.com/pinterest/pin-pets/" size="header"]</code></li>
				<li><code>[pin_board url="http://www.pinterest.com/pinterest/pin-pets/" size="custom" image_width="100" board_width="900" board_height="450"]</code></li>
			</ul>
			
			<!-- Profile Widget Shortcode Help -->

			<h3 class="title"><?php _e( 'Profile Widget', 'pw' ); ?></h3>

			<p>
				<?php _e( 'Use the shortcode', 'pw' ); ?> <code>[pin_profile]</code> <?php _e( 'to display the Profile Widget within your content.', 'pw' ); ?>
			</p>
			<p>
				<?php _e( 'Use the function', 'pw' ); ?> <code><?php echo htmlentities( '<?php echo do_shortcode(\'[pin_profile]\'); ?>' ); ?></code>
				<?php _e( 'to display within template or theme files.', 'pw' ); ?>
			</p>

			<h4><?php _e( 'Available Attributes', 'pw' ); ?></h4>

			<table class="widefat importers" cellspacing="0">
				<thead>
				<tr>
					<th><?php _e( 'Attribute', 'pw' ); ?></th>
					<th><?php _e( 'Description', 'pw' ); ?></th>
					<th><?php _e( 'Choices', 'pw' ); ?></th>
					<th><?php _e( 'Default', 'pw' ); ?></th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>username</td>
					<td><?php _e( 'The Pinterest username', 'pw' ); ?></td>
					<td><?php _e( 'Any Pinterest username', 'pw' ); ?></td>
					<td>pinterest</td>
				</tr>
				<tr>
					<td>size</td>
					<td><?php _e( 'The size of the widget', 'pw' ); ?></td>
					<td>square, sidebar, header, custom</td>
					<td>square</td>
				</tr>
				<tr>
					<td colspan="4">
						<strong><?php _e( 'The following options only take effect when size is set to custom, otherwise they will be ignored.', 'pw' ); ?></strong>
					</td>
				</tr>
				<tr>
					<td>image_width</td>
					<td><?php _e( 'The size of the images on the widget', 'pw' ); ?></td>
					<td><?php _e( 'Any number greater than', 'pw' ); ?> 60</td>
					<td>92</td>
				</tr>
				<tr>
					<td>board_height</td>
					<td><?php _e( 'The height of the widget', 'pw' ); ?></td>
					<td><?php _e( 'Any number greater than', 'pw' ); ?> 60</td>
					<td>175</td>
				</tr>
				<tr>
					<td>board_width</td>
					<td><?php _e( 'The width of the widget', 'pw' ); ?></td>
					<td><?php _e( 'Any number greater than', 'pw' ); ?> 130</td>
					<td>auto</td>
				</tr>
				</tbody>
			</table>
			
			<h4><?php _e( 'Examples', 'pw' ); ?></h4>

			<ul class="ul-disc">
				<li><code>[pin_profile username="pinterest"]</code></li>
				<li><code>[pin_profile username="pinterest" size="sidebar"]</code></li>
				<li><code>[pin_profile username="pinterest" size="custom" image_width="125" board_width="1200" board_height="600"]</code></li>
			</ul>

		</div><!-- #pw-settings-content -->

		<div id="pw-settings-sidebar">
			<?php include( 'admin-sidebar.php' ); ?>
		</div>

	</div>
</div><!-- .wrap -->
