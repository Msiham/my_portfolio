<?php
/**
 * Header template part
 */

$alt_nav = ( function_exists('ot_get_option') && ot_get_option('alt_nav') == "on" || isset($_GET["alt_nav"]) ) ? 'menu-alt' : '';
$navigation_style = ( function_exists('ot_get_option') && ot_get_option('navigation_style') ) ?  ot_get_option('navigation_style') : 'menu-default menu-right';
$navigation_style = (isset($_GET["navigation_style"])) ? esc_attr($_GET["navigation_style"]) : $navigation_style; ?>

<div class="container nav_container <?php echo esc_attr($alt_nav . ' ' . $navigation_style); ?>">
	<div id="site-navigation">

		<?php if ( in_array($navigation_style, array('menu-default menu-right', 'menu-default menu-right social-no', 'menu-alt', 'menu-alt alt-right social-no', 'logo-right alt-left menu-alt social-no')) ) { ?>

			<div class="three columns">
				<div id="logo">
					<?php get_template_part( '/templates/widgets/widgets', 'logo' ); ?>
				</div>
			</div>

			<div class="thirteen columns">
				<div id="navigation" class="top-navigation">
					<?php get_template_part( '/templates/widgets/widgets', 'mainmenu' ); ?>
				</div>
				<?php tempus_header_social(); ?>
			</div>

		<?php } elseif ( in_array($navigation_style, array('center-header logo-center search-left social-right menu-center', 'center-header logo-center search-left social-right menu-center menu-alt', 'center-header logo-center search-no social-no menu-center menu-alt')) ) { ?>


				<div id="logo">
					<?php get_template_part( '/templates/widgets/widgets', 'logo' ); ?>
				</div>

			<div class="sixteen columns">
				<?php if (function_exists('ot_get_option') && ot_get_option('hide_menu_search') != "on") { ?>
					<div class="search-icon"><i class="fa fa-search" aria-hidden="true"></i></div>
				<?php } ?>
				<div id="navigation" class="top-navigation">
					<?php get_template_part( '/templates/widgets/widgets', 'mainmenu' ); ?>
				</div>
				<?php tempus_header_social(); ?>
			</div>


		<?php } elseif ( in_array($navigation_style, array('social-left menu-alt alt-right logo-center', 'social-right menu-alt alt-left logo-center')) ) { ?>

			<div class="sixteen columns">
				<div id="navigation" class="top-navigation">
					<?php get_template_part( '/templates/widgets/widgets', 'mainmenu' ); ?>
				</div>
				<div id="logo">
					<?php get_template_part( '/templates/widgets/widgets', 'logo' ); ?>
				</div>
				<?php tempus_header_social(); ?>
			</div>

		<?php } else { ?>

			<div class="thirteen columns">
				<div id="navigation" class="top-navigation">
					<?php get_template_part( '/templates/widgets/widgets', 'mainmenu' ); ?>
				</div>
			</div>

			<div class="three columns">
				<div id="logo">
					<?php get_template_part( '/templates/widgets/widgets', 'logo' ); ?>
				</div>
			</div>

		<?php } ?>

	</div>
</div>
