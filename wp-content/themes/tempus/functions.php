<?php

add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_theme_mode', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_use_theme_options', '__return_true' );
add_filter( 'ot_meta_boxes', '__return_true' );

include get_template_directory() . '/admin/theme-options.php';
include get_template_directory() . '/admin/meta-boxes.php';
include get_template_directory() . '/admin/options.php';
include get_template_directory() . '/admin/widgets.php';
include get_template_directory() . '/admin/customcss.php';
require_once( ABSPATH . 'wp-admin/includes/media.php' );

/* ----------------------------------------------------- */
/* Theme Install */
/* ----------------------------------------------------- */

function tempus_theme_admin_bar_menu($admin_bar) {
  if ( function_exists('ot_get_option') ) {
    if (!is_super_admin() || !is_admin_bar_showing())
      return;
    $admin_bar->add_menu(array(
      'id' => 'option_tree_link',
      'title' => esc_html__("Theme Options", 'tempus'),
      'href' => site_url().'/wp-admin/themes.php?page=ot-theme-options',
      'meta' => array()
    ));
  }
}

add_action('after_setup_theme', 'tempus_install');
add_action('admin_bar_menu', 'tempus_theme_admin_bar_menu', 99);
add_action('wp_head', 'tempus_stylesheet_content');

if (!function_exists('tempus_install')):

  function tempus_install() {
    add_theme_support('automatic-feed-links');
		add_theme_support( 'title-tag' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor-style.css' );
		add_theme_support('post-formats', array( 'image', 'gallery', 'video', 'quote', 'link'));
		register_nav_menu( 'menu-header', 'Header menu' );
		load_theme_textdomain( 'tempus', get_template_directory() . '/languages' );
    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'Main Green', 'tempus' ),
            'slug' => 'main-green',
            'color' => '#33b996',
        ),
        array(
            'name' => esc_html__( 'Light Gray', 'tempus' ),
            'slug' => 'light-gray',
            'color' => '#999',
        ),
        array(
            'name' => esc_html__( 'Dark Gray', 'tempus' ),
            'slug' => 'dark-gray',
            'color' => '#272B2F',
        )
    ) );
	}

endif;

if ( ! isset( $content_width ) ) {
	$content_width = 1800;
}

/* ----------------------------------------------------- */
/* Scripts */
/* ----------------------------------------------------- */

