<?php

add_action('widgets_init', 'tempus_theme_widgets');

function tempus_theme_widgets() {
	register_widget('tempus_recent_posts');
	register_widget('tempus_social');
	register_widget('tempus_author');
	register_widget('tempus_contacts');
	register_widget('tempus_social_menu');
}

class tempus_recent_posts extends WP_Widget {

  function __construct() {
    $widget_ops = array('classname' => 'tw-recent-posts', 'description' => esc_html__( 'Recent posts', 'tempus' ));
    $control_ops = array('width' => 300);
    parent::__construct('tempus_recent_posts', '--- Recent Posts ---', $widget_ops, $control_ops);
  }

	function form($instance) {
    $instance = wp_parse_args((array) $instance, array('title' => ''));
    $title = strip_tags($instance['title']);
    $count = (isset($instance['count'])) ? $instance['count'] : ''; ?>

    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Widget Title:', 'tempus'); ?>
      	<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e('How many items show, only number 1-9:', 'tempus'); ?>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($count); ?>" />
      </label>
    </p>

  <?php }

  function widget($args, $instance) {
    extract($args, EXTR_SKIP);
    echo $args['before_widget'];
    $title = apply_filters( 'widget_title', $instance['title'] );
    $count = $instance['count'];

    if ( $title ) echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>
		<ul>
			<?php $recent_posts = new WP_Query(
				array(
					'post_type' => 'post',
					'posts_per_page' => $count,
					'post_status' => 'publish',
					'nopaging' => 0,
					'post__not_in' => get_option('sticky_posts')
				)
			);

			if ($recent_posts->have_posts()) :while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>

				<li class="latest-post-blog">
					<?php if (has_post_thumbnail()) { ?>
						<a href="<?php the_permalink() ?>" class="widget-thumb"> <?php the_post_thumbnail('tempus_portfolio-footer'); ?></a>
					<?php } else { ?>
						<a href="<?php the_permalink() ?>" class="no-thumb"></a>
					<?php } ?>

					<a href="<?php the_permalink() ?>" class="latest-title"><?php the_title(); ?></a>
				</li>
			<?php	endwhile;
			endif;
			wp_reset_postdata();	?>
		</ul>
  	<?php echo $args['after_widget'];
  }

  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['count'] = $new_instance['count'];
    return $instance;
  }

}

class tempus_social_menu extends WP_Widget {

  public function __construct() {
    $widget_ops = array('classname' => 'widget-themeworm_social_menu', 'description' => esc_html__( 'Social icons menu', 'tempus' ));
    $control_ops = array('width' => 300);
    parent::__construct('tempus_social_menu', '--- Social Menu ---', $widget_ops, $control_ops);
  }

  public function form( $instance ) {
    $title = isset( $instance['title'] ) ? $instance['title'] : '';
    $nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';
    $menus = wp_get_nav_menus(); ?>

    <p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
      <?php if ( isset( $GLOBALS['wp_customize'] ) && $GLOBALS['wp_customize'] instanceof WP_Customize_Manager ) {
        $url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
      } else {
        $url = admin_url( 'nav-menus.php' );
      } ?>
      <?php echo sprintf( esc_html__( 'No menus have been created yet. <a href="%s">Create some</a>.', 'tempus' ), esc_attr( $url ) ); ?>
    </p>

    <div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title:', 'tempus'); ?></label>
        <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr( $title ); ?>"/>
      </p>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( 'nav_menu' )); ?>"><?php esc_html_e('Select Menu:', 'tempus'); ?></label>
        <select id="<?php echo esc_attr($this->get_field_id( 'nav_menu' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'nav_menu' )); ?>">
          <option value="0"><?php esc_html_e('Select', 'tempus'); ?></option>
          <?php foreach ( $menus as $menu ) : ?>
            <option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
              <?php echo esc_html( $menu->name ); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </p>
    </div>
  <?php }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    if ( ! empty( $new_instance['title'] ) ) {
      $instance['title'] = sanitize_text_field( $new_instance['title'] );
    }
    if ( ! empty( $new_instance['nav_menu'] ) ) {
      $instance['nav_menu'] = (int) $new_instance['nav_menu'];
    }
    return $instance;
  }

  public function widget( $args, $instance ) {

    $nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;
    if ( !$nav_menu )
      return;

    $instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

    echo $args['before_widget'];

    if ( !empty($instance['title']) )
      echo $args['before_title'] . $instance['title'] . $args['after_title'];

    $nav_menu_args = array(
      'container_class' => 'social_menu_widget',
      'fallback_cb' => '',
      'link_before' => '<span>',
      'link_after' => '</span>',
      'depth' => 1,
      'items_wrap' => '%3$s',
      'menu' => $nav_menu,
      'walker' => new tempus_Social_Walker
    );

    wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args, $instance ) );

    echo $args['after_widget'];
  }
}

