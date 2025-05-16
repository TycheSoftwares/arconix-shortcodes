<?php
/**
 * It will Add all the Boilerplate component when we activate the plugin.
 * @author  Tyche Softwares
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
if ( ! class_exists( 'Arconix_Shortcodes_Component' ) ) {
	/**
	 * It will Add all the Boilerplate component when we activate the plugin.
	 * 
	 */
	class Arconix_Shortcodes_Component {
	    
		/**
		 * It will Add all the Boilerplate component when we activate the plugin.
		 */
		public function __construct() {
            
			$is_admin = is_admin();

			if ( true === $is_admin ) {

                require_once( "component/tracking-data/ts-tracking.php" );
                require_once( "component/deactivate-survey-popup/class-ts-deactivation.php" );

                require_once( "component/welcome-page/ts-welcome.php" );
                require_once( "component/faq-support/ts-faq-support.php" );
                
                $shortcodes_plugin_name          = self::ts_get_plugin_name();;
                $shortcodes_locale               = self::ts_get_plugin_locale();

                $shortcodes_file_name            = 'arconix-shortcodes/plugin.php';
                $shortcodes_plugin_prefix        = 'shortcodes';
                $shortcodes_lite_plugin_prefix   = 'shortcodes';
                $shortcodes_plugin_folder_name   = 'arconix-shortcodes/';
                $shortcodes_plugin_dir_name      = dirname ( untrailingslashit( plugin_dir_path ( __FILE__ ) ) ) . '/plugin.php' ;
                $shortcodes_plugin_url           = dirname ( untrailingslashit( plugins_url( '/', __FILE__ ) ) );

                $shortcodes_get_previous_version = get_option( 'shortcodes_version', '1' );

                $shortcodes_blog_post_link       = 'https://www.tychesoftwares.com/docs/docs/shortcodes/usage-tracking/';

                $shortcodes_plugins_page         = '';
                $shortcodes_plugin_slug          = '';
                $shortcodes_pro_file_name        = '';

                $shortcodes_settings_page        = '';

                new Shortcodes_TS_tracking ( $shortcodes_plugin_prefix, $shortcodes_plugin_name, $shortcodes_blog_post_link, $shortcodes_locale, $shortcodes_plugin_url, $shortcodes_settings_page, '', '', '', $shortcodes_file_name );

                new Shortcodes_TS_Tracker ( $shortcodes_plugin_prefix, $shortcodes_plugin_name );

                $shortcodes_deativate = new Shortcodes_TS_deactivate;
                $shortcodes_deativate->init ( $shortcodes_file_name, $shortcodes_plugin_name );
                
                // $user = wp_get_current_user();
                
                // if ( in_array( 'administrator', (array) $user->roles ) ) {
                //     new Shortcodes_TS_Welcome ( $shortcodes_plugin_name, $shortcodes_plugin_prefix, $shortcodes_locale, $shortcodes_plugin_folder_name, $shortcodes_plugin_dir_name, $shortcodes_get_previous_version );
                // }

                $ts_pro_shortcodes = self::shortcodes_get_faq ();
                new Shortcodes_TS_Faq_Support( $shortcodes_plugin_name, $shortcodes_plugin_prefix, $shortcodes_plugins_page, $shortcodes_locale, $shortcodes_plugin_folder_name, $shortcodes_plugin_slug, $ts_pro_shortcodes, '', $shortcodes_file_name );
            }
        }

         /**
         * It will retrun the plguin name.
         * @return string $ts_plugin_name Name of the plugin
         */
		public static function ts_get_plugin_name () {
            $ordd_plugin_dir =  dirname ( dirname ( __FILE__ ) );
            $ordd_plugin_dir .= '/plugin.php';
           
            $ts_plugin_name = '';
            $plugin_data = get_file_data( $ordd_plugin_dir, array( 'name' => 'Plugin Name' ) );
            if ( ! empty( $plugin_data['name'] ) ) {
                $ts_plugin_name = $plugin_data[ 'name' ];
            }
            return $ts_plugin_name;
        }

        /**
         * It will retrun the Plugin text Domain
         * @return string $ts_plugin_domain Name of the Plugin domain
         */
        public static function ts_get_plugin_locale () {
            $ordd_plugin_dir =  dirname ( dirname ( __FILE__ ) );
            $ordd_plugin_dir .= '/plugin.php';

            $ts_plugin_domain = '';
            $plugin_data = get_file_data( $ordd_plugin_dir, array( 'domain' => 'Text Domain' ) );
            if ( ! empty( $plugin_data['domain'] ) ) {
                $ts_plugin_domain = $plugin_data[ 'domain' ];
            }
            return $ts_plugin_domain;
        }
		
		/**
         * It will contain all the shortcodes which need to be display on the shortcodes page.
         * @return array $ts_shortcodes All questions and answers.
         * 
         */
        public static function shortcodes_get_faq() {

            $ts_shortcodes = array ();

            $ts_shortcodes = array(
                1 => array (
                        'question' => 'What is compatibility mode?',
                        'answer'   => 'Compatibility mode adds a prefix to all the plugin’s shortcodes. This was put into place to help avoid conflicts with other themes or plugins that used the same shortcode (like [button] or [box])'
                    ), 
                2 => array (
                        'question' => 'How do I enable compatibility mode?',
                        'answer'   => 'Place the following code in your theme’s functions.php file:
                        <br>
                        <pre><code>define( "ACS_COMPAT", true ); // Arconix Shortcodes Compatibility Mode
</code></pre>
Now when adding a shortcode, just make sure they start ac- (i.e. [ac-box]content[/ac-box]
                        '
                    ),
                3 => array (
						'question' => 'How can I collapse all the accordions?',
                        'answer'   => 'While you can set the accordions to all collapse when the page is first loaded, the jQuery Tools script that powers these accordions does not support closing all the accordions once one has been opened.'
                ),
                4 => array (
                    'question' => 'The Accordions/Tabs/Toggles isn’t working',
                    'answer'   => '<p>While you can certainly start a thread in the <a href="https://wordpress.org/support/plugin/arconix-shortcodes" rel="nofollow">support forum</a>, there are some troubleshooting steps you can take beforehand to help speed up the process.</p>
                    
                    <ol>
                        <li>Check to make sure the javascripts are loading correctly. Load the page with the malfunctioning shortcode in your browser and view your page’s source (usually CTRL + U). Look for jQuery, jQuery Tools and Arconix Shortcodes JS files there. If you don’t see jQuery Tools or the Arconix scripts at all (they’re somewhere near the bottom of the page), then your theme’s <code>footer.php</code> file is likely missing <code>&lt;?php wp_footer(); ?&gt;</code>, which is necessary for the operation of mine and many other plugins. If you’re unable or unwilling to resolve the issue yourself, contact the theme developer for assistance.</li>
                        <li>Check to make sure only one copy of jQuery is being loaded. Many times conflicts arise when themes or plugins load jQuery incorrectly, causing it to be loaded multiple times in multiple versions. In order to find the offending item, start by disabling your plugins one by one until you find the problem. If you’ve disabled all your plugins and the issue still persists, try switching to a different them, such as TwentyTen or TwentyTwelve to see if the problem is with your theme. Once you’ve found the problem, contact the developer for assistance getting the issue resolved.</li>
                    </ol>'
                )   
            );

            return $ts_shortcodes;
        }
	}
	$Arconix_Shortcodes_Component = new Arconix_Shortcodes_Component();
}