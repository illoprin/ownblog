<?

$portfolio_items = [
  [
    "id" => 1,
    "category" => "wp",
    "media" => [
      "https://placehold.co/600x400/2d90cf/EAEAEA?font=montserrat&text=Olhon+Main",
      "https://placehold.co/600x400/181818/EAEAEA?font=montserrat&text=Catalog+Page",
      "https://placehold.co/600x400/e17c33/EAEAEA?font=montserrat&text=Checkout+Mobile",
    ],
    "title" => "Магазин мебели «Ольхон»",
    "body" => "WooCommerce-магазин на 1200 SKU: кастомная фильтрация, геопозиционирование доставки, онлайн-оплата и синхронизация с 1С в реальном времени.",
    "task" => "Крупный ритейлер мебели переходил с шаред-хостинга и типового шаблона на полноценный интернет-магазин. Каталог — свыше **1200 SKU** с вариациями по материалу, размеру и цвету, а старая витрина не справлялась с нагрузкой и не считала доставку по регионам.

Основные требования клиента:
- Гибкая фильтрация каталога без перезагрузки страницы
- Расчёт стоимости доставки по геопозиции покупателя
- Приём онлайн-оплаты прямо на сайте
- Остатки и цены должны синхронизироваться с 1С в реальном времени",
    "solution" => "Взял WooCommerce как ядро и построил кастомную тему без лишнего конструкторного кода.

- Настроил **ACF Pro** для гибких характеристик товаров и связал их с фильтром на AJAX
- Подключил геолокацию и калькулятор доставки по API транспортных компаний
- Интегрировал **Ю.Kassa** для приёма онлайн-оплаты
- Написал модуль синхронизации с 1С через REST — остатки обновляются каждые 15 минут
- Развернул проект в **Docker** на выделенном Linux VPS",
    "stack" => ["WordPress", "ACF Pro", "WooCommerce", "Docker", "Linux VPS", "Ю.Kassa API"],
    "stats" => [
      "**+4 000** клиентов",
      "**>90** PageSpeed",
      "**x2.5 рост** конверсии"
    ],
    "favourite" => true,
  ],
  [
    "id" => 2,
    "category" => "react",
    "media" => [
      "https://placehold.co/600x400/2d90cf/EAEAEA?font=montserrat&text=Dashboard+UI",
      "https://placehold.co/600x400/181818/EAEAEA?font=montserrat&text=Analytics+Chart",
      "https://placehold.co/600x400/e17c33/EAEAEA?font=montserrat&text=Dark+Mode"
    ],
    "title" => "Личный кабинет фитнес-сети «FitSpace»",
    "body" => "SPA-приложение для клиентов сети: онлайн-запись на тренировки, покупка абонементов, заморозка карт и расписание с гибкой фильтрацией.",
    "task" => "Сеть фитнес-клубов росла быстрее, чем справлялась старая админка. Нужен был личный кабинет для клиентов: смотреть расписание, записываться на тренировки, покупать и замораживать абонементы.

Ключевые требования:
- Быстрый и отзывчивый интерфейс (SPA)
- Гибкое расписание с фильтрацией по клубу, направлению и тренеру
- Поддержка тёмной темы и офлайн-доступности (PWA)",
    "solution" => "Собрал SPA на **React + TypeScript** с состоянием на **MobX**.

- Спроектировал компонентную библиотеку на **Tailwind CSS**
- Реализовал фильтрацию расписания с мемоизацией
- Подключил REST API к оплате абонементов и заморозке карт
- Настроил **PWA**: офлайн-кэш расписания и push-уведомления",
    "stack" => ["React", "TypeScript", "MobX", "Tailwind CSS", "REST API", "PWA"],
    "stats" => [
      "**15k+** MAU",
      "**0.8с** время загрузки",
      "**100%** адаптивность"
    ],
    "favourite" => false,
  ],
  [
    "id" => 3,
    "category" => "node",
    "media" => [
      "https://placehold.co/600x400/181818/EAEAEA?font=montserrat&text=Bot+Interface",
      "https://placehold.co/600x400/e17c33/EAEAEA?font=montserrat&text=Admin+Panel",
      "https://placehold.co/600x400/2d90cf/EAEAEA?font=montserrat&text=Architecture"
    ],
    "title" => "Telegram-бот бронирования для ресторана «Gusto»",
    "body" => "Автоматизированная система бронирования столов через Telegram с выбором даты, времени, посадкой по схеме зала и напоминаниями.",
    "task" => "Ресторан терял брони из-за загруженной телефонной линии в вечерние часы. Задача: автоматизировать бронирование через Telegram, показывать схему зала и снизить нагрузку на администратора.",
    "solution" => "Написал Telegram-бота на **Node.js + Telegraf** с пошаговым сценарием выбора стола.

- Хранение броней и схемы зала — **PostgreSQL** с **Prisma ORM**
- Настроил автоматические напоминания за 2 часа до визита
- Собрал удобную админ-панель для менеджеров смены
- Задеплоил в **Docker**-контейнере с авто-перезапуском",
    "stack" => ["Node.js", "TypeScript", "Telegraf", "PostgreSQL", "Prisma", "Docker"],
    "stats" => [
      "**300+** броней/день",
      "**-80%** нагрузки на админа"
    ],
    "favourite" => true,
  ],
  [
    "id" => 4,
    "category" => "vps",
    "media" => [
      "https://placehold.co/600x400/0f172a/EAEAEA?font=montserrat&text=Server+Architecture",
      "https://placehold.co/600x400/334155/EAEAEA?font=montserrat&text=Nginx+Cluster",
      "https://placehold.co/600x400/475569/EAEAEA?font=montserrat&text=Grafana+Dashboard"
    ],
    "title" => "Настройка отказоустойчивого VPS-кластера для EdTech платформы",
    "body" => "Миграция обучающего сервиса с шаред-хостинга на Linux VPS с балансировкой нагрузки, Nginx, Redis и мониторингом Grafana.",
    "task" => "Онлайн-школа падала во время проведения вебинаров и массовых распродаж курсов (до 3000 одновременных пользователей). Требовалось настроить изолированное серверное окружение с защитой от сбоев.",
    "solution" => "Сконфигурировал связку из 2 VPS под управлением Ubuntu Server:

- Настроил **Nginx** в качестве Reverse Proxy и балансировщика
- Установил **Redis** для кеширования сессий и тяжелых БД-запросов
- Настроил автобэкапы базы данных в S3-хранилище каждые 6 часов
- Подключил **Prometheus + Grafana** для мониторинга нагрузки CPU/RAM в реальном времени
- Настроил **UFW** фаервол и защиту от брутфорса **Fail2ban**",
    "stack" => ["Ubuntu Linux", "Nginx", "Redis", "Docker Compose", "Grafana", "UFW"],
    "stats" => [
      "**99.99%** Uptime",
      "До **5 000** RPS",
      "**0** падений в пики"
    ],
    "favourite" => true,
  ],
  [
    "id" => 5,
    "category" => "fix",
    "media" => [
      "https://placehold.co/600x400/7c2d12/EAEAEA?font=montserrat&text=Bug+Fixing",
      "https://placehold.co/600x400/9a3412/EAEAEA?font=montserrat&text=Code+Refactoring"
    ],
    "title" => "Устранение ошибок оформления заказа и чекаута на WooCommerce",
    "body" => "Аудит и исправление критических багов в чекауте, конфликтов плагинов и утечки памяти при интеграции со сторонней CRM.",
    "task" => "В интернет-магазине одежды отваливалась кнопка «Оформить заказ» у 15% мобильных пользователей. Заявки терялись, а сайт выдавал ошибку 500 при отправке данных в CRM.",
    "solution" => "Провел комплексный отладку проекта:

- Выявил конфликт скриптов между плагином кастомных полей и темы оформления
- Переписал устаревшие обработчики `jQuery` на чистый **Vanilla JS**
- Исправил утечку памяти в PHP-скрипте интеграции с CRM
- Оптимизировал REST API хуки WooCommerce, уменьшив время отклика корзины",
    "stack" => ["PHP", "WooCommerce", "JavaScript", "WordPress Hooks", "REST API"],
    "stats" => [
      "**100%** работающий чекаут",
      "**-60%** брошенных корзин"
    ],
    "favourite" => false,
  ],
  [
    "id" => 6,
    "category" => "opt",
    "media" => [
      "https://placehold.co/600x400/065f46/EAEAEA?font=montserrat&text=PageSpeed+100",
      "https://placehold.co/600x400/047857/EAEAEA?font=montserrat&text=SEO+Structure"
    ],
    "title" => "Комплексная SEO-оптимизация и ускорение портала недвижимости",
    "body" => "Оптимизация Core Web Vitals с 24 до 95 баллов, генерация динамического Sitemap, микроразметка Schema.org и устранение дублей страниц.",
    "task" => "Крупный каталог недвижимости терял позиции в Google и Yandex из-за долгой загрузки тяжёлых фото картинок (8+ секунд) и отсутствия корректной микроразметки объявлений.",
    "solution" => "Провел глубокую оптимизацию производительности и SEO:

- Настроил автоматическую конвертацию всех изображений в формат **AVIF / WebP**
- Внедрил инлайн-критический CSS и отложенную загрузку JavaScript
- Настроил генератор **Schema.org/RealEstateAgent** для улучшенных сниппетов в поиске
- Очистил базу данных от 50 000+ битых ссылок и дубликатов страниц",
    "stack" => ["Core Web Vitals", "WebP/AVIF", "Schema.org", "Nginx Cache", "SEO Audit"],
    "stats" => [
      "**95+** Google PageSpeed",
      "**x3.2** органика из поиска",
      "**1.1с** LCP показатель"
    ],
    "favourite" => true,
  ],
  [
    "id" => 7,
    "category" => "wp",
    "media" => [
      "https://placehold.co/600x400/1e3a8a/EAEAEA?font=montserrat&text=Clinic+Home",
      "https://placehold.co/600x400/1d4ed8/EAEAEA?font=montserrat&text=Doctor+Schedule"
    ],
    "title" => "Корпоративный портал медицинского центра «VitaMed»",
    "body" => "Сайт клиники на WordPress с каталогом услуг, расписанием врачей, онлайн-записью и интеграцией с МИС Медиалог.",
    "task" => "Медицинскому центру требовался современный сайт, соответствующий законодательству, с удобным поиском врачей по специализациям и записью на приём в реальном времени.",
    "solution" => "Разработал кастомную тему WordPress без использования тяжёлых билдеров:

- Использовал **Gutenberg + ACF Blocks** для создания уникального редактора страниц
- Написал кастомный плагин синхронизации расписания врачей с МИС клиники
- Реализовал удобный поиск с подсказками (Live Search)
- Верстка полностью адаптирована для слабовидящих (требование Минздрава)",
    "stack" => ["WordPress", "Gutenberg", "ACF Blocks", "PHP 8.2", "REST API"],
    "stats" => [
      "**+120%** записей с сайта",
      "Соответствие ФЗ-152"
    ],
    "favourite" => false,
  ],
  [
    "id" => 8,
    "category" => "react",
    "media" => [
      "https://placehold.co/600x400/581c87/EAEAEA?font=montserrat&text=Trading+Terminal",
      "https://placehold.co/600x400/6b21a8/EAEAEA?font=montserrat&text=Orderbook+UI"
    ],
    "title" => "Аналитический терминал для крипто-трейдинга «CryptoPulse»",
    "body" => "Реального времени веб-интерфейс на React и WebSockets для отслеживания котировок, стакана ордеров и движения ликвидности.",
    "task" => "Заказчику требовался быстрый веб-терминал, способный отрисовывать до 100 обновлений котировок в секунду без лагов интерфейса и просадок FPS.",
    "solution" => "Собрал высокопроизводительное SPA на **React 18**:

- Настроил **WebSockets** соединение с автоматическим переподключением
- Использовал Canvas-библиотеки для рендеринга графиков свечей
- Применил виртуализацию списков (**React-Window**) для таблицы ордеров
- Настроил стейт-менеджмент на **Zustand** с разделением потоков данных",
    "stack" => ["React", "TypeScript", "Zustand", "WebSockets", "Tailwind CSS", "Canvas"],
    "stats" => [
      "**60 FPS** плавность",
      "**<10ms** задержка данных"
    ],
    "favourite" => true,
  ],
  [
    "id" => 9,
    "category" => "node",
    "media" => [
      "https://placehold.co/600x400/312e81/EAEAEA?font=montserrat&text=API+Architecture",
      "https://placehold.co/600x400/3730a3/EAEAEA?font=montserrat&text=Microservices"
    ],
    "title" => "REST API микросервис обработки платежей и подписок",
    "body" => "Backend на Node.js (NestJS) для работы с чеками, рекуррентными платежами, webhook-обработчиками и генерацией PDF-инвойсов.",
    "task" => "SaaS-сервису требовалось выделить платежную логику в отдельный изолированный и защищенный микросервис с поддержкой нескольких платежных шлюзов.",
    "solution" => "Разработал архитектуру микросервиса на **NestJS + TypeScript**:

- Реализовал очереди задач через **BullMQ + Redis** для фоновой обработки чеков
- Подключил API Stripe, PayPal и ЮKassa с единым универсальным интерфейсом
- Написал генератор электронных чеков и инвойсов в PDF
- Покрыл код интеграционными тестами (**Jest**) на 85%",
    "stack" => ["Node.js", "NestJS", "TypeScript", "Redis", "BullMQ", "PostgreSQL", "Jest"],
    "stats" => [
      "**99.9%** надежность транзакций",
      "**10k+** чеков в день"
    ],
    "favourite" => false,
  ],
  [
    "id" => 10,
    "category" => "vps",
    "media" => [
      "https://placehold.co/600x400/831843/EAEAEA?font=montserrat&text=Docker+Deploy",
      "https://placehold.co/600x400/9d174d/EAEAEA?font=montserrat&text=GitLab+CI/CD"
    ],
    "title" => "Настройка CI/CD пайплайна и Docker-окружения для стартапа",
    "body" => "Автоматизация сборки и деплоя проектов через GitLab CI/CD на VPS с Docker Swarm, SSL-сертификатами и ротацией логов.",
    "task" => "Команда разработчиков тратила до 2 часов на ручной деплой каждой новой фичи по FTP/SSH. Требовалось автоматизировать процесс без использования сложных K8s платформ.",
    "solution" => "Настроил систему непрерывной интеграции и доставки:

- Написал `.gitlab-ci.yml` пайплайны для автоматической сборки Docker-образов
- Настроил **Traefik** в качестве роутера с автоматическим выпуском SSL (Let's Encrypt)
- Внедрил механизмы **Zero-downtime deployment** (деплой без простоя)
- Настроила очистку старых Docker-образов и ротацию логов через `logrotate`",
    "stack" => ["Docker", "GitLab CI/CD", "Traefik", "Bash", "Linux VPS"],
    "stats" => [
      "Время деплоя: **3 минуты**",
      "**0** ручных действий"
    ],
    "favourite" => false,
  ],
  [
    "id" => 11,
    "category" => "fix",
    "media" => [
      "https://placehold.co/600x400/365314/EAEAEA?font=montserrat&text=React+Refactor",
      "https://placehold.co/600x400/3f6212/EAEAEA?font=montserrat&text=Performance+Fix"
    ],
    "title" => "Оптимизация рендеринга и рефакторинг React-приложения",
    "body" => "Устранение лишних повторных рендеров (re-renders), оптимизация Redux-стора и уменьшение размера бандла на 45%.",
    "task" => "Дашборд аналитики сильно тормозил при кликах по таблицам и переключении вкладки фильтров. Размер главного `main.js` бандла превышал 4.2 МБ.",
    "solution" => "Провел аудит производительности через React Profiler:

- Устранил циклические рендеры, применив `useMemo`, `useCallback` и `React.memo`
- Разбил монолитный бандл на чанки с помощью **Code Splitting / React.lazy**
- Переписал тяжелые селекторы в Redux на **Reselect**
- Заменил громоздкие библиотеки (Moment.js -> date-fns, Lodash -> lodash-es)",
    "stack" => ["React", "Redux Toolkit", "Webpack", "React Profiler"],
    "stats" => [
      "Размер бандла: **4.2MB -> 1.1MB**",
      "**60 FPS** при скролле"
    ],
    "favourite" => false,
  ],
  [
    "id" => 12,
    "category" => "opt",
    "media" => [
      "https://placehold.co/600x400/701a75/EAEAEA?font=montserrat&text=SSR+Migration",
      "https://placehold.co/600x400/86198f/EAEAEA?font=montserrat&text=NextJS+SEO"
    ],
    "title" => "Перевод SPA на Next.js (SSR) для индексации поисковиками",
    "body" => "Миграция клиентоориентированного React SPA на Next.js с серверным рендерингом для полноценного SEO и быстрых социальных превью.",
    "task" => "Интернет-журнал на чистом React (CSR) не индексировался Яндексом, а ссылки при отправке в мессенджеры не отображали превью (OG-теги).",
    "solution" => "Перевел архитектуру проекта на **Next.js**:

- Перенес статические страницы на **ISR (Incremental Static Regeneration)**
- Настроил динамический генератор Open Graph картинок для соцсетей
- Настроил кэширование заголовков на уровне CDN Cloudflare
- Настроил кастомный `sitemap.xml` и `robots.txt` с быстрой регенерацией",
    "stack" => ["Next.js", "React", "SSR/ISR", "Cloudflare", "Open Graph"],
    "stats" => [
      "**100%** страниц в индексе",
      "**+250%** SEO трафика"
    ],
    "favourite" => true,
  ],
  [
    "id" => 13,
    "category" => "wp",
    "media" => [
      "https://placehold.co/600x400/14532d/EAEAEA?font=montserrat&text=Eco+Catalog",
      "https://placehold.co/600x400/166534/EAEAEA?font=montserrat&text=Filter+System"
    ],
    "title" => "Каталог строительных эко-материалов «GreenBuild»",
    "body" => "Кастомный сайт-каталог на WordPress с калькулятором расхода материалов и составлением смета-запроса в PDF.",
    "task" => "Компания продает премиальные изоляционные материалы. Требовался удобный каталог с возможностью рассчитать объем заказа под площадь объекта и сразу скачать КП.",
    "solution" => "Разработал проект с помощью кастомных типов записей (CPT):

- Написал интерактивный калькулятор на **Vue.js**, встроенный в тему WP
- Настроила генерацию коммерческого предложения в PDF прямо в браузере
- Оптимизировал базу данных для моментальной отдачи 500+ карточек товаров",
    "stack" => ["WordPress", "Vue.js", "PHP", "ACF Pro", "tcPDF"],
    "stats" => [
      "**+45%** конверсия в заявку",
      "Удобный калькулятор"
    ],
    "favourite" => false,
  ],
  [
    "id" => 14,
    "category" => "react",
    "media" => [
      "https://placehold.co/600x400/4c1d95/EAEAEA?font=montserrat&text=Task+Board",
      "https://placehold.co/600x400/5b21b6/EAEAEA?font=montserrat&text=Kanban+UI"
    ],
    "title" => "Интерактивный Канбан-таскменеджер «FlowBoard»",
    "body" => "Приложение для управления проектами внутри команды: Drag-and-Drop доски, совместное редактирование в реальном времени и чек-листы.",
    "task" => "Внутренней аналитической команде требовался простой инструмент по типу Trello, но размещенный на их собственном сервере для безопасности данных.",
    "solution" => "Разработал SPA-приложение на **React + Dnd Kit**:

- Реализовал плавный Drag-and-Drop карточек и колонок
- Подключил **Socket.io** для моментального отражения изменений у всей команды
- Добавил систему фильтрации по тегам, исполнителям и дедлайнам
- Сверстал интерфейс по гайдлайнам **Shadcn/ui**",
    "stack" => ["React", "TypeScript", "Dnd Kit", "Shadcn/ui", "Socket.io"],
    "stats" => [
      "До **50** юзеров онлайн",
      "Удобный UX"
    ],
    "favourite" => false,
  ],
  [
    "id" => 15,
    "category" => "node",
    "media" => [
      "https://placehold.co/600x400/172554/EAEAEA?font=montserrat&text=GraphQL+API",
      "https://placehold.co/600x400/1e3a8a/EAEAEA?font=montserrat&text=Data+Sync"
    ],
    "title" => "GraphQL API бэкенд для мобильного приложения службы доставки",
    "body" => "Шлюз данных на Node.js, Express и GraphQL для мобильных приложений курьеров и клиентов с отслеживанием геолокации.",
    "task" => "Старый REST API не справлялся с передачей геоданных курьеров и отдавал много лишних полей, что замедляло работу приложения на слабом мобильном интернете.",
    "solution" => "Спроектировал и написал GraphQL сервер:

- Внедрил **GraphQL Subscriptions** для передача координат курьера на карту в реальном времени
- Настроила авторизацию по JWT с ротацией Refresh-токенов в **Redis**
- Оптимизировал запросы к БД с помощью **DataLoader** для решения проблемы N+1",
    "stack" => ["Node.js", "Express", "GraphQL", "Apollo Server", "PostgreSQL", "Redis"],
    "stats" => [
      "**-70%** размер сетевых ответов",
      "**>50k** эвентов в день"
    ],
    "favourite" => true,
  ],
];



function lp_import_portfolio_demo_data() {

  if (get_option('lp_portfolio_imported')) {
    return;
  }

  // check array

  $portfolio = get_posts([
    'post_type'       => 'portfolio',
    'post_status'     => 'any',
    'posts_per_page'  => -1,
    'fields'          => 'ids'
  ]);
  // if (!empty($portfolio)) {
  //   foreach ($portfolio as $id) {
  //     wp_delete_post($id, true);
  //   }
  // }
  // return;

  if (!empty($portfolio)) return;


  global $portfolio_items;


  /*
     * --------------------------------------------------------
     * Получаем изображения из медиатеки
     * --------------------------------------------------------
     */
  $media_ids = get_posts([
    'post_type'      => 'attachment',
    'post_status'    => 'inherit',
    'post_mime_type' => 'image',
    'posts_per_page' => -1,
    'fields'         => 'ids',
    'orderby'        => 'ID',
    'order'          => 'ASC',
  ]);

  if (empty($media_ids)) {
    return;
  }

  /*
     * --------------------------------------------------------
     * Создаём все необходимые термины ДО создания постов
     * --------------------------------------------------------
     */

  foreach ($portfolio_items as $project) {

    /*
         * CATEGORY
         */

    if (!empty($project['category'])) {

      $category_slug = sanitize_title(
        $project['category']
      );

      $category_term = get_term_by(
        'slug',
        $category_slug,
        'portfolio_category'
      );

      if (!$category_term) {

        $result = wp_insert_term(
          ucfirst($project['category']),
          'portfolio_category',
          [
            'slug' => $category_slug,
          ]
        );

        if (!is_wp_error($result)) {
          $category_term = get_term(
            $result['term_id'],
            'portfolio_category'
          );
        }
      }
    }


    /*
         * STACK
         */

    if (!empty($project['stack'])) {

      foreach ($project['stack'] as $technology) {

        $technology_slug = sanitize_title(
          $technology
        );

        $stack_term = get_term_by(
          'slug',
          $technology_slug,
          'portfolio_stack'
        );

        if (!$stack_term) {

          wp_insert_term(
            $technology,
            'portfolio_stack',
            [
              'slug' => $technology_slug,
            ]
          );
        }
      }
    }
  }


  /*
     * --------------------------------------------------------
     * Создаём проекты
     * --------------------------------------------------------
     */

  foreach ($portfolio_items as $project) {

    /*
         * Создаём пост
         */

    $post_id = wp_insert_post([
      'post_type'    => 'portfolio',
      'post_status'  => 'publish',
      'post_title'   => $project['title'],
      'post_content' => $project['body'],
    ], true);


    if (is_wp_error($post_id)) {
      continue;
    }


    /*
         * ----------------------------------------------------
         * Сохраняем исходный ID проекта
         * ----------------------------------------------------
         */

    update_post_meta(
      $post_id,
      '_portfolio_import_id',
      $project['id']
    );


    /*
         * ----------------------------------------------------
         * CATEGORY
         * ----------------------------------------------------
         */

    if (!empty($project['category'])) {

      $category_term = get_term_by(
        'slug',
        sanitize_title($project['category']),
        'portfolio_category'
      );

      if ($category_term) {

        wp_set_post_terms(
          $post_id,
          [$category_term->term_id],
          'portfolio_category',
          false
        );
      }
    }


    /*
         * ----------------------------------------------------
         * STACK
         * ----------------------------------------------------
         */

    if (!empty($project['stack'])) {

      $stack_term_ids = [];

      foreach ($project['stack'] as $technology) {

        $stack_term = get_term_by(
          'slug',
          sanitize_title($technology),
          'portfolio_stack'
        );

        if ($stack_term) {
          $stack_term_ids[] = $stack_term->term_id;
        }
      }

      if (!empty($stack_term_ids)) {

        wp_set_post_terms(
          $post_id,
          $stack_term_ids,
          'portfolio_stack',
          false
        );
      }
    }


    /*
         * ----------------------------------------------------
         * CARBON FIELDS — TASK
         * ----------------------------------------------------
         */

    carbon_set_post_meta(
      $post_id,
      'task',
      $project['task']
    );


    /*
         * ----------------------------------------------------
         * CARBON FIELDS — SOLUTION
         * ----------------------------------------------------
         */

    carbon_set_post_meta(
      $post_id,
      'solution',
      $project['solution']
    );


    /*
         * ----------------------------------------------------
         * CARBON FIELDS — MEDIA GALLERY
         * ----------------------------------------------------
         *
         * Берём два существующих изображения.
         *
         * ВАЖНО:
         * media_gallery ожидает массив attachment ID.
         */

    $project_media_ids = [];

    /*
         * Распределяем картинки по проектам.
         *
         * Для одного проекта берём первые две.
         */

    foreach ($project['media'] as $index => $unused_url) {

      if (isset($media_ids[$index])) {

        $project_media_ids[] =
          (int) $media_ids[$index];
      }
    }

    /*
         * Если почему-то не хватило двух картинок,
         * добиваем из медиатеки.
         */

    if (count($project_media_ids) < 2) {

      foreach ($media_ids as $media_id) {

        if (
          !in_array(
            $media_id,
            $project_media_ids,
            true
          )
        ) {
          $project_media_ids[] = (int) $media_id;
        }

        if (count($project_media_ids) >= 2) {
          break;
        }
      }
    }

    carbon_set_post_meta(
      $post_id,
      'media',
      $project_media_ids
    );


    /*
         * ----------------------------------------------------
         * CARBON FIELDS — STATS
         * ----------------------------------------------------
         *
         * complex field ожидает:
         *
         * [
         *     [
         *         'stat_value' => '...'
         *     ],
         *     [
         *         'stat_value' => '...'
         *     ]
         * ]
         */

    $stats = [];

    if (!empty($project['stats'])) {

      foreach ($project['stats'] as $stat) {

        $stats[] = [
          'stat_value' => $stat,
        ];
      }
    }

    carbon_set_post_meta(
      $post_id,
      'stats',
      $stats
    );


    /*
         * ----------------------------------------------------
         * CARBON FIELDS — FAVOURITE
         * ----------------------------------------------------
         */

    carbon_set_post_meta(
      $post_id,
      'is_favourite',
      !empty($project['favourite'])
    );
  }

  update_option('lp_portfolio_imported', true);
}


function lp_assign_portfolio_taxonomies() {

  if (get_option('lp_portfolio_taxonomies_imported')) {
    return;
  }

  $posts = get_posts([
    'post_type'      => 'portfolio',
    'post_status'    => 'any',
    'posts_per_page' => -1,
    'orderby'        => 'ID',
    'order'          => 'ASC',
  ]);


  if (empty($posts)) {
    return;
  }


  /*
     * --------------------------------------------------------
     * Проходим по постам
     * --------------------------------------------------------
     */

  global $portfolio_items;

  foreach ($posts as $post) {

    $title = $post->post_title;


    /*
         * Если для этого названия нет настроек —
         * пропускаем пост.
         */


    $result = array_filter($portfolio_items, function ($item) use ($title) {
      return $item['title'] === $title;
    });



    $data = !empty($result) ? reset($result) : null;


    if (!$data) {
      continue;
    }



    /*
         * ====================================================
         * CATEGORY
         * ====================================================
         */

    if (!empty($data['category'])) {

      $category_slug = sanitize_title(
        $data['category']
      );

      /*
             * Ищем существующую категорию.
             */

      $category_term = get_term_by(
        'slug',
        $category_slug,
        'portfolio_category'
      );


      /*
             * Если категории нет — создаём её.
             */

      if (!$category_term) {

        $result = wp_insert_term(
          ucfirst($data['category']),
          'portfolio_category',
          [
            'slug' => $category_slug,
          ]
        );

        if (!is_wp_error($result)) {

          $category_term = get_term(
            $result['term_id'],
            'portfolio_category'
          );
        }
      }


      /*
             * Назначаем категорию посту.
             */

      if ($category_term) {

        wp_set_post_terms(
          $post->ID,
          [
            (int) $category_term->term_id
          ],
          'portfolio_category',
          false
        );
      }
    }


    /*
         * ====================================================
         * STACK
         * ====================================================
         */

    $stack_term_ids = [];


    if (!empty($data['stack'])) {

      foreach ($data['stack'] as $technology) {

        $technology_slug = sanitize_title(
          $technology
        );


        /*
                 * Ищем технологию.
                 */

        $stack_term = get_term_by(
          'slug',
          $technology_slug,
          'portfolio_stack'
        );


        /*
                 * Если технологии нет — создаём.
                 */

        if (!$stack_term) {

          $result = wp_insert_term(
            $technology,
            'portfolio_stack',
            [
              'slug' => $technology_slug,
            ]
          );

          if (!is_wp_error($result)) {

            $stack_term = get_term(
              $result['term_id'],
              'portfolio_stack'
            );
          }
        }


        /*
                 * Запоминаем ID технологии.
                 */

        if ($stack_term) {

          $stack_term_ids[] =
            (int) $stack_term->term_id;
        }
      }
    }


    /*
         * Назначаем весь стек посту.
         */

    if (!empty($stack_term_ids)) {

      wp_set_post_terms(
        $post->ID,
        $stack_term_ids,
        'portfolio_stack',
        false
      );
    }
  }


  /*
     * --------------------------------------------------------
     * Готово
     * --------------------------------------------------------
     */

  update_option(
    'lp_portfolio_taxonomies_imported',
    true
  );
}


add_action(
  'init',
  'lp_assign_portfolio_taxonomies',
  20
);


add_action(
  'carbon_fields_fields_registered',
  'lp_import_portfolio_demo_data'
);
