<?php
/**
 * Returns an array of shortcodes that have passed through a compatibility mode check
 *
 * While the list is filterable, it's suggested to only filter the list if shortcodes will be removed.
 * Adding shortcodes in this manner will likely fail as the callback function will not exist in the class.
 *
 * @link Codex reference: apply_filters()
 *
 * @return array $new_shortcodes
 *
 * @since 1.1.0
 */
function get_arconix_shortcode_list() {
    // List all shortcodes in an array to run through compatibility check
    $shortcodes = apply_filters( 'arconix_shortcodes_list', array(
        'loginout', 'googlemap', 'site-link', 'the-year', 'wp-link',
        'abbr', 'highlight',
        'accordions', 'accordion',
        'box',
        'button',
        'list',
        'tabs', 'tab',
        'toggle',
        'one-half',
        'one-third', 'two-thirds',
        'one-fourth', 'two-fourths', 'three-fourths',
        'one-fifth', 'two-fifths', 'three-fifths', 'four-fifths'
    ) );

    // Check for defined var and add prefix for compatibility mode
    defined( 'ACS_COMPAT' ) ? $prefix = 'ac-' : $prefix = '';

    // Will store our new shortcode array
    $new_shortcodes = array();

    // Loop through each shortcode and append the prefix as necessary, then add it to the array
    foreach( (array) $shortcodes as $shortcode ) {
        $new_shortcodes[] = $prefix . $shortcode;
    }

    return $new_shortcodes;
}

/**
 * Register the plugin shortcodes
 *
 * Stores the shortcode list in an array and then loops through, adding the shortcode to WP for use.
 * In the event the user has enabled compatibility mode, we have to remove the prefix (1st 3 chars)
 * so it doesn't foul up the callback function.
 *
 * @link Codex reference: add_shortcode()
 * @link PHP reference: substr()
 * @link PHP reference: str_replace()
 *
 * @uses get_arconix_shortcode_list()   Defined in this file
 *
 * @since 0.9
 * @version 1.1.0
 */
function acs_register_shortcodes() {
    $shortcodes = get_arconix_shortcode_list();

    foreach( (array) $shortcodes as $shortcode ) {
        // If compatibility mode is enabled, remove the prefix for the function call, otherwise the function call is the shortcode name
        defined( 'ACS_COMPAT' ) ? $shortcode_func = substr( $shortcode, 3 ) : $shortcode_func = $shortcode;

        add_shortcode( $shortcode , str_replace( '-', '_', $shortcode_func )  . '_arconix_shortcode' );
    }
}

/**
 * Shortcode to display a login link or logout link.
 *
 * @link Codex reference: is_user_logged_in()
 * @link Codex reference: esc_url()
 * @link Codex reference: esc_attr()
 * @link Codex reference: wp_logout_url()
 * @link Codex reference: site_url()
 *
 * @return string
 *
 * @since 0.9
 */
function loginout_arconix_shortcode() {
    $textdomain = 'acs';
    if( is_user_logged_in() )
        $return = '<a class="arconix-logout-link" href="' . esc_url( wp_logout_url( site_url( $SERVER['REQUEST_URI'] ) ) ) . '" title="' . esc_attr__( 'Log out of this site', $textdomain ) . '">' . __( 'Log out', $textdomain ) . '</a>';
    else
        $return = '<a class="arconix-login-link" href="' . esc_url( wp_login_url( site_url( $SERVER['REQUEST_URI'] ) ) ) . '" title="' . esc_attr__( 'Log in to this site', $textdomain ) . '">' . __( 'Log in', $textdomain ) . '</a>';

    return $return;
}

/**
 * Shortcode a Google Map based on the embed URL or address provided
 *
 * @link Codex reference: apply_filters()
 * @link Codex reference: shortcode_atts()
 * @link Codex reference: absint()
 * @link Codex reference: esc_url()
 * @link PHP reference: extract()
 *
 * @param array $atts
 * @return string
 *
 * @since 0.9
 * @version 1.3.0
 *
 * @example [map w="640" h="400" url="htp://..."]
 * @example [map url="RI, USA" type="address"]
 */
function googlemap_arconix_shortcode( $atts ) {
    $defaults = apply_filters( 'arconix_googlemap_shortcode_args', array(
        'w' => '640',
        'h' => '400',
        'url' => '',
        'type' => ''
    ) );
    extract( shortcode_atts( $defaults, $atts, 'arconix_googlemap' ) );

    $r = '<iframe width="' . absint( $w ) . '" height="' . absint( $h ) . '" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . esc_url( $url ) . '&amp;output=embed"></iframe>';

    // If a user enters address as the type, instead of a full url in the url param, they enter an address
    if ( $type == "address" )
        $r = '<iframe src="https://maps.google.com/maps?q=' . urlencode( $url ) . '&amp;output=embed" width="' . absint( $w ) . '" height="' . absint( $h ) . '" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>';

    return apply_filters( 'arconix_googlemap_return', $r );
}

