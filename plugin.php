<?php
/**
 * Plugin Name: Arconix Shortcodes
 * Plugin URI: http://arconixpc.com/plugins/arconix-shortcodes
 * Description: A handy collection of shortcodes for your site.
 *
 * Version: 1.1.2
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
        $this->constants();
        $this->hooks();
        $this->includes();
    }

    /**
     * Define plugin constants
     *
     * @since 1.1.0
     */
    function constants() {
        define( 'ACS_VERSION', '1.1.2' );
        define( 'ACS_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
        define( 'ACS_INCLUDES_URL', trailingslashit( ACS_URL . 'includes' ) );
        define( 'ACS_CSS_URL', trailingslashit( ACS_INCLUDES_URL . 'css' ) );
        define( 'ACS_IMAGES_URL', trailingslashit( ACS_URL . 'images' ) );
        define( 'ACS_ADMIN_IMAGES_URL', trailingslashit( ACS_IMAGES_URL . 'admin' ) );
        define( 'ACS_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
        define( 'ACS_INCLUDES_DIR', trailingslashit( ACS_DIR . 'includes' ) );
    }

    /**
     * Load necessary functions
     *
     * @since 1.1.0
     */
    function hooks() {
        add_action( 'init', 'acs_register_shortcodes' );
        add_action( 'add_meta_boxes', 'acs_add_custom_meta_box' );
        add_action( 'wp_enqueue_scripts', 'acs_load_scripts' );
        add_action( 'wp_dashboard_setup', 'acs_register_shortcode_dash_widget' );
        add_action( 'admin_enqueue_scripts', 'acs_admin_css' );

        add_filter( 'widget_text', 'do_shortcode' );
    }

    /**
     * Load necessary plugin files
     *
     * @since 1.1.0
     */
    function includes() {
        require_once( ACS_INCLUDES_DIR . 'shortcodes.php' );
        require_once( ACS_INCLUDES_DIR . 'functions.php' );

        if( is_admin() )
            require_once( ACS_INCLUDES_DIR . 'admin.php' );
    }

}

new Arconix_Shortcodes;
?>