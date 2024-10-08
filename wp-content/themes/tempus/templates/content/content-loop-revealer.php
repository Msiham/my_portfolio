<?php
/**
 * Revealer portfolio loop template part
 */

if (has_post_thumbnail()) {
	$portfolio_main = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tempus_blog-main' );
	$image_url = $portfolio_main[0];
} else {
	$thumb = get_template_directory_uri() . '/assets/images/noimage.png';
}

	$thumbnail_url = get_the_permalink();

	if ( get_post_meta($post->ID, 'tempus_show_aslightbox', true) == "on" ) {
		$thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		$thumbnail_url = esc_url($thumbnail_data[0]);
		if (get_post_meta($post->ID, 'tempus_video_link', TRUE)) { $thumbnail_url = esc_url(get_post_meta($post->ID, 'tempus_video_link', TRUE)); }
	}

	$tempus_customurl = get_post_meta($post->ID, 'tempus_customurl', TRUE);

	$delay = rand (50, 500); ?>

	<div class="revealer-item" data-delay="<?php echo esc_attr($delay); ?>" data-id="<?php the_ID(); ?>" style="background-image: url('<?php echo esc_url($thumb[0]); ?>');">
		<div class="loader"></div>
		<a href="<?php echo esc_url( $portfolio_link = ($tempus_customurl) ?: $thumbnail_url ); ?>" class="portfolio-link <?php if ( get_post_meta($post->ID, 'tempus_video_link', TRUE) && get_post_meta($post->ID, 'tempus_show_aslightbox', true) == 'on' ) { echo 'video-popup'; } ?>" <?php if ( get_post_meta($post->ID, 'tempus_show_aslightbox', true) == 'on' ) { echo 'data-fancybox="group"'; } ?> data-fancybox-group="examples"></a>
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