function tempus_scripts() {

  wp_enqueue_script( 'appear', get_template_directory_uri() . '/assets/js/jquery.appear.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), false, true );

  if (is_page_template('templates/template-portfolio-fullscreen-slider.php')) {
    wp_enqueue_script( 'vegas', get_template_directory_uri() . '/assets/js/vegas.min.js', array( 'jquery' ), false, true );
  }

  if (is_page_template('templates/template-portfolio-pointy-slider.php') || is_page_template('templates/template-blog-chess.php')) {
    wp_enqueue_script( 'color-thief', get_template_directory_uri() . '/assets/js/color-thief.min.js', array( 'jquery' ), false, true );
  }

	wp_enqueue_script( 'justifiedGallery', get_template_directory_uri() . '/assets/js/jquery.justifiedGallery.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'tempus-masonry', get_theme_file_uri( '/assets/js/masonry.min.js' ), array( 'jquery' ), false, true );
	wp_enqueue_script( 'imagesloaded' );
  wp_enqueue_script( 'anime', get_template_directory_uri() . '/assets/js/anime.min.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.min.js', array( 'jquery' ), false, true );

  if (is_page_template('templates/template-portfolio-tilt.php')) {
    wp_enqueue_script( 'tilt', get_template_directory_uri() . '/assets/js/tilt.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'tilt-init', get_template_directory_uri() . '/assets/js/tilt-init.js', array( 'jquery' ), false, true );
  }

	wp_enqueue_script( 'custom', get_template_directory_uri() . '/assets/js/custom.min.js', array( 'jquery' ), false, true );
  wp_add_inline_script ( 'custom', 'var security = "' . wp_create_nonce( "tempus_ajax_infinite" ) . '";', 'before');

  if (is_page_template('templates/template-portfolio-pointy-slider.php')) {
    wp_enqueue_script( 'adaptive_background', get_template_directory_uri() . '/assets/js/adaptive_background.js', array( 'jquery' ), false, true );
  }

	wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/assets/js/fancybox.js', array( 'jquery' ), false, true );
  //wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/assets/js/fitvids.js', array( 'jquery' ), false, true );
  wp_localize_script( 'custom', 'infinite_url', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	if ( function_exists('ot_get_option') && ot_get_option('preloader_on') != "off") {
		wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/assets/js/lazyload.min.js', array( 'jquery' ), false, true );
	}

	if (is_singular()) {
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font/css/font-awesome.min.css', array(), '4.3' );
	wp_enqueue_style( 'justifiedGallery', get_template_directory_uri() . '/assets/css/justifiedGallery.min.css', array(), '4.3' );
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/assets/css/fancybox.min.css' );
  wp_enqueue_style( 'owl-transitions', get_template_directory_uri() . '/assets/css/owl.transitions.css' );
  wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.min.css' );

  if (is_page_template('templates/template-portfolio-fullscreen-slider.php')) {
    wp_enqueue_style( 'vegas', get_template_directory_uri() . '/assets/css/vegas.min.css' );
  }

  if (is_active_widget( false, false, 'tempus_social_menu' )) {
    wp_enqueue_style( 'vegas', get_template_directory_uri() . '/assets/css/social-menu.css' );
  }

  if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.min.css' );
  }

  //wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.min.css' );
	wp_enqueue_style( 'style', get_stylesheet_uri() );

}
add_action( 'wp_enqueue_scripts', 'tempus_scripts' );

if (!function_exists('tempus_styles')) {
	function tempus_styles() {
		wp_register_style('responsive', get_template_directory_uri() . '/assets/css/responsive.min.css', '', '', 'screen');
		wp_enqueue_style('responsive');
	}
	add_action('wp_enqueue_scripts', 'tempus_styles');
}

function tempus_admin_style() {
  wp_enqueue_style('fix-ot-styles', get_template_directory_uri() . '/assets/css/fix-ot-styles.css' );
}
add_action('admin_enqueue_scripts', 'tempus_admin_style');

/* ----------------------------------------------------- */
/* Google fonts */
/* ----------------------------------------------------- */

function tempus_fonts_url() {
  $font_url = '';

  /* Translators: If there are characters in your language that are not supported
  by chosen font(s), translate this to 'off'. Do not translate into your own language. */

  if ( 'off' !== _x( 'on', 'Google font: on or off', 'tempus' ) ) {
    $font_url = add_query_arg( 'family', urlencode( 'Montserrat:400,700|Roboto Condensed:300,400,700|Roboto:300,400,700' ), "//fonts.googleapis.com/css" );
  }
  return $font_url;
}

function tempus_fonts_init() {
  wp_enqueue_style( 'Google-font', tempus_fonts_url(), array(), '1.0.0' );
}

add_action( 'wp_enqueue_scripts', 'tempus_fonts_init' );

/* ----------------------------------------------------- */
/* Thumbs */
/* ----------------------------------------------------- */

  add_theme_support('post-thumbnails');
  set_post_thumbnail_size(600, 300, true);
	add_image_size('tempus_blog-main', 1200, 0, true);
	add_image_size('tempus_portfolio-main', 800, 800, true);
	add_image_size('tempus_portfolio-footer', 150, 150, true);

/* ----------------------------------------------------- */
/* Sidebars */
/* ----------------------------------------------------- */

function tempus_sidebars() {
	register_sidebar( array(
		'name' 			=> esc_html__('Default sidebar', 'tempus'),
		'id' 			=> 'tempus_sidebar1',
    'description'   => esc_html__('Sidebar used for all pages by default', 'tempus'),
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h6 class="widget-title"><span>',
		'after_title'	=> '</span></h6>',
	) );

  register_sidebar( array(
    'name' 			=> esc_html__('Footer Sidebar', 'tempus'),
    'id' 			=> 'tempus_footer_sidebar',
    'description'   => esc_html__('Footer Sidebar for copyright or menu', 'tempus'),
    'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
    'after_widget'	=> '</aside>',
    'before_title'	=> '<h6 class="widget-title"><span>',
    'after_title'	=> '</span></h6>',
  ) );

  if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    register_sidebar( array(
  		'name' 			=> esc_html__('Woocommerce', 'tempus'),
  		'id' 			=> 'tempus_woocommerce_sidebar',
      'description'	=> esc_html__('Sidebar for shop based on WooCommerce', 'tempus'),
  		'before_widget'	=> '<aside id="%1$s" class="widget woo-widget %2$s">',
  		'after_widget'	=> '</aside>',
  		'before_title'	=> '<h6 class="widget-title"><span>',
  		'after_title'	=> '</span></h6>'
  	) );
  }
};

add_action( 'widgets_init', 'tempus_sidebars' );

/* ----------------------------------------------------- */
/* Option Tree Settings */
/* ----------------------------------------------------- */

function ot_recognized_font_families( $field_id = '' ) {
  $families = array();
  return apply_filters( 'ot_recognized_font_families', $families, $field_id );
}

/* ----------------------------------------------------- */
/* Comments Setup */
/* ----------------------------------------------------- */

function tempus_wrap_comment_text($content) {
  return "<div class=\"comment-content\"><p>". $content ."</p></div>";
}
add_filter('comment_text', 'tempus_wrap_comment_text');

/* ----------------------------------------------------- */
/* Tag Cloud */
/* ----------------------------------------------------- */

function tempus_tag_cloud_widget($args) {
  $args['largest'] = 14;
  $args['smallest'] = 14;
  $args['unit'] = 'px';
  return $args;
}

add_filter( 'widget_tag_cloud_args', 'tempus_tag_cloud_widget' );

/* ----------------------------------------------------- */
/* Getting global options */
/* ----------------------------------------------------- */

class tempus_GetGlobal {
  function __construct() {
    global $tempus_non_fullwidth, $tempus_columns, $tempus_masonry, $tempus_shared, $tempus_limit_image_size, $tempus_enable_mixed, $tempus_allow_multi_items, $tempus_slide_url, $tempus_slide_title, $tempus_slide_subtitle, $tempus_image_url, $tempus_ratio, $tempus_big_image, $tilt_style;

    $this->columns = $tempus_columns;
    $this->non_fullwidth = $tempus_non_fullwidth;
    $this->masonry = $tempus_masonry;
    $this->shared = $tempus_shared;
    $this->limit_image_size = $tempus_limit_image_size;
    $this->enable_mixed = $tempus_enable_mixed;
    $this->allow_multi_items = $tempus_allow_multi_items;
    $this->slide_url = $tempus_slide_url;
    $this->image_url = $tempus_image_url;
    $this->slide_subtitle = $tempus_slide_subtitle;
    $this->slide_title = $tempus_slide_title;
    $this->ratio = $tempus_ratio;
    $this->big_image = $tempus_big_image;
    $this->tilt_style = $tilt_style;
  }
}

/* ----------------------------------------------------- */
/* Social Icons in Header Menu */
/* ----------------------------------------------------- */

function tempus_header_social() {
  if ( function_exists('ot_get_option') && ot_get_option('header_social') ) { ?>
    <div class="header-sidebar header-social widget-themeworm_social">
      <div class="social-widget-inner">
        <?php	$links_array = ot_get_option('header_social');
        if ( !empty($links_array) ) {
          foreach ( $links_array as $links ) {
            if ( $links['href'] ) {
              if ( $links['name'] == 'GooglePlus' || $links['name'] == 'Google+' ) { $links['name'] = 'google-plus'; }
              if ( $links['name'] == 'VK.com' ) { $links['name'] = 'vk'; }
              if ( $links['name'] == 'email' || $links['name'] == 'envelope' ) { $links['name'] = 'envelope'; }
              if ( empty($links['title']) ) { $links['title'] = $links['name']; }

              if ( $links['name'] == 'email' || $links['name'] == 'envelope' ) { ?>

              <a href="<?php echo "mailto:" . $links['href']; ?>" target="_blank" title="<?php echo esc_attr($links['title']); ?>" >
                <i class="fa fa-<?php echo strtolower(esc_attr($links['name'])); ?>"></i>
              </a>

            <?php	} else { ?>

              <a href="<?php echo esc_url($links['href']); ?>" target="_blank" title="<?php echo esc_attr($links['title']); ?>" >
                <i class="fa fa-<?php echo strtolower(esc_attr($links['name'])); ?>"></i>
              </a>

            <?php	}
            }
          }
        } ?>

<?php if (ot_get_option('custom_icon_upload')) { ?>
        <a href="<?php echo esc_url(ot_get_option('custom_icon_url')); ?>" target="_blank" style="background-image:url(<?php echo esc_url(ot_get_option('custom_icon_upload')); ?>); background-repeat:no-repeat; background-position: center; border-radius: unset;"><i class="fa fa-envelope" style="visibility:hidden"></i></a>
<?php } ?>

      </div>
    </div>
  <?php }
}

/* ----------------------------------------------------- */
/* Slider */
/* ----------------------------------------------------- */

function tempus_selected_slider() {

  $themeworm_slug = ( get_option('themeworm_slug') ) ?: 'portfolio-item';

  $slider_query_args = array(
    'post_type' => $themeworm_slug,
    'meta_query' => array(
      array(
      'key' => '_thumbnail_id',
      'compare' => 'EXISTS'
      ),
      array(
        'key' => 'tempus_in_slider',
        'value' => 'on'
      ),
      array(
        'key' => 'tempus_page_slider',
        'value' => get_the_ID()
      )
    )
  );

  $slider_query = new WP_Query( $slider_query_args );

  global $tempus_image_url, $tempus_slide_title, $tempus_slide_url, $tempus_slide_subtitle;

  if ($slider_query->have_posts()) {
  while ( $slider_query->have_posts() ) : $slider_query->the_post();
    $thumbnail_url = get_the_permalink();
    $portfolio_main = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
    $ratio = ($portfolio_main[2] > 0) ? $portfolio_main[1]/$portfolio_main[2] : '';
    $tempus_image_url = $portfolio_main[0];
    $tempus_slide_title = get_the_title();
    $tempus_slide_url = get_the_permalink();
    $tempus_slide_subtitle = get_post_meta(get_the_ID(), 'tempus_portfolio_subtitle', true);

    get_template_part('/templates/content/content', 'slide-fullscreen');

  endwhile; }
}

/* ----------------------------------------------------- */
/* Images attr by URL */
/* ----------------------------------------------------- */

function tempus_get_image_attr($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", esc_url($image_url) ));
  return ($attachment) ? $attachment[0] : false;
}

/* ----------------------------------------------------- */
/* Nav Menu */
/* ----------------------------------------------------- */

class tempus_SplitMenuWalker extends Walker_Nav_Menu {

  private $split_at;
  private $button;
  private $count = 0;
  private $wrappedOutput;
  private $replaceTarget;
  private $wrapped = false;
  private $toSplit = false;

  public function __construct($split_at = 5, $button = '<a href="#" class="menu-overflowed">&hellip;</a>') {
    $this->split_at = $split_at;
    $this->button = $button;
  }

  public function walk($elements, $max_depth, ...$args) {
    $args = array_slice(func_get_args(), 2);
    $output = parent::walk($elements, $max_depth, reset($args));
    return $this->toSplit ? $output.'</ul></li>' : $output;
  }

  public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $this->count += $depth === 0 ? 1 : 0;
    parent::start_el($output, $item, $depth, $args, $id);
    if (($this->count === $this->split_at) && ! $this->wrapped) {
      // split at number has been reached generate and store wrapped output
      $this->wrapped = true;
      $this->replaceTarget = $output;
      $this->wrappedOutput = $this->wrappedOutput($output, $depth);
    } elseif (($this->count === $this->split_at + 1) && ! $this->toSplit) {
      // split at number has been exceeded, replace regular with wrapped output
      $this->toSplit = true;
      $output = str_replace($this->replaceTarget, $this->wrappedOutput, $output);
    }
  }

  public function start_lvl(&$output, $depth = 0, $args = array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent<ul class=\"sub-menu\"><span class=\"sub-menu-holder\">\n";
    //$output .= "$indent<ul class=\"sub-menu\">\n";
  }

  public function end_lvl(&$output, $depth = 0, $args = array()) {
    $output .= "</span></ul>\n";
    //$output .= "</ul>\n";
  }

  private function wrappedOutput($output, $depth) {
    $dom = new DOMDocument;
    $dom->loadHTML($output.'</li>');
    $lis = $dom->getElementsByTagName('li');
    $last = trim(substr($dom->saveHTML($lis->item($lis->length-1)), 0, -5));
    // remove last li
    $wrappedOutput = substr(trim($output), 0, -1 * strlen($last));
    $classes = array(
     'menu-item',
     'menu-item-type-custom',
     'menu-item-object-custom',
     'menu-item-has-children',
     'menu-item-split-wrapper'
    );
    // add wrap li element
    $sub_item = ($depth > 0) ? 'sub-' : '';
    $wrappedOutput .= '<li class="' . $sub_item . implode(' ', $classes).'">';
    // add the "more" link
    $wrappedOutput .= $this->button;
    // add the last item wrapped in a submenu and return
    return $wrappedOutput . '<ul class="sub-menu">'. $last;
  }
}

/* ----------------------------------------------------- */
/* Gallery Setup */
/* ----------------------------------------------------- */

add_filter( 'use_default_gallery_style', '__return_false' );
add_filter( 'the_content', 'tempus_im_add_rel_attribute');
add_filter( 'wp_get_attachment_link', 'tempus_rc_add_rel_attribute');
add_filter( 'the_content', 'tempus_fancybox_image_attribute' );

function tempus_fancybox_image_attribute( $content ) {
       global $post;

       $pattern = "/<a(.*?)href=('|\")(.*?).(webp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replace = '<a$1href=$2$3.$4$5 data-fancybox="group">';
       $content = preg_replace( $pattern, $replace, $content );

       return $content;
}

function tempus_rc_add_rel_attribute($link) {
	return str_replace('<a href', '<a data-fancybox="group" href', $link);
}

function tempus_im_add_rel_attribute($content) {
	$string = '/<a href="(.*?).(jpg|jpeg|png|gif|bmp|ico)"><img(.*?)class="(.*?)wp-image-(.*?)" \/><\/a>/i';
	preg_match_all( $string, $content, $matches, PREG_SET_ORDER);

	foreach ($matches as $val) {
		$post = get_post($val[5]);
		$slimbox_caption = (isset($post->post_content)) ? esc_attr( $post->post_content ) : "";
		$string = '<a href="' . $val[1] . '.' . $val[2] . '"><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';
		$replace = '<a data-fancybox="group" href="' . $val[1] . '.' . $val[2] . '" ><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';
		$content = str_replace( $string, $replace, $content);
	}

	return $content;
}

add_filter('img_caption_shortcode', 'tempus_fix_img_caption_shortcode', 10, 3);

function tempus_fix_img_caption_shortcode($val, $attr, $content = null) {
  extract(shortcode_atts(array(
    'id'    => '',
    'align' => '',
    'width' => '',
    'caption' => ''
  ), $attr));

  if ( 1 > (int) $width || empty($caption) ) return $val;

  return '<div id="' . esc_html($id) . '" class="wp-caption ' . esc_attr($align) . '" style="width: ' . (0 + (int) $width) . 'px">' . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

/* ----------------------------------------------------- */
/* User Custom Fields */
/* ----------------------------------------------------- */

add_action( 'show_user_profile', 'tempus_add_extra_social_links' );
add_action( 'edit_user_profile', 'tempus_add_extra_social_links' );

function tempus_add_extra_social_links( $user ) { ?>
  <h3><?php esc_html_e('User Profile Links', 'tempus') ?></h3>
    <table class="form-table">
      <tr>
        <th><label for="facebook_profile"><?php esc_html_e('Facebook', 'tempus') ?></label></th>
        <td><input type="text" name="facebook_profile" value="<?php echo esc_attr(get_the_author_meta( 'facebook_profile', $user->ID )); ?>" class="regular-text" /></td>
      </tr>
      <tr>
        <th><label for="twitter_profile"><?php esc_html_e('Twitter', 'tempus') ?></label></th>
        <td><input type="text" name="twitter_profile" value="<?php echo esc_attr(get_the_author_meta( 'twitter_profile', $user->ID )); ?>" class="regular-text" /></td>
      </tr>
      <tr>
        <th><label for="google_profile"><?php esc_html_e('Google+', 'tempus') ?></label></th>
        <td><input type="text" name="google_profile" value="<?php echo esc_attr(get_the_author_meta( 'google_profile', $user->ID )); ?>" class="regular-text" /></td>
      </tr>
			<tr>
        <th><label for="instagram_profile"><?php esc_html_e('Instagram', 'tempus') ?></label></th>
        <td><input type="text" name="instagram_profile" value="<?php echo esc_attr(get_the_author_meta( 'instagram_profile', $user->ID )); ?>" class="regular-text" /></td>
      </tr>
  </table>
<?php }

add_action( 'personal_options_update', 'tempus_save_extra_social_links' );
add_action( 'edit_user_profile_update', 'tempus_save_extra_social_links' );

function tempus_save_extra_social_links( $user_id ) {
  update_user_meta( $user_id,'facebook_profile', sanitize_text_field( $_POST['facebook_profile'] ) );
  update_user_meta( $user_id,'twitter_profile', sanitize_text_field( $_POST['twitter_profile'] ) );
  update_user_meta( $user_id,'google_profile', sanitize_text_field( $_POST['google_profile'] ) );
	update_user_meta( $user_id,'instagram_profile', sanitize_text_field( $_POST['instagram_profile'] ) );
}

/* ----------------------------------------------------- */
/* Search Archives Display */
/* ----------------------------------------------------- */

function tempus_displayArchives() {

  $search_posts = new WP_Query( array(
    'post_type' => 'post',
    'posts_per_page' => 8,
    'post_status' => 'publish',
    'nopaging' => 0,
    'post__not_in' => get_option('sticky_posts')
  ));

  if ($search_posts->have_posts()) : while ($search_posts->have_posts()) : $search_posts->the_post();

  echo '<a href="' . get_the_permalink() . '" class="dummy-media-object" >';

    if (has_post_thumbnail()) { the_post_thumbnail('portfolio-footer'); } else { echo '<div class="no-archive-thumb"></div>'; }

    echo '<h3>' . get_the_title() . '</h3></a>';

  endwhile;
  endif;
  wp_reset_postdata();

}

/* ----------------------------------------------------- */
/* Recents Comments */
/* ----------------------------------------------------- */

function tempus_recent_comments($no_comments = 6, $comment_len = 80, $avatar_size = 50) {
	$comments_query = new WP_Comment_Query();
	$comments = $comments_query->query( array( 'number' => $no_comments ) );
	$comm = '';
	if ( $comments ) : foreach ( $comments as $comment ) :
		$comm .= '<a class="dummy-media-object" href="' . esc_url(get_permalink( $comment->comment_post_ID )) . '#comment-' . $comment->comment_ID . '">';
		$comm .= get_avatar( $comment->comment_author_email, $avatar_size );
		$comm .= '<h3><strong>'.get_comment_author( $comment->comment_ID ) . '</strong></h3>' . '<div class="search-comment"><span>' . get_the_title($comment->comment_post_ID) . ':</span>';
		$comm .= '"' . strip_tags( substr( apply_filters( 'get_comment_text', $comment->comment_content ), 0, $comment_len ) ) . '..."</div></a>';
	endforeach; else :
		$comm .= esc_html__('No comments.', 'tempus');
	endif;
	return $comm;
}

/* ----------------------------------------------------- */
/* Related posts */
/* ----------------------------------------------------- */

function tempus_related_posts() {

  global $post;
  $tags = wp_get_post_tags( $post->ID );
  $tag_arr = $link = '';
  $i = 0;

  //if ( $tags ) {

    foreach( $tags as $tag ) {
      $tag_arr .= $tag->slug . ',';
    }

    $related_postcount = ( function_exists('ot_get_option') && ot_get_option('related_postcount') ) ? ot_get_option('related_postcount') : 3;

    $args = array(
			'post_type' => 'post',
      /*'tag' => $tag_arr,*/
      'posts_per_page' => $related_postcount,
      'post__not_in' => array($post->ID)
    );

    $related_posts = get_posts( $args );

    if ( $related_posts ) {

      echo '<div class="container related-posts-title"><h2 id="related-posts">' . esc_html__('Latest Posts', 'tempus') . '</h2></div>';
      echo '<div class="related-posts blog-content related-posts-count-' . esc_attr($related_postcount) . '">';

      foreach ( $related_posts as $post ) : setup_postdata( $post ); $i++;

        $thumbnail_url = get_template_directory_uri() . '/assets/images/noimage.png';

        if (has_post_thumbnail()) {
        	$thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'tempus_blog-main' );
        	$thumbnail_url = $thumbnail_data[0];
        } ?>

        <article class="loop related-item blog-item type-post status-publish wow fadeIn">
          <a href="<?php the_permalink(); ?>" rel="bookmark" class="blog-link"></a>

      		<div class="blog-image" style="background-image:url('<?php echo esc_url($thumbnail_url); ?>');" ></div>

          <div class="post-title">
    				<h2><?php the_title(); ?></h2>
    			</div>

          <div class="date-number"><?php echo '<span>' . get_the_date('M') . '</span> ' . get_the_date('j, Y'); ?></div>

        </article>

      <?php endforeach;
    }
  //}

	wp_reset_postdata();
  echo '</div>';

}

/* ----------------------------------------------------- */
/* Video */
/* ----------------------------------------------------- */

function tempus_get_video($video_url) {
  global $wp_embed;
  return $wp_embed->autoembed( esc_url( $video_url  . '?autoplay=1&muted=1') );
}

/* ----------------------------------------------------- */
/* Page Title */
/* ----------------------------------------------------- */

function tempus_title() {
  $title = ( get_post_meta(get_the_ID(), 'tempus_title_text', true) ) ?: get_the_title();
  global $post;
  $author_id = $post->post_author;
  $thumbnail_url = '';

  $title_class = ( get_post_meta(get_the_ID(), 'tempus_title_height', true) ) ?: 'titleheight-standard';
  $themeworm_slug = ( get_option('themeworm_slug') ) ?: 'portfolio-item';

  if (has_post_thumbnail() && get_post_type( get_the_ID() ) != $themeworm_slug) {
    $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
    $thumbnail_url = "background-image:url('" . esc_url($thumbnail_data[0]) . "');";
  } ?>

  <?php if ( is_single() && get_post_type( get_the_ID() ) == "post" ) { ?>

    <?php get_template_part('/templates/blog/blog', get_post_format());  ?>

  <?php } else {
    if (get_post_type( get_the_ID() ) != $themeworm_slug) { ?>

      <?php if (get_post_meta($post->ID, 'tempus_title_video', TRUE)) { ?>
        <?php get_template_part('/templates/content/content', 'video'); ?>
      <?php } ?>

      <div class="container title_container <?php echo esc_html($title_class); ?>" style="<?php echo esc_html($thumbnail_url); ?>">

    <?php }
  } ?>

    <?php if ( !is_single() || get_post_meta(get_the_ID(), 'tempus_title_position', true) == 'title-position-over' ) { ?>

      <div id="page-title" class="<?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_title_style', true));  if ( get_post_meta(get_the_ID(), 'tempus_subtitle', true)) { echo ' has-subtitle'; } ?> wow fadeIn">

        <h1 style="color:<?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_title_color', true)); ?>;"><?php echo esc_html($title); ?></h1>

        <?php if ( get_post_meta(get_the_ID(), 'tempus_subtitle', true) || get_post_meta(get_the_ID(), 'tempus_subtitle_url', true) ) { ?>
          <?php tempus_subtitle(); ?>
        <?php } ?>

      </div>

    <?php } ?>

    <?php if ( is_single() && get_post_type( get_the_ID() ) == "post" ) { ?>
      <?php tempus_project_navigation() ?>
    <?php } ?>

  </div>

  <?php if ( is_single() && get_post_type( get_the_ID() ) != $themeworm_slug ) { ?>

    <div class="container title-position-under wow fadeIn">

      <?php if ( get_post_meta(get_the_ID(), 'tempus_title_position', true) != 'title-position-over' ) { ?>
        <h1><?php echo esc_html($title); ?></h1>
      <?php } ?>

      <?php if ( get_post_type( get_the_ID() ) == "post" ) { ?>
        <?php tempus_post_meta($author_id); ?>
      <?php } ?>

    </div>

  <?php } elseif ( get_post_type( get_the_ID() ) == $themeworm_slug && !in_array( get_post_meta($post->ID, 'tempus_gallery_layout', TRUE), array("half-gallery-left", "half-gallery-right")) ) { ?>

    <div class="container portfolio_title <?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_title_style', true)); ?>">
      <h1><?php echo esc_html($title); ?></h1>
      <?php if ( get_post_meta(get_the_ID(), 'tempus_portfolio_subtitle', true) ) { ?>
        <?php tempus_subtitle(); ?>
      <?php } ?>
    </div>

  <?php } ?>

<?php
}

/* ----------------------------------------------------- */
/* Post Meta */
/* ----------------------------------------------------- */

function tempus_post_meta($author_id = '') { ?>
  <div class="post-meta">
    <div class="single-date">
      <span class="single-number"><?php echo get_the_date('M j, Y'); ?></span>
      <span class="single-author animated-link"><?php esc_html_e('by','tempus'); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ); ?>"><?php the_author_meta( 'nickname', $author_id ); ?></a></span>
      <span class="single-comments animated-link"><?php if ( comments_open() ) { esc_html_e('with', 'tempus'); } ?>
        <?php  comments_popup_link( esc_html__('no comments','tempus'), esc_html__('1 comment','tempus'), esc_html__('% comments','tempus'), 'comments-link', esc_html__('Comments are off for this post','tempus')); ?>
      </span>
    </div>
  </div>
<?php }

/* ----------------------------------------------------- */
/* Subtitle */
/* ----------------------------------------------------- */

function tempus_subtitle() { ?>
  <div class="subtitle">
    <p style="color:<?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_title_color', true)); ?>;"><?php echo esc_html( $tempus_subtitle = (get_post_meta(get_the_ID(), 'tempus_subtitle', true)) ?: get_post_meta(get_the_ID(), 'tempus_portfolio_subtitle', true)); ?></p>
    <?php if ( get_post_meta(get_the_ID(), 'tempus_subtitle_url', true) ) { ?>
      <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'tempus_subtitle_url', true)); ?>" class="cd-btn" style="color:<?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_title_color', true)); ?>; border-color:<?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_title_color', true)); ?>;"><?php echo esc_html(get_post_meta(get_the_ID(), 'tempus_subtitle_button', true)); ?></a>
    <?php } ?>
  </div>
