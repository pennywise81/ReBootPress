<!-- START TPL.NAVBAR.PHP -->
<?php

get_template_part('template-parts/tpl.navbar_top');

wp_nav_menu(array(
  'container' => false,
  'items_wrap' => '<ul class="%2$s">%3$s</ul>',
  'menu_class' => 'nav navbar-nav',
  'theme_location' => 'mainnavigation'
));

get_template_part('template-parts/tpl.navbar_bottom');

?>
<!-- END TPL.NAVBAR.PHP -->