<?php

/**
 * adds 'nav-link' css-class to menu anchors
 *
 * @param $ulclass
 * @return mixed
 */
function add_class_to_menu_a($ulclass) {
  return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
}

add_filter('wp_nav_menu', 'add_class_to_menu_a');