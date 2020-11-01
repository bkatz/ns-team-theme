<?php
/**
 * Module: Hero Carousel
 */

// Section ID and Classes
$id 			= get_sub_field('section_id');
$class 			= get_sub_field('section_class');
$section_id 	= ($id) ? $id : null;
$section_class 	= ($class) ? $class : null;

// Section Data
$carousel_settings = get_carousel_settings($post->ID);
$carousel_class = ( count(get_sub_field('carousel_items')) > 1 ) ? ' hero--carousel' : null;
?>

<?php if( have_rows('carousel_items') ): ?>

	<section class="hero<?php echo $carousel_class; ?>" data-slick="<?php echo htmlspecialchars(json_encode($carousel_settings), ENT_QUOTES, 'UTF-8'); ?>">

	    <?php while ( have_rows('carousel_items') ) : the_row(); ?>

	        <?php if( get_row_layout() == 'carousel_item' ): ?>
	            <?php include( locate_template( 'partials/modules/module-hero-carousel-item.php') ); ?>
	        <?php endif; ?>

	        <?php if( get_row_layout() == 'carousel_item_video' ): ?>
	            <?php include( locate_template( 'partials/modules/module-hero-carousel-video.php') ); ?>
	        <?php endif; ?>

	    <?php endwhile; ?>

    </section><!-- .hero -->

<?php endif; ?>