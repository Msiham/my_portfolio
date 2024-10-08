<?php
/**
 * The single page template file.
 * @package WordPress
 */

get_header();

$add_class = (get_post_meta($post->ID, 'tempus_content_padding', true) == "off") ? 'no-padding' : '';
$sec_gallery = (get_post_meta(get_the_ID(), 'tempus_post_gallery_images', TRUE)) ? 'is-gallery' : ''; ?>

<div class="container">

	<?php if (have_posts()) { ?>

		<div class="twelve columns blog-nosidebar <?php echo esc_attr($sec_gallery); ?>">

			<?php while (have_posts()) : the_post(); ?>

				<div <?php post_class('post-page ' . $add_class); ?> id="post-<?php the_ID(); ?>" >
					<div class="post-content">
						<div class="post-description">
							<?php	the_content();
							if (function_exists('pb_page_builder')) { pb_page_builder(); } ?>

							<?php wp_link_pages(); ?>

							<?php get_template_part( '/templates/widgets/widgets', 'post-footer' ); ?>

						</div>
					</div>
				</div>

			<?php endwhile; ?>

		</div>

		<?php tempus_post_gallery(); ?>

	<?php } else {

		get_template_part( '/templates/content/content', 'none' );

	} ?>

	<?php if ( !function_exists('ot_get_option') || function_exists('ot_get_option') && ot_get_option('blog_layout') != "no-sidebar" ) {
		get_sidebar();
	} ?>

</div>

<?php if ( function_exists('ot_get_option') && ot_get_option('blog_latest') == "on" ) { ?>
	<div class="related-columns">
		<?php tempus_related_posts(); ?>
	</div>
<?php } ?>

<?php get_footer(); ?>
