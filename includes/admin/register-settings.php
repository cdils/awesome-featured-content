<?php
/**
 * Register Settings
 *
 * @package     WPFP
 * @subpackage  Admin/Settings
 * @copyright   Copyright (c) 2013, Robert Neu
 * @license     GPL-2.0+
 * @since       1.0.0
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Registers all off the required WPFP settings and provides hooks for extensions
 * to add their own settings to either the General, Gateways, Emails, Styles
 * or Misc Settings Pages
 *
 * @since 1.0.0
 * @return void
*/
function afpw_register_settings() {

	/**
	 * 'Whitelisted' WPFP settings, filters are provided for each settings
	 * section to allow extensions and other plugins to add their own settings
	 */
	$afpw_settings = array(
		/** General Settings */
		'general' => apply_filters('afpw_settings_general',
			array(
				'icon_background' => array(
					'id' => 'icon_background',
					'name' => __('Icon Background Color', 'afpw'),
					'desc' => '',
					'type' => 'colorpicker',
					'std'  => __('#cccccc', 'afpw')
				),
				'icon_color' => array(
					'id' => 'icon_color',
					'name' => __('Icon Background Color', 'afpw'),
					'desc' => '',
					'type' => 'colorpicker',
					'std'  => __('#000000', 'afpw')
				),
			)
		),
	);

	if ( false == get_option( 'afpw_settings_general' ) ) {
		add_option( 'afpw_settings_general' );
	}

	add_settings_section(
		'afpw_settings_general',
		__( 'General Settings', 'afpw' ),
		'__return_false',
		'afpw_settings_general'
	);

	foreach ( $afpw_settings['general'] as $option ) {
		add_settings_field(
			'afpw_settings_general[' . $option['id'] . ']',
			$option['name'],
			function_exists( 'afpw_' . $option['type'] . '_callback' ) ? 'afpw_' . $option['type'] . '_callback' : 'afpw_missing_callback',
			'afpw_settings_general',
			'afpw_settings_general',
			array(
				'id' => $option['id'],
				'desc' => $option['desc'],
				'name' => $option['name'],
				'section' => 'general',
				'size' => isset( $option['size'] ) ? $option['size'] : null,
				'options' => isset( $option['options'] ) ? $option['options'] : '',
				'std' => isset( $option['std'] ) ? $option['std'] : ''
			)
		);
	}

	// Creates our settings in the options table
	register_setting( 'afpw_settings_general',  'afpw_settings_general',  'afpw_settings_sanitize' );
}
add_action('admin_init', 'afpw_register_settings');

/**
 * Header Callback
 *
 * Renders the header.
 *
 * @since 1.0.0
 * @param array $args Arguments passed by the setting
 * @return void
 */
function afpw_header_callback( $args ) {
	echo '';
}

/**
 * Checkbox Callback
 *
 * Renders checkboxes.
 *
 * @since 1.0.0
 * @param array $args Arguments passed by the setting
 * @global $afpw_options Array of all the WPFP Options
 * @return void
 */
function afpw_checkbox_callback( $args ) {
	global $afpw_options;

	$checked = isset($afpw_options[$args['id']]) ? checked(1, $afpw_options[$args['id']], false) : '';
	$html = '<input type="checkbox" id="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']" name="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']" value="1" ' . $checked . '/>';
	$html .= '<label for="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;
}

/**
 * Multicheck Callback
 *
 * Renders multiple checkboxes.
 *
 * @since 1.0.0
 * @param array $args Arguments passed by the setting
 * @global $afpw_options Array of all the WPFP Options
 * @return void
 */
function afpw_multicheck_callback( $args ) {
	global $afpw_options;

	foreach( $args['options'] as $key => $option ):
		if( isset( $afpw_options[$args['id']][$key] ) ) { $enabled = $option; } else { $enabled = NULL; }
		echo '<input name="afpw_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']"" id="afpw_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']" type="checkbox" value="' . $option . '" ' . checked($option, $enabled, false) . '/>&nbsp;';
		echo '<label for="afpw_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']">' . $option . '</label><br/>';
	endforeach;
	echo '<p class="description">' . $args['desc'] . '</p>';
}

/**
 * Radio Callback
 *
 * Renders radio boxes.
 *
 * @since 1.3.3
 * @param array $args Arguments passed by the setting
 * @global $afpw_options Array of all the WPFP Options
 * @return void
 */
function afpw_radio_callback( $args ) {
	global $afpw_options;

	foreach ( $args['options'] as $key => $option ) :
		$checked = false;

		if ( isset( $afpw_options[ $args['id'] ] ) && $afpw_options[ $args['id'] ] == $key )
			$checked = true;

		echo '<input name="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']"" id="afpw_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']" type="radio" value="' . $key . '" ' . checked(true, $checked, false) . '/>&nbsp;';
		echo '<label for="afpw_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']">' . $option . '</label><br/>';
	endforeach;

	echo '<p class="description">' . $args['desc'] . '</p>';
}

/**
 * Text Callback
 *
 * Renders text fields.
 *
 * @since 1.0.0
 * @param array $args Arguments passed by the setting
 * @global $afpw_options Array of all the WPFP Options
 * @return void
 */
