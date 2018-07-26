<?php
/**
 * Welcome page on activate or updation of the plugin
 */

$shortcodes_array = get_query_var( 'shortcodes_array' );

$badge_url = $shortcodes_array['badge_url'];

$ts_dir_image_path = $shortcodes_array['ts_dir_image_path'];

$ts_plugin_name = $shortcodes_array['plugin_name'];

?>
<style>
    .feature-section .feature-section-item {
        float:left;
        width:48%;
    }
</style>
<div class="wrap about-wrap">

    <?php echo $shortcodes_array[ 'get_welcome_header'] ?>

    <div style="float:left;width: 80%;">
    <p class="about-text" style="margin-right:20px;"><?php
        printf(
            __( "Thank you for activating or updating to the latest version of $ts_plugin_name! If you're a first time user, welcome! You're well on your way to explore the $ts_plugin_name functionality for your WordPress site." )
        );
        ?></p>
    </div>
    <div class="faq-badge"><img src="<?php echo $badge_url; ?>" style="width:150px;"/></div>

    <p>&nbsp;</p>

    <div class="feature-section clearfix introduction">

        <h3><?php esc_html_e( "Get Started with $ts_plugin_name", 'acs' ); ?></h3>

        <div class="video feature-section-item" style="float:left;padding-right:10px;">
            <img src="<?php echo $ts_dir_image_path . 'acs_accordian.png' ?>"
                    alt="<?php esc_attr_e( 'Arconix Shortcodes', 'acs' ); ?>" style="width:600px;">
        </div>

        <div class="content feature-section last-feature">
            <h3><?php esc_html_e( 'Accordian', 'acs' ); ?></h3>

            <p><?php esc_html_e( 'To add frequently asked questions and their answers, you can use accordian shortcode on your site.', 'acs' ); ?></p>
            <a href="https://www.tychesoftwares.com/docs/docs/shortcodes/shortcode-reference/#gist6495554" target="_blank" class="button-secondary">
                <?php esc_html_e( 'Click here to check example', 'acs' ); ?>
                <span class="dashicons dashicons-external"></span>
            </a>
        </div>
    </div>

    <div class="content">

        <div class="feature-section clearfix">
            <div class="content feature-section-item">

                <h3><?php esc_html_e( 'Tabs', 'acs' ); ?></h3>

                    <p><?php esc_html_e( 'You can create a tabs for displaying information on your post or pages.', 'acs' ); ?></p>
                    
                    <a href="https://www.tychesoftwares.com/docs/docs/shortcodes/shortcode-reference/#gist6500592" target="_blank" class="button-secondary">
                        <?php esc_html_e( 'Click here to check example', 'acs' ); ?>
                        <span class="dashicons dashicons-external"></span>
                    </a>
            </div>

            <div class="content feature-section-item last-feature">
                <img src="<?php echo $ts_dir_image_path . 'acs_tabs.png'; ?>" alt="<?php esc_attr_e( 'Arconix FAQ', 'acs' ); ?>" style="width:500px;">
            </div>
        </div>

        <div class="feature-section clearfix introduction">
            <div class="video feature-section-item" style="float:left;padding-right:10px;">
                <img src="<?php echo $ts_dir_image_path . 'acs_misellaneous.png'; ?>" alt="<?php esc_attr_e( 'Arconix FAQ', 'acs' ); ?>" style="width:500px;">
            </div>

            <div class="content feature-section-item last-feature">
                <h3><?php esc_html_e( 'Miscellaneous', 'acs' ); ?></h3>

                <p><?php esc_html_e( 'You can use diffrent other shortcodes on your site, like Button, Highlighting text, Box, Login / Logout link and many more. ', 'acs' ); ?></p>
                <a href="https://www.tychesoftwares.com/docs/docs/shortcodes/shortcode-reference/#gist6499059" target="_blank" class="button-secondary">
                    <?php esc_html_e( 'Click here to check example', 'acs' ); ?>
                    <span class="dashicons dashicons-external"></span>
                </a>
            </div>
        </div>
    </div>

    
    <div class="feature-section clearfix">

        <div class="content feature-section-item">

            <h3><?php esc_html_e( 'Getting to Know Tyche Softwares', 'acs' ); ?></h3>

            <ul class="ul-disc">
                <li><a href="https://tychesoftwares.com/?utm_source=wpaboutpage&utm_medium=link&utm_campaign=ShortcodesPlugin" target="_blank"><?php esc_html_e( 'Visit the Tyche Softwares Website', 'acs' ); ?></a></li>
                <li><a href="https://tychesoftwares.com/premium-woocommerce-plugins/?utm_source=wpaboutpage&utm_medium=link&utm_campaign=ShortcodesPlugin" target="_blank"><?php esc_html_e( 'View all Premium Plugins', 'acs' ); ?></a>
                <ul class="ul-disc">
                    <li><a href="https://www.tychesoftwares.com/store/premium-plugins/woocommerce-abandoned-cart-pro/?utm_source=wpaboutpage&utm_medium=link&utm_campaign=ShortcodesPlugin" target="_blank">Abandoned Cart Pro Plugin for WooCommerce</a></li>
                    <li><a href="https://www.tychesoftwares.com/store/premium-plugins/woocommerce-booking-plugin/?utm_source=wpaboutpage&utm_medium=link&utm_campaign=ShortcodesPlugin" target="_blank">Booking & Appointment Plugin for WooCommerce</a></li>
                    <li><a href="https://www.tychesoftwares.com/store/premium-plugins/order-delivery-date-for-woocommerce-pro-21/?utm_source=wpaboutpage&utm_medium=link&utm_campaign=ShortcodesPlugin" target="_blank">Order Delivery Date for WooCommerce</a></li>
                    <li><a href="https://www.tychesoftwares.com/store/premium-plugins/product-delivery-date-pro-for-woocommerce/?utm_source=wpaboutpage&utm_medium=link&utm_campaign=ShortcodesPlugin" target="_blank">Product Delivery Date for WooCommerce</a></li>
                    <li><a href="https://www.tychesoftwares.com/store/premium-plugins/deposits-for-woocommerce/?utm_source=wpaboutpage&utm_medium=link&utm_campaign=ShortcodesPlugin" target="_blank">Deposits for WooCommerce</a></li>
                </ul>
                </li>
                <li><a href="https://tychesoftwares.com/about/?utm_source=wpaboutpage&utm_medium=link&utm_campaign=ShortcodesPlugin" target="_blank"><?php esc_html_e( 'Meet the team', 'acs' ); ?></a></li>
            </ul>
        </div>
    </div>            
    <!-- /.feature-section -->
</div>
