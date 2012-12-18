<?php
/**
 * Register the necessary javascript, which can be overridden in up to 2 different ways.
 * If you'd like to use a different version of the jQuery Tools script {@link http://jquerytools.org/download/}
 * you can add a filter that overrides the the url, version and dependency.
 * If you'd like to modify the javascript that is used by the shortcodes, you can copy the shortcodes.js
 * file to the root of your theme's folder and rename it to arconix-shortcodes.js. That will be loaded
 * in place of the plugin's version, which means you can modify it to your heart's content and know
 * the file will be safe when the plugin is updated in the future.
 *
 * @link Codex reference: apply_filters()
 * @link Codex reference: wp_register_script()
 * @link Codex reference: get_stylesheet_directory()
 * @link Codex reference: get_stylesheet_directory_uri()
 * @link Codex reference: get_template_directory()
 * @link Codex reference: get_template_directory_uri()
 * @link Codex reference: wp_enqueue_style()
 *
 * @see ACS_INCLUDES_URL    Defined in /plugin.php
 * @see ACS_CSS_URL         Defined in /plugin.php
 * @see ACS_VERSION         Defined in /plugin.php
 *
 * @since 0.9
 * @version 1.1.0
 */
function acs_load_scripts() {
    /* Provide script registration args so they can be filtered if necessary */
    $script_args = apply_filters( 'arconix_jquerytools_reg', array(
        'url' => 'http://cdn.jquerytools.org/1.2.7/tiny/jquery.tools.min.js',
        'ver' => '1.2.7',
        'dep' => 'jquery'
    ) );

    wp_register_script( 'jquery-tools', esc_url( $script_args['url'] ), array( $script_args['dep'] ), $script_args['ver'], true );

    /* Register the javascript - Check the theme directory first, the parent theme (if applicable) second, otherwise load the plugin file */
    if( file_exists( get_stylesheet_directory() . '/arconix-shortcodes.js' ) )
        wp_register_script( 'arconix-shortcodes-js', get_stylesheet_directory_uri() . '/arconix-shortcodes.js', array( 'jquery-tools' ), ACS_VERSION, true );
    elseif( file_exists( get_template_directory() . '/arconix-shortcodes.js' ) )
        wp_register_script( 'arconix-shortcodes-js', get_template_directory_uri() . '/arconix-shortcodes.js', array( 'jquery-tools' ), ACS_VERSION, true );
    else
        wp_register_script( 'arconix-shortcodes-js', ACS_INCLUDES_URL . 'shortcodes.js', array( 'jquery-tools' ), ACS_VERSION, true );

    /* Load the CSS - Check the theme directory first, the parent theme (if applicable) second, otherwise load the plugin file */
    if( file_exists( get_stylesheet_directory() . '/arconix-shortcodes.css' ) )
        wp_enqueue_style( 'arconix-shortcodes', get_stylesheet_directory_uri() . '/arconix-shortcodes.css', false, ACS_VERSION );
    elseif( file_exists( get_template_directory() . '/arconix-shortcodes.css' ) )
        wp_enqueue_style( 'arconix-shortcodes', get_template_directory_uri() . '/arconix-shortcodes.css', false, ACS_VERSION );
    else
        wp_enqueue_style( 'arconix-shortcodes', ACS_CSS_URL . 'shortcodes.css', false, ACS_VERSION );
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
?>