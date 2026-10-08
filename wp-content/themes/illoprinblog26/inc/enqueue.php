<?php

function lp_asset_version($relative_path) {
  $file_path = get_template_directory() . $relative_path;

  if (is_file($file_path)) {
    return (string) filemtime($file_path);
  }

  return (string) wp_get_theme()->get('Version');
}

function lp_enqueue_style() {

  wp_enqueue_style(
    'bootstrap',
    get_template_directory_uri() . '/assets/dist/css/bootstrap.min.css',
    array('fonts'),
    lp_asset_version('/assets/dist/css/bootstrap.min.css'),
  );

  wp_enqueue_style(
    'bootstrap-icons',
    'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css',
    array(),
    '1.13.1'
  );

  wp_enqueue_style(
    'fonts',
    get_template_directory_uri() . '/fonts.css',
    array(),
    lp_asset_version('/fonts.css'),
  );

  wp_enqueue_style(
    'main',
    get_template_directory_uri() . '/assets/dist/css/style.min.css',
    array('fonts', 'bootstrap'),
    lp_asset_version('/assets/dist/css/style.min.css'),
  );


  // front page
  if (is_front_page()) {
    wp_enqueue_style(
      'landing',
      get_template_directory_uri() . '/assets/dist/css/landing.min.css',
      array('main'),
      lp_asset_version('/assets/dist/css/landing.min.css'),
    );
  }
  // single portfolio
  else if (is_singular('portfolio')) {
    wp_enqueue_style(
      'single-portfolio',
      get_template_directory_uri() . '/assets/dist/css/single-portfolio.min.css',
      array('main'),
      lp_asset_version('/assets/dist/css/single-portfolio.min.css'),
    );
  }
}

function lp_enqueue_scripts() {
  // illoprin lib
  wp_enqueue_script(
    'reveal-on-scroll',
    get_template_directory_uri() . '/assets/src/js/RevealOnScroll.js',
    array(),
    lp_asset_version('/assets/src/js/RevealOnScroll.js'),
    array(
      'strategy' => 'defer'
    )
  );
  wp_enqueue_script(
    'scroll-bar',
    get_template_directory_uri() . '/assets/src/js/ScrollBar.js',
    array(),
    lp_asset_version('/assets/src/js/ScrollBar.js'),
    array(
      'strategy' => 'defer'
    )
  );
  wp_enqueue_script(
    'toast',
    get_template_directory_uri() . '/assets/src/js/ToastShow.js',
    array(),
    lp_asset_version('/assets/src/js/ToastShow.js'),
    array(
      'strategy' => 'defer'
    )
  );

  // main js
  wp_enqueue_script(
    'main',
    get_template_directory_uri() . '/assets/src/js/main.js',
    array(),
    lp_asset_version('/assets/src/js/main.js'),
    array(
      'in_footer' => true,
      'strategy' => 'defer'

    )
  );

  // for front page
  if (is_front_page()) {
    wp_enqueue_script(
      'typing-effect',
      get_template_directory_uri() . '/assets/src/js/TypingEffect.js',
      array(),
      lp_asset_version('/assets/src/js/TypingEffect.js'),
      array(
        'strategy' => 'defer'
      )
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
      'strategy' => 'defer',
    )
  );
  wp_enqueue_script(
    'tilt-effect',
    get_template_directory_uri() . '/assets/src/js/tilt.js',
    array(),
    lp_asset_version('/assets/src/js/tilt.js'),
    array(
      'in_footer' => true,
      'strategy' => 'defer',
    )
  );
}

function lp_make_styles_async($html, $handle, $href, $media) {
  // specify style slugs that should be loaded async
  $async_handles = array('bootstrap-icons', 'fonts');

  if (in_array($handle, $async_handles, true) && ! is_admin()) {
    $html = sprintf(
      '<link rel="preload" id="%s-css" href="%s" as="style" media="%s" onload="this.onload=null;this.rel=\'stylesheet\'">' .
        '<noscript><link rel="stylesheet" id="%s-css-ns" href="%s" media="%s"></noscript>' . "\n",
      esc_attr($handle),
      esc_url($href),
      esc_attr($media),
      esc_attr($handle),
      esc_url($href),
      esc_attr($media)
    );
  }

  return $html;
}


function lp_add_cdn_preconnect($urls, $relation_type) {
  if ('preconnect' === $relation_type) {
    $urls[] = array(
      'href' => 'https://cdn.jsdelivr.net',
      'crossorigin' => 'anonymous',
    );
  }

  return $urls;
}

function my_custom_body_classes($classes) {
  $classes[] = 'font-primary';
  return $classes;
}

add_filter('style_loader_tag', 'lp_make_styles_async', 10, 4);
add_filter('wp_resource_hints', 'lp_add_cdn_preconnect', 10, 2);
add_filter('body_class', 'my_custom_body_classes');
add_action('wp_enqueue_scripts', 'lp_enqueue_style');
add_action('wp_enqueue_scripts', 'lp_enqueue_scripts');
