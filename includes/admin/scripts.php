<?php
/**
 * Admin Scripts
 *
 * @package     AFPW
 * @copyright   Copyright (c) 2013, FAT Media, LLC
 * @license     GPL-2.0+
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_enqueue_scripts', 'afpw_load_admin_styles' );
/**
 * Load admin stylesheets
 *
 * @since 1.0.0
 * @global $afpw_settings_page
 */
function afpw_load_admin_styles( $hook ) {
	global $afpw_settings_page;
	$screen = get_current_screen();
	$css_path = AFPW_PLUGIN_URL . 'assets/css/';

	// Only enqueue on widgets.php
	if ( 'widgets.php' == $hook ) {
		wp_enqueue_style( 'afpw-select2-css', $css_path . 'select2.css', array(), '3.4.0' );
		wp_enqueue_style( 'afpw-font-awesome', $css_path . 'font-awesome.min.css', array(), '3.2.0' );
		wp_enqueue_style( 'afpw-admin', $css_path . 'admin.css', array(), '3.4.0' );
	}

	// Only enqueue on settings page
	if ( $screen->id == $afpw_settings_page ) {
		wp_enqueue_style( 'wp-color-picker' );
	}
}

add_action( 'admin_enqueue_scripts', 'afpw_load_admin_scripts' );
/**
 * Load admin scripts
 *
 * @since 1.0.0
 * @global $afpw_settings_page
 */
function afpw_load_admin_scripts( $hook ) {
	global $afpw_settings_page;
	$screen = get_current_screen();
	$js_path = AFPW_PLUGIN_URL . 'assets/js/';

	// Only enqueue on widgets.php
	if ( 'widgets.php' == $hook ) {
		wp_enqueue_script( 'select2',  $js_path . 'select2.min.js', array( 'jquery' ), '3.4.0', true );
		wp_enqueue_script( 'select2-init', $js_path . 'init.select2.js', array( 'select2' ), '3.4.0', true );
	}

	// Only enqueue on settings page
	if ( $screen->id == $afpw_settings_page ) {
	    wp_enqueue_script( 'afwp-load-wp-color-picker', $js_path . 'colorpicker.js', array( 'wp-color-picker' ), false, true );
	}
}