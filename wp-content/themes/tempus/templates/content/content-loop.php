<?php
/**
 * Masonry portfolio loop template part
 */

$columns = new tempus_GetGlobal();
$rand = rand (0, 400);

$ratio = $image_url = '';

$image_size = ($columns->masonry) ? "tempus_blog-main" : "tempus_portfolio-main";

$columns_style = ($columns->masonry) ? $columns->columns . ' masonry-item' : $columns->columns;

$columns_style .= ( $columns->enable_mixed && get_post_meta($post->ID, 'tempus_preview_size', TRUE)) ? ' ' . get_post_meta($post->ID, 'tempus_preview_size', TRUE) . ' ' : '';

if (has_post_thumbnail()) {
	$portfolio_main = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $image_size );
	$ratio = ($portfolio_main[2] > 0) ? $portfolio_main[1]/$portfolio_main[2] : '';
	$image_url = $portfolio_main[0];
} else {
	$image_url = get_template_directory_uri() . '/assets/images/placeholder.jpg';
	$ratio = 1;
}

$video_ratio = (function_exists('ot_get_option') && ot_get_option('video_ratio')) ? ot_get_option('video_ratio') : '';
$video_ratio = (get_post_meta($post->ID, 'tempus_current_video_ratio', true) && "none" != get_post_meta($post->ID, 'tempus_current_video_ratio', true)) ? get_post_meta($post->ID, 'tempus_current_video_ratio', true) : $video_ratio;

$thumbnail_url = get_the_permalink();

if ( get_post_meta($post->ID, 'tempus_show_aslightbox', true) == "on" ) {
	$thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
	$thumbnail_url = esc_url($thumbnail_data[0]);
	if (get_post_meta($post->ID, 'tempus_video_link', TRUE)) {
		$thumbnail_url = esc_url(get_post_meta($post->ID, 'tempus_video_link', TRUE));
		// $video_data_caption = 'data-caption="' . get_post_meta($post->ID, 'tempus_portfolio_subtitle', TRUE) . '"';
	}
	if (get_post_meta($post->ID, 'tempus_selfvideo_link', TRUE)) {
		$thumbnail_url = esc_url(get_post_meta($post->ID, 'tempus_selfvideo_link', TRUE));
		// $video_data_caption = 'data-caption="' . get_post_meta($post->ID, 'tempus_portfolio_subtitle', TRUE) . '"';
	}
	if (get_post_meta($post->ID, 'tempus_portfolio_subtitle', TRUE)) {
		// $video_data_caption = 'data-caption="' . esc_attr(get_post_meta($post->ID, 'tempus_portfolio_subtitle', TRUE)) . '"';
	}
}

$video_data_caption = array();
$video_data_caption[] = 'data-caption="';
$video_data_caption[] = (function_exists('ot_get_option') && ot_get_option('lightbox_captions') == 'subtitle') ? esc_attr(get_post_meta($post->ID, 'tempus_portfolio_subtitle', TRUE)) : get_the_title();
$video_data_caption[] = '"';

$tempus_customurl = get_post_meta($post->ID, 'tempus_customurl', TRUE); ?>

<div class="portfolio_sizer"></div>
<div <?php post_class(esc_html($columns_style).' portfolio-item-slug wow fadeIn '); ?> id="post-<?php the_ID(); ?>" data-id="<?php the_ID(); ?>" data-wow-delay="<?php echo esc_attr($rand);?>ms">
	<div class="picture">
		<a href="<?php echo esc_url( $portfolio_link = ($tempus_customurl) ?: $thumbnail_url ); ?>"
			class="portfolio-link <?php if ( get_post_meta($post->ID, 'tempus_video_link', TRUE) && get_post_meta($post->ID, 'tempus_show_aslightbox', true) == 'on' ) { echo 'video-popup'; } ?>"
			<?php if ( get_post_meta($post->ID, 'tempus_show_aslightbox', true) == 'on' && !get_post_meta($post->ID, 'tempus_video_link', TRUE) ) { echo 'data-ratio="' . $video_ratio . '" data-fancybox="group"'; }

			echo implode('', $video_data_caption);

			if (get_post_meta($post->ID, 'tempus_video_link', TRUE) && !(get_post_meta($post->ID, 'tempus_selfvideo_link', TRUE))) { echo ' data-ratio="' . $video_ratio . '" data-fancybox="group"'; }

			if (get_post_meta($post->ID, 'tempus_selfvideo_link', TRUE)) { echo ' data-ratio="' . $video_ratio . '" data-fancybox'; } ?> >

			<?php if ( get_post_meta($post->ID, 'tempus_show_infobutton', true) == 'on' && get_post_meta($post->ID, 'tempus_show_aslightbox', true) == 'on' && function_exists('ot_get_option') && ot_get_option('portfolio_additional_info')) { ?>
				<a href="<?php echo get_the_permalink(); ?>" class="video-info-icon"></a>
			<?php } ?>

			<?php if ( $columns->allow_multi_items && get_post_meta($post->ID, 'tempus_gallery_slider', TRUE) && get_post_meta($post->ID, 'tempus_featured_gallery', true) == "on" ) { ?>

				<?php get_template_part('/templates/content/content', 'items-gallery'); ?>

			<?php } else { ?>

				<div class="thumb" data-ratio="<?php echo esc_html($ratio) ?>" style="background-image:url('<?php echo esc_url($image_url); ?>');"></div>

				<?php if ( get_post_meta($post->ID, 'tempus_hover_image', true) ) { ?>
					<div class="thumb-hover" style="background-image:url('<?php echo esc_url(get_post_meta($post->ID, 'tempus_hover_image', true)); ?>');"></div>
				<?php } ?>

			<?php } ?>
		</a>
	</div>

	<div class="item-description alt">
		<h6><?php the_title();?></h6>
	</div>
	<div class="item-filter">
		<?php	$terms = get_the_terms( $post->ID, 'filters');
		if ( $terms ) {
			foreach ( $terms as $term ) {
				echo esc_html( $term->name ) . ' ';
			}
		} ?>
	</div>

</div>
