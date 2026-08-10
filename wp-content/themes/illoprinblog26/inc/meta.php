<?

function lp_meta_description() {

  if (is_front_page()) {
    $description = 'Илья (illoprin) — веб-разработчик. WordPress под ключ, React/TypeScript приложения, Node.js, оптимизация скорости, настройка VPS. От идеи к готовому решению.';
  } elseif (is_post_type_archive('portfolio')) {
    $description = 'Каталог проектов и работ — портфолио веб-разработки';
  } elseif (is_singular('portfolio')) {
    // Берём excerpt текущего поста как описание
    $description = wp_trim_words(get_the_content(), 25);
  } else {
    $description = get_bloginfo('description');
  }

  echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
}

add_action('wp_head', 'lp_meta_description', 1);
