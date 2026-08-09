/* ============================================================
   CASE LANDING PAGE
   Данные из data-portfolio.js (categories, portfolioItems)
   ============================================================ */

const isVideoSrc = (src) => /\.(mp4|webm|mov)$/i.test(src);

/* ---------- поиск кейса по ?id= ---------- */

function getRequestedCase() {
  const params = new URLSearchParams(window.location.search);
  const id = Number(params.get('id'));
  if (!Number.isFinite(id)) return null;
  return portfolioItems.find((item) => item.id === id) || null;
}

/* ---------- галерея + лайтбокс ---------- */

function initGallery(item) {
  const mainEl = $('#case-gallery-main');
  const thumbsEl = $('#case-gallery-thumbs');
  const lightbox = $('#case-lightbox');
  const lightboxContent = $('#case-lightbox-content');

  let activeIndex = 0;

  const mediaMarkup = (src, isThumb) => isVideoSrc(src)
    ? `<video src="${src}" ${isThumb ? 'muted playsinline preload="metadata"' : 'controls playsinline'}></video>`
    : `<img src="${src}" alt="${item.title}" loading="${isThumb ? 'lazy' : 'eager'}" />`;

  const setMain = (index) => {
    activeIndex = index;
    mainEl.innerHTML = mediaMarkup(item.media[index], false)
      + '<span class="zoom-hint"><i class="bi bi-arrows-angle-expand"></i></span>';
    $$('.gallery-thumb', thumbsEl).forEach((t, i) =>
      t.classList.toggle('is-active', i === index));
  };

  const openLightbox = (index) => {
    activeIndex = index;
    lightboxContent.innerHTML = mediaMarkup(item.media[index], false);
    lightbox.classList.add('is-open');
    document.body.style.overflow = 'hidden';
  };

  const closeLightbox = () => {
    lightbox.classList.remove('is-open');
    // lightboxContent.innerHTML = '';
    document.body.style.overflow = '';
  };

  const step = (dir) => {
    const next = (activeIndex + dir + item.media.length) % item.media.length;
    openLightbox(next);
  };

  // thumbs
  thumbsEl.innerHTML = '';
  item.media.forEach((src, i) => {
    const thumb = document.createElement('button');
    thumb.type = 'button';
    thumb.className = 'gallery-thumb' + (isVideoSrc(src) ? ' is-video' : '');
    thumb.innerHTML = mediaMarkup(src, true);
    thumb.addEventListener('click', () => setMain(i));
    thumbsEl.appendChild(thumb);
  });

  setMain(0);

  mainEl.addEventListener('click', () => openLightbox(activeIndex));
  $('#lightboxClose').addEventListener('click', closeLightbox);
  $('#lightboxPrev').addEventListener('click', () => step(-1));
  $('#lightboxNext').addEventListener('click', () => step(1));
  // lightbox.addEventListener('click', (e) => {
  //   if (e.target === lightbox) closeLightbox();
  // });
  document.addEventListener('keydown', (e) => {
    if (!lightbox.classList.contains('is-open')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') step(-1);
    if (e.key === 'ArrowRight') step(1);
  });
}

/* ---------- похожие кейсы ---------- */

function renderRelated(item) {
  const container = $('#case-related-container');
  const template = $('template#case-item');
  const section = $('#case-related');
  if (!container || !section) return;

  const sameCategory = portfolioItems.filter(
    (p) => p.id !== item.id && p.category === item.category);
  const others = portfolioItems.filter(
    (p) => p.id !== item.id && p.category !== item.category);
  const related = [...sameCategory, ...others].slice(0, 3);

  if (!related.length) {
    section.remove();
    return;
  }

  related.forEach(r => {
    const cat = categories.find((c) => c.value === r.category);
    const node = template.content.cloneNode(true);

    // set links
    $$('a', node).forEach(
      a => a.setAttribute('href', `case.html?id=${r.id}`)
    );

    // set image
    const img = $('img', node);
    img.src = r.media[0];
    img.alt = r.title;

    // set category badge
    $('span.pf-category', node).textContent = cat.name;

    // set body
    $('#pf-body', node).textContent = r.body;

    // set title
    $('#pf-title', node).textContent = r.title;

    container.appendChild(node);
  });

}

/* ---------- рендер страницы ---------- */

function renderCase(item) {
  const category = categories.find((c) => c.value === item.category);

  document.title = `${item.title} — кейс | illoprin`;

  $('#case-crumb-title').textContent = item.title;
  $('#case-category').textContent = category ? category.name : '';
  $('#case-title').textContent = item.title;
  $('#case-lead').textContent = item.body;

  $('#case-task').innerHTML = marked.parse(item.task || '');
  $('#case-solution').innerHTML = marked.parse(item.solution || '');

  $('#case-stack').innerHTML = item.stack
    .map((s) => `<div class="badge badge-stack reveal">${s}</div>`)
    .join('');

  $('#case-stats').innerHTML = item.stats.map((s) => {
    const html = marked.parseInline(s);
    // выносим первый <strong>…</strong> отдельно, остаток — подпись
    const match = html.match(/^<strong>(.*?)<\/strong>\s*(.*)$/);
    return match
      ? `<div class="glass case-stat"><strong>${match[1]}</strong><span>${match[2]}</span></div>`
      : `<div class="glass case-stat"><span>${html}</span></div>`;
  }).join('');

  // прелоад заявки формы: подставляем контекст кейса
  const taskField = $('#fTask');
  if (taskField) {
    taskField.value = `Хочу проект, похожий на «${item.title}». Расскажите подробнее...`;
  }

  initGallery(item);
  renderRelated(item);
}
function initParallax() {
  if (reduceMotion) return;

  const config = {
    maxBlur: 15,
    yMotion: 200,
    threshold: 0.1,
  };

  const hero = $('#hero');
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
      hero.style.setProperty('--neg', 0 );
      return;
    }

    hero.style.setProperty('--neg', neg );
  };

  const onScroll = () => {
    if (!ticking) {
      ticking = true;
      requestAnimationFrame(update);
    }
  };

  window.addEventListener('scroll', onScroll, { passive: true });

  // Применяем состояние сразу при инициализации
  // (на случай, если страница открыта не с самого верха)
  update();
}
/* ---------- форма заявки (как на лендинге) ---------- */

