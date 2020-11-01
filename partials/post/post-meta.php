<?php
/**
 * Post Meta Information
 *
 * Shows additional post information.
 *
 * @package WordPress
 * @since 1.0
 */

global $post;
$author_id 			= $post->post_author;
$author_name 		= get_the_author_meta( 'display_name', $author_id  );
// $author_photo 		= get_the_author_meta( 'user_image', $author_id  ); // custom field
$author_posts_link 	= get_author_posts_url( $author_id, $author_name );
$categories 		= get_the_category();
$category_name 		= $categories[0]->name;
$category_link 		= get_category_link( $categories[0]->term_id );
?>

<div class="post__meta">
	<div class="post__author">By <a href="<?php echo $author_posts_link; ?>"><?php echo $author_name; ?></a></div>
	<div class="post__category"> in <a href="<?php echo $category_link; ?>"><?php echo $category_name; ?></a></div>
	<div class="post__date"> on <?php echo get_the_date( 'M j, Y' ); ?></div>
</div>