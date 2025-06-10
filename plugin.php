<?php
/**
 * Plugin Name: Arconix Shortcodes
 * Plugin URI: https://www.tychesoftwares.com/
 * Description: A handy collection of shortcodes for your site.
 *
 * Version: 2.1.18
 *
 * Author: Tyche Softwares
 * Author URI: https://www.tychesoftwares.com/
 * 
 * Text Domain: acs
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 */

require_once( plugin_dir_path(__FILE__) . 'includes/shortcodes.php' );


class Arconix_Shortcodes {
	
	/**
     * Stores the current version of the plugin.
     *
     * @since   2.0.4
     * @access  private
     * @var string $version Current plugin version.
     */
    const VERSION = '2.1.18';

    /**
     * The url path to this plugin.
     *
     * @since   1.0.0
     * @access  private
     * @var     string      $url            The url path to this plugin
     */
    protected $url;

    /**
     * Construct Method
     *
     * @since   1.0.0
     * @version 1.2.0
     */
    public function __construct() {
        $this->url = trailingslashit( plugin_dir_url( __FILE__ ) );
		
        $this->constants();

        add_action( 'init',                     'acs_register_shortcodes' );
        add_action( 'add_meta_boxes',           array( $this, 'metabox' ) );
        add_action( 'wp_enqueue_scripts',       array( $this, 'scripts' ) );
        add_action( 'admin_enqueue_scripts',    array( $this, 'admin_css' ) );
        /**
         * We have commented this, because we will create a feed from our site and then we can enable this widget.
         */
        //add_action( 'wp_dashboard_setup',       array( $this, 'dashboard_widget' ) );

        add_filter( 'widget_text',              'do_shortcode' );

        $is_admin = is_admin();

        if ( true === $is_admin ) {
            add_action( 'init',                         array ($this , 'shortcodes_load_files') );
            add_filter( 'ts_deativate_plugin_questions', array( $this, 'shortcodes_deactivate_add_questions' ), 10, 1 );
            add_filter( 'ts_tracker_data',               array( $this, 'shortcodes_ts_add_plugin_tracking_data' ), 10, 1 );
            add_filter( 'ts_tracker_opt_out_data',       array( $this, 'shortcodes_get_data_for_opt_out' ), 10, 1 );
            add_action( 'admin_init',                    array( $this, 'shortcodes_admin_actions' ) );
        }
    }

    function shortcodes_load_files () {
        require_once( plugin_dir_path(__FILE__) . 'includes/arconix-shortcodes-all-component.php' );
    }

    /**
     * Define plugin constants
     *
     * @since   1.1.0
     */
    function constants() {
        define( 'ACS_VERSION',                  self::VERSION ); // kept for backwards compatibility in case anyone else is checking or using it
		
        /*
	define( 'ACS_URL',                  trailingslashit( plugin_dir_url( __FILE__ ) ) );
        define( 'ACS_INCLUDES_URL',         trailingslashit( ACS_URL . 'includes' ) );
        define( 'ACS_CSS_URL',              trailingslashit( ACS_INCLUDES_URL . 'css' ) );
        define( 'ACS_IMAGES_URL',           trailingslashit( ACS_URL . 'images' ) );
        define( 'ACS_ADMIN_IMAGES_URL',     trailingslashit( ACS_IMAGES_URL . 'admin' ) );
        define( 'ACS_DIR',                  trailingslashit( plugin_dir_path( __FILE__ ) ) );
        define( 'ACS_INCLUDES_DIR',         trailingslashit( ACS_DIR . 'includes' ) );
	*/
    }

