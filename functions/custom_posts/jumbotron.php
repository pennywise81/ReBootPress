<?php

new CustomPostType(
  'Jumbotrons',
  'Jumbotron',
  'jumbotron',
  array('title')
);

new CustomMetaBox(
  'jumbotron_content',
  __('Content', 'rebootpress'),
  function ($object) {
    $field1 = new CustomMetaBoxField('jumbotron_tmp', __('Lead Content', 'rebootpress'), $object);
    $field1->displayAdministration();
  },
  'jumbotron',
  'advanced',
  'default',
  array($object)
);

// @todo: REFACTOR BELOW THIS POINT

/**
 * Shortcode for Jumbotrons
 */
function get_jumbotron($attrs) {
  extract(
    shortcode_atts(array(
      'id' => 0
    ), $attrs));

  $item = get_post($id);

  return '
    <div class="jumbotron">
      <h1 class="display-3">' . $item->post_title . '</h1>
      ' . $item->post_content . '
    </div>
  ';
}

add_shortcode('jumbotron', 'get_jumbotron');

/**
 * Adds custom column for Jumbotrons
 */
function jumbotron_columns($columns) {
  $columns['shortcode'] = __('Shortcode', 'rebootpress');
  return $columns;
}

add_filter('manage_edit-jumbotron_columns', 'jumbotron_columns');

/**
 * Shows the content for custom Jumbotron column 'shortcode'
 */
function add_jumbotron_column($name) {
  global $post;

  switch ($name) {
    case 'shortcode':
      echo '[jumbotron id=' . $post->ID . ']';
  }
}

add_action('manage_jumbotron_posts_custom_column', 'add_jumbotron_column');