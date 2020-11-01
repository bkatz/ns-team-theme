<?php
/**
 * Notifications: Sticky Bar Bottom
 *
 * Displays sticky bar notifications above at the
 * bottom of the viewport.
 *
 * @package WordPress
 * @since 1.0
 */
?>

<?php if( have_rows('notifications', 'options') ) : ?>

    <?php while ( have_rows('notifications', 'options') ) : the_row(); ?>

        <?php if( get_row_layout() == 'sticky-bar-bottom' ): ?>

            <?php
	        /**
	         * Notification data:
	         */
            $content = get_sub_field( 'content' );
            $cookie_duration = get_sub_field( 'cookie_duration' );
           	?>

			<div class="notification is-hidden is-bottom is-sticky-bar" data-display="<?php echo $cookie_duration; ?>">

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