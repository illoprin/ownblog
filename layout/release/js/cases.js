/* ============================================================
   CASES CATALOG — рендер и real-time фильтрация
   Данные берутся из data-portfolio.js (categories, portfolioItems)
   ============================================================ */

/* ---------- рендер категорий (с счётчиком) ---------- */

function renderCasesCategories() {
  const template = $('template#portfolio-category-item');
  const container = $('#portfolio-category-container');

  categories.forEach(item => {
    const node = template.content.cloneNode(true);
    const label = $('label', node);
    const input = $('input[type="radio"]', node);

    const count = item.value === 'all'
      ? portfolioItems.length
      : portfolioItems.filter(p => p.category === item.value).length;

    label.innerHTML = `${item.name}<span class="cat-count">${count}</span>`;
    label.setAttribute('for', item.value);
    input.id = item.value;
    input.value = item.value;

    if (item.value === 'all') input.checked = true;

    container.appendChild(node);
  });
}

/* ---------- рендер карточек кейсов ---------- */

function renderCasesGrid() {
  const template = $('template#portfolio-item');
  const container = $('#portfolio-container');
  container.innerHTML = '';

  portfolioItems.forEach(item => {
    const node = template.content.cloneNode(true);
    const categoryJson = categories.find(c => c.value === item.category);
    const root = node.firstElementChild;

    // маркировка для фильтра
    root.classList.add('pf-col');
    root.setAttribute('data-cat', item.category);

    // badge категории
    $('.pf-category', node).textContent = categoryJson.name;

    // превью
    const img = $('img', node);
    img.src = item.media[0];
    img.alt = item.title;

    // заголовок и описание
    $('#pf-title', node).textContent = item.title;
    $('#pf-body', node).textContent = item.body;

    // ссылки на карточку кейса
    $$('a', node).forEach(a => a.setAttribute('href', `case.html?id=${item.id}`));

    // стек
    $('#pf-stack', node).innerHTML = item.stack
      .map(s => `<div class="badge badge-light">${s}</div>`)
      .join('');

    // статистика
    $('.pf-stats', node).innerHTML = item.stats
      .map(s => `<span class="pf-stat-item">${marked.parseInline(s)}</span>`)
      .join('');

    container.appendChild(node);
  });
}

/* ---------- real-time фильтрация по data-cat ---------- */

function initCasesFilter() {
  let debounceTimer = null;
  let selectorValue = "all";
  let searchBoxValue = "";
  const grid = $('#portfolio-container');
  const meta = $('#cases-meta');
  const empty = $('#cases-empty');

  const colsElements = $$('.pf-col', grid);
  const casesData = colsElements.map(col => ({
    elem: col,
    cat: col.dataset.cat || '',
    title: col.querySelector('#pf-title')?.textContent.toLowerCase() || '',
    desc: col.querySelector('#pf-body')?.textContent.toLowerCase() || ''
  }));

  const FADE_MS = 450;

  const getDelay = (i) => (i * 30) + 'ms';

  const apply = () => {
    let visible = 0, invisible = 0;
    const search = searchBoxValue.toLowerCase();

    // помечаем видимые карточки
    casesData.forEach(item => {
      const col = item.elem;

      // -- match check
      const catMatch =
        selectorValue === 'all'
        || !item.cat
        || item.cat === selectorValue;
      const titleMatch =
        item.title.includes(search)
        || item.desc.includes(search)
        || !searchBoxValue
        || !item.title;
      const match = catMatch && titleMatch;

      if (reduceMotion) {
        if (match) {
          visible++;
          col.classList.remove('pf-hidden');
        } else {
          col.classList.add('pf-hidden');
        }
        return;
      }


      if (match) {
        visible++;
        col.style.transitionDelay = getDelay(visible);
        col.classList.remove('pf-hidden');
        col.classList.add('pf-anim');
        setTimeout(() => col.classList.remove('pf-anim'), FADE_MS);
      } else if (!col.classList.contains('pf-hidden')) {
        col.classList.add('pf-anim');
        col.style.transitionDelay = getDelay(invisible);
        setTimeout(() => col.classList.add('pf-hidden'), FADE_MS);
      }
    });

    meta.textContent = `Показано ${visible} из ${casesData.length} кейсов`;
    empty.classList.toggle('is-visible', visible === 0);
  };

  $('#portfolio-category-container')
    .addEventListener('change', e => {
    if (e.target.matches('input[type="radio"]')) {
      selectorValue = e.target.value;
      requestAnimationFrame(apply);
    }
  });

  $('#search').addEventListener('input', e => {
    searchBoxValue = e.target.value.trim();

    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
      requestAnimationFrame(apply);
    }, 150); // optimal latency for debounce
  });

  apply();
}

/* ---------- init ---------- */

document.addEventListener('DOMContentLoaded', () => {
  renderCasesCategories();
  renderCasesGrid();
  initCasesFilter();
});