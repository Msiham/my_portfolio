<?php
/**
 * Template Name: Portfolio 2
 *
 * Iya:) Custom portfolio template.
*/

get_header(); ?>

<?php
$tempus_about_me = (get_post_meta($post->ID, 'tempus_about_me', true) == 'on') ? true : false;
$tempus_columns = 'portfolio-two';
$tempus_allow_multi_items = true;
$filters_array = (get_post_meta($post->ID, 'tempus_portfolio_filters', true)) ? get_post_meta($post->ID, 'tempus_portfolio_filters', true) : ''; ?>

<?php if (get_post_meta($post->ID, 'tempus_content_position', true) != 'after_portfolio') { ?>
  <?php while (have_posts()) : the_post();
    if ($post->post_content != '' || in_array( 'elementor/elementor.php', apply_filters('active_plugins', get_option('active_plugins')))) { ?>
      <div class="container fix_overflow">
      	<div class="sixteen columns blog-nosidebar">
      			<div class="post-content">
      				<div class="post-description">
                <?php the_content(); ?>
              </div>
            </div>
        </div>
      </div>
    <?php } ?>
  <?php endwhile; ?>
<?php } ?>

<?php get_template_part('/templates/content/content', 'masonry');

tempus_load_more( $filters_array, 'portfolio-two' );

if ( function_exists('ot_get_option') && ot_get_option('infinite_off') != 'off') {
  tempus_get_appear('.load-more');
} ?>

<?php wp_reset_query(); ?>

<?php if (get_post_meta($post->ID, 'tempus_content_position', true) == 'after_portfolio') { ?>
  <?php while (have_posts()) : the_post();
    if ($post->post_content != '' || in_array( 'elementor/elementor.php', apply_filters('active_plugins', get_option('active_plugins')))) { ?>
      <div class="container fix_overflow">
      	<div class="sixteen columns blog-nosidebar">
      			<div class="post-content">
      				<div class="post-description">
                <?php the_content(); ?>
              </div>
            </div>
        </div>
      </div>
    <?php } ?>
  <?php endwhile; ?>
<?php } ?>

<?php if ( function_exists('ot_get_option') && true === $tempus_about_me ) {
	get_template_part( '/templates/widgets/widgets', 'about' );
}

get_footer(); ?>
