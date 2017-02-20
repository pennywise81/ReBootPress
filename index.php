<!--[if anybrowser]> START INDEX.PHP <![endif]-->
<?php get_header(); ?>
<?php get_template_part('template-parts/tpl.navbar'); ?>

<?php

$headcontent = get_post_meta(get_the_ID(), 'headcontentmetabox', true);

if ($headcontent != '') {
  ?>

  <div class="head-content">
    <?php echo htmlspecialchars_decode($headcontent); ?>
  </div>

  <?php
}

?>

<div class="container-fluid container-fluid-limited page-content">
  <div class="row">

    <?php if (is_active_sidebar('widgetsright')) { ?>
    <div class="col-xs-12 col-sm-12 col-md-9 col-lg-10 col-xl-10">
    <?php } else { ?>
    <div class="col-xs-12">
    <?php } ?>
      <div class="row row-offcanvas row-offcanvas-left">

        <?php if (is_active_sidebar('widgetsleft')) { ?>
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 col-xl-2 sidebar-offcanvas">
          <?php get_sidebar('left') ?>
        </div>
        <?php } ?>

        <?php if (is_active_sidebar('widgetsleft')) { ?>
        <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10 col-xl-10">
        <?php } else { ?>
        <div class="col-xs-12">
        <?php } ?>

          <div class="content">
            <?php

            get_template_part('template-parts/tpl.btn_toggle_offcanvas_left');
            get_template_part('template-parts/tpl.loop');

            ?>
          </div>
        </div>

      </div>
    </div>
    <?php if (is_active_sidebar('widgetsright')) { ?>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-2 col-xl-2">
      hallo
      <?php get_sidebar('right') ?>
    </div>
    <?php } ?>

  </div>
</div>

<?php get_footer(); ?>
<!-- END INDEX.PHP -->