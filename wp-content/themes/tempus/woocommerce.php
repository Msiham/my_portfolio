<?php
/**
 * The woocommerce template file.
 * @package WordPress
 */
get_header(); ?>

<div class="container">

	<div class="sixteen columns blog-nosidebar">

		<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>" >

			<?php woocommerce_content(); ?>

		</div>

	</div>

</div>

<?php if ( !function_exists('ot_get_option') || function_exists('ot_get_option') && ot_get_option('blog_layout') != "no-sidebar" ) {
	get_sidebar();
} ?>

<?php get_footer(); ?>
