<?php

/**
 * adds 'active' css-class to current menu point
 *
 * @param array $classes
 * @param bool $menu_item
 * @return array
 */
function add_active_class_to_current_menu_li($classes = array(), $menu_item = false) {
  $classes[] = "nav-item";

  if (in_array('current-menu-item', $menu_item->classes)) {
    $classes[] = 'active';
  }

  return $classes;
}

add_filter('nav_menu_css_class', 'add_active_class_to_current_menu_li', 10, 2);