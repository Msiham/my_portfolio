<?php
/**
 * Gallery template part
 */

$masonry_style = '';
$thumbnail_url = get_template_directory() . '/assets/images/noimage.png';

$ids = get_post_meta($post->ID, 'tempus_gallery_slider', TRUE);
$args = array(
  'post_type' => 'attachment',
  'post_status' => 'inherit',
  'post_mime_type' => 'image',
  'post__in' => explode( ",", $ids),
  'posts_per_page' => '-1',
  'orderby' => 'post__in'
);

$images_array = get_posts( $args );
$galleryID = rand (1, 999);
$fullwidth_class = (get_post_meta($post->ID, 'tempus_gallery_fullwidth', TRUE) == "off") ? 'container' : ''; ?>

<div class="container title_container <?php if (!$images_array) { echo 'no-thumb'; } ?>">

	<?php if (get_post_meta($post->ID, 'tempus_post_primarygallery_layout', TRUE) == "slider-gallery" && get_post_meta($post->ID, 'tempus_gallery_slider', TRUE)) {

  	if ($images_array) { ?>
  		<div class="owl-carousel owl-theme <?php echo esc_attr($fullwidth_class) ?>">

  			<?php foreach ($images_array as $image) {
  				$attachment = wp_get_attachment_image_src($image->ID, 'full');
  				$thumb = wp_get_attachment_image_src($image->ID, 'full'); ?>

  				<a class="slick-slide" href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group" title="<?php echo esc_html($image->post_title); ?>" >
  					<img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_html($image->post_title); ?>" />
  				</a>

  			<?php } ?>

  	  </div>

  		<?php	}

	} elseif (get_post_meta($post->ID, 'tempus_post_primarygallery_layout', TRUE) == "tiled-gallery" && get_post_meta($post->ID, 'tempus_gallery_slider', TRUE))  {

  	tempus_justified_gallery( $images_array, $fullwidth_class );

  } elseif ( in_array( get_post_meta($post->ID, 'tempus_post_primarygallery_layout', TRUE), array("classic-gallery", "classic-gallery-boxed", "classic-gallery4", "classic-gallery4-boxed", "classic-gallery3-boxed", "classic-gallery3")) ) {

    if ($images_array) {
  		if ( get_post_meta($post->ID, 'tempus_post_primarygallery_layout', TRUE) == "classic-gallery4" || get_post_meta($post->ID, 'tempus_post_primarygallery_layout', TRUE) == "classic-gallery4-boxed" ) { $count = 'four'; }
  		elseif ( get_post_meta($post->ID, 'tempus_post_primarygallery_layout', TRUE) == "classic-gallery3" || get_post_meta($post->ID, 'tempus_post_primarygallery_layout', TRUE) == "classic-gallery3-boxed" ) { $count = 'three'; }
  		else { $count = 'six'; } ?>

  		<div id="portfolio-gallery-wrapper-<?php echo esc_html($galleryID); ?>" class="boxed-style <?php echo esc_attr($fullwidth_class) ?>">

  			<?php foreach($images_array as $image){
  				$attachment = wp_get_attachment_image_src($image->ID, 'full');
  				$thumb = wp_get_attachment_image_src($image->ID, 'tempus_blog-main'); ?>

  				<div class="portfolio-<?php echo esc_attr($count); ?> portfolio-gallery-item">
  					<a href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group" title="<?php echo esc_html($image->post_title); ?>" data-caption="<?php echo esc_html($caption = ($image->post_excerpt) ?: $image->post_title ); ?>" <?php if (empty($image->post_title)) { echo 'class="no-caption"'; } ?> >
  						<div class="thumb" style="background-image:url('<?php echo esc_url($thumb[0]); ?>');"></div>
  					</a>
  				</div>

  			<?php } ?>

  		</div>

  		<?php tempus_getitemheight($galleryID); ?>
      <?php tempus_getitemmasonry($galleryID); ?>

  	<?php	}

  } elseif ( get_post_meta($post->ID, 'tempus_post_primarygallery_layout', TRUE) == "classic-gallery1" ) {
  	if ($images_array) { ?>
  		<div class="<?php echo esc_attr($fullwidth_class); ?>">
  			<?php foreach($images_array as $image){
  				$attachment = wp_get_attachment_image_src($image->ID, 'full');
  				$thumb = wp_get_attachment_image_src($image->ID, 'full'); ?>

  				<div class="portfolio-one portfolio-gallery-item">
  					<a href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group" title="<?php echo esc_html($image->post_title); ?>" data-caption="<?php echo esc_html($caption = ($image->post_excerpt) ?: $image->post_title ); ?>" >
  						<div class="one-gallery"><img src="<?php echo esc_url($thumb[0]); ?>" /></div>
  					</a>
  				</div>

  			<?php } ?>

  		</div>
  	<?php }
  } else {

  	if ($images_array) {

  		$masonry_columns = (get_post_meta($post->ID, 'tempus_post_primarygallery_layout', TRUE) == "masonry-gallery") ? 'portfolio-four' : 'portfolio-three';
  	?>

  		<div id="portfolio-gallery-wrapper-<?php echo esc_html($galleryID); ?>" class="boxed-style <?php echo esc_attr($fullwidth_class) ?>">
  			<?php foreach($images_array as $image){
  				$attachment = wp_get_attachment_image_src($image->ID, 'full');
  				$ratio = ($attachment[2] > 0) ? $attachment[1]/$attachment[2] : '';
  				$thumb = wp_get_attachment_image_src($image->ID, 'tempus_blog-main'); ?>
  				<div class="<?php echo esc_attr($masonry_columns); ?> portfolio-gallery-item" data-ratio="<?php echo esc_html($ratio) ?>">
  					<a href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group" title="<?php echo esc_html($image->post_title); ?>" data-caption="<?php echo esc_html($caption = ($image->post_excerpt) ?: $image->post_title ); ?>" >
  						<img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_html($image->post_title); ?>" />
  					</a>
  				</div>
  			<?php } ?>
  		</div>

  		<?php tempus_getitemmasonry($galleryID); ?>

  	<?php }
  } ?>
