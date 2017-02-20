<?php

class CustomMetaBox {
  private $id;
  private $title;
  private $callback;
  private $screen;
  private $context;
  private $priority;
  private $callback_args;

  function __construct(
    $id,
    $title,
    $callback = null,
    $screen = 'post',
    $context = 'side',
    $priority = 'default',
    $callback_args = null
  ) {
    $this->id = $id;
    $this->title = $title;
    
    if ($callback == null) {
      $this->callback = function() {
        echo __('empty');
      };
    } else {
      $this->callback = $callback;
    }

    $this->screen = $screen;
    $this->context = $context;
    $this->priority = $priority;
    $this->callback_args = $callback_args;

    $this->register();
  }

  private function register() {
    add_action('add_meta_boxes_' . $this->screen, function() {
      add_meta_box(
        $this->id,
        $this->title,
        $this->callback,
        $this->screen,
        $this->context,
        $this->priority,
        $this->callback_args
      );
    });
  }
}