class tempus_Social_Walker extends Walker_Nav_Menu {
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $classes = empty($item->classes) ? array () : (array) $item->classes;
    $class_names = join(' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
    !empty( $class_names ) and $class_names = ' class="'. esc_attr( $class_names ) . '"';
    $attributes = $custom  = '';
    !empty( $item->attr_title ) and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';
    !empty( $item->target ) and $attributes .= ' target="' . esc_attr( $item->target ) .'"';
    !empty( $item->xfn ) and $attributes .= ' rel="' . esc_attr( $item->xfn ) .'"';
    $title = apply_filters( 'the_title', $item->title, $item->ID );

    if (!empty( $title ) && strtolower( $title ) == 'custom' ) {
      if (!empty( $item->url )) {
        $urls = explode('|', $item->url);
        $attributes .= ' href="' . esc_attr( $link_url = (is_array($urls)) ? $urls[1] : $item->url ) .'"' . 'class="custom-social-link"';
        $custom = '<img src="'. $urls[0] .'" class="custom-social svg" />';
      }
    } else {
      !empty( $item->url ) and $attributes .= ' href="' . esc_attr( $item->url ) .'"';
    }

    $item_output = $args->before
      . "<a $attributes target=_blank>"
        . $custom
        . $args->link_before
        . $title
      . '</a>'
      . $args->link_after
      . $args->after;
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}


class tempus_social extends WP_Widget {

	function __construct() {
    $widget_ops = array('classname' => 'widget-themeworm_social', 'description' => esc_html__( 'Social icons', 'tempus' ));
    $control_ops = array('width' => 300);
    parent::__construct('tempus_social', '--- Social ---', $widget_ops, $control_ops);
    $this->social = array('twitter', 'facebook', 'skype', 'instagram', 'youtube', 'vimeo', 'imdb', 'dribbble', 'behance', 'flickr', 'dropbox', 'googleplus', 'pinterest', 'soundcloud', 'github', 'linkedin', 'xing', 'rss', 'envelope');
  }

  function form( $instance ) {

    $title = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] ); ?>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Title:</label>
      <input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>

    <?php foreach ($this->social as $slug) : ?>
      <p>
        <label for="<?php echo esc_attr($this->get_field_id( $slug )); ?>"><?php echo esc_attr(ucfirst($slug)); ?>:</label>
        <input id="<?php echo esc_attr($this->get_field_id( $slug )); ?>" name="<?php echo esc_attr($this->get_field_name( $slug )); ?>" value="<?php echo !empty($instance[$slug]) ? esc_url($instance[$slug]) : ''; ?>" class="widefat" type="text" />
      </p>
    <?php endforeach;

  }

	function update( $new_instance, $old_instance ) {
  	$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
    foreach ($this->social as $slug) {
      $instance[$slug] = strip_tags( $new_instance[$slug] );
    }
		return $instance;
	}

	function widget( $args, $instance ) {

		extract($args, EXTR_SKIP);
		$title = apply_filters( 'widget_title', $instance['title'] );

    foreach ($this->social as $slug) {
      if (array_key_exists($slug, $instance)) {
        $$slug = $instance[$slug];
      }
    }

		echo $args['before_widget'];
		if ( $title ) echo $args['before_title'] . esc_attr( $title ) . $args['after_title'];
    echo '<div class="social-widget-inner">';

    foreach ($this->social as $slug) {
      if (!empty($instance[$slug])) {
				$surl = ($slug == 'envelope' ) ? 'mailto:' . $instance[$slug] : esc_url($instance[$slug]);
        echo '<a href="' . $surl . '" target="_blank"><i class="fa fa-'. esc_attr($slug) .'"></i></a>';
      }
		}

		echo '</div>'.$args['after_widget'];

	}
}

class tempus_author extends WP_Widget {

	function __construct() {
  	$widget_ops = array('classname' => 'author-meta', 'description' => esc_html__('Author information', 'tempus'));
    $control_ops = array('width' => 300);
    parent::__construct('tempus_author', '--- Author ---', $widget_ops, $control_ops);
  }

