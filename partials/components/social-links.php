<?php
/**
 * Social Links.
 *
 * Displays the social links/icons populated in the theme settings.
 *
 * @package WordPress
 * @since 1.0
 */

$facebook 		= get_option( 'options_facebook' );
$twitter 		= get_option( 'options_twitter' );
$instagram 		= get_option( 'options_instagram' );
$linkedin 		= get_option( 'options_linkedin' );
$youtube 		= get_option( 'options_youtube' );

$socials = array(
	'facebook' 	=> array( 'link' => $facebook, 'name' => 'Facebook' ),
	'twitter' 	=> array( 'link' => $twitter, 'name' => 'Twitter' ),
	'instagram' => array( 'link' => $instagram, 'name' => 'Instagram' ),
	'linkedin' 	=> array( 'link' => $linkedin, 'name' => 'LinkedIn' ),
	'youtube' 	=> array( 'link' => $youtube, 'name' => 'YouTube' ),
);

$show_names = ( $atts['show_names'] == 'true' ) ? true : false;
$social_links_class = ( $show_names ) ? ' social-links--show-names' : null;
?>

<ul class="social-links<?php echo $social_links_class; ?>">

	<?php foreach ( $socials as $key => $value ) : ?>

		<?php if ( ! empty( $value['link'] ) ) : ?>

			<li class="social-link">
				<a href="<?php echo $value['link']; ?>" target="_blank">
					<i class="social-link__icon" data-feather="<?php echo $key; ?>"></i>
					<?php if ( $show_names ) : ?>
						<span class="social-link__name"><?php echo $value['name']; ?></span>
					<?php endif; ?>
				</a>
			</li>

		<?php endif; ?>

	<?php endforeach; ?>

</ul><!-- .social-links -->
