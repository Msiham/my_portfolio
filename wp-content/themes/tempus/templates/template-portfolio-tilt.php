<?php
/**
 * Template Name: Portfolio Tilter effect
 *
 * Iya:) Custom portfolio template.
*/

get_header();

$i = 0;

$filters = get_post_meta($post->ID, 'tempus_portfolio_filters', true);

$posts_per_page = (function_exists('ot_get_option') && ot_get_option('portfolio_tilter_showpost')) ? ot_get_option('portfolio_tilter_showpost') : 10;
// $posts_per_page =  10 ;

$tilt_style = ( get_post_meta($post->ID, 'tempus_tilt_style', true) ) ?: 'tilt-vertical';
$themeworm_slug = ( get_option('themeworm_slug') ) ?: 'portfolio-item';

if ( empty($filters) ) {

	$slider_query_args = array(
		'post_type' => $themeworm_slug,
		'posts_per_page' => $posts_per_page,
		'meta_query' => array( array(
			'key' => '_thumbnail_id',
			'compare' => 'EXISTS'
		))
	);

} else {

	$slider_query_args = array(
		'post_type' => $themeworm_slug,
		'posts_per_page' => $posts_per_page,
		'tax_query' => array( array(
			'taxonomy' => 'filters',
			'field' => 'id',
			'terms' => $filters,
			'operator' => 'IN',
			'include_children' => false
		)),
		'meta_query' => array( array(
			'key' => '_thumbnail_id',
			'compare' => 'EXISTS'
		))
	);

} ?>

<div class="tilt-wrapper">

	<?php $slider_query = new WP_Query ( $slider_query_args ); $n = 3;

	if ( $slider_query->have_posts() ) { while ($slider_query->have_posts()) : $slider_query->the_post();
		if ( $i == $n + $n - 1 ) { $i = 0; }
		$i++; ?>

		<?php if ( $i == 1 || $i == $n ) { ?>
			<section class="tilt-row">
		<?php } ?>

		<?php get_template_part('/templates/content/content', 'loop-tilt'); ?>

		<?php if ( $i == $n - 1 || $i == $n + $n - 1 ) { ?>
			</section>
		<?php } ?>

	<?php endwhile; } ?>

</div>

<?php tempus_load_more( $filters, 'portfolio-tilt', $data_all = false, $posts_per_page, $tilt_style ); ?>

<?php get_footer(); ?>
