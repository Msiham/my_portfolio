<?php
/**
 * The template of sidebar
 */

$sidebar_name = (is_page_template('template-contact.php')) ? "tempus_sidebar2" : "tempus_sidebar1";
$sidebar_name = (function_exists('is_shop') && is_shop()) ? "tempus_woocommerce_sidebar" : $sidebar_name;

$sidebar_side = ( function_exists('ot_get_option') && ot_get_option('blog_layout') != "no-sidebar" ) ? ot_get_option('blog_layout') : 'right-sidebar';

if ( is_active_sidebar($sidebar_name) ) : ?>
	<div class="sidebar-hider"></div>
	<div class="floated-sidebar <?php echo esc_attr($sidebar_side); ?>">
		<a href="#0" class="sidebar-close"></a>
		<div class="sidebar-holder">
			<div class="sidebar-content">
				<?php dynamic_sidebar($sidebar_name); ?>
			</div>
		</div>
	</div>
<?php endif; ?>
