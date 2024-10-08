<?php
/**
 * The page template file.
 * @package WordPress
 */
get_header();

$tempus_about_me = (get_post_meta($post->ID, 'tempus_about_me', true) == 'on') ? true : false; ?>

<div class="container">

	<div class="sixteen columns blog-nosidebar">

		<?php while (have_posts()) : the_post(); ?>

			<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>" >
				<div class="post-content">
					<div class="post-description">
						<?php the_content();
						if (function_exists('pb_page_builder')) { pb_page_builder(); } ?>
					</div>
				</div>
			</div>

		<?php endwhile; ?>

		<?php if ( function_exists('ot_get_option') && ot_get_option('hide_comments') != "yes" && have_comments() ) { ?>
			<div class="post-footer wow fadeIn">
				<div class="comments-number"><?php echo get_comments_number(); ?></div>
				<?php comments_template('', true); ?>
			</div>
		<?php } elseif ( !function_exists('ot_get_option') ) { ?>
			<div class="post-footer wow fadeIn">
				<div class="comments-number"><?php echo get_comments_number(); ?></div>
				<?php comments_template(); ?>
			</div>
		<?php } ?>

	</div>

</div>

<?php if ( function_exists('ot_get_option') && true === $tempus_about_me ) {
	get_template_part( '/templates/widgets/widgets', 'about' );
} ?>

<?php get_footer(); ?>
