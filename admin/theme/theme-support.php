<?php
/**
 * Theme functions
 *
 * Provides additional theme functionality.
 *
 * @package WordPress
 * @since 1.0
 */

/**
 * Set default carousel settings.
 */
function get_carousel_settings($post_id) {

	// Set defaults.
	$carousel_settings = [
		'autoplay' => 0,
		'autoplaySpeed' => 5500,
	];

	$autoplay = get_sub_field('settings_autoplay', $post_id);
	$autoplay_speed = get_sub_field('settings_autoplay_speed', $post_id);

	if ( $autoplay ) :
		$carousel_settings['autoplay'] = $autoplay;
	endif;

	if ( $autoplay_speed ) :
		$carousel_settings['autoplaySpeed'] = $autoplay_speed;
	endif;

	return $carousel_settings;

}

/**
 * Show Pagination.
 * Displays the post pagination.
 */
function show_pagination() {
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total' => $wp_query->max_num_pages,
		'prev_text'          => __('<i data-feather="arrow-left"></i>'),
		'next_text'          => __('<i data-feather="arrow-right"></i>'),
	) );
}

/**
 * Get Video ID.
 * Extracts Video ID from YouTube or Vimeo url.
 */
function get_video_ID($url) {

    if ( preg_match('#(?:https?://)?(?:www.)?(?:player.)?vimeo.com/(?:[a-z]*/)*([0-9]{6,11})[?]?.*#', $url, $m) ) :
        return $m[1];
    endif;

	if( preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $m) ) :
		return $m[1];
	endif;

    return false;

}

/**
 * Get Video Provider.
 * Extracts the provider from YouTube or Vimeo url.
 */
function get_video_provider($url) {

    if ( preg_match('#(?:https?://)?(?:www.)?(?:player.)?vimeo.com/(?:[a-z]*/)*([0-9]{6,11})[?]?.*#', $url, $m)) :
        return 'vimeo';
    endif;

	if( preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $m) ) :
		return 'youtube';
	endif;

    return false;

}