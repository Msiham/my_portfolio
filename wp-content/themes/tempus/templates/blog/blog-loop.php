<?php
/**
 * Blog template part
 */

$addclass = $thumbnail_url = '';
$rand = rand (0, 400);

if ( function_exists('get_post_format') && get_post_format($post->ID) == 'link' ) {
	$link = get_the_content();
	$link = strip_tags($link);
}

if (has_post_thumbnail()) {
	$global_size = new tempus_GetGlobal;
	$image_size = ($global_size->big_image) ? 'full' : 'tempus_blog-main';
	$thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $image_size );
	$thumbnail_url = $thumbnail_data[0];
} ?>

<article <?php post_class('loop one-third column blog-item wow fadeIn '); ?> id="post-<?php the_ID(); ?>" data-id="<?php the_ID(); ?>" data-wow-delay="<?php echo esc_attr($rand);?>ms">

	<?php if (function_exists('get_post_format') && get_post_format() != 'link' && get_post_format() != "quote") { ?>

		<a href="<?php the_permalink(); ?>" rel="bookmark" class="blog-link"></a>

		<div class="blog-image" style="background-image:url('<?php echo esc_url($thumbnail_url) ?>')"></div>

		<div class="post-title">
			<h2><?php the_title(); ?></h2>
		</div>

		<div class="date-number"><?php echo '<span>'.get_the_date('M').'</span> '.get_the_date('j, Y'); ?></div>

	<?php } elseif (function_exists('get_post_format') && get_post_format() == 'quote') {  ?>

		<div class="post-title">
			<h2>
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h2>
		</div>

		<div class="post-quote"><i class="fa fa-quote-right"></i></div>

		<a href="<?php the_permalink(); ?>" class="blog-link"></a>
		<?php echo '<blockquote>'. wp_trim_words( get_the_content(), 65 ) .'</blockquote>'; ?>


	<?php } else { ?>
		<a href="<?php echo esc_url($link); ?>" class="blog-link"></a>
		<div class="post-title">
			<h2>
				<a href="<?php echo esc_url($link); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h2>
		</div>

		<div class="post-link"><i class="fa fa-link"></i></div>

	<?php } ?>

</article>
