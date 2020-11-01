<?php
/**
 * Post Header.
 *
 * Generates the output for the header section of the single.php file.
 *
 * @package WordPress
 * @since 1.0
 */

// Header options data.
$featured_image_url		= get_the_post_thumbnail_url( $post->ID, 'full' );
$page_title 			= get_post_meta( $post->ID, 'header_title', true );
$page_subtitle 			= get_post_meta( $post->ID, 'header_subtitle', true );
$page_title 			= ( ! empty( $page_title ) ) ? $page_title : get_the_title();
$header_background 		= ( ! empty( $featured_image_url ) ) ? $header_background = 'style="background-image: url(' . $featured_image_url . ');"' : null;
?>

<section id="page-header" class="page-header" <?php echo $header_background; ?>>

	<div class="page-header__overlay"></div>

	<div class="container">

		<div class="page-header__content">

			<h1 class="page-header__title"><?php echo esc_html( $page_title ); ?></h1>

			<?php if ( ! empty( $page_subtitle ) ) : ?>
				<span class="page-header__subtitle"><?php echo  esc_html( $page_subtitle ); ?></span>
			<?php endif; ?>

		</div><!-- .page-header__content -->

	</div><!-- .container -->

	<?php if ( function_exists('yoast_breadcrumb') ) : ?>
		<?php yoast_breadcrumb('<div class="page-header__breadcrumbs"><div class="container">','</div></div>'); ?>
	<?php endif; ?>

</section><!-- .page-header -->
