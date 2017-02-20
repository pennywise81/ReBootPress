<?php

class CustomMetaBoxField {
  private $id;
  private $label;
  private $object;
  private $type; // text, textarea, wp_editor, select ... 
  
  function __construct($id, $label, $object, $type = 'text') {
    $this->id = $id;
    $this->label = $label;
    $this->object = $object;
    $this->type = $type;

    add_action('save_post', $this->saveValue($object->ID));
  }

  public function displayAdministration() {
    wp_nonce_field(-1, $this->id . '_nonce');

    if ($this->type == 'text') {
      $this->displayAdministrationText();
    }
  }
  
  private function displayAdministrationText() {
    ?>
    <p>
      <?php echo $this->id; ?><br>
      <?php echo $this->object->ID; ?><br>
      <br>

      <label for="<?php echo $this->id; ?>"><?php echo $this->label; ?></label>
      <br/>
      <input
        class="widefat"
        type="text"
        name="<?php echo $this->id; ?>"
        id="<?php echo $this->id; ?>"
        value="<?php echo self::getValue($this->object->ID, $this->id); ?>"
      />
    </p>
    <?php
  }

  public static function getValue($post_id, $field_id, $clean = true) {
    $field_data = get_post_meta($post_id, $field_id, true);

    if ($clean === true) {
      $field_data = esc_attr($field_data);
    }

    return $field_data;
  }

  private function saveValue($post_id) {
    echo '<pre>';
    print_r($_REQUEST);
    echo '</pre>';

    /*
    if (!isset($_POST[$this->id . '_nonce']) ||
      !wp_verify_nonce($_POST[$this->id . '_nonce'])
    ) {
      return $post_id;
    }
    */

    $new_value = (isset($_POST[$this->id]) ? htmlspecialchars($_POST[$this->id]) : '');
    $old_value = self::getValue($post_id, $this->id, false);

    var_dump($old_value);
    var_dump($new_value);

    if ($new_value != '' && $old_value == '') {
      add_post_meta($post_id, $this->id, $new_value, true);
      echo '1';

    } elseif ($new_value != '' && $new_value != $old_value) {
      update_post_meta($post_id, $this->id, $new_value);
      echo '2';

    } elseif ($new_value == '' && $old_value != '') {
      delete_post_meta($post_id, $this->id, $new_value);
      echo '3';
    }

    echo '4';

    return $post_id;
  }
}