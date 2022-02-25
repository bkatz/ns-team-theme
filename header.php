<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php wp_title(); ?></title>

	<!-- Get favicons here: https://realfavicongenerator.net/ -->

	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo THEME_URL; ?>/assets/img/icons/apple-touch-icon-57x57.png" />
	
	<meta name="application-name" content="<?php echo get_bloginfo('name'); ?>" />
	
	<?php wp_head(); ?>

	<?php
	/**
	 * Header Scripts.
	 * Put your header scripts in the file below and they
	 * will be included in this location in the <head>.
	 */
	get_template_part('partials/scripts/scripts', 'header');
	?>

</head>

<body <?php body_class(); ?>>

	<?php get_template_part('partials/scripts/scripts', 'body'); ?>

	<?php get_template_part('partials/navigation/navigation', 'menu'); ?>