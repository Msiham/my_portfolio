<?php
/**
 * The template for Comments.
 *
 */

$always_open = ( function_exists('ot_get_option') && ot_get_option('comments_open') == "on" ) ? "show-comments" : "" ;

?>

<div class="comments-inner <?php echo esc_attr($always_open); ?>">

	<div class="comments-title">
		<h4 id="comments-title">
			<?php	esc_html_e('Comments', 'tempus'); ?>
		</h4>
	</div>

	<a name="comments"></a>

	<div class="comments-container">

		<?php if (post_password_required()) : ?>
			<p><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'tempus' ); ?></p>
		<?php

			return;

			endif;

		if (have_comments()) :

			if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>

				<div id="pagination" class="pagination">
					<?php paginate_comments_links( array( 'prev_text' => '', 'next_text' => '' ) ); ?>
				</div>

			<?php endif; ?>

			<ol class="commentlist">
				<?php wp_list_comments(array('avatar_size' => 60)); ?>
			</ol>

			<?php

		else :

			if ( !comments_open() ) : ?>

				<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'tempus' ); ?></p>

			<?php endif;

		endif; ?>

	</div>

	<div class="comments-container">
		<?php comment_form(); ?>
	</div>

</div>
