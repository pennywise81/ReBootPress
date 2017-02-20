<!--[if anybrowser]> START HEADER.PHP <![endif]-->
<!DOCTYPE html>
<html lang="en" class="<?php echo is_admin_bar_showing() ? 'admin-bar' : ''; ?>">
<head>
  <?php

  get_template_part('template-parts/tpl.metatags');
  get_template_part('template-parts/tpl.title');

  if (get_theme_mod('enable_css_caching') == 1) {
    echo '<style>';
    include_once 'above-fold.css';
    echo '</style>';
  }

  wp_head();

  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  ?>
</head>

<body <?php body_class([
  'sidebar-left',
  'sidebar-right',
  'fixed-footer',
  'fixed-navbar'
]); ?>>
<!-- END HEADER.PHP -->