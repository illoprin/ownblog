

function initPortfolioGallery() {
  const mediaList = window.portfolioMedia || [];
  if (!mediaList.length) return;

  const mainEl = document.getElementById("case-gallery-main");
  const thumbsEl = document.getElementById("case-gallery-thumbs");
  const lightbox = document.getElementById("case-lightbox");
  const lightboxContent = document.getElementById("case-lightbox-content");

  if (!mainEl || !lightbox) return;

  let activeIndex = 0;

  const mediaMarkup = (item, isThumb) => {
    if (item.is_video) {
      return `<video src="${item.src}" ${
        isThumb
          ? 'muted playsinline preload="metadata"'
          : "controls playsinline"
      }></video>`;
    }
    return `<img src="${item.src}" alt="${item.alt}" loading="${
      isThumb ? "lazy" : "eager"
    }" />`;
  };

  const setMain = (index) => {
    activeIndex = index;

    // Обновляем главный блок
    mainEl.innerHTML =
      mediaMarkup(mediaList[index], false) +
      '<span class="zoom-hint"><i class="bi bi-arrows-angle-expand"></i></span>';

    // Переключаем активную миниатюру
    const thumbs = thumbsEl.querySelectorAll(".gallery-thumb");
    thumbs.forEach((t, i) => t.classList.toggle("is-active", i === index));
  };

  const openLightbox = (index) => {
    activeIndex = index;
    lightboxContent.innerHTML = mediaMarkup(mediaList[index], false);
    lightbox.classList.add("is-open");
    document.body.style.overflow = "hidden";
  };

  const closeLightbox = () => {
    lightbox.classList.remove("is-open");
    lightboxContent.innerHTML = ""; // Очищаем (в т.ч. останавливает видео)
    document.body.style.overflow = "";
  };

  const step = (dir) => {
    const next = (activeIndex + dir + mediaList.length) % mediaList.length;
    openLightbox(next);
  };

  // Навешиваем клики на превью
  thumbsEl.querySelectorAll(".gallery-thumb").forEach((thumbBtn) => {
    thumbBtn.addEventListener("click", () => {
      const idx = parseInt(thumbBtn.getAttribute("data-index"), 10);
      setMain(idx);
    });
  });

  // Клики для главного изображения и Лайтбокса
  mainEl.addEventListener("click", () => openLightbox(activeIndex));

  const closeBtn = document.getElementById("lightboxClose");
  const prevBtn = document.getElementById("lightboxPrev");
  const nextBtn = document.getElementById("lightboxNext");

  if (closeBtn) closeBtn.addEventListener("click", closeLightbox);
  if (prevBtn) prevBtn.addEventListener("click", () => step(-1));
  if (nextBtn) nextBtn.addEventListener("click", () => step(1));

  // Клавиатура
  document.addEventListener("keydown", (e) => {
    if (!lightbox.classList.contains("is-open")) return;
    if (e.key === "Escape") closeLightbox();
    if (e.key === "ArrowLeft") step(-1);
    if (e.key === "ArrowRight") step(1);
  });
}

function initParallax() {
  if (reduceMotion) return;

  const config = {
    maxBlur: 15,
    yMotion: 200,
    threshold: 0.1,
  };

  const hero = $("#hero");
  let ticking = false;

  // const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

  const update = () => {
    ticking = false;

    // Пересчитываем rect прямо в момент кадра — актуальные данные
    const rect = hero.getBoundingClientRect();
    const ratio = rect.bottom / rect.height;
    const neg = 1 - ratio;

    // console.log(window.scrollY, rect.bottom, ratio);

    if (rect.bottom < 0 || neg < 0) {
      hero.style.setProperty("--neg", 0);
      return;
    }

    hero.style.setProperty("--neg", neg);
  };

  const onScroll = () => {
    if (!ticking) {
      ticking = true;
      requestAnimationFrame(update);
    }
  };

  window.addEventListener("scroll", onScroll, { passive: true });

  // Применяем состояние сразу при инициализации
  // (на случай, если страница открыта не с самого верха)
  update();
}
/* ---------- форма заявки (как на лендинге) ---------- */

function initCaseForm() {
  const form = document.forms.lead;
  if (!form) return;

  const fields = $$("input,textarea", form);
  const success = $("#lead-success");

  fields.forEach((f) =>
    f.addEventListener("input", () => {
      if (f.classList.contains("is-invalid")) f.classList.remove("is-invalid");
    })
  );

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

    const btn = $("button[type=submit]", form);
    const original = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML =
      '<span class="spinner-border spinner-border-sm me-2"></span>Отправляем…';

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
}

/* ---------- init ---------- */

document.addEventListener("DOMContentLoaded", () => {
  initPortfolioGallery();
  initParallax();
});
