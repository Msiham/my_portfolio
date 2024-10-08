<?php
/**
 * Template Name: Portfolio Slider + Content
 *
 * Iya:) Custom portfolio template.
*/

get_header();

$tempus_image_url = '';
$tempus_about_me = (get_post_meta($post->ID, 'tempus_about_me', true) == 'on') ? true : false; ?>

<div class="container boxed-slider">
	<div class="owl-carousel owl-theme">

		<?php if ( get_post_meta($post->ID, 'tempus_slider_images', true) ) {

			$slides = get_post_meta($post->ID, 'tempus_slider_images', true);

			foreach ( $slides as $slide ) {

				$tempus_image_url = $slide['tempus_slider_images_image'];
				$portfolio_main = wp_get_attachment_image_src( tempus_get_image_attr($tempus_image_url), 'full' );
				$tempus_ratio = ($portfolio_main[2] > 0) ? $portfolio_main[1]/$portfolio_main[2] : '';
				$tempus_slide_title = $slide['title'];
				$tempus_slide_url = $slide['tempus_slider_images_url'];
				$tempus_slide_subtitle = $slide['tempus_slider_images_subtitle'];

				get_template_part('/templates/content/content', 'slide-fullscreen');

			}

		} else { ?>

			<?php get_template_part('/templates/content/content', 'slider-latest'); ?>

		<?php } ?>

	</div>
</div>

<div class="container">
	<div class="sixteen columns hentry portfolio-text blog-nosidebar">
		<?php while (have_posts()) : the_post(); ?>
			<?php the_content() ?>
		<?php endwhile; ?>
	</div>
</div>

<?php if ( function_exists('ot_get_option') && true === $tempus_about_me ) {
	get_template_part( '/templates/widgets/widgets', 'about' );
} ?>

<?php get_footer(); ?>
