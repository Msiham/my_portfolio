<?php
/**
 * The template part for displaying a message that posts cannot be found
 */
?>
<h6><?php esc_attr_e( 'Oops! No results for you, try to another search', 'tempus' ); ?></h6>

<?php get_template_part( 'searchform' ); ?>

<div class="search404_post">
	<h6 class="widget-title"><span><?php esc_attr_e( 'Latest Posts', 'tempus' ); ?></span></h6>
	<div class="widget nosearch-results nosearch-cats">
		<?php $args = array( 'numberposts' => '10' );
		$recent_posts = wp_get_recent_posts($args);
		foreach( $recent_posts as $recent ){
			echo '<li><a href="' . get_permalink($recent["ID"]) . '">' . $recent["post_title"].'</a></li>';
		}
		wp_reset_postdata(); ?>
	</div>
</div>

<div class="search404_post">
	<h6 class="widget-title"><span><?php esc_attr_e( 'Tags', 'tempus' ); ?></span></h6>
	<div class="widget nosearch-results tags-cloud">
		<?php wp_tag_cloud( 'smallest=11&largest=11' ); ?>
	</div>
</div>

<div class="search404_post">
	<h6 class="widget-title"><span><?php esc_attr_e( 'Categories', 'tempus' ); ?></span></h6>
	<div class="widget nosearch-results nosearch-cats">
		<ul>
			<?php wp_list_categories('number=10&title_li='); ?>
		</ul>
	</div>
</div>
