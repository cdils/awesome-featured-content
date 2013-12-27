<?php
/**
 * Font-End Widgets
 *
 * @package     AFPW
 * @subpackage  Widgets
 * @copyright   Copyright (c) 2013, FAT Media, LLC
 * @license     GPL-2.0+
 * @since       1.0.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/** Include widget class files */
require_once( AFPW_PLUGIN_DIR . '/includes/awesome-featured-page-widget.php' );

add_action("widgets_init", "afpw_load_widgets");

/**
 * Register widgets for use in the Modern Portfolio theme.
 *
 * @since 1.0.0
 */
function afpw_load_widgets() {

	register_widget( 'Awesome_Featured_Widget' );

}