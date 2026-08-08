<?

/**
 * Секция "Услуги" — получает все посты типа 'service' 
 * и рендерит карточки через card.php
 */

$services_query = new WP_Query([
  'post_type'      => 'service',
  'posts_per_page' => -1,
  'orderby'        => 'menu_order',
  'order'          => 'ASC',
]);

if (!$services_query->have_posts()) {
  return; // если услуг нет — секцию вообще не выводим
}

while ($services_query->have_posts()) {
  $services_query->the_post();

  // Собираем данные текущего поста
  $icon = get_post_meta(get_the_ID(), '_service_icon', true);

  $description = get_the_content();
  $desc_clean = str_replace(['<div>', '</div>'], '', $description);

  $tags_terms = get_the_terms(get_the_ID(), 'service_tag');
  $tags = [];
  if ($tags_terms && !is_wp_error($tags_terms)) {
    $tags = wp_list_pluck($tags_terms, 'name');
  }

  // Передаём собранные данные в шаблон карточки
  get_template_part('template-parts/services/item', null, [
    'icon'        => $icon,
    'title'       => get_the_title(),
    'description' => $desc_clean,
    'tags'        => $tags,
    'post_id'     => get_the_ID(),
  ]);

}
?>