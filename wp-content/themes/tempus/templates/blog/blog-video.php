<?php
/**
 * Standard template part
 */

$fullwidth_class = (get_post_meta($post->ID, 'tempus_gallery_fullwidth', TRUE) == "off") ? 'container' : ''; ?>

<div class="container title_container no-thumb">

<div class="portfolio_video hentry <?php echo esc_attr($fullwidth_class) ?>">
	<div class="embed video-cont"><?php echo tempus_get_video( get_post_meta( $post->ID, 'tempus_portfolio_video', true ) ); ?></div>
</div>
