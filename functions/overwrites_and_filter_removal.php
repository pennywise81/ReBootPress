<?php

/**
 * Overwrite standard styles of native gallery
 */
add_filter('gallery_style', create_function('$a', 'return "<div class=\'gallery\'>";'));

/**
 * Removes auto p's
 */
remove_filter('the_content', 'wpautop');
remove_filter('the_excerpt', 'wpautop');

/**
 * enables auto p's for certain post types
 */
function add_auto_p($content) {
  'post' === get_post_type() && add_filter('the_content', 'wpautop');
  return $content;
}

add_filter('the_content', 'add_auto_p', 0);

/**
 * removes REST api
 */
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);

/**
 * removes Weblog Client Link
 */
remove_action('wp_head', 'rsd_link');

/**
 * removes  Windows Live Writer Manifest Link
 */
remove_action('wp_head', 'wlwmanifest_link');

/**
 * removes WordPress Version info
 */
remove_action('wp_head', 'wp_generator');