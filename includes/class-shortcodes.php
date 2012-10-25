<?php
/**
 * This file contains the Arconix_Shortcodes class.
 *
 * This class handles the registration of the shortcodes, and loading
 * of the scripts necessary for its operation.
 */
class Arconix_Shortcodes {
    /**
     * Construct Method
     */
    function __construct() {

	add_action( 'init', array( $this , 'register_script' ) );
	add_action( 'wp_footer', array( $this , 'print_script' ) );

	add_action( 'wp_enqueue_scripts', array( $this , 'enqueue_css' ) );

        add_action( 'wp_dashboard_setup', array( $this, 'register_dashboard_widget' ) );

	add_action( 'init', array( $this, 'register_shortcodes' ) ) ;
	add_filter( 'widget_text', 'do_shortcode' );

    }

    /**
     * Register the necessary javascript, which can be overriden by creating your own file and
     * placing it in the root of your theme's folder
     *
     * @since 0.9
     * @version 1.0.3
     */
    function register_script() {

        wp_register_script( 'jquery-tools', 'http://cdn.jquerytools.org/1.2.7/tiny/jquery.tools.min.js', array( 'jquery' ), '1.2.7', true );

	if( file_exists( get_stylesheet_directory() . "/arconix-shortcodes.js" ) ) {
	    wp_register_script( 'arconix-shortcodes-js', get_stylesheet_directory_uri() . '/arconix-shortcodes.js', array( 'jquery-tools' ), ACS_VERSION, true );
	}
	elseif( file_exists( get_template_directory() . "/arconix-shortcodes.js" ) ) {
	    wp_register_script( 'arconix-shortcodes-js', get_template_directory_uri() . '/arconix-shortcodes.js', array( 'jquery-tools' ), ACS_VERSION, true );
	}
	else {
            wp_register_script( 'arconix-shortcodes-js', ACS_URL . 'includes/shortcodes.js', array( 'jquery-tools' ), ACS_VERSION, true );
	}
    }

    /**
     * This var is used in the shortcode to flag the loading of javascript
     * @var type boolean
     */
    static $load_js;

    /**
     * Check the state of the variable. If true, load the registered javascript
     *
     * @since 0.9.2
     * @version 1.0
     */
    function print_script() {

	if( ! self::$load_js )
	    return;

	wp_print_scripts( 'arconix-shortcodes-js' );
    }

    /**
     * Load the necessary css, which can be overriden by creating your own file and placing it in
     * the root of your theme's folder
     *
     * @since 0.9
     */
    function enqueue_css() {

	if( file_exists( get_stylesheet_directory() . "/arconix-shortcodes.css" ) ) {
	    wp_enqueue_style( 'arconix-shortcodes', get_stylesheet_directory_uri() . '/arconix-shortcodes.css', array(), ACS_VERSION );
	}
	elseif( file_exists( get_template_directory() . "/arconix-shortcodes.css" ) ) {
	    wp_enqueue_style( 'arconix-shortcodes', get_template_directory_uri() . '/arconix-shortcodes.css', array(), ACS_VERSION );
	}
	else {
            wp_enqueue_style( 'arconix-shortcodes', ACS_URL . 'includes/shortcodes.css', array(), ACS_VERSION );
	}
    }

    /**
     * Adds a news widget to the dashboard.
     *
     * @since 1.0
     */
    function register_dashboard_widget() {

        wp_add_dashboard_widget( 'ac-shortcodes', 'Arconix Shortcodes', array( $this, 'dashboard_widget_output' ) );
    }

    /**
     * Output for the dashboard widget
     *
     * @since 1.0
     */
    function dashboard_widget_output() {

        echo '<div class="rss-widget">';

        wp_widget_rss_output( array(
            'url' => 'http://arconixpc.com/tag/arconix-shortcodes/feed', // feed url
            'title' => 'Arconix Shortcodes News', // feed title
            'items' => 3, //how many posts to show
            'show_summary' => 1, // 1 = display excerpt
            'show_author' => 0, // 1 = display author
            'show_date' => 1 // 1 = display post date
        )); ?>

        <div class="acs-widget-bottom">
            <ul>
                <li><img src="<?php echo ACS_URL . 'images/admin/page-16x16.png'?>"><a href="http://arcnx.co/aswiki">Wiki Page</a></li>
                <li><img src="<?php echo ACS_URL . 'images/admin/help-16x16.png'?>"><a href="http://arcnx.co/ashelp">Support Forum</a></li>
            </ul>
        </div></div>

        <?php // handle the styling
        echo '<style type="text/css">
            #ac-shortcodes .rsssummary { display: block; }
            #ac-shortcodes .acs-widget-bottom { border-top: 1px solid #ddd; padding-top: 10px; text-align: center; }
            #ac-shortcodes .acs-widget-bottom ul { list-style: none; }
            #ac-shortcodes .acs-widget-bottom ul li { display: inline; padding-right: 9%; }
            #ac-shortcodes .acs-widget-bottom img { padding-right: 3px; vertical-align: top; }
        </style>';
    }

