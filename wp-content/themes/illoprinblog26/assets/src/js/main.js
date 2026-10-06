const $ = (sel, ctx = document) => ctx.querySelector(sel);
const $$ = (sel, ctx = document) => [...ctx.querySelectorAll(sel)];
const reduceMotion = window.matchMedia(
  "(prefers-reduced-motion: reduce)",
).matches;


/* ---------- Marquee: дублируем содержимое для бесшовной прокрутки ---------- */
const initMarquees = () => {
  $$(".marquee-track").forEach((track) => {
    track.innerHTML += track.innerHTML + track.innerHTML; // 2 копии → translateX(-50%) бесшовен
    track.setAttribute("aria-hidden", "false");
  });
};

const initNav = () => {
  const nav = $("#siteNav");
  const toggle = $("#navToggle");
  const menu = $("#navMobile");

  const onScroll = () => nav.classList.toggle("scrolled", window.scrollY > 24);
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  toggle?.addEventListener("click", () => {
    const open = menu.classList.toggle("open");
    toggle.setAttribute("aria-expanded", String(open));
    toggle.innerHTML = `<i class="bi bi-${open ? "x-lg" : "list"}"></i>`;
  });

  $$("a", menu).forEach((a) =>
    a.addEventListener("click", () => {
      menu.classList.remove("open");
      toggle.setAttribute("aria-expanded", "false");
      toggle.innerHTML = '<i class="bi bi-list fs-5"></i>';
    })
  );
};

function initGoTopButton() {
  const btn = $("#toTop");
  window.addEventListener("scroll", () => {
    window.scrollY > 300
      ? btn.classList.add("is-shown")
      : btn.classList.remove("is-shown");
  });

  toTop.addEventListener("click", (e) => {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: "smooth" /* Smooth native browser animation */
    });
  });
}

function clipboardCopy(msg) {
  const cfg = { reduceMotion, interval: 3000 };

  navigator.clipboard.writeText(msg).catch(err => {
    ToastShow.ShowToast('danger', `Не удалось скопировать в буфер!<br><t>${err.message}</t>`, cfg);
  }).then(() => {
    ToastShow.ShowToast('success', 'Скопировали в буфер обмена!', cfg);
  });
}

document.addEventListener('DOMContentLoaded', () => {
  createRevealOnScrollEffect();
  initMarquees();
  initNav();
  initScrollBar();
  initGoTopButton();
})