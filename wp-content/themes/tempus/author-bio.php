<?php
/**
 * The template for displaying Author bio
  */
?>

<div class="author-info">
	<div class="author-avatar">
		<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 96 );	?>
		</a>
	</div>

	<div class="author-description animated-link">
		<h3 class="author-title"><?php echo get_the_author(); ?></h3>

		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p>
		<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php printf( esc_html__( 'View all posts by %s', 'tempus' ), get_the_author() ); ?>
		</a>

	</div>
</div>
