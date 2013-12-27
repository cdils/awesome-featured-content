<?php
/**
 * Admin Options Page
 *
 * @package     AFCW
 * @subpackage  Admin/Settings
 * @copyright   Copyright (c) 2013, FAT Media, LLC
 * @license     GPL-2.0+
 * @since       1.0.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Options Page
 *
 * Renders the options page contents.
 *
 * @since 1.0.0
 * @global $afcw_options Array of all the AFCW Options
 * @return void
 */
function afcw_options_page() {
	global $afcw_options;

	ob_start();
	?>
	<div class="wrap">
		<div class="icon32" id="icon-options-general"><br></div>
		<h2><?php _e( 'Awesome Featured Content Settings', 'afcw' ); ?></h2>

			<form method="post" action="options.php">
				<?php
				settings_fields( 'afcw_settings_general' );
				do_settings_sections( 'afcw_settings_general' );
				submit_button();
				?>
			</form>
		</div><!-- #tab_container-->
	</div><!-- .wrap -->
	<?php
	echo ob_get_clean();
}