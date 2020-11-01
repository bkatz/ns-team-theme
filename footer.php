<?php
/**
 * Footer
 *
 * This file generates the footer output
 *
 * @package WordPress
 * @since 1.0
 */

$footer_text 	= get_option( 'options_footer_text' );
$sidebars 		= array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
$sidebar_count 	= 0;

foreach ( $sidebars as $sidebar ) :
	if ( is_active_sidebar( $sidebar ) ) :
		$sidebar_count++;
	endif;
endforeach;

?>

<footer role="contentinfo" class="footer footer--<?php echo $sidebar_count; ?>-columns">

	<div class="footer__top">
		<div class="container">

			<?php $widget_map = array('one', 'two', 'three', 'four'); ?>
			<?php foreach ( $sidebars as $i => $sidebar ) : ?>
				<?php if ( is_active_sidebar( $sidebar ) ) : ?>

					<div class="footer__column footer__column--<?php echo $widget_map[$i]; ?>">
						<div class="inner">
							<?php dynamic_sidebar( $sidebar ); ?>
						</div>
					</div>

				<?php endif; ?>
			<?php endforeach; ?>

		</div><!-- .container -->
	</div> <!-- .footer__top -->

	<?php if ( ! empty( $footer_text ) ) : ?>

	<div class="footer__bottom">
		<div class="container">
			<?php echo wpautop( $footer_text ); ?>
		</div><!-- .container -->
	</div><!-- .footer__bottom -->

	<?php endif; ?>

	<?php
	/**
	 * Notifications (Bottom).
	 */
	get_template_part( 'partials/components/notifications/notifications-sticky-bar', 'bottom' );
	?>

	<?php
	/**
	 * Modals.
	 */
	// get_template_part( 'partials/components/modals/modal', 'example' );
	?>

</footer>

<?php wp_footer(); ?>
<?php get_template_part( 'partials/scripts/scripts', 'footer' ); ?>

</body>
</html>
