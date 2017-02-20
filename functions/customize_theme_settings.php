<?php

function customize_theme_settings($wp_customize) {
  /**
   * Creates the section "Theme Settings"
   */
  $wp_customize->add_section('rebootpress_theme_settings', array(
    'title' => __('Theme Settings', 'rebootpress'),
    'priority' => 10,
    'description' => __('Basic Settings for the ReBootPress Theme', 'rebootpress')
  ));

  /**
   * Creates the setting "enable_css_caching"
   */
  $wp_customize->add_setting('enable_css_caching', array(
    'default' => true
  ));

  /**
   * Creates a control for "enable_css_caching"
   */
  $wp_customize->add_control('your_control_id', array(
    'label' => __('Enable CSS Caching', 'rebootpress'),
    'description' => __('Caches CSS for 5 hours and enables "Above-the-Fold" CSS', 'rebootpress'),
    'section' => 'rebootpress_theme_settings',
    'settings' => 'enable_css_caching',
    'type' => 'radio',
    'choices' => array(
      true => __('enable', 'rebootpress'),
      false => __('disable', 'rebootpress'),
    )
  ));
}

add_action('customize_register', 'customize_theme_settings', 0);