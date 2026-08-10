
/* ---------- real-time фильтрация  ---------- */

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

document.addEventListener('DOMContentLoaded', () => {
  initCasesFilter();
})
