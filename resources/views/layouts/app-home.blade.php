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
</body>

</html>

