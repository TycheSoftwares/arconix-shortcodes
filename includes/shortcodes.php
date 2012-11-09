<?php
/**
 * Register all the shortcodes
 *
 * @since 0.9
 * @version 1.1.0
 */
function register_shortcodes() {
    /* List all shortcodes in an array to run through compatibility check */
    $shortcodes = array(
        'loginout', 'map', 'site-link', 'the-year', 'wp-link',
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
    );
    
    /* Check for defined var and add prefix for compatibility mode */
    if( defined( 'ACS_COMPAT' ) ) {
        $_prefix = 'ac-';
    }
    else {
        $_prefix = '';
    }
    
    /* Loop through each shortcode */
    foreach( (array) $shortcodes as $shortcode ) {
        add_shortcode( 
            $_prefix . $shortcode, 
            str_replace( '-', '_', $shortcode )  . '_shortcode' 
        );        
    }    
}

/**
 * Shortcode to display a login link or logout link.
 *
 * @return string
 *
 * @since 0.9
 */
function loginout_shortcode() {
    $textdomain = 'arconix-shortcodes';
    if( is_user_logged_in() )
        $return = '<a class="arconix-logout-link" href="' . esc_url( wp_logout_url( site_url( $SERVER['REQUEST_URI'] ) ) ) . '" title="' . esc_attr__( 'Log out of this site', $textdomain ) . '">' . __( 'Log out', $textdomain ) . '</a>';
    else
        $return = '<a class="arconix-login-link" href="' . esc_url( wp_login_url( site_url( $SERVER['REQUEST_URI'] ) ) ) . '" title="' . esc_attr__( 'Log in to this site', $textdomain ) . '">' . __( 'Log in', $textdomain ) . '</a>';

    return $return;
}

/**
 * Shortcode a Google Map based on the URL provided
 *
 * @param type $atts
 * @return type
 *
 * @since 0.9
 * @example [map w="640" h="400" url="htp://..."]
 */
function googlemap_shortcode( $atts ) {

    $defaults = apply_filters( 'arconix_googlemap_shortcode_args', array(
        'w' => '640',
        'h' => '400',
        'url' => ''
    ) );
    extract( shortcode_atts( $defaults, $atts ) );

    return '<iframe width="' . $w . '" height="' . $h . '" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . $url . '&amp;output=embed"></iframe>';
}

/**
 * Shortcode to display a link back to the site.
 *
 * @since   0.9
 */
function site_link_shortcode() {
    return '<a class="arconix-site-link" href="' . home_url() . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home"><span>' . get_bloginfo( 'name' ) . '</span></a>';
}

/**
 * Shortcode to display the current 4-digit year.
 *
 * @since   0.9
 */
function the_year_shortcode() {
    return '<span class="arconix-the-year">' . date( 'Y' ) . '</span>';
}

/**
 * Shortcode to return a link to WordPress.org.
 *
 * @since   0.9
 */
function wp_link_shortcode() {
    return '<a class="arconix-wp-link" href="http://wordpress.org" title="' . esc_attr__( 'This site is powered by WordPress', 'arconix-shortcodes' ) . '"><span>' . __( 'WordPress', 'arconix-shortcodes' ) . '</span></a>';
}

/**
 * Shortcode to handle abbreviations
 *
 * @param type $atts
 * @param type $content
 * @return type
 *
 * @since 0.9
 */
function abbr_shortcode( $atts, $content = null ) {
    $defaults = apply_filters( 'arconix_abbr_shortcode_args', array( 'title' => '' ) );
    extract( shortcode_atts( $defaults, $atts ) );

    return '<abbr class="arconix-abbr" title="' . $title . '">' . $content . '</abbr>';
}

/**
 * Shortcode to produce jQuery-powered accordion group
 *
 * @param type $atts
 * @param type $content
 * @return type
 *
 * @since 0.9
 * @version 1.1.0
 */
function accordions_shortcode( $atts, $content = null ) {
    wp_enqueue_script( 'jquery-tools' );

    /*
      Supported Attributes
      type	=>  vertical
      load	=>  0, 1, 2, 3, 4, 5
     */
    $defaults = apply_filters( 'arconix_accordions_shortcode_args', array(
        'type' => 'vertical',
        'load' => '1',
        'css' => ''
    ) );
    extract( shortcode_atts( $defaults, $atts ) );

    if( $load == "none" )
        $load = 0; // for backwards compatibility

    if( $css != '' )
        $css = ' ' . $css;

    return '<div class="arconix-accordions arconix-accordions-' . $type . ' arconix-accordions-' . $load . $css . '">' . remove_wpautop( $content ) . '</div>';
}

