<?php

/**
 * registers the menu positions
 */
function menu_register() {
  register_nav_menus(
    array
    (
      'mainnavigation' => __('Main Navigation', 'rebootpress')
    )
  );
}

add_action('init', 'menu_register');