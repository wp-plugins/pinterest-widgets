<?php

/**
 * Sidebar portion of the administration dashboard view (and subpages).
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

<?php if ( ! pw_is_pib_pro_active() ): // If "Pin It" Button Pro is already active don't show. ?>

<!-- Use some built-in WP admin theme styles. -->

<div class="sidebar-container metabox-holder">
	<div class="postbox">
		<h3 class="wp-ui-primary"><span><?php _e( 'Need an awesome "Pin It" button?', 'pw' ); ?></span></h3>
		<div class="inside">
			<div class="main">
				<ul>
					<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Add "Pin It" buttons on image hover', 'pw' ); ?></li>
					<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Add "Pin It" buttons under images', 'pw' ); ?></li>
					<li><div class="dashicons dashicons-yes"></div> <?php _e( '30 custom "Pin It" button designs', 'pw' ); ?></li>
					<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Upload your own button designs', 'pw' ); ?></li>
					<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Twitter, Facebook & G+ buttons', 'pw' ); ?></li>
					<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Use with featured images', 'pw' ); ?></li>
					<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Use with custom post types', 'pw' ); ?></li>

					<li><div class="dashicons dashicons-yes"></div> <?php _e( 'Automatic updates & email support', 'pw' ); ?></li>
				</ul>

				<p class="last-blurb centered">
					<?php _e( 'Get all of these and more with Pinterest "Pin It" Button Pro!', 'pw' ); ?>
				</p>

				<div class="centered">
					<a href="<?php echo pw_ga_campaign_url( PINPLUGIN_BASE_URL . 'pin-it-button-pro/', 'pinterest_widgets', 'sidebar_link', 'pro_upgrade' ); ?>"
					   class="button-primary button-large" target="_blank">
						<?php _e( 'Get "Pin It" Pro Now', 'pw' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php endif; // End "Pin It" Button Pro check. ?>

<div class="sidebar-container metabox-holder">
	<div class="postbox">
		<div class="inside">
			<p>
				<?php _e( 'Now accepting 5-star reviews! It only takes seconds and means a lot.', 'pw' ); ?>
			</p>
			<div class="centered">
				<a href="http://wordpress.org/support/view/plugin-reviews/pinterest-widgets" class="button-primary" target="_blank">
					<?php _e( 'Rate this Plugin Now', 'pw' ); ?></a>
			</div>
		</div>
	</div>
</div>

<div class="sidebar-container metabox-holder">
	<div class="postbox">
		<div class="inside">
			<ul>
				<li>
					<div class="dashicons dashicons-arrow-right-alt2"></div>
					<a href="http://wordpress.org/support/plugin/pinterest-widgets" target="_blank">
						<?php _e( 'Community Support Forums', 'pw' ); ?></a>
				</li>
			</ul>
		</div>
	</div>
</div>

<div class="sidebar-container metabox-holder">
	<div class="postbox">
		<h3><?php _e( 'Recent News from pinplugins.com', 'pw' ); ?></h3>
		<div class="inside">
			<?php pw_rss_news(); ?>
		</div>
	</div>
</div>
