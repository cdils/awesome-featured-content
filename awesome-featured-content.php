<?php
/**
 * Plugin Name: Awesome Featured Page
 * Plugin URI: http://wpbacon.com/awesome-featured-page/
 * Description: Display a Font Awesome icon with a link to a featured page.
 * Author: FAT Media
 * Author URI: http://youneedfat.com/
 * Version: 1.0.0
 * Text Domain: afpw
 * Domain Path: languages
 *
 * Awesome Featured Page is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Awesome Featured Page is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Awesome Featured Page. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package AFPW
 * @category Core
 * @author FAT Media, LLC
 * @version 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Awesome_Featured_Page' ) ) :

class Awesome_Featured_Page {
	/** Singleton *************************************************************/

	/**
	 * @var Awesome_Featured_Page The one true Awesome_Featured_Page
	 * @since 1.4
	 */
	private static $instance;

	/**
	 * Main Awesome_Featured_Page Instance
	 *
	 * Insures that only one instance of Awesome_Featured_Page exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since 1.4
	 * @static
	 * @staticvar array $instance
	 * @uses Awesome_Featured_Page::setup_globals() Setup the globals needed
	 * @uses Awesome_Featured_Page::includes() Include the required files
	 * @uses Awesome_Featured_Page::setup_actions() Setup the hooks and actions
	 * @see AFPW()
	 * @return The one true Awesome_Featured_Page
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Awesome_Featured_Page ) ) {
			self::$instance = new Awesome_Featured_Page;
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
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'afpw' ), '1.6' );
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
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'afpw' ), '1.6' );
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
		if ( ! defined( 'AFPW_VERSION' ) ) {
			define( 'AFPW_VERSION', '1.0.0' );
		}

		// Plugin Folder URL
		if ( ! defined( 'AFPW_PLUGIN_URL' ) ) {
			define( 'AFPW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Folder Path
		if ( ! defined( 'AFPW_PLUGIN_DIR' ) ) {
			define( 'AFPW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Root File
		if ( ! defined( 'AFPW_PLUGIN_FILE' ) ) {
			define( 'AFPW_PLUGIN_FILE', __FILE__ );
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

		global $afpw_options;

		require_once AFPW_PLUGIN_DIR . 'includes/admin/register-settings.php';
		$afpw_options = afpw_get_settings();

		/** Require Plugin Files*/
		require_once AFPW_PLUGIN_DIR . 'includes/install.php';
		require_once AFPW_PLUGIN_DIR . 'includes/scripts.php';
		require_once AFPW_PLUGIN_DIR . 'includes/widgets.php';
		if( is_admin() ) {
			require_once AFPW_PLUGIN_DIR . 'includes/admin/scripts.php';
			require_once AFPW_PLUGIN_DIR . 'includes/admin/display-settings.php';
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
		$afpw_lang_dir = dirname( plugin_basename( AFPW_PLUGIN_FILE ) ) . '/languages/';
		$afpw_lang_dir = apply_filters( 'afpw_languages_directory', $afpw_lang_dir );

		// Traditional WordPress plugin locale filter
		$locale        = apply_filters( 'plugin_locale',  get_locale(), 'afpw' );
		$mofile        = sprintf( '%1$s-%2$s.mo', 'afpw', $locale );

		// Setup paths to current locale file
		$mofile_local  = $afpw_lang_dir . $mofile;
		$mofile_global = WP_LANG_DIR . '/awesome-featured-page/' . $mofile;

		if ( file_exists( $mofile_global ) ) {
			// Look in global /wp-content/languages/afpw folder
			load_textdomain( 'afpw', $mofile_global );
		} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/easy-digital-obituaries/languages/ folder
			load_textdomain( 'afpw', $mofile_local );
		} else {
			// Load the default language files
			load_plugin_textdomain( 'afpw', false, $afpw_lang_dir );
		}
	}
}

endif; // End if class_exists check

/**
 * The main function responsible for returning the one true Awesome_Featured_Page
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $afpw = AFPW(); ?>
 *
 * @since 1.4
 * @return object The one true Awesome_Featured_Page Instance
 */
function AFPW() {
	return Awesome_Featured_Page::instance();
}

// Get AFPW Running
AFPW();