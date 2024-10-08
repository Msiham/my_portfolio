<?php
/**
 * The template part for displaying a message that posts cannot be found
 */

$fullwidth_class = (get_post_meta($post->ID, 'tempus_gallery_fullwidth', TRUE) == "off") ? 'container' : '';
$tempus_portfolio_video = get_post_meta( $post->ID, 'tempus_portfolio_video', true ) ?: get_post_meta( $post->ID, 'tempus_title_video', true ); ?>

<div class="portfolio_video hentry <?php echo esc_attr($fullwidth_class) ?>">
	<div class="embed video-cont"><?php echo tempus_get_video( $tempus_portfolio_video ); ?></div>
</div>
