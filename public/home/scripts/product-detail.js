import { cart, save } from "../data/cart-data.js";
import { products } from "../data/products.js";

document.addEventListener('DOMContentLoaded', () => {
  let color = "white";
  let size = "XS";

  const path = window.location.pathname;
  const pathComponents = path.split('/').filter(component => component !== '');


  const domImageLeft = document.querySelector('.detail-image-left');
  const domImageRight = document.querySelector('.detail-image-right');
  const domSumary = document.querySelector('.product-detail-summary');

  const divLefts = domImageLeft.querySelectorAll('div');
  const divColors = document.querySelector('.summary-color-item').querySelectorAll('div');
  const divSizes = document.querySelector('.product-size').querySelectorAll('div');

  divLefts[0].classList.add("click-img-left");
 
  divLefts.forEach((item) => {
    item.addEventListener('click', () => {
      domImageRight.querySelector('img').src = item.querySelector('img').src;
      item.classList.add("click-img-left");
      item.style.borderBottom = "2px solid var(--primary-color)";
      divLefts.forEach((div) => {
        if (div.innerHTML !== item.innerHTML) {
          div.classList.remove("click-img-left");
          div.style.borderBottom = "none";
        }
      })
    });
  });

});

