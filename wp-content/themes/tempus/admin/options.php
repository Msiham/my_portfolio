<?php

function tempus_thumb_class($classes) {
  global $post;

  if (has_post_thumbnail($post->ID)) {
    $classes[] = "has-thumbnail";
  }
  return $classes;
}

add_filter('post_class','tempus_thumb_class');

// if ( !function_exists('tempus_AddThumbColumn') && function_exists('add_theme_support') ) {
//   add_theme_support('post-thumbnails', array( 'post', 'page' ) );
//
//   function tempus_AddThumbColumn($cols) {
//     $cols['thumbnail'] = esc_html__( 'Featured Image', 'tempus' );
//     return $cols;
//   }
//
//   function tempus_AddThumbValue( $column_name, $post_id ) {
//     $width = (int) 60;
//     $height = (int) 60;
//
//     if ( 'thumbnail' == $column_name ) {
//       $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
//       $image_data = wp_get_attachment_image_src( $thumbnail_id, "thumbnail" );
//       $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
//
//       if ($thumbnail_id && $image_data[1]) {
//         $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
//       } elseif ($attachments) {
//         foreach ( $attachments as $attachment_id => $attachment ) {
//           $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
//         }
//       }
//
//       if ( isset($thumb) && $thumb ) {
//         echo wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
//       } else {
//         echo esc_html__( 'None', 'tempus' );
//       }
//     }
//   }
//
//   add_filter( 'manage_posts_columns', 'tempus_AddThumbColumn' );
//   add_action( 'manage_posts_custom_column', 'tempus_AddThumbValue', 10, 2 );
//
//   add_filter( 'manage_pages_columns', 'tempus_AddThumbColumn' );
//   add_action( 'manage_pages_custom_column', 'tempus_AddThumbValue', 10, 2 );
// }

// function tempus_short_title( $after = '', $length ) {
// 	$mytitle = explode(' ', get_the_title(), $length);
// 	if ( count($mytitle) >= $length ) {
// 		array_pop($mytitle);
// 		$mytitle = implode(" ", $mytitle) . $after;
// 	} else {
// 		$mytitle = implode(" ", $mytitle);
// 	}
// 	return $mytitle;
// }

function tempus_add_nofollow_cat( $text ) {
  $strings = array('rel="category"', 'rel="category tag"', 'rel="whatever may need"');
  $text = str_replace('rel="category tag"', "", $text);
  return $text;
}

add_filter( 'the_category', 'tempus_add_nofollow_cat' );

function tempus_filter_next_post_link( $link ) {
  $link = str_replace("rel=", 'class="next" rel=', $link);
  return $link;
}

add_filter('next_post_link', 'tempus_filter_next_post_link');

function tempus_filter_previous_post_link( $link ) {
  $link = str_replace("rel=", 'class="prev" rel=', $link);
  return $link;
}

add_filter('previous_post_link', 'tempus_filter_previous_post_link'); ?>