    /**
     * Register the necessary Javascript and CSS, which can be overridden in 3 different ways.
     * If you'd like to use a different version of the jQuery Tools script {@link http://jquerytools.org/download/}
     * you can add a filter that overrides the the url, version and dependency.
     *
     * If you would like to bundle the Javacsript or CSS funtionality into another file and prevent either of the plugin files
     * from loading at all, return false to the desired pre_register filters
     *
     * @example add_filter( 'pre_register_arconix_shortcodes_js', '__return_false' );
     *
     * If you'd like to modify the Javascript or CSS that is used by the shortcodes, you can copy the arconix-shortcodes.js
     * or arconix-shortcodes.css files to the root of your theme's folder. That will be loaded in place of the plugin's
     * version, which means you can modify it to your heart's content and know the file will be safe when the plugin
     * is updated in the future.
     *
     * @link Codex reference: apply_filters()
     * @link Codex reference: wp_register_script()
     * @link Codex reference: get_stylesheet_directory()
     * @link Codex reference: get_stylesheet_directory_uri()
     * @link Codex reference: get_template_directory()
     * @link Codex reference: get_template_directory_uri()
     * @link Codex reference: wp_enqueue_style()
     *
     * @since   0.9
     * @version 2.0.2
     */
    function scripts() {
        // Provide script registration args so they can be filtered if necessary
        $jqt_args = apply_filters( 'arconix_jquerytools_reg', array(
            'url' => $this->url . "includes/jquery.tools.min.js",
            'ver' => '1.2.7',
            'dep' => 'jquery'
        ) );

        wp_register_script( 'jquery-tools', esc_url( $jqt_args['url'] ), array( $jqt_args['dep'] ), $jqt_args['ver'], true );
		
		
        // Set the FontAwesome CSS version to load. Can be overridden via filter
        $fa_version = apply_filters( 'arconix_fontawesome_version', '4.6.3' );

        /*
        * Allow users to override the FontAwesome CSS registration params. This is not
        * the recommended way of changing the version of the CSS to be loaded. To do
        * that, filter $fa_version above
        */
        $fa_args = apply_filters( 'arconix_fontawesome_css', array(
            'url' => $this->url . "includes/css/font-awesome.min.css",
            'ver' => '4.6.3',
        ));

        wp_enqueue_style( 'font-awesome', $fa_args['url'], false, $fa_args['ver'] );

        // Use the .min files if SCRIPT_DEBUG is turned off.
        $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

        // Register the javascript - Check the child theme directory first, the parent theme second, otherwise load the plugin version
        if( apply_filters( 'pre_register_arconix_shortcodes_js', true ) ) {
            if( file_exists( get_stylesheet_directory() . '/arconix-shortcodes.js' ) )
                wp_register_script( 'arconix-shortcodes-js', get_stylesheet_directory_uri() . '/arconix-shortcodes.js', array( 'jquery-tools' ), self::VERSION, true );
            elseif( file_exists( get_template_directory() . '/arconix-shortcodes.js' ) )
                wp_register_script( 'arconix-shortcodes-js', get_template_directory_uri() . '/arconix-shortcodes.js', array( 'jquery-tools' ), self::VERSION, true );
            else
                wp_register_script( 'arconix-shortcodes-js', $this->url . "includes/arconix-shortcodes{$suffix}.js", array( 'jquery-tools' ), self::VERSION, true );
        }

        // Load the CSS - Check the child theme directory first, the parent theme second, otherwise load the plugin version
        if( apply_filters( 'pre_register_arconix_shortcodes_css', true ) ) {
            if( file_exists( get_stylesheet_directory() . '/arconix-shortcodes.css' ) )
                wp_enqueue_style( 'arconix-shortcodes', get_stylesheet_directory_uri() . '/arconix-shortcodes.css', false, self::VERSION );
            elseif( file_exists( get_template_directory() . '/arconix-shortcodes.css' ) )
                wp_enqueue_style( 'arconix-shortcodes', get_template_directory_uri() . '/arconix-shortcodes.css', false, self::VERSION );
            else
                wp_enqueue_style( 'arconix-shortcodes', $this->url . "includes/css/arconix-shortcodes{$suffix}.css", false, self::VERSION );
        }

    }

    /**
     * Adds a meta box to the sidebar column on the Post and Page edit screens.
     *
     * The list of available post_types is filterable for themes and plugins
     *
     * @link Codex reference: apply_filters()
     * @link Codex reference: add_meta_box()
     *
     * @since   1.1.0
     */
    function metabox() {
        // Allow a theme or plugin to filter the list of post types this meta box is added to
        $post_types = apply_filters( 'arconix_shortcodes_meta_box_post_types', array( 'post', 'page' ) );

        foreach( (array) $post_types as $post_type ) {
            add_meta_box( 'ac-shortcode-list', __( 'Arconix Shortcode List', 'acs' ), array( $this, 'shortcodes_box' ), $post_type, 'side' );
        }
    }

    /**
     * Callback to display the meta box content
     *
     * @uses get_arconix_shortcode_list()   Defined in /includes/shortcodes.php
     *
     * @see ACS_ADMIN_IMAGES_URL    Defined in this file
     *
     * @since   1.1.0
     */
    function shortcodes_box() {
        $shortcodes = get_arconix_shortcode_list();

        if( ! $shortcodes or ! is_array( $shortcodes ) )
            return;

        $return = '<p><a href="https://www.tychesoftwares.com/docs/docs/shortcodes/shortcode-reference/"><img src="' . $this->url . 'images/admin/page-16x16.png">Documentation</a></p><ul>';
        foreach( (array) $shortcodes as $shortcode ) {
            $return .= '<li>[' . $shortcode . ']</li>';
        }
        $return .= '</ul>';

        echo $return;
    }

    /**
     * Adds a news widget to the dashboard.
     *
     * If the filter is returned false or the logged in user isn't an Admin user, it will prevent the dashboard widget
     * from loading. It's a little cleaner than other solutions available.
     *
     * @example add_filter( 'pre_register_arconix_shortcodes_dashboard_widget', '__return_false' );
     *
     * @link Codex reference: wp_add_dashboard_widget()
     * @link Codex reference: current_user_can()
     *
     * @since   1.0
     * @version 1.2.0
     */
    function dashboard_widget() {
        if( apply_filters( 'pre_register_arconix_shortcodes_dashboard_widget', true ) and
            apply_filters( 'arconix_shortcodes_dashboard_widget_security', current_user_can( 'manage_options' ) ) )
                wp_add_dashboard_widget( 'ac-shortcodes', 'Arconix Shortcodes', array( $this, 'acs_dash_widget' ) );
    }

