const services = [
  {
    id: 1,
    icon: "bi bi-wordpress",
    title: "WordPress-сайт под ключ",
    description:
      "Корпоративные сайты и интернет-магазины на **WooCommerce**. Гибкие поля **ACF**, удобная админка, кастомная тема без «конструкторного» мусора.",
    tags: ["ACF", "WooCommerce", "Custom theme"],
  },
  {
    id: 2,
    icon: "bi bi-wrench-adjustable",
    title: "Доработка и исправление ошибок",
    description:
      "Чиню то, что сломалось: конфликты плагинов, белый экран, ошибки после обновления. Дорабатываю чужой код и довожу проекты до рабочего состояния.",
    tags: ["Debug", "Legacy code", "Hotfix"],
  },
  {
    id: 3,
    icon: "bi bi-speedometer2",
    title: "Ускорение и оптимизация",
    description:
      "Технический аудит, разгон **PageSpeed** до зелёной зоны, кэширование, оптимизация картинок и запросов, базовое **техническое SEO**.",
    tags: ["Аудит", "PageSpeed", "SEO-тех"],
  },
  {
    id: 4,
    icon: "bi bi-hdd-network",
    title: "Настройка VPS/VDS-сервера",
    description:
      "Разворачиваю сервер с нуля: Nginx, PHP-FPM, БД, **SSL**-сертификаты, бэкапы. Переношу сайт на новый хостинг без простоя и потери позиций.",
    tags: ["SSL", "Nginx", "Перенос сайта"],
  },
  {
    id: 5,
    icon: "bi bi-braces-asterisk",
    title: "Веб-приложение на React",
    description:
      "SPA и личные кабинеты на **React** + **TypeScript** с состоянием на **MobX**. Чистая архитектура, компонентный подход, адаптив на всех экранах.",
    tags: ["React", "TypeScript", "MobX"],
  },
  {
    id: 6,
    icon: "bi bi-hexagon-half",
    title: "Приложение на Node.js",
    description:
      "REST API, телеграм-боты, интеграции и парсеры на **Node.js** + **TypeScript**. Docker, логи, понятная документация к эндпоинтам.",
    tags: ["Node.js", "TypeScript", "REST API"],
  },
];

function parallaxRing() {
  const wrap = document.querySelector(".avatar-wrap");

  if (reduceMotion) return;

  const ring = wrap.querySelector(".avatar-ring");
  const avatar = wrap.querySelector(".avatar");
  const img = wrap.querySelector(".avatar img");

  // Слои с разной "силой" смещения — создают иллюзию глубины
  const layers = [
    { el: ring, strength: 12 },
    { el: avatar, strength: 22 },
  ];

  // Текущие и целевые координаты (для плавности через lerp)
  let targetX = 0;
  let targetY = 0;
  let currentX = 0;
  let currentY = 0;

  let rafId = null;
  let isHovering = false;

  const handleMouseMove = (e) => {

    const rect = wrap.getBoundingClientRect();
    const cx = rect.left + rect.width / 2;
    const cy = rect.top + rect.height / 2;

    // Нормализуем в диапазон -1...1
    targetX = (e.clientX - cx) / (rect.width / 2);
    targetY = (e.clientY - cy) / (rect.height / 2);

    // Ограничиваем на случай, если курсор далеко за пределами блока
    targetX = Math.max(-1, Math.min(1, targetX));
    targetY = Math.max(-1, Math.min(1, targetY));

    if (!rafId) {
      rafId = requestAnimationFrame(update);
    }
  }

  function handleMouseLeave() {
    isHovering = false;
    targetX = 0;
    targetY = 0;
    if (!rafId) {
      rafId = requestAnimationFrame(update);
    }
  }

  const handleMouseEnter = () => {
    isHovering = true;
  }

  const update = () => {
    // Линейная интерполяция для плавного "довода" до цели
    const ease = 0.08;
    currentX += (targetX - currentX) * ease;
    currentY += (targetY - currentY) * ease;

    layers.forEach(({ el, strength }) => {
      if (!el) return;
      const x = currentX * strength;
      const y = currentY * strength;
      el.style.transform = `translate3d(${x}px, ${y}px, 0)`;
    });

    // Продолжаем анимацию, пока не "доехали" до цели (или пока hover активен)
    const distance =
      Math.abs(targetX - currentX) + Math.abs(targetY - currentY);
    if (distance > 0.001 || isHovering) {
      rafId = requestAnimationFrame(update);
    } else {
      rafId = null;
    }
  }

  // Слушаем движение мыши по секции hero
  const hero = $('section#hero');
  hero.addEventListener("mousemove", handleMouseMove);
  // hero.addEventListener("mouseenter", handleMouseEnter);
  hero.addEventListener("mouseleave", handleMouseLeave);
}

