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
                require_once( "component/pro-notices-in-lite/ts-pro-notices.php" );
                
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
                
                if ( in_array('woocommerce/woocommerce.php', get_option('active_plugins') ) ) {
                    $ts_pro_notices = self::shortcodes_get_notice_text ();
                    new Shortcodes_ts_pro_notices( $shortcodes_plugin_name, $shortcodes_lite_plugin_prefix, $shortcodes_plugin_prefix, $ts_pro_notices, $shortcodes_file_name, $shortcodes_pro_file_name );
                }

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
         * It will Display the notices in the admin dashboard for the pro vesion of the plugin.
         * @return array $ts_pro_notices All text of the notices
         */
        public static function shortcodes_get_notice_text () {
            $ts_pro_notices = array();

            $shortcodes_locale               = self::ts_get_plugin_locale();

            $message_first = wp_kses_post ( __( 'Thank you for using WooCommerce Print Invoice & Delivery Note plugin! Now make your deliveries more accurate by allowing customers to select their preferred delivery date & time from Product Delivery Date Pro for WooCommerce. <strong><a target="_blank" href= "https://www.tychesoftwares.com/store/premium-plugins/product-delivery-date-pro-for-woocommerce/?utm_source=wpnotice&utm_medium=first&utm_campaign=PrintInvoicePlugin">Get it now!</a></strong>', $shortcodes_locale ) );  

            $message_two = wp_kses_post ( __( 'Never login to your admin to check your deliveries by syncing the delivery dates to the Google Calendar from Product Delivery Date Pro for WooCommerce. <strong><a target="_blank" href= "https://www.tychesoftwares.com/store/premium-plugins/product-delivery-date-pro-for-woocommerce/checkout?edd_action=add_to_cart&download_id=16&utm_source=wpnotice&utm_medium=first&utm_campaign=PrintInvoicePlugin">Get it now!</a></strong>', $shortcodes_locale ) );

            $message_three = wp_kses_post ( __( 'You can now view all your deliveries in list view or in calendar view from Product Delivery Date Pro for WooCommerce. <strong><a target="_blank" href= "https://www.tychesoftwares.com/store/premium-plugins/product-delivery-date-pro-for-woocommerce/checkout?edd_action=add_to_cart&download_id=16&utm_source=wpnotice&utm_medium=first&utm_campaign=PrintInvoicePlugin">Get it now!</a></strong>.', $shortcodes_locale ) );

            $message_four = wp_kses_post ( __( 'Allow your customers to pay extra for delivery for certain Weekdays/Dates from Product Delivery Date Pro for WooCommerce. <strong><a target="_blank" href= "https://www.tychesoftwares.com/store/premium-plugins/product-delivery-date-pro-for-woocommerce/checkout?edd_action=add_to_cart&download_id=16&utm_source=wpnotice&utm_medium=first&utm_campaign=PrintInvoicePlugin">Have it now!</a></strong>.', $shortcodes_locale ) );

            $message_five = wp_kses_post ( __( 'Customers can now edit the Delivery date & time on cart and checkout page or they can reschedule the deliveries for the already placed orders from Product Delivery Date Pro for WooCommerce. <strong><a target="_blank" href= "https://www.tychesoftwares.com/store/premium-plugins/product-delivery-date-pro-for-woocommerce/checkout?edd_action=add_to_cart&download_id=16&utm_source=wpnotice&utm_medium=first&utm_campaign=PrintInvoicePlugin">Have it now!</a></strong>.', $shortcodes_locale ) );

		// message six
            $_link = 'https://www.tychesoftwares.com/store/premium-plugins/woocommerce-abandoned-cart-pro/?utm_source=wpnotice&utm_medium=sixth&utm_campaign=PrintInvoicePlugin';
            $message_six = wp_kses_post ( __( 'Boost your sales by recovering up to 60% of the abandoned carts with our Abandoned Cart Pro for WooCommerce plugin. You can capture customer email addresses right when they click the Add To Cart button. <strong><a target="_blank" href= "'.$_link.'">Grab your copy of Abandon Cart Pro plugin now</a></strong>.', $shortcodes_locale ) );
            
            $shortcodes_message_six = array ( 'message' => $message_six, 'plugin_link' => 'woocommerce-abandon-cart-pro/woocommerce-ac.php' );
		// message seven
            $_link = 'https://www.tychesoftwares.com/store/premium-plugins/woocommerce-abandoned-cart-pro/?utm_source=wpnotice&utm_medium=seventh&utm_campaign=PrintInvoicePlugin';
            $message_seven = wp_kses_post ( __( 'Don\'t loose your sales to abandoned carts. Use our Abandon Cart Pro plugin & start recovering your lost sales in less then 60 seconds.<br> 
            <strong><a target="_blank" href= "'.$_link.'">Get it now!</a></strong>', $shortcodes_locale ) );
            $shortcodes_message_seven = array ( 'message' => $message_seven, 'plugin_link' => 'woocommerce-abandon-cart-pro/woocommerce-ac.php' );
        
        // message eight
            $_link = 'https://www.tychesoftwares.com/store/premium-plugins/woocommerce-abandoned-cart-pro/?utm_source=wpnotice&utm_medium=eight&utm_campaign=PrintInvoicePlugin';
            $message_eight = wp_kses_post ( __( 'Send Abandoned Cart reminders that actually convert. Take advantage of our fully responsive email templates designed specially with an intent to trigger conversion. <br><strong><a target="_blank" href= "'.$_link.'">Grab your copy now!</a></strong>', $shortcodes_locale ) );
            $shortcodes_message_eight = array ( 'message' => $message_eight, 'plugin_link' => 'woocommerce-abandon-cart-pro/woocommerce-ac.php' );

		// message nine
            $_link = 'https://www.tychesoftwares.com/store/premium-plugins/woocommerce-abandoned-cart-pro/?utm_source=wpnotice&utm_medium=ninth&utm_campaign=PrintInvoicePlugin';
            $message_nine = wp_kses_post ( __( 'Increase your store sales by recovering your abandoned carts for just $119. No profit sharing, no monthly fees. Our Abandoned Cart Pro plugin comes with a 30 day money back guarantee as well. :). Use coupon code ACPRO20 & save $24!<br>
            <strong><a target="_blank" href= "'.$_link.'">Purchase now</a></strong>', $shortcodes_locale ) );
            $shortcodes_message_nine = array ( 'message' => $message_nine, 'plugin_link' => 'woocommerce-abandon-cart-pro/woocommerce-ac.php' );
            
		// message ten  
	        $_link = 'https://www.tychesoftwares.com/store/premium-plugins/order-delivery-date-for-woocommerce-pro-21/?utm_source=wpnotice&utm_medium=tenth&utm_campaign=PrintInvoicePlugin';
            $message_ten = wp_kses_post ( __( 'Allow your customers to select the Delivery Date & Time on the Checkout Page using our Order Delivery Date Pro for WooCommerce Plugin. <br> 
            <strong><a target="_blank" href= "'.$_link.'">Shop now</a></strong> & be one of the 20 customers to get 20% discount on the plugin price. Use the code "ORDPRO20". Hurry!!', $shortcodes_locale ) );
            $shortcodes_message_ten = array ( 'message' => $message_ten, 'plugin_link' => 'order-delivery-date/order_delivery_date.php' );

		// message eleven
            $_link = 'https://www.tychesoftwares.com/store/premium-plugins/woocommerce-booking-plugin/?utm_source=wpnotice&utm_medium=eleven&utm_campaign=PrintInvoicePlugin';
            $message_eleven = wp_kses_post ( __( ' Allow your customers to book an appointment or rent an apartment with our Booking and Appointment for WooCommerce plugin. You can also sell your product as a resource or integrate with a few Vendor plugins. <br>Shop now & Save 20% on the plugin with the code "BKAP20". Only for first 20 customers. <strong><a target="_blank" href= "'.$_link.'">Have it now!</a></strong>', $shortcodes_locale ) );
            $shortcodes_message_eleven = array ( 'message' => $message_eleven, 'plugin_link' => 'woocommerce-booking/woocommerce-booking.php' );

		// message 12
            $_link = 'https://www.tychesoftwares.com/store/premium-plugins/deposits-for-woocommerce/?utm_source=wpnotice&utm_medium=twelve&utm_campaign=PrintInvoicePlugin';
            $message_twelve = wp_kses_post ( __( ' Allow your customers to pay deposits on products using our Deposits for WooCommerce plugin.<br>
            <strong><a target="_blank" href= "'.$_link.'">Purchase now</a></strong> & Grab 20% discount with the code "DFWP20". The discount code is valid only for the first 20 customers.', $shortcodes_locale ) );
            $shortcodes_message_twelve = array ( 'message' => $message_twelve, 'plugin_link' => 'woocommerce-deposits/deposits-for-woocommerce.php' );

		// message 13 
	        $_link = 'https://www.tychesoftwares.com/store/premium-plugins/product-delivery-date-pro-for-woocommerce/?utm_source=wpnotice&utm_medium=thirteen&utm_campaign=PrintInvoicePlugin';
            $message_thirteen = wp_kses_post ( __( 'Allow your customers to select the Delivery Date & Time for your WooCommerce products using our Product Delivery Date Pro for WooCommerce Plugin. <br> 
            <strong><a target="_blank" href= "'.$_link.'">Shop now</a></strong>', $shortcodes_locale ) );
            $shortcodes_message_thirteen = array ( 'message' => $message_thirteen, 'plugin_link' => 'product-delivery-date/product-delivery-date.php' );

            $ts_pro_notices = array (
                1 => $message_first,
                2 => $message_two,
                3 => $message_three,
                4 => $message_four,
                5 => $message_five,
                6 => $shortcodes_message_six,
                7 => $shortcodes_message_seven,
                8 => $shortcodes_message_eight,
                9 => $shortcodes_message_nine,
                10 => $shortcodes_message_ten,
                11 => $shortcodes_message_eleven,
                12 => $shortcodes_message_twelve,
                13 => $shortcodes_message_thirteen
            );

            return $ts_pro_notices;
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