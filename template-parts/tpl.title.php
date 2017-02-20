<!-- START TPL.TITLE.PHP -->
<title><?php

  if (is_front_page() && get_bloginfo('description') != '') {
    echo get_bloginfo('description') . ' | ';
  } else {
    wp_title('|', true, 'right');
  }

  bloginfo('name');

  ?>
</title>
<!-- END TPL.TITLE.PHP -->