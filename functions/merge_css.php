<?php

function merge_css() {
  if (get_theme_mod('enable_css_caching') == 0) {
    return;
  }

  global $wp_styles;

  $css_ouput = '';
  $all_styles = [];
  $cache_time = 60 * 60 * 5; // cache css for x hours

  foreach ($wp_styles->queue as $q) {
    if (!in_array($q, $all_styles)) {
      $all_styles[] = $q;
    }

    foreach ($wp_styles->registered[$q]->deps as $d) {
      if (!in_array($d, $all_styles)) {
        $all_styles[] = $d;
      }
    }
  }

  if (
    !file_exists(get_template_directory() . '/combined.css') ||
    isset($_GET['refresh']) === true ||
    time() - filemtime(get_template_directory() . '/combined.css') >= $cache_time
  ) {
    foreach ($all_styles as $s) {
      $t = $wp_styles->registered[$s]->src;

      $css_ouput .= '/* file "' . $t . '" (';

      if (substr($t, 0, 4) == 'http') {
        $css_ouput .= "remote) */\n";
        $css_ouput .= file_get_contents($t);
      } else {
        $css_ouput .= "local) */\n";
        ob_start();
        include_once $t;
        $css_ouput .= ob_get_contents();
        ob_end_clean();
      }
    }

    file_put_contents(get_template_directory() . '/combined.css', $css_ouput);
  }

  foreach ($all_styles as $s) {
    wp_deregister_style($s);
    wp_register_style($s, false);
  }
}

add_action('wp_enqueue_scripts', 'merge_css');

function load_css() {
  if (get_theme_mod('enable_css_caching') == 0) {
    return;
  }
  
  $stylesheet = get_stylesheet_directory_uri() . '/combined.css';

  echo '
  <script>
    function loadStyleSheet(src){
      if (document.createStyleSheet) document.createStyleSheet(src);
      else {
        var stylesheet = document.createElement(\'link\');
        stylesheet.href = src;
        stylesheet.rel = \'stylesheet\';
        stylesheet.type = \'text/css\';
        document.getElementsByTagName(\'head\')[0].appendChild(stylesheet);
      }
    }
    
    loadStyleSheet("' . $stylesheet . '")
    </script>
  ';
}

add_action('wp_footer', 'load_css', 1000);