function afpw_text_callback( $args ) {
	global $afpw_options;

	if ( isset( $afpw_options[ $args['id'] ] ) )
		$value = $afpw_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$size = isset( $args['size'] ) && !is_null($args['size']) ? $args['size'] : 'regular';
	$html = '<input type="text" class="' . $args['size'] . '-text" id="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']" name="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']" value="' . esc_attr( $value ) . '"/>';
	$html .= '<label for="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;
}

/**
 * Textarea Callback
 *
 * Renders textarea fields.
 *
 * @since 1.0.0
 * @param array $args Arguments passed by the setting
 * @global $afpw_options Array of all the WPFP Options
 * @return void
 */
function afpw_textarea_callback( $args ) {
	global $afpw_options;

	if ( isset( $afpw_options[ $args['id'] ] ) )
		$value = $afpw_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$size = isset( $args['size'] ) && !is_null($args['size']) ? $args['size'] : 'regular';
	$html = '<textarea class="large-text" cols="50" rows="5" id="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']" name="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']">' . esc_textarea( $value ) . '</textarea>';
	$html .= '<label for="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;
}


/**
 * Colorpicker Callback
 *
 * Renders text fields.
 *
 * @since 1.0.0
 * @param array $args Arguments passed by the setting
 * @global $afpw_options Array of all the WPFP Options
 * @return void
 */
function afpw_colorpicker_callback( $args ) {
	global $afpw_options;

	if ( isset( $afpw_options[ $args['id'] ] ) )
		$value = $afpw_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$size = isset( $args['size'] ) && !is_null($args['size']) ? $args['size'] : 'regular';
	$html = '<input type="text" class="' . $args['size'] . '-colorpicker wp-color-picker" id="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']" name="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']" value="' . esc_attr( $value ) . '"/>';
	$html .= '<label for="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;
}

/**
 * Missing Callback
 *
 * If a function is missing for settings callbacks alert the user.
 *
 * @since 1.3.1
 * @param array $args Arguments passed by the setting
 * @return void
 */
function afpw_missing_callback($args) {
	printf( __( 'The callback function used for the <strong>%s</strong> setting is missing.', 'afpw' ), $args['id'] );
}

/**
 * Select Callback
 *
 * Renders select fields.
 *
 * @since 1.0.0
 * @param array $args Arguments passed by the setting
 * @global $afpw_options Array of all the WPFP Options
 * @return void
 */
function afpw_select_callback($args) {
	global $afpw_options;

	$html = '<select id="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']" name="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']"/>';

	foreach ( $args['options'] as $option => $name ) :
		$selected = isset( $afpw_options[ $args['id'] ] ) ? selected( $option, $afpw_options[$args['id']], false ) : '';
		$html .= '<option value="' . $option . '" ' . $selected . '>' . $name . '</option>';
	endforeach;

	$html .= '</select>';
	$html .= '<label for="afpw_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;
}

/**
 * Hook Callback
 *
 * Adds a do_action() hook in place of the field
 *
 * @since 1.0.0.8.2
 * @param array $args Arguments passed by the setting
 * @return void
 */
function afpw_hook_callback( $args ) {
	do_action( 'afpw_' . $args['id'] );
}

/**
 * Settings Sanitization
 *
 * Adds a settings error (for the updated message)
 * At some point this will validate input
 *
 * @since 1.0.0.8.2
 * @param array $input The value inputted in the field
 * @return string $input Sanitizied value
 */
function afpw_settings_sanitize( $input ) {
	add_settings_error( 'afpw-notices', '', __('Settings Updated', 'afpw'), 'updated' );
	return $input;
}

/**
 * Get Settings
 *
 * Retrieves all plugin settings and returns them as a combined array.
 *
 * @since 1.0.0
 * @return array Merged array of all the WPFP settings
 */
function afpw_get_settings() {
	$general_settings = is_array( get_option( 'afpw_settings_general' ) )  ? get_option( 'afpw_settings_general' )  : array();

	return array_merge( $general_settings );
}

/**
 * Creates the settings page under the main WP settings
 * group and links to global variables
 *
 * @since 1.0.0
 * @global $afpw_settings_page
 * @return void
 */
function afpw_add_options_link() {
	global $afpw_settings_page;

	$afpw_settings_page = add_options_page( __( 'Awesome Featured Page Settings', 'afpw' ), __( 'Awesome Featured', 'afpw' ), 'manage_options', 'awesome-featured-page', 'afpw_options_page' );

}
add_action( 'admin_menu', 'afpw_add_options_link', 10 );

/**
 * Displays a link to the settings
 * page in the plugin action links
 *
 * @since 1.0.0
 * @global $afpw_settings_page
 * @return void
 */
function afpw_plugin_settings_link($links) {
  $settings_link = '<a href="options-general.php?page=awesome-featured-page">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}

$plugin = plugin_basename(AFPW_PLUGIN_FILE);
add_filter("plugin_action_links_$plugin", 'afpw_plugin_settings_link' );