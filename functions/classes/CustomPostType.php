<?php

class CustomPostType {
  private $slug;
  private $name;
  private $name_singular;
  private $text_domain;
  private $supported_fields;

  function __construct(
    $name,
    $name_singular,
    $slug,
    $supported_fields = array(
      'title',
      'editor',
      'author',
      'thumbnail',
      'excerpt',
      'comments',
      'custom-fields'
    ),
    $text_domain = 'default'
  ) {
    $this->name = $name;
    $this->name_singular = $name_singular;
    $this->supported_fields = $supported_fields;
    $this->text_domain = $text_domain;
    $this->slug = $slug;

    $this->register();
  }

  private function register() {
    add_action('init', function() {
      $labels = array(
        'name' => _x($this->name, 'post type general name', $this->text_domain),
        'singular_name' => _x($this->name_singular, 'post type singular name', $this->text_domain),
        'menu_name' => _x($this->name, 'admin menu', $this->text_domain),
        'name_admin_bar' => _x($this->name_singular, 'add new on admin bar', $this->text_domain),
        'add_new' => _x('Add new ' . $this->name_singular, 'book', $this->text_domain),
        'add_new_item' => __('Add new ' . $this->name_singular, $this->text_domain),
        'new_item' => __('New ' . $this->name_singular, $this->text_domain),
        'edit_item' => __('Edit ' . $this->name_singular, $this->text_domain),
        'view_item' => __('View ' . $this->name_singular, $this->text_domain),
        'all_items' => __('All ' . $this->name, $this->text_domain),
        'search_items' => __('Search ' . $this->name, $this->text_domain),
        'parent_item_colon' => __('Parent ' . $this->name . ':', $this->text_domain),
        'not_found' => __('No ' . $this->name . ' found.', $this->text_domain),
        'not_found_in_trash' => __('No ' . $this->name . ' found in Trash.', $this->text_domain)
      );

      $args = array(
        'labels' => $labels,
        'public' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'show_ui' => true,
        'show_in_nav_menus' => false,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 20,
        'menu_icon' => null,
        'hierarchical' => false,
        'supports' => $this->supported_fields,
        'query_var' => true,
        'rewrite' => array(
          'slug' => $this->slug,
          'with_front' => 'false'
        ),
        'capability_type' => 'post',
        'has_archive' => false,
      );

      register_post_type($this->slug, $args);
    });
  }
}