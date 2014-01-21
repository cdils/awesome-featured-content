<?php
/**
 * Font-End Widgets
 *
 * @package     AFCW
 * @subpackage  Widgets
 * @copyright   Copyright (c) 2013, FAT Media, LLC
 * @license     GPL-2.0+
 * @since       1.0.0
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_action("widgets_init", "afcw_load_widgets");

/**
 * Register widgets for use in the Modern Portfolio theme.
 *
 * @since 1.0.0
 */
function afcw_load_widgets() {

	register_widget( 'Awesome_Featured_Widget' );

}
