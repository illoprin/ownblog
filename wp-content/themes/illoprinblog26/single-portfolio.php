<?

/**
 * Шаблон для отображения одного проекта из портфолио
 * File: single-portfolio.php
 */

function get_portfolio_link_icon($type)
{
  $icons = [
    'github' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg',
    'website' => 'https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/ie10/ie10-original.svg',
    'figma'  => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg',
  ];

  $type = sanitize_key($type);

  if (!isset($icons[$type])) {
    return '';
  }

  return sprintf(
    '<img src="%s" alt="" aria-hidden="true" />',
    esc_url($icons[$type])
  );
}

get_header();

while (have_posts()):
  the_post();

  $post_id   = get_the_ID();
  $title     = get_the_title();
  
  $lead_text = get_the_content(); // или используйте custom lead если есть

  /* ================= TAXONOMIES ================= */
  // 1. Категория (радио)
  $categories = wp_get_post_terms($post_id, 'portfolio_category');
  $category   = !empty($categories) && !is_wp_error($categories) ? $categories[0] : null;

  // 2. Стек технологий
  $stack_terms = wp_get_post_terms($post_id, 'portfolio_stack');

  /* ================= CARBON FIELDS ================= */
  $task_content     = carbon_get_post_meta($post_id, 'task');
  $solution_content = carbon_get_post_meta($post_id, 'solution');
  $stats            = carbon_get_post_meta($post_id, 'stats');
  $media_ids        = carbon_get_post_meta($post_id, 'media');
  $links            = carbon_get_post_meta($post_id, 'project_links');

  /* ================= GALLERY PREPARATION ================= */
  $gallery_data = [];

  if (!empty($media_ids) && is_array($media_ids)) {
    foreach ($media_ids as $att_id) {
      $mime_type = get_post_mime_type($att_id);
      $is_video  = (strpos($mime_type, 'video') !== false);
      $full_url  = wp_get_attachment_url($att_id);

      // Для превью берем размер medium, для видео - полный url
      $thumb_src = wp_get_attachment_image_src($att_id, 'medium');
      $thumb_url = ($thumb_src && !$is_video) ? $thumb_src[0] : $full_url;

      $gallery_data[] = [
        'src'      => $full_url,
        'thumb'    => $thumb_url,
        'is_video' => $is_video,
        'alt'      => get_post_meta($att_id, '_wp_attachment_image_alt', true) ?: $title,
      ];
    }
  } elseif (has_post_thumbnail()) {
    // Фолбэк на миниатюру поста, если галерея пуста
    $gallery_data[] = [
      'src'      => get_the_post_thumbnail_url($post_id, 'full'),
      'thumb'    => get_the_post_thumbnail_url($post_id, 'medium'),
      'is_video' => false,
      'alt'      => $title,
    ];
  }
