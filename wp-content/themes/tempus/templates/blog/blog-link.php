<?php
/**
 * Link template part
 */

$thumbnail_url = '';

if (has_post_thumbnail()) {
	$thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	$thumbnail_url = $thumbnail_data[0];
}

$title_class = ( get_post_meta(get_the_ID(), 'tempus_title_height', true) ) ?: 'titleheight-standard'; ?>

<div class="container title_container <?php echo esc_html($title_class); if (!has_post_thumbnail()) { echo ' no-thumb'; } ?>" style="background-image:url('<?php echo  esc_url($thumbnail_url); ?>');">
