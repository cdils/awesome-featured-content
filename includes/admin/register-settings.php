<?php
/**
 * Register Settings
 *
 * @package     AFCW
 * @subpackage  Admin/Settings
 * @copyright   Copyright (c) 2013, Robert Neu
 * @license     GPL-2.0+
 * @since       1.0.0
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Registers all off the required AFCW settings and provides hooks for extensions
 * to add their own settings to either the General, Gateways, Emails, Styles
 * or Misc Settings Pages
 *
 * @since 1.0.0
 * @return void
*/
function afcw_register_settings() {

	/**
	 * 'Whitelisted' AFCW settings, filters are provided for each settings
	 * section to allow extensions and other plugins to add their own settings
	 */
	$afcw_settings = array(
		/** General Settings */
		'general' => apply_filters('afcw_settings_general',
			array(
				'icon_background' => array(
					'id' => 'icon_background',
					'name' => __('Icon Background Color', 'afcw'),
					'desc' => '',
					'type' => 'colorpicker',
					'std'  => __('#cccccc', 'afcw')
				),
				'icon_background_hover' => array(
					'id' => 'icon_background_hover',
					'name' => __('Icon Background Hover Color', 'afcw'),
					'desc' => '',
					'type' => 'colorpicker',
					'std'  => __('#cccccc', 'afcw')
				),
				'icon_color' => array(
					'id' => 'icon_color',
					'name' => __('Icon Color', 'afcw'),
					'desc' => '',
					'type' => 'colorpicker',
					'std'  => __('#000000', 'afcw')
				),
				'font_size' => array(
					'id' => 'font_size',
					'name' => __('Font Size', 'afcw'),
					'desc' => '',
					'type' => 'text',
					'std'  => __('24', 'afcw')
				),
				'border_radius' => array(
					'id' => 'border_radius',
					'name' => __('Border Radius', 'afcw'),
					'desc' => '',
					'type' => 'text',
					'std'  => __('10', 'afcw')
				),
			)
		),
	);

	if ( false == get_option( 'afcw_settings_general' ) ) {
		add_option( 'afcw_settings_general' );
	}

	add_settings_section(
		'afcw_settings_general',
		__( 'General Settings', 'afcw' ),
		'__return_false',
		'afcw_settings_general'
	);

	foreach ( $afcw_settings['general'] as $option ) {
		add_settings_field(
			'afcw_settings_general[' . $option['id'] . ']',
			$option['name'],
			function_exists( 'afcw_' . $option['type'] . '_callback' ) ? 'afcw_' . $option['type'] . '_callback' : 'afcw_missing_callback',
			'afcw_settings_general',
			'afcw_settings_general',
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
	register_setting( 'afcw_settings_general',  'afcw_settings_general',  'afcw_settings_sanitize' );
}
add_action('admin_init', 'afcw_register_settings');

/**
 * Header Callback
 *
 * Renders the header.
 *
 * @since 1.0.0
 * @param array $args Arguments passed by the setting
 * @return void
 */
function afcw_header_callback( $args ) {
	echo '';
}

/**
 * Checkbox Callback
 *
 * Renders checkboxes.
 *
 * @since 1.0.0
 * @param array $args Arguments passed by the setting
 * @global $afcw_options Array of all the AFCW Options
 * @return void
 */
function afcw_checkbox_callback( $args ) {
	global $afcw_options;

	$checked = isset($afcw_options[$args['id']]) ? checked(1, $afcw_options[$args['id']], false) : '';
	$html = '<input type="checkbox" id="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']" name="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']" value="1" ' . $checked . '/>';
	$html .= '<label for="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;
}

/**
 * Multicheck Callback
 *
 * Renders multiple checkboxes.
 *
 * @since 1.0.0
 * @param array $args Arguments passed by the setting
 * @global $afcw_options Array of all the AFCW Options
 * @return void
 */
function afcw_multicheck_callback( $args ) {
	global $afcw_options;

	foreach( $args['options'] as $key => $option ):
		if( isset( $afcw_options[$args['id']][$key] ) ) { $enabled = $option; } else { $enabled = NULL; }
		echo '<input name="afcw_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']"" id="afcw_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']" type="checkbox" value="' . $option . '" ' . checked($option, $enabled, false) . '/>&nbsp;';
		echo '<label for="afcw_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']">' . $option . '</label><br/>';
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
 * @global $afcw_options Array of all the AFCW Options
 * @return void
 */
function afcw_radio_callback( $args ) {
	global $afcw_options;

	foreach ( $args['options'] as $key => $option ) :
		$checked = false;

		if ( isset( $afcw_options[ $args['id'] ] ) && $afcw_options[ $args['id'] ] == $key )
			$checked = true;

		echo '<input name="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']"" id="afcw_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']" type="radio" value="' . $key . '" ' . checked(true, $checked, false) . '/>&nbsp;';
		echo '<label for="afcw_settings_' . $args['section'] . '[' . $args['id'] . '][' . $key . ']">' . $option . '</label><br/>';
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
 * @global $afcw_options Array of all the AFCW Options
 * @return void
 */
function afcw_text_callback( $args ) {
	global $afcw_options;

	if ( isset( $afcw_options[ $args['id'] ] ) )
		$value = $afcw_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$size = isset( $args['size'] ) && !is_null($args['size']) ? $args['size'] : 'regular';
	$html = '<input type="text" class="' . $args['size'] . '-text" id="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']" name="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']" value="' . esc_attr( $value ) . '"/>';
	$html .= '<label for="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;
}

/**
 * Textarea Callback
 *
 * Renders textarea fields.
 *
 * @since 1.0.0
 * @param array $args Arguments passed by the setting
 * @global $afcw_options Array of all the AFCW Options
 * @return void
 */
function afcw_textarea_callback( $args ) {
	global $afcw_options;

	if ( isset( $afcw_options[ $args['id'] ] ) )
		$value = $afcw_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$size = isset( $args['size'] ) && !is_null($args['size']) ? $args['size'] : 'regular';
	$html = '<textarea class="large-text" cols="50" rows="5" id="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']" name="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']">' . esc_textarea( $value ) . '</textarea>';
	$html .= '<label for="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

	echo $html;
}


/**
 * Colorpicker Callback
 *
 * Renders text fields.
 *
 * @since 1.0.0
 * @param array $args Arguments passed by the setting
 * @global $afcw_options Array of all the AFCW Options
 * @return void
 */
function afcw_colorpicker_callback( $args ) {
	global $afcw_options;

	if ( isset( $afcw_options[ $args['id'] ] ) )
		$value = $afcw_options[ $args['id'] ];
	else
		$value = isset( $args['std'] ) ? $args['std'] : '';

	$size = isset( $args['size'] ) && !is_null($args['size']) ? $args['size'] : 'regular';
	$html = '<input type="text" class="' . $args['size'] . '-colorpicker wp-color-picker" id="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']" name="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']" value="' . esc_attr( $value ) . '"/>';
	$html .= '<label for="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

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
function afcw_missing_callback($args) {
	printf( __( 'The callback function used for the <strong>%s</strong> setting is missing.', 'afcw' ), $args['id'] );
}

/**
 * Select Callback
 *
 * Renders select fields.
 *
 * @since 1.0.0
 * @param array $args Arguments passed by the setting
 * @global $afcw_options Array of all the AFCW Options
 * @return void
 */
function afcw_select_callback($args) {
	global $afcw_options;

	$html = '<select id="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']" name="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']"/>';

	foreach ( $args['options'] as $option => $name ) :
		$selected = isset( $afcw_options[ $args['id'] ] ) ? selected( $option, $afcw_options[$args['id']], false ) : '';
		$html .= '<option value="' . $option . '" ' . $selected . '>' . $name . '</option>';
	endforeach;

	$html .= '</select>';
	$html .= '<label for="afcw_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

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
function afcw_hook_callback( $args ) {
	do_action( 'afcw_' . $args['id'] );
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
function afcw_settings_sanitize( $input ) {
	add_settings_error( 'afcw-notices', '', __('Settings Updated', 'afcw'), 'updated' );
	return $input;
}

/**
 * Get Settings
 *
 * Retrieves all plugin settings and returns them as a combined array.
 *
 * @since 1.0.0
 * @return array Merged array of all the AFCW settings
 */
function afcw_get_settings() {
	$general_settings = is_array( get_option( 'afcw_settings_general' ) )  ? get_option( 'afcw_settings_general' )  : array();

	return array_merge( $general_settings );
}

/**
 * Creates the settings page under the main WP settings
 * group and links to global variables
 *
 * @since 1.0.0
 * @global $afcw_settings_page
 * @return void
 */
function afcw_add_options_link() {
	global $afcw_settings_page;

	$afcw_settings_page = add_options_page( __( 'Awesome Featured Content Settings', 'afcw' ), __( 'Awesome Featured', 'afcw' ), 'manage_options', 'awesome-featured-content', 'afcw_options_page' );

}
add_action( 'admin_menu', 'afcw_add_options_link', 10 );

/**
 * Displays a link to the settings
 * page in the plugin action links
 *
 * @since 1.0.0
 * @global $afcw_settings_page
 * @return void
 */
function afcw_plugin_settings_link($links) {
  $settings_link = '<a href="options-general.php?page=awesome-featured-content">Settings</a>';
  array_unshift($links, $settings_link);
  return $links;
}

$plugin = plugin_basename(AFCW_PLUGIN_FILE);
add_filter("plugin_action_links_$plugin", 'afcw_plugin_settings_link' );