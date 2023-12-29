<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Private</title>
  @yield('styles')
  <link rel="stylesheet" href="home/styles/shared/general.css">
  <link rel="stylesheet" href="home/styles/pages/index.css">
  <link rel="stylesheet" href="home/styles/pages/nav.css">
  <link rel="stylesheet" href="home/styles/pages/footer.css">
  <link rel="stylesheet" href="home/styles/pages/media-footer.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body>
  <!-- HEADER -->
  @include('layouts.header')
 
  @yield('content')

  <!-- FOOTER -->
  @include('layouts.footer')

  <script type="module" src="home/scripts/index.js"></script>
  @yield('scripts')
  @livewireScripts

  <script>
    const searchInput = document.querySelector('.search-input input');

    searchInput.addEventListener('input', function(event) {
        const keyword = event.target.value.trim();

        if (keyword === '') {
            document.querySelector('.search-matched-title p').innerText = 'Popular Categories';
            $.ajax({
                url: '{{ route("categories.getIsFeatured") }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    const categoriesContainer = document.querySelector('.search-matched-categories');
                    categoriesContainer.innerHTML = '';

                    response.featuredCategories.forEach(category => {
                        const categoryItem = document.createElement('div');
                        categoryItem.classList.add('categories-item');

                        const imageSrc = category.image ? `{{ asset('uploads/category/thumb/') }}/${category.image}` : "{{ asset('uploads/category/thumb/null.png') }}";
                        const categoryHTML = `
                            <img src="${imageSrc}" alt="">
                            <div class="categories-name">
                                <p>${category.name}</p>
                                <a href="/categories/${category.name}">Shop now</a>
                            </div>
                        `;
                        categoryItem.innerHTML = categoryHTML;

                        categoriesContainer.appendChild(categoryItem);
                    });
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        } else {
            document.querySelector('.search-matched-title p').innerText = 'Result';
            const categoriesContainer = document.querySelector('.search-matched-categories');
            categoriesContainer.innerHTML = '';
            $.ajax({
              url: '{{ route("search.products.keyword") }}',
              type: 'GET',
              data: { keyword: keyword },
              dataType: 'json',
              success: function(response) {
                  categoriesContainer.innerHTML = '';

                  response.getProductsByKeyWord.forEach(product => {
                      const productItem = document.createElement('div');
                      productItem.classList.add('categories-item');
                      const imageSrc = product.images_id ? `{{ asset('uploads/product/products/thumb/') }}/${product.images.image_1}` : "{{ asset('uploads/product/products/thumb/null.png') }}";
                      const productHTML = `
                            <img src="${imageSrc}" alt="">
                            <div class="categories-name">
                                <p>${product.title}</p>
                                <a href="/products/women/${product.id}">Shop now</a>
                            </div>
                        `;
                      productItem.innerHTML = productHTML;
                      categoriesContainer.appendChild(productItem);
                  });
              },
              error: function(error) {
                  console.error('Error:', error);
              }
            });
        }
    });

    
    cart = JSON.parse(localStorage.getItem("cart")) || [];

    function addToCart(productId, colorId = null, sizeId = null) {
            $.ajax({
                type: 'POST',
                url: '{{ route("cart.addToCartDefault") }}',
                data: { productId: productId, colorId: colorId, sizeId: sizeId },
                dataType: 'json',
                success: function (response) {
                    if (response.success == true) {
                        let variant = response.variant;
                        variant.QuantityPurchased = 1;
                        variant.ColorName = response.color;
                        variant.SizeName = response.size;
                        variant.promo = response.promotion;
                        cart.push(variant);
                        localStorage.setItem("cart", JSON.stringify(cart));
                        renderDropDownCart();
                    } else {
                        console.error("Not found");
                        
                    }
                },
                error: function (xhr, status, error) {
                    console.error("fail:", error);
                }
            });
        }

    renderDropDownCart();
        function renderDropDownCart() {
            let htmlDropdownCart = ``;
            const divCartContent = document.querySelector('.js-cart-content');
            let sumQuantityCart = 0;
            let sumCost = 0;
            cart.forEach(item => {
                let priceProduct = item.price;
                sumQuantityCart += item.QuantityPurchased
                
                sumCost += item.QuantityPurchased * Number(priceProduct);
                htmlDropdownCart += `
                            <div class="cart-box">
                                <div class="cart-image">
                                <img src="uploads/product/variantss/thumb/${item.image}">
                                </div>
                                <div class="cart-info">
                                <p>${item.title}</p>
                                <p>COLOR: <span>${item.ColorName}</span></p>
                                <p>SIZE: <span>${item.SizeName}</span></p>
                                        <p>QTY: <span>${item.QuantityPurchased}</span></p>
                                        <p><span>${priceProduct}</span> VND</p>
                                </div>
                            </div>
                            `;
            });
            divCartContent.innerHTML = htmlDropdownCart;
            const shoppingBag = document.querySelector('.ri-shopping-bag-line');
            shoppingBag.setAttribute('data-content', sumQuantityCart);
            document.querySelector('.cart-price').querySelector('p').nextElementSibling.querySelector('span').innerHTML = sumCost;
            document.querySelector('.cart-checkout').querySelector('span').innerHTML = sumQuantityCart;
        }
  </script>
</body>

</html>

