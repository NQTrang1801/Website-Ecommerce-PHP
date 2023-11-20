<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
   @include('home.frame-css')
  <link rel="stylesheet" href="home/styles/pages/media-index.css">
  <link rel="stylesheet" href="home/styles/pages/index-body.css">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
  <!-- HEADER -->
  @include('home.header')
  <main class="main-index">
    <!-- private-header-video -->
    @include('home.index-video')

    <!-- first section -->
    @include('home.index-first-section')

    <!-- second section -->
    @include('home.index-second-section')

    <!-- third section -->
    @include('home.index-third-section')

  </main>
  <!-- FOOTER -->
  @include('home.footer')
  <script type="module" src="home/scripts/index.js"></script>
  <script src="home/scripts/index-body.js"></script>
</body>

</html>

