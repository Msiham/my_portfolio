<?php

add_action( 'admin_init', 'tempus_custom_theme_options', 1 );

function tempus_custom_theme_options() {
  $layers = array();
  global $wpdb;

  $saved_settings = get_option( 'option_tree_settings', array() );

  $custom_settings = array(
    'contextual_help' => array(
      'content'       => array( array(
        'id'        => 'general_help',
        'title'     => esc_html__('General', 'tempus'),
        'content'   => esc_html__('Help content goes here!', 'tempus')
      ) ),
      'sidebar'       => esc_html__('Sidebar content goes here!', 'tempus')
    ),

    'sections'        => array(
      array(
        'title'       => esc_html__('General Options', 'tempus'),
        'id'          => 'general'
      ),
      array(
        'title'       => esc_html__('Logo & Menu', 'tempus'),
        'id'          => 'header'
      ),
      array(
        'title'       => esc_html__('Portfolio', 'tempus'),
        'id'          => 'portfolio'
      ),
      array(
        'title'       => esc_html__('Blog', 'tempus'),
        'id'          => 'blog'
      ),
      array(
        'title'       => esc_html__('About Me', 'tempus'),
        'id'          => 'aboutme'
      ),
      array(
        'title'       => esc_html__('Contacts Map', 'tempus'),
        'id'          => 'map'
      ),
		  array(
        'id'          => 'typo',
        'title'       => esc_html__('Typography', 'tempus')
      )
    ),

    'settings'        => array(

      array(
        'label'       => esc_html__('Top Navigation & Menu style', 'tempus'),
        'id'          => 'navigation_style',
        'type'        => 'radio-image',
        'desc'        => '',
        'choices'     => array(
          array(
            'label'=>  esc_html__('Logo + Navigation + Social', 'tempus'),
            'value'=> 'menu-default menu-right',
            'src' => get_template_directory_uri() . '/assets/images/options/lmi-menu.png'),
          array(
            'label'=>  esc_html__('Logo + Navigation', 'tempus'),
            'value'=> 'menu-default menu-right social-no',
            'src' => get_template_directory_uri() . '/assets/images/options/lm-menu.png'),
          array(
            'label'=>  esc_html__('Logo + Simple Navigation + Social', 'tempus'),
            'value'=> 'menu-alt',
            'src' => get_template_directory_uri() . '/assets/images/options/li-menu.png'),
          array(
            'label'=>  esc_html__('Logo + Simple Navigation', 'tempus'),
            'value'=> 'menu-alt alt-right social-no',
            'src' => get_template_directory_uri() . '/assets/images/options/ll-menu.png'),
          array(
            'label'=>  esc_html__('Right Logo + Left Simple Navigation', 'tempus'),
            'value'=> 'logo-right alt-left menu-alt social-no',
            'src' => get_template_directory_uri() . '/assets/images/options/lr-menu.png'),
          array(
            'label'=>  esc_html__('Social + Logo + Simple Navigation', 'tempus'),
            'value'=> 'social-left menu-alt alt-right logo-center',
            'src' => get_template_directory_uri() . '/assets/images/options/il-menu.png'),
          array(
            'label'=>  esc_html__('Simple Navigation + Logo + Social', 'tempus'),
            'value'=> 'social-right menu-alt alt-left logo-center',
            'src' => get_template_directory_uri() . '/assets/images/options/lli-menu.png'),
          array(
            'label'=>  esc_html__('Search + Centered Logo + Social + Centered Navigation', 'tempus'),
            'value'=> 'center-header logo-center search-left social-right menu-center',
            'src' => get_template_directory_uri() . '/assets/images/options/slmi-menu.png'),
          array(
            'label'=>  esc_html__('Search + Centered Logo + Social + Simple Navigation', 'tempus'),
            'value'=> 'center-header logo-center search-left social-right menu-center menu-alt',
            'src' => get_template_directory_uri() . '/assets/images/options/sli-menu.png'),
          array(
            'label'=>  esc_html__('Centered Logo + Simple Navigation', 'tempus'),
            'value'=> 'center-header logo-center search-no social-no menu-center menu-alt',
            'src' => get_template_directory_uri() . '/assets/images/options/l-menu.png'),
        ),
        'std'         => 'menu-default menu-right',
        'class'       => '',
        'section'     => 'header'
      ),

      array(
        'label'       => esc_html__('Hide search icon in menu', 'tempus'),
        'id'          => 'hide_menu_search',
        'type'        => 'on_off',
        'desc'        => '',
        'std'         => 'off',
        'class'       => '',
        'section'     => 'header'
      ),

      array(
        'label'       => esc_html__('How many menu items to show', 'tempus'),
        'id'          => 'counter_nav',
        'type'        => 'select',
        'desc'        => '',
        'choices'     => array(
          array('label'=> '3','value'=> '4'),
          array('label'=> '4','value'=> '5'),
          array('label'=> '5','value'=> '6'),
          array('label'=> '6','value'=> '7'),
      	  array('label'=> '7','value'=> '8')
        ),
        'std'         => '6',
        'class'       => '',
        'section'     => 'header'
      ),

      array(
        'label'       => esc_html__('Full width navigation menu', 'tempus'),
        'id'          => 'fullwidth_nav',
        'type'        => 'on_off',
        'desc'        => '',
        'std'         => 'off',
        'class'       => '',
        'section'     => 'header'
      ),

      array(
        'label'       => esc_html__('Header logo', 'tempus'),
        'id'          => 'logo_upload',
        'type'        => 'upload',
        'desc'        => esc_html__('Better use transparent png', 'tempus'),
        'std'         => '',
        'class'       => '',
        'section'     => 'header'
      ),

      array(
        'label'       => esc_html__('Logo height and width', 'tempus'),
        'id'          => 'logo_dimensions',
        'type'        => 'dimension',
        'desc'        => esc_html__('px', 'tempus'),
        'std'         => '',
        'rows'        => '',
        'class'       => '',
        'section'     => 'header'
      ),

      array(
        'label'       => esc_html__('Mobile Logo height and width', 'tempus'),
        'id'          => 'mobile_logo_dimensions',
        'type'        => 'dimension',
        'desc'        => esc_html__('px', 'tempus'),
        'std'         => '',
        'rows'        => '',
        'class'       => '',
        'section'     => 'header'
      ),

      array(
        'label'       => esc_html__('Logo text', 'tempus'),
        'id'          => 'logo_text',
        'type'        => 'text',
        'desc'        => esc_html__('Text in Logo', 'tempus'),
        'std'         => '',
        'class'       => '',
        'section'     => 'header'
      ),

      array(
        'label'       => esc_html__('Favicon ', 'tempus'),
        'id'          => 'favicon_upload',
        'type'        => 'upload',
        'desc'        => esc_html__('Upload favicon here - PNG or ICO 16x16px', 'tempus'),
        'std'         => '',
        'class'       => '',
        'section'     => 'header'
      ),

      array(
        'label'       => esc_html__('Social links in Main menu', 'tempus'),
        'id'          => 'header_social',
        'type'        => 'social_links',
        'desc'        => ' ',
        'std'         => '',
        'class'       => '',
        'section'     => 'header'
      ),

      array(
        'label'       => esc_html__('Custom Icon ', 'tempus'),
        'id'          => 'custom_icon_upload',
        'type'        => 'upload',
        'desc'        => esc_html__('Upload custom icon for social links here - PNG 16x16px', 'tempus'),
        'std'         => '',
        'class'       => '',
        'section'     => 'header'
      ),

      array(
        'label'       => esc_html__('Custom Icon URL', 'tempus'),
        'id'          => 'custom_icon_url',
        'type'        => 'text',
        'desc'        => esc_html__('Url for the icon', 'tempus'),
        'std'         => '',
        'class'       => '',
        'section'     => 'header'
      ),

      array(
        'label'       => esc_html__('Portfolio projects to display', 'tempus'),
        'id'          => 'portfolio_showpost',
        'type'        => 'select',
        'desc'        => esc_html__('Choose how many items to display on portfolio page', 'tempus'),
        'choices'     => array(
          array('label'=> '2','value'=> '2'),
          array('label'=> '3','value'=> '3'),
          array('label'=> '6','value'=> '6'),
          array('label'=> '7','value'=> '7'),
          array('label'=> '8','value'=> '8'),
          array('label'=> '9','value'=> '9'),
          array('label'=> '10','value'=> '10'),
          array('label'=> '11','value'=> '11'),
          array('label'=> '12','value'=> '12'),
          array('label'=> '13','value'=> '13'),
          array('label'=> '14','value'=> '14'),
          array('label'=> '15','value'=> '15'),
          array('label'=> '16','value'=> '16'),
          array('label'=> '17','value'=> '17'),
          array('label'=> '18','value'=> '18'),
          array('label'=> '19','value'=> '19'),
          array('label'=> '20','value'=> '20'),
          array('label'=> '32','value'=> '32'),
          array('label'=> 'All','value'=> '999')
        ),
        'std'         => '12',
        'class'       => '',
        'section'     => 'portfolio'
      ),

      array(
        'label'       => esc_html__('Tilter projects to display', 'tempus'),
        'id'          => 'portfolio_tilter_showpost',
        'type'        => 'select',
        'desc'        => esc_html__('Choose how many items to display on portfolio Tilter page', 'tempus'),
        'choices'     => array(
          array('label'=> '2','value'=> '2'),
          array('label'=> '3','value'=> '3'),
          array('label'=> '6','value'=> '6'),
          array('label'=> '7','value'=> '7'),
          array('label'=> '8','value'=> '8'),
          array('label'=> '9','value'=> '9'),
          array('label'=> '10','value'=> '10'),
          array('label'=> '11','value'=> '11'),
          array('label'=> '12','value'=> '12'),
          array('label'=> '13','value'=> '13'),
          array('label'=> '14','value'=> '14'),
          array('label'=> '15','value'=> '15'),
          array('label'=> '16','value'=> '16'),
          array('label'=> '17','value'=> '17'),
          array('label'=> '18','value'=> '18'),
          array('label'=> '19','value'=> '19'),
          array('label'=> '20','value'=> '20'),
          array('label'=> '32','value'=> '32'),
          array('label'=> 'All','value'=> '999')
        ),
        'std'         => '10',
        'class'       => '',
        'section'     => 'portfolio'
      ),

      array(
        'label'       => esc_html__('Portfolio projects order', 'tempus'),
        'id'          => 'portfolio_sorting',
        'type'        => 'select',
        'desc'        => esc_html__('Choose order of items on portfolio page', 'tempus'),
        'choices'     => array(
          array('label'=> esc_html__('Default (by Date)', 'tempus'),'value'=> 'date'),
          array('label'=> esc_html__('Custom Sort', 'tempus'),'value'=> 'menu_order'),
          array('label'=> esc_html__('by Title', 'tempus'),'value'=> 'title'),
          array('label'=> esc_html__('by Name (slug)', 'tempus'),'value'=> 'name'),
          array('label'=> esc_html__('Random', 'tempus'),'value'=> 'rand')
        ),
        'std'         => 'date',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'portfolio'
      ),

      array(
        'label'       => esc_html__('Video lightbox Ratio', 'tempus'),
        'id'          => 'video_ratio',
        'type'        => 'select',
        'desc'        => esc_html__('Video Aspect Ratio for Lightbox', 'tempus'),
        'choices'     => array(
          array('label'=> esc_html__('4:3', 'tempus'),'value'=> '1.33333'),
          array('label'=> esc_html__('16:9', 'tempus'),'value'=> '1.77777'),
          array('label'=> esc_html__('1.85:1', 'tempus'),'value'=> '1.85'),
          array('label'=> esc_html__('2:1', 'tempus'),'value'=> '2'),
          array('label'=> esc_html__('2.35:1', 'tempus'),'value'=> '2.35'),
          array('label'=> esc_html__('1:1', 'tempus'),'value'=> '1'),
          array('label'=> esc_html__('9:16 - vertical', 'tempus'),'value'=> '0.5625'),
        ),
        'std'         => '1.77777',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'portfolio'
      ),

      array(
        'label'       => esc_html__('Lightbox Captions', 'tempus'),
        'id'          => 'lightbox_captions',
        'type'        => 'radio',
        'desc'        => '',
        'choices'     => array(
          array('label'=> 'Custom Subtitle','value'=> 'subtitle'),
          array('label'=> 'Project Title','value'=> 'title'),
        ),
        'std'         => 'subtitle',
        'class'       => '',
        'section'     => 'portfolio'
      ),

      array(
        'label' => esc_html__('Portfolio categories for Next/Prev navigation', 'tempus'),
        'id' => 'in_cats',
        'type' => 'taxonomy-checkbox',
        'desc' => '',
        'taxonomy' => 'filters',
        'section'     => 'portfolio'
      ),

      array(
        'label'       => esc_html__('Padding between projects', 'tempus'),
        'id'          => 'portfolio_padding',
        'type'        => 'select',
        'desc'        => esc_html__('Default is 10', 'tempus'),
        'choices'     => array(
          array('label'=> '0','value'=> '0'),
          array('label'=> '1','value'=> '1'),
          array('label'=> '2','value'=> '2'),
          array('label'=> '3','value'=> '3'),
          array('label'=> '4','value'=> '4'),
          array('label'=> '5','value'=> '5'),
          array('label'=> '6','value'=> '6'),
          array('label'=> '8','value'=> '8'),
          array('label'=> '10','value'=> '10'),
          array('label'=> '12','value'=> '12'),
          array('label'=> '15','value'=> '15'),
          array('label'=> '20','value'=> '20')
        ),
        'std'         => '10',
        'class'       => '',
        'section'     => 'portfolio'
      ),

      array(
       'label'       => esc_html__('Infinite scroll', 'tempus'),
       'id'          => 'infinite_off',
       'type'        => 'on_off',
       'desc'        => '',
       'std'         => 'off',
       'class'       => '',
       'section'     => 'portfolio'
      ),

      array(
        'label'       => esc_html__('Recent Projects on single Page', 'tempus'),
        'id'          => 'recent_portfolio',
        'type'        => 'on_off',
        'desc'        => '',
        'std'         => 'off',
        'class'       => '',
        'section'     => 'portfolio'
      ),

      array(
       'label'       => esc_html__('Show share icons', 'tempus'),
       'id'          => 'portfolio_share_on',
       'type'        => 'on_off',
       'desc' => esc_html__('Enable Share icons in Footer section of a Portfolio project.', 'tempus'),
       'std'         => 'on',
       'class'       => '',
       'section'     => 'portfolio'
      ),

      array(
				'id'           => 'portfolio_share_icons',
				'label' => esc_html__('Share Icons', 'tempus'),
				'desc' => esc_html__('Put mark near which icons to show', 'tempus'),
				'std'          => '',
				'type'         => 'checkbox',
				'section'      => 'portfolio',
				'rows'         => '',
				'post_type'    => '',
				'taxonomy'     => '',
				'min_max_step' => '',
				'class'        => '',
				'condition'    => '',
				'operator'     => 'and',
				'choices'      => array(
					array(
						'value' => 'twitter_but',
						'label'   => esc_html__('Twitter', 'tempus'),
						'src'   => '',
					),
					array(
						'value' => 'facebook_but',
						'label'   => esc_html__('Facebook', 'tempus'),
						'src'   => '',
					),
          array(
            'value'   => 'pinterest_but',
            'label'   => esc_html__('Pinterest', 'tempus'),
						'src'   => '',
					),
          array(
            'value'   => 'linkedin_but',
            'label'   => esc_html__('LinkedIn', 'tempus'),
						'src'   => '',
					),
				),
			),

      array(
       'label'       => esc_html__('Show Play button and Info button for Video portfolios', 'tempus'),
       'id'          => 'portfolio_additional_info',
       'type'        => 'on_off',
       'desc'        => '',
       'std'         => 'off',
       'class'       => '',
       'section'     => 'portfolio'
      ),

      array(
        'label'       => esc_html__('Projects Titles', 'tempus'),
        'id'          => 'portfolio_titles',
        'type'        => 'radio',
        'desc'        => '',
        'choices'     => array(
          array('label'=> 'Show on Hover (Default)','value'=> 'titles-hover'),
          array('label'=> 'Always Show on Mobile','value'=> 'titles-mobile'),
          array('label'=> 'Always Show on Any Device','value'=> 'titles-all'),
        ),
        'std'         => 'titles-hover',
        'class'       => '',
        'section'     => 'portfolio'
      ),

      array(
        'label'       => esc_html__('Blog Sidebar', 'tempus'),
        'id'          => 'blog_layout',
        'type'        => 'radio',
        'desc'        => esc_html__('Choose sidebar side on blog.', 'tempus'),
        'std'         => 'left-sidebar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'choices'     => array(
          array(
            'value'   => 'left-sidebar',
            'label'   => esc_html__('Left Sidebar', 'tempus'),
          ),
          array(
            'value'   => 'right-sidebar',
            'label'   => esc_html__('Right Sidebar', 'tempus'),
          ),
    		  array(
            'value'   => 'no-sidebar',
            'label'   => esc_html__('No Sidebar', 'tempus'),
          )
        ),
        'class'       => '',
        'section'     => 'blog'
      ),

      array(
        'label'       => esc_html__('Latest Posts', 'tempus'),
        'id'          => 'blog_latest',
        'type'        => 'on_off',
        'desc'        => '',
        'std'         => 'off',
        'class'       => '',
        'section'     => 'blog'
      ),

      array(
        'label'       => esc_html__('Comments Form Open ', 'tempus'),
        'id'          => 'comments_open',
        'type'        => 'on_off',
        'desc'        => esc_html__('Keep comments form always open', 'tempus'),
        'std'         => 'off',
        'class'       => '',
        'section'     => 'blog'
      ),

      array(
        'label'       => esc_html__('Latest Posts Count', 'tempus'),
        'id'          => 'related_postcount',
        'type'        => 'select',
        'desc'        => esc_html__('How many recent posts show in post page', 'tempus'),
        'choices'     => array(
          array('label'=> '3','value'=> '3'),
          array('label'=> '6','value'=> '6')
        ),
        'std'         => '3',
        'class'       => '',
        'section'     => 'blog'
      ),

      array(
        'label'       => esc_html__('Hide search button in Blog Posts', 'tempus'),
        'id'          => 'blog_search_btn',
        'type'        => 'on_off',
        'desc'        => '',
        'std'         => 'off',
        'class'       => '',
        'section'     => 'blog'
      ),

      // array(
      //   'id'          => 'hide_comments',
      //   'label'       => esc_html__('Hide comments for all posts', 'tempus'),
      //   'desc'        => '',
      //   'std'         => 'no',
      //   'section'     => 'blog',
      //   'type'        => 'select',
      //   'desc'        => esc_html__('Enable/disable comments on blog pages', 'tempus'),
      //   'choices'     => array(
      //     array(
      //       'label'       => esc_html__('No', 'tempus'),
      //       'value'       => 'no'
      //     ),
      //     array(
      //       'label'       => esc_html__('Yes', 'tempus'),
      //       'value'       => 'yes'
      //     )
      //   )
      // ),

      array(
        'label'       => esc_html__('Enable page preloader', 'tempus'),
        'id'          => 'preloader_on',
        'type'        => 'on_off',
        'desc'        => '',
        'std'         => 'off',
        'class'       => '',
        'section'     => 'general'
      ),

      array(
        'label'       => esc_html__('Theme Main Color', 'tempus'),
        'id'          => 'main_color',
        'type'        => 'colorpicker',
        'desc'        => '',
        'std'         => '',
        'class'       => '',
        'section'     => 'general'
      ),

      array(
        'label'       => esc_html__('Background Color', 'tempus'),
        'id'          => 'background_color',
        'type'        => 'colorpicker',
        'desc'        => '',
        'std'         => '',
        'class'       => '',
        'section'     => 'general'
      ),

      array(
        'label'       => esc_html__('Enable Map in Contacts page', 'tempus'),
        'id'          => 'map_on',
        'type'        => 'on_off',
        'desc'        => '',
        'std'         => 'on',
        'class'       => '',
        'section'     => 'map'
      ),

      array(
        'label'       => esc_html__('Contacts Map height', 'tempus'),
        'id'          => 'map_height',
        'type'        => 'select',
        'desc'        => '',
        'choices'     => array(
          array('label'=> esc_html__('Default', 'tempus'),'value'=> 'default'),
          array('label'=> esc_html__('30%', 'tempus'),'value'=> 'map30'),
      	  array('label'=> esc_html__('50%', 'tempus'),'value'=> 'map50'),
          array('label'=> esc_html__('100%', 'tempus'),'value'=> 'map100')
          ),
        'std'         => '3',
        'class'       => '',
        'section'     => 'map'
      ),

      array(
        'label'       => esc_html__('Google Maps API key', 'tempus'),
        'id'          => 'map_key',
        'type'        => 'text',
        'desc'        => esc_html__('It may be necessary to register a Google API key in order to allow the Google Maps to load correctly. Please follow this link to <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">get a Google API key</a>', 'tempus'),
        'std'         => '',
        'class'       => '',
        'section'     => 'map'
      ),

      array(
        'label'       => esc_html__('Contacts Map address', 'tempus'),
        'id'          => 'map_address',
        'type'        => 'text',
        'desc'        => esc_html__('Example: 21 West St, New York, NY 10006', 'tempus'),
        'std'         => '',
        'class'       => '',
        'section'     => 'map'
      ),

      array(
        'label'       => esc_html__('Latitude (optional)', 'tempus'),
        'id'          => 'map_latitude',
        'type'        => 'text',
        'desc'        => esc_html__('Example: 40.7063666', 'tempus'),
        'std'         => '',
        'class'       => '',
        'section'     => 'map'
      ),

      array(
        'label'       => esc_html__('Longitude (optional)', 'tempus'),
        'id'          => 'map_longitude',
        'type'        => 'text',
        'desc'        => esc_html__('Example: -74.0156634', 'tempus'),
        'std'         => '',
        'class'       => '',
        'section'     => 'map'
      ),

      array(
        'id'          => 'custom_css',
        'label'       => esc_html__('Custom CSS', 'tempus'),
        'desc'        => esc_html__('To prevent problems with theme update write here custom CSS code', 'tempus'),
        'std'         => '',
        'type'        => 'css',
        'section'     => 'general',
        'rows'        => '',
        'class'       => ''
      ),

      array(
        'label'       => esc_html__('About Me style', 'tempus'),
        'id'          => 'about_style',
        'type'        => 'select',
        'desc'        => '',
        'choices'     => array(
          array('label'=> esc_html__('Text Right', 'tempus'),'value'=> 'text-right'),
          array('label'=> esc_html__('Text Left', 'tempus'),'value'=> 'text-left'),
      	  array('label'=> esc_html__('Text Center', 'tempus'),'value'=> 'text-center')
          ),
        'std'         => 'text-center',
        'class'       => '',
        'section'     => 'aboutme'
      ),

      array(
        'label'       => esc_html__('Color', 'tempus'),
        'id'          => 'about_color',
        'type'        => 'colorpicker',
        'desc'        => '',
        'class'       => '',
        'section'     => 'aboutme'
      ),

      array(
        'label'       => esc_html__('Overlay Color', 'tempus'),
        'id'          => 'about_color_overlay',
        'type'        => 'colorpicker-opacity',
        'desc'        => '',
        'class'       => '',
        'section'     => 'aboutme'
      ),

      array(
        'label'       => esc_html__('Title', 'tempus'),
        'id'          => 'about_title',
        'type'        => 'text',
        'desc'        => '',
        'class'       => '',
        'section'     => 'aboutme'
      ),

      array(
        'label'       => esc_html__('Text', 'tempus'),
        'id'          => 'about_text',
        'type'        => 'textarea-simple',
        'desc'        => '',
        'class'       => '',
        'section'     => 'aboutme'
      ),

      array(
        'label'       => esc_html__('Link URL', 'tempus'),
        'id'          => 'about_URL',
        'type'        => 'text',
        'desc'        => '',
        'class'       => '',
        'section'     => 'aboutme'
      ),

      array(
        'label'       => esc_html__('Link Text', 'tempus'),
        'id'          => 'about_URL_text',
        'type'        => 'text',
        'desc'        => '',
        'class'       => '',
        'section'     => 'aboutme'
      ),

      array(
        'label'       => esc_html__('Background Image', 'tempus'),
        'id'          => 'about_picture',
        'type'        => 'upload',
        'desc'        => '',
        'class'       => '',
        'section'     => 'aboutme'
      ),

      array(
        'id'          => 'google_fonts',
        'label'       => esc_html__('Google Fonts', 'tempus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'google-fonts',
        'section'     => 'typo',
        'class'       => '',
        'operator'    => 'and'
      ),

      array(
        'label'       => esc_html__('Body Font', 'tempus'),
        'id'          => 'body_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'class'       => '',
        'section'     => 'typo'
      ),

      array(
        'label'       => esc_html__('Menu Font', 'tempus'),
        'id'          => 'menu_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'class'       => '',
        'section'     => 'typo'
      ),

      array(
        'label'       => esc_html__('Logo Font', 'tempus'),
        'id'          => 'logo_font',
        'type'        => 'typography',
        'desc'        => '',
        'std'         => '',
        'class'       => '',
        'section'     => 'typo'
      ),

      array(
        'label'       => esc_html__('H1 Headers Font', 'tempus'),
        'id'          => 'h1_font',
        'type'        => 'typography',
        'std'         => '',
        'class'       => '',
        'section'     => 'typo'
      ),

      array(
        'label'       => esc_html__('H2 Headers Font', 'tempus'),
        'id'          => 'h2_font',
        'type'        => 'typography',
        'std'         => '',
        'class'       => '',
        'section'     => 'typo'
      ),

      array(
        'label'       => esc_html__('H3 Headers Font', 'tempus'),
        'id'          => 'h3_font',
        'type'        => 'typography',
        'std'         => '',
        'class'       => '',
        'section'     => 'typo'
      ),

      array(
        'label'       => esc_html__('H4 Headers Font', 'tempus'),
        'id'          => 'h4_font',
        'type'        => 'typography',
        'std'         => '',
        'class'       => '',
        'section'     => 'typo'
      ),

      array(
        'label'       => esc_html__('H5 Headers Font', 'tempus'),
        'id'          => 'h5_font',
        'type'        => 'typography',
        'std'         => '',
        'class'       => '',
        'section'     => 'typo'
      ),

      array(
        'label'       => esc_html__('H6 Headers Font', 'tempus'),
        'id'          => 'h6_font',
        'type'        => 'typography',
        'std'         => '',
        'class'       => '',
        'section'     => 'typo'
      )
    )
  );

	if ( $saved_settings !== $custom_settings ) {
	  update_option( 'option_tree_settings', $custom_settings );
	}

}
