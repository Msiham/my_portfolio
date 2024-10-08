<?php
/**
 * The main template file.
 * @package WordPress
 */

get_header();

if (is_search()) { ?>

  <?php if (have_posts()) { ?>

  <div class="container blog-content">

  	<?php while (have_posts()) : the_post();
  		get_template_part('/templates/blog/blog', 'loop');
  	endwhile; ?>

  </div>

  <div class="pagination">
    <div class="nav-previous">
      <?php next_posts_link(esc_html__('Older posts', 'tempus')); ?>
      <?php previous_posts_link(esc_html__('Newer posts', 'tempus')); ?>
    </div>
  </div>

  <?php } else { ?>

    <div class="container no-content">
    	<?php get_template_part( '/templates/content/content', 'none' ); ?>
    </div>

  <?php } ?>

<?php } else { ?>

  <?php if (have_posts()) { ?>

  	<div class="container blog-content">

    	<?php while (have_posts()) : the_post();
    		get_template_part('/templates/blog/blog', 'loop');
    	endwhile; ?>

    </div>

    <div class="pagination">
    	<div class="nav-previous animated-link">
    		<?php next_posts_link(esc_html__('Older posts', 'tempus')); ?>
    		<?php previous_posts_link(esc_html__('Newer posts', 'tempus')); ?>
    	</div>
    </div>

    <?php if ( get_post_meta($post->ID, 'tempus_sidebar_on', true) == "on" ) { get_sidebar(); } ?>

  <?php } else { ?>

    <div class="container no-content">
    	<?php get_template_part( '/templates/content/content', 'none' ); ?>
    </div>

  <?php } ?>

<?php }

get_footer(); ?>
