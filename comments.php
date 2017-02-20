<?php

if (post_password_required()) {
  return;
}

?>

<div id="comments" class="comments-area">
  <?php if (have_comments()) { ?>
  <h4>
    <?php

    comments_number(
      __('No Comments yet', 'rebootpress'),
      __('One Comment', 'rebootpress'),
      __('% Comments', 'rebootpress')
    );

    ?>
  </h4>

  <?php

  $comments_threaded = get_option('thread_comments') == 1 ? true : false;
  $thread_max_level = get_option('thread_comments_depth');
  $comments_sorted_by_id = array();

  // wp_list_comments(); // standard comment list

  /* start custom comment list */
  foreach ($comments as $comment) {
  $comment->level = 1; // setting base level for each comment
  $comments_sorted_by_id[get_comment_ID()] = $comment;

  if (true === $comments_threaded) { // comments are threaded
    if ($comment->comment_parent != 0) { // comment is a reply

      // increase level, if we are not above the max level
      if ($comment->level <= $thread_max_level) {
        $comment->level = $comments_sorted_by_id[$comment->comment_parent]->level + $comment->level;
      }
    }
  }

  ?>
  <div class="media comment-level-<?php echo $comment->level; ?> <?php echo implode(' ', get_comment_class()); ?>"
       id="comment-<?php comment_ID(); ?>">
    <div class="media-left">
      <?php

      $new_args = array(
        'class' => 'media-object img-circle'
      );
      echo get_avatar(get_comment_author_email(), 32, get_option('avatar_default', 'mystery'), '', $new_args);

      ?>
    </div>

    <div class="media-body">
      <h4 class="media-heading">
        <?php comment_author_link(); ?>
      </h4>
      <div class="comment-meta">
        <?php comment_date(get_option('date_format')); ?>
        <?php comment_time(get_option('time_format')); ?>
        <?php

        if ($comment->comment_parent != 0) {
          echo __('as reply to', 'rebootpress') . ' <a href="#comment-' . $comment->comment_parent . '">' .
            __('comment', 'rebootpress') . ' #' . $comment->comment_parent .
            '</a>';
        }

        ?>
      </div>
      <div class="comment-text" id="comment-text-<?php comment_ID(); ?>">
        <?php comment_text(); ?>
        <?php

        $defaults = array(
          'add_below' => 'comment',
          'respond_id' => 'respond',
          'reply_text' => __('Reply', 'rebootpress'),
          'reply_to_text' => __('Reply to %s', 'rebootpress'),
          'login_text' => __('Log in to Reply', 'rebootpress'),
          'depth' => 0,
          'before' => '',
          'after' => ''
        );

        comment_reply_link(array_merge($defaults, array(
          'depth' => 1,
          'max_depth' => $thread_max_level,
          'add_below' => 'comment-text'
        )), $comment->comment_ID);

        ?>
      </div><!-- end .comment-text -->
      <?php

      get_template_part('template-parts/tpl.comment_closing');
      }
      /* end custom comment list */
      }

      comment_form(array(
        'id_form' => 'commentform',
        'class_form' => 'comment-form',
        'id_submit' => 'submit',
        'class_submit' => 'btn btn-primary pull-xs-right',
        'name_submit' => 'submit',
        'title_reply' => __('Leave a Reply', 'rebootpress'),
        'title_reply_to' => __('Leave a Reply to %s', 'rebootpress'),
        'cancel_reply_link' => __('Cancel Reply', 'rebootpress'),
        'label_submit' => __('Post Comment', 'rebootpress'),
        'format' => 'xhtml',
        'comment_notes_before' => '<div class="alert alert-info" role="alert">
            ' . __('Your email address will not be published.', 'rebootpress') . ($req ? $required_text : '') . '
          </div>',
        'comment_notes_after' => '<div class="alert alert-info" role="alert">
            ' . sprintf(__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'rebootpress'), ' <code>' . allowed_tags() . '</code>') . '
          </div>',
        'comment_field' => '<fieldset class="form-group">
            <label for="comment">' . __('Comment', 'rebootpress') .'</label>
            <textarea class="form-control"  id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
          </fieldset>',
        'must_log_in' => '<div class="alert alert-warning" role="alert">' .
          sprintf(
            __('You must be <a class="alert-link" href="%s">logged in</a> to post a comment.'),
            wp_login_url(apply_filters('the_permalink', get_permalink()))
          ) . '</div>',
        'logged_in_as' => '<div class="alert alert-success" role="alert">' .
          sprintf(
            __('Logged in as <a class="alert-link" href="%1$s">%2$s</a>. <a class="alert-link" href="%3$s" title="Log out of this account">Log out?</a>'),
            admin_url('profile.php'),
            $user_identity,
            wp_logout_url(apply_filters('the_permalink', get_permalink()))
          ) . '</div>',
        'fields' => array(
          'author' => '<fieldset class="form-group">
              <label for="author">' . __('Name', 'rebootpress') . '</label>
              <input type="text" class="form-control" id="author" placeholder="' . __('Name', 'rebootpress') . '" value="' . esc_attr($commenter['comment_author']) . '">
            </fieldset>',
          'email' => '<fieldset class="form-group">
              <label for="email">' . __('Email', 'rebootpress') . '</label>
              <input type="email" class="form-control" id="email" placeholder="' . __('Email', 'rebootpress') . '" value="' . esc_attr($commenter['comment_author_email']) . '">
            </fieldset>',
          'url' => '<fieldset class="form-group">
              <label for="url">' . __('Website', 'rebootpress') . '</label>
              <input type="text" class="form-control" id="url" placeholder="' . __('Website', 'rebootpress') . '" value="' . esc_attr($commenter['comment_author_url']) . '">
            </fieldset>'
        )
      ));

      ?>
    </div>