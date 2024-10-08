<?php
/**
 * The Archive template file.
 * @package WordPress
 */

get_header(); ?>

<?php
$tempus_columns = 'portfolio-three';
$allow_multi_items = true;
$queried_object = get_queried_object();

get_template_part('/templates/content/content', 'masonry');

tempus_load_more( array($queried_object->term_taxonomy_id), 'portfolio-three' );

if ( function_exists('ot_get_option') && ot_get_option('infinite_off') != 'off') {
  tempus_get_appear('.load-more');
}

get_footer(); ?>
