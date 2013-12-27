<?php
/**
 * Install Function
 *
 * @package     AFCW
 * @subpackage  Functions/Install
 * @copyright   Copyright (c) 2013, FAT Media, LLC
 * @license     GPL-2.0+
 * @since       1.0.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Install
 *
 * Runs on plugin install by setting up the post types, custom taxonomies,
 * flushing rewrite rules to initiate the new 'obituaries' slug and also
 * creates the plugin and populates the settings fields for those plugin
 * pages. After successfull install, the user is redirected to the AFCW Welcome
 * screen.
 *
 * @since 1.0.0
 * @global $wpdb
 * @global $afcw_options
 * @global $wp_version
 * @return void
 */
function afcw_install() {
	global $wpdb, $afcw_options, $wp_version;

	if ( (float) $wp_version < 3.5 ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die( __( 'Looks like you\'re running an older version of WordPress, you need to be running at least WordPress 3.3 to use Awesome Featured Content.', 'afcw' ), __( 'Awesome Featured Content is not compatible with this version of WordPress.', 'afcw' ), array( 'back_link' => true ) );
	}

	update_option( 'afcw_settings_general', $options );

}
register_activation_hook( AFCW_PLUGIN_FILE, 'afcw_install' );