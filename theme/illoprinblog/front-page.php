<?php get_header() ?>

<main>
  <div class="hero__gradient_left"></div>
  <div class="hero__gradient_right"></div>
  <section id="hero" class="d-flex flex-column justify-content-start align-items-center gap-3">

    <div class="hero__contents">

      <h1 id="hero_title" class="d-block blog-title text-to-dark text-center">
        От идеи к реализации
      </h1>

      <div id="hero_contents" class="text-center mt-3">
        <p class="fs-5">
          Привет! Меня зовут <a href="#contacts" class="blog-link">Илья</a>.
          Я — веб-разработчик и дизайнер. Создаю веб-приложения, сайты и визуально выразительные интерфейсы.
        </p>
        <div class="d-flex gap-3 justify-content-center">
          <a href="#contacts" class="btn-glass">Связаться</a>
          <a href="#info" class="btn-glass">Узнать больше</a>
        </div>
      </div>

    </div>

  </section>

  <section id="info" class="text-center d-flex flex-column justify-content-center align-items-center gap-5">

    <h1 class="blog-title text-blue">
      Чем я могу быть полезен
    </h1>

    <div class="blog-wrapper d-flex flex-column gap-3">
      <div class="glass-panel">
        <span class="service-title">
          🧩 Нужен сайт под ключ
        </span>
        <span class="service-description">
          От дизайна и структуры до настройки и загрузки на хостинг. Сайт будет выглядеть современно, работать
          быстро
          и корректно на всех устройствах.
        </span>
      </div>
      <div class="glass-panel">
        <span class="service-title">
          🚀 Есть макет — нужна реализация
        </span>
        <span class="service-description">
          Сверстаю сайт точно по Figma-макету, добавлю адаптив, подключу клиенскую логику (форма, слайдеры, фильтры
          и
          т.п.), натяну на CMS.
        </span>
      </div>
      <div class="glass-panel">
        <span class="service-title">
          📦 Разработка MVP
        </span>
        <span class="service-description">
          Помогу быстро запустить первую версию продукта: сайт, веб-приложение или сервис. Фокус на скорости запуска
          и
          минимально нужной функциональности.
        </span>
      </div>
      <div class="glass-panel">
        <span class="service-title">
          🛎 Нужно автоматизировать рутину
        </span>
        <span class="service-description">
          Сделаю Telegram-бота, настрою выгрузку данных, автозаполнение или парсинг. Интеграции с CRM, платёжками,
          API
          — без лишней головной боли.
        </span>
      </div>
    </div>
  </section>

  <section id="portfolio" class="text-center d-flex flex-column justify-content-center align-items-center gap-5">
    <h1 class="blog-title text-blue">
      Кейсы
    </h1>

    <div class="blog-wrapper d-flex gap-3 blog-row">

    <!-- Featured cases -->
    <?php
    // Get featured cases
    $featured_cases = get_transient('featured_cases');
    
    if (false === $featured_cases) {
      $featured_cases = new WP_Query([
        'post_type' => 'portfolio_case',
        'meta_query' => [
          [
            'key' => "is_featured",
            'value' => 'yes',
          ],
        ],
        'orderby' => 'title',
        'order' => 'DESC',
      ]);
      set_transient('featured_cases', $featured_cases, DAY_IN_SECONDS);
    }

    if ($featured_cases->have_posts()):
      while($featured_cases->have_posts()):
        $featured_cases->the_post();
        $category = get_the_terms(get_the_ID(), 'case_category')[0] ?? null;
    ?>
      <div class="glass-panel p-0 d-flex flex-column">
        <img
          class="portfolio-image"
          src="<? the_post_thumbnail_url() ?>"
          alt="case-image"
        >
        <div class="p-3">
          <div class="service-title">
            <? the_title() ?>
          </div>
          <? if ($category): ?>
            <div class="case-badge rounded-5 p-1 mt-3">
              <? echo $category->name ?>
            </div>
          <? endif ?>

        </div>

        <div class="p-3 mt-auto">
          <button
            class="btn-glass"
            onclick="handleCaseDetailsButton('<? the_permalink() ?>')"
          >
            Подробнее
          </button>
        </div>

      </div>
      <? endwhile ?>
    <? else: ?>
      <h2 class="fs-5 fw-bold">
        Нет избранных кейсов
      </h2>
    <? endif ?>

    </div>

    <a class="btn-glass btn" href="<? echo get_post_type_archive_link("portfolio_case")?>">
      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <path stroke="gray" stroke-linecap="round" stroke-width="2" d="M6 12h.01m6 0h.01m5.99 0h.01" />
      </svg>
      Смотреть больше
    </a>

  </section>

  <section id="stack" class="text-center d-flex flex-column justify-content-center align-items-center gap-5">
    <h1 class="blog-title text-blue">
      Технологический стек
    </h1>
    <div class="d-flex blog-row gap-4">
      <div>
        <p class="fs-5 m-0 mb-3">
          Frontend
        </p>

        <div class="glass-panel d-flex gap-3 flex-column">
          <div class="glass-panel-nohover p-3">
            React
          </div>
          <div class="glass-panel-nohover p-3">
            Tailwind CSS
          </div>
          <div class="glass-panel-nohover p-3">
            Bootstrap 5
          </div>
          <div class="glass-panel-nohover p-3">
            Typescript
          </div>
        </div>
      </div>

      <div>
        <p class="fs-5 m-0 mb-3">
          Backend
        </p>

        <div class="glass-panel d-flex gap-3 flex-column">
          <div class="glass-panel-nohover p-3">
            WordPress
          </div>
          <div class="glass-panel-nohover p-3">
            Python
          </div>
          <div class="glass-panel-nohover p-3">
            Node.js
          </div>
          <div class="glass-panel-nohover p-3">
            Golang
          </div>
        </div>
      </div>
      <div>
        <p class="fs-5 m-0 mb-3">
          Databases
        </p>

        <div class="glass-panel d-flex gap-3 flex-column">
          <div class="glass-panel-nohover p-3">
            MongoDB
          </div>
          <div class="glass-panel-nohover p-3">
            mySQL
          </div>
          <div class="glass-panel-nohover p-3">
            Redis
          </div>
          <div class="glass-panel-nohover p-3">
            PostgreSQL
          </div>
        </div>
      </div>
      <div>
        <p class="fs-5 m-0 mb-3">
          DevOps
        </p>

        <div class="glass-panel d-flex gap-3 flex-column">
          <div class="glass-panel-nohover p-3">
            Docker
          </div>
          <div class="glass-panel-nohover p-3">
            Git
          </div>
          <div class="glass-panel-nohover p-3">
            Nginx
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <section id="contacts" class="text-center d-flex flex-column justify-content-center align-items-center gap-5">
    <h1 class="blog-title text-blue">
      Связаться
    </h1>
    <p>
      Готов обсудить ваш проект и предложить оптимальные решения
    </p>
    <div class="d-flex gap-3 blog-row">
      <a href="https://t.me/illoprin" class="btn-glass d-flex align-items-center justify-content-center gap-2">
        <!-- Telegram SVG -->
        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M12 4C10.4178 4 8.87103 4.46919 7.55544 5.34824C6.23985 6.22729 5.21447 7.47672 4.60897 8.93853C4.00347 10.4003 3.84504 12.0089 4.15372 13.5607C4.4624 15.1126 5.22433 16.538 6.34315 17.6569C7.46197 18.7757 8.88743 19.5376 10.4393 19.8463C11.9911 20.155 13.5997 19.9965 15.0615 19.391C16.5233 18.7855 17.7727 17.7602 18.6518 16.4446C19.5308 15.129 20 13.5823 20 12C20 9.87827 19.1571 7.84344 17.6569 6.34315C16.1566 4.84285 14.1217 4 12 4ZM15.93 9.48L14.62 15.67C14.52 16.11 14.26 16.21 13.89 16.01L11.89 14.53L10.89 15.46C10.8429 15.5215 10.7824 15.5715 10.7131 15.6062C10.6438 15.6408 10.5675 15.6592 10.49 15.66L10.63 13.66L14.33 10.31C14.5 10.17 14.33 10.09 14.09 10.23L9.55 13.08L7.55 12.46C7.12 12.33 7.11 12.03 7.64 11.83L15.35 8.83C15.73 8.72 16.05 8.94 15.93 9.48Z"
            fill="#ffffff" />
        </svg>
        Telegram
      </a>
      <a href="https://kwork.ru/user/ilyakuntsevich"
        class="btn-glass d-flex align-items-center justify-content-center gap-2">
        <!-- Kwork SVG -->
        <svg width="16" height="17" viewBox="0 0 24 25" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M7.73753 2.66698L7.77997 5.28525L5.1725 8.41361L2.56503 11.5418L2.52368 7.36918L2.48233 3.19641H1.24116H0V1.68658C0 0.856051 0.0478803 0.129469 0.106332 0.071582C0.164783 0.0138486 1.89626 -0.0148647 3.95388 0.00770665L7.69509 0.0487033L7.73753 2.66698Z"
            fill="#FF9F05" />
          <path
            d="M22.7555 1.00837C22.3397 1.49388 20.3884 3.75685 18.4192 6.03701C13.3299 11.9306 13.4776 11.748 13.6156 11.9767C13.6828 12.0878 15.3129 14.1136 17.2379 16.4782C20.7875 20.8381 23.7211 24.4586 23.9875 24.8081C24.1034 24.9601 23.4405 25 20.7954 25H17.4571L15.6028 22.5816C11.1159 16.7295 9.89744 15.1738 9.80961 15.185C9.75815 15.1916 9.3137 15.6716 8.82215 16.2517L7.92827 17.3066V21.1534V25H5.20779H2.4873V21.4109V17.8217L9.64156 8.97359L16.7958 0.125477H20.1538H23.5117L22.7555 1.00837Z"
            fill="white" />
        </svg>
        KWork
      </a>
      <a href="https://github.com/illoprin" class="btn-glass d-flex align-items-center justify-content-center gap-2">
        <!-- Github SVG -->
        <svg width="22px" height="22px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
          xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="Page-1" stroke="none" stroke-width="1" fill-rule="evenodd">
            <g id="Dribbble-Light-Preview" transform="translate(-140.000000, -7559.000000)" fill="#ffffff">
              <g id="icons" transform="translate(56.000000, 160.000000)">
                <path
                  d="M94,7399 C99.523,7399 104,7403.59 104,7409.253 C104,7413.782 101.138,7417.624 97.167,7418.981 C96.66,7419.082 96.48,7418.762 96.48,7418.489 C96.48,7418.151 96.492,7417.047 96.492,7415.675 C96.492,7414.719 96.172,7414.095 95.813,7413.777 C98.04,7413.523 100.38,7412.656 100.38,7408.718 C100.38,7407.598 99.992,7406.684 99.35,7405.966 C99.454,7405.707 99.797,7404.664 99.252,7403.252 C99.252,7403.252 98.414,7402.977 96.505,7404.303 C95.706,7404.076 94.85,7403.962 94,7403.958 C93.15,7403.962 92.295,7404.076 91.497,7404.303 C89.586,7402.977 88.746,7403.252 88.746,7403.252 C88.203,7404.664 88.546,7405.707 88.649,7405.966 C88.01,7406.684 87.619,7407.598 87.619,7408.718 C87.619,7412.646 89.954,7413.526 92.175,7413.785 C91.889,7414.041 91.63,7414.493 91.54,7415.156 C90.97,7415.418 89.522,7415.871 88.63,7414.304 C88.63,7414.304 88.101,7413.319 87.097,7413.247 C87.097,7413.247 86.122,7413.234 87.029,7413.87 C87.029,7413.87 87.684,7414.185 88.139,7415.37 C88.139,7415.37 88.726,7417.2 91.508,7416.58 C91.513,7417.437 91.522,7418.245 91.522,7418.489 C91.522,7418.76 91.338,7419.077 90.839,7418.982 C86.865,7417.627 84,7413.783 84,7409.253 C84,7403.59 88.478,7399 94,7399"
                  id="github-[#142]">
                </path>
              </g>
            </g>
          </g>
        </svg>
        GitHub
      </a>
    </div>
  </section>
</main>

<div id="scroll-top" class="btn-glass btn-scroll-top">
  <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
    height="24" fill="none" viewBox="0 0 24 24">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="m5 15 7-7 7 7" />
  </svg>
</div>

<script>
  function handleCaseDetailsButton(url) {
    window.location.href = url;
  }
</script>

<script src="<? echo get_template_directory_uri() ?>/js/btn-scroll-top.js"></script>

<?php get_footer() ?>