<?php
/**
 * Hero Carousel Item: Carousel Item (Standard).
 *
 * This file contains the markup for the standard carousel item.
 *
 * @package WordPress
 * @since 1.0
 */

/**
 * Carousel item data
 */
$title 	= get_sub_field('title');
$text 	= get_sub_field('text');
$image 	= get_sub_field('image');
$background = ( $image ) ? 'style="background-image: url(' . $image['url'] . ');"' : null;
?>

<div class="hero-item" <?php echo $background; ?>>

	<div class="hero-item__overlay"></div>

	<div class="container">

		<div class="hero-item__content">

			<?php if ( $title ) : ?>
				<h1 class="hero-item__title"><?php echo $title; ?></h1>
			<?php endif; ?>

			<?php if ( $text ) : ?>
				<div class="hero-item__description">
					<?php echo wpautop( $text ); ?>
				</div>
			<?php endif; ?>

			<?php if( have_rows('buttons') ): ?>

				<div class="hero-item__buttons">

				    <?php while ( have_rows('buttons') ) : the_row(); ?>

			            <?php
				        /**
				         * Button Variables
				         */
						$button_text = get_sub_field('button_text');
						$button_link = get_sub_field('button_link');
						$button_type = get_sub_field('button_type');
						$button_target = get_sub_field('button_target');
						$button_scroll_id = get_sub_field('button_scroll_id');
						$button_page = get_sub_field('button_page');
						$button_target = ( $button_target ) ? 'target="_blank"' : null;
						$button_href = ( $button_type == 'scroll' ) ? '#'.str_replace('#', '', $button_scroll_id) : $button_link;
						$button_href = ( $button_type == 'page' ) ? $button_page : $button_href;
						$button_class = ( $button_type == 'scroll' ) ? ' scroll' : null;
						?>

						<a class="button<?php echo $button_class; ?>" href="<?php echo $button_href; ?>" <?php echo $button_target; ?>><?php echo $button_text; ?></a>

				    <?php endwhile; ?>

				</div><!-- .hero-item__buttons -->

			<?php endif; ?>

		</div><!-- .hero-item__content -->

	</div><!-- .container -->

</div><!-- .hero-item -->
