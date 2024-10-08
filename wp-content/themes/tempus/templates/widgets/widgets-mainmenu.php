<?php
/**
 * Title template part
 */


if ( has_nav_menu( 'menu-header' ) ) {

	$counter_nav = ( function_exists('ot_get_option') && ot_get_option('counter_nav') ) ? ot_get_option('counter_nav') : 7;

	echo preg_replace( '/>\s+</', '><', wp_nav_menu( array( 'theme_location' => 'menu-header', 'menu_class' => 'nav-menu', 'walker' => new tempus_SplitMenuWalker((int)$counter_nav, '<a href="#" class="menu-overflowed"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>'), 'depth' => 3, 'echo' => 0 ) ) );

} else { ?>

	<div class="nav-menu"><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_attr_e( 'Setup a navigation menu in Admin panel', 'tempus' );?></a></div>

<?php } ?>

<div class="menu-dropdown"><span></span></div>