	function form( $instance ) {
		$title = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
		$author_id = empty( $instance['author_id'] ) ? '' : esc_attr( $instance['author_id'] );	?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Widget Title:', 'tempus'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'author_id' ) ); ?>"><?php esc_html_e('Author ID:', 'tempus'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'author_id' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'author_id' ) ); ?>" type="text" value="<?php echo esc_attr( $author_id ); ?>">
		</p>
	<?php	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['author_id'] = strip_tags( $new_instance['author_id'] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract($args, EXTR_SKIP);

		$title = apply_filters( 'widget_title', $instance['title'] );
		$author_id = $instance['author_id'];

		echo $args['before_widget'];
		if ( $title ) echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

		if ( !$author_id ) { $author_id = get_the_author_meta('ID'); }

		if ( $author_id ) { ?>

				<div class="author-avatar">
					<a href="<?php echo esc_url(get_author_posts_url( $author_id )); ?>"><?php echo get_avatar( $author_id, 96); ?></a>
				</div>
				<div class="description">
					<h3 class="author-title"><?php the_author(); ?></h3>

					<div class="author-social">
						<?php if (get_the_author_meta( 'twitter_profile', $author_id )) { ?><a href="<?php echo esc_url(get_the_author_meta( 'twitter_profile', $author_id )); ?>" class="fa fa-twitter" target="_blank"></a><?php } ?>
						<?php if (get_the_author_meta( 'facebook_profile', $author_id )) { ?><a href="<?php echo esc_url(get_the_author_meta( 'facebook_profile', $author_id )); ?>" class="fa fa-facebook" target="_blank"></a><?php } ?>
						<?php if (get_the_author_meta( 'google_profile', $author_id )) { ?><a href="<?php echo esc_url(get_the_author_meta( 'google_profile', $author_id )); ?>" class="fa fa-google-plus" target="_blank"></a><?php } ?>
						<?php if (get_the_author_meta( 'instagram_profile', $author_id )) { ?><a href="<?php echo esc_url(get_the_author_meta( 'instagram_profile', $author_id )); ?>" class="fa fa-instagram" target="_blank"></a><?php } ?>
					</div>

					<p class="author-bio">
						<?php echo esc_attr(get_the_author_meta( 'description', $author_id )); ?>
					</p>

		<?php
		}
		echo $args['after_widget'];

	}

}

class tempus_contacts extends WP_Widget {

	function __construct() {
  	$widget_ops = array('classname' => 'contacts-widget', 'description' => esc_html__('Contacts widget', 'tempus'));
    $control_ops = array('width' => 300);
    parent::__construct('tempus_contacts', '--- Contacts ---', $widget_ops, $control_ops);
  }

	function form( $instance ) {

		$title = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
		$contacts_text = empty( $instance['contacts_text'] ) ? '' : esc_attr( $instance['contacts_text'] );
		$contacts_address = empty( $instance['contacts_address'] ) ? '' : esc_attr( $instance['contacts_address'] );
		$contacts_email = empty( $instance['contacts_email'] ) ? '' : esc_attr( $instance['contacts_email'] );
		$contacts_phone = empty( $instance['contacts_phone'] ) ? '' : esc_attr( $instance['contacts_phone'] ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Widget Title:', 'tempus'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contacts_text' ) ); ?>"><?php esc_html_e('Text:', 'tempus'); ?></label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'contacts_text' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'contacts_text' ) ); ?>" type="text"><?php echo esc_attr( $contacts_text ); ?></textarea>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contacts_address' ) ); ?>"><?php esc_html_e('Address:', 'tempus'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'contacts_address' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'contacts_address' ) ); ?>" type="text" value="<?php echo esc_attr( $contacts_address ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contacts_email' ) ); ?>"><?php esc_html_e('Email:', 'tempus'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'contacts_email' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'contacts_email' ) ); ?>" type="text" value="<?php echo esc_attr( $contacts_email ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contacts_phone' ) ); ?>"><?php esc_html_e('Phone:', 'tempus'); ?>Phone:</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'contacts_phone' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'contacts_phone' ) ); ?>" type="text" value="<?php echo esc_attr( $contacts_phone ); ?>">
		</p>

	<?php	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['contacts_text'] = strip_tags( $new_instance['contacts_text'] );
		$instance['contacts_address'] = strip_tags( $new_instance['contacts_address'] );
		$instance['contacts_email'] = strip_tags( $new_instance['contacts_email'] );
		$instance['contacts_phone'] = strip_tags( $new_instance['contacts_phone'] );
		return $instance;

	}

	function widget( $args, $instance ) {
		extract($args, EXTR_SKIP);

		$title = apply_filters( 'widget_title', $instance['title'] );
		$contacts_text = $instance['contacts_text'];
		$contacts_address = $instance['contacts_address'];
		$contacts_email = $instance['contacts_email'];
		$contacts_phone = $instance['contacts_phone'];

		echo $args['before_widget'];
		if ( $title ) echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

		if ( $contacts_text ) { ?>
			<div class="contacts_text">
				<?php echo esc_html($contacts_text); ?>
			</div>
		<?php
		}

		if ( $contacts_address ) { ?>
			<div class="contacts_address">
				<?php echo esc_html($contacts_address); ?>
			</div>
		<?php
		}

		if ( $contacts_email ) { ?>
			<div class="contacts_email">
				<a href="mailto:<?php echo esc_attr($contacts_email); ?>"><?php echo esc_html($contacts_email); ?></a>
			</div>
		<?php
		}

		if ( $contacts_phone ) { ?>
			<div class="contacts_phone">
				<?php echo esc_html($contacts_phone); ?>
			</div>
		<?php
		}

		echo $args['after_widget'];

	}

} ?>
