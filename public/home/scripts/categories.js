import { cart, sumCostData, save } from "../data/cart-data.js";
// Khởi tạo Swiper
const swiper = new Swiper('.sliderbox', {
  loop: true,
  effect: 'fade',
  autoHeight: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});

document.addEventListener("DOMContentLoaded", function () {

  const path = window.location.pathname;

  const pathComponents = path.split('/').filter(component => component !== '');
  const [category, subcategory] = pathComponents;
  
  document.querySelector(".slider .title").innerHTML = decodeURIComponent(subcategory.toUpperCase());

});

document.getElementById('special-prices-link').addEventListener('click', function (e) {
  e.preventDefault(); // Prevent default behavior of the link

  const section = document.getElementById('special-prices');

  if (section) {
    section.scrollIntoView({
      behavior: 'smooth'
    });
  }
});

document.getElementById('products-categories-link').addEventListener('click', function (e) {
  e.preventDefault(); // Prevent default behavior of the link

  const section = document.getElementById('products-categories');

  if (section) {
    section.scrollIntoView({
      behavior: 'smooth'
    });
  }
});



// Function to handle smooth scrolling to a section
function scrollToSection(id) {
  const section = document.getElementById(id);
  
  if (section) {
    section.scrollIntoView({
      behavior: 'smooth'
    });
  }
}

// Add event listeners to all links with class 'category-link'
document.querySelectorAll('.category-link').forEach(link => {
  link.addEventListener('click', function (e) {
    e.preventDefault(); // Prevent default behavior of the link
    const sectionId = this.getAttribute('data-section-id');
    scrollToSection(sectionId);
  });
});
