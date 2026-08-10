<!doctype html>
<html <? language_attributes() ?>>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

  <title>Илья — веб-разработчик | От идеи к готовому решению</title>

  <? wp_head() ?>

</head>

<body <? body_class() ?>>

  <!-- ================= BACKGROUND FX ================= -->
  <div class="bg-fx" aria-hidden="true">
    <span class="blob blob--1"></span>
    <span class="blob blob--2"></span>
    <span class="blob blob--3"></span>
    <span class="grid-overlay"></span>
  </div>

  <!-- ================= GO TOP BUTTON ================= -->
  <a href="#hero" class="to-top" id="toTop" aria-label="Наверх">↑</a>

  <!-- =============== SCROLL PROGRESS BAR =============== -->
  <div class="scroll-progress-container">
    <div class="scroll-progress-bar"></div>
  </div>

  <? if (is_front_page()) get_template_part('template-parts/marquee-banner') ?>

  <!-- ================= NAV ================= -->
  <nav class="site-nav" id="siteNav">
    <div class="container position-relative">
      <div class="nav-inner d-flex align-items-center justify-content-between gap-3">
        <a
          class="nav-logo font-alt"
          href="<?= home_url('/#hero') ?>">
          illoprin<span class="text-accent">.</span>
        </a>

        <ul class="nav-links d-none d-md-flex align-items-center gap-1 list-unstyled m-0">
          <li><a href="<?= home_url('/#services') ?>">Услуги</a></li>
          <li><a href="<?= home_url('/#portfolio') ?>">Портфолио</a></li>
          <li><a href="<?= home_url('/#contact') ?>">Связаться</a></li>
        </ul>

        <div class="d-flex align-items-center gap-2">
          <a href="#contact" class="btn btn-primary d-none btn-sm d-sm-inline-flex">Обсудить проект</a>
          <button class="btn btn-ghost btn-sm d-md-none" id="navToggle" aria-label="Меню" aria-expanded="false">
            <i class="bi bi-list"></i>
          </button>
        </div>
      </div>

      <!-- mobile dropdown -->
      <div class="nav-mobile glass d-md-none" id="navMobile">
        <a href="<?= home_url('/#services') ?>">Услуги</a>
        <a href="<?= home_url('/#portfolio') ?>">Портфолио</a>
        <a href="<?= home_url('/#contact') ?>">Связаться</a>
      </div>
    </div>
  </nav>