    /**
     * Register all the shortcodes
     *
     * @since 0.9
     * @version 1.0
     */
    function register_shortcodes() {

	/* Utility */
	add_shortcode( 'loginout-link', array( $this , 'loginout_link_shortcode' ) );
	add_shortcode( 'map', array( $this , 'googlemap_shortcode' ) );
	add_shortcode( 'site-link', array( $this , 'link_shortcode' ) );
	add_shortcode( 'the-year', array( $this , 'the_year_shortcode' ) );
	add_shortcode( 'wp-link', array( $this , 'wp_link_shortcode' ) );

	/* Typography */
	add_shortcode( 'abbr', array( $this , 'abbr_shortcode' ) );
	add_shortcode( 'highlight', array( $this , 'highlight_shortcode' ) );

	/* Styles */
	add_shortcode( 'accordions', array( $this , 'accordions_shortcode'), 90 );
	add_shortcode( 'accordion', array( $this , 'accordion_shortcode' ), 99 );
	add_shortcode( 'box', array( $this , 'box_shortcode' ) );
	add_shortcode( 'button', array( $this , 'button_shortcode' ) );
	add_shortcode( 'list', array( $this , 'list_shortcode' ) );
	add_shortcode( 'tabs', array( $this , 'tabs_shortcode' ), 90 );
	add_shortcode( 'tab', array( $this , 'tab_shortcode' ), 99 );
	add_shortcode( 'toggle', array( $this , 'toggle_shortcode' ) );

	/* Content Columns */
	/* = Two Columns */
	add_shortcode( 'one-half', array( $this , 'one_half_shortcode' ) );
	/* = Three Columns */
	add_shortcode( 'one-third', array( $this , 'one_third_shortcode' ) );
	add_shortcode( 'two-thirds', array( $this , 'two_thirds_shortcode' ) );
	/* = Four Columns */
	add_shortcode( 'one-fourth', array( $this , 'one_fourth_shortcode' ) );
	add_shortcode( 'two-fourths', array( $this , 'two_fourths_shortcode' ) );
	add_shortcode( 'three-fourths', array( $this , 'three_fourths_shortcode' ) );
	/* = Five Columns */
	add_shortcode( 'one-fifth', array( $this , 'one_fifth_shortcode' ) );
	add_shortcode( 'two-fifths', array( $this , 'two_fifths_shortcode' ) );
	add_shortcode( 'three-fifths', array( $this , 'three_fifths_shortcode' ) );
	add_shortcode( 'four-fifths', array( $this , 'four_fifths_shortcode' ) );
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
	if ( is_user_logged_in() )
	    $return = '<a class="arconix-logout-link" href="' . esc_url( wp_logout_url( site_url( $SERVER['REQUEST_URI'] ))) . '" title="' . esc_attr__( 'Log out of this site', $textdomain ) . '">' . __( 'Log out', $textdomain ) . '</a>';
	else
	    $return = '<a class="arconix-login-link" href="' . esc_url( wp_login_url( site_url( $SERVER['REQUEST_URI'] ))) . '" title="' . esc_attr__( 'Log in to this site', $textdomain ) . '">' . __( 'Log in', $textdomain ) . '</a>';

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

	$defaults = apply_filters( 'arconix_googlemap_shortcode_args',
	    array(
		'w' => '640',
		'h' => '400',
		'url' => ''
	    )
	);
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
	return '<span class="arconix-the-year">'. date( 'Y' ). '</span>';
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
    function abbr_shortcode ( $atts, $content = null ) {
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
     * @version 1.0.1
     */
    function accordions_shortcode( $atts, $content = null ) {
	self::$load_js = true;

	/*
	Supported Attributes
	    type	=>  vertical
	    load	=>  0, 1, 2, 3, 4, 5
	*/
	$defaults = apply_filters( 'arconix_accordions_shortcode_args',
	    array(
		'type' => 'vertical',
		'load' => '1',
		'css' => ''
	    )
	);
	extract( shortcode_atts( $defaults, $atts ) );

        if( $load == "none" ) $load = 0 ; // for backwards compatibility

	if ( $css != '' ) { $css = ' ' . $css; }

	return '<div class="arconix-accordions arconix-accordions-' . $type . ' arconix-accordions-'. $load . $css .'">'. self::remove_wpautop( $content ) . '</div>';
    }

    /**
     * Shortcode to produce jQuery-powered accordion
     *
     * @param type $atts
     * @param type $content
     * @return string
     *
     * @since 0.9
     */
    function accordion_shortcode( $atts, $content = null ) {
	$defaults = apply_filters( 'arconix_accordion_shortcode_args',
	    array(
		'title' => '',
		'last' => ''
	    )
	);
	extract( shortcode_atts( $defaults, $atts ) );

	if ( $last != '' ) { $last = ' arconix-accordion-last'; }

	$return = '<div class="arconix-accordion-title accordion-' . sanitize_title( $title ) . $last . '">' . $title . '</div>';
	$return .= '<div class="arconix-accordion-content' . $last . '">' . self::remove_wpautop( $content ) . '</div>';

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
     * @example [box style="comment"]my content[/box]
     */
    function box_shortcode( $atts, $content = null ) {
	/*
	Supported Attributes
	    style   =>  blue, green, grey, red, tan, yellow	-> creates boxes using only those colors
		OR
	    style   =>  alert, comment, download, info, tip	-> boxes with the corresponding icon to the left of the text
	*/
	$defaults = apply_filters( 'arconix_box_shortcode_args',
	    array(
		'style' => 'grey'
	    )
	);
	extract( shortcode_atts( $defaults, $atts ) );

	return '<div class="arconix-box arconix-box-'. $style .'">'. self::remove_wpautop( $content ) .'</div>';
    }

    /**
     * Shortcode to produce a styled button
     *
     * @param type $atts
     * @param type $content
     * @return type
     *
     * @since 0.9
     * @version 1.0.2
     */
    function button_shortcode( $atts, $content = null ) {
	/*
	Supported Attributes
	    size    =>  large, medium, small
	    color   =>  black, blue, green, grey, orange, pink, red, white
            target  =>  _self, _blank
	*/
	$defaults = apply_filters( 'arconix_button_shortcode_args',
	    array(
		'size' => 'medium',
		'color' => 'white',
		'url' => '#',
                'target' => '_self',
                'rel' => ''
	    )
	);
	extract( shortcode_atts( $defaults, $atts ) );

        switch ( $target ) {
            case "_blank":
            case "blank":
                $target = "_blank";
                break;
            case "_self":
            case "self":
            default:
                $target = "_self";
                break;
        }

        if( $rel ) $rel = ' rel="' . $rel . '"';

	return '<a target="' . $target . '" class="arconix-button arconix-button-'. $size .' arconix-button-'. $color .'" href="'. $url .'"' . $rel . '>'. $content .'</a>';
    }

    /**
     * Shortcode to highlight text
     *
     * @param type $atts
     * @param type $content
     * @return type
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

	return '<span class="arconix-highlight arconix-highlight-'. $color .'">' . do_shortcode( $content ) . '</span>';
    }

    /**
     * Shortcode outputs a styled unordered list
     *
     * @param type $atts
     * @param type $content
     * @return type
     *
     * @since 0.9
     * @example [list style="arrow-green"]unordered list here[/list]
     */
    function list_shortcode( $atts, $content = null ) {
	/*
	Supported Attributes
	    style   =>  arrow-black, arrow-blue, arrow-green, arrow-grey, arrow-orange, arrow-pink, arrow-red, arrow-white, check, close, star
	*/

	$defaults = apply_filters( 'arconix_list_shortcode_args', array( 'style' => 'arrow-white' ) );

	extract( shortcode_atts( $defaults, $atts ) );

	return '<div class="arconix-list arconix-list-' . $style . '">' . self::remove_wpautop( $content ) . '</div>';
    }

    /**
     * Shortcode to produce a jQuery-powered tabbed group
     *
     * @param type $atts
     * @param type $content
     * @return string
     *
     * @since 0.9
     * @version 1.0.3
     */
    function tabs_shortcode( $atts, $content = null ) {
        /*
	Supported Attributes
	    style   =>  horizontal
            id      =>  name, number
         */
	self::$load_js = true;

	$defaults = apply_filters( 'arconix_tabs_shortcode_args',
	    array(
		'style' => 'horizontal',
                'id' => 'name',
		'css' => ''
	    )
	);
	extract( shortcode_atts( $defaults, $atts ) );

	if ( $css != '' ) { $css = ' ' . $css; }

	$GLOBALS['tab_count'] = 0;
        $tabid = 0;

	do_shortcode( $content );

	if( is_array($GLOBALS['tabs'] ) ) {
	    foreach ($GLOBALS['tabs'] as $tab) {

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

		$tabs[] = '<li class="arconix-tab tab-'. sanitize_title( $tab['title'] ). '"><a class="" href="#tab-' . $tabid . '">' . $tab['title'] . '</a></li>';
		$panes[] = '<div class="arconix-pane pane-' . sanitize_title( $tab['title'] ) .'">' . self::remove_wpautop( $tab['content'] ) . '</div>';
	    }
	    $return = "\n" . '<div class="arconix-tabs-'. $style . $css .'"><ul class="arconix-tabs">' . implode("\n", $tabs) . '</ul>' . "\n" . '<div class="arconix-panes">' . implode("\n", $panes) . '</div></div>' . "\n";
	}

	/** Reset the variables in the event we use multiple tabs on single page*/
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
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

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
     * @version 0.9.2
     */
    function toggle_shortcode( $atts, $content = null ) {
	self::$load_js = true;

	$defaults = apply_filters( 'arconix_toggle_shortcode_args',
	    array(
		'title' => '',
		'css' => ''
	    )
	);
	extract( shortcode_atts( $defaults, $atts ) );

	$return = '<div class="arconix-toggle-wrap"><div class="arconix-toggle-title">'. $title .'</div><div class="arconix-toggle-content">'. self::remove_wpautop( $content ) .'</div></div>';
	$css_start = '<div class="'. $css . '">';
	$css_end = '</div>';

	if( $css ) $return = $css_start . $return . $css_end;

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
     * @version 1.0.4
     */
    function one_half_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' arconix-column-last'; }

	$return = '<div class="arconix-column-one-half'. $last .'">'. self::remove_wpautop( $content ) . '</div>';

	$float = self::clearfloat( $last );
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
     * @version 1.0.4
     */
    function one_third_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' arconix-column-last'; }

	$return = '<div class="arconix-column-one-third'. $last .'">'. self::remove_wpautop( $content ) . '</div>';

	$float = self::clearfloat( $last );
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
     * @version 1.0.4
     */
    function two_thirds_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' arconix-column-last'; }

	$return = '<div class="arconix-column-two-thirds'. $last .'">'. self::remove_wpautop( $content ) . '</div>';

	$float = self::clearfloat( $last );
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
     * @version 1.0.4
     */
    function one_fourth_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' arconix-column-last'; }

	$return = '<div class="arconix-column-one-fourth'. $last .'">'. self::remove_wpautop( $content ) . '</div>';

	$float = self::clearfloat( $last );
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
     * @version 1.0.4
     */
    function two_fourths_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' arconix-column-last'; }

