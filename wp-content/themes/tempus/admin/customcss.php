<?php

function tempus_adaptive_css($typo){

	if ( is_array($typo) ) {

    $ot_google_fonts = get_theme_mod( 'ot_google_fonts', array() );

    foreach ($typo as  $key => $value) {

      if (isset($value) && !empty($value)) {

				if ( $key == 'font-color' ) { $key = "color"; }
				if ( $key == 'font-family' ) { $value = '"'.$ot_google_fonts[$value]['family'].'"'; }
				echo esc_attr($key) . ":" . $value . " !important;";

      }
    }
  }
}

function tempus_stylesheet_content() {
if ( function_exists('ot_get_option') ) {
	$logo_dimensions = ot_get_option( 'logo_dimensions' );
	$mobile_logo_dimensions = ot_get_option( 'mobile_logo_dimensions' );
	$logo_top_margin = ot_get_option( 'logo_top_margin' );
	$logo_bottom_margin = ot_get_option( 'logo_bottom_margin' );
	$submenu_width = ot_get_option( 'submenu_width' );
	$links_color = ot_get_option( 'links_color' );
	$body_font = ot_get_option( 'body_font');
	$menu_font = ot_get_option( 'menu_font');
	$logo_font = ot_get_option( 'logo_font');
  $main_color = ot_get_option( 'main_color');
	$background_color = ot_get_option( 'background_color');
  $main_text = ot_get_option( 'main_text');
	$h1_font = ot_get_option( 'h1_font');
	$h2_font = ot_get_option( 'h2_font');
	$h3_font = ot_get_option( 'h3_font');
	$h4_font = ot_get_option( 'h4_font');
	$h5_font = ot_get_option( 'h5_font');
	$h6_font = ot_get_option( 'h6_font');
	$preloader_color = ot_get_option( 'preloader_color');
	$about_color_overlay = ot_get_option( 'about_color_overlay');

	global $post; ?>

	<style type="text/css">

		<?php if ($body_font) { ?>

			body,
			.date, .post-meta, .readmore,
			.widget, .comment-text,
			.search-results,
			.post-content p,
			.container p, .filters-container a
			{ <?php tempus_adaptive_css($body_font); ?> }

		<?php } ?>

		<?php if ($main_color) { ?>

			.nosearch-results a:hover,
			.nosearch-results.tags-cloud a:hover
			{ color: <?php echo esc_html($main_color); ?>; }

			input[type="submit"]:hover
			{ border-color: <?php echo esc_html($main_color); ?> }

			.nav-menu a::before,
			.animated-link a:after,
			.comments-number:hover,
			a.comment-reply-link::before,
			.widget.widget_recent_entries li a:before,
			.widget.widget_categories li a:before,
			.widget.widget_archive li a:before,
			.widget.widget_pages li a:before,
			.widget.widget_meta li a:before,
			.nosearch-results.nosearch-cats li a:before
			{	background-color: <?php echo esc_html($main_color); ?>; }

			@media only screen and (max-width: 959px) {
				#navigation ul li a:hover,
				.top-navigation li a:hover,
				#site-navigation.scaled .top-navigation li a:hover {
					color: <?php echo esc_html($main_color); ?>;
				}
			}

			::-moz-selection {
				background-color: <?php echo esc_html($main_color); ?>;
				color: #fff;
			}

			::selection {
				background-color: <?php echo esc_html($main_color); ?>;
				color: #fff;
			}

		<?php } ?>

		<?php if ($background_color) { ?>

			body {
				background-color: <?php echo esc_html($background_color); ?>;
			}

		<?php } ?>

		h1{ <?php tempus_adaptive_css($h1_font); ?> }
		h2{ <?php tempus_adaptive_css($h2_font); ?> }
		h3{ <?php tempus_adaptive_css($h3_font); ?> }
		h4{ <?php tempus_adaptive_css($h4_font); ?> }
		h5{ <?php tempus_adaptive_css($h5_font); ?> }
		h6{ <?php tempus_adaptive_css($h6_font); ?> }

		#logo a { <?php tempus_adaptive_css($logo_font); ?> }

		<?php if (!empty( $logo_dimensions) && ot_get_option( 'logo_upload') ) { ?>
			.logo-image, #spinner-outer {
				width: <?php echo esc_html($logo_width = (isset($logo_dimensions['width'])) ? $logo_dimensions['width'] : ''); ?>px;
				height: <?php echo esc_html($logo_height = (isset($logo_dimensions['height'])) ? $logo_dimensions['height'] : ''); ?>px;
			}
		<?php } ?>

		<?php if (!empty( $mobile_logo_dimensions) && ot_get_option( 'logo_upload') ) { ?>
			@media only screen and (max-width: 959px) {
			.logo-image {
				width: <?php echo esc_html($mobile_logo_width = (isset($mobile_logo_dimensions['width'])) ? $mobile_logo_dimensions['width'] : ''); ?>px;
				height: <?php echo esc_html($mobile_logo_height = (isset($mobile_logo_dimensions['height'])) ? $mobile_logo_dimensions['height'] : ''); ?>px;
			}}
		<?php } ?>

		<?php if (!empty( $preloader_color) ) { ?>
			#spinner {
				background-color: <?php echo esc_html($preloader_color); ?>;
			}
		<?php } ?>

		<?php if (!empty( $about_color_overlay) ) { ?>
			.about-me:before {
				content: '';
				position: absolute;
				top: 0;
				right: 0;
				bottom: 0;
				left: 0;
				z-index: 1;
				background-color: <?php echo esc_html($about_color_overlay); ?>;
			}
		<?php } ?>

		#navigation a, .widget_nav_menu a, .header-sidebar.widget-themeworm_social a, .search-icon {  <?php tempus_adaptive_css($menu_font); ?>  }

		<?php if (!empty( $logo_top_margin ) || !empty( $logo_bottom_margin)) { ?>

			#logo {
				<?php if ( !empty( $logo_top_margin ) ) { echo 'margin-top:'.esc_html($logo_top_margin).'px;'; } ?>
				<?php if ( !empty( $logo_bottom_margin ) ) { echo 'margin-bottom:'.esc_html($logo_bottom_margin).'px;'; } ?>
			}

		<?php } ?>

		<?php if ( function_exists('ot_get_option') && ot_get_option('logo_upload') ) { ?>
			#spinner {
    		background-color: transparent;
			}
		<?php } ?>

		<?php if (get_post_meta(get_the_ID(), 'tempus_portfolio_menucolor', true)) { ?>
			.top-navigation li a, .header-sidebar.widget-themeworm_social a {
		  	color: <?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_portfolio_menucolor', true)); ?>;
			}
			.menu-dropdown span, .menu-dropdown span:before, .menu-dropdown span:after {
				background-color: <?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_portfolio_menucolor', true)); ?>;
			}
		<?php } ?>

		<?php if (get_post_meta(get_the_ID(), 'tempus_portfolio_logocolor', true)) { ?>
			h1.logo, #logo a {
		    color: <?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_portfolio_logocolor', true)); ?>;
			}
		<?php } ?>

		<?php if ( function_exists('ot_get_option') && ot_get_option('portfolio_padding') || ot_get_option('portfolio_padding') == '0') {
			$portfolio_padding = (!empty(ot_get_option('portfolio_padding')) || ot_get_option('portfolio_padding') == '0') ? ot_get_option('portfolio_padding') : '10'; ?>
			@media only screen and (min-width: 960px) {
				.boxed-style .portfolio-three, .boxed-style .portfolio-two, .boxed-style .portfolio-four, .boxed-style .portfolio-five {
			    width: calc(33.33334% - <?php echo esc_html($portfolio_padding) * 2; ?>px);
			    margin: 0 <?php echo esc_html($portfolio_padding); ?>px <?php echo esc_html($portfolio_padding) * 2; ?>px <?php echo esc_html($portfolio_padding); ?>px;
				}
				.boxed-style .portfolio-two {
				  width: calc(50% - <?php echo esc_html($portfolio_padding) * 2; ?>px);
				}
				.boxed-style .portfolio-four {
				  width: calc(25% - <?php echo esc_html($portfolio_padding) * 2; ?>px);
				}
				.boxed-style .portfolio-five {
				  width: calc(20% - <?php echo esc_html($portfolio_padding) * 2; ?>px);
				}
				.boxed-style .portfolio-five.size-2x2 {
				  width: calc(40% - <?php echo esc_html($portfolio_padding) * 2; ?>px);
				}
				.boxed-style .portfolio-five.size-2x1, .boxed-style .portfolio-five.size-2x2 {
				    width: calc(40% - <?php echo esc_html($portfolio_padding) * 2; ?>px);
				}
			}
			@media only screen and (max-width: 959px) {
				.boxed-style .portfolio-three, .boxed-style .portfolio-two, .boxed-style .portfolio-four, .boxed-style .portfolio-five {
			    margin-bottom: <?php echo esc_html($portfolio_padding) * 2; ?>px;
				}
			}
		<?php } ?>

		<?php if (get_post_meta(get_the_ID(), 'tempus_video_gallery', true) == 'video-image') { ?>
			.content-wrapper .container .columns.portfolio-text {
    		float: none;
				display: block;
			}
			.portfolio-text {
    		padding: 55px 8% 35px 8%;
			}
		<?php } ?>

		<?php if ( function_exists('ot_get_option') && ot_get_option('portfolio_titles') == 'titles-mobile' ) { ?>
			@media only screen and (max-width: 959px) {
				.item-description h6, .item-filter {
					opacity: 1;
				}
				.portfolio-link:after {
					opacity: .5;
				}
			}
		<?php } ?>

		<?php if ( function_exists('ot_get_option') && ot_get_option('portfolio_titles') == 'titles-all' ) { ?>
				.item-description h6, .item-filter {
					opacity: 1;
				}
				.portfolio-link:after {
					opacity: .5;
				}
		<?php } ?>

		<?php echo ot_get_option( 'custom_css' );  ?>

	</style>

 <?php
	if ( function_exists('ot_get_option') && ot_get_option('portfolio_padding') ) { ?>
		<script type='text/javascript'>
			var customPadding = <?php echo esc_attr((ot_get_option('portfolio_padding')) ? ot_get_option('portfolio_padding') : '10'); ?>;
		</script>
	<?php }

}
} ?>
