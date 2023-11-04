import { cart, save} from "../data/cart-data.js";

document.addEventListener('DOMContentLoaded', () => {
    const divData = document.querySelector('.items-cart');
    const options = { weekday: 'long', month: 'long', day: 'numeric' };
    const dateFormatter = new Intl.DateTimeFormat('en-US', options);

    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth() + 1;
    const day = currentDate.getDate();
    cart.date = {year : year, month : month, day : day};
    save();
    renderCart();

    // sự kiện tăng giảm số lượng sản phẩm
    const divBtnQTY = document.querySelectorAll('.item-quantity');
    divBtnQTY.forEach((div) => {
        const domQTY = div.querySelector("span");
        div.querySelectorAll("button")[0].addEventListener("click", () => {
            const index = div.querySelectorAll("button")[0].dataset.index;
            const domTotalCost = document.querySelector(`.total-cart-${index}`);
            if (Number(domQTY.innerHTML) > 1) {
                const product = cart[index];
                product.quantity--;
                save();
                domQTY.innerHTML = Number(domQTY.innerHTML) - 1;
                domTotalCost.innerHTML = product.price * (1 - product.sales) * product.quantity;
                renderSumary();
                renderDropDownCart();
            }
        });

        div.querySelectorAll("button")[1].addEventListener("click", () => {
            const index = div.querySelectorAll("button")[1].dataset.index;
            const domTotalCost = document.querySelector(`.total-cart-${index}`);
            const product = cart[index];
            product.quantity++;
            save();
            domQTY.innerHTML = Number(domQTY.innerHTML) + 1;
            domTotalCost.innerHTML = product.price * (1 - product.sales) * product.quantity;
            renderSumary();
            renderDropDownCart();
        });
    })

    // sự kiện xóa sản phẩm
    document.querySelectorAll('.ri-close-line').forEach((X) => {
        X.addEventListener("click", () => {
            const index = X.dataset.index;
            cart.splice(index, 1);
            save();
            location.reload();
        });
    })

    // tổng chi phí
    function sumCostData() {
        const totalPrice = cart.reduce((cost, product) => {
            return cost + product.price * (1 - product.sales) * product.quantity;
        }, 0);
        return totalPrice;
    }

    // render cart
    function renderCart() {
        divData.innerHTML = "";
        let indexItem = 0;
        cart.forEach(item => {
            let shipingDate = new Date(currentDate);
            shipingDate.setDate(currentDate.getDate() + 7);
            divData.innerHTML += `
                    <div class="item-wrapper js-index-item-${indexItem}">
                        <div>
                            <img src="${item.image[0]}" alt="" width="100%">
                        </div>
                        <div>
                            <div class="item-attb">
                                <a href="#">${item.name}</a>
                                <p>Color: <span>${item.image_color[0].color}</span></p>
                                <p>Size: <span>${item.sizes[0]}</span></p>
                                <p>#<span>${item.productId}</span></p>
                            </div>
                            <p class="item-sale">Enjoy ${item.sales * 100}% Off Select Styles</p>
                            <div class="item-quantity">
                                <button data-index="${indexItem}">-</button>
                                <p>QTY: <span>${item.quantity}</span></p>
                                <button data-index="${indexItem}">+</button>
                            </div>
                            <div class="delivery-shipping-container">
                                <button>DELIVERY</button><button>VOUCHER</button>
                                <p><i class="ri-truck-line"></i>Standard Shipping Receive by <span>${dateFormatter.format(shipingDate)}</span></p>
                            </div>
                        </div>
                        <div>
                            <div class="item-interact">
                                <a href="product-detail.html?productId=${item.productId}&&color=${item.image_color[0].color}&&size=${item.sizes[0]}&&index=${indexItem}"><i class="ri-pencil-line"></i></a>
                                <i class="ri-heart-line"></i>
                                <i class="ri-close-line" data-product-id="${item.productId}" data-index="${indexItem}"></i>
                            </div>
                            <div class="price-container">
                                <p>$<span class="price-cart">${item.price}</span></p>
                                <div class="inf-sale">
                                    <div>
                                        <p class="item-sale">Enjoy ${item.sales * 100}% Off Select Styles</p>
                                        <p>-$<span class="price-sale">${item.price * item.sales}</span></p>
                                    </div>
                                </div>
                                <p>$<span class="total-cart-${indexItem}">${item.price * (1 - item.sales) * item.quantity}</span></p>
                            </div>
                        </div>
                    </div>
                    `;
            indexItem++;
        });
        renderSumary();
        renderDropDownCart();
    };

    // render sumary
    function renderSumary() {
        const divSumary = document.querySelector(".inf-order");
        divSumary.innerHTML = `
                            <p>Subtotal</p>
                            <p>$<span>${sumCostData()}</span></p>
                            <p>Standard Shipping</p>
                            <p>$<span>${2}</span></p>
                            <p>Free when you <a href="account.html">Sign in</a> or <a href="account.html">Create an Account</a></p>
                            <p></p>
                            <p>Estimated Total</p>
                            <p>$<span>${sumCostData() + 2}</span></p>
                            <p>Taxes finalized at the end of checkout</p>
            `;    
    }

    // render dropdown cart
    function renderDropDownCart() {
        let htmlDropdownCart = ``;
        const divCartContent = document.querySelector('.js-cart-content');
        let sumQuantityCart = 0;

        cart.forEach(item => {
            sumQuantityCart += item.quantity;
            htmlDropdownCart += `
                <div class="cart-box">
                  <div class="cart-image">
                    <img src="${item.image[0]}">
                  </div>
                  <div class="cart-info">
                    <p>${item.name}</p>
                    <p>COLOR: <span>${item.image_color[0].color}</span></p>
                    <p>SIZE: <span>${item.sizes[0]}</span></p>
                    <p>QTY: <span>${item.quantity}</span></p>
                    <p>$<span>${item.price * (1 - item.sales)}</span></p>
                  </div>
                </div>
                `;
        });
        divCartContent.innerHTML = htmlDropdownCart;
        const shoppingBag = document.querySelector('.ri-shopping-bag-line');
        shoppingBag.setAttribute('data-content', sumQuantityCart);
        document.querySelector('.cart-price').querySelector('p').nextElementSibling.querySelector('span').innerHTML = sumCostData();
        document.querySelector('.cart-checkout').querySelector('span').innerHTML = sumQuantityCart;
    };

    // move checkout.html
    document.querySelector(".checkout-wapper").querySelector("button").addEventListener("click", () => {
        window.location.href = `checkout.html?subtotal=${sumCostData()}`;
    });
});