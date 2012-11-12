<?php
/**
 * Plugin Name: Arconix Shortcodes
 * Plugin URI: http://arconixpc.com/plugins/arconix-shortcodes
 * Description: A handy collection of shortcodes for your site.
 *
 * Version: 1.1.0-dev
 *
 * Author: John Gardner
 * Author URI: http://arconixpc.com
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 */

class Arconix_Shortcodes {
    
    /**
     * Construct Method
     * 
     * @since 1.0.0
     * @version 1.1.0
     */
    function __construct() {
        define( 'ACS_VERSION', '1.1.0' );
        define( 'ACS_URL', plugin_dir_url( __FILE__ ) );
        define( 'ACS_INCLUDES_URL', ACS_URL . 'includes' );
        define( 'ACS_IMAGES_URL', ACS_URL . 'images' );
        define( 'ACS_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
        define( 'ACS_INCLUDES_DIR', trailingslashit( ACS_DIR . 'includes' ) );
        
        $this->hooks();
    }
    
    /**
     * Load necessary functions
     * 
     * @since 1.1.0
     */
    function hooks() {

	add_action( 'init', 'register_shortcodes' );	
        add_action( 'init', 'register_javascript' );
        add_action( 'wp_enqueue_scripts', 'enqueue_css' );
        add_action( 'wp_dashboard_setup', 'register_dashboard_widget' );

	add_filter( 'widget_text', 'do_shortcode' );
        
        require_once( ACS_INCLUDES_DIR . 'shortcodes.php' );
        require_once( ACS_INCLUDES_DIR . 'functions.php' );
        
        if( is_admin() )
            require_once( ACS_INCLUDES_DIR . 'admin.php' );
    }
    
}

new Arconix_Shortcodes;
?>