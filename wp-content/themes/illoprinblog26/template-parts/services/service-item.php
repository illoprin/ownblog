<?
/**
 * Ожидает переменные через $args:
 *   $args['icon']        - класс иконки (bi bi-...)
 *   $args['title']        - заголовок услуги
 *   $args['description']  - HTML-описание (уже с <strong> вместо **bold**)
 *   $args['tags']         - массив строк (названия тегов)
 *   $args['post_id']      - ID поста (для уникальных id, если понадобится)
 */

// Защита от прямого доступа и отсутствия данных
if (!isset($args) || empty($args)) {
  return;
}

$icon        = $args['icon'] ?? '';
$title       = $args['title'] ?? '';
$description = $args['description'] ?? '';
$tags        = $args['tags'] ?? [];
$post_id     = $args['post_id'] ?? 0;
?>

<div class="col-12 col-md-6 col-lg-4 reveal">
  <article class="card svc-card glass spotlight h-100 card-body p-4">

    <? if ($icon): ?>
      <span class="svc-icon <?= esc_attr($icon); ?>"></span>
    <? endif; ?>

    <h3 class="card-title" id="svc-title">
      <?= esc_html($title) ?>
    </h3>

    <p class="text-dim" id="svc-body">
      <?= wp_kses_post($description); ?>
    </p>

    <? if (!empty($tags)): ?>
      <ul class="svc-tags list-unstyled">
        <? foreach ($tags as $tag): ?>
          <li class="badge badge-accent font-alt">
            <?= esc_html($tag); ?>
          </li>
        <? endforeach; ?>
      </ul>
    <? endif; ?>

    <div class="card-footer">
      <a href="#contact" class="svc-link link-primary">
        Обсудить <i class="bi bi-arrow-right"></i>
      </a>
    </div>

  </article>
</div>