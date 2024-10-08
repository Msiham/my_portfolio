<?php
/**
 * Title template part
 */

if (!function_exists('is_shop') || (function_exists('is_shop') && !is_shop() && !is_product_category()) ) {
  $themeworm_slug = ( get_option('themeworm_slug') ) ?: 'portfolio-item';

if ( is_search() || is_404() || is_archive() || get_post_type( get_the_ID() ) == "post" && get_post_meta($post->ID, 'tempus_display_title', true) != "off" || get_post_type( get_the_ID() ) == "page" && get_post_meta($post->ID, 'tempus_display_title', true) != "off" || get_post_type( get_the_ID() ) == $themeworm_slug && get_post_meta($post->ID, 'tempus_portfolio_title', true) != "off" ) {

  $queried_object = get_queried_object();
  if ( is_category() || is_search() || is_404() || is_tax() || is_tag() || is_day() || is_month() || is_year() || is_author() || is_archive() /*|| (is_front_page() && single_post_title())*/ || (is_home() && single_post_title()) ) { ?>
    <div class="container title_container archive-container">
      <div id="page-title" class="wow fadeIn">

        <?php if (is_search()) { ?>
          <h1><?php echo esc_html__('Search for:', 'tempus') .' <span>'. get_search_query().'</span>'; ?></h1>
        <?php }

        elseif (is_404()) { ?>
          <h1><?php echo '404 <span>' . esc_html__('Page Not Found', 'tempus') . '</span>'; ?></h1>
        <?php }

        elseif (is_category()) { ?>
          <h1><?php printf(esc_html__('Category', 'tempus').':<span> %s</span>', '' . single_cat_title('', false) . ''); ?></h1>
        <?php }

        elseif (is_tag()) { ?>
          <h1><?php printf(esc_html__('Tag', 'tempus').':<span> %s</span>', '' . single_cat_title('', false) . ''); ?></h1>
        <?php }

        elseif (is_author()) { ?>
          <h1><?php printf(esc_html__('Author', 'tempus').':<span> '. get_the_author().'</span>', '' . single_cat_title('', false) . ''); ?></h1>
        <?php }

        elseif (is_day()) { ?>
          <h1><?php printf(esc_html__('Daily Archives', 'tempus').':<span> %s </span>', get_the_date()); ?></h1>
        <?php }

        elseif (is_month()) { ?>
          <h1><?php printf(esc_html__('Monthly Archives','tempus').':<span> %s</span>', get_the_date('F Y')); ?></h1>
        <?php }

        elseif (is_year()) { ?>
          <h1><?php printf(esc_html__('Yearly Archives', 'tempus').':<span> %s</span>', get_the_date('Y')); ?></h1>
        <?php }

        elseif (is_tax() || is_archive()) { ?>
          <h1><?php $queried_object = get_queried_object();
            print $queried_object->name; ?></h1>
        <?php }

        elseif (is_home() || is_front_page()) { ?>
          <?php if (single_post_title()) { ?>
            <h1><?php single_post_title(); ?></h1>
          <?php } ?>
        <?php } ?>

      </div>
    </div>
  <?php } elseif ( is_home() && !single_post_title() ) {

  } else {
    tempus_title();
  }

}
}
