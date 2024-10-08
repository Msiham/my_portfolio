<?php
/**
 * Masonry portfolio template part
 */

get_template_part('/templates/content/content', 'filter');

$masonry = new tempus_GetGlobal();

$posts_per_page = ( function_exists('ot_get_option') ) ? ot_get_option('portfolio_showpost','10') : get_option( 'posts_per_page' );

$container_fullwidth = ( get_post_meta($post->ID, 'tempus_portfolio_fullwidth', true) == "on" ) ? ' container_fullwidth ' : '';
$container_fullwidth .= ($masonry->masonry) ? ' masonry-style' : '';

$paged = 1;
$exclude = '';

if ( get_query_var( 'paged' ) ) $paged = get_query_var( 'paged' );
if ( get_query_var( 'page' ) ) $paged = get_query_var( 'page' );

$portfolio_sorting = ( function_exists('ot_get_option') && ot_get_option('portfolio_sorting')  ) ? ot_get_option('portfolio_sorting') : 'date';
$portfolio_order = (function_exists('ot_get_option') && ot_get_option('portfolio_sorting') == 'menu_order') ? 'ASC' : 'DESC';

$filters = is_page() ? get_post_meta($post->ID, 'tempus_portfolio_filters', true) : get_post_meta($post->ID, 'tempus_recent_filters', true);
$themeworm_slug = ( get_option('themeworm_slug') ) ?: 'portfolio-item';

if (is_single()) { $exclude = $post->ID; $nopaging = true; }

if ( empty($filters) ) {

	query_posts(array (
		'post_type' => $themeworm_slug,
		'orderby' => $portfolio_sorting,
		'order'   => $portfolio_order,
		'paged' => $paged,
		'page' => 1,
		'posts_per_page' => $posts_per_page,
		// 'meta_query' => array( array(
		// 	'key' => '_thumbnail_id',
		// 	'compare' => 'EXISTS'
		// ))
	));

} else {

	query_posts(array (
		'post_type' => $themeworm_slug,
		'orderby' => $portfolio_sorting,
		'order'   => $portfolio_order,
		'post__not_in' => array($exclude),
		'paged' => $paged,
		'posts_per_page' => $posts_per_page,
		'tax_query' => array( array(
			'taxonomy' => 'filters',
			'field' => 'id',
			'terms' => $filters,
			'operator' => 'IN',
			'include_children' => false
		)),
		// 'meta_query' => array( array(
		// 	'key' => '_thumbnail_id',
		// 	'compare' => 'EXISTS'
		// ))
	));

}

$image_size = (get_post_meta($post->ID, 'tempus_masonry_off', true) != "off" ) ? "tempus_portfolio-main" : "tempus_portfolio-main"; ?>

<div class="container portfolio_container boxed-style <?php echo esc_html($container_fullwidth); ?>">
	<div id="ajax-loader" class="ajax-loader">
		<div class="spinner">
			<div class="bounce1"></div>
			<div class="bounce2"></div>
			<div class="bounce3"></div>
		</div>
	</div>
	<div id="portfolio-wrapper">

		<?php if ( have_posts() ) { while (have_posts()) : the_post();

			$ratio = $image_url = '';

			if (has_post_thumbnail()) {
				$portfolio_main = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $image_size );
				$ratio = ($portfolio_main[2] > 0) ? $portfolio_main[1]/$portfolio_main[2] : '';
				$image_url = $portfolio_main[0];
			} else {
				$image_url = get_template_directory_uri() . '/assets/images/noimage.png';
				$ratio = 1;
			}

			$thumbnail_url = get_the_permalink();

			// if (has_post_thumbnail()) {
				get_template_part( '/templates/content/content', 'loop' );
			// }

		endwhile; } ?>
	</div>

</div>
