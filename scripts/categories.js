import { products } from "../data/products.js";
import { cart, save } from "../data/cart-data.js";
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
  function renderIteamHTML(items, limit) {
    let html = '';
    let i = 0;
    items.forEach(item => {
      if (i < limit) {
        i++;
      } else {
        return;
      }
      html += `
      <div class="item">
      <div class="dot-image">
          <a href="" class="product-permalink"></a>
          <div class="thumbnail">
              <img src="${item.image[0]}" alt="">
          </div>
          <div class="thumbnail hover">
              <img src="${item.image[1]}" alt="">
          </div>
          <div class="actions">
              <div><i class="ri-heart-line"></i></div>
              <div class="js-btn-add-cart" data-product-id="${item.productId}"><i class="ri-shopping-cart-line"></i></div>
              <a href="product-detail.html?productId=${item.productId}"><i class="ri-eye-line"></i></a>
          </div>
          <div class="label"><span>-${item.sales}</span></div>
      </div>
      <div class="dot-info">
          <h2 class="dot-title"><a href="">${item.name}</a></h2>
          <div class="product-price">
              <span class="before">$${item.before_price}</span>
              <span class="current">$${item.current_price}</span>
          </div>
      </div>
   </div>
      `;

    });
    return html;
  }

  //Special Prices
  const divItemSpecialPrice = document.querySelector('.special-prices .wrapper');
  let limitShowSpecialPrice = 8;
  function RenderSpecialPrice(limit) {
    divItemSpecialPrice.innerHTML = '';
    const specialPrices = products.filter((item) => item.classify[0] === "Women" && item.classify[2] === "SpecialPrices");
    divItemSpecialPrice.innerHTML = renderIteamHTML(specialPrices, limit);
  }

  RenderSpecialPrice(limitShowSpecialPrice);

  const btnSeeMore = document.querySelector('.special-prices .see-more');
  btnSeeMore.addEventListener('click', () => {
    limitShowSpecialPrice += 8;
    RenderSpecialPrice(limitShowSpecialPrice);
  });

  // Products Categories

  // Category-1
  const divItemCategory1 = document.querySelector('.type-1 .wrapper');
  let limitShowView1 = 18;
  function RenderCategoryView1(limit) {
    divItemCategory1.innerHTML = '';
    const productsCategory1 = products.filter((item) => item.classify[0] === "Women" && item.classify[4] === "Coats-and-jackets");
    divItemCategory1.innerHTML = renderIteamHTML(productsCategory1, limit);
  }

  RenderCategoryView1(limitShowView1);

  const btnSeeMore1 = document.querySelector('.type-1 .see-more');
  console.log(btnSeeMore1);
  btnSeeMore1.addEventListener('click', () => {
    limitShowView1 += 18;
    RenderCategoryView1(limitShowView1);
  });

  // Category-2
  const divItemCategory2 = document.querySelector('.type-2 .wrapper');
  let limitShowView2 = 10;
  function RenderCategoryView2(limit) {
    divItemCategory2.innerHTML = '';
    const productsCategory2 = products.filter((item) => item.classify[0] === "Women" && item.classify[4] === "Dresses-and-skirts");
    divItemCategory2.innerHTML = renderIteamHTML(productsCategory2, limit);
  }

  RenderCategoryView2(limitShowView2);

  const btnSeeMore2 = document.querySelector('.type-2 .see-more');
  btnSeeMore2.addEventListener('click', () => {
    limitShowView2 += 10;
    RenderCategoryView2(limitShowView2);
  });

  // Category-3
  const divItemCategory3 = document.querySelector('.type-3 .wrapper');
  let limitShowView3 = 18;
  function RenderCategoryView3(limit) {
    divItemCategory3.innerHTML = '';
    const productsCategory3 = products.filter((item) => item.classify[0] === "Women" && item.classify[4] === "Pants-and-shorts");
    divItemCategory3.innerHTML = renderIteamHTML(productsCategory3, limit);
  }

  RenderCategoryView3(limitShowView3);

  const btnSeeMore3 = document.querySelector('.type-3 .see-more');
  btnSeeMore3.addEventListener('click', () => {
    limitShowView3 += 18;
    RenderCategoryView3(limitShowView3);
  });

  // Category-4
  const divItemCategory4 = document.querySelector('.type-4 .wrapper');
  let limitShowView4 = 10;
  function RenderCategoryView4(limit) {
    divItemCategory4.innerHTML = '';
    const productsCategory4 = products.filter((item) => item.classify[0] === "Women" && item.classify[4] === "Tops-and-shirts");
    divItemCategory4.innerHTML = renderIteamHTML(productsCategory4, limit);
  }

  RenderCategoryView4(limitShowView4);

  const btnSeeMore4 = document.querySelector('.type-4 .see-more');
  btnSeeMore4.addEventListener('click', () => {
    limitShowView4 += 10;
    RenderCategoryView4(limitShowView4);
  });

  // Add To Cart
  document.querySelectorAll('.js-btn-add-cart')
    .forEach((DomAddCart) => {
      DomAddCart.addEventListener('click', () => {
        const productId = DomAddCart.dataset.productId;
        cart.push({ productId, quantity: 1 });
        save();
        this.location.reload();
      });
    });

});