function initCaseForm() {
  const form = document.forms.lead;
  if (!form) return;

  const fields = $$('input,textarea', form);
  const success = $('#lead-success');

  fields.forEach((f) =>
    f.addEventListener('input', () => {
      if (f.classList.contains('is-invalid')) f.classList.remove('is-invalid');
    }));

  const validate = () => {
    let ok = true;
    if (form.name.value.length < 3) { ok = false; form.name.classList.add('is-invalid'); }
    if (form.contact.value.length < 3) { ok = false; form.contact.classList.add('is-invalid'); }
    if (form.task.value.length < 10) { ok = false; form.task.classList.add('is-invalid'); }
    if (!form.consent.checked) { ok = false; form.consent.classList.add('is-invalid'); }
    return ok;
  };

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    if (!validate()) return;

    const btn = $('button[type=submit]', form);
    const original = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Отправляем…';

    setTimeout(() => {
      btn.disabled = false;
      btn.innerHTML = original;
      form.reset();
      success.classList.remove('d-none');
      success.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'center' });
      setTimeout(() => success.classList.add('d-none'), 5000);
    }, 900);
  });
}

/* ---------- init ---------- */

document.addEventListener('DOMContentLoaded', () => {
  const item = getRequestedCase();

  if (!item) {
    $('#case-content').style.display = 'none';
    $('#case-not-found').style.display = 'block';
    return;
  }

  initParallax();
  renderCase(item);
  initCaseForm();
});