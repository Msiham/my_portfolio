<?php
/**
 * Template Name: Portfolio Slider - Pointy
 *
 * Iya:) Custom portfolio template.
*/

get_header(); ?>

<div class="pointy-slider-wrapper">
	<ul class="pointy-slider">

		<?php if ( get_post_meta($post->ID, 'tempus_slider_images', true) ) {

			$slides = get_post_meta($post->ID, 'tempus_slider_images', true);
			$i = 0;

			foreach ( $slides as $slide ) { $i++;

				$image_url = $slide['tempus_slider_images_image'];
				$slide_title = $slide['title'];
				$slide_url = $slide['tempus_slider_images_url'];
				$slide_subtitle = $slide['tempus_slider_images_subtitle']; ?>

				<li class="<?php echo esc_html($is_visible = ( $i == 1 ) ? 'is-visible' : ''); ?>">
					<div class="pointy-half-block image <?php if (get_post_meta($post->ID, 'tempus_portfolio_color', true)) { echo "custom-background"; } ?>" style="background-image: url('<?php echo esc_url($image_url); ?>');" data-adaptive-background data-ab-css-background>
						<a href="<?php echo esc_url($slide_url); ?>"></a>
					</div>

					<div class="pointy-half-block content added-background" style="background: <?php echo esc_attr(get_post_meta($post->ID, 'tempus_portfolio_color', true)); ?>">
						<div>
							<h2><a href="<?php echo esc_url($slide_url); ?>"><?php echo esc_html($slide_title); ?></a></h2>
							<?php if ($slide_subtitle) { ?> <p><?php echo esc_html($slide_subtitle); ?></p><?php  } ?>
						</div>
					</div>
				</li>

			<?php }

		} else { ?>

			<?php $exclude = $image_url = ''; $i = 0;
			$posts_per_page = (  get_post_meta($post->ID, 'tempus_slider_count', true)) ?: 4;
			$filters = is_page() ? get_post_meta($post->ID, 'tempus_portfolio_filters', true) : get_post_meta($post->ID, 'tempus_recent_filters', true);
			$themeworm_slug = ( get_option('themeworm_slug') ) ?: 'portfolio-item';

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

			if ( $slider_query->have_posts() ) { while ($slider_query->have_posts()) : $slider_query->the_post(); $i++;

				if (has_post_thumbnail() && !post_password_required()) {
					$portfolio_main = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
					$image_url = $portfolio_main[0];
				} ?>

				<li class="<?php echo esc_html($is_visible = ( $i == 1 ) ? 'is-visible' : ''); ?>">
					<div class="pointy-half-block image <?php if (get_post_meta($post->ID, 'tempus_portfolio_color', true)) { echo "custom-background"; } ?>" style="background-image: url('<?php echo esc_url($image_url); ?>');" data-adaptive-background data-ab-css-background>
						<a href="<?php echo get_the_permalink(); ?>"></a>
					</div>

					<div class="pointy-half-block content added-background" style="background: <?php echo esc_attr(get_post_meta($post->ID, 'tempus_portfolio_color', true)); ?>">
						<div>
							<h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
							<?php if (get_post_meta(get_the_ID(), 'tempus_portfolio_subtitle', true)) { ?> <p><?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_portfolio_subtitle', true)); ?></p><?php  } ?>
						</div>
					</div>
				</li>

			<?php endwhile; } ?>

			<?php wp_reset_postdata(); ?>

		<?php } ?>

	</ul>
</div>

<?php get_footer(); ?>