/**
 * Shortcode to display a link back to the site.
 *
 * @link Codex reference: home_url()
 * @link Codex reference: esc_attr()
 * @link Codex reference: get_bloginfo()
 *
 * @since 0.9
 */
function site_link_arconix_shortcode() {
    return '<a class="arconix-site-link" href="' . home_url() . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home"><span>' . esc_attr( get_bloginfo( 'name' ) ) . '</span></a>';
}

/**
 * Shortcode to display the current 4-digit year with optional before, start and after
 *
 * @link Codex reference: apply_filters()
 * @link Codex reference: esc_html()
 * @link Codex reference: absint()
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 * @link PHP reference: date()
 *
 * @param array $atts
 * @return string
 *
 * @since 0.9
 * @version 1.3.0
 */
function the_year_arconix_shortcode( $atts ) {
    $defaults = apply_filters( 'arconix_the_year_shortcode_args', array(
        'before' => '',
        'start' => '',
        'after' => ''
    ) );

    extract( shortcode_atts( $defaults, $atts, 'arconix_the_year' ) );

    if( $before ) $before = esc_html( $before ) . ' ';
    if( $start ) $start = absint( $start ) . ' - ';
    if( $after ) $after = ' ' . esc_html( $after );

    $r = '<span class="arconix-the-year">' . $before . $start . date( 'Y' ) . $after . '</span>';

    return apply_filters( 'arconix_the_year_return', $r );
}

/**
 * Shortcode to return a link to WordPress.org.
 *
 * @link Codex reference: esc_attr_()
 *
 * @since 0.9
 */
function wp_link_arconix_shortcode() {
    return '<a class="arconix-wp-link" href="http://wordpress.org" title="' . esc_attr__( 'This site is powered by WordPress', 'acs' ) . '"><span>' . __( 'WordPress', 'acs' ) . '</span></a>';
}

/**
 * Shortcode to handle abbreviations
 *
 * @link Codex reference: apply_filters()
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @param array $atts
 * @return string
 *
 * @since 0.9
 * @version  1.3.0
 */
function abbr_arconix_shortcode( $atts, $content = null ) {
    $defaults = apply_filters( 'arconix_abbr_shortcode_args', array( 'title' => '' ) );
    extract( shortcode_atts( $defaults, $atts, 'arconix_abbr' ) );

    $r = '<abbr class="arconix-abbr" title="' . esc_attr( $title ) . '">' . $content . '</abbr>';

    return apply_filters( 'arconix_abbr_return', $r );
}

/**
 * Shortcode to produce jQuery-powered accordion group
 *
 * Using the 'load' parameter, the user can specify which accordion is initially shown (or entirely collapsed when '0' is passed).
 * Right now that's accordion 0-5
 *
 * @link Codex reference: apply_filters()
 * @link Codex reference: wp_script_is()
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 *
 * @param array $atts
 * @return string
 *
 * @since 0.9
 * @version 1.3.0
 */
function accordions_arconix_shortcode( $atts, $content = null ) {
    if( wp_script_is( 'arconix-shortcodes-js', 'registered' ) ) wp_enqueue_script( 'arconix-shortcodes-js' );

    $defaults = apply_filters( 'arconix_accordions_shortcode_args', array(
        'type' => 'vertical',
        'load' => '1',
        'css' => ''
    ) );
    extract( shortcode_atts( $defaults, $atts, 'arconix_accordions' ) );

    if( $load == "none" )
        $load = 0; // for backwards compatibility

    if( $css )
        $css = ' ' . sanitize_html_class( $css );

    $r = '<div class="arconix-accordions arconix-accordions-' . esc_attr( $type ) . ' arconix-accordions-' . esc_attr( $load ) . esc_attr( $css ) . '">' . remove_wpautop( $content ) . '</div>';

    return apply_filters( 'arconix_accordions_return', $r );
}

/**
 * Shortcode to produce jQuery-powered accordion
 *
 * @link Codex reference: apply_filters()
 * @link Codex reference: shortcode_atts()
 * @link Codex reference: sanitize_title()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.3.0
 */
