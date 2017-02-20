<?php

/**
 * registers the theme's widget sections
 */
function register_widget_sections() {
  register_sidebar(array(
    'name' => __('Widget section one', 'rebootpress'),
    'id' => 'widgetsleft',
    'description' => __('left hand sidebar', 'rebootpress'),
    'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'name' => __('Widget section two', 'rebootpress'),
    'id' => 'widgetsright',
    'description' => __('right hand sidebar (bottom on small screens)', 'rebootpress'),
    'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'name' => __('Widget section three', 'rebootpress'),
    'id' => 'widgetsfooter',
    'description' => __('Widgets in the footer', 'rebootpress'),
    'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4>',
    'after_title' => '</h4>',
  ));
}

add_action('widgets_init', 'register_widget_sections');