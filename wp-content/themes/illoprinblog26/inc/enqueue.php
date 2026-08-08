<?

function lp_enqueue_style() {

  // master styles
  wp_enqueue_style(
    'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css'
  );
  wp_enqueue_style(
    'bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css'
  );
  wp_enqueue_style(
    'main', get_template_directory_uri() . '/assets/css/style.css'
  );
  wp_enqueue_style(
    'bg', get_template_directory_uri() . '/assets/css/bg.css'
  );
  wp_enqueue_style(
    'cases', get_template_directory_uri() . '/assets/css/cases.css'
  );


  if (is_front_page()) {
    wp_enqueue_style(
      'landing', get_template_directory_uri() . '/assets/css/landing.css'
    );
  }
}


function lp_enqueue_scripts() {
  // external libs
  wp_enqueue_script(
    'marked', get_template_directory_uri() . '/assets/js/lib/marked.js'
  );

  // illoprin lib
  wp_enqueue_script(
    'reveal-on-scroll', get_template_directory_uri() . '/assets/js/RevealOnScroll.js'
  );
  wp_enqueue_script(
    'scroll-bar', get_template_directory_uri() . '/assets/js/ScrollBar.js'
  );
  wp_enqueue_script(
    'toast', get_template_directory_uri() . '/assets/js/ToastShow.js'
  );

  // main js
  wp_enqueue_script(
    'main', get_template_directory_uri() . '/assets/js/main.js',
    array(), '1.0.0',
    array(
      'in_footer' => true,
    )
  );
  wp_enqueue_script(
    'portfolio', get_template_directory_uri() . '/assets/js/data-portfolio.js'
  );
  
  // for front page
  if (is_front_page()) {
    wp_enqueue_script(
      'typing-effect',
      get_template_directory_uri() . '/assets/js/TypingEffect.js',
    );
    wp_enqueue_script(
      'landing',
      get_template_directory_uri() . '/assets/js/landing.js',
      
    );
  }

  wp_enqueue_script(
    'spotlight',
    get_template_directory_uri() . '/assets/js/spotlight.js',
    array(), '1.0.0',
      array(
        'in_footer' => true,
      )
  );
  wp_enqueue_script(
    'tilt-effect',
    get_template_directory_uri() . '/assets/js/tilt.js',
    array(), '1.0.0',
      array(
        'in_footer' => true,
      )
  );

}

function my_custom_body_classes( $classes ) {
  $classes[] = 'font-primary';  
  return $classes;
}

add_filter('body_class', 'my_custom_body_classes');
add_action('wp_enqueue_scripts', 'lp_enqueue_style');
add_action('wp_enqueue_scripts', 'lp_enqueue_scripts');
