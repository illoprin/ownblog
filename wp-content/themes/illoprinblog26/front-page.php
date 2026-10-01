<?
get_header();

$count = wp_count_posts('portfolio')->publish;
$count = wp_count_posts('portfolio')->publish;
?>

<main id="top">

  <!-- ================= HERO ================= -->
  <section class="section-hero" id="hero">
    <div class="container">
      <div class="row align-items-center g-5 flex-column flex-lg-row">
        <!-- left -->
        <div class="col-12 col-lg-6 text-center text-lg-start">
          <span class="pill reveal glass"><span class="dot"></span>Свободен для новых проектов
          </span>

          <h1 class="hero-title font-alt mt-3 reveal">
            Илья —
            <span class="text-grad">веб-разработчик</span>
          </h1>

          <p class="hero-typing font-alt reveal">
            <span class="text-mute">&lt;</span><span id="typing"></span><span class="caret"></span><span
              class="text-mute">/&gt;</span>
          </p>

          <p class="hero-lead reveal">
            Веду проект целиком —
            <span class="text-primary">от идеи к готовому решению</span>:
            обсуждаем задачу, проектирую, пишу код, разворачиваю на сервере
            и остаюсь на связи после запуска.
          </p>

          <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start mt-4 reveal">
            <a href="#contact" class="btn btn-brand btn-lg">
              Связаться<i class="bi bi-arrow-right ms-1"></i>
            </a>
            <a href="#portfolio" class="btn btn-ghost btn-lg">Портфолио</a>
          </div>

          <div class="row row-cols-3 g-3 mt-4 hero-stats reveal">
            <div class="col">
              <div class="stat-num font-alt text-accent">5.0 ★</div>
              <div class="stat-cap">
              рейтинг <a href="https://kwork.ru/user/illoprin" class="link-primary">Kwork</a>
              </div>
            </div>
            <div class="col">
              <div class="stat-num font-alt text-accent"><?= $count ?></div>
              <div class="stat-cap">кейсов портфолио</div>
            </div>
            <div class="col">
              <div class="stat-num font-alt text-accent">94</div>
              <div class="stat-cap">средний PageSpeed</div>
            </div>
          </div>
        </div>

        <!-- right -->
        <div class="col-12 col-lg-6">
          <div class="avatar-wrap mx-auto reveal">
            <div class="avatar-ring"></div>
            <div class="avatar glass">
              <img src="<?= get_template_directory_uri() . '/assets/static/avatar.webp' ?>" alt="Илья — веб-разработчик" loading="lazy" />
            </div>

            <span class="float-badge glass fb--1"><img
                src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/wordpress/wordpress-plain.svg" alt="" />
              WordPress</span>
            <span class="float-badge glass fb--2"><img
                src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" alt="" />
              React</span>
            <span class="float-badge glass fb--3"><img
                src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg" alt="" />
              Node.js</span>
            <span class="float-badge glass fb--4"><img
                src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/typescript/typescript-original.svg" alt="" />
              TypeScript</span>
            <span class="float-badge glass fb--5"><img
                src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg" alt="" />
              Docker</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= 4. TECH MARQUEE ================= -->
  <section class="marquee-strip" aria-label="Стек технологий">
    <div class="marquee">
      <div class="marquee-track marquee-track slow">
        <span class="tech-item"><img
            src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/wordpress/wordpress-plain.svg"
            alt="" />WordPress</span>
        <span class="tech-item"><img
            src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/woocommerce/woocommerce-original.svg"
            alt="" />WooCommerce</span>
        <span class="tech-item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg"
            alt="" />PHP</span>
        <span class="tech-item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg"
            alt="" />React</span>
        <span class="tech-item"><img
            src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/typescript/typescript-original.svg"
            alt="" />TypeScript</span>
        <span class="tech-item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mobx/mobx-original.svg"
            alt="" />MobX</span>
        <span class="tech-item"><img
            src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg"
            alt="" />Node.js</span>
        <span class="tech-item"><img
            src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/express/express-original.svg"
            alt="" />Express</span>
        <span class="tech-item"><img
            src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg"
            alt="" />PostgreSQL</span>
        <span class="tech-item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg"
            alt="" />MySQL</span>
        <span class="tech-item"><img
            src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg" alt="" />Docker</span>
        <span class="tech-item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nginx/nginx-original.svg"
            alt="" />Nginx</span>
        <span class="tech-item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/linux/linux-original.svg"
            alt="" />Linux</span>
        <span class="tech-item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/figma/figma-original.svg"
            alt="" />Figma</span>
      </div>
    </div>
  </section>

  <!-- ================= SERVICES ================= -->
  <section id="services" class="section">
    <div class="container">
      <header class="section-head reveal">
        <span class="badge badge-primary section-badge">
          Услуги
        </span>
        <h2 class="section-title font-alt">
          С чем могу
          <span class="text-grad">помочь?</span>
        </h2>
        <p class="section-sub">
          Соберу решение под ваш проект или доведу существующий до ума. Сомневаетесь в выборе, расскажите о проекте, разберёмся.
        </p>
      </header>

      <div class="row g-4" id="service-container">
        <? get_template_part('template-parts/services/service-section') ?>
      </div>
    </div>
  </section>


  <!-- ================= HOW I WORK ================= -->
  <section id="workflow" class="section">
    <div class="container">
      <header class="section-head section-center reveal">
        <span class="badge badge-primary section-badge">этапы</span>
        <h2 class="section-title font-alt">
          Как я <span class="text-grad">работаю</span>
        </h2>
        <p class="section-sub">
          Понятные этапы, согласования и контроль результата — вы всегда знаете, что происходит с проектом.
        </p>
      </header>

      <ol class="workflow-list">
        <li class="workflow-item reveal reveal-left">
          <div class="workflow-content glass">
            <span class="fw-bold workflow-number font-alt">01</span>
            <div class="workflow-body">
              <h3 class="font-alt">Бриф</h3>
              <p>
                Обсуждаем цель сайта и референсы. Отвечаю и присылаю примерную оценку в течение дня.
              </p>
            </div>
          </div>
        </li>
        <li class="workflow-item reveal reveal-right">
          <div class="workflow-content glass">
            <span class="fw-bold workflow-number font-alt">02</span>
            <div class="workflow-body">
              <h3 class="font-alt">Смета</h3>
              <p>
                Фиксирую в тексте, что делаю, за какие деньги и в какой срок.
              </p>
            </div>
          </div>
        </li>
        <li class="workflow-item reveal reveal-left">
          <div class="workflow-content glass">
            <span class="fw-bold workflow-number font-alt">03</span>
            <div class="workflow-body">
              <h3 class="font-alt">Прототип</h3>
              <p>
                Показываю структуру и внешний вид до начала кода.
              </p>
            </div>
          </div>
        </li>
        <li class="workflow-item reveal reveal-right">
          <div class="workflow-content glass">
            <span class="fw-bold workflow-number font-alt">04</span>
            <div class="workflow-body">
              <h3 class="font-alt">Разработка</h3>
              <p>
                Промежуточные показы в коротких видео.
              </p>
            </div>
          </div>
        </li>
        <li class="workflow-item reveal reveal-left">
          <div class="workflow-content glass">
            <span class="fw-bold workflow-number font-alt">05</span>
            <div class="workflow-body">
              <h3 class="font-alt">Запуск</h3>
              <p>
                Размещаю на сервер, передаю доступы и записываю короткую инструкцию.
              </p>
            </div>
          </div>
        </li>
      </ol>
    </div>
  </section>

  <!-- ================= PORTFOLIO ================= -->
  <section id="portfolio" class="section">
    <div class="container">

      <header class="section-head section-center reveal">
        <span class="badge badge-primary section-badge">
          портфолио
        </span>
        <h2 class="section-title font-alt">
          Что уже <span class="text-grad">сделано</span>
        </h2>
        <p class="section-sub">
          Несколько проектов, где результат можно увидеть вживую.
        </p>
      </header>


      <div class="row g-4" id="portfolio-container">
        <? get_template_part('template-parts/portfolio/portfolio-favorite') ?>
      </div>

      <div class="mt-5 text-center reveal">
        <a href="<?= get_post_type_archive_link('portfolio') ?>" class="btn btn-primary font-alt">
          Смотреть больше <i class="bi bi-arrow-up-right"></i>
        </a>
      </div>

    </div>
  </section>

  <!-- ============= ILLOPRIN WEBDEV MARQUEE ============= -->
  <section>
    <div class="marquee-strip marquee reveal">
      <div class="marquee-track slow d-flex gap-3">
        <span class="font-alt fw-normal big-title text-uppercase text-mute">
          illoprin • web-dev •
        </span>

        <span class="font-alt fw-normal big-title text-uppercase text-mute">
          illoprin • web-dev •
        </span>
      </div>
    </div>
  </section>

  <? get_template_part('template-parts/lead-form') ?>

</main>

<? get_footer() ?>