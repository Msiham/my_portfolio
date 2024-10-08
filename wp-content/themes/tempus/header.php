<!DOCTYPE html>
<html ontouchmove <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php if ( function_exists('ot_get_option') && !function_exists( 'has_site_icon' ) || function_exists('ot_get_option') && !has_site_icon() ) { ?>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(ot_get_option('favicon_upload', get_template_directory_uri() . '/images/favicon.png')); ?>" />
	<?php } ?>
	<?php wp_head(); ?>
</head>

<?php
$body_class =  ( function_exists('ot_get_option') && ot_get_option('blog_layout') != "no-sidebar" && !is_home() &&  is_single() && get_post_type( get_the_ID() ) == 'post' || get_post_meta(get_the_ID(), 'tempus_sidebar_on', true) == "on" ) ? ot_get_option('blog_layout') : '';
$body_class .= ( function_exists('ot_get_option') && ot_get_option('fullwidth_nav') == "on" || isset($_GET["fullwidth_nav"]) ) ? ' fullwidth-navigation ' : ''; ?>

<body onclick <?php body_class( esc_attr($body_class) ); ?> >

	<?php if ( function_exists('wp_body_open')) { wp_body_open(); } ?>

	<?php if ( function_exists('ot_get_option') && ot_get_option('preloader_on') == "on" ) { ?>
		<div id="loader">
	    <div class="loader-spinner"></div>
	  </div>
	<?php } ?>

	<?php get_template_part( '/templates/widgets/widgets', 'header' ); ?>

	<div class="search-bar">
		<div class="search-bar-form">
	  	<?php get_template_part( 'searchform' ); ?>
		</div>
	</div>

	<?php get_template_part( '/templates/widgets/widgets', 'title' ); ?>

	<main class="content-wrapper">
