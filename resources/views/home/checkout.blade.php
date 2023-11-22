<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @include('home.frame-css')
    <link rel="stylesheet" href="home/styles/pages/checkout.css">

    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <!-- HEADER -->
    @include('home.header')

    <main>
        @include('home.checkout-form')
    </main>

    @include('home.footer')
    <script type="module" src="home/scripts/index.js"></script>
    <script src="home/scripts/checkout.js"></script>
</body>

</html>