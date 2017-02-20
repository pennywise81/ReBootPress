<?php

/**
 * enqueues scripts and stylesheets
 */
function enqueues() {
  // Basic Stylesheet
  wp_register_style(
    'basic-style',
    get_template_directory_uri() . '/style.css',
    array(),
    '1.0.0',
    'screen'
  );
  wp_enqueue_style('basic-style');

  wp_deregister_script('jquery');
  wp_register_script('jquery', includes_url('/js/jquery/jquery.js'), false, NULL, true);
  wp_enqueue_script('jquery');

  // init
  wp_enqueue_script(
    'init',
    get_stylesheet_directory_uri() . '/javascript/all.min.js',
    array('jquery'),
    '1.0.0',
    true
  );
}

add_action('wp_enqueue_scripts', 'enqueues');

/**
 * defers all the js-scripts
 */
function defer_parsing_of_js($url) {
  if (FALSE === strpos($url, '.js'))
    return $url;

  if (strpos($url, 'jquery.js'))
    return $url;

  return "$url' defer onload='";
}

add_filter('clean_url', 'defer_parsing_of_js', 11, 1);