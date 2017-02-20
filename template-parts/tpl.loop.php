<!-- START TPL.LOOP.PHP -->
<?php

if (have_posts()) {
  while (have_posts()) {
    the_post();
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <div class="post-title">
        <?php the_title(sprintf('<h2><a href="%s">', esc_url(get_permalink())), '</a></h2>'); ?>
      </div>

      <div class="post-meta">
        <?php _e('Written by', 'rebootpress'); ?>
        <?php the_author('display_name'); ?>
        <?php _e('on', 'rebootpress'); ?>
        <?php the_time(get_option('date_format')); ?>
        <?php _e('in', 'rebootpress'); ?>
        <?php the_category(', ') ?>
        <?php edit_post_link(__('Edit post', 'rebootpress'), '<nobr>[', ']</nobr>'); ?>
      </div>

      <div class="post-content">
        <?php the_content(); ?>
      </div>

      <div class="post-comments">
        <?php if (comments_open() || get_comments_number()) comments_template(); ?>
      </div>

    </article>

    <?php
  }
} else {
  _e('Nothing found.', 'rebootstrap');
}

?>
<!-- END TPL.LOOP.PHP -->