<?php }

/* ----------------------------------------------------- */
/* Project Navigation */
/* ----------------------------------------------------- */

function tempus_project_navigation() { ?>
  <div class="project-navigation" role="navigation">
    <?php if ( function_exists('ot_get_option') && ot_get_option('display_portfolio_nav') != "off" && is_single() || !function_exists('ot_get_option') ) {
      if ( get_adjacent_post( false, '', false ) ) { next_post_link( '%link', '<span>%title</span>' ); }
      if ( get_adjacent_post( false, '', true ) ) { previous_post_link( '%link', '<span>%title</span>' ); }
    }

    if ( function_exists('ot_get_option') && ot_get_option('blog_layout') != "no-sidebar" || !function_exists('ot_get_option') ) { ?>
      <a href="#0" class="sidebar-btn"><span></span></a>
    <?php }

    if ( function_exists('ot_get_option') && ot_get_option('blog_search_btn', 'option') != "on" || !function_exists('ot_get_option') ) { ?>
      <a href="#" class="search-btn"></a>
    <?php } ?>
  </div>
<?php }

/* ----------------------------------------------------- */
/* Infinite AJAX loading portfolio and filtering */
/* ----------------------------------------------------- */

add_action( 'wp_ajax_nopriv_tempus_ajax_infinite', 'tempus_ajax_infinite' );
add_action( 'wp_ajax_tempus_ajax_infinite', 'tempus_ajax_infinite' );