function accordion_arconix_shortcode( $atts, $content = null ) {
    $defaults = apply_filters( 'arconix_accordion_shortcode_args', array(
        'title' => '',
        'last' => ''
    ) );
    extract( shortcode_atts( $defaults, $atts, 'arconix_accordion' ) );

    if( ( is_array( $atts ) && in_array( 'last', $atts ) && $atts['last'] != '' ) || $last != '' ) $last = ' arconix-accordion-last';

    $r = '<div class="arconix-accordion-title accordion-' . sanitize_title( $title ) . $last . '">' . $title . '</div>';
    $r .= '<div class="arconix-accordion-content' . $last . '">' . remove_wpautop( $content ) . '</div>';

    return apply_filters( 'arconix_accordions_return', $r );
}

/**
 * Shortcode to produce a styled box
 *
 * Supports 6 solid colors (blue, green, grey, red, tan and yellow) and
 * 5 icon boxes (alert, comment, download, info, tip) by default
 *
 * Can be infinitely extended by specifying your own style and adding the
 * corresponding CSS to your stylesheet
 *
 * @example [box style="comment"]my content[/box]
 *
 * @link Codex reference: apply_filters()
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.3.0
 */
function box_arconix_shortcode( $atts, $content = null ) {
    $defaults = apply_filters( 'arconix_box_shortcode_args', array(
        'style' => 'grey'
    ) );
    extract( shortcode_atts( $defaults, $atts, 'arconix_box' ) );

    $r = '<div class="arconix-box arconix-box-' . esc_attr( $style ) . '">' . remove_wpautop( $content ) . '</div>';

    return apply_filters( 'arconix_box_return', $r );
}

/**
 * Shortcode to produce a styled button
 *
 * Supports 3 default sizes (small, medium and large).
 * Supports 8 default colors (black, blue, green, grey, orange, pink, red, white).
 * Allows you to specify a link target and a relationship (rel)
 *
 * @example [button size="large" color="green" url="http://google.com"]my content[/box]
 *
 * @link Codex reference: apply_filters()
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.3.0
 */
function button_arconix_shortcode( $atts, $content = null ) {
    $defaults = apply_filters( 'arconix_button_shortcode_args', array(
        'size' => 'medium',
        'color' => 'white',
        'url' => '#',
        'target' => '',
        'rel' => ''
    ) );
    extract( shortcode_atts( $defaults, $atts, 'arconix_button' ) );

    switch( $target ) {
        case "_blank":
        case "blank":
            $target = ' target="_blank" ';
            break;
        default:
            $target = '';
            break;
    }

    if( $rel )
        $rel = ' rel="' . esc_attr( $rel ) . '"';

    // Properly escape our data
    $url = esc_url( $url );
    $size = esc_attr( $size );
    $color = esc_attr( $color );

    $r = "<a href='{$url}' class='arconix-button arconix-button-{$size} arconix-button-{$color}'{$rel}{$target}>{$content}</a>";

    return apply_filters( 'arconix_button_return', $r );
}

/**
 * Shortcode to highlight text
 *
 * Supports yellow by default
 *
 * @link Codex reference: apply_filters()
 * @link Codex reference: shortcode_atts()
 * @link Codex reference: do_shortcode()
 * @link PHP reference: extract()
 *
 * @example [highlight]my content[/highlight]
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version  1.3.0
 */
function highlight_arconix_shortcode( $atts, $content = null ) {
    $defaults = apply_filters( 'arconix_highlight_shortcode_args', array( 'color' => 'yellow' ) );

    extract( shortcode_atts( $defaults, $atts, 'arconix_highlight' ) );

    $r = '<span class="arconix-highlight arconix-highlight-' . esc_attr( $color ) . '">' . do_shortcode( $content ) . '</span>';

    return apply_filters( 'arconix_highlight_return', $r );
}

/**
 * Shortcode outputs a styled unordered list
 *
 * Supports the following list types:
 * - arrow-black
 * - arrow-blue
 * - arrow-green
 * - arrow-grey
 * - arrow-orange
 * - arrow-pink
 * - arrow-red
 * - arrow-qhite
 * - check
 * - close
 * - star
 *
 * @example [list style="arrow-green"]unordered list here[/list]
 *
 * @link Codex reference: apply_filters()
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.3.0
 */
function list_arconix_shortcode( $atts, $content = null ) {
    $defaults = apply_filters( 'arconix_list_shortcode_args', array( 'style' => 'arrow-white' ) );

    extract( shortcode_atts( $defaults, $atts, 'arconix_list' ) );

    $r = '<div class="arconix-list arconix-list-' . esc_attr( $style ) . '">' . remove_wpautop( $content ) . '</div>';

    return apply_filters( 'arconix_list_return', $r );
}

