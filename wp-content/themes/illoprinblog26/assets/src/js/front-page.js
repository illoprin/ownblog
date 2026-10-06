const workflowItems = [
  {
    title: "Бриф",
    term: "(1-2 дня)",
    body: "Обсуждаем цель сайта и референсы. Отвечаю и присылаю примерную оценку.",
  },
  {
    title: "Смета",
    term: "(1-2 дня)",
    body: "Фиксирую, что делаю, за какие деньги и в какой срок.",
  },
  {
    title: "Прототип",
    term: "(1 день)",
    body: "Показываю структуру и внешний вид до начала разработки.",
  },
  {
    title: "Разработка",
    term: "(3-4 дня)",
    body: "Разрабатываю сайт и присылаю промежуточные показы в коротких видео.",
  },
  {
    title: "Запуск",
    term: "(1-2 дня)",
    body: "Размещаю сайт на сервере, передаю доступы и записываю короткую инструкцию.",
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
  };

  function handleMouseLeave() {
    isHovering = false;
    targetX = 0;
    targetY = 0;
    if (!rafId) {
      rafId = requestAnimationFrame(update);
    }
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
  };

  // Слушаем движение мыши по секции hero
  const hero = $("section#hero");
  hero.addEventListener("mousemove", handleMouseMove);
  // hero.addEventListener("mouseenter", handleMouseEnter);
  hero.addEventListener("mouseleave", handleMouseLeave);
}

/* ---------- Render Сервисы ---------- */
function initServices() {
  // предзаполнение темы заявки при клике на "Обсудить"
  document.querySelectorAll(".svc-link").forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const title = $("#svc-title", link.closest(".card")).textContent.trim();
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
        a.setAttribute("href", `case.html?id=${item.id}`),
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
          (s) => ` <span class="pf-stat-item">${marked.parseInline(s)}</span>`,
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

function initWorkflow() {
  const list = document.querySelector("ol.workflow-list");
  const template = document.querySelector("#workflow_item");

  if (!list || !template) return;

  list.replaceChildren(
    ...workflowItems.map((step, index) => {
      const item = template.content.firstElementChild.cloneNode(true);

      item.classList.remove("reveal-left", "reveal-right");
      item.classList.add(index % 2 === 0 ? "reveal-left" : "reveal-right");
      item.querySelector(".workflow-number").textContent = String(
        index + 1,
      ).padStart(2, "0");
      item.querySelector(".workflow-title").textContent = step.title;
      item.querySelector(".workflow-term").textContent = step.term;
      item.querySelector(".workflow-description").textContent = step.body;

      return item;
    }),
  );
}

/* ---------- init ---------- */
document.addEventListener("DOMContentLoaded", () => {
  parallaxRing();
  initServices();
  initWorkflow();
  initTyping();
});
