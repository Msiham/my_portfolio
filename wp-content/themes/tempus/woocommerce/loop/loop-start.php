<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version   9.9.0
 */

$sidebar = "";
if (function_exists('ot_get_option') && ot_get_option('woo_sidebar') == "left-sidebar" || ot_get_option('woo_sidebar') == "right-sidebar") {
	$sidebar = "sidebar-exist";
}

if ( function_exists('ot_get_option') && ot_get_option('blog_layout') != "no-sidebar" || !function_exists('ot_get_option') ) { ?>
	<div class="project-navigation woocommerce-navigation" role="navigation"><a href="#0" class="sidebar-btn"><span></span></a></div>
<?php } ?>

<div id="shop-wrapper" class="products <?php echo esc_attr($sidebar); ?>">
