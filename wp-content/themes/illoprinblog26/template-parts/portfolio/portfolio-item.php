<?php

// Защита от прямого доступа и отсутствия данных
if (!isset($args) || empty($args)) {
  return;
}

$post_id = $args['post_id'] ?? '';

$title = $args['title'] ?? '';
$cat = $args['category_name'] ?? '';
$cat_slug = $args['category_slug'] ?? '';
$desc = $args['desc'] ?? '';

$stack = $args['stack'] ?? array();
$stats = $args['stats'] ?? array();

$image_alt = $args['image_alt'] ?? '';
$image_url = $args['image_url'] ?? '';

$has_tilt = $args['tilt'] ?? false;
$has_reveal = $args['reveal'] ?? false;

?>

<div class="pf-col col-12 col-lg-4 <?= $has_reveal ? 'reveal' : '' ?> ?>" data-cat=<?= esc_html($cat_slug) ?>>
  <!-- 3d hover effect wrapper -->
  <? if ($has_tilt): ?> <div class="tilt h-100"> <? endif; ?>

    <article class="card d-flex flex-column card-portfolio glass h-100 spotlight">

      <!-- media -->
      <div class="card-media pf-media">
        <span class="badge pf-category">
          <?= esc_html($cat); ?>
        </span>

        <?php if (!empty($image_url)): ?>
          <img
            src="<?= esc_url($image_url); ?>"
            alt="<?= esc_attr($image_alt); ?>"
            loading="lazy" />
        <?php endif; ?>

        <div class="pf-overlay d-none d-lg-flex">
          <a
            href="<?= esc_url(get_permalink($post_id)); ?>"
            class="btn btn-brand btn-sm font-alt">
            Подробнее
            <i class="bi bi-arrow-up-right"></i>
          </a>
        </div>
      </div>

      <!-- body -->
      <div class="card-body position-relative">

        <!-- title -->
        <h3 class="card-title font-alt" id="pf-title">
          <?= esc_html($title); ?>
        </h3>

        <!-- description -->
        <p class="text-dim" id="pf-body">
          <?= wp_kses_post($desc); ?>
        </p>

        <!-- stack -->
        <?php if (!empty($stack) && !is_wp_error($stack)): ?>
          <div class="d-flex flex-wrap gap-2 mb-3">
            <?php foreach ($stack as $technology): ?>
              <div class="badge badge-light">
                <?= esc_html($technology->name); ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <!-- footer -->
        <div class="card-footer mt-auto">
          <?php if (!empty($stats)): ?>
            <div class="pf-stats">
              <? foreach ($stats as $stat):
                $stat_arr = lp_parse_case_stat($stat['stat_value']);
              ?>
                <span class="pf-stat-item">
                  <? if (count($stat_arr) == 2): ?>
                    <strong><?= wp_kses_post($stat_arr[0]); ?></strong>
                    <?= wp_kses_post($stat_arr[1]); ?>
                  <? else: ?>
                    <?= wp_kses_post($stat_arr[1]); ?>
                  <? endif;?>
                </span>
              <? endforeach; ?>
            </div>
          <?php endif; ?>

          <a
            href="<?= esc_url(get_permalink($post_id)); ?>"
            class="btn btn-ghost d-lg-none">
            Подробнее
            <i class="bi bi-arrow-up-right"></i>
          </a>
        </div>
      </div>
    </article>
  <? if ($has_tilt): ?> </div> <? endif; ?>

</div>