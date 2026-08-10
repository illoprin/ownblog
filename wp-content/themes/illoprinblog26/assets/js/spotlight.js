
function initSpotlight() {
  if (reduceMotion) return;

  $$(".spotlight").forEach((card) => {
    card.addEventListener("pointermove", (e) => {
      const r = card.getBoundingClientRect();
      card.style.setProperty("--mx", e.clientX - r.left + "px");
      card.style.setProperty("--my", e.clientY - r.top + "px");
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  initSpotlight(); 
});
