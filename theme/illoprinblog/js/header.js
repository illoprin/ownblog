
const header = document.querySelector(".blog-header");

const navbarToggleButton = document.querySelector(".navbar-toggle");
const navbar = document.querySelector(".navbar");
const toggleMobileMenu = () => {
  navbar.classList.toggle("visible");
}
navbarToggleButton.addEventListener("click", toggleMobileMenu);

var lastScrollTop = 0;
window.addEventListener("scroll", () => {
  // Toggle navbar on scroll
  if (navbar.classList.contains("visible")) {
    toggleMobileMenu();
  }
  var scrollTop = window.scrollY || document.documentElement.scrollTop;
  if (scrollTop > lastScrollTop) {
    header.style.top = "-100%"
  } else {
    header.style.top = "1rem";
  }
  lastScrollTop = scrollTop;
})