/**
 * Shortcode to produce a jQuery-powered tabbed group
 *
 * The tab title (for styling and linking can be set up by name or number. Read the following link for more information.
 *
 * @tutorial http://arconixpc.com/2012/progress-report-tab-linking
 *
 * @example [tabs][tab title="Tab 1"]My tab 1 content[/tab][tab title="Tab 2"]My tab 2 content[/tab][/tabs]
 *
 * @see tab_shortcode()
 *
 * @link Codex reference: wp_enqueue_script()
 * @link Codex reference: apply_filters()
 * @link Codex reference: wp_script_is()
 * @link Codex reference: shortcode_atts()
 * @link Codex reference: do_shortcode()
 * @link Codex reference: sanitize_title()
 * @link PHP reference: extract()
 * @link PHP reference: implode()
 *
 * @uses remove_wpautop()   Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.3.0
 */
function tabs_arconix_shortcode( $atts, $content = null ) {
    if( wp_script_is( 'arconix-shortcodes-js', 'registered' ) ) wp_enqueue_script( 'arconix-shortcodes-js' );

    $defaults = apply_filters( 'arconix_tabs_shortcode_args', array(
        'style' => 'horizontal',
        'id' => 'name',
        'css' => ''
    ) );
    extract( shortcode_atts( $defaults, $atts, 'arconix_tabs' ) );

    if( $css )
        $css = ' ' . sanitize_html_class( $css );

    $GLOBALS['tab_count'] = 0;
    $tabid = 0;

    do_shortcode( $content );

    if( is_array( $GLOBALS['tabs'] ) ) {
        foreach( $GLOBALS['tabs'] as $tab ) {

            // Set up tabid based on the id defined above
            switch( $id ) {
                case "name":
                    $tabid = sanitize_title( $tab['title'] );
                    break;
                case "number":
                    $tabid += 1;
                    break;
                default:
                    break;
            }

            $tabs[] = '<li class="arconix-tab tab-' . sanitize_title( $tab['title'] ) . '"><a class="" href="#tab-' . $tabid . '">' . $tab['title'] . '</a></li>';
            $panes[] = '<div class="arconix-pane pane-' . sanitize_title( $tab['title'] ) . '">' . remove_wpautop( $tab['content'] ) . '</div>';
        }
        $r = "\n" . '<div class="arconix-tabs-' . esc_attr( $style ) . esc_attr( $css ) . '"><ul class="arconix-tabs">' . implode( "\n", $tabs ) . '</ul>' . "\n" . '<div class="arconix-panes">' . implode( "\n", $panes ) . '</div></div>' . "\n";
    }

    // Reset the variables in the event we use multiple tabs on single page
    $GLOBALS['tabs'] = null;
    $GLOBALS['tab_count'] = 0;

    return apply_filters( 'arconix_tabs_return', $r );
}

/**
 * Shortcode that handles the creation of each individual tab as part of a [tabs] group
 *
 * @see tabs_shortcode()
 *
 * @link Codex reference: apply_filters()
 * @link Codex reference: shortcode_atts()
 * @link Codex reference: do_shortcode()
 * @link PHP reference: extract()
 * @link PHP reference: sprintf()
 *
 * @uses remove_wpautop()   Defined in this file
 *
 * @param array $atts
 * @param string $content
 *
 * @since 0.9
 * @version  1.3.0
 */
function tab_arconix_shortcode( $atts, $content = null ) {
    $defaults = apply_filters( 'arconix_tab_shortcode_args', array( 'title' => 'Tab' ) );
    extract( shortcode_atts( $defaults, $atts, 'arconix_tab' ) );

    $x = $GLOBALS['tab_count'];
    $GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' => $content );

    $GLOBALS['tab_count']++;
}

/**
 * Shortcode to produce a jQuery-powered toggle-box
 *
 * @example [toggle title="My Toggle Title"]My Toggle Content[/toggle]
 *
 * @link Codex reference: wp_enqueue_script()
 * @link Codex reference: apply_filters()
 * @link Codex reference: shortcode_atts()
 * @link Codex reference: do_shortcode()
 *
 * @uses remove_wpautop()   Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.3.0
 */
function toggle_arconix_shortcode( $atts, $content = null ) {
    wp_enqueue_script( 'arconix-shortcodes-js' );

    $defaults = apply_filters( 'arconix_toggle_shortcode_args', array(
        'title' => '',
        'load' => 'closed',
        'css' => ''
    ) );
    extract( shortcode_atts( $defaults, $atts, 'arconix_toggle' ) );

    $load == 'open' ? $load = ' toggle-open' : $load = ' toggle-closed';


    if( $css )
        $css = ' ' . sanitize_html_class( $css );

    $r = '<div class="arconix-toggle-wrap'. esc_attr( $css ) . '"><div class="arconix-toggle-title' . esc_attr( $load ) . '">' . esc_attr( $title ) . '</div><div class="arconix-toggle-content' . esc_attr( $load ) . '">' . remove_wpautop( $content ) . '</div></div>';

    return apply_filters( 'arconix_toggle_return', $r );
}

