<?php
/**
 * Template Name: Elementor Tempus Fullwidth
 * Template Post Type: page
*/

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <div class="container">

              <?php the_content(); ?>

    </div>
<?php endwhile; ?>

<?php get_footer(); ?>