/* ---------- Render Сервисы ---------- */
function initServices() {

  const template = $("template#service-item");
  const container = $("#service-container");

  services.forEach((item) => {
    const node = template.content.cloneNode(true);

    // icon
    $(".svc-icon", node).innerHTML = `<i class="${item.icon}"></i>`;
    // title
    $("#svc-title", node).textContent = item.title;
    // body
    $("#svc-body", node).innerHTML = marked.parseInline(item.description);
    // tags
    $("ul#svc-tags", node).innerHTML = item.tags
      .map((t) => `<div class="badge badge-accent font-alt">${t}</div>`)
      .join("");

    container.appendChild(node);
  });

  // предзаполнение темы заявки при клике на "Обсудить"
  document.querySelectorAll('.svc-link').forEach(link => {
    link.addEventListener('click', (e) => {
      e.preventDefault();
      const title = $('#svc-title', link.closest('.card')).textContent.trim();
      const message = document.forms.lead.task;
      if (!title || message.value) return;
      message.value = `Здравствуйте! Интересует услуга: ${title}. `;
      // message.dispatchEvent(new Event("input"));
      message.focus();
    });
  });
}

/* ---------- Портфолио ---------- */
function initPortfolio() {
  // портфолио
  const templateItem = $("template#portfolio-item");
  const containerItem = $("#portfolio-container");

  // render favourites
  portfolioItems
    .filter((item) => item.favourite)
    .forEach((item) => {
      const node = templateItem.content.cloneNode(true);

      // badge cat
      const categoryJson = categories.find((c) => c.value == item.category);
      $(".pf-category", node).textContent = categoryJson.name;
      // data-cat (category)
      node.firstElementChild.setAttribute("data-cat", categoryJson.value);

      // banner
      $("img", node).src = item.media[0];

      // title
      $("#pf-title", node).textContent = item.title;

      // body
      $("#pf-body", node).textContent = item.body;

      // links
      $$("a", node).forEach((a) =>
        a.setAttribute("href", `case.html?id=${item.id}`)
      );

      // stack
      $("#pf-stack", node).innerHTML = item.stack
        .map((s) => `<div class="badge badge-light">${s}</div>`)
        .join("");

      // stats
      const stats = $(".pf-stats", node);
      stats.replaceChildren();
      stats.innerHTML = item.stats
        .map(
          (s) => ` <span class="pf-stat-item">${marked.parseInline(s)}</span>`
        )
        .join("");

      containerItem.appendChild(node);
    });

  // init portfolio filter
}

/* ---------- Typing-эффект в Hero ---------- */
const initTyping = () => {
  const el = $("#typing");
  if (!el) return;

  const words = [
    "WordPress под ключ",
    "React + TypeScript",
    "Node.js API",
    "WooCommerce",
    "Оптимизация скорости",
    "Настройка VPS",
  ];

  createTypingEffect(el, {
    words,
    reduceMotion,
  });
};

/* ---------- Форма заявки ---------- */
const initForm = () => {
  const form = document.forms.lead;
  const fields = $$("input,textarea", form);
  const success = $("#lead-success");
  if (!form) return;

  fields.forEach((f) =>
    f.addEventListener("input", () => {
      if (f.classList.contains("is-invalid")) f.classList.remove("is-invalid");
    })
  );

  // ------------- validate -----------------

  const validate = () => {
    let ok = true;
    if (form.name.value.length < 3) {
      ok = false;
      form.name.classList.add("is-invalid");
    }

    if (form.contact.value.length < 3) {
      ok = false;
      form.contact.classList.add("is-invalid");
    }

    if (form.task.value.length < 10) {
      ok = false;
      form.task.classList.add("is-invalid");
    }

    if (!form.consent.checked) {
      ok = false;
      form.consent.classList.add("is-invalid");
    }

    return ok;
  };

  form.addEventListener("submit", (e) => {
    e.preventDefault();

    if (!validate()) return;

    // ------------- spinner button -----------------
    const btn = $("button[type=submit]", form);
    const original = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML =
      '<span class="spinner-border spinner-border-sm me-2"></span>Отправляем…';

    // ------------- success -----------------

    setTimeout(() => {
      btn.disabled = false;
      btn.innerHTML = original;
      form.reset();
      success.classList.remove("d-none");
      success.scrollIntoView({
        behavior: reduceMotion ? "auto" : "smooth",
        block: "center",
      });
      setTimeout(() => success.classList.add("d-none"), 5000);
    }, 900);
  });
};

/* ---------- init ---------- */
document.addEventListener("DOMContentLoaded", () => {
  parallaxRing();
  initServices();
  initPortfolio();
  initTyping();
  initForm();
});
