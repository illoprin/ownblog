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

  // open gallery lightbox
  mainEl.addEventListener("click", () => openLightbox(activeIndex));

  // gallery lightbox elements
  const closeBtn = document.getElementById("lightboxClose");
  const prevBtn = document.getElementById("lightboxPrev");
  const nextBtn = document.getElementById("lightboxNext");

  // gallery lightbox events
  if (closeBtn) closeBtn.addEventListener("click", closeLightbox);
  if (prevBtn) prevBtn.addEventListener("click", () => step(-1));
  if (nextBtn) nextBtn.addEventListener("click", () => step(1));

  // gallery lightbox key input
  document.addEventListener("keydown", (e) => {
    if (!lightbox.classList.contains("is-open")) return;
    if (e.key === "Escape") closeLightbox();
    if (e.key === "ArrowLeft") step(-1);
    if (e.key === "ArrowRight") step(1);
  });

  // gallery lightbox swipe input
  let pointerStartX = 0;
  let pointerStartY = 0;
  let pointerCurrentX = 0;
  let isDragging = false;
  let dragDirectionLocked = null; // 'x' | 'y' | null
  
  // минимальная дистанция свайпа в px, чтобы сработало
  const SWIPE_THRESHOLD = 50; 
  // после скольких px определяем направление жеста
  const DIRECTION_LOCK_THRESHOLD = 10;

  const onPointerDown = (e) => {
    const currentItem = mediaList[activeIndex];
    if (currentItem.is_video) return; // не свайпаем видео, чтобы не мешать управлению

    // свайпаем только основным указателем (палец / левая кнопка мыши)
    if (e.pointerType === "mouse" && e.button !== 0) return;

    isDragging = true;
    dragDirectionLocked = null;
    pointerStartX = pointerCurrentX = e.clientX;
    pointerStartY = e.clientY;

    lightboxContent.classList.add("is-dragging");
  };

  const onPointerMove = (e) => {
    if (!isDragging) return;

    pointerCurrentX = e.clientX;
    const deltaX = pointerCurrentX - pointerStartX;
    const deltaY = e.clientY - pointerStartY;

    // определяем направление жеста один раз, чтобы не путать свайп со скроллом
    if (!dragDirectionLocked) {
      if (
        Math.abs(deltaX) > DIRECTION_LOCK_THRESHOLD ||
        Math.abs(deltaY) > DIRECTION_LOCK_THRESHOLD
      ) {
        dragDirectionLocked = Math.abs(deltaX) > Math.abs(deltaY) ? "x" : "y";
      }
    }

    // если жест горизонтальный — блокируем скролл страницы и двигаем контент за пальцем
    if (dragDirectionLocked === "x") {
      e.preventDefault();
      lightboxContent.style.transform = `translateX(${deltaX}px)`;
    }
  };

  const onPointerUp = (e) => {
    if (!isDragging) return;
    isDragging = false;
    lightboxContent.classList.remove("is-dragging");

    const deltaX = pointerCurrentX - pointerStartX;

    // возвращаем контент на место (transition добавлен в CSS через .is-dragging off)
    lightboxContent.style.transform = "";

    if (dragDirectionLocked === "x" && Math.abs(deltaX) > SWIPE_THRESHOLD) {
      // свайп вправо -> предыдущее, влево -> следующее
      step(deltaX > 0 ? -1 : 1);
    }

    dragDirectionLocked = null;
  };

  lightboxContent.addEventListener("pointerdown", onPointerDown);
  lightboxContent.addEventListener("pointermove", onPointerMove, {
    passive: false,
  });
  lightboxContent.addEventListener("pointerup", onPointerUp);
  lightboxContent.addEventListener("pointercancel", onPointerUp);
  lightboxContent.addEventListener("pointerleave", onPointerUp);
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

/* ---------- init ---------- */

document.addEventListener("DOMContentLoaded", () => {
  initPortfolioGallery();
  initParallax();
});
