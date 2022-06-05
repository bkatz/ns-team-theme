<?php
/**
 * This file modifies/removes the default WordPress functionality
 *
 * @package WordPress
 * @since 1.0
 */

/**
 * Disable the visual editor
 */
// add_filter( 'user_can_richedit' , '__return_false', 50 );

/**
 * Hide the admin bar on front end.
 */
add_filter( 'show_admin_bar', '__return_false' );

/**
 * Disable the Gutenberg editor
 */
add_filter('use_block_editor_for_post', '__return_false', 10);

/**
 * Allow shortcodes in text widgets.
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Add thumbnail support.
 */
add_theme_support( 'post-thumbnails' );

/**
 * Add HTML5 Search compatibility.
 */
function wpst_after_setup_theme() {
    add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'wpst_after_setup_theme' );

/**
 * Set the default editor to the text editor.
 */
function wpst_default_editor() {
    $editor = 'html'; // html or tinymce
    return $editor;
}
add_filter( 'wp_default_editor', 'wpst_default_editor' );

/**
 * Remove the version number from files.
 */
function wpst_remove_wp_version_strings( $src ) {
     global $wp_version;
     parse_str(parse_url($src, PHP_URL_QUERY), $query);
     if ( !empty($query['ver']) && $query['ver'] === $wp_version ) {
          $src = remove_query_arg('ver', $src);
     }
     return $src;
}
add_filter( 'script_loader_src', 'wpst_remove_wp_version_strings' );
add_filter( 'style_loader_src', 'wpst_remove_wp_version_strings' );

/**
 * Remove WordPress versions from meta
 */
function wpst_remove_version() {
return '';
}
add_filter('the_generator', 'wpst_remove_version');
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );

/**
 * Remove Emoji scripts
 */
function wpst_disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'wpst_disable_emojicons_tinymce' );
}
add_action( 'init', 'wpst_disable_wp_emojicons' );

function wpst_disable_emojicons_tinymce( $plugins ) {

    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
    return array();
    }

}

/**
 * Modify the default body classes.
 */
function wpst_add_slug_body_class( $wp_classes, $classes ) {

    global $post;
    global $template;

    if ( isset( $post ) ) :

        // Post Classes.
        if ( is_single() ) :
            // $classes[] = 'post';
            $classes[] = 'single';
            $classes[] = 'single--' . $post->post_type;
        endif;

        // Page Classes.
        if ( is_page() ) :
            $page_template = basename( $template, '.php' );
            $classes[] = 'page';
            $classes[] = 'page--' . $post->post_name;
            $classes[] = $page_template;
        endif;

        if ( is_search() ) :
            $classes[] = 'page';
            $classes[] = 'search';
        endif;

        if ( is_home() ) :
            $classes[] = 'page';
            $classes[] = 'index';
            $classes[] = 'blog';
        endif;

        if ( is_front_page() ) :
            $classes[] = 'page';
        endif;

        if( is_archive() ) :
            $cat = get_category( get_query_var( 'cat' ) );
            $classes[] = 'page';
            $classes[] = 'archive';
            if ( ! is_wp_error( $cat ) ) :
                $classes[] = 'archive--' . $cat->slug;
            endif;
        endif;

    endif;

    if ( is_404() ) :
        $classes[] = 'page';
        $classes[] = 'page--404';
    endif;

    $wp_classes = array_intersect( $wp_classes, $classes );
    return array_merge( $wp_classes, (array) $classes );

}
add_filter( 'body_class', 'wpst_add_slug_body_class', 10, 2 );

/**
 * Add browser name to body classes.
 */
function wpst_browser_classes($classes)
{
    // the list of WordPress global browser checks
    // https://codex.wordpress.org/Global_Variables#Browser_Detection_Booleans
    $browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];

    // check the globals to see if the browser is in there and return a string with the match
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));

    return $classes;

}
// call the filter for the body class
add_filter('body_class', 'wpst_browser_classes');

/**
 * CHANGE DEFAULT FOOTER TEXT
 */
function wpst_footer_admin() {
  echo '<span style="text-transform: uppercase; font-size: 0.85em; letter-spacing: 0.2em;">Theme developed by <a style="text-decoration: none;font-weight: bold; color:#555;" target="_blank" href="https://bkcreative.co">BKCreative</a></span>';
}
add_filter( 'admin_footer_text', 'wpst_footer_admin' );

/**
 * Add widget title to widget class name.
 */
function add_widget_title_to_widget_class( $instance, $widget_class, $args ) {
    if ( ! empty( $instance['title'] ) ) {
        $new_class = 'class="widget--' . sanitize_title( $instance['title'] ) . ' ';
        $args['before_widget'] = str_replace('class="', $new_class, $args['before_widget']);
    }
    $widget_class->widget( $args, $instance );
    return false;
}
add_filter( 'widget_display_callback', 'add_widget_title_to_widget_class', 10, 3 );

/**
 * Redirect Specific Post Types
 *
 * This function will disable the individual posts
 * from being viewed.
 */
function wpst_single_redirect() {

    $redirect_post_type = array( 'post_type_name' );
    if ( is_singular( $redirect_post_type ) ) :
        wp_redirect( home_url() );
        exit();
    endif;

}
// add_action( 'template_redirect', 'wpst_single_redirect' );

/**
 * Allow SVG files via Media Uploader
 */
function wpst_svg_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'wpst_svg_mime_types' );

function wpst_show_svg_in_media_library() {
    $css = '';
    $css = 'table.media .column-title .media-icon img[src$=".svg"] { width: 60px !important; height: auto !important; }';
    echo '<style type="text/css">' . $css . '</style>';
}
add_action( 'admin_head', 'wpst_show_svg_in_media_library' );

/**
 * Filter search results
 *
 * Filters the search results to show only specific post types.
 *
 */
function filter_search_results( $query ) {

    if ( $query->is_search ) {
        $query->set( 'post_type',array( 'post', 'page' ) );
    }
    return $query;

}
// add_filter( 'pre_get_posts','filter_search_results' );


/**
 * Change login logo URL to site URL.
 */
function wpst_login_logo(){
    return esc_url( site_url() );
}
add_filter('login_headerurl', 'wpst_login_logo');