function tempus_ajax_infinite() {
  check_ajax_referer( 'tempus_ajax_infinite', 'security' );
	$perpage = sanitize_text_field( $_POST['perpage'] );
	$filter = sanitize_text_field( $_POST['filter'] );
  $style = sanitize_text_field( $_POST['style'] );
  global $tempus_columns, $tempus_tilt_style; $i = 0;
  $tempus_tilt_style = sanitize_text_field( $_POST['style'] );
  $tempus_columns = sanitize_text_field( $_POST['columns'] );
  // $exclude = sanitize_text_field( $_POST['exclude'] );
  $exclude = (isset($_POST['exclude'])) ? sanitize_text_field( $_POST['exclude'] ) : '';
  $exclude = (isset($exclude)) ? explode(",", $exclude) : '';
  $filter = ( $filter != 'all' ) ? explode(",", $filter) : $filter;
	$tax_query = ( $filter != 'all' ) ? array( array( 'taxonomy' => 'filters', 'field' => 'term_id', 'terms' => $filter, 'operator' => 'IN' ) ) : '';
  $portfolio_sorting = ( function_exists('ot_get_option') && ot_get_option('portfolio_sorting')  ) ? ot_get_option('portfolio_sorting') : 'date';
  $portfolio_order = (function_exists('ot_get_option') && ot_get_option('portfolio_sorting') == 'menu_order') ? 'ASC' : 'DESC';
  $themeworm_slug = ( get_option('themeworm_slug') ) ?: 'portfolio-item';

  if ($style == 'mixed') {
    global $tempus_limit_image_size, $tempus_enable_mixed;
    $tempus_limit_image_size = true;
    $tempus_enable_mixed = true;
  }

	$args = array(
		'post_type' => $themeworm_slug,
    'orderby' => $portfolio_sorting,
    'order'   => $portfolio_order,
		'posts_per_page' => $perpage,
    'post_status' => 'publish',
    'post__not_in' => $exclude,
		'tax_query' => $tax_query,
    // 'meta_query' => array( array(
		// 	'key' => '_thumbnail_id',
		// 	'compare' => 'EXISTS'
		// ))
	);

	$portfolio_query = new WP_Query( $args );

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		if ( $portfolio_query->have_posts() ) :
			while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
        // if ( has_post_thumbnail() ) {
          if ($tempus_columns == 'portfolio-tilt') {

            if ( $i == 5 ) { $i = 0; }
        		$i++; ?>

        		<?php if ( $i == 1 || $i == 3 ) { ?>
        			<section class="tilt-row">
        		<?php } ?>

        		<?php get_template_part('/templates/content/content', 'loop-tilt'); ?>

        		<?php if ( $i == 2 || $i == 5 ) { ?>
        			</section>
        		<?php }

          } elseif ($style == 'masonry') {
            get_template_part( '/templates/content/content', 'loop-masonry' );
          } else {
            get_template_part( '/templates/content/content', 'loop' );
          }
          $exclude[] = get_the_ID();
        // }
			endwhile;
		endif;
	}
	wp_die();
}

