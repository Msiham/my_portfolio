<?php
/**
 * Template Name: Portfolio Slider - Vegas
 *
 * Iya:) Custom portfolio template.
*/

get_header();

$slider_images = $image_url = $exclude = $slider_attrs = '';
$themeworm_slug = ( get_option('themeworm_slug') ) ?: 'portfolio-item';

if ( get_post_meta($post->ID, 'tempus_slider_images', true) ) {

	$title = ( get_post_meta(get_the_ID(), 'tempus_title_text', true) ) ?: get_the_title();
	$slides = get_post_meta($post->ID, 'tempus_slider_images', true); ?>

	<div class="fullscreen-title vegas-title">
		<div id="page-title" class="<?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_title_style', true));  if ( get_post_meta(get_the_ID(), 'tempus_subtitle', true) || get_post_meta(get_the_ID(), 'tempus_subtitle_url', true) ) { echo ' has-subtitle'; } ?> wow fadeIn">

			<h1 style="color:<?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_title_color', true)); ?>;"><?php echo esc_html($title); ?></h1>

			<?php if ( get_post_meta(get_the_ID(), 'tempus_subtitle', true) || get_post_meta(get_the_ID(), 'tempus_subtitle_url', true) ) { ?>
				<?php tempus_subtitle(); ?>
			<?php } ?>

			<style>
				#page-title h1, .fullscreen-title .subtitle {
					color:<?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_title_color', true)); ?>;
				}
			</style>

		</div>
	</div>

	<?php foreach ( $slides as $slide ) {

		$image_url = $slide['tempus_slider_images_image'];
    $slider_images .= "{ src: '" . esc_url($image_url) . "' },";
		$slider_attrs .= '["' . $slide['title'] . '", "' . $slide['tempus_slider_images_subtitle'] . '"],';

	}

	tempus_vegas_slides($slider_images, $slider_attrs);

} else {

	$posts_per_page = (  get_post_meta($post->ID, 'tempus_slider_count', true)) ?: 4;
	$filters = is_page() ? get_post_meta($post->ID, 'tempus_portfolio_filters', true) : get_post_meta($post->ID, 'tempus_recent_filters', true);

	if ( empty($filters) ) {

		$slider_query_args = array(
			'post_type' => $themeworm_slug,
			'posts_per_page' => $posts_per_page,
			'meta_query' => array( array(
				'key' => '_thumbnail_id',
				'compare' => 'EXISTS'
			))
		);

	} else {

		$slider_query_args = array(
			'post_type' => $themeworm_slug,
			'posts_per_page' => $posts_per_page,
			'tax_query' => array( array(
				'taxonomy' => 'filters',
				'field' => 'id',
				'terms' => $filters,
				'operator' => 'IN',
				'include_children' => false
			)),
			'meta_query' => array( array(
				'key' => '_thumbnail_id',
				'compare' => 'EXISTS'
			))
		);

	}

	$slider_query = new WP_Query ( $slider_query_args );

  if ( $slider_query->have_posts() ) { while ($slider_query->have_posts()) : $slider_query->the_post();

    if (has_post_thumbnail() && !post_password_required()) {
      $portfolio_main = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
      $image_url = $portfolio_main[0];
    }

		$slider_images .= "{ src: '" . esc_url($image_url) . "' },";

	endwhile; }

	tempus_vegas_slides($slider_images);

	wp_reset_postdata();

} ?>

<?php get_footer(); ?>
