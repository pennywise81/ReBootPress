<!-- START FOOTER.PHP -->
<?php

get_template_part('template-parts/tpl.footer_top');

if (is_active_sidebar('widgetsfooter')) {
  dynamic_sidebar('widgetsfooter');
} else {
  get_template_part('template-parts/tpl.footer_default');
}

get_template_part('template-parts/tpl.footer_bottom');

wp_footer();

?>
</body>
</html>
<!-- END FOOTER.PHP -->