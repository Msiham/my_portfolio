<?php
/**
 * Standard template part
 */

$thumbnail_url = get_template_directory_uri() . '/assets/images/noimage.png';

if (has_post_thumbnail()) {
	$thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	$thumbnail_url = $thumbnail_data[0];
}

$title_class = ( get_post_meta(get_the_ID(), 'tempus_title_height', true) ) ?: 'titleheight-standard'; ?>

<div class="container title_container <?php echo esc_html($title_class); ?>" style="background-image:url('<?php echo  esc_url($thumbnail_url); ?>');">

	<a href="<?php echo esc_url($thumbnail_url); ?>" data-fancybox="group" class="blog-link"></a>
