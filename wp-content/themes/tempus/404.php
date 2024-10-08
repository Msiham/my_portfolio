<?php
/**
 * The 404 page template file.
 * @package WordPress
 */

get_header(); ?>

<div class="container no-content">
	<?php get_template_part( '/templates/content/content', 'none' ); ?>
</div>

<?php get_footer(); ?>
