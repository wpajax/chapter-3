<?php
/**
 * Sample WPAJAX Plugin
 *
 * @package   Sample_WPAjax_Plugin
 * @copyright Copyright(c) 2019, MediaRon LLC
 * @license http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 *
 * Plugin Name: Sample WPAjax Plugin
 * Plugin URI: https://wpandajax.com
 * Description: Sample Plugin.
 * Version: 1.0.0
 * Author: MediaRon LLC
 * Author URI: https://wpandajax.com
 * License: GPL2
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: sample-wpajax-plugin
 * Domain Path: languages
 */

define( 'SAMPLE_WPAJAX_VERSION', '1.0.0' );
define( 'SAMPLE_WPAJAX_PLUGIN_NAME', 'Sample WPAjax Plugin' );
define( 'SAMPLE_WPAJAX_DIR', plugin_dir_path( __FILE__ ) );
define( 'SAMPLE_WPAJAX_URL', plugins_url( '/', __FILE__ ) );
define( 'SAMPLE_WPAJAX_SLUG', plugin_basename( __FILE__ ) );
define( 'SAMPLE_WPAJAX_FILE', __FILE__ );

// Setup the plugin auto loader.
require_once 'php/autoloader.php';

/**
 * Admin notice if User Profile Picture isn't an adequate version.
 */
function sample_wpajax_version_error() {
	printf(
		'<div class="error"><p>%s</p></div>',
		esc_html__( 'Sample WPAjax requires a PHP version of 5.6 or above.', 'sample-wpajax-plugin' )
	);
}

// If the PHP version is too low, show warning and return.
if ( version_compare( phpversion(), '5.6', '<' ) ) {
	add_action( 'admin_notices', 'sample_wpajax_version_error' );
	return;
}

/**
 * Get the plugin object.
 *
 * @return \Sample_WPAjax\Plugin
 */
function sample_wpajax() {
	static $instance;

	if ( null === $instance ) {
		$instance = new \Sample_WPAjax_Plugin\Plugin();
	}

	return $instance;
}

/**
 * Setup the plugin instance.
 */
sample_wpajax()
	->set_basename( plugin_basename( __FILE__ ) )
	->set_directory( plugin_dir_path( __FILE__ ) )
	->set_file( __FILE__ )
	->set_slug( 'sample-wpajax-plugin' )
	->set_url( plugin_dir_url( __FILE__ ) )
	->set_version( __FILE__ );

/**
 * Sometimes we need to do some things after the plugin is loaded, so call the Plugin_Interface::plugin_loaded().
 */
add_action( 'plugins_loaded', array( sample_wpajax(), 'plugin_loaded' ), 20 );
add_action( 'init', 'sample_wpajax_add_i18n' );

/**
 * Add i18n to Sample Plugin.
 */
function sample_wpajax_add_i18n() {
	load_plugin_textdomain( 'sample-wpajax-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
