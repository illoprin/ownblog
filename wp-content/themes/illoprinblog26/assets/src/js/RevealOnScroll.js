/* ---------- Reveal on scroll ---------- */
const createRevealOnScrollEffect = (revealClass = ".reveal", visibleClass = ".visible") => {
  const items = document.querySelectorAll(revealClass);
  if (reduceMotion || !("IntersectionObserver" in window)) {
    items.forEach((el) => el.classList.add(visibleClass));
    return;
  }
  const io = new IntersectionObserver(
    (entries, obs) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        // лёгкий каскад внутри одного ряда
        const delay = [...entry.target.parentElement.children].indexOf(
          entry.target,
        );
        entry.target.style.transitionDelay = `${Math.min(delay, 5) * 80}ms`;
        entry.target.classList.add("visible");
        obs.unobserve(entry.target);
      });
    },
    { threshold: 0.12, rootMargin: "0px 0px -60px 0px" },
  );
  items.forEach((el) => io.observe(el));
};