/* ----------------------------------------------------- */
/* load more portfolio */
/* ----------------------------------------------------- */

function tempus_load_more( $filters_array = '', $columns = 'one-third column', $data_all = false, $posts_per_page = false, $style = '' ) {

  global $tempus_masonry;

  $posts_per_page = (!empty($posts_per_page)) ? $posts_per_page : ot_get_option('portfolio_showpost','6');
  $load_svg = get_template_directory_uri() . '/assets/images/puff.svg';
  $data_all = (!empty($data_all)) ? $data_all : tempus_get_tax_filters($filters_array, 'count');
  $data_order = ( function_exists('ot_get_option') && ot_get_option('portfolio_sorting') ) ? ot_get_option('portfolio_sorting') : 'date';
  $portfolio_style = ($style) ?: '';
  $portfolio_style = ($tempus_masonry) ? 'masonry' : $portfolio_style;

  echo '<div class="load-more">';
  echo '<a href="#" id="next-projects" class="next-projects" data-size="" data-order="' . esc_html($data_order) . '" data-style="' . esc_html($portfolio_style) . '" data-all="'. esc_html($data_all) .'" data-perpage="'. esc_html($posts_per_page) .'" data-filter="'. tempus_get_tax_filters($filters_array) .'" data-columns="'. $columns .'">'
    . '<img class="loadmore-img" src="'. $load_svg . '" alt="loading" />'
    . '</a>'
    . '</div>';
}

function tempus_get_appear( $selector = '.load-more', $container = '#next-projects' ) {

  wp_add_inline_script( 'appear', 'jQuery(document).ready(function() {
    jQuery("' . $selector . '").appear();
    jQuery(document.body).on("appear", "' . $selector . '", function() {
      if ( jQuery( "' . $container . '" ).data( "perpage" ) < jQuery( "' . $container . '" ).attr( "data-all" ) ) {
        jQuery( "' . $container . '" ).click();
      }
    });
  });' );

}

function tempus_get_tax_filters( $filters_array, $count = '' ) {

  $tax_filters = '';
  $tax_count = 0;
  $themeworm_slug = ( get_option('themeworm_slug') ) ?: 'portfolio-item';

  if (is_array( $filters_array )) {
  	foreach ( $filters_array as $filter ) {
  		$term = get_term( $filter, 'filters' );
  		$tax_filters .= $term->term_id .",";
  		//$tax_count = $term->count + $tax_count;
  	}
  	$tax_filters = substr( $tax_filters, 0, -1 );

    $query = new WP_Query( array(
    	'post_type' => $themeworm_slug,
    	'tax_query' => array(	array(
    			'taxonomy' => 'filters',
    			'field'    => 'term_id',
    			'terms'    => explode( ",", $tax_filters ),
    	))
    ));

    $tax_count = $query->found_posts;
  }

  $filters = ( $tax_filters ) ? $tax_filters : 'all';
  $data_all = ( $tax_count > 0 ) ? $tax_count : wp_count_posts( $themeworm_slug )->publish;

  return $output = ( 'count' == $count ) ? $data_all : $filters;
}

/* ----------------------------------------------------- */
/* Load more Revealer */
/* ----------------------------------------------------- */

function tempus_revealer_load_more( $filters_array = '', $posts_per_page = false ) {

  $posts_per_page = (!empty($posts_per_page)) ? $posts_per_page : 7;
  $themeworm_slug = ( get_option('themeworm_slug') ) ?: 'portfolio-item';
  $new_query = new WP_Query( array( 'post_type' => $themeworm_slug ) );
  $data_all = ($filters_array) ? tempus_get_tax_filters($filters_array, 'count') : $new_query->post_count;

  echo '<div class="revealer-loadmore">';
  echo '<a href="#" class="revealer-next-projects" data-perpage="'. esc_html($posts_per_page) .'" data-all="'. esc_html($data_all) .'" data-filter="'. tempus_get_tax_filters($filters_array) .'">'
  . '</a>'
  . '</div>';

}

/* ----------------------------------------------------- */
/* AJAX loading Revealer */
/* ----------------------------------------------------- */

add_action( 'wp_ajax_nopriv_tempus_ajax_revealer', 'tempus_ajax_revealer' );
add_action( 'wp_ajax_tempus_ajax_revealer', 'tempus_ajax_revealer' );

function tempus_ajax_revealer() {

	$filter = sanitize_text_field( $_POST['filter'] );
  // $exclude = sanitize_text_field( $_POST['exclude'] );
  $exclude = (isset($_POST['exclude'])) ? sanitize_text_field( $_POST['exclude'] ) : '';
  $i = 0;

  $exclude = (isset($exclude)) ? explode(",", substr( $exclude, 0, -1 )) : '';
  $filter = ( $filter != 'all' ) ? array_map('intval', explode(',', $filter)) : $filter;
	$tax_query = ( $filter != 'all' ) ? array( array( 'taxonomy' => 'filters', 'field' => 'term_id', 'terms' => $filter) ) : '';

  $column_scheme = tempus_revealer_random();
  $randNum = rand (0, tempus_revealer_random('count'));
  $perpage = $column_scheme[$randNum][1][2];
  $themeworm_slug = ( get_option('themeworm_slug') ) ?: 'portfolio-item';

	$args = array(
		'post_type' => $themeworm_slug,
		'posts_per_page' => $perpage,
    'post_status' => 'publish',
    'post__not_in' => $exclude,
		'tax_query' => $tax_query,
    // 'meta_query' => array( array(
		// 	'key' => '_thumbnail_id',
		// 	'compare' => 'EXISTS'
		// ))
	);

	$portfolio_query = new WP_Query( $args );

	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		if ( $portfolio_query->have_posts() ) :
			while ( $portfolio_query->have_posts() ) :
        $portfolio_query->the_post(); $i++;

        if ($i == 1 || $i == $column_scheme[$randNum][0][1] || $i == $column_scheme[$randNum][0][2]) { ?>
				  <div class="revealer-column" data-perpage="<?php echo esc_html($column_scheme[$randNum][1][2]); ?>">
			  <?php }

        get_template_part('/templates/content/content', 'loop-revealer');

        if ($i == $column_scheme[$randNum][1][0] || $i == $column_scheme[$randNum][1][1] || $i == $column_scheme[$randNum][1][2]) { ?>
  				</div>
  			<?php }

			endwhile;
		endif;
    wp_reset_query();
	}
	die();
}

