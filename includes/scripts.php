<?php
/**
 * Font-End Scripts
 *
 * @package     AFPW
 * @subpackage  Functions
 * @copyright   Copyright (c) 2013, FAT Media, LLC
 * @license     GPL-2.0+
 * @since       1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', 'afpw_add_styles' );
/**
 * Registers and loads the Font Awesome
 * library and other required styles.
 *
 * @since 1.0.0
 * @global $wp_styles
 * @global $is_IE
 */
function afpw_add_styles() {
	global $wp_styles, $is_IE;
	$css_url = AFPW_PLUGIN_URL . 'assets/css/';

	// Enqueu styles
	wp_enqueue_style( 'afpw-font-awesome', $css_url . 'font-awesome.min.css', array(), '3.2.0' );
	wp_enqueue_style( 'afpw-styles', $css_url . 'awesome-styles.css', array(), '1.0.0' );

	if ( $is_IE ) {
		wp_enqueue_style( 'afpw-font-awesome-ie', $css_url . 'font-awesome-ie7.min.css', array(), '3.2.0' );
		$wp_styles->add_data( 'afpw-font-awesome-ie', 'conditional', 'lte IE 7' );
	}
}

/** Load CSS in <head> */
add_action( 'wp_head', 'afpw_not_so_awesome_css' );
/**
 * Custom CSS.
 *
 * Output custom CSS to control the look of the icons.
 */
function afpw_not_so_awesome_css() {

	global $afpw_options;

	$font_size = round( (int) $instance['size'] / 2 );
	$icon_padding = round ( (int) $font_size / 2 );

	/** The CSS to output */
	$css = '
	.awesome-feature .ico-bg a {
		background: ' . $instance['background_color'] . ' !important;
		-moz-border-radius: ' . $instance['border_radius'] . 'px
		-webkit-border-radius: ' . $instance['border_radius'] . 'px;
		border-radius: ' . $instance['border_radius'] . 'px;
		color: ' . $instance['icon_color'] . ' !important;
		font-size: ' . $font_size . 'px;
		padding: ' . $icon_padding . 'px;
	}

	.awesome-feature .ico-bg i {
		color: rgba(6, 6, 6, 0.14);
		display: block;
		font-size: 80px;
		padding: 25% 0;
		cursor: pointer;
		position: relative;
		text-align: center;
	}

	.awesome-feature .ico-bg a:hover {
		background-color: ' . $instance['background_color_hover'] . ' !important;
		color: ' . $instance['icon_color_hover'] . ' !important;
	}';

	/** Minify a bit */
	$css = str_replace( "\t", '', $css );
	$css = str_replace( array( "\n", "\r" ), ' ', $css );

	/** Echo the CSS */
	echo '<style type="text/css" media="screen">' . $css . '</style>';

}