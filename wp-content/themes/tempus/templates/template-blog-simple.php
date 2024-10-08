<?php
/**
 *
 * Template Name: Blog Simple
 * The page template file.
 * @package WordPress
 */
get_header();

$tempus_big_image = true;
$tempus_about_me = (get_post_meta($post->ID, 'tempus_about_me', true) == 'on') ? true : false;
$container_fullwidth = ( get_post_meta($post->ID, 'tempus_portfolio_fullwidth', true) == "on" ) ? ' container_fullwidth ' : ''; ?>

<?php if ($post->post_content != '') { ?>
  <div class="container text-container">
  	<div class="sixteen columns hentry portfolio-text">
  		<?php while (have_posts()) : the_post(); ?>
  			<?php the_content() ?>
  		<?php endwhile; ?>
  	</div>
  </div>
<?php } ?>

<div class="container blog-content blog-simple <?php echo esc_attr($container_fullwidth); ?>">

	<?php $paged = 1;
	$blog_postsperpage = get_option('posts_per_page');

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

<div class="pagination">
	<div class="nav-previous animated-link">
		<?php next_posts_link(esc_html__('Older posts', 'tempus'), $blog_query->max_num_pages); ?>
		<?php previous_posts_link(esc_html__('Newer posts', 'tempus')); ?>
	</div>
</div>

<?php if ( function_exists('ot_get_option') && true === $tempus_about_me ) {
	get_template_part( '/templates/widgets/widgets', 'about' );
} ?>

<?php get_footer(); ?>