?>

  <!-- ================= MAIN ================= -->
  <main id="top">

    <!-- ================= HERO ================= -->
    <div class="parallax" id="hero">
      <section class="section">
        <div class="container">

          <!-- breadcrumbs -->
          <p class="glass-crumbs reveal">
            <a href="<? echo esc_url(home_url('/')); ?>">Главная</a>
            <span class="mx-1">/</span>
            <a href="<? echo esc_url(get_post_type_archive_link('portfolio')); ?>">Кейсы</a>
            <span class="mx-1">/</span>
            <span class="text-dim"><? echo esc_html($title); ?></span>
          </p>

          <!-- title -->
          <? if ($category) : ?>
            <span class="badge badge-accent text-uppercase reveal"><? echo esc_html($category->name); ?></span>
          <? endif; ?>

          <h1 class="case-title font-alt reveal">
            <? echo esc_html($title); ?>
          </h1>

          <? if ($lead_text) : ?>
            <p class="case-lead reveal">
              <?= wp_kses_post($lead_text) ?>
            </p>
          <? endif; ?>

          <!-- stack -->
          <? if (!empty($stack_terms) && !is_wp_error($stack_terms)) : ?>
            <div class="case-stack-container mt-3">
              <? foreach ($stack_terms as $term) : ?>
                <div class="badge badge-stack reveal"><?= esc_html($term->name); ?></div>
              <? endforeach; ?>
            </div>
          <? endif; ?>

          <!-- links -->
          <? if (!empty($links) && !is_wp_error($stack_terms)) : ?>
            <ul class="case-links reveal">
              <? foreach ($links as $link): ?>
              <li class="case-link-item">
                <a
                  href="<?= esc_url($link['url']) ?>"
                  <? if ($link['new_tab']) echo 'target="blank_"'; ?> 
                >
                  <?= get_portfolio_link_icon($link['type'] ?? '') ?>
                  <?= esc_html($link['label']) ?>
                </a>
              </li>
              <? endforeach; ?>
            </ul>
          <? endif; ?>

        </div>
      </section>
    </div>

    <!-- ==================== GALLERY ==================== -->
    <? if (!empty($gallery_data)) : ?>
      <section class="section parallax-overlap">
        <div class="container">
          
          <div class="gallery reveal">
            <!-- Главный слайд -->
            <div class="gallery-main" id="case-gallery-main">
              <?
              $first = $gallery_data[0];
              if ($first['is_video']) : ?>
                <video
                  src="<?= esc_url($first['src']); ?>" controls playsinline></video>
              <? else : ?>
                <img
                  src="<?= esc_url($first['src']); ?>"
                  alt="<?= esc_attr($first['alt']); ?>" loading="eager" />
              <? endif; ?>
              <span class="zoom-hint"><i class="bi bi-arrows-angle-expand"></i></span>
            </div>

            <!-- Миниатюры -->
            <div class="gallery-thumbs" id="case-gallery-thumbs">
              <? foreach ($gallery_data as $index => $media) : ?>
                <button type="button"
                  class="gallery-thumb <? echo $media['is_video'] ? 'is-video' : ''; ?> <?= $index === 0 ? 'is-active' : ''; ?>"
                  data-index="<? echo $index; ?>">
                  <? if ($media['is_video']) : ?>
                    <video src="<? echo esc_url($media['src']); ?>" muted playsinline preload="metadata"></video>
                  <? else : ?>
                    <img
                      src="<?= esc_url($media['thumb']); ?>"
                      alt="<?= esc_attr($media['alt']); ?>" loading="lazy" />
                  <? endif; ?>
                </button>
              <? endforeach; ?>
            </div>
          </div>
        </div>
      </section>
    <? endif; ?>

    <!-- ================= ЗАДАЧА / РЕШЕНИЕ ================= -->
    <? if ($task_content || $solution_content) : ?>
      <section class="section">
        <div class="container">
          <div class="row g-3">

            <!-- task -->
            <? if ($task_content) : ?>
              <div class="col-12 col-md-6 reveal case-task-col">
                <span class="case-section-label badge badge-primary">
                  <i class="bi bi-flag"></i> Задача
                </span>
                <article class="text-article">
                  <? echo apply_filters('the_content', $task_content); ?>
                </article>
              </div>
            <? endif; ?>

            <!-- solution -->
            <? if ($solution_content) : ?>
              <div class="col-12 col-md-6 reveal case-solution-col">
                <div class="text-end case-solution-label-container">
                  <span class="case-section-label badge badge-accent">
                    <i class="bi bi-lightbulb"></i> Решение
                  </span>
                </div>
                <article class="text-article">
                  <? echo apply_filters('the_content', $solution_content); ?>
                </article>
              </div>
            <? endif; ?>

          </div>
        </div>
      </section>
    <? endif; ?>

    <!-- ================= РЕЗУЛЬТАТЫ ================= -->
    <? if (!empty($stats)) : ?>
      <section class="section pt-0">
        <div class="container">
          <header class="section-head reveal">
            <span class="badge badge-primary section-badge">Результаты</span>
            <h2 class="section-title font-alt"><span class="text-grad">Результат</span></h2>
          </header>

          <div class="case-stats-grid reveal">
            <? foreach ($stats as $stat):
              // $stat_raw = "**+45%** конверсия в заявку"
              $stat_raw = $stat['stat_value'];

              $stat_arr = lp_parse_case_stat($stat_raw);

              if (count($stat_arr) == 2) : ?>
                <div class="glass case-stat">
                  <strong><?= wp_kses_post($stat_arr[0]); ?></strong>
                  <span><?= wp_kses_post($stat_arr[1]); ?></span>
                </div>
              <? else: ?>
                <div class="glass case-stat">
                  <span><?= wp_kses_post($stat_arr[0]); ?></span>
                </div>
            <?
              endif;
            endforeach;
            ?>
          </div>
        </div>
      </section>
    <? endif; ?>

    <!-- ================= РЕЛЕВАНТНЫЕ КЕЙСЫ ================= -->
    <?
    // Формируем запрос похожих кейсов (сначала той же категории)
    $related_args = [
      'post_type'      => 'portfolio',
      'posts_per_page' => 3,
      'post__not_in'   => [$post_id],
      'orderby'        => 'date',
      'order'          => 'DESC',
    ];

    if ($category) {
      $related_args['tax_query'] = [
        [
          'taxonomy' => 'portfolio_category',
          'field'    => 'term_id',
          'terms'    => $category->term_id,
        ]
      ];
    }

    $related_query = new WP_Query($related_args);

    // Если кейсов из той же категории меньше 3 — добираем из других
    if ($related_query->post_count < 3) {
      $needed = 3 - $related_query->post_count;
      $excluded_ids = array_merge([$post_id], wp_list_pluck($related_query->posts, 'ID'));

      $fallback_query = new WP_Query([
        'post_type'      => 'portfolio',
        'posts_per_page' => $needed,
        'post__not_in'   => $excluded_ids,
        'orderby'        => 'date',
        'order'          => 'DESC',
      ]);

      $related_posts = array_merge($related_query->posts, $fallback_query->posts);
    } else {
      $related_posts = $related_query->posts;
    }

    if (!empty($related_posts)) :
    ?>
      <section class="section pt-0" id="case-related">
        <div class="container">

          <header class="section-head reveal">
            <span class="badge badge-primary section-badge">Портфолио</span>
            <h2 class="section-title font-alt">Похожие <span class="text-grad">проекты</span></h2>
          </header>

          <div class="row g-4">
            <? foreach ($related_posts as $rel_post):
              $rel_id   = $rel_post->ID;
              $rel_cats = wp_get_post_terms($rel_id, 'portfolio_category');
              $rel_cat  = !empty($rel_cats) ? $rel_cats[0]->name : '';

              $rel_media_ids = carbon_get_post_meta($rel_post->ID, 'media');
              $rel_thumb = wp_get_attachment_url(!empty($rel_media_ids) ? $rel_media_ids[0] : '');
            ?>
              <div class="col-12 col-lg-4 reveal">
                <article class="card card-portfolio glass spotlight h-100">
                  <div class="card-media pf-media">
                    <? if ($rel_cat) : ?>
                      <span class="badge pf-category"><? echo esc_html($rel_cat); ?></span>
                    <? endif; ?>
                    <img src="<? echo esc_url($rel_thumb) ?>" alt="<? echo esc_attr(get_the_title($rel_id)); ?>" loading="lazy" />
                    <div class="pf-overlay d-none d-lg-flex">
                      <a href="<? echo get_permalink($rel_id); ?>" class="btn btn-brand btn-sm font-alt">
                        Подробнее <i class="bi bi-arrow-up-right"></i>
                      </a>
                    </div>
                  </div>

                  <div class="card-body position-relative">
                    <h3 class="card-title font-alt"><? echo esc_html(get_the_title($rel_id)); ?></h3>
                    <p class="text-dim"><? echo esc_html(get_the_excerpt($rel_id)); ?></p>
                    <div class="card-footer mt-auto">
                      <a href="<? echo get_permalink($rel_id); ?>" class="btn btn-ghost d-lg-none">
                        Подробнее <i class="bi bi-arrow-up-right"></i>
                      </a>
                    </div>
                  </div>
                </article>
              </div>
            <? endforeach;
            wp_reset_postdata(); ?>
          </div>
        </div>
      </section>
    <? endif; ?>

    <?
    get_template_part(
      'template-parts/lead-form',
      null,
      [
        'task' =>
        "Хочу проект, похожий на «"
          . get_the_title($post_id) .
          "». Расскажите подробнее..."
      ]
    )
    ?>

  </main>

  <!-- ================= LIGHTBOX ================= -->
  <div class="gallery-lightbox" id="case-lightbox">
    <button class="gallery-lightbox-close btn btn-icon" id="lightboxClose" aria-label="Закрыть"><i class="bi bi-x-lg"></i></button>
    <button class="gallery-lightbox-nav gallery-lightbox-prev btn btn-icon" id="lightboxPrev" aria-label="Предыдущее"><i class="bi bi-chevron-left"></i></button>
    <div class="gallery-lightbox-content" id="case-lightbox-content"></div>
    <button class="gallery-lightbox-nav gallery-lightbox-next btn btn-icon" id="lightboxNext" aria-label="Следующее"><i class="bi bi-chevron-right"></i></button>
  </div>

  <!-- Передача массива галереи в JS -->
  <script>
    window.portfolioMedia = <? echo json_encode($gallery_data, JSON_UNESCAPED_UNICODE); ?>;
  </script>

<?
endwhile;

get_footer();
