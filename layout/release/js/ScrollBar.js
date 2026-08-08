

/**
 * Initializes the scroll bar.
 *
 * @param      {string}  [containerName='.scroll-progress-container']  The container name
 * @param      {string}  [barClass='.scroll-progress-bar']             The bar class
 * 
 * @details changes 'width' property of bar element
 */
function initScrollBar(containerName = '.scroll-progress-container', barClass = '.scroll-progress-bar'){
  const container = document.querySelector(containerName);
  const bar = document.querySelector(barClass);

  window.addEventListener('scroll', () => {
    if (window.scrollY > 25) {
      
      // show progress bar
      container.classList.add('visible');

      // calculate scroll progress
      const winHeight = window.innerHeight;
      const documentHeight = document.documentElement.scrollHeight;
      const totalScrollableDistance = documentHeight - winHeight;
      const progress = window.scrollY / (totalScrollableDistance || 0.01);

      // if progress > 97% => hide progress bar
      if (progress > 0.97) {
        bar.style.width = `100%`;
        container.classList.remove('visible');
        return;
      }

      // set width
      bar.style.width = `${progress * 100.0}%`;

    } else {
      container.classList.remove('visible');
    }
  });
}