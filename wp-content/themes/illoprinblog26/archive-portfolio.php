<?
get_header();

$categories = get_terms([
  'taxonomy' => 'portfolio_category',
  'hide_empty' => true,
]);

?>

<main id="top">

  <!-- ================= CASES HEADER ================= -->
  <section class="section pb-0">
    <div class="container">
      <p class="glass-crumbs text-start reveal">
        <a href="<? home_url('/') ?>">Главная</a>
        <span class="mx-1">/</span>
        <span class="text-dim">Кейсы</span>
      </p>

      <header class="section-head section-center reveal">
        <span class="badge badge-primary section-badge">
          портфолио
        </span>
        <h1 class="section-title font-alt">
          Все <span class="text-grad">кейсы</span>
        </h1>
        <p class="section-sub">
          Полный каталог проектов — от интернет-магазинов на WordPress
          до React-приложений и настройки серверов. Отфильтруйте по типу задачи.
        </p>
      </header>
    </div>
  </section>

  <!-- ================= FILTER + GRID ================= -->
  <section class="section pt-0">
    <div class="container">

      <div class="reveal">
        <!-- search box -->
        <div class="input-box-container cases-search-box">
          <i class="bi bi-search"></i>
          <input type="text" id="search"
            placeholder="Начните вводить ключевые слова...">
        </div>

        <!-- filters -->
        <div
          class="btn-group glass-selector mb-3"
          role="group"
          id="portfolio-category-container"
          aria-label="Категория портфолио">

          <!-- all -->
          <input
            type="radio"
            class="btn-check"
            name="btnradio"
            id="all"
            value="all"
            checked
          >
          <label
            class="btn btn-brand"
            for="all">Все</label>

          <!-- other categories -->
          <? if (!empty($categories) && !is_wp_error($categories)): ?>
            <?php foreach ($categories as $category) : ?>
              <input
                type="radio"
                class="btn-check"
                name="btnradio"
                id="<?= esc_html($category->slug) ?>"
                value="<?= esc_html($category->slug) ?>"
              >
              <label
                class="btn btn-brand"
                for="<?= esc_html($category->slug) ?>">
                <!-- name -->
                <?= esc_html($category->name) ?>
                <!-- count -->
                <span class="cat-count">
                  <?= $category->count ?>
                </span>
              </label>
            <? endforeach;?>
          <? endif;?>

        </div>
      </div>

      <!-- grid meta -->
      <p
        class="cases-meta reveal"
        id="cases-meta"></p>

      <div
        class="row g-4"
        id="portfolio-container">

        <?
        while (have_posts()) :
          the_post();

          // Получаем данные для передачи в шаблон карточки
          $post_id = get_the_ID();
          $title = get_the_title();
          $desc = get_the_content();

          // Получаем первую категорию проекта
          $categories = get_the_terms($post_id, 'portfolio_category');
          $category_name = '';
          $category_slug = '';
          if (!empty($categories) && !is_wp_error($categories)) {
            $category_name = $categories[0]->name;
            $category_slug = $categories[0]->slug;
          }

          // Получаем стек технологий
          $stack = get_the_terms($post_id, 'portfolio_stack');

          // Получаем статистику из Carbon Fields
          $stats = carbon_get_post_meta($post_id, 'stats');

          // Получаем URL изображения (первое изображение из медиа-галереи или thumbnail)
          $media_gallery = carbon_get_post_meta($post_id, 'media');
          $image_url = '';
          $image_alt = $title;

          if (!empty($media_gallery)) {
            $image_url = wp_get_attachment_image_url($media_gallery[0], 'large');
          } elseif (has_post_thumbnail()) {
            $image_url = get_the_post_thumbnail_url($post_id, 'large');
            $image_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
          }

          // Подготавливаем аргументы для передачи в шаблон
          $args = [
            'post_id'       => $post_id,
            'title'         => $title,
            'category_name' => $category_name,
            'category_slug' => $category_slug,
            'desc'          => $desc,
            'stack'         => $stack,
            'stats'         => $stats,
            'image_url'     => $image_url,
            'image_alt'     => $image_alt,
            'tilt'          => true, // Включаем 3D эффект наклона
            'reveal'        => false, // Выключаем эффект появления, т.к. появлением управляет cases.js
          ];

          // Подключаем шаблон карточки проекта
          get_template_part('template-parts/portfolio/portfolio-item', null, $args);

        endwhile;
        ?>
      </div>

      <!-- empty state -->
      <div
        class="cases-empty"
        id="cases-empty">
        <i class="bi bi-inboxes"></i>
        <p>В этой категории пока нет кейсов. Попробуйте выбрать другую.</p>
      </div>

    </div>
  </section>

  <!-- ================= CTA ================= -->
  <section class="section pt-0">
    <div class="container">
      <div class="glass panel text-center reveal">
        <h3 class="panel-title font-alt fs-2 fw-bold">
          Не нашли похожий <span class="text-grad">кейс?</span>
        </h3>
        <p class="text-dim mb-4">
          Расскажите о своей задаче — подскажу решение и оценю сроки.
        </p>
        <a
          href="<?= home_url('/#contact') ?>"
          class="btn btn-brand btn-lg">Обсудить проект <i class="bi bi-arrow-right ms-1"></i></a>
      </div>
    </div>
  </section>

</main>


<? get_footer() ?>