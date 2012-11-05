<?php

/**
 * Register the necessary javascript, which can be overriden by creating your own file and
 * placing it in the root of your theme's folder
 *
 * @since 0.9
 * @version 1.1.0
 */
function register_script() {
    /* Provide script registration args so they can be filtered if necessary */
    $script_args = apply_filters( 'arconix_jquerytools_reg', array(
        'url' => 'http://cdn.jquerytools.org/1.2.7/tiny/jquery.tools.min.js',
        'ver' => '1.2.7',
        'dep' => 'jquery'
    ) );

    wp_register_script( 'jquery-tools', $script_args['url'], array( $script_args['dep'] ), $script_args['ver'], true );

    if( file_exists( get_stylesheet_directory() . '/arconix-shortcodes.js' ) ) {
        wp_register_script( 'arconix-shortcodes-js', get_stylesheet_directory_uri() . '/arconix-shortcodes.js', array( 'jquery-tools' ), ACS_VERSION, true );
    } elseif( file_exists( get_template_directory() . '/arconix-shortcodes.js' ) ) {
        wp_register_script( 'arconix-shortcodes-js', get_template_directory_uri() . '/arconix-shortcodes.js', array( 'jquery-tools' ), ACS_VERSION, true );
    } else {
        wp_register_script( 'arconix-shortcodes-js', ACS_INCLUDES_URL . 'shortcodes.js', array( 'jquery-tools' ), ACS_VERSION, true );
    }
}

/**
 * Load the necessary css, which can be overriden by creating your own file and placing it in
 * the root of your theme's folder
 *
 * @since 0.9
 * @version 1.1.0
 */
function enqueue_css() {
    if( file_exists( get_stylesheet_directory() . '/arconix-shortcodes.css' ) ) {
        wp_enqueue_style( 'arconix-shortcodes', get_stylesheet_directory_uri() . '/arconix-shortcodes.css', array(), ACS_VERSION );
    } elseif( file_exists( get_template_directory() . '/arconix-shortcodes.css' ) ) {
        wp_enqueue_style( 'arconix-shortcodes', get_template_directory_uri() . '/arconix-shortcodes.css', array(), ACS_VERSION );
    } else {
        wp_enqueue_style( 'arconix-shortcodes', ACS_INCLUDES_URL . 'shortcodes.css', array(), ACS_VERSION );
    }
}

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

    if( $last )
        $return = '<div style="clear:both;"></div>';

    return $return;
}
?>