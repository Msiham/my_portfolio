<?php
/**
 * Template Name: Portfolio Revealer + Content
 *
 * Iya:) Custom portfolio template.
*/

get_header();

$tempus_about_me = (get_post_meta($post->ID, 'tempus_about_me', true) == 'on') ? true : false;
$i = 0;

$filters = get_post_meta($post->ID, 'tempus_portfolio_filters', true);

$randNum = rand (0, tempus_revealer_random('count'));

$column_scheme = tempus_revealer_random();

$posts_per_page = isset($column_scheme[$randNum][1][2]) ? $column_scheme[$randNum][1][2] : 7 ;
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

}

$slider_query = new WP_Query ( $slider_query_args ); ?>

<div class="revealer-wrapper">

	<?php if ( $slider_query->have_posts() ) { while ($slider_query->have_posts()) : $slider_query->the_post();
		$i++; ?>

		<?php if ($i == 1 || $i == $column_scheme[$randNum][0][1] || $i == $column_scheme[$randNum][0][2]) { ?>
			<div class="revealer-column">
		<?php } ?>

		<?php get_template_part('/templates/content/content', 'loop-revealer'); ?>

		<?php if ($i == $column_scheme[$randNum][1][0] || $i == $column_scheme[$randNum][1][1] || $i == $column_scheme[$randNum][1][2]) { ?>
			</div>
		<?php } ?>

	<?php endwhile; } ?>

	<?php wp_reset_postdata(); ?>

</div>

<?php tempus_revealer_load_more( $filters, $posts_per_page ); ?>

<div class="container">
	<div class="sixteen columns hentry portfolio-text blog-nosidebar">
		<?php while (have_posts()) : the_post(); ?>
			<?php the_content() ?>
		<?php endwhile; ?>
	</div>
</div>

<?php if ( function_exists('ot_get_option') && true === $tempus_about_me ) {
	get_template_part( '/templates/widgets/widgets', 'about' );
} ?>

<?php get_footer(); ?>
