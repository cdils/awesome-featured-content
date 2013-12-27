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

add_action( 'wp_enqueue_scripts', 'afcw_add_styles' );
/**
 * Registers and loads the Font Awesome
 * library and other required styles.
 *
 * @since 1.0.0
 * @global $wp_styles
 * @global $is_IE
 */
function afcw_add_styles() {
	global $wp_styles, $is_IE;
	$css_url = AFCW_PLUGIN_URL . 'assets/css/';

	// Enqueu styles
	wp_enqueue_style( 'afcw-font-awesome', $css_url . 'font-awesome.min.css', array(), '3.2.0' );
	wp_enqueue_style( 'afcw-styles', $css_url . 'awesome-styles.css', array(), '1.0.0' );

	if ( $is_IE ) {
		wp_enqueue_style( 'afcw-font-awesome-ie', $css_url . 'font-awesome-ie7.min.css', array(), '3.2.0' );
		$wp_styles->add_data( 'afcw-font-awesome-ie', 'conditional', 'lte IE 7' );
	}
}

/** Load CSS in <head> */
add_action( 'wp_head', 'afcw_not_so_awesome_css' );
/**
 * Custom CSS.
 *
 * Output custom CSS to control the look of the icons.
 */
function afcw_not_so_awesome_css() {

	global $afcw_options;

	$font_size = round( (int) $afcw_options['font_size'] );
	$icon_padding = round ( (int) $font_size / 2 );

	/** The CSS to output */
	$css = '
	.awesome-feature .ico-bg a {
		background: ' . $afcw_options['icon_background'] . ';
		-moz-border-radius: ' . $afcw_options['border_radius'] . 'px
		-webkit-border-radius: ' . $afcw_options['border_radius'] . 'px;
		border-radius: ' . $afcw_options['border_radius'] . 'px;
		padding: ' . $icon_padding . 'px;
	}

	.awesome-feature .ico-bg i {
		color: ' . $afcw_options['icon_color'] . ';
		font-size: ' . $font_size  . 'px;
	}

	.awesome-feature .ico-bg a:hover {
		background-color: ' . $afcw_options['icon_background_hover'] . ';
	}';

	/** Minify a bit */
	$css = str_replace( "\t", '', $css );
	$css = str_replace( array( "\n", "\r" ), ' ', $css );

	/** Echo the CSS */
	echo '<style type="text/css" media="screen">' . $css . '</style>';

}