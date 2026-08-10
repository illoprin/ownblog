<?php
get_header();

/*
Template Name: Legal
 */

$title = get_the_title();
?>

<main id="top">

  <section class="section-hero py-5 section-left" id="hero">
    <div class="container">
      
      <!-- ================= ARTICLE HERO ================= -->
      <header class="section-head reveal">
        <span class="pill reveal badge-accent">
          <span class="dot"></span>Юридическая информация
        </span>
        <h2 class="section-title font-alt">
          <?= esc_html($title) ?>
        </h2>
        <p class="section-sub">
          Дата обновления:
          <strong><?= esc_html(get_the_modified_date('d.m.Y')) ?></strong>
        </p>
      </header>


      <!-- ================= ARTICLE CONTENT ================= -->
      <div class="reveal">
        <?php
        while (have_posts()) :
          the_post();
        ?>
          <article class="article-content">
            <?php the_content(); ?>
          </article>
        <?php
          wp_link_pages([
            'before' => '<div class="page-links mt-4">' . __('Страницы:', 'textdomain'),
            'after'  => '</div>',
          ]);
        endwhile;
        ?>
      </div>

      <div class="text-center mt-4 reveal">
        <a href="<?= esc_url(home_url('/')) ?>" class="btn btn-ghost">
          <i class="bi bi-arrow-left me-1"></i> Вернуться на главную
        </a>
      </div>
    </div>

  </section>

</main>

<?php get_footer(); ?>