import { cart, save } from "../data/cart-data.js";
import { products } from "../data/products.js";

document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const productId = urlParams.get('productId');

  const data = products.find(item => item.productId === productId);
  const domImageLeft = document.querySelector('.detail-image-left');
  const domImageRight = document.querySelector('.detail-image-right');
  const domSumary = document.querySelector('.product-detail-summary');

  let htmlImgLeft = `
    <div>
    <img src="${data.image[0]}" alt="">
  </div>
  <div>
    <img src="${data.image[1]}" alt="">
  </div>
  <div>
    <img src="${data.image[2]}" alt="">
  </div>
  <div>
    <img src="${data.image[3]}" alt="">
  </div>
    `;

  let htmlImgRight = `
        <img src="${data.image[0]}" alt=""></img>
    `;

  let htmlSumary = `
    <div class="detail-summary">
          <div class="summary-name">
            <p>${data.name}</p>
            <p class="detail-price">$${data.current_price}</p>
          </div>
          <div class="summary-color">
            <div>
              <p>Color</p>
              <p style="font-weight: 600;">${data.image_color[0].color}</p>
            </div>
            <div class="summary-color-item">
              <div>
                <img src="${data.image_color[0].img}" data-content="0" alt="">
              </div>
              <div>
                <img src="${data.image_color[1].img}" data-content="1" alt="">
              </div>
              <div>
                <img src="${data.image_color[2].img}" data-content="2" alt="">
              </div>
            </div>
          </div>
          <div class="summary-size">
            <div>
              Size
              <i class="ri-arrow-down-s-line"></i>
            </div>
            <div>
              <p class="product-size-guide">Size Guide</p>
              <div class="product-size">
                <div>${data.sizes[0]}</div>
                <div>${data.sizes[1]}</div>
                <div>${data.sizes[2]}</div>
                <div>${data.sizes[3]}</div>
                <div>${data.sizes[4]}</div>
              </div>
            </div>
          </div>
          <div class="summary-button">
            <button class="js-btn-add-cart">Add to cart</button>
          </div>
          <div>
            <pre>${data.description}
              </pre>
          </div>
        </div>

        <div class="detail-reference">
          <div class="reference-title">
            <div>
              PRODUCTS DETAILS
              <i class="ri-arrow-down-s-line"></i>
            </div>
            <p>
              ${data.suggestion}
            </p>
          </div>
          <div class="reference-title">
            <div>
              CARE
              <i class="ri-arrow-down-s-line"></i>
            </div>
            <pre>
              ${data.care}
            </pre>
          </div>
        </div>
    `;

  domImageLeft.innerHTML = htmlImgLeft;
  domImageRight.innerHTML = htmlImgRight;
  domSumary.innerHTML = htmlSumary;

  const divLefts = domImageLeft.querySelectorAll('div');
  const divColors = document.querySelector('.summary-color-item').querySelectorAll('div');
  const divSizes = document.querySelector('.product-size').querySelectorAll('div');
  divLefts[0].classList.add("click-img-left");
  divLefts[0].style.borderBottom = "2px solid var(--primary-color)";
  divColors[0].style.borderBottom = "2px solid var(--primary-color)";
  divSizes[0].style.border = "3px solid var(--primary-color)";

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

  divColors.forEach(item => {
    item.addEventListener('click', () => {
      const content = item.querySelector("img").dataset.content;
      document.querySelector(".summary-color").querySelector("div").querySelector("p").nextElementSibling.textContent = data.image_color[content].color;
      item.style.borderBottom = "2px solid var(--primary-color)";
      divColors.forEach((div) => {
        if (div.innerHTML !== item.innerHTML) {
          div.style.borderBottom = "none";
        }
      })
    })
  });

  divSizes.forEach(item => {
    item.addEventListener('click', () => {
      item.style.border = "3px solid var(--primary-color)";
      divSizes.forEach((div) => {
        if (div.innerHTML !== item.innerHTML) {
          div.style.border = "1px solid var(--primary-color)";
        }
      })
    })
  });

  // Add To Cart
  document.querySelector('.js-btn-add-cart').addEventListener('click', () => {
      cart.push({ productId, quantity: 1 });
    save();
    location.reload();
  });
});