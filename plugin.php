<?php
/**
 * Plugin Name: Arconix Shortcode Collection
 * Plugin URI: http://arconixpc.com/plugins/arconix-shortcodes
 * Description: A handy collection of shortcodes for your site.
 *
 * Version: 1.0.4
 *
 * Author: John Gardner
 * Author URI: http://arconixpc.com
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 */

register_activation_hook( __FILE__, 'arconix_shortcodes_activation' );
/**
 * This function runs on plugin activation. It checks for the existence of the class
 * and starts its creation
 *
 * @since 1.0
 */
function arconix_shortcodes_activation() {

    if( ! class_exists( 'arconix_shortcodes' ) ) {
	arconix_shortcodes_init();
	global $_arconix_shortcodes;
    }
}

add_action( 'after_setup_theme', 'arconix_shortcodes_init' );
/**
 * Initializes the plugin
 * Includes the libraries, defines global variables, instantiates the class
 *
 * @since 1.0
 */
function arconix_shortcodes_init() {
    global $_arconix_shortcodes;

    define( 'ACS_URL', plugin_dir_url( __FILE__ ) );
    define( 'ACS_VERSION', '1.0.3' );

    /** Includes **/
    require_once( dirname( __FILE__ ) . '/includes/class-shortcodes.php' );

    /** Instantiate **/
    $_arconix_shortcodes = new Arconix_Shortcodes;

}
?>