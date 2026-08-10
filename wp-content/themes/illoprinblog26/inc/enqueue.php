<?

/**
 * Returns the version of a file based on the time it was last modified.
 * Used for automatic cache busting.
 */
function lp_asset_version($relative_path) {
  $file_path = get_template_directory() . $relative_path;
  return file_exists($file_path) ? filemtime($file_path) : '1.0.0';
}

function lp_enqueue_style() {

  // master styles
  wp_enqueue_style(
    'bootstrap',
    get_template_directory_uri() . '/assets/dist/css/bootstrap.min.css',
    array(),
    lp_asset_version('/assets/dist/css/bootstrap.min.css')
  );
  wp_enqueue_style(
    'bootstrap-icons',
    'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'
  );
  wp_enqueue_style(
    'main',
    get_template_directory_uri() . '/assets/dist/css/style.min.css',
    array(),
    lp_asset_version('/assets/dist/css/style.min.css')
  );
  wp_enqueue_style(
    'bg',
    get_template_directory_uri() . '/assets/dist/css/bg.min.css',
    array(),
    lp_asset_version('/assets/dist/css/bg.min.css')
  );
  wp_enqueue_style(
    'archive-portfolio',
    get_template_directory_uri() . '/assets/dist/css/archive-portfolio.min.css',
    array(),
    lp_asset_version('/assets/dist/css/archive-portfolio.min.css')
  );


  // front page
  if (is_front_page()) {
    wp_enqueue_style(
      'landing',
      get_template_directory_uri() . '/assets/dist/css/landing.min.css',
      array(),
      lp_asset_version('/assets/dist/css/landing.min.css')
    );
  }
  // single portfolio
  else if (is_singular('portfolio')) {
    wp_enqueue_style(
      'single-portfolio',
      get_template_directory_uri() . '/assets/dist/css/single-portfolio.min.css',
      array(),
      lp_asset_version('/assets/dist/css/single-portfolio.min.css')
    );
  }
}

function lp_enqueue_scripts() {
  // illoprin lib
  wp_enqueue_script(
    'reveal-on-scroll',
    get_template_directory_uri() . '/assets/src/js/RevealOnScroll.js',
    array(),
    lp_asset_version('/assets/src/js/RevealOnScroll.js')
  );
  wp_enqueue_script(
    'scroll-bar',
    get_template_directory_uri() . '/assets/src/js/ScrollBar.js',
    array(),
    lp_asset_version('/assets/src/js/ScrollBar.js')
  );
  wp_enqueue_script(
    'toast',
    get_template_directory_uri() . '/assets/src/js/ToastShow.js',
    array(),
    lp_asset_version('/assets/src/js/ToastShow.js')
  );

  // main js
  wp_enqueue_script(
    'main',
    get_template_directory_uri() . '/assets/src/js/main.js',
    array(),
    lp_asset_version('/assets/src/js/main.js'),
    array(
      'in_footer' => true,
    )
  );

  // for front page
  if (is_front_page()) {
    wp_enqueue_script(
      'typing-effect',
      get_template_directory_uri() . '/assets/src/js/TypingEffect.js',
      array(),
      lp_asset_version('/assets/src/js/TypingEffect.js')
    );
    wp_enqueue_script(
      'front-page-js',
      get_template_directory_uri() . '/assets/src/js/front-page.js',
      array(),
      lp_asset_version('/assets/src/js/front-page.js'),
      array(
        'strategy' => 'defer'
      )
    );
  }
  // portfolio archive
  else if (is_post_type_archive('portfolio')) {
    wp_enqueue_script(
      'archive-portfolio-js',
      get_template_directory_uri() . '/assets/src/js/archive-portfolio.js',
      array(),
      lp_asset_version('/assets/src/js/archive-portfolio.js'),
      array(
        'strategy' => 'defer',
      )
    );
  }
  // portfolio single
  else if (is_singular('portfolio')) {
    wp_enqueue_script(
      'single-portfolio-js',
      get_template_directory_uri() . '/assets/src/js/single-portfolio.js',
      array(),
      lp_asset_version('/assets/src/js/single-portfolio.js'),
      array(
        'strategy' => 'defer',
      )
    );
  }

  wp_enqueue_script(
    'spotlight',
    get_template_directory_uri() . '/assets/src/js/spotlight.js',
    array(),
    lp_asset_version('/assets/src/js/spotlight.js'),
    array(
      'in_footer' => true,
    )
  );
  wp_enqueue_script(
    'tilt-effect',
    get_template_directory_uri() . '/assets/src/js/tilt.js',
    array(),
    lp_asset_version('/assets/src/js/tilt.js'),
    array(
      'in_footer' => true,
    )
  );
}

function my_custom_body_classes($classes) {
  $classes[] = 'font-primary';
  return $classes;
}

add_filter('body_class', 'my_custom_body_classes');
add_action('wp_enqueue_scripts', 'lp_enqueue_style');
add_action('wp_enqueue_scripts', 'lp_enqueue_scripts');