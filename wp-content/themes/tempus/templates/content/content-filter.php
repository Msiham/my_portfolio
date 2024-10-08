<?php
/**
 * Filter template part
 */

if ( get_post_meta($post->ID, 'tempus_filters_on', true) == 'on' ) { ?>

  <div class="filters-container container">

  <?php if ( is_page() ) {
      $filters = get_post_meta($post->ID, 'tempus_portfolio_filters', true);
    } else {
      $filters = get_post_meta($post->ID, 'tempus_recent_portfolio_filters', true);
    }

    $filter_array = '';
    $all = 0;

  	$terms = get_terms( 'filters', array( 'include' => $filters, 'orderby' => 'slug' ) );
    $data_order = ( function_exists('ot_get_option') && ot_get_option('portfolio_sorting') ) ? ot_get_option('portfolio_sorting') : 'date';
    $posts_per_page = ( function_exists('ot_get_option') && ot_get_option('portfolio_showpost') ) ? ot_get_option('portfolio_showpost') : 9;

    foreach ( $terms as $counter ) {
      $all = $all + $counter->count;
    }

    foreach ( $terms as $filter ) {
      $filter_array .= $filter->term_id . ',';
    }
    $data_filters = ($filters) ? $filter_array : 'all' ?>

  	<ul id="filter" class="portfolio-filters">
  		<li data-filter="<?php echo esc_attr($data_filters); ?>" data-count="<?php echo esc_attr($all); ?>" data-order="<?php echo esc_attr($data_order); ?>" data-perpage="<?php echo esc_attr($posts_per_page); ?>"><a href="#"><?php esc_html_e( 'All', 'tempus' ); ?></a></li>
  		  <?php	foreach ( $terms as $term ) {
  				echo '<li data-filter="' . esc_html($term->term_id) . '" data-count="' . $term->count . '" data-order="' . esc_attr($data_order) . '" data-perpage="'. esc_attr($posts_per_page) .'"><a href="#">' . esc_html($term->name) . '</a></li>';
  			} ?>
  	</ul>

  	<script>
  		// (function() {
  		// 	[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
  		// 		new SelectFx(el);
  		// 	} );
  		// })();
  	</script>

  </div>

<?php } ?>
