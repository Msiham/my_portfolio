<?php
/**
 * The Archive template file.
 * @package WordPress
 */

get_header(); ?>

<?php
$columns = 'portfolio-three';
$allow_multi_items = true;
$filters_array = array();

get_template_part('/templates/content/content', 'masonry');

tempus_load_more( $filters_array, 'portfolio-three' );

if ( function_exists('ot_get_option') && ot_get_option('infinite_off') != 'off') {
  tempus_get_appear('.load-more');
}

get_footer(); ?>
