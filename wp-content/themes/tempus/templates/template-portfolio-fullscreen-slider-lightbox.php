<?php
/**
 * Template Name: Portfolio Slider - Lightbox
 *
 * Iya:) Custom portfolio template.
*/

get_header();

$exclude = $tempus_image_url = ''; ?>

<div class="fullscreen-slider">
	<div class="owl-carousel owl-theme">

		<?php if ( get_post_meta($post->ID, 'tempus_slider_images', true) ) {

			$slides = get_post_meta($post->ID, 'tempus_slider_images', true);

			foreach ( $slides as $slide ) {

				$tempus_image_url = (!empty($slide['tempus_slider_images_image'])) ? $slide['tempus_slider_images_image'] : false;
				$portfolio_main = wp_get_attachment_image_src( tempus_get_image_attr($tempus_image_url), 'full' );
				$tempus_ratio = ($portfolio_main[2] > 0) ? $portfolio_main[1]/$portfolio_main[2] : '1.77';
				$tempus_slide_title = $slide['title'];
				$tempus_slide_url = $slide['tempus_slider_images_url'];
				$tempus_slide_subtitle = $slide['tempus_slider_images_subtitle'];

				get_template_part('/templates/content/content', 'slide-lightbox');

			}

		} else { ?>

			<?php get_template_part('/templates/content/content', 'slider-latest-lightbox'); ?>

		<?php } ?>

	</div>
</div>

<?php get_footer(); ?>
