<!-- START SIDEBAR-LEFT.PHP -->
<?php

get_template_part('template-parts/tpl.sidebar_left_top');

if (is_active_sidebar('widgetsleft')) {
  dynamic_sidebar('widgetsleft');
}

get_template_part('template-parts/tpl.sidebar_left_bottom');

?>
<!-- END SIDEBAR-LEFT.PHP -->