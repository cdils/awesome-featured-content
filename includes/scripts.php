<?php
/**
 * Font-End Scripts
 *
 * @package     AFCW
 * @subpackage  Functions
 * @copyright   Copyright (c) 2013, FAT Media, LLC
 * @license     GPL-2.0+
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'afcw_enqueue_styles' );
/**
 * Registers and loads the Font Awesome
 * library and other required styles.
 *
 * @since 1.0.0
 * @global $wp_styles
 */
function afcw_enqueue_styles() {
	$css_url = AFCW_PLUGIN_URL . 'assets/css/';

	// Enqueu styles
	wp_enqueue_style( 'afcw-font-awesome', $css_url . 'font-awesome.min.css', array(), '4.0.3' );
	wp_enqueue_style( 'afcw-styles', $css_url . 'awesome-styles.css', array(), AFCW_VERSION );

}
