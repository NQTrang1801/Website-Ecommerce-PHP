import { products } from "../backend/products.js";
<<<<<<< HEAD
import { cart } from "../backend/cart.js";
=======
import { cart} from "../backend/cart.js";
>>>>>>> 328e4d0168e7cfca8dc2a332f1f403d6047332e8
// Scroll header
$(document).ready(function () {
  const headerElement = $(".private-header");
  const searchContainer = $(".js-search-navbar");
  const cartContainer = $(".js-cart-navbar");

  $(document).scroll(function () {
    if (window.scrollY > 0) {
      headerElement.addClass("scrolled");
      searchContainer.addClass("scrolled");
      cartContainer.addClass("scrolled");
    } else {
      headerElement.removeClass("scrolled");
      searchContainer.removeClass("scrolled");
      cartContainer.removeClass("scrolled");
    }
  });

  // Search container
  $(".header-search").click(function () {
    $(".js-search-navbar").slideToggle("slow");
    $(".private-header").addClass("hovered");
    $(document).on("click", function (event) {
      const elementBox = $(".js-search-navbar");
      const elementIcon = $(".header-search");
      if (!elementBox.is(event.target) && elementBox.has(event.target).length === 0
        && !elementIcon.is(event.target) && elementIcon.has(event.target).length === 0) {
        $(".js-search-navbar").css({ "display": "none" });
      }
    })
  });

  // Menu container
  $(".js-menu-btn").click(function () {
    $('.js-menu-navbar').css({ "left": "0px" });
    $("#overlay").css({ "display": "block" });
    $("body").css({ "overflow": "hidden" });
  });

  $(".nav-close").click(function () {
    closeMenuBar();
  });

  $("#overlay").click(function (event) {
    closeMenuBar();
  });

  function closeMenuBar() {
    $(".js-menu-navbar").css({ "left": "-500px" });
    $("#overlay").css({ "display": "none" });
    $("body").css({ "overflow": "scroll" });
  }

  // dropdown cart render
  // render dropdown cart
  let htmlDropdownCart = ``;
  const divCartContent = document.querySelector('.js-cart-content');
  let sumQuantityCart = 0;
  let sumCost = 0;
  cart.forEach(item => {
    sumQuantityCart += item.quantity;
    const infoItemCart = products.find(product => item.productId === product.productId);
<<<<<<< HEAD
    sumCost += item.quantity * infoItemCart.current_price;
    htmlDropdownCart += `
                <div class="cart-box">
                  <div class="cart-image">
                    <img src="${infoItemCart.image[0]}">
                  </div>
                  <div class="cart-info">
                    <p>${infoItemCart.name}</p>
                    <p>COLOR: <span>${infoItemCart.image_color[0].color}</span></p>
=======
    sumCost += item.quantity*infoItemCart.current_price;
    console.log(item);
    console.log(infoItemCart.colors[0]);
    htmlDropdownCart += `
                <div class="cart-box">
                  <div class="cart-image">
                    <img src="${infoItemCart.image}">
                  </div>
                  <div class="cart-info">
                    <p>${infoItemCart.name}</p>
                    <p>COLOR: <span>${infoItemCart.colors[0]}</span></p>
>>>>>>> 328e4d0168e7cfca8dc2a332f1f403d6047332e8
                    <p>SIZE: <span>${infoItemCart.sizes[0]}</span></p>
                    <p>QTY: <span>${item.quantity}</span></p>
                    <p>$<span>${infoItemCart.current_price}</span></p>
                  </div>
                </div>
  `
  });
  divCartContent.innerHTML = htmlDropdownCart;
  const shoppingBag = document.querySelector('.ri-shopping-bag-line');
  shoppingBag.setAttribute('data-content', sumQuantityCart);
<<<<<<< HEAD
=======
  console.log(sumCost);
>>>>>>> 328e4d0168e7cfca8dc2a332f1f403d6047332e8
  document.querySelector('.cart-price').querySelector('p').nextElementSibling.querySelector('span').innerHTML = sumCost;
  document.querySelector('.cart-checkout').querySelector('span').innerHTML = sumQuantityCart;

});


