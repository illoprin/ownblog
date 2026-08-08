/**
 * Создаёт бесконечный typing-эффект в указанном элементе.
 *
 * @param {HTMLElement} el - элемент, в который выводится текст
 * @param {Object} [options]
 * @param {string[]} options.words - список слов для перебора
 * @param {number} [options.typeSpeed=65] - скорость печати, мс/символ
 * @param {number} [options.eraseSpeed=32] - скорость стирания, мс/символ
 * @param {number} [options.holdTime=1500] - пауза после допечатывания слова
 * @param {number} [options.pauseTime=350] - пауза перед печатью следующего слова
 * @param {boolean} [options.reduceMotion=false] - если true, эффект отключается,
 *        показывается первое слово статично
 * @param {(word: string, index: number) => void} [options.onWordChange] - колбэк смены слова
 * @returns {() => void} stop - функция остановки эффекта (cleanup)
 */
const createTypingEffect = (el, options = {}) => {
  const {
    words = [],
    typeSpeed = 65,
    eraseSpeed = 32,
    holdTime = 1500,
    pauseTime = 350,
    reduceMotion = false,
    onWordChange,
  } = options;

  if (!el || words.length === 0) return () => {};

  if (reduceMotion) {
    el.textContent = words[0];
    return () => {};
  }

  let w = 0;
  let i = 0;
  let erasing = false;
  let timerId = null;
  let stopped = false;

  const tick = () => {
    if (stopped) return;

    const word = words[w];
    el.textContent = word.slice(0, i);

    if (!erasing) {
      if (i < word.length) {
        i++;
        timerId = setTimeout(tick, typeSpeed);
        return;
      }
      erasing = true;
      timerId = setTimeout(tick, holdTime);
      return;
    }

    if (i > 0) {
      i--;
      timerId = setTimeout(tick, eraseSpeed);
      return;
    }

    erasing = false;
    w = (w + 1) % words.length;
    onWordChange?.(words[w], w);
    timerId = setTimeout(tick, pauseTime);
  };

  tick();

  // cleanup-   
  return () => {
    stopped = true;
    if (timerId) clearTimeout(timerId);
  };
};
