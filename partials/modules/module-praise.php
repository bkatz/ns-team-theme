<?php

/**
 * Module: Praise
 */

// Section ID and Classes
$id 			= get_sub_field('section_id');
$class 			= get_sub_field('section_class');
$section_id 	= ($id) ? $id : null;
$section_class 	= ($class) ? $class : null;

// Section Data
$terms = get_sub_field('add_praise');

?>

<section class="praise">
	<?php
	$args = array(
		'post_type' => 'praise',
		'orderby'	=> 'rand',
		'tax_query' => array(
			array(
				'taxonomy' => 'books',
				'field'    => 'slug',
				'terms'    => $terms,
			),
		),
	);
	$praise = new WP_Query($args);
	if($praise->have_posts()) : ?>
		<h2>Praise</h2>
		<div class="praise--carousel carousel">
			<?php while($praise->have_posts()) : $praise->the_post();
				$quote = get_field('testimonial');
				$quote = ($quote) ? '<div class="praise__quote">' . $quote . '</div>' : null;
				$cite = get_field('cite');
				$cite_attr = get_field('cite_attributes');
				$cite_attr = ($cite_attr) ? '<div class="cite-attr">' . $cite_attr . '</div>' : null;
				$cite = ($cite) ? '<div class="praise__cite"><em>—' . $cite . '</em>' . $cite_attr . '</div>' : null;
			?>
				<div class="praise__container">
					<?php echo $quote; ?>
					<?php echo $cite; ?>
				</div>
			<?php endwhile; ?>
		</div>
	<?php endif;
	wp_reset_postdata();?>

</section><!-- .praise -->