<?php
/**
 * Post Footer template part
 */
?>

<div class="post-footer wow fadeIn">

	<?php if ( comments_open() ) { ?>

		<div class="comments-number"><?php echo get_comments_number(); ?></div>

		<?php if ( function_exists('ot_get_option') && ot_get_option('hide_comments') != "yes" ) {
			comments_template('', true);
		} elseif (!function_exists('ot_get_option')) {
			comments_template('', true);
		} ?>

	<?php } ?>

	<span class="cats animated-link"><?php esc_html_e('Category: ', 'tempus'); the_category( ', ' ); ?></span>

	<?php if (has_tag()) { ?><span class="single-tags animated-link"> <?php the_tags(esc_html__( 'Tags: ', 'tempus' ),', '); ?></span> <?php } ?>

	<?php tempus_share(); ?>

</div>
