
const initTiltEffect = () => {
  if (reduceMotion || window.matchMedia("(hover: none)").matches) return;
  
  const p = `800px`;

  $$('.tilt').forEach(elem => {
    elem.style.transform = `perspective(${p}) rotateX(0) rotateY(0)`
    elem.style.transition = `transform .4s`;

    elem.addEventListener('pointermove', (e) => {
      const box = elem.getBoundingClientRect();

      const x = e.clientX - box.left - box.width  / 2;
      const y = e.clientY - box.top  - box.height / 2;

      elem.style.transform = `perspective(${p}) rotateX(${-y/60}deg) rotateY(${x/60}deg) `;
    });

    elem.addEventListener('pointerleave', (e) => {
      elem.style.transform = `perspective(${p}) rotateX(0) rotateY(0)`
    });

  })
}

document.addEventListener('DOMContentLoaded', () => {
  initTiltEffect();
})