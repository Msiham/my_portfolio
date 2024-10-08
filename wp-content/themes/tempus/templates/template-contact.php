<?php
/**
 *
 * Template Name: Contact Page
 * The page template file.
 * @package WordPress
 */
get_header();

$tempus_about_me = (get_post_meta($post->ID, 'tempus_about_me', true) == 'on') ? true : false; ?>

<?php echo tempus_contact_map(); ?>

<div class="container">

	<div class="sixteen columns blog-nosidebar">

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>" >
				<div class="post-content">
					<div class="post-description">
						<?php the_content() ?>
					</div>
				</div>
			</div>

		<?php endwhile; ?>

	</div>

</div>

<?php if ( function_exists('ot_get_option') && true === $tempus_about_me ) {
	get_template_part( '/templates/widgets/widgets', 'about' );
} ?>

<?php get_footer(); ?>
