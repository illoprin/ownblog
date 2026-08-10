<?

/**
 * Получает картинку для OG/Twitter превью с приоритетом:
 * 1. Первая картинка из Carbon Fields галереи
 * 2. Featured Image поста
 * 3. Дефолтная картинка темы
 */
function get_post_og_image(WP_Post $post): string {
  // Пробуем достать первую картинку из Carbon Fields галереи
  $gallery = carbon_get_post_meta($post->ID, 'media');

  if (!empty($gallery) && is_array($gallery)) {
    $first_attachment_id = reset($gallery);
    $image_url = wp_get_attachment_image_url($first_attachment_id, 'large');

    if ($image_url) {
      return $image_url;
    }
  }

  // Fallback на Featured Image
  if (has_post_thumbnail($post)) {
    return get_the_post_thumbnail_url($post, 'large');
  }

  // Дефолтная картинка темы
  return get_template_directory_uri() . '/assets/static/og-singular.jpg';
}

/**
 * Собирает данные для SEO/OG тегов текущей страницы
 */
function get_page_seo_data(): array {
  if (is_singular()) {
    global $post;

    $title = get_the_title($post);

    $description = has_excerpt($post)
      ? get_the_excerpt($post)
      : wp_trim_words(strip_shortcodes(wp_strip_all_tags($post->post_content)), 30, '…');

    $image = get_post_og_image($post);

    $url = get_permalink($post);
  } elseif (is_front_page()) {
    $title       = get_bloginfo('name');
    $description = 'Илья (illoprin) — веб-разработчик. WordPress под ключ, React/TypeScript приложения, Node.js, оптимизация скорости, настройка VPS Linux. От идеи к готовому решению.';
    $image       = get_template_directory_uri() . '/assets/static/og-preview.jpg';
    $url         = home_url('/');
  } else {
    $title       = wp_get_document_title();
    $description = get_bloginfo('description');
    $image       = get_template_directory_uri() . '/assets/static/og-preview.jpg';
    $url         = home_url(add_query_arg(null, null));
  }

  return compact('title', 'description', 'image', 'url');
}

/**
 * Выводим мета-теги в <head> — работает на всех страницах автоматически
 */
add_action('wp_head', function () {
  $seo = get_page_seo_data();
?>
  <meta name="description" content="<?= esc_attr($seo['description']) ?>">
  <link rel="canonical" href="<?= esc_url($seo['url']) ?>">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="<?= esc_attr(get_bloginfo('name')) ?>">
  <meta property="og:title" content="<?= esc_attr($seo['title']) ?>">
  <meta property="og:description" content="<?= esc_attr($seo['description']) ?>">
  <meta property="og:image" content="<?= esc_url($seo['image']) ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:url" content="<?= esc_url($seo['url']) ?>">
  <meta property="og:locale" content="ru_RU">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= esc_attr($seo['title']) ?>">
  <meta name="twitter:description" content="<?= esc_attr($seo['description']) ?>">
  <meta name="twitter:image" content="<?= esc_url($seo['image']) ?>">
<?php
}, 1);

add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
});
