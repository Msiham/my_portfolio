<?php
/**
 * Gallery template part
 */

$ids = get_post_meta($post->ID, 'tempus_gallery_slider', TRUE);
$args = array(
	'post_type' => 'attachment',
	'post_status' => 'inherit',
	'post_mime_type' => 'image',
	'post__in' => explode( ",", $ids),
	'posts_per_page' => '-1',
	'orderby' => 'rand'
);

$count = '';
$galleryID = rand (1, 999);

$images_array = get_posts( $args );

if ($images_array && get_post_meta($post->ID, 'tempus_featured_gallery_style', TRUE) == 'style-3x3') { ?>

		<div id="portfolio-gallery-wrapper-<?php echo esc_html($galleryID); ?>">

			<?php foreach($images_array as $image){
				$attachment = wp_get_attachment_image_src($image->ID, 'full');
				$thumb = wp_get_attachment_image_src($image->ID, 'tempus_blog-main'); ?>

				<div class="portfolio-three portfolio-gallery-item gallery-itemid-<?php echo esc_html($galleryID); ?>">
					<div class="thumb" style="background-image:url('<?php echo esc_url($thumb[0]); ?>');"></div>
				</div>

			<?php } ?>

		</div>

		<?php tempus_getsmart($galleryID); ?>

<?php	} elseif ($images_array) { ?>

	<div class="images-container">
		<div class="justified-gallery-container">
			<div class="justified-gallery-<?php echo esc_html($galleryID); ?>">

				<?php foreach($images_array as $image){
					$attachment = wp_get_attachment_image_src($image->ID, 'full');
					$thumb = wp_get_attachment_image_src($image->ID, 'tempus_blog-main'); ?>

					<div class="slick-slide" href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group">
						<img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_html($image->post_title); ?>" />
					</div>

				<?php } ?>

			</div>
		</div>
	</div>

	<?php tempus_getjustified($galleryID); ?>

<?php
}
