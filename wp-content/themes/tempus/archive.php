<?php
/**
 * The Archive template file.
 * @package WordPress
 */
get_header(); ?>

<div class="container blog-content">

	<?php while (have_posts()) : the_post();
		get_template_part('/templates/blog/blog','loop');
	endwhile; ?>

</div>

<div class="pagination">
	<div class="nav-previous animated-link">
		<?php next_posts_link(esc_html__('Older posts', 'tempus')); ?>
		<?php previous_posts_link(esc_html__('Newer posts', 'tempus')); ?>
	</div>
</div>

<?php get_footer(); ?>
