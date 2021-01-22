<?php
/**
 * Index Header.
 *
 * Generates the output for the header section of the index.php file.
 *
 * @package WordPress
 * @since 1.0
 */

$blog 				= get_page_by_path( 'blog' );
$header_enable 		= get_post_meta( $blog->ID, 'header_enable', true ); // Needs to be set up in ACF as an optional header.

if ( is_home() || is_front_page() ) :

	$header_title 			= '';
	$header_subtitle 		= '';
	$featured_image_url 	= get_the_post_thumbnail_url( $blog->ID, 'full' );
	$header_background 		= ( ! empty( $featured_image_url ) ) ? $header_background = 'style="background-image: url(' . $featured_image_url . ');"' : null;

elseif ( is_archive() ) :

	$header_title 			= get_the_archive_title();
	$featured_image_url 	= get_the_post_thumbnail_url( $blog->ID, 'full' );
	$header_background 		= ( ! empty( $featured_image_url ) ) ? $header_background = 'style="background-image: url(' . $featured_image_url . ');"' : null;

else :

	$header_title 		= get_the_title();
	$header_background 	= ( ! empty( $featured_image_url ) ) ? $header_background = 'style="background-image: url(' . $featured_image_url . ');"' : null;

endif;
?>

<?php if( $header_enable ) : ?>

<section class="page-header" <?php echo $header_background; ?>>

	<div class="page-header__overlay"></div>

	<div class="container">

		<div class="page-header__content">

			<h1 class="page-header__title"><?php echo esc_html( $header_title ); ?></h1>

			<?php if ( ! empty( $header_subtitle ) ) : ?>
				<span class="page-header__subtitle"><?php echo  esc_html( $header_subtitle ); ?></span>
			<?php endif; ?>

		</div><!-- .page-header__content -->

	</div><!-- .container -->

</section><!-- .page-header -->

<?php endif; ?>