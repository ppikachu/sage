<?php
/**
 * Clean up gallery_shortcode()
 *
 * Re-create the [gallery] shortcode and use thumbnails styling from Bootstrap
 * The number of columns must be a factor of 12.
 *
 * @link http://getbootstrap.com/components/#thumbnails
 */

//galeria slick
function roots_gallery_st($attr) {
  $post = get_post();

  static $instance = 0;
  $instance++;

  if (!empty($attr['ids'])) {
    if (empty($attr['orderby'])) {
      $attr['orderby'] = 'post__in';
    }
    $attr['include'] = $attr['ids'];
  }

  $output = apply_filters('post_gallery', '', $attr);

  if ($output != '') {
    return $output;
  }

  if (isset($attr['orderby'])) {
    $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
    if (!$attr['orderby']) {
      unset($attr['orderby']);
    }
  }

  extract(shortcode_atts(array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => '',
    'icontag'    => '',
    'captiontag' => '',
    'columns'    => 4,
    'size'       => 'thumbnail',
    'include'    => '',
    'exclude'    => '',
    'link'       => ''
  ), $attr));

  $id = intval($id);
  $grid = 'item';

  if ($order === 'RAND') {
    $orderby = 'none';
  }

  if (!empty($include)) {
    $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

    $attachments = array();
    foreach ($_attachments as $key => $val) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif (!empty($exclude)) {
    $attachments = get_children(array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  } else {
    $attachments = get_children(array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));
  }

  if (empty($attachments)) {
    return '';
  }

  $unique = (get_query_var('page')) ? $instance . '-p' . get_query_var('page'): $instance;
  $output = '<div id="slick">';

  $i = 0;
  foreach ($attachments as $id => $attachment) {
    if ($i == 0) $grid.=" itemx2"; else $grid="item"; //agranda la primer foto
    $attachment_medium = wp_get_attachment_image_src( $id, $size='large' );
    $output .= '<div><img src="'.$attachment_medium[0].'" class="img-fluid"></div>';
    // if (trim($attachment->post_excerpt)) {
    //   $output .= '<div class="caption hidden-xs">' . wptexturize($attachment->post_excerpt) . '</div>';
    // }
    $i++;
  }

  $output .= '</div>';
  return $output;
}

  remove_shortcode('gallery');
  add_shortcode('gallery', 'roots_gallery_st');
  add_filter('use_default_gallery_style', '__return_null');

/**
 * Add class="thumbnail img-thumbnail" to attachment items
 */
function roots_attachment_link_class($html) {
  $postid = get_the_ID();
  $html = str_replace('<a', '<a class="itempack thumbnail img-thumbnail"', $html);
  return $html;
}
add_filter('wp_get_attachment_link', 'roots_attachment_link_class', 10, 1);
