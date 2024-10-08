<?php
/**
 * The sinple page portfolio template file.
 * @package WordPress
 */

get_header();

get_template_part('/templates/content/content', 'portfolio');

if ( function_exists('ot_get_option') && ot_get_option('recent_portfolio') != 'off' ) { ?>

	<div class="container container-content wow fadeIn">
		<div class="sixteen columns">
			<div class="recent-title">
				<h3>
					<?php esc_attr_e('Recent Projects', 'tempus'); ?>
				</h3>
			</div>
		</div>
	</div>

	<?php	$filters_array = (get_post_meta($post->ID, 'tempus_recent_filters', true)) ? get_post_meta($post->ID, 'tempus_recent_filters', true) : '';

	$columns = ( function_exists('ot_get_option') && ot_get_option('default_style') ) ? ot_get_option('default_style') : 'portfolio-four';

	get_template_part('/templates/content/content', 'masonry');

	tempus_load_more( $filters_array, $columns );

	if ( function_exists('ot_get_option') && ot_get_option('infinite_off') == 'on' ) { tempus_get_appear('#footer'); }

}

get_footer(); ?>
