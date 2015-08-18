<?php
/**
 * Admin Scripts
 *
 * @package     AFCW
 * @copyright   Copyright (c) 2013, FAT Media, LLC
 * @license     GPL-2.0+
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_enqueue_scripts', 'afcw_admin_enqueue_styles' );
/**
 * Load admin stylesheets
 *
 * @since 1.0.0
 * @global $afcw_settings_page
 */
function afcw_admin_enqueue_styles( $hook ) {
	$css_uri = AFCW_PLUGIN_URL . 'assets/css/';

	// Return early if we're not on widgets.php
	if ( 'widgets.php' != $hook ) {
		return;
	}

	wp_enqueue_style( 'afcw-select2-css', $css_uri . 'select2.css', array(), '3.4.0' );
	wp_enqueue_style( 'afcw-font-awesome', $css_uri . 'font-awesome.min.css', array(), '4.4.0' );
	wp_enqueue_style( 'afcw-admin', $css_uri . 'admin.css', array(), AFCW_VERSION );
}

add_action( 'admin_enqueue_scripts', 'afcw_admin_enqueue_scripts' );
/**
 * Load admin scripts
 *
 * @since 1.0.0
 * @global $afcw_settings_page
 */
function afcw_admin_enqueue_scripts( $hook ) {
	$js_uri = AFCW_PLUGIN_URL . 'assets/js/';

	// Return early if we're not on widgets.php
	if ( 'widgets.php' != $hook ) {
		return;
	}

	wp_enqueue_script( 'select2',  $js_uri . 'select2.min.js', array( 'jquery' ), '3.4.0', true );
	wp_enqueue_script( 'select2-init', $js_uri . 'init.select2.js', array( 'select2' ), '3.4.0', true );
}