    /**
     * Output for the dashboard widget
     *
     * @link Codex reference: wp_widget_rss_output()
     *
     * @since   1.0
     * @version 1.1.0
     */
    public function acs_dash_widget() {
        echo '<div class="rss-widget">';

        wp_widget_rss_output( array(
            'url' => 'http://arconixpc.com/tag/arconix-shortcodes/feed', // feed url
            'title' => 'Arconix Shortcodes News', // feed title
            'items' => 3, //how many posts to show
            'show_summary' => 1, // 1 = display excerpt
            'show_author' => 0, // 1 = display author
            'show_date' => 1 // 1 = display post date
        ) );
        ?>
        <div class="acs-widget-bottom">
            <ul>
                <li><a href="http://arcnx.co/aswiki"><img src="<?php echo $this->url . 'images/admin/page-16x16.png'; ?>">Documentation</a></li>
                <li><a href="http://arcnx.co/ashelp"><img src="<?php echo $this->url . 'images/admin/help-16x16.png'; ?>">Support Forum</a></li>
                <li><a href="http://arcnx.co/assource"><img src="<?php echo $this->url . 'images/admin/github-16x16.png'; ?>">Source Code</a></li>
            </ul>
        </div></div>
        <?php
    }

    /**
     * Includes admin css
     *
     * @link Codex reference: wp_enqueue_style()
     *
     * @since   1.1.0
     */
    function admin_css() {
        wp_enqueue_style( 'arconix-shortcodes-admin', $this->url . 'includes/css/admin.css', false, self::VERSION );
    }

    function shortcodes_deactivate_add_questions ( $shortcodes_deactivate_questions ) {

        $shortcodes_deactivate_questions = array(
            0 => array(
                'id'                => 4, 
                'text'              => __( "Font Awesome icons are not working.", "acs" ),
                'input_type'        => '',
                'input_placeholder' => ''
                ),
            1 => array(
                'id'                => 5,
                'text'              => __( "Shortcode attributes does not work.", "acs" ),
                'input_type'        => 'textfield',
                'input_placeholder' => 'Which attribute?'
            ), 
            2 =>  array(
                'id'                => 6,
                'text'              => __( "The styling of the plugin does not work with my theme.", "acs" ),
                'input_type'        => 'textfield',
                'input_placeholder' => 'Which Theme?'
            ),
            3 => array(
                'id'                => 7,
                'text'              => __( "The plugin is not compatible with another plugin.", "acs" ),
                'input_type'        => 'textfield',
                'input_placeholder' => 'Which plugin?'
            )

        );
        return $shortcodes_deactivate_questions;
    }

    function shortcodes_admin_actions ( ) {
        /**
         * We need to store the plugin version in DB, so we can show the welcome page and other contents.
         */
        $shortcodes_version_in_db = get_option( 'shortcodes_version' ); 
        if ( $shortcodes_version_in_db != self::VERSION ){
            update_option( 'shortcodes_version', self::VERSION );
        }
    }

    /**
     * Plugin's data to be tracked when Allow option is choosed.
     *
     * @hook ts_tracker_data
     *
     * @param array $data Contains the data to be tracked.
     *
     * @return array Plugin's data to track.
     * 
     */

    public static function shortcodes_ts_add_plugin_tracking_data ( $data ) {
        if ( isset( $_GET[ 'shortcodes_tracker_optin' ] ) && isset( $_GET[ 'shortcodes_tracker_nonce' ] ) && wp_verify_nonce( $_GET[ 'shortcodes_tracker_nonce' ], 'shortcodes_tracker_optin' ) ) {

            $plugin_data[ 'ts_meta_data_table_name' ] = 'ts_tracking_shortcodes_meta_data';
            $plugin_data[ 'ts_plugin_name' ]		  = 'Arconix Shortcodes';
            /**
             * Add Plugin data
             */
            $plugin_data[ 'shortcodes_plugin_version' ]      = self::VERSION;
            
            $plugin_data[ 'shortcodes_allow_tracking' ]      = get_option ( 'shortcodes_allow_tracking' );
            $data[ 'plugin_data' ]                    = $plugin_data;
        }
        return $data;
    }
    
    /**
     * Tracking data to send when No, thanks. button is clicked.
     *
     * @hook ts_tracker_opt_out_data
     *
     * @param array $params Parameters to pass for tracking data.
     *
     * @return array Data to track when opted out.
     * 
     */
    public static function shortcodes_get_data_for_opt_out ( $params ) {
        $plugin_data[ 'ts_meta_data_table_name']   = 'ts_tracking_shortcodes_meta_data';
        $plugin_data[ 'ts_plugin_name' ]		   = 'Arconix Shortcodes';
        
        // Store count info
        $params[ 'plugin_data' ]  				   = $plugin_data;
        
        return $params;
    }

}

new Arconix_Shortcodes;