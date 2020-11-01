<?php
/**
 * Theme Shortcodes
 *
 * Contains the shortcodes for use with the theme.
 *
 * @package WordPress
 * @since 1.0
 */

/**
 * Theme images
 *
 * Generates the URL to theme images directory.
 *
 * @package WordPress
 * @since 1.0
 */
function theme_image_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
		),
		$atts, 'theme_image'
	);

	return THEME_URL . '/assets/img/';
}
add_shortcode( 'theme_image', 'theme_image_shortcode' );


/**
 * Reveal
 *
 * Generates the HTML for a reveal box.
 *
 * @package WordPress
 * @since 1.0
 */
function reveal_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
		),
		$atts, 'reveal'
	);

	ob_start();
	?>

	<div class="reveal">
		<?php echo $content; ?>
		<p class="reveal__button"><a href="#">Show More</a></p>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'reveal', 'reveal_shortcode' );


/**
 * Social Links
 *
 * Generates the social icons list.
 *
 * @package WordPress
 * @since 1.0
 */
function wpst_social_links_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'show_names' => '',
		),
		$atts, 'social_links'
	);

	ob_start();
	include( locate_template( 'partials/components/social-links.php' ) );
	return ob_get_clean();

}
add_shortcode( 'social_links', 'wpst_social_links_shortcode' );
