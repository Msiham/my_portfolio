<?php
/**
 * Tilt portfolio loop template part
 */

$rand = rand (0, 400);
if (has_post_thumbnail()) {
	$portfolio_main = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
	$ratio = ($portfolio_main[2] > 0) ? $portfolio_main[1]/$portfolio_main[2] : '';
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'tempus_blog-main' );
} else {
	$thumb = get_template_directory_uri() . '/assets/images/noimage.png';
	$ratio = 1;
}

	$tilt_width = ( $thumb[1] > 380 ) ? 380 : $thumb[1];
	$tilt_height = ( $thumb[2] > 380 ) ? 380 : $thumb[2];

	$tilt_style = new tempus_GetGlobal();
	$tempus_tilt_style = $tilt_style->tilt_style;
	// global $tempus_tilt_style;
	// $tempus_tilt_style = 'tilt-vertical';

	if ( $tempus_tilt_style == 'tilt-vertical' ) {
		$tilt_width = 300;
		$tilt_height = 415;
	} elseif ( $tempus_tilt_style == 'tilt-horizontal' ) {
		$tilt_width = 380;
		$tilt_height = 190;
	} else {
		if ( $ratio > 0 ) {
			$tilt_height = $tilt_width/$ratio;
		} else {
			$tilt_width = $tilt_height*$ratio;
		}
	}

	$style_wh = 'style="width:' . esc_html($tilt_width) . 'px; height:' . esc_html($tilt_height) . 'px;"';

	$thumbnail_url = get_the_permalink();

	if ( get_post_meta($post->ID, 'tempus_show_aslightbox', true) == "on" ) {
		$thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
		$thumbnail_url = esc_url($thumbnail_data[0]);
		if (get_post_meta($post->ID, 'tempus_video_link', TRUE)) { $thumbnail_url = esc_url(get_post_meta($post->ID, 'tempus_video_link', TRUE)); }
	}

	$tempus_customurl = get_post_meta($post->ID, 'tempus_customurl', TRUE); ?>

	<a href="<?php echo esc_url( $portfolio_link = ($tempus_customurl) ?: $thumbnail_url ); ?>" class="tilt-item wow fadeIn" data-id="<?php the_ID(); ?>" <?php if ( get_post_meta($post->ID, 'tempus_show_aslightbox', true) == 'on' ) { echo 'data-fancybox="group"'; } ?> data-fancybox-group="examples" <?php echo esc_attr($style_wh); ?> data-wow-delay="<?php echo esc_attr($rand);?>ms">

		<div class="tilt-figure">

			<div class="tilt-image" style="background-image: url(<?php echo esc_url($thumb[0]); ?>)" title="<?php the_title();?>"></div>

			<div class="tilt-deco tilt-deco--shine"><div></div></div>

			<div class="tilt-caption">

				<h6><?php the_title();?></h6>

				<p>
					<?php	$terms = get_the_terms( $post->ID, 'filters');
					if ( $terms ) {
						foreach ( $terms as $term ) {
							echo esc_html( $term->name ) . ' ';
						}
					} ?>
				</p>

			</div>

			<svg class="tilt-deco tilt-deco--lines" viewBox="0 0 <?php echo esc_html($tilt_width . ' ' . $tilt_height); ?>">
				<path d="M20.5,20.5h<?php echo esc_html($tilt_width - 40);?>v<?php echo esc_html($tilt_height - 40);?>h-<?php echo esc_html($tilt_width - 40);?>V20.5z" />
			</svg>

		</div>

	</a>
