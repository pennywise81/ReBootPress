<?php
if (current_user_can('edit_theme_options')) {
  ?>
  <!-- START TPL.BTN_EDIT-MENU.PHP -->
  <a class="btn btn-sm btn-info pull-md-right btn-edit"
     href="/wp-admin/nav-menus.php" title="<?php _e('Edit menu', 'rebootstrap'); ?>">
    <i class="fa fa-pencil" aria-hidden="true"></i>
    <span><?php _e('Edit menu', 'rebootstrap'); ?></span>
  </a>
  <!-- END TPL.BTN_EDIT-MENU.PHP -->
  <?php
}