/**
 * Shortcode to produce jQuery-powered accordion
 *
 * @param type $atts
 * @param type $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function accordion_shortcode( $atts, $content = null ) {
    $defaults = apply_filters( 'arconix_accordion_shortcode_args', array(
        'title' => '',
        'last' => ''
    ) );
    extract( shortcode_atts( $defaults, $atts ) );

    if( $last != '' )
        $last = ' arconix-accordion-last';

    $return = '<div class="arconix-accordion-title accordion-' . sanitize_title( $title ) . $last . '">' . $title . '</div>';
    $return .= '<div class="arconix-accordion-content' . $last . '">' . remove_wpautop( $content ) . '</div>';

    return $return;
}

/**
 * Shortcode to produce a styled box
 *
 * @param type $atts
 * @param type $content
 * @return type
 *
 * @since 0.9
 * @version 1.1.0
 * @example [box style="comment"]my content[/box]
 */
function box_shortcode( $atts, $content = null ) {
    /*
      Supported Attributes
      style   =>  blue, green, grey, red, tan, yellow	-> creates boxes using only those colors
      OR
      style   =>  alert, comment, download, info, tip	-> boxes with the corresponding icon to the left of the text
     */
    $defaults = apply_filters( 'arconix_box_shortcode_args', array(
        'style' => 'grey'
    ) );
    extract( shortcode_atts( $defaults, $atts ) );

    return '<div class="arconix-box arconix-box-' . $style . '">' . remove_wpautop( $content ) . '</div>';
}

/**
 * Shortcode to produce a styled button
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function button_shortcode( $atts, $content ) {
    /*
      Supported Attributes
      size    =>  large, medium, small
      color   =>  black, blue, green, grey, orange, pink, red, white
      target  =>  {nothing}, _blank
     */
    $defaults = apply_filters( 'arconix_button_shortcode_args', array(
        'size' => 'medium',
        'color' => 'white',
        'url' => '#',
        'target' => '',
        'rel' => ''
    ) );
    extract( shortcode_atts( $defaults, $atts ) );

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
        $rel = ' rel="' . $rel . '"';

    return '<a' . $target . '"class="arconix-button arconix-button-' . $size . ' arconix-button-' . $color . '" href="' . esc_url( $url ) . '"' . $rel . '>' . $content . '</a>';
}

/**
 * Shortcode to highlight text
 *
 * @param array $atts
 * @param string $content
 * @return string
 *
 * @since 0.9
 * @example [highlight]my content[/highlight]
 */
function highlight_shortcode( $atts, $content = null ) {
    /*
      Supported Attributes
      color   =>  yellow
     */
    $defaults = apply_filters( 'arconix_highlight_shortcode_args', array( 'color' => 'yellow' ) );

    extract( shortcode_atts( $defaults, $atts ) );

    return '<span class="arconix-highlight arconix-highlight-' . $color . '">' . do_shortcode( $content ) . '</span>';
}

/**
 * Shortcode outputs a styled unordered list
 *
 * @param type $atts
 * @param type $content
 * @return type
 *
 * @since 0.9
 * @version 1.1.0
 * @example [list style="arrow-green"]unordered list here[/list]
 */
function list_shortcode( $atts, $content = null ) {
    /*
      Supported Attributes
      style   =>  arrow-black, arrow-blue, arrow-green, arrow-grey, arrow-orange, arrow-pink, arrow-red, arrow-white, check, close, star
     */

    $defaults = apply_filters( 'arconix_list_shortcode_args', array( 'style' => 'arrow-white' ) );

    extract( shortcode_atts( $defaults, $atts ) );

    return '<div class="arconix-list arconix-list-' . $style . '">' . remove_wpautop( $content ) . '</div>';
}

/**
 * Shortcode to produce a jQuery-powered tabbed group
 *
 * @param type $atts
 * @param type $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function tabs_shortcode( $atts, $content = null ) {
    /*
      Supported Attributes
      style   =>  horizontal
      id      =>  name, number
     */
    wp_enqueue_script( 'jquery-tools' );

    $defaults = apply_filters( 'arconix_tabs_shortcode_args', array(
        'style' => 'horizontal',
        'id' => 'name',
        'css' => ''
    ) );
    extract( shortcode_atts( $defaults, $atts ) );

    if( $css != '' )
        $css = ' ' . $css;

    $GLOBALS['tab_count'] = 0;
    $tabid = 0;

    do_shortcode( $content );

    if( is_array( $GLOBALS['tabs'] ) ) {
        foreach( $GLOBALS['tabs'] as $tab ) {

            // set up tabid based on the id defined above
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
        $return = "\n" . '<div class="arconix-tabs-' . $style . $css . '"><ul class="arconix-tabs">' . implode( "\n", $tabs ) . '</ul>' . "\n" . '<div class="arconix-panes">' . implode( "\n", $panes ) . '</div></div>' . "\n";
    }

    /** Reset the variables in the event we use multiple tabs on single page */
    $GLOBALS['tabs'] = '';
    $GLOBALS['tab_count'] = 0;

    return $return;
}