	$return = '<div class="arconix-column-two-fourths'. $last .'">'. self::remove_wpautop( $content ) . '</div>';

	$float = self::clearfloat( $last );
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
     * @version 1.0.4
     */
    function three_fourths_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' arconix-column-last'; }

	$return = '<div class="arconix-column-three-fourths'. $last .'">'. self::remove_wpautop( $content ) . '</div>';

	$float = self::clearfloat( $last );
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
     * @version 1.0.4
     */
    function one_fifth_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' arconix-column-last'; }

	$return = '<div class="arconix-column-one-fifth'. $last .'">'. self::remove_wpautop( $content ) . '</div>';

	$float = self::clearfloat( $last );
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
     * @version 1.0.4
     */
    function two_fifths_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' arconix-column-last'; }

	$return = '<div class="arconix-column-two-fifths'. $last .'">'. self::remove_wpautop( $content ) . '</div>';

	$float = self::clearfloat( $last );
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
     * @version 1.0.4
     */
    function three_fifths_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' arconix-column-last'; }

	$return = '<div class="arconix-column-three-fifths'. $last .'">'. self::remove_wpautop( $content ) . '</div>';

	$float = self::clearfloat( $last );
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
     * @version 1.0.4
     */
    function four_fifths_shortcode( $atts, $content ) {
	extract( shortcode_atts( array( 'last' => '' ), $atts ) );

	if ( $last != '' ) { $last = ' arconix-column-last'; }

	$return = '<div class="arconix-column-four-fifths'. $last .'">'. self::remove_wpautop( $content ) . '</div>';

	$float = self::clearfloat( $last );
	$return .= $float;

	return $return;
    }



    /******************************************************
     *  Helper Functions
     ******************************************************/

    /**
     * Remove automatic <p></p> and <br /> tags from content
     *
     * @param type $content
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
     */
    function clearfloat( $last ) {
	$return = '';

	if( $last ) $return = '<div style="clear:both;"></div>';

	return $return;
    }

}
?>