/**
 * Shortcode to display a 1/2 column
 *
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 * @uses clearfloat()       Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function one_half_arconix_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    $last = ( ( isset( $atts[0] ) && trim( $atts[0] == 'last' ) ) || $last != "" ) ? ' arconix-column-last' : '';

    $return = '<div class="arconix-column-one-half' . $last . '">' . remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 1/3 column
 *
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 * @uses clearfloat()       Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function one_third_arconix_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    $last = ( ( isset( $atts[0] ) && trim( $atts[0] == 'last' ) ) || $last != "" ) ? ' arconix-column-last' : '';

    $return = '<div class="arconix-column-one-third' . $last . '">' . remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 2/3 column
 *
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 * @uses clearfloat()       Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function two_thirds_arconix_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    $last = ( ( isset( $atts[0] ) && trim( $atts[0] == 'last' ) ) || $last != "" ) ? ' arconix-column-last' : '';

    $return = '<div class="arconix-column-two-thirds' . $last . '">' . remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 1/4 column
 *
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 * @uses clearfloat()       Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function one_fourth_arconix_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    $last = ( ( isset( $atts[0] ) && trim( $atts[0] == 'last' ) ) || $last != "" ) ? ' arconix-column-last' : '';

    $return = '<div class="arconix-column-one-fourth' . $last . '">' . remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 2/4 column
 *
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 * @uses clearfloat()       Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function two_fourths_arconix_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    $last = ( ( isset( $atts[0] ) && trim( $atts[0] == 'last' ) ) || $last != "" ) ? ' arconix-column-last' : '';

    $return = '<div class="arconix-column-two-fourths' . $last . '">' . remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 3/4 column
 *
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 * @uses clearfloat()       Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function three_fourths_arconix_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    $last = ( ( isset( $atts[0] ) && trim( $atts[0] == 'last' ) ) || $last != "" ) ? ' arconix-column-last' : '';

    $return = '<div class="arconix-column-three-fourths' . $last . '">' . remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 1/5 column
 *
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 * @uses clearfloat()       Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function one_fifth_arconix_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    $last = ( ( isset( $atts[0] ) && trim( $atts[0] == 'last' ) ) || $last != "" ) ? ' arconix-column-last' : '';

    $return = '<div class="arconix-column-one-fifth' . $last . '">' . remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 2/5 column
 *
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 * @uses clearfloat()       Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function two_fifths_arconix_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    $last = ( ( isset( $atts[0] ) && trim( $atts[0] == 'last' ) ) || $last != "" ) ? ' arconix-column-last' : '';

    $return = '<div class="arconix-column-two-fifths' . $last . '">' . remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 3/5 column
 *
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 * @uses clearfloat()       Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function three_fifths_arconix_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    $last = ( ( isset( $atts[0] ) && trim( $atts[0] == 'last' ) ) || $last != "" ) ? ' arconix-column-last' : '';

    $return = '<div class="arconix-column-three-fifths' . $last . '">' . remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 4/5 column
 *
 * @link Codex reference: shortcode_atts()
 * @link PHP reference: extract()
 *
 * @uses remove_wpautop()   Defined in this file
 * @uses clearfloat()       Defined in this file
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function four_fifths_arconix_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    $last = ( ( isset( $atts[0] ) && trim( $atts[0] == 'last' ) ) || $last != "" ) ? ' arconix-column-last' : '';

    $return = '<div class="arconix-column-four-fifths' . $last . '">' . remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

    /**
     * Remove automatic <p></p> and <br /> tags from content
     *
     * @link Codex reference: do_shortcode()
     * @link Codex reference: shortcode_unautop()
     * @link PHP reference: preg_replace()
     *
     * @param string $content
     * @return string
     *
     * @since 0.9
     */
    function remove_wpautop( $content ) {
        $content = do_shortcode( shortcode_unautop( $content ) );
        $content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );

        return $content;
    }

    /**
     * Properly clear our floats after the columns
     *
     * @param string $last
     * @return string
     *
     * @since 1.0.4
     * @version 1.1.0
     */
    function clearfloat( $last ) {
        if( ! $last )
            return;

       return '<div style="clear:both;"></div>';
    }
