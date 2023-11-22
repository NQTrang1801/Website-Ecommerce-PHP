<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    @include('home.frame-css')
    <link rel="stylesheet" href="home/styles/pages/categories.css">
    <link rel="stylesheet" href="home/styles/pages/media-categories.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    @include('home.header')
    <main>
        @include('home.categories-slider')
        <!-- special price -->
        @include('home.categories-top-show')
        <!-- products-categories -->
        @include('home.categories-types-of-product')

        <!-- categories -->
        @include('home.categories-products')
        <!-- banner -->
        <div class="banner">
            <div class="container">
                <div class="wrap">
                    <div class="content">
                        <span>Promo</span>
                        <h3 class="title1">Get ready!<br>Winter is coming</h3>
                        <div class="button"><a href="">Go get it</a></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FormIG -->
        @include('home.categories-instagram')
    </main>
    @include('home.footer')

    <script type="module" src="home/scripts/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script type="module" src="home/scripts/categories.js"></script>

</body>

</html>