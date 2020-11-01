<?php
/**
 * Sharing Buttons
 *
 * Displays sharing buttons
 *
 * @package WordPress
 * @since 1.0
 */

global $post;

$permalink 	= get_the_permalink();
$title 		= get_the_title();
$thumbnail 	= get_the_post_thumbnail_url( $post->ID );

$icons = [
	'facebook' => '<i data-feather="facebook"></i>',
	'twitter' => '<i data-feather="twitter"></i>',
	'linkedin' => '<i data-feather="linkedin"></i>',
];

?>

<div class="post__share">
	<a class="post__share-link facebook" target="_blank" rel="noopener" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $permalink ); ?>"><?php echo $icons['facebook']; ?></a>
	<a class="post__share-link twitter" target="_blank" rel="noopener" href="https://twitter.com/home?status=<?php echo esc_url( $permalink ); ?>"><?php echo $icons['twitter']; ?></a>
	<a class="post__share-link linkedin" target="_blank" rel="noopener" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url( $permalink ); ?>&title=<?php echo $title; ?>&summary=&source="><?php echo $icons['linkedin']; ?></a>
</div>