function tempus_revealer_random( $counter = '' ) {

  $column_scheme = array(
  	array( array(1, 4, 7), array(3, 6, 8)), /* 3-3-2 */
  	array( array(1, 4, 6), array(3, 5, 8)), /* 3-2-3 */
  	array( array(1, 3, 6), array(2, 5, 8)), /* 2-3-3 */

  	array( array(1, 3, 4), array(2, 3, 5)), /* 2-1-2 */
  	array( array(1, 2, 4), array(1, 3, 5)), /* 1-2-2 */
  	array( array(1, 3, 5), array(2, 4, 5)), /* 2-2-1 */

  	array( array(1, 2, 3), array(1, 2, 4)), /* 1-1-2 */
  	array( array(1, 2, 4), array(1, 3, 4)), /* 1-2-1 */
  	array( array(1, 3, 4), array(2, 3, 4)), /* 2-1-1 */

  	array( array(1, 3, 6), array(2, 5, 7)), /* 2-3-2 */
  	array( array(1, 4, 6), array(3, 5, 7)), /* 3-2-2 */
  	array( array(1, 3, 5), array(2, 4, 7)), /* 2-2-3 */

  	array( array(1, 4, 5), array(3, 4, 7)), /* 3-1-3 */
  	array( array(1, 2, 5), array(1, 4, 7)), /* 1-3-3 */
  	array( array(1, 4, 7), array(3, 6, 7)), /* 3-3-1 */

    array( array(1, 3, 4), array(2, 3, 6)), /* 2-1-3 */
    array( array(1, 2, 5), array(1, 4, 6)), /* 1-3-2 */
    array( array(1, 3, 6), array(2, 5, 6)), /* 2-3-1 */
  );

  return $output = ( 'count' == $counter ) ? count($column_scheme) - 1 : $column_scheme;
}

/* ----------------------------------------------------- */
/* Portfolio Info */
/* ----------------------------------------------------- */

function tempus_portfolio_info() {
  $tempus_info_desc = get_post_meta(get_the_ID(), 'tempus_info_desc', true);
  $tempus_info_title = get_post_meta(get_the_ID(), 'tempus_info_title', true);
  $tempus_project_client = get_post_meta(get_the_ID(), 'tempus_project_client', true);
  $tempus_project_date = get_post_meta(get_the_ID(), 'tempus_project_date', true);
  $tempus_project_website_url = get_post_meta(get_the_ID(), 'tempus_project_website_url', true);
  $tempus_project_website = get_post_meta(get_the_ID(), 'tempus_project_website', true);
  $tempus_project_date = get_post_meta(get_the_ID(), 'tempus_project_date', true);
  $tempus_info_position = get_post_meta(get_the_ID(), 'tempus_info_position', true);
  $tempus_project_category = '';
  global $tempus_shared;
  $tempus_shared = false;

  $terms = get_the_terms( get_the_ID(), 'filters');
  if ( $terms ) {
    foreach ( $terms as $term ) {
      $tempus_project_category .= esc_html($term->name) . ' ';
    }
  }

  if ( $tempus_info_desc || $tempus_info_title || $tempus_project_client || $tempus_project_date ) { ?>
    <div class="portfolio-info <?php echo esc_html($tempus_info_position); ?>">
    <div class="horisontal-divider-left">
      <?php if ( $tempus_info_title ) { ?>
        <h3><?php echo esc_html($tempus_info_title); ?></h3>
      <?php } ?>
      <?php if ( $tempus_info_desc ) { ?>
        <p><?php echo esc_html($tempus_info_desc); ?></p>
      <?php } ?>
      </div>
      <div class="horisontal-divider-right">
      <?php if ( $tempus_project_website_url ) { ?>
        <a href="<?php echo esc_url($tempus_project_website_url); ?>" target="_blank" class="cd-btn"><?php echo esc_html($project_website = ($tempus_project_website) ?: esc_attr__( 'View website','tempus' )); ?></a>
      <?php } ?>
      <?php if ( $tempus_project_client ) { ?>
        <div class="info-client"><span><?php echo esc_attr__( 'Client:','tempus' ) . '</span>' . esc_html($tempus_project_client); ?></div>
      <?php } ?>
      <?php if ( get_post_meta(get_the_ID(), 'tempus_show_category', true) != 'off' && $tempus_project_category ) { ?>
        <div class="info-category"><span><?php echo esc_attr__( 'Category:','tempus' ) . '</span>' . esc_html($tempus_project_category); ?></div>
      <?php } ?>
      <?php if ( get_post_meta(get_the_ID(), 'tempus_show_date', true) != 'off' ) { ?>
        <div class="info-date"><span><?php echo esc_attr__( 'Date:','tempus' ) . '</span>' . esc_html($tempus_project_date = ($tempus_project_date) ? date('F d, Y', strtotime($tempus_project_date)) : get_the_date() ); ?></div>
      <?php }
      if ( get_post_meta(get_the_ID(), 'tempus_show_share', true) != 'off' ) {
      } ?>
    </div>
    </div>
  <?php }
}

/* ----------------------------------------------------- */
/* Social Share in posts/portfolio */
/* ----------------------------------------------------- */

function tempus_share() {
  include get_template_directory() . '/admin/link-plus.php';
  $tempus_shared = new tempus_GetGlobal();
  $themeworm_slug = ( get_option('themeworm_slug') ) ?: 'portfolio-item';
  $in_cats = ( function_exists('ot_get_option') && ot_get_option('in_cats') ) ? implode( ",", ot_get_option('in_cats') ) : '';
  $show_share = ( get_post_type( get_the_ID() ) == "post" ) ? false : $tempus_shared->shared; ?>

  <div class="portfolio-share container wow fadeIn">
    <?php if ( get_post_type( get_the_ID() ) == $themeworm_slug ) {
    	if ( get_adjacent_post( false, '', false ) ) { next_post_link_plus( array( 'order_by' => 'menu_order', 'format' => '%link', 'link' => '<em>' . esc_html__('Next Project', 'tempus') . '</em><span>%title</span>', 'in_cats' =>  $in_cats ) ); }
    	if ( get_adjacent_post( false, '', true ) ) { previous_post_link_plus( array( 'order_by' => 'menu_order', 'format' => '%link', 'link' => '<em>' . esc_html__('Previous Project', 'tempus') . '</em><span>%title</span>', 'in_cats' => $in_cats ) ); }
    } ?>
    <?php tempus_share_me(); ?>
  </div>
<?php }

