<!-- START SIDEBAR-RIGHT.PHP -->
<?php

get_template_part('template-parts/tpl.sidebar_right_top');

if (is_active_sidebar('widgetsright')) {
  dynamic_sidebar('widgetsright');
}

get_template_part('template-parts/tpl.sidebar_right_bottom');

?>
<!-- END SIDEBAR-RIGHT.PHP -->