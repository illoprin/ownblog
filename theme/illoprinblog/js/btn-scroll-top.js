
const btn = document.getElementById("scroll-top");

document.addEventListener("scroll", e => {
  if (window.scrollY > 100) {
    btn.classList.add("visible");
  } else {
    btn.classList.remove("visible");
  }
});

btn.addEventListener("click", e => {
  window.scroll({
    top: 0,
  })
});