/**
 * Shortcode to produce a jQuery-powered tab as part of a tabbed group
 *
 * @param type $atts
 * @param type $content
 *
 * @since 0.9
 */
function tab_shortcode( $atts, $content = null ) {
    $defaults = apply_filters( 'arconix_tab_shortcode_args', array( 'title' => 'Tab' ) );
    extract( shortcode_atts( $defaults, $atts ) );

    $x = $GLOBALS['tab_count'];
    $GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' => $content );

    $GLOBALS['tab_count']++;
}

/**
 * Shortcode to produce a jQuery-powered toggle-box
 *
 * @param type $atts
 * @param type $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function toggle_shortcode( $atts, $content = null ) {
    wp_enqueue_script( 'jquery-tools' );

    $defaults = apply_filters( 'arconix_toggle_shortcode_args', array(
        'title' => '',
        'css' => ''
    ) );
    extract( shortcode_atts( $defaults, $atts ) );

    $return = '<div class="arconix-toggle-wrap"><div class="arconix-toggle-title">' . $title . '</div><div class="arconix-toggle-content">' . remove_wpautop( $content ) . '</div></div>';
    $css_start = '<div class="' . $css . '">';
    $css_end = '</div>';

    if( $css )
        $return = $css_start . $return . $css_end;

    return $return;
}

/**
 * Shortcode to display a 1/2 column
 *
 * @param type $atts
 * @param type $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function one_half_shortcode( $atts, $content ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    if( $last != '' ) {
        $last = ' arconix-column-last';
    }

    $return = '<div class="arconix-column-one-half' . $last . '">' . remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 1/3 column
 *
 * @param type $atts
 * @param type $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function one_third_shortcode( $atts, $content ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    if( $last != '' ) {
        $last = ' arconix-column-last';
    }

    $return = '<div class="arconix-column-one-third' . $last . '">' . remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 2/3 column
 *
 * @param type $atts
 * @param type $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function two_thirds_shortcode( $atts, $content ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    if( $last != '' ) {
        $last = ' arconix-column-last';
    }

    $return = '<div class="arconix-column-two-thirds' . $last . '">' . remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 1/4 column
 *
 * @param type $atts
 * @param type $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function one_fourth_shortcode( $atts, $content ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    if( $last != '' ) {
        $last = ' arconix-column-last';
    }

    $return = '<div class="arconix-column-one-fourth' . $last . '">' . self::remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 2/4 column
 *
 * @param type $atts
 * @param type $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function two_fourths_shortcode( $atts, $content ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    if( $last != '' ) {
        $last = ' arconix-column-last';
    }

    $return = '<div class="arconix-column-two-fourths' . $last . '">' . self::remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 3/4 column
 *
 * @param type $atts
 * @param type $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function three_fourths_shortcode( $atts, $content ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    if( $last != '' ) {
        $last = ' arconix-column-last';
    }

    $return = '<div class="arconix-column-three-fourths' . $last . '">' . self::remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 1/5 column
 *
 * @param type $atts
 * @param type $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function one_fifth_shortcode( $atts, $content ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    if( $last != '' ) {
        $last = ' arconix-column-last';
    }

    $return = '<div class="arconix-column-one-fifth' . $last . '">' . self::remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 2/5 column
 *
 * @param type $atts
 * @param type $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function two_fifths_shortcode( $atts, $content ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    if( $last != '' ) {
        $last = ' arconix-column-last';
    }

    $return = '<div class="arconix-column-two-fifths' . $last . '">' . self::remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 3/5 column
 *
 * @param type $atts
 * @param type $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function three_fifths_shortcode( $atts, $content ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    if( $last != '' ) {
        $last = ' arconix-column-last';
    }

    $return = '<div class="arconix-column-three-fifths' . $last . '">' . self::remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

/**
 * Shortcode to display a 4/5 column
 *
 * @param type $atts
 * @param type $content
 * @return string
 *
 * @since 0.9
 * @version 1.1.0
 */
function four_fifths_shortcode( $atts, $content ) {
    extract( shortcode_atts( array( 'last' => '' ), $atts ) );

    if( $last != '' ) {
        $last = ' arconix-column-last';
    }

    $return = '<div class="arconix-column-four-fifths' . $last . '">' . self::remove_wpautop( $content ) . '</div>';

    $float = clearfloat( $last );
    $return .= $float;

    return $return;
}

?>