function tempus_share_me() {
  if ( function_exists('ot_get_option') && ot_get_option('portfolio_share_on') != 'off') { ?>

    <?php if ( ot_get_option('portfolio_share_icons') ) {
      $portfolio_share_icons = ot_get_option('portfolio_share_icons'); ?>
      <div class="post-share">
        <?php if ( isset($portfolio_share_icons[0]) ) { ?>
          <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>+<?php the_permalink(); ?>" class="fa fa-twitter" target="_blank"></a>
        <?php } ?>
        <?php if ( isset($portfolio_share_icons[1]) ) { ?>
          <a href="https://www.facebook.com/share.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" class="fa fa-facebook" target="_blank"></a>
        <?php } ?>
        <?php if ( isset($portfolio_share_icons[2]) ) { ?>
          <?php $pinterestimage = (wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' )) ? wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ) : array(); ?>
          <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>&media=<?php echo esc_url($pinterestimage[0]); ?>&description=<?php the_title(); ?>" class="fa fa-pinterest-p" target="_blank"></a>
        <?php } ?>
        <?php if ( isset($portfolio_share_icons[3]) ) { ?>
          <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" class="fa fa-linkedin" target="_blank"></a>
        <?php } ?>
      </div>
    <?php } else { ?>
      <div class="post-share">
        <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>+<?php the_permalink(); ?>" class="fa fa-twitter" target="_blank"></a>
        <a href="https://www.facebook.com/share.php?u=<?php the_permalink(); ?>&title=<?php the_title(); ?>" class="fa fa-facebook" target="_blank"></a>
        <?php $pinterestimage = (wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' )) ? wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' ) : array(); ?>
        <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>&media=<?php echo esc_url($pinterestimage[0]); ?>&description=<?php the_title(); ?>" class="fa fa-pinterest-p" target="_blank"></a>
        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" class="fa fa-linkedin" target="_blank"></a>
      </div>
    <?php } ?>
  <?php }
}

/* ----------------------------------------------------- */
/* Output Map in Contacts Page */
/* ----------------------------------------------------- */

function tempus_contact_map( $param = false ) {
  $map_address = ( function_exists('ot_get_option') && ot_get_option('map_address') && ot_get_option('map_on') != 'off' ) ? esc_html(ot_get_option('map_address')) : '';
  $map_height = ( function_exists('ot_get_option') && ot_get_option('map_height') ) ? ot_get_option('map_height') : '';

  if ( $map_address ) {
  	$mapID = rand (1, 999);
  	$prepAddr = esc_attr( str_replace(' ', '+', $map_address) );
  	$geocode = wp_remote_fopen('https://maps.google.com/maps/api/geocode/json?address='. $prepAddr .'&sensor=false');
  	$output = json_decode($geocode);
  	$latitude = ( is_array($output) ) ? esc_attr($output->results[0]->geometry->location->lat) : '0';
  	$longitude = ( is_array($output) ) ? esc_attr($output->results[0]->geometry->location->lng) : '0';

    $latitude = ( function_exists('ot_get_option') && ot_get_option('map_latitude') ) ? esc_attr(ot_get_option('map_latitude')) : $latitude;
  	$longitude = ( function_exists('ot_get_option') && ot_get_option('map_longitude') ) ? esc_attr(ot_get_option('map_longitude')) : $longitude;

    $output = '<div id="googlemaps-ID1" class="google-map map_height-' . esc_html($map_height) . ' wow fadeIn" data-map="' . esc_html($prepAddr) . '"></div>';

  	return $output = ($param) ? "var latitude = " . $latitude . ", longitude = " . $longitude : $output;
  }
}

function tempus_map_init() {
  $map_key = ( function_exists('ot_get_option') && ot_get_option('map_key') ) ? esc_attr(ot_get_option('map_key')) : '';
  if ( is_page_template("templates/template-contact.php") && function_exists('ot_get_option') && ot_get_option('map_address') && ot_get_option('map_on') != 'off' ) {
    wp_enqueue_script( 'maps', 'https://maps.googleapis.com/maps/api/js?key='. $map_key . '&libraries=geometry', 'jquery', '2.1', true );
    wp_enqueue_script( 'maplace', get_template_directory_uri() . '/assets/js/maplace.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'googlemap', get_template_directory_uri() . '/assets/js/googlemap.js', array( 'jquery' ), false, true );
    wp_add_inline_script ( 'googlemap', tempus_contact_map('coordinates'), 'before');
  }
}

add_action( 'wp_enqueue_scripts', 'tempus_map_init' );

/* ----------------------------------------------------- */
/* Vegas Slides */
/* ----------------------------------------------------- */

function tempus_vegas_slides($slides, $slider_attrs) {
  if ($slides) {
    $slider_attrs = 'var slidesAttr = [' . $slider_attrs . '];';
    $output = 'var getSlides = [ ' . $slides . ' ], getOverlay = "' . get_template_directory_uri() . '/assets/images/overlay.png";' . $slider_attrs;
    wp_enqueue_script( 'vegas_slides', get_template_directory_uri() . '/assets/js/vegas_slides.js' );
    wp_add_inline_script ( 'vegas_slides', $output, 'before');
  }
}

/* ----------------------------------------------------- */
/* Ligtbox video ratio */
/* ----------------------------------------------------- */

function tempus_get_lightbox_ratio() { ?>
	var fancyRatio;
	<?php
	if ( function_exists('ot_get_option') && ot_get_option('video_ratio')) {
		echo ot_get_option('video_ratio') ? 'fancyRatio = ' . esc_attr(ot_get_option('video_ratio')) . ';'  : '' ;
	}
}

/* ----------------------------------------------------- */
/* HEX to RGBA color */
/* ----------------------------------------------------- */

function tempus_hex2rgba($color, $opacity = false) {

  $default = 'rgb(0,0,0)';

  if ( empty($color) ) return $default;

  if ( $color[0] == '#' ) {
    $color = substr( $color, 1 );
  }

  if ( strlen($color) == 6 ) {
    $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
  } elseif ( strlen( $color ) == 3 ) {
    $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
  } else {
    return $default;
  }

  $rgb =  array_map('hexdec', $hex);

    if ($opacity) {
        if (abs($opacity) > 1)
            $opacity = 1.0;
        $output = implode(",", $rgb) . ',' . $opacity;
    } else {
        $output = implode(",", $rgb);
    }

  return esc_html($output);
}

/* ----------------------------------------------------- */
/* Post Gallery */
/* ----------------------------------------------------- */

function tempus_post_gallery() {
  $ident = get_post_meta(get_the_ID(), 'tempus_post_gallery_images', TRUE);
  $args = array(
    'post_type' => 'attachment',
    'post_status' => 'inherit',
    'post_mime_type' => 'image',
    'post__in' => explode( ",", $ident),
    'posts_per_page' => '-1',
    'orderby' => 'post__in'
  );
  $gallery_array = get_posts( $args );

  if ($gallery_array) { ?>

    <div class="four columns post-gallery wow fadeIn">

      <?php if ( get_post_meta(get_the_ID(), 'tempus_post_gallery_layout', TRUE) == "tiled-gallery" ) {

        tempus_justified_gallery( $gallery_array );

      } elseif ( get_post_meta(get_the_ID(), 'tempus_post_gallery_layout', TRUE) == "classic-gallery" ) {

        tempus_classic_gallery( $gallery_array );

      } elseif ( get_post_meta(get_the_ID(), 'tempus_post_gallery_layout', TRUE) == "masonry-gallery" ) {

        tempus_masonry_gallery( $gallery_array );

      } ?>

    </div>

  <?php } ?>
<?php }

/* ----------------------------------------------------- */
/* Justified Gallery */
/* ----------------------------------------------------- */

function tempus_justified_gallery( $images_array = array(), $fullwidth_class = '' ) {
  if ($images_array) { ?>

    <div class="images-container <?php echo esc_attr($fullwidth_class) ?>">
      <div class="justified-gallery-container">
        <div class="justified-gallery">

          <?php foreach ($images_array as $image) {
            $attachment = wp_get_attachment_image_src($image->ID, 'full');
            $thumb = wp_get_attachment_image_src($image->ID, 'full'); ?>

            <a class="slick-slide" href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group" title="<?php echo esc_html($image->post_title); ?>" data-caption="<?php echo esc_html($caption = ($image->post_excerpt) ?: $image->post_title ); ?>" >
              <img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_html($image->post_title); ?>" />
            </a>

          <?php } ?>

        </div>
      </div>
    </div>

  <?php }
}

/* ----------------------------------------------------- */
/* Classic Gallery */
/* ----------------------------------------------------- */

function tempus_classic_gallery( $images_array = array(), $fullwidth_class = '', $count = '' ) {
  if ($images_array) {

    $galleryID = rand (1, 999);

    if ( in_array(get_post_meta(get_the_ID(), 'tempus_gallery_layout', TRUE), array("classic-gallery4", "classic-gallery4-boxed")) ) {
      $count = 'four';
    } elseif ( in_array(get_post_meta(get_the_ID(), 'tempus_gallery_layout', TRUE), array("classic-gallery3", "classic-gallery3-boxed")) ) {
      $count = 'three';
    }  elseif ( get_post_meta(get_the_ID(), 'tempus_gallery_layout', TRUE) == "classic-gallery6" ) { $count = 'six';
    } else {
      $count = 'one';
    }

    $fullwidth_class .= ( in_array(get_post_meta(get_the_ID(), 'tempus_gallery_layout', TRUE), array("classic-gallery4-boxed", "classic-gallery3-boxed", "classic-gallery-boxed")) ) ? ' boxed-style ' : ''; ?>

    <div id="portfolio-gallery-wrapper-<?php echo esc_html($galleryID); ?>" class="<?php echo esc_attr($fullwidth_class) ?>">

      <?php foreach($images_array as $image) {
        $attachment = wp_get_attachment_image_src($image->ID, 'full');
        $thumb = wp_get_attachment_image_src($image->ID, 'tempus_blog-main'); ?>

        <div class="portfolio-<?php echo esc_attr($count); ?> portfolio-gallery-item">
          <a href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group" title="<?php echo esc_html($image->post_title); ?>" data-caption="<?php echo esc_html($caption = ($image->post_excerpt) ?: $image->post_title ); ?>" >
            <div class="thumb" style="background-image:url('<?php echo esc_url($thumb[0]); ?>');" alt="<?php echo esc_html($image->post_title); ?>"></div>
          </a>
        </div>

      <?php } ?>

    </div>

    <?php	wp_enqueue_script( 'tempus_classic_script', get_template_directory_uri() .'/assets/js/gallery_classic.js', array( 'jquery' ), false, true );
    wp_add_inline_script( 'tempus_classic_script', 'var classicGalleryID = ' . esc_html($galleryID) . ';', 'before' ); ?>

  <?php	}
}

/* ----------------------------------------------------- */
/* Get Items Height */
/* ----------------------------------------------------- */

function tempus_getitemheight($galleryID = 0) {
  wp_enqueue_script( 'tempus_classic_script', get_template_directory_uri() .'/assets/js/gallery_classic.js', array( 'jquery' ), false, true );
  wp_add_inline_script( 'tempus_classic_script', 'var classicGalleryID = ' . esc_html($galleryID) . ';', 'before' );
}

/* ----------------------------------------------------- */
/* Masonry Gallery */
/* ----------------------------------------------------- */

function tempus_masonry_gallery($images_array = array(), $fullwidth_class = '') {
  if ($images_array) {
    $galleryID = rand (1, 999); ?>

		<div id="portfolio-gallery-wrapper-<?php echo esc_html($galleryID); ?>"  class="<?php echo esc_attr($fullwidth_class) ?>">
			<?php foreach($images_array as $image){
				$attachment = wp_get_attachment_image_src($image->ID, 'full');
				$ratio = ($attachment[2] > 0) ? $attachment[1]/$attachment[2] : '';
				$thumb = wp_get_attachment_image_src($image->ID, 'tempus_blog-main'); ?>
				<div class="one-masonry portfolio-gallery-item item-<?php echo esc_html($galleryID); ?>" data-ratio="<?php echo esc_html($ratio) ?>">
					<a href="<?php echo esc_url($attachment[0]); ?>" data-fancybox="group" title="<?php echo esc_html($image->post_title); ?>" data-caption="<?php echo esc_html($caption = ($image->post_excerpt) ?: $image->post_title ); ?>" >
						<img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php echo esc_html($image->post_title); ?>" />
					</a>
				</div>
			<?php } ?>
		</div>

    <?php	wp_enqueue_script( 'tempus_masonry_script', get_template_directory_uri() .'/assets/js/gallery_masonry.js', array( 'jquery' ), false, true );
    wp_add_inline_script( 'tempus_masonry_script', 'var masonryGalleryID = ' . esc_html($galleryID) . ';', 'before' ); ?>

	<?php }
}

/* ----------------------------------------------------- */
/* Get Items Masonry */
/* ----------------------------------------------------- */

function tempus_getitemmasonry($galleryID = 0) {
  wp_enqueue_script( 'tempus_masonry_script', get_template_directory_uri() .'/assets/js/gallery_masonry.js', array( 'jquery' ), false, true );
  wp_add_inline_script( 'tempus_masonry_script', 'var masonryGalleryID = ' . esc_html($galleryID) . ';', 'before' );
}

/* ----------------------------------------------------- */
/* Smart Gallery */
/* ----------------------------------------------------- */

function tempus_getsmart($galleryID = 0) {
  //wp_enqueue_script( 'tempus_smart_script', get_template_directory_uri() .'/assets/js/gallery_smart.js', array( 'jquery' ), false, true );
  //wp_add_inline_script( 'tempus_smart_script', 'var smartGalleryID = ' . esc_html($galleryID) . ';', 'before' ); ?>

  <script>
    ( function( $ ) {

      var smartGalleryID = <?php echo esc_html($galleryID); ?>;

      $(document).ready(function() {
        tempus_getSmartItemHeight(smartGalleryID);
      });

      $(window).resize(function(){
        tempus_getSmartItemHeight(smartGalleryID);
      });

      function tempus_getSmartItemHeight(galleryID) {
        if ($("#portfolio-gallery-wrapper-" + galleryID).length > 0 ) {
          $('.gallery-itemid-' + galleryID).each(function() {
            var $this = $(this);
            $(this).css({"height" : $(this).parent().width()/3})
          })
        }
      }
    } )( jQuery );
  </script>


<?php }

/* ----------------------------------------------------- */
/* Justified Gallery */
/* ----------------------------------------------------- */

function tempus_getjustified($galleryID = 0) {
  wp_enqueue_script( 'tempus_justified_script', get_template_directory_uri() .'/assets/js/gallery_justified.js', array( 'jquery' ), false, true );
  wp_add_inline_script( 'tempus_justified_script', 'var justifiedGalleryID = ' . esc_html($galleryID) . ';', 'before' );
}

/* ----------------------------------------------------- */
/* About Me custom color */
/* ----------------------------------------------------- */

function tempus_about_color() {
  wp_enqueue_style( 'custom', get_template_directory_uri() . '/assets/css/custom.css' );
  wp_add_inline_style( 'custom', '.contact-btn { border-color: ' . esc_attr(ot_get_option("about_color")) . '; }' );
}

/* ----------------------------------------------------- */
/* Elementor Extension */
/* ----------------------------------------------------- */

// class tempus_elementor_plugin_name {
//   function __construct() {
// 		$plugin_name = 'elementor-tempus';
// 		$this->plugin_name = $plugin_name;
// 	}
// }
//
// $tempus_elementor_plugin_name = new tempus_elementor_plugin_name();
//
// if (in_array( $tempus_elementor_plugin_name->plugin_name . '/elementor-tempus.php', apply_filters('active_plugins', get_option('active_plugins')))) {
//
// 	include WP_PLUGIN_DIR . '/' . $tempus_elementor_plugin_name->plugin_name . '/includes/page-settings.php';
//
// }
//
// function tempus_elementor_style() {
//   $tempus_elementor_plugin_name = new tempus_elementor_plugin_name();
// 	wp_enqueue_style( 'elementor_tempus', plugins_url() . '/' . $tempus_elementor_plugin_name->plugin_name . '/assets/css/elementor-tempus.css' );
// }
//
// if (in_array( $tempus_elementor_plugin_name->plugin_name . '/elementor-tempus.php', apply_filters('active_plugins', get_option('active_plugins')))) {
// 	add_action('wp_enqueue_scripts', 'tempus_elementor_style');
// }

/* ----------------------------------------------------- */
/* TGM */
/* ----------------------------------------------------- */

require_once get_template_directory() . '/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'tempus_register_required_plugins' );

if (!function_exists('tempus_register_required_plugins')) {
function tempus_register_required_plugins() {

	$plugins = array(
		array(
			'name'               => 'Portfolio Installer', // The plugin name.
			'slug'               => 'portfolio-installer', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/plugins/portfolio-installer.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '4.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
		),
    array(
			'name'               => esc_html__('OptionTree', 'tempus'),
			'slug'               => 'option-tree',
      'source'             => get_template_directory() . '/plugins/option-tree.zip',
			'required'           => true,
			'version'            => '2.7.0',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => ''
		),
    array(
      'name'               => esc_html__('Envato Market', 'tempus'),
      'slug'               => 'envato-market',
      'source'             => get_template_directory() . '/plugins/envato-market.zip',
      'required'           => false,
      'version'            => '2.0.0',
      'force_activation'   => false,
      'force_deactivation' => false,
      'external_url'       => ''
    ),
		array(
			'name'               => 'Contact Form 7',
			'slug'               => 'contact-form-7',
			'required'           => false,
			'version'            => '5.0',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => ''
		)

	);

  $config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'tempus' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'tempus' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'tempus' ), // %s = plugin name.
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'tempus' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'tempus'
			), // %1$s = plugin name(s).
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'tempus'
			), // %1$s = plugin name(s).
			'notice_cannot_install'           => _n_noop(
				'Sorry, but you do not have the correct permissions to install the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to install the %1$s plugins.',
				'tempus'
			), // %1$s = plugin name(s).
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'tempus'
			), // %1$s = plugin name(s).
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'tempus'
			), // %1$s = plugin name(s).
			'notice_cannot_update'            => _n_noop(
				'Sorry, but you do not have the correct permissions to update the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to update the %1$s plugins.',
				'tempus'
			), // %1$s = plugin name(s).
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'tempus'
			), // %1$s = plugin name(s).
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'tempus'
			), // %1$s = plugin name(s).
			'notice_cannot_activate'          => _n_noop(
				'Sorry, but you do not have the correct permissions to activate the %1$s plugin.',
				'Sorry, but you do not have the correct permissions to activate the %1$s plugins.',
				'tempus'
			), // %1$s = plugin name(s).
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'tempus'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'tempus'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'tempus'
			),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'tempus' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'tempus' ),
			'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'tempus' ),
			'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'tempus' ),  // %1$s = plugin name(s).
			'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'tempus' ),  // %1$s = plugin name(s).
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'tempus' ), // %s = dashboard link.
			'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'tempus' ),

			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );

} }

?>
