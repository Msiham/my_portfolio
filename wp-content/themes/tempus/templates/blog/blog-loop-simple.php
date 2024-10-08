<?php
/**
 * Blog simple template part
 */

$addclass = '';
$thumbnail_url = get_template_directory_uri() . '/assets/images/noimage.png';
$rand = rand (0, 400);

if ( function_exists('get_post_format') && get_post_format($post->ID) == 'link' ) {
	$link = get_the_content();
	$link = strip_tags($link);
}

if (has_post_thumbnail()) {
	$thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'tempus_blog-main' );
	$thumbnail_url = $thumbnail_data[0];
} ?>

	<article <?php post_class('loop blog-item simple-post wow fadeIn '); ?> id="post-<?php the_ID(); ?>" data-id="<?php the_ID(); ?>" data-wow-delay="<?php echo esc_attr($rand);?>ms">

		<?php if (function_exists('get_post_format') && get_post_format() != 'link' && get_post_format() != "quote") { ?>

			<div class="post-data added-background">

				<div class="data-inner">

					<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

					<p><?php
						if (get_the_content()) {
							echo strip_shortcodes(wp_trim_words( get_the_content(), 35 ));
						}	elseif (function_exists('pb_page_builder')) {
							pb_page_builder('Text');
						} ?>
					</p>

					<div class="date-number"><?php echo '<span>'.get_the_date('M').'</span> '.get_the_date('j, Y'); ?></div>

					<div class="author-name">
						<span class="post-category animated-link"><?php
					foreach((get_the_category()) as $category) {
	    			echo '<a href="' . get_category_link($category->cat_ID) . '">#' . $category->category_nicename . '</a>';
					} ?></span>
					</div>

				</div>

			</div>

			<div class="blog-image" style="background-image:url('<?php echo esc_url($thumbnail_url) ?>'); background-color: rgb(255, 255, 255);" data-adaptive-background data-ab-css-background>
				<a href="<?php the_permalink(); ?>" rel="bookmark"></a>
			</div>

		<?php } elseif (function_exists('get_post_format') && get_post_format() == 'quote') {  ?>

			<div class="post-title">
				<h2>
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h2>
			</div>

			<a href="<?php the_permalink(); ?>">
				<?php echo '<blockquote>'. wp_trim_words( get_the_content(), 65 ) .'</blockquote>'; ?>
			</a>

		<?php } elseif (function_exists('get_post_format') && get_post_format() == "video") { ?>

			<div class="post-title">
				<h2>
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h2>
				<div class="post-category"><?php the_category( ', ' ); ?></div>
			</div>

			<?php get_template_part('blog', get_post_format()); ?>

		<?php } else { ?>
			<a href="<?php echo esc_url($link); ?>" class="format-link-url"></a>
			<div class="post-title">
				<h2>
					<a href="<?php echo esc_url($link); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h2>
			</div>

			<!-- <div class="post-link"><i class="fa fa-link"></i></div> -->

		<?php } ?>

	</article>
