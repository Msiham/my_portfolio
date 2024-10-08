<?php
/**
 * Initialize the meta boxes.
 */
add_action( 'admin_init', 'tempus_custom_meta_boxes' );

function tempus_custom_meta_boxes() {

  $themeworm_slug = ( get_option('themeworm_slug') ) ?: 'portfolio-item';

  $tempus_meta_box = array(
    'id'        => 'tempus_metabox_sidebar',
    'title'     => esc_html__('Page Layout settings', 'tempus'),
    'desc'      => '',
    'pages'     => array( 'page', 'post' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
      	'label'       => esc_html__('Title', 'tempus'),
      	'id'          => 'tempus_page1',
      	'type'        => 'tab',
      	'desc'        => '',
      	'std'         => '',
      ),

      array(
      	'label'       => esc_html__('Show Title/Gallery', 'tempus'),
      	'id'          => 'tempus_display_title',
      	'type'        => 'on_off',
      	'desc'        => '',
      	'std'         => 'on',
      ),

      array(
      	'label'       => esc_html__('Title Video URL', 'tempus'),
      	'id'          => 'tempus_title_video',
      	'type'        => 'text',
      	'desc'        => '',
      	'std'         => '',
      ),

      array(
        'id'          => 'tempus_title_style',
        'label'       => esc_html__('Title align (Only in Title Position - Over)', 'tempus'),
        'desc'        => '',
        'std'         => 'titlestyle-left',
        'type'        => 'select',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'titlestyle-center',
            'label'   => esc_html__('Center', 'tempus'),
          ),
          array(
            'value'   => 'titlestyle-left',
            'label'   => esc_html__('Left', 'tempus'),
          ),
          array(
            'value'   => 'titlestyle-right',
            'label'   => esc_html__('Right', 'tempus'),
          ),
        )
      ),

      array(
        'id'          => 'tempus_title_position',
        'label'       => esc_html__('Title position', 'tempus'),
        'desc'        => '',
        'std'         => 'title-position-under',
        'type'        => 'select',
        'class'       => 'not-in-page',
        'choices'     => array(
          array(
            'value'   => 'title-position-under',
            'label'   => esc_html__('Under Image', 'tempus'),
          ),
          array(
            'value'   => 'title-position-over',
            'label'   => esc_html__('Over Image', 'tempus'),
          ),
        )
      ),

      array(
        'id'          => 'tempus_title_height',
        'label'       => esc_html__('Title height', 'tempus'),
        'desc'        => '',
        'std'         => 'titleheight-standard',
        'type'        => 'select',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'titleheight-standard',
            'label'   => esc_html__('Default', 'tempus'),
          ),
          array(
            'value'   => 'titleheight-30',
            'label'   => esc_html__('30%', 'tempus'),
          ),
          array(
            'value'   => 'titleheight-50',
            'label'   => esc_html__('50%', 'tempus'),
          ),
          array(
            'value'   => 'titleheight-80',
            'label'   => esc_html__('80%', 'tempus'),
          ),
          array(
            'value'   => 'titleheight-100',
            'label'   => esc_html__('100%', 'tempus'),
          ),
        )
      ),

      array(
    		'label'       => esc_html__('Title text', 'tempus'),
    		'id'          => 'tempus_title_text',
    		'type'        => 'text',
    		'desc'        => '',
    		'std'         => '',
      ),

      array(
    		'label'       => esc_html__('Subtitle text', 'tempus'),
    		'id'          => 'tempus_subtitle',
    		'type'        => 'textarea',
    		'desc'        => '',
    		'std'         => '',
      ),

      array(
    		'label'       => esc_html__('Title for Blog (Portfolio + Blog template only)', 'tempus'),
    		'id'          => 'tempus_portblog_title',
    		'type'        => 'text',
    		'desc'        => '',
    		'std'         => '',
      ),

      array(
    		'label'       => esc_html__('Button text', 'tempus'),
    		'id'          => 'tempus_subtitle_button',
    		'type'        => 'text',
    		'desc'        => '',
    		'std'         => esc_html__('Read More', 'tempus'),
      ),

      array(
    		'label'       => esc_html__('Button URL', 'tempus'),
    		'id'          => 'tempus_subtitle_url',
    		'type'        => 'text',
    		'desc'        => '',
    		'std'         => '',
      ),

      array(
    		'label'       => esc_html__('Title text color', 'tempus'),
    		'id'          => 'tempus_title_color',
    		'type'        => 'colorpicker',
    		'desc'        => '',
    		'std'         => '',
      ),

      array(
      	'label'       => esc_html__('About Me', 'tempus'),
      	'id'          => 'tempus_page2',
      	'type'        => 'tab',
      	'desc'        => '',
      	'std'         => '',
      ),

      array(
    		'label'       => esc_html__('Show About me section', 'tempus'),
    		'id'          => 'tempus_about_me',
    		'type'        => 'on_off',
    		'desc'        => '',
        'class'       => 'not-in-post',
    		'std'         => 'off',
      ),

    )
  );

  $meta_color = array(

    'id'        => 'tempus_portfolio_tax',
    'title'     => esc_html__('Color options', 'tempus'),
    'desc'      => '',
    'pages'     => array('page', 'post'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

  	  array(
        'label'       => esc_html__('Title Background Color', 'tempus'),
        'id'          => 'tempus_post_color',
        'type'        => 'colorpicker',
        'desc'        => '',
        'std'         => ''
      ),

  	  array(
        'label'       => esc_html__('Title Text Color', 'tempus'),
        'id'          => 'tempus_title_color',
        'type'        => 'colorpicker',
        'desc'        => '',
        'std'         => ''
      )
    )
  );

  $tempus_pf_options = array(
    'id'        => 'tempus_pf_options',
    'title'     => esc_html__('Portfolio Options', 'tempus'),
    'desc'      => '',
    'pages'     => array($themeworm_slug),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
      	'label'       => esc_html__('General Options', 'tempus'),
      	'id'          => 'tempus_spacer1',
      	'type'        => 'tab',
      	'desc'        => '',
      	'std'         => '',
      ),

      array(
        'label'       => esc_html__('Open in Lightbox', 'tempus'),
        'id'          => 'tempus_show_aslightbox',
        'type'        => 'on_off',
        'desc'        => 'Popup a lightbox after clicking on the Project',
        'std'         => 'off',
      ),

      array(
        'label'       => esc_html__('Show Featured Image', 'tempus'),
        'id'          => 'tempus_show_featured',
        'type'        => 'on_off',
        'desc'        => 'Inside the Project',
        'std'         => 'on',
      ),

      array(
        'label'       => esc_html__('Hover Image', 'tempus'),
        'id'          => 'tempus_hover_image',
        'type'        => 'upload',
        'desc'        => 'May affect page loading speed',
        'std'         => '',
      ),

      array(
        'id'          => 'tempus_video_link',
        'label'       => esc_html__('Video URL for Lightbox', 'tempus'),
        'desc'        => esc_html__('Youtube or Vimeo', 'tempus'),
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
      ),

      array(
        'id'          => 'tempus_selfvideo_link',
        'label'       => esc_html__('Selfhosted Video for Lightbox', 'tempus'),
        'desc'        => 'MP4 only',
        'std'         => '',
        'type'        => 'upload',
        'class'       => '',
      ),

      array(
        'id'          => 'tempus_customurl',
        'label'       => esc_html__('Custom URL', 'tempus'),
        'desc'        => esc_html__('URL for click on the Project', 'tempus'),
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
      ),

      array(
        'label'       => esc_html__('Video lightbox Ratio', 'tempus'),
        'id'          => 'tempus_current_video_ratio',
        'type'        => 'select',
        'desc'        => esc_html__('Video Aspect Ratio for Current Lightbox', 'tempus'),
        'choices'     => array(
          array('label'=> esc_html__('Not Set', 'tempus'),'value'=> 'none'),
          array('label'=> esc_html__('4:3', 'tempus'),'value'=> '1.33333'),
          array('label'=> esc_html__('16:9', 'tempus'),'value'=> '1.77777'),
          array('label'=> esc_html__('1.85:1', 'tempus'),'value'=> '1.85'),
          array('label'=> esc_html__('2:1', 'tempus'),'value'=> '2'),
          array('label'=> esc_html__('2.35:1', 'tempus'),'value'=> '2.35'),
          array('label'=> esc_html__('1:1', 'tempus'),'value'=> '1'),
          array('label'=> esc_html__('9:16 - vertical', 'tempus'),'value'=> '0.5625'),
        ),
        'std'         => 'none',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',

      ),

      array(
        'label'       => esc_html__('Show Info Button', 'tempus'),
        'id'          => 'tempus_show_infobutton',
        'type'        => 'on_off',
        'desc'        => 'Must be turned on in Theme Options > Portfolio',
        'std'         => 'off',
      ),

      array(
      	'label'       => esc_html__('Show Title', 'tempus'),
      	'id'          => 'tempus_portfolio_title',
      	'type'        => 'on_off',
      	'desc'        => 'Inside the Project',
      	'std'         => 'on',
      ),

      array(
        'id'          => 'tempus_title_style',
        'label'       => esc_html__('Title align', 'tempus'),
        'desc'        => '',
        'std'         => 'titlestyle-left',
        'type'        => 'select',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'titlestyle-center',
            'label'   => esc_html__('Center', 'tempus'),
          ),
          array(
            'value'   => 'titlestyle-left',
            'label'   => esc_html__('Left', 'tempus'),
          ),
          array(
            'value'   => 'titlestyle-right',
            'label'   => esc_html__('Right', 'tempus'),
          ),
        )
      ),

      array(
        'id'          => 'tempus_portfolio_subtitle',
        'label'       => esc_html__('Subtitle or Photo/Video lightbox Caption', 'tempus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
      ),

      array(
    		'label'       => esc_html__('Title text color', 'tempus'),
    		'id'          => 'tempus_title_color',
    		'type'        => 'colorpicker',
    		'desc'        => '',
    		'std'         => '',
      ),

      array(
        'id'          => 'tempus_preview_size',
        'label'       => esc_html__('Packery Portfolio Item Size', 'tempus'),
        'desc'        => esc_html__('Only for Packery Portfolio template', 'tempus'),
        'std'         => 'size-1x1',
        'type'        => 'select',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'size-1x1',
            'label'   => esc_html__('Default', 'tempus'),
          ),
          array(
            'value'   => 'size-2x1',
            'label'   => esc_html__('2x1', 'tempus'),
          ),
          array(
            'value'   => 'size-2x2',
            'label'   => esc_html__('2x2', 'tempus'),
          ),
          array(
            'value'   => 'size-1x2',
            'label'   => esc_html__('1x2', 'tempus'),
          ),
        )
      ),

      array(
      	'label'       => esc_html__('Show as Smart Gallery', 'tempus'),
      	'id'          => 'tempus_featured_gallery',
      	'type'        => 'on_off',
      	'desc'        => 'Only for 2 and 3 column templates',
      	'std'         => 'off',
      ),

      array(
        'id'          => 'tempus_featured_gallery_style',
        'label'       => esc_html__('Smart Gallery style', 'tempus'),
        'desc'        => '',
        'std'         => 'style-3x3',
        'type'        => 'select',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'style-3x3',
            'label'   => esc_html__('3x3', 'tempus'),
          ),
          array(
            'value'   => 'tiled',
            'label'   => esc_html__('Tiled', 'tempus'),
          )
        )
      ),

      array(
        'id'          => 'tempus_portfolio_color',
        'label'       => esc_html__('Color for Pointy Slider', 'tempus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'class'       => '',
      ),

      array(
      	'label'       => esc_html__('Categories of Recent projects', 'tempus'),
      	'id'          => 'tempus_spacer3',
      	'type'        => 'tab',
      	'desc'        => '',
      	'std'         => '',
      ),

      array(
        'label' => esc_html__('Select categories of Recent projects to display on this page', 'tempus'),
        'id' => 'tempus_recent_filters',
        'type' => 'taxonomy-checkbox',
        'desc' => esc_html__('Dispays all categories if not selected.', 'tempus'),
        'std' => '',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => 'filters',
        'class' => 'filters-checbox'
      ),

    )
  );

  $tempus_video_box = array(
    'id'        => 'tempus_metabox_video',
    'title'     => esc_html__('Post video link', 'tempus'),
    'desc'      => '',
    'pages'     => array( 'post' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

	    array(
        'id'          => 'tempus_video_link',
        'label'       => esc_html__('Link to video (Youtube or Vimeo)', 'tempus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
      ),

      array(
        'label'       => esc_html__('Self Hosted Video ', 'tempus'),
        'id'          => 'tempus_video_upload',
        'type'        => 'upload',
        'desc'        => '',
        'std'         => '',
        'taxonomy'    => '',
        'class'       => '',
      )
    )
  );

  $tempus_slider_box = array(
    'id'        => 'tempus_metabox_slider',
    'title'     => esc_html__('Portfolio page Slider options', 'tempus'),
    'desc'      => '',
    'pages'     => array( $themeworm_slug ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
        'label' => esc_html__('Show in Slider', 'tempus'),
        'id' => 'tempus_in_slider',
        'type'        => 'on_off',
        'desc'        => '',
        'std'         => 'off',
      ),

      array(
        'label' => esc_html__('Choose Slider page', 'tempus'),
        'id' => 'tempus_page_slider',
        'type'        => 'page-select',
        'desc'        => '',
        'std'         => '',
      ),

      array(
        'id'          => 'tempus_slider_type',
        'label'       => esc_html__('Type of slide', 'tempus'),
        'desc'        => '',
        'std'         => 'cd-full-width',
        'type'        => 'select',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'cd-full-width',
            'label'   => esc_html__('Text in center', 'tempus'),
          ),
          array(
            'value'   => 'cd-half-width',
            'label'   => esc_html__('Text in left half', 'tempus'),
          ),
          array(
            'value'   => 'cd-bg-video',
            'label'   => esc_html__('Video', 'tempus'),
          ),
        )
      ),

  	  array(
        'id'          => 'tempus_slider_text',
        'label'       => esc_html__('Short text to show in slider', 'tempus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
      ),

      array(
        'id'          => 'tempus_slider_image',
        'label'       => esc_html__('Custom image/video for slider', 'tempus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'upload',
        'class'       => '',
      ),

      array(
        'id'          => 'tempus_slider_button1',
        'label'       => esc_html__('Button 1 text', 'tempus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
      ),

      array(
        'id'          => 'tempus_slider_button1url',
        'label'       => esc_html__('Button 1 URL', 'tempus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
      ),

      array(
        'id'          => 'tempus_slider_button2',
        'label'       => esc_html__('Button 2 text', 'tempus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
      ),

      array(
        'id'          => 'tempus_slider_button2url',
        'label'       => esc_html__('Button 2 URL', 'tempus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
      )
    )
  );

  $tempus_gallery = array(
    'id'        => 'tempus_gallery_options',
    'title'     => esc_html__('Gallery & image options', 'tempus'),
    'desc'      => '',
    'pages'     => array($themeworm_slug, 'post'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
      	'label'       => esc_html__('Gallery', 'tempus'),
      	'id'          => 'tempus_gallery1',
      	'type'        => 'tab',
      	'desc'        => ''
      ),

      array(
        'id'          => 'tempus_gallery_layout',
        'label'       => esc_html__('Primary Gallery style', 'tempus'),
        'desc'        => '',
        'std'         => 'slider-gallery',
        'type'        => 'radio-image',
        'class'       => 'not-in-post',
        'choices'     => array(
          array(
            'value'   => 'slider-gallery',
            'label'   => esc_html__('Slider', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/slider-gallery.png'
          ),
          array(
            'value'   => 'tiled-gallery',
            'label'   => esc_html__('Tiled', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/tiled-gallery.png'
          ),
          array(
            'value'   => 'masonry-gallery',
            'label'   => esc_html__('Masonry 4 columns', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/masonry-gallery.png'
          ),
          array(
            'value'   => 'masonry-gallery3',
            'label'   => esc_html__('Masonry 3 columns', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/masonry-gallery3.png'
          ),
          array(
            'value'   => 'classic-gallery',
            'label'   => esc_html__('Classic 6 columns', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/classic-gallery.png'
          ),
          array(
            'value'   => 'classic-gallery4',
            'label'   => esc_html__('Classic 4 columns', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/classic-gallery4.png'
          ),
          array(
            'value'   => 'classic-gallery3',
            'label'   => esc_html__('Classic 3 columns', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/classic-gallery3.png'
          ),
          array(
            'value'   => 'classic-gallery1',
            'label'   => esc_html__('1 column', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/classic-gallery1.png'
          ),
          array(
            'value'   => 'half-gallery-left',
            'label'   => esc_html__('Half column & Text', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/half-gallery-left.png'
          ),
          array(
            'value'   => 'half-gallery-right',
            'label'   => esc_html__('Text left & Half column', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/half-gallery-right.png'
          ),
        )
      ),

      array(
        'id'          => 'tempus_post_primarygallery_layout',
        'label'       => esc_html__('Post Primary Gallery style', 'tempus'),
        'desc'        => '',
        'std'         => 'slider-gallery',
        'type'        => 'radio-image',
        'class'       => 'not-in-portfolio',
        'choices'     => array(
          array(
            'value'   => 'slider-gallery',
            'label'   => esc_html__('Slider', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/slider-gallery.png'
          ),
          array(
            'value'   => 'tiled-gallery',
            'label'   => esc_html__('Tiled', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/tiled-gallery.png'
          ),
          array(
            'value'   => 'masonry-gallery',
            'label'   => esc_html__('Masonry 4 columns', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/masonry-gallery.png'
          ),
          array(
            'value'   => 'masonry-gallery3',
            'label'   => esc_html__('Masonry 3 columns', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/masonry-gallery3.png'
          ),
          array(
            'value'   => 'classic-gallery',
            'label'   => esc_html__('Classic 6 columns', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/classic-gallery.png'
          ),
          array(
            'value'   => 'classic-gallery4',
            'label'   => esc_html__('Classic 4 columns', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/classic-gallery4.png'
          ),
          array(
            'value'   => 'classic-gallery3',
            'label'   => esc_html__('Classic 3 columns', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/classic-gallery3.png'
          ),
          array(
            'value'   => 'classic-gallery1',
            'label'   => esc_html__('1 column', 'tempus'),
            'src'     => get_template_directory_uri() . '/assets/images/options/classic-gallery1.png'
          ),
        )
      ),

      array(
        'id'          => 'tempus_gallery_fullwidth',
        'label'       => esc_html__('Gallery/Video Fullwidth', 'tempus'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on_off',
        'class'       => ''
      ),

      array(
        'label' => esc_html__('Primary Gallery images', 'tempus'),
        'id' => 'tempus_gallery_slider',
        'type' => 'gallery',
        'desc' => '',
        'post_type' => 'post'
      ),

      array(
        'id'          => 'tempus_portfolio_video',
        'label'       => esc_html__('Video URL for Header', 'tempus'),
        'desc'        => esc_html__('Youtube or Vimeo', 'tempus'),
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
      ),

      array(
        'id'          => 'tempus_video_gallery',
        'label'       => esc_html__('Displaying Video and Gallery', 'tempus'),
        'desc'        => '',
        'std'         => 'video-image',
        'type'        => 'radio',
        'choices'     => array(
          array(
            'value'   => 'image-only',
            'label'   => esc_html__('Image gallery only', 'tempus')
          ),
          array(
            'value'   => 'video-only',
            'label'   => esc_html__('Video only', 'tempus')
          ),
          array(
            'value'   => 'video-image',
            'label'   => esc_html__('Both - video and image gallery', 'tempus')
          )
        )
      ),

      array(
        'id'          => 'tempus_content_order',
        'label'       => esc_html__('Editor Content Order', 'tempus'),
        'desc'        => '',
        'std'         => 'images-content',
        'type'        => 'radio',
        'choices'     => array(
          array(
            'value'   => 'images-content',
            'label'   => esc_html__('Video - Image gallery - Content', 'tempus')
          ),
          array(
            'value'   => 'content-images',
            'label'   => esc_html__('Video - Content - Image gallery', 'tempus')
          )
        )
      ),

      array(
        'id'          => 'tempus_hide_content',
        'label'       => esc_html__('Hide Editor Content', 'tempus'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on_off',
        'class'       => ''
      ),

      array(
        'id'          => 'tempus_post_gallery_layout',
        'label'       => esc_html__('Secondary Gallery style', 'tempus'),
        'desc'        => '',
        'std'         => 'classic-gallery',
        'type'        => 'radio',
        'class'       => 'not-in-portfolio',
        'choices'     => array(
          array(
            'value'   => 'classic-gallery',
            'label'   => esc_html__('Classic', 'tempus')
          ),
          array(
            'value'   => 'masonry-gallery',
            'label'   => esc_html__('Masonry', 'tempus')
          )
        )
      ),

      array(
        'label' => esc_html__('Secondary Gallery images', 'tempus'),
        'id' => 'tempus_post_gallery_images',
        'type' => 'gallery',
        'desc' => '',
        'class'       => 'not-in-portfolio',
        'post_type' => 'post'
      )
    )
  );

  $recent_pf_options = array(
    'id'        => 'tempus_recent_pf_options',
    'title'     => esc_html__('Categories to Show', 'tempus'),
    'desc'      => '',
    'pages'     => array('page'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
        'label' => esc_html__('Recent Works section settings', 'tempus'),
        'id' => 'tempus_recent_pofrfolio_textblock',
        'type' => 'textblock',
        'desc' => esc_html__('Under the portfolio post content you can see "Recent Works" section, by default displays 4 latest portfolio posts, here you can configure it to show selected items or filters.', 'tempus'),
        'post_type' => 'post',
      ),

      array(
        'label' => esc_html__('Categories to display', 'tempus'),
        'id' => 'tempus_category_filter',
        'type' => 'category-checkbox'
      )
    )
  );

  $tempus_filters = array(
    'id'        => 'tempus_portfolio_tax',
    'title'     => esc_html__('Portfolio page & Slider options', 'tempus'),
    'desc'      => '',
    'pages'     => array('page'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
      	'label'       => esc_html__('Portfolio Style', 'tempus'),
      	'id'          => 'tempus_portfolio1',
      	'type'        => 'tab',
      	'desc'        => '',
      	'std'         => '',
      ),

      array(
        'id'          => 'tempus_portfolio_fullwidth',
        'label'       => esc_html__('Full width portfolio page', 'tempus'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on_off',
        'class'       => ''
      ),

      array(
        'id'          => 'tempus_content_position',
        'label'       => esc_html__('Editor Content Position', 'tempus'),
        'desc'        => '',
        'std'         => 'before_portfolio',
        'type'        => 'select',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'before_portfolio',
            'label'   => esc_html__('Before Portfolio', 'tempus')
          ),
          array(
            'value'   => 'after_portfolio',
            'label'   => esc_html__('After Portfolio', 'tempus')
          ),
        )
      ),

      array(
        'id'          => 'tempus_portfolio_ratio',
        'label'       => esc_html__('Portfolio Aspect Ratio', 'tempus'),
        'desc'        => '',
        'std'         => 'default',
        'type'        => 'select',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'default',
            'label'   => esc_html__('Default', 'tempus')
          ),
          array(
            'value'   => '1.777',
            'label'   => esc_html__('16:9', 'tempus')
          ),
          array(
            'value'   => '2.39',
            'label'   => esc_html__('2.39:1', 'tempus')
          ),
          array(
            'value'   => '1.85',
            'label'   => esc_html__('1.85:1', 'tempus')
          ),
        )
      ),

      array(
        'id'          => 'tempus_tilt_style',
        'label'       => esc_html__('Potrfolio Tilter template style', 'tempus'),
        'desc'        => '',
        'std'         => 'tilt-vertical',
        'type'        => 'select',
        'class'       => '',
        'choices'     => array(
          array(
            'value'   => 'tilt-vertical',
            'label'   => esc_html__('Vertical', 'tempus')
          ),
          array(
            'value'   => 'tilt-horizontal',
            'label'   => esc_html__('Horizontal', 'tempus')
          ),
          array(
            'value'   => 'tilt-full',
            'label'   => esc_html__('Real proportions', 'tempus')
          ),
        )
      ),

      array(
        'id'          => 'tempus_portfolio_menucolor',
        'label'       => esc_html__('Menu color', 'tempus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'class'       => ''
      ),

      array(
        'id'          => 'tempus_portfolio_logocolor',
        'label'       => esc_html__('Logo color', 'tempus'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'colorpicker',
        'class'       => ''
      ),

      array(
      	'label'       => esc_html__('Categories to display', 'tempus'),
      	'id'          => 'tempus_portfolio2',
      	'type'        => 'tab',
      	'desc'        => '',
      	'std'         => '',
      ),

      array(
        'label' => esc_html__('Select portfolio categories to display on this page', 'tempus'),
        'id' => 'tempus_portfolio_filters',
        'type' => 'taxonomy-checkbox',
        'desc' => esc_html__('Dispays all categories if not selected.', 'tempus'),
        'std' => '',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => 'filters',
        'class' => 'filters-checbox'
      ),

      array(
        'id'          => 'tempus_filters_on',
        'label'       => esc_html__('Show filters', 'tempus'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on_off',
        'class'       => ''
      ),

      array(
      	'label'       => esc_html__('Slider Options', 'tempus'),
      	'id'          => 'tempus_portfolio3',
      	'type'        => 'tab',
      	'desc'        => '',
      	'std'         => '',
      ),

      array(
        'id'          => 'tempus_slider_images',
        'label'       => esc_html__( 'Slider Gallery', 'tempus' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'list-item',
        'operator'    => 'and',
        'settings'    => array(
          array(
            'id'          => 'tempus_slider_images_image',
            'label'       => esc_html__( 'Image', 'tempus' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'upload',
          ),
          array(
            'id'          => 'tempus_slider_images_subtitle',
            'label'       => esc_html__( 'Subtitle', 'tempus' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
          ),
          array(
            'id'          => 'tempus_slider_images_url',
            'label'       => esc_html__( 'Custom URL', 'tempus' ),
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
          )
        )
      ),

      array(
        'id'          => 'tempus_slider_count',
        'label'       => esc_html__('Slider images count (if Latest Projects)', 'tempus'),
        'desc'        => '',
        'std'         => '4',
        'type'        => 'select',
        'choices'     => array(
          array(
            'value'   => '3',
            'label'   => esc_html__('3', 'tempus')
          ),
          array(
            'value'   => '4',
            'label'   => esc_html__('4', 'tempus')
          ),
          array(
            'value'   => '5',
            'label'   => esc_html__('5', 'tempus')
          ),
          array(
            'value'   => '6',
            'label'   => esc_html__('6', 'tempus')
          ),
          array(
            'value'   => '8',
            'label'   => esc_html__('8', 'tempus')
          ),
        )
      ),
    )
  );

  if ( function_exists('ot_register_meta_box') ) {
    ot_register_meta_box( $tempus_meta_box );
    ot_register_meta_box( $tempus_filters );
    ot_register_meta_box( $tempus_pf_options );
    ot_register_meta_box( $tempus_gallery );
    ot_register_meta_box( $tempus_video_box );
  }

}
