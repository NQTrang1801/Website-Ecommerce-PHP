@extends('layouts.app-home')

@section('styles')
    <link rel="stylesheet" href="home/styles/pages/cart.css">
    <link rel="stylesheet" href="home/styles/pages/media-cart.css">
@endsection


@section('content')
    @include('home.cart.cart-data')
@endsection

@section('scripts')
    {{-- <script type="module" src="home/scripts/cart.js"></script> --}}
    <script>
        $(document).ready(function() {
            const divData = $('.items-cart');
            const options = {
                weekday: 'long',
                month: 'long',
                day: 'numeric'
            };
            const dateFormatter = new Intl.DateTimeFormat('en-US', options);

            const currentDate = new Date();
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth() + 1;
            const day = currentDate.getDate();
            cart.date = {
                year: year,
                month: month,
                day: day
            };
            localStorage.setItem("cart", JSON.stringify(cart));
            renderCart();

            $('.item-quantity').each(function() {
                const domQTY = $(this).find("span");
                $(this).find("button").eq(0).on("click", function() {
                    const index = $(this).data("index");
                    const domTotalCost = $(`.total-cart-${index}`);
                    if (Number(domQTY.text()) > 1) {
                        const product = cart[index];
                        product.QuantityPurchased--;
                        localStorage.setItem("cart", JSON.stringify(cart));
                        domQTY.text(Number(domQTY.text()) - 1);
                        if (product.promo == null)
                            product.promo = 0;
                        domTotalCost.text(product.price * (1 - product.promo) * product
                            .QuantityPurchased);
                        renderSumary();
                        renderDropDownCart();
                    }
                });

                $(this).find("button").eq(1).on("click", function() {
                    const index = $(this).data("index");
                    const domTotalCost = $(`.total-cart-${index}`);
                    const product = cart[index];
                    product.QuantityPurchased++;
                    localStorage.setItem("cart", JSON.stringify(cart));
                    domQTY.text(Number(domQTY.text()) + 1);
                    if (product.promo == null)
                        product.promo = 0;
                    domTotalCost.text(product.price * (1 - product.promo) * product
                        .QuantityPurchased);
                    renderSumary();
                    renderDropDownCart();
                });
            });

            $(document).on('click', '.ri-close-line', function() {
                const index = $(this).data("index");
                cart.splice(index, 1);
                localStorage.setItem("cart", JSON.stringify(cart));
                location.reload();
            });

            function renderCart() {
                const divData = $('.items-cart');
                divData.empty();
                let indexItem = 0;

                cart.forEach(item => {
                    let shipingDate = new Date(currentDate);
                    shipingDate.setDate(currentDate.getDate() + 7);

                    let promoValue = '';
                    let discountPrice = '';

                    discountPrice = (item.price * Number(item.promo)).toLocaleString('vi-VN');
                    promoValue = item.promo;
                    const formattedTotal = (item.promo != null) ?
                        (item.price * (1 - promoValue) * item.QuantityPurchased).toLocaleString('vi-VN') :
                        '';

                    const htmlContent = `
                    <div class="item-wrapper js-index-item-${indexItem}">
                        <div>
                            <img src="/uploads/product/variantss/thumb/${item.image}" alt="" width="100%">
                        </div>
                        <div>
                            <div class="item-attb">
                                <p href="#">${item.title}</p>
                                <p>Color: <span>${item.ColorName}</span></p>
                                <p>Size: <span>${item.SizeName}</span></p>
                                <p>#<span>${item.id}</span></p>
                            </div>
                            ${item.promo != null ? `<p class="item-sale">Enjoy ${promoValue*100}% Off Select Styles - ${item.promotion.name}</p>` : ''}
                            <div class="item-quantity">
                                <button data-index="${indexItem}">-</button>
                                <p>QTY: <span>${item.QuantityPurchased}</span></p>
                                <button data-index="${indexItem}">+</button>
                            </div>
                        </div>
                        <div>
                            <div class="item-interact">
                                <a href="/Products/UpdateCart?indexCart=${indexItem}&productId=${item.product_id}">
                                        <i class="ri-pencil-line"></i>
                                </a>
                                <i class="ri-heart-line"></i>
                                <i class="ri-close-line" data-product-id="${item.product_id}" data-index="${indexItem}"></i>
                            </div>
                            <div class="price-container">
                                <p><span class="price-cart">${item.promo != null ? item.price.toLocaleString('vi-VN') : ""}</span></p>
                                <div class="inf-sale">
                                    <div>
                                        ${item.promo != null ? `<p class="item-sale">Enjoy ${promoValue*100}% Off Select Styles</p>` : ''}
                                        ${item.promo != null ? `<p>-<span class="price-sale">${discountPrice}</span></p>` : ''}
                                    </div>
                                </div>
                                        <p>${item.promo != null ? `<span class="total-cart-${indexItem}">${formattedTotal}</span> VND` : `<span class="total-cart-${indexItem}">${(item.price*item.QuantityPurchased).toLocaleString('vi-VN')} VND</span>`}</p>
                            </div>
                        </div>
                    </div>
                `;

                    divData.append(htmlContent);
                    indexItem++;
                });

                renderSumary();
                renderDropDownCart();
            }

            function sumCartTotal() {
                let total = 0;

                cart.forEach(item => {
                    const promoValue = item.promo;
                    total += item.price * (1 - promoValue) * item.QuantityPurchased;
                });

                return total;
            }

            function renderSumary() {
                const divSumary = $(".inf-order");
                const subtotal = sumCartTotal();
                @if (Route::has('login'))
                    @auth
                    const shipping = 0;
                @else
                    const shipping = 40000;
                @endauth
            @endif
            const estimatedTotal = subtotal + shipping;

            divSumary.html(`
                <p>Subtotal</p>
                <p><span>${subtotal.toLocaleString('vi-VN')}</span> VND</p>
                <p>Standard Shipping</p>
                <p><span>${shipping.toLocaleString('vi-VN')}</span> VND</p>
                <p>Free when you <a href="login">Sign in</a> or <a href="login">Create an Account</a></p>
                <p></p>
                <p>Estimated Total</p>
                <p><span id="cost-cart">${estimatedTotal.toLocaleString('vi-VN')}</span> VND</p>
                <p>Taxes finalized at the end of checkout</p>
            `);
        }

        $(".checkout-wapper button").on("click", function() {
            let total = $("#cost-cart").text();
            window.location.href = `/Orders?total=${total}`;
        });

        });
    </script>
@endsection
