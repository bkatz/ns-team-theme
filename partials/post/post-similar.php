<?php
/**
 * Adds "Next" and "Previous" posts section
 *
 * This will add links to the next and previous posts,
 * when shown on a single.php file.
 *
 * @package WordPress
 * @since 1.0
 */

$current_post = get_the_ID();
?>

<div class="similar-posts">

	<h3 class="similar-posts__title">Similar Articles</h3>

	<?php
	$args = array(
		'post_type' 		=> 'post',
		'posts_per_page'	=> '3',
		'post__not_in' 		=> array($current_post),
	);
	?>

	<?php $similar_posts = new WP_Query( $args ); ?>
	<?php if ( $similar_posts->have_posts() ) : ?>
		<?php while ( $similar_posts->have_posts() ) : $similar_posts->the_post(); ?>

			<?php
			/**
			 * Post Data.
			 */
			$thumbnail 	= get_the_post_thumbnail_url( $post->ID, 'large' );
			$background = ( ! empty( $thumbnail ) ) ? 'style="background-image: url(' . $thumbnail . ');"' : null;
			?>

			<div class="similar-post">

				<div class="inner">
					<a class="similar-post__link" href="<?php the_permalink(); ?>"></a>
					<div class="similar-post__image" <?php echo $background; ?>></div>
					<h4 class="similar-post__title"><?php the_title(); ?></h4>
				</div>

			</div><!-- .similar-post -->

		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>

</div>
<!-- .similar-posts -->
