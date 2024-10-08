<?php
/**
 * Portfolio template part Content
 */

if (get_post_meta($post->ID, 'tempus_portfolio_video', TRUE) && get_post_meta($post->ID, 'tempus_video_gallery', TRUE) != 'image-only' && !post_password_required()) {
 	get_template_part('/templates/content/content', 'video');
}

if ( !post_password_required() && get_post_meta($post->ID, 'tempus_video_gallery', TRUE) != 'video-only' && get_post_meta($post->ID, 'tempus_content_order', TRUE) == 'images-content' || !get_post_meta($post->ID, 'tempus_content_order', TRUE) && !post_password_required()) {
	get_template_part('/templates/content/content', 'gallery');
} ?>

<?php while (have_posts()) : the_post();
if ( !in_array( get_post_meta($post->ID, 'tempus_gallery_layout', TRUE), array("half-gallery-left", "half-gallery-right")) && get_post_meta($post->ID, 'tempus_hide_content', TRUE) != 'on' ) { ?>

	<div class="container">
		<div class="sixteen columns hentry portfolio-text <?php if ($post->post_content == '') { echo 'no-text'; } ?> wow fadeIn">
			<?php if ( ! post_password_required() ) {
				the_content();
			} else {
				echo get_the_password_form();
			} ?>
		</div>
	</div>

<?php }
if ( in_array( get_post_meta($post->ID, 'tempus_gallery_layout', TRUE), array("half-gallery-left", "half-gallery-right")) && post_password_required() ) { ?>

	<div class="container">
		<div class="sixteen columns hentry portfolio-text wow fadeIn">
			<?php echo get_the_password_form(); ?>
		</div>
	</div>

<?php }
 endwhile; ?>

<?php if ( !post_password_required() && get_post_meta($post->ID, 'tempus_video_gallery', TRUE) != 'video-only' && get_post_meta($post->ID, 'tempus_content_order', TRUE) == 'content-images') {
	get_template_part('/templates/content/content', 'gallery');
} ?>

<?php tempus_share(); ?>
