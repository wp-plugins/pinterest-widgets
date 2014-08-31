<?php

/**
 * Show notice after plugin install/activate in admin dashboard until user acknowledges.
 *
 * @package    PW
 * @subpackage Views
 * @author     Phil Derksen <pderksen@gmail.com>, Nick Young <mycorpweb@gmail.com>
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<style>
	#pw-install-notice .button-primary,
	#pw-install-notice .button-secondary {
		margin-left: 15px;
	}
</style>

<div id="pw-install-notice" class="updated">
	<p>
		<?php echo $this->get_plugin_title() . __( ' is now installed.', 'pw' ); ?>
		<?php _e( 'Pinterest widgets are now active in Appearance', 'pw' ); ?> &rarr; <a href="<?php echo admin_url( 'widgets.php' ); ?>"><?php _e( 'Widgets', 'pw' ); ?></a>
	</p>
</div>
