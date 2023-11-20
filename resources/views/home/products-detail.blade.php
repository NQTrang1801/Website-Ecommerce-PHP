<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    @include('home.frame-css')
    <link rel="stylesheet" href="home/styles/pages/product-detail.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <!-- HEADER -->
    @include('home.header')
    <!-- MAIN -->
    <main>
        <div class="button-back">
            <i class="ri-arrow-left-line"></i>
            Back
        </div>
        <div class="product-detail-container">
            @include('home.products-detail-data')
            @include('home.products-details-partner')
            <div></div>
            @include('home.products-detail-exploring')
        </div>
    </main>

    @include('home.footer')
    <script type="module" src="home/scripts/index.js"></script>
    <script type="module" src="home/scripts/product-detail.js"></script>
</body>

</html>