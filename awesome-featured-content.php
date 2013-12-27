<?php
/**
 * Plugin Name: Awesome Featured Content
 * Plugin URI: http://wpbacon.com/awesome-featured-content/
 * Description: Display a Font Awesome icon with a link to a featured piece of content.
 * Author: FAT Media
 * Author URI: http://youneedfat.com/
 * Version: 1.0.1
 * Text Domain: afcw
 * Domain Path: languages
 *
 * Awesome Featured Content is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Awesome Featured Content is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Awesome Featured Content. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package AFCW
 * @category Core
 * @author FAT Media, LLC
 * @version 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Awesome_Featured_Content' ) ) :

class Awesome_Featured_Content {
	/** Singleton *************************************************************/

	/**
	 * @var Awesome_Featured_Content The one true Awesome_Featured_Content
	 * @since 1.4
	 */
	private static $instance;

	/**
	 * Main Awesome_Featured_Content Instance
	 *
	 * Insures that only one instance of Awesome_Featured_Content exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since 1.4
	 * @static
	 * @staticvar array $instance
	 * @uses Awesome_Featured_Content::setup_globals() Setup the globals needed
	 * @uses Awesome_Featured_Content::includes() Include the required files
	 * @uses Awesome_Featured_Content::setup_actions() Setup the hooks and actions
	 * @see AFCW()
	 * @return The one true Awesome_Featured_Content
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Awesome_Featured_Content ) ) {
			self::$instance = new Awesome_Featured_Content;
			self::$instance->setup_constants();
			self::$instance->includes();
			self::$instance->load_textdomain();
		}
		return self::$instance;
	}

	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 1.6
	 * @access protected
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'afcw' ), '1.6' );
	}

	/**
	 * Disable unserializing of the class
	 *
	 * @since 1.6
	 * @access protected
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'afcw' ), '1.6' );
	}

	/**
	 * Setup plugin constants
	 *
	 * @access private
	 * @since 1.4
	 * @return void
	 */
	private function setup_constants() {

		// Plugin version
		if ( ! defined( 'AFCW_VERSION' ) ) {
			define( 'AFCW_VERSION', '1.0.0' );
		}

		// Plugin Folder URL
		if ( ! defined( 'AFCW_PLUGIN_URL' ) ) {
			define( 'AFCW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Folder Path
		if ( ! defined( 'AFCW_PLUGIN_DIR' ) ) {
			define( 'AFCW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Root File
		if ( ! defined( 'AFCW_PLUGIN_FILE' ) ) {
			define( 'AFCW_PLUGIN_FILE', __FILE__ );
		}
	}

	/**
	 * Include required files
	 *
	 * @access private
	 * @since 1.4
	 * @return void
	 */
	private function includes() {

		global $afcw_options;

		require_once AFCW_PLUGIN_DIR . 'includes/admin/register-settings.php';
		$afcw_options = afcw_get_settings();

		/** Require Plugin Files*/
		require_once AFCW_PLUGIN_DIR . 'includes/install.php';
		require_once AFCW_PLUGIN_DIR . 'includes/scripts.php';
		require_once AFCW_PLUGIN_DIR . 'includes/widgets.php';
		if( is_admin() ) {
			require_once AFCW_PLUGIN_DIR . 'includes/admin/scripts.php';
			require_once AFCW_PLUGIN_DIR . 'includes/admin/display-settings.php';
		}

	}

	/**
	 * Loads the plugin language files
	 *
	 * @access public
	 * @since 1.4
	 * @return void
	 */
	public function load_textdomain() {
		// Set filter for plugin's languages directory
		$afcw_lang_dir = dirname( plugin_basename( AFCW_PLUGIN_FILE ) ) . '/languages/';
		$afcw_lang_dir = apply_filters( 'afcw_languages_directory', $afcw_lang_dir );

		// Traditional WordPress plugin locale filter
		$locale        = apply_filters( 'plugin_locale',  get_locale(), 'afcw' );
		$mofile        = sprintf( '%1$s-%2$s.mo', 'afcw', $locale );

		// Setup paths to current locale file
		$mofile_local  = $afcw_lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/awesome-featured-content/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/afcw folder
			load_textdomain( 'afcw', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/easy-digital-obituaries/languages/ folder
			load_textdomain( 'afcw', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'afcw', false, $afcw_lang_dir );
		}
	}
}

endif; // End if class_exists check

/**
 * The main function responsible for returning the one true Awesome_Featured_Content
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $afcw = AFCW(); ?>
 *
 * @since 1.4
 * @return object The one true Awesome_Featured_Content Instance
 */
function AFCW() {
	return Awesome_Featured_Content::instance();
}

// Get AFCW Running
AFCW();