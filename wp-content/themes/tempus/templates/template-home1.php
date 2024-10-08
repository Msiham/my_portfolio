<?php
/**
 *
 * Template Name: Portfolio 3 + Blog
 * The page template file.
 * @package WordPress
 */
get_header();

$tempus_about_me = (get_post_meta($post->ID, 'tempus_about_me', true) == 'on') ? true : false;

$tempus_columns = 'portfolio-three';
$tempus_allow_multi_items = true;
$filters_array = (get_post_meta($post->ID, 'tempus_portfolio_filters', true)) ? get_post_meta($post->ID, 'tempus_portfolio_filters', true) : '';
$blog_title = (get_post_meta($post->ID, 'tempus_portblog_title', true)) ?: '';

get_template_part('/templates/content/content', 'masonry');

tempus_load_more( $filters_array, 'portfolio-three' );

if ( function_exists('ot_get_option') && ot_get_option('infinite_off') != 'off') {
  tempus_get_appear('.load-more');
}

if ( function_exists('ot_get_option') && true === $tempus_about_me ) {
	get_template_part( '/templates/widgets/widgets', 'about' );
} ?>

<?php if ( $blog_title ) { ?>

  <div class="container">
    <div id="page-title" class="titlestyle-center wow fadeIn" style="padding-bottom: 5px;">
      <h1><?php echo esc_attr($blog_title); ?></h1>
    </div>
  </div>

<?php } ?>

<div class="container blog-content blog-simple top-margin">

	<?php $paged = 1;
	$blog_postsperpage = get_option('posts_per_page');
  $tempus_big_image = true;

	if ( get_query_var( 'paged' ) ) $paged = get_query_var( 'paged' );
	if ( get_query_var( 'page' ) ) $paged = get_query_var( 'page' );

	$blog_query_args = array(
		'post_type' => 'post',
		'paged' => $paged,
		'posts_per_page' => $blog_postsperpage,
		'ignore_sticky_posts' => 1
	);

	$blog_query = new WP_Query( $blog_query_args );

	if ($blog_query->have_posts()) {  ?>

		<?php	while ( $blog_query->have_posts() ) : $blog_query->the_post();
			get_template_part('/templates/blog/blog', 'loop');
		endwhile; ?>

	<?php } else { ?>

		<div class="fourteen columns blog-nosidebar">
	    <?php get_template_part( '/templates/content/content', 'none' ); ?>
		</div>

	<?php } ?>

</div>

<?php get_footer(); ?>
