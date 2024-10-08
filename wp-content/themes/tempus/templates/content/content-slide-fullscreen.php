<?php
/**
 * The template part for displaying a slide
 */

$get_slides = new tempus_GetGlobal();
$slider_image_url = (!empty($get_slides->image_url)) ? $get_slides->image_url : get_template_directory_uri() . '/assets/images/placeholder.jpg'; ?>

	<a class="slick-slide" href="<?php echo esc_url($get_slides->slide_url); ?>">
		<div class="fullscreen-title">
			<div id="page-title" class="<?php if ( $get_slides->slide_subtitle ) { echo 'has-subtitle'; } ?> wow fadeIn">
				<h1><?php echo esc_html($get_slides->slide_title); ?></h1>
				<?php if ( $get_slides->slide_subtitle ) { ?>
					<div class="subtitle">
						<p><?php echo esc_html($get_slides->slide_subtitle); ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
		<img src="<?php echo esc_url($slider_image_url); ?>" data-ratio="<?php echo esc_html($get_slides->ratio) ?>" alt="<?php echo esc_html($get_slides->slide_title); ?>" />
	</a>
