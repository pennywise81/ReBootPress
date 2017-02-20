<?php

function headcontentmetabox_setup() {
  add_action('add_meta_boxes', 'headcontentmetabox_add');
  add_action('save_post', 'headcontentmetabox_save', 10, 2);
}

add_action('load-post.php', 'headcontentmetabox_setup');
add_action('load-post-new.php', 'headcontentmetabox_setup');

function headcontentmetabox_post($object, $box) {
  $editor_id = 'headcontentmetabox';
  $content = get_post_meta($object->ID, 'headcontentmetabox', true);
  wp_nonce_field(basename(__FILE__), 'headcontentmetabox_nonce');

  wp_editor(
    htmlspecialchars_decode($content),
    $editor_id . '_editor',
    array(
      'wpautop' => true, // true, false
      'media_buttons' => true, // true, false
      'textarea_name' => $editor_id, // $editor_id, STRING
      'editor_height' => 200, // INTEGER
      'tinymce' => true, // true, false
      'quicktags' => true, // true, false
      'drag_drop_upload' => true // false, true
    )
  );
  
}

function headcontentmetabox_save($post_id, $post) {
  if (!isset($_POST['headcontentmetabox_nonce']) ||
    !wp_verify_nonce($_POST['headcontentmetabox_nonce'], basename(__FILE__))
  )
    return $post_id;

  $post_type = get_post_type_object($post->post_type);

  if (!current_user_can($post_type->cap->edit_post, $post_id)) return $post_id;

  $new_meta_value = (isset($_POST['headcontentmetabox']) ? htmlspecialchars($_POST['headcontentmetabox']) : '');
  $meta_key = 'headcontentmetabox';
  $meta_value = get_post_meta($post_id, $meta_key, true);

  if ($new_meta_value && '' == $meta_value) add_post_meta($post_id, $meta_key, $new_meta_value, true);
  elseif ($new_meta_value && $new_meta_value != $meta_value) update_post_meta($post_id, $meta_key, $new_meta_value);
  elseif ('' == $new_meta_value && $meta_value) delete_post_meta($post_id, $meta_key, $meta_value);

  return $post_id;
}

function headcontentmetabox_add() {
  add_meta_box(
    'headcontentmetabox', // id
    __('Head Content', 'rebootpress'), // title
    'headcontentmetabox_post', // callback function
    'page', // where: post, page, custom post type
    'advanced', // position: normal, advanced, side
    'core' // priority: default, core, high, low
  );
}