<?php
/**
 * Notifications: Sticky Bar Top
 *
 * Displays sticky bar notifications above the header.
 *
 * @package WordPress
 * @since 1.0
 */
?>

<?php if( have_rows('notifications', 'options') ) : ?>

    <?php while ( have_rows('notifications', 'options') ) : the_row(); ?>

        <?php if( get_row_layout() == 'sticky-bar-top' ): ?>

            <?php
	        /**
	         * $var Row data
	         */
            $content = get_sub_field('content');
            $cookie_duration = get_sub_field( 'cookie_duration' );
           	?>

			<div class="notification is-hidden is-top is-sticky-bar" data-display="<?php echo $cookie_duration; ?>">

				<div class="container">

					<h3 class="notification__title">
						<span><?php echo $content; ?></span>
					</h3><!-- .notification__title -->

				</div><!-- .container -->

				<a href="#" class="notification__close">
					<i data-feather="x-circle"></i>
				</a>

			</div><!-- .notification -->

        <?php endif; ?>

    <?php endwhile; ?>

<?php endif; ?>