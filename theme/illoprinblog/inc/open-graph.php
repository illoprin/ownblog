<?php
function my_open_graph_tags()
{
  if (is_singular('portfolio_case')) {
    global $post;
    $title = get_the_title($post);
    $url   = get_permalink($post);
    $img   = get_the_post_thumbnail_url($post, 'large');

    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . PHP_EOL;
    echo '<meta property="og:description" content="Кейс ' . esc_attr($title) . ' из портфолио веб-разработчика Ильи.">' . PHP_EOL;
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . PHP_EOL;
    if ($img) {
      echo '<meta property="og:image" content="' . esc_url($img) . '">' . PHP_EOL;
    }
  }
}
add_action('wp_head', 'my_open_graph_tags');
