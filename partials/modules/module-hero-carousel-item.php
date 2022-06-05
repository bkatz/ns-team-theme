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
$background = ($image) ? '<div class="hero-item__background">' . wp_get_attachment_image($image, '',) . '</div>' : null;
?>

<div class="hero-item">

	<div class="hero-item__overlay"></div>

	<?php echo $background; ?>

	<div class="container">

		<div class="hero-item__content">

			<?php if ($title) : ?>
				<h1 class="hero-item__title"><?php echo $title; ?></h1>
			<?php endif; ?>

			<?php if ($text) : ?>
				<div class="hero-item__description">
					<?php echo wpautop($text); ?>
				</div>
			<?php endif; ?>

			<?php if (have_rows('buttons')) : ?>

				<div class="hero-item__buttons">

					<?php while (have_rows('buttons')) : the_row(); ?>

						<?php
						/**
						 * Button Variables
						 */
						$button = get_sub_field('button');
						$button_url = $button['url'];
						$button_title = $button['title'];
						$button_target = $button['target'] ? $button['target'] : '_self';
						?>

						<a class="button" href="<?php echo $button_url; ?>" target="<?php echo $button_target; ?>"><?php echo $button_title; ?></a>

					<?php endwhile; ?>

				</div><!-- .hero-item__buttons -->

			<?php endif; ?>

		</div><!-- .hero-item__content -->

	</div><!-- .container -->

</div><!-- .hero-item -->