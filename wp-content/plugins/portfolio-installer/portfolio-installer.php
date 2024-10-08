<?php

/*
Plugin Name: Portfolio Installer for Tempus
Plugin URI: http://themeforest.net/user/mallini
Description: Enable a Portfolio post type
Author: Mallinidesign
Author URI: http://themeforest.net/user/mallini
Version: 5.0
Text Domain: themeworm
License: GPLv2
*/

/* Copyright 2016-2021 Mallinidesign (http://themeforest.net/user/mallini)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit();

if ( ! class_exists( 'Portfolio_installer' ) ) :

class Portfolio_installer {

	function __construct() {
		add_action( 'init', array( $this, 'portfolio_init' ) );
		add_action( 'admin_init', array( $this, 'register_plugin_settings' ) );
		add_action( 'admin_init', array( $this, 'file_replace' ) );
		add_action( 'admin_menu', array( $this, 'portfolio_add_page' ) );
		add_action( 'admin_menu', array( &$this, 'themeworm_create_portfolio_sort_page') );
		add_action( 'wp_ajax_portfolio_sort', array( &$this, 'themeworm_save_portfolio_sorted_order' ) );
		add_action( 'manage_posts_custom_column', array( &$this, 'display_thumbnail' ), 10, 1 );
		add_filter( 'manage_posts_columns', array( &$this, 'add_thumbnail_column'), 10, 1 );
	}

	function portfolio_add_page() {
		$page = add_options_page( 'Portfolio Slug', 'Portfolio Slug', 'manage_options', 'portfolio_slug', array( $this, 'portfolio_do_page' ) );
	}

	function register_plugin_settings() {
		add_option('themeworm_slug', 'portfolio-item');
		register_setting( 'themeworm_options_group', 'themeworm_slug', 'themeworm_callback' );
	}

	function file_replace() {
		$portfolio_item = get_option('themeworm_slug') ?: 'portfolio-item';
    $portfolio_source = get_template_directory() . '/single-portfolio-item.php';
    $portfolio_copy = get_template_directory() . '/single-' . $portfolio_item . '.php';
		$archive_source = get_template_directory() . '/archive-portfolio-item.php';
    $archive_copy = get_template_directory() . '/archive-' . $portfolio_item . '.php';

		if ($portfolio_item != 'portfolio-item') {
	    if (!copy($portfolio_source, $portfolio_copy)) {
	        echo "failed to copy portfolio";
	    }
			if (!copy($archive_source, $archive_copy)) {
	        echo "failed to copy archive";
	    }
		}
	}

	function portfolio_do_page() {

		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'themeworm' ) );
		} ?>

		<h2><?php esc_html_e('Theme Portfolio Slug', 'themeworm'); ?></h2>

		<form method="post" action="options.php">
			<?php settings_fields( 'themeworm_options_group' ); ?>
			<?php do_settings_sections( 'themeworm_options_group' ); ?>
			<input name="themeworm_slug" type="text" id="themeworm_slug" value="<?php echo esc_attr( get_option('themeworm_slug') ); ?>" class="regular-text">
			<p class="description" id="tagline-description"><?php esc_html_e('Default is portfolio-item. Do not forget to open Settings > Permalinks and press Save after slug changing. Be careful to change the portfolio slug because all your previous portfolio projects will disappear.', 'themeworm'); ?></p>
			<?php submit_button(); ?>
		</form>

	<?php }

	function portfolio_init() {

		/* ----------------------------------------------------- */
		/* Portfolio Pages */
		/* ----------------------------------------------------- */

		$labels = array(
			'name' =>  esc_html__('Portfolio', 'themeworm'),
			'singular_name' => esc_html__('Portfolio', 'themeworm'),
			'add_new' => esc_html__('Add New', 'themeworm'),
			'add_new_item' =>  esc_html__('Add New Project', 'themeworm'),
			'edit_item' =>  esc_html__('Edit Project', 'themeworm'),
			'new_item' =>  esc_html__('New Project', 'themeworm'),
			'view_item' =>  esc_html__('View Project', 'themeworm'),
			'search_items' =>  esc_html__('Search Portfolio', 'themeworm'),
			'not_found' =>  esc_html__('No portfolio found', 'themeworm'),
			'not_found_in_trash' =>  esc_html__('No Projects found in Trash', 'themeworm'),
			'parent_item_colon' =>  esc_html__('Parent Project:', 'themeworm'),
			'menu_name' =>  esc_html__('Portfolio', 'themeworm')
		);

		$args = array(
			'labels' => $labels,
			'hierarchical' => false,
			'description' => esc_html__('Display your Projects by filters', 'themeworm'),
			'supports' => array( 'title', 'editor', 'excerpt', 'revisions', 'thumbnail' ),
			'public' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_icon' => 'dashicons-images-alt2',
			'show_in_nav_menus' => true,
			'show_in_rest' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'has_archive' => true,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => array( 'slug' => esc_attr( get_option('themeworm_slug') )),
			'capability_type' => 'post'
		);

		register_post_type( esc_attr( get_option('themeworm_slug') ), $args );

		/* ----------------------------------------------------- */
		/* Filter Taxonomy */
		/* ----------------------------------------------------- */

		$labels = array(
			'name' =>  esc_html__('Filters', 'themeworm'),
			'singular_name' =>  esc_html__('Filter', 'themeworm'),
			'search_items' =>  esc_html__('Search Filters', 'themeworm'),
			'popular_items' =>  esc_html__('Popular Filters', 'themeworm'),
			'all_items' =>  esc_html__('All Filters', 'themeworm'),
			'parent_item' =>  esc_html__('Parent Filter', 'themeworm'),
			'parent_item_colon' =>  esc_html__('Parent Filter:', 'themeworm'),
			'edit_item' =>  esc_html__('Edit Filter', 'themeworm'),
			'update_item' =>  esc_html__('Update Filter', 'themeworm'),
			'add_new_item' =>  esc_html__('Add New Filter', 'themeworm'),
			'new_item_name' =>  esc_html__('New Filter', 'themeworm'),
			'separate_items_with_commas' =>  esc_html__('Separate Filters with commas', 'themeworm'),
			'add_or_remove_items' =>  esc_html__('Add or remove Filters', 'themeworm'),
			'choose_from_most_used' =>  esc_html__('Choose from the most used Filters', 'themeworm'),
			'menu_name' =>  esc_html__('Filters', 'themeworm')
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_in_rest' => true,
			'show_admin_column' => true,
			'show_ui' => true,
			'show_tagcloud' => false,
			'hierarchical' => true,
			'rewrite' => true,
			'query_var' => true
		);

		register_taxonomy( 'filters', array(esc_attr( get_option('themeworm_slug') )), $args );

	}

	function add_thumbnail_column( $columns ) {
		$column_thumb = array( 'thumbnail' => esc_html__('Featured image','themeworm' ) );
		$columns = array_slice( $columns, 0, 2, true ) + $column_thumb + array_slice( $columns, 1, NULL, true );
		return $columns;
	}

	function display_thumbnail( $column ) {
		global $post;
		switch ( $column ) {
			case 'thumbnail':
				echo get_the_post_thumbnail( $post->ID, array(60, 60) );
				break;
		}
	}

	function themeworm_create_portfolio_sort_page() {
		$portfolio_item = get_option('themeworm_slug') ?: 'portfolio-item';
	  $portfolio_sort_page = add_submenu_page('edit.php?post_type=' . $portfolio_item . '', esc_html__('Portfolio Order', 'themeworm'), esc_html__('Custom Sort', 'themeworm'), 'edit_posts', basename(__FILE__), array($this, 'themeworm_portfolio_sort'));

	  add_action('admin_print_styles-' . $portfolio_sort_page, array($this, 'themeworm_sort_styles')) ;
	  add_action('admin_print_scripts-' . $portfolio_sort_page , array($this,'themeworm_sort_scripts'));
	}

	function themeworm_portfolio_sort() {
		$portfolio_item = get_option('themeworm_slug') ?: 'portfolio-item';
	  $portfolios = new WP_Query('post_type=' . $portfolio_item . '&posts_per_page=-1&orderby=menu_order&order=ASC'); ?>

	    <div class="wrap">

	      <h2><?php esc_html_e('Portfolio Order', 'themeworm'); ?></h2>
	      <p><?php esc_html_e('Drag and re-order Portfolio Projects. The item at the left top corner of the grid will display first.', 'themeworm'); ?><br /><strong><?php esc_html_e('To see new Projects order do not forget to choose Custom Sort in Portfolio Page order settings (Theme Options > Portfolio).', 'themeworm'); ?></strong></p>

				<div class="ajax-message" style="height: 20px;"></div>

	        <ul id="portfolio_list">
	          <?php while( $portfolios->have_posts() ) : $portfolios->the_post();
							if( get_post_status() == 'publish' ) { ?>

	              <li id="<?php the_id(); ?>" class="menu-item">
									<div class="menu-item-bar">
										<div class="menu-item-handle">
											<div class="menu-item-image"><?php the_post_thumbnail('thumbnail'); ?></div>
											<div class="menu-item-title"><?php the_title(); ?></div>
										</div>
									</div>
								</li>

	            <?php } endwhile;
							wp_reset_postdata(); ?>
	        </ul>
    	</div>

	<?php }

	function themeworm_save_portfolio_sorted_order() {
	  global $wpdb;
	  // $order = explode(',', $_POST['order']);
		$order = $_POST['order'];
	  $counter = 0;

		if (is_array($order)) {
		  foreach($order as $portfolio_id) {
		    $wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $portfolio_id));
		    $counter++;
		  }
		}

	  die(1);
	}

	function themeworm_sort_scripts() {
	  wp_enqueue_script('jquery-ui-sortable');
		// wp_enqueue_script( 'jquery_migrate', plugins_url( '/assets/js/jquery-migrate-1.4.1-wp.js', __FILE__ ), array('jquery') );
		wp_enqueue_script( 'themeworm_portfolio_toastr', plugins_url( '/assets/js/toastr.min.js', __FILE__ ), array('jquery') );
	  wp_enqueue_script( 'themeworm_portfolio_sort', plugins_url( '/assets/js/order.min.js', __FILE__ ), array('jquery') );

		wp_enqueue_style( 'portfolio-toastr', plugins_url( '/assets/css/toastr.min.css', __FILE__ ) );
		wp_enqueue_style( 'portfolio-sort', plugins_url( '/assets/css/order.min.css', __FILE__ ) );
	}

	function themeworm_sort_styles() {
	  wp_enqueue_style ('nav-menu');
	}

}

new Portfolio_installer();

endif;
