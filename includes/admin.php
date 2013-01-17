<?php
/**
 * Adds a meta box to the sidebar column on the Post and Page edit screens.
 *
 * The list of available post_types is filterable for themes and plugins
 *
 * @link Codex reference: apply_filters()
 * @link Codex reference: add_meta_box()
 *
 * @since 1.1.0
 */
function acs_add_custom_meta_box() {
    // Allow a theme or plugin to filter the list of post types this meta box is added to
    $post_types = apply_filters( 'arconix_shortcodes_meta_box_post_types', array( 'post', 'page' ) );

    foreach( (array) $post_types as $post_type ) {
        add_meta_box( 'ac-shortcode-list', __( 'Arconix Shortcode List', 'acs' ), 'shortcodes_box', $post_type, 'side' );
    }
}

/**
 * Callback to display the meta box content
 *
 * @uses get_arconix_shortcode_list()   Defined in /includes/shortcodes.php
 *
 * @see ACS_ADMIN_IMAGES_URL    Defined in /plugin.php
 *
 * @since 1.1.0
 */
function shortcodes_box() {
    $shortcodes = get_arconix_shortcode_list();

    if( ! $shortcodes or ! is_array( $shortcodes ) )
        return;

    $return = '<p><a href="http://arcnx.co/aswiki"><img src="' . ACS_ADMIN_IMAGES_URL . 'page-16x16.png">Documentation</a></p><ul>';
    foreach( (array) $shortcodes as $shortcode ) {
        $return .= '<li>[' . $shortcode . ']</li>';
    }
    $return .= '</ul>';

    echo $return;
}

/**
 * Adds a news widget to the dashboard.
 *
 * @link Codex reference: wp_add_dashboard_widget()
 *
 * @since 1.0
 */
function acs_register_shortcode_dash_widget() {
    wp_add_dashboard_widget( 'ac-shortcodes', 'Arconix Shortcodes', 'acs_dash_widget' );
}

/**
 * Output for the dashboard widget
 *
 * @link Codex reference: wp_widget_rss_output()
 *
 * @see ACS_ADMIN_IMAGES_URL    Defined in /plugin.php
 *
 * @since 1.0
 * @version 1.1.0
 */
function acs_dash_widget() {
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
            <li><a href="http://arcnx.co/aswiki"><img src="<?php echo ACS_ADMIN_IMAGES_URL . 'page-16x16.png'; ?>">Documentation</a></li>
            <li><a href="http://arcnx.co/ashelp"><img src="<?php echo ACS_ADMIN_IMAGES_URL . 'help-16x16.png'; ?>">Support Forum</a></li>
            <li><a href="http://arcnx.co/astrello"><img src="<?php echo ACS_ADMIN_IMAGES_URL . 'trello-16x16.png'; ?>">Dev Board</a></li>
            <li><a href="http://arcnx.co/assource"><img src="<?php echo ACS_ADMIN_IMAGES_URL . 'github-16x16.png'; ?>">Source Code</a></li>
        </ul>
    </div></div>
    <?php
}

/**
 * Includes admin css
 *
 * @link Codex reference: wp_enqueue_style()
 *
 * @see ACS_CSS_URL     Defined in /plugin.php
 * @see ACS_VERSION     Defined in /plugin.php
 *
 * @since 1.1.0
 */
function acs_admin_css() {
    wp_enqueue_style( 'arconix-shortcodes-admin', ACS_CSS_URL . 'admin.css', false, ACS_VERSION );
}
?>