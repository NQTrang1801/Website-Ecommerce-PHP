import { cart, save } from "../backend/cart.js";
import { products } from "../backend/products.js";
document.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const productId = urlParams.get('productId');

  console.log(productId); 

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
  domImageLeft.innerHTML = htmlImgLeft;

  let htmlImgRight = `
        <img src="${data.image[0]}" alt=""></img>
    `;

  domImageRight.innerHTML = htmlImgRight;
  domImageLeft.querySelectorAll('div').forEach((item) => {
    item.addEventListener('click', () => {
      domImageRight.querySelector('img').src = item.querySelector('img').src;
    });
  });


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

  domSumary.innerHTML = htmlSumary;

  document.querySelector(".summary-color-item").querySelectorAll('div').forEach(item => {
    item.addEventListener('click', () => {
      const content = item.querySelector("img").dataset.content;
      document.querySelector(".summary-color").querySelector("div").querySelector("p").nextElementSibling.textContent = data.image_color[content].color;
    })
  });


  // Add To Cart
  document.querySelector('.js-btn-add-cart').addEventListener('click', () => {
    console.log("ok");
    const exItem = cart.find(item => item.productId === productId);
    if (exItem) {
      exItem.quantity++;
    } else {
      cart.push({ productId, quantity: 1 });
    }
    save();
    location.reload();
  });
});