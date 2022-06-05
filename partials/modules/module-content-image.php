<?php

/**
 * Module: Content & Image Repeater
 */

// Section ID and Classes
$id 			= get_sub_field('section_id');
$class 			= get_sub_field('section_class');
$section_id 	= ($id) ? $id : null;
$section_class 	= ($class) ? $class : null;

// Section Data
$content = get_sub_field('content');
?>

<section id="<?php echo $section_id; ?>" class="content-image">

	<div class="container <?php echo $section_class; ?>">
		<?php if (have_rows('content_image')) : while (have_rows('content_image')) : the_row();
				$content = get_sub_field('content');
				$image = get_sub_field('image'); ?>
				<div class="content-image__container">
					<div class="content-image__content"><?php echo $content; ?></div>
					<div class="content-image__image"><?php echo wp_get_attachment_image($image, ''); ?></div>
				</div>
		<?php endwhile;
		endif; ?>
	</div>

</section><!-- .content-image -->