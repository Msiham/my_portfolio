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
	'orderby' => 'post__in'
);

$count = '';
$galleryID = rand (1, 999);
$fullwidth_class = (get_post_meta($post->ID, 'tempus_gallery_fullwidth', TRUE) == "off") ? 'container' : '';

$images_array = get_posts( $args );

if (get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) == "slider-gallery" ) {

	if ($images_array) { ?>

		<div class="owl-carousel owl-theme <?php echo esc_attr($fullwidth_class) ?>">

			<?php foreach($images_array as $image){
				$attachment = wp_get_attachment_image_src($image->ID, 'full');
				$thumb = wp_get_attachment_image_src($image->ID, 'full'); ?>

				<a class="slick-slide" href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group" title="<?php echo esc_html($image->post_title); ?>" >
					<img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_html($image->post_title); ?>" />
				</a>

			<?php } ?>

		</div>

		<?php
	}

}  elseif ( get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) == "classic-gallery" || get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) == "classic-gallery4" || get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) == "classic-gallery3" ) {

	if ($images_array) {
		if (get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) == "classic-gallery4") { $count = 'four'; }
		elseif (get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) == "classic-gallery3") { $count = 'three'; }
		else { $count = 'six'; } ?>

		<div id="portfolio-gallery-wrapper-<?php echo esc_html($galleryID); ?>" class="boxed-style <?php echo esc_attr($fullwidth_class) ?>">

			<?php foreach($images_array as $image) {
				$attachment = wp_get_attachment_image_src($image->ID, 'full');
				$thumb = wp_get_attachment_image_src($image->ID, 'full'); ?>

				<div class="portfolio-<?php echo esc_attr($count); ?> portfolio-gallery-item">
					<a href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group" <?php if (!empty($image->post_excerpt) || !empty($image->post_title)) { ?> data-caption="<?php echo esc_html($caption = ($image->post_excerpt) ?: $image->post_title ); ?>" title="<?php echo esc_html($image->post_title); ?>" <?php } else { echo 'class="no-caption" data-caption=""'; } ?> >
						<div class="thumb" style="background-image:url('<?php echo esc_url($thumb[0]); ?>');"></div>
					</a>
				</div>

			<?php } ?>

		</div>

		<?php tempus_getitemheight($galleryID); ?>
		<?php tempus_getitemmasonry($galleryID); ?>

	<?php	}
} elseif ( get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) == "classic-gallery1" || get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) == "classic-gallery-small" || get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) == "classic-gallery-normal" ) {
	if ($images_array) {

		$fullwidth_class .= ( get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) == "classic-gallery-small" ||  get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) == "classic-gallery-normal" ) ? ' ' . get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) : ''; ?>
		<div class="<?php echo esc_attr($fullwidth_class) ?>">
			<?php foreach($images_array as $image){
				$attachment = wp_get_attachment_image_src($image->ID, 'full');
				$thumb = wp_get_attachment_image_src($image->ID, 'full'); ?>

				<div class="portfolio-one portfolio-gallery-item">
					<a href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group" title="<?php echo esc_html($image->post_title); ?>" data-caption="<?php echo esc_html($caption = ($image->post_excerpt) ?: $image->post_title ); ?>" >
						<img src="<?php echo esc_url($thumb[0]); ?>" />
					</a>
				</div>

			<?php } ?>

		</div>
	<?php }
} elseif (get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) == "tiled-gallery" ) {

	if ($images_array) { ?>

		<div class="images-container <?php echo esc_attr($fullwidth_class) ?>">
			<div class="justified-gallery-container">
				<div class="justified-gallery">

					<?php foreach($images_array as $image){
						$attachment = wp_get_attachment_image_src($image->ID, 'full');
						$thumb = wp_get_attachment_image_src($image->ID, 'full'); ?>

						<a class="slick-slide" href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group" title="<?php echo esc_html($image->post_title); ?>" data-caption="<?php echo esc_html($caption = ($image->post_excerpt) ?: $image->post_title ); ?>" >
							<img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_html($image->post_title); ?>" />
						</a>

					<?php } ?>

				</div>
			</div>
		</div>

<?php
	}
} elseif ( in_array( get_post_meta($post->ID, 'tempus_gallery_layout', TRUE), array("half-gallery-left", "half-gallery-right")) ) {

	if ($images_array) { ?>

		<div class="images-container half-container <?php echo esc_attr($fullwidth_class . ' ' . get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) ) ?>">
			<div class="half-gallery-container">
				<div class="half-gallery">

					<?php foreach($images_array as $image){
						$attachment = wp_get_attachment_image_src($image->ID, 'full');
						$thumb = wp_get_attachment_image_src($image->ID, 'full'); ?>

						<a class="slick-slide half-slide" href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group" title="<?php echo esc_html($image->post_title); ?>" data-caption="<?php echo esc_html($caption = ($image->post_excerpt) ?: $image->post_title ); ?>" >
							<img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_html($image->post_title); ?>" />
						</a>

					<?php } ?>

				</div>
			</div>

			<div class="half-text-container">
				<div class="sticky-text">
					<h1><?php echo get_the_title(); ?></h1>
					<?php while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>

	<?php	} else { ?>

		<div class="images-container half-container <?php echo esc_attr($fullwidth_class . ' ' . get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) ) ?>">
			<div class="half-gallery-container">
				<div class="half-gallery">

					<?php $attachment = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ); ?>

					<a class="slick-slide half-slide" href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group" data-caption="<?php echo esc_html($caption = ($image->post_excerpt) ?: $image->post_title ); ?>">
						<img src="<?php echo esc_url($attachment[0]); ?>" />
					</a>

				</div>
			</div>

			<div class="half-text-container">
				<div class="sticky-text">
					<h1><?php echo get_the_title(); ?></h1>
					<?php while (have_posts()) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>

	<?php }

} else {

	if ($images_array) {

		$masonry_columns = (get_post_meta($post->ID, 'tempus_gallery_layout', TRUE) == "masonry-gallery") ? 'portfolio-four' : 'third-masonry';
	?>

		<div id="portfolio-gallery-wrapper-<?php echo esc_html($galleryID); ?>"  class="boxed-style <?php echo esc_attr($fullwidth_class) ?>">
			<?php foreach($images_array as $image){
				$attachment = wp_get_attachment_image_src($image->ID, 'full');
				$ratio = ($attachment[2] > 0) ? $attachment[1]/$attachment[2] : '';
				$thumb = wp_get_attachment_image_src($image->ID, 'tempus_blog-main'); ?>
				<div class="<?php echo esc_attr($masonry_columns); ?> portfolio-gallery-item item-<?php echo esc_html($galleryID); ?>" data-ratio="<?php echo esc_html($ratio) ?>">
					<a href="<?php echo esc_url($attachment[0]); ?>" class="masonry-link" data-fancybox="group" title="<?php echo esc_html($image->post_title); ?>" data-caption="<?php echo esc_html($caption = ($image->post_excerpt) ?: $image->post_title ); ?>" >
						<img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_html($image->post_title); ?>" />
					</a>
				</div>
			<?php } ?>
		</div>

		<?php tempus_getitemmasonry($galleryID); ?>

	<?php }
}

	if (!$images_array && !in_array( get_post_meta($post->ID, 'tempus_gallery_layout', TRUE), array("half-gallery-left", "half-gallery-right"))) {
		if ( has_post_thumbnail() && get_post_meta($post->ID, 'tempus_show_featured', TRUE) != "off" ) {
			$thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
			$thumbnail_url = $thumbnail_data[0];
			$not_resize = (get_post_meta($post->ID, 'tempus_portfolio_featuredsize', TRUE) != "standard-size") ? get_post_meta($post->ID, 'tempus_portfolio_featuredsize', TRUE) : ''; ?>

			<div class="image-featured <?php echo esc_attr($not_resize) ?>">
				<img src="<?php echo esc_url($thumbnail_url) ?>" />
			</div>

		<?php }
	} ?>
