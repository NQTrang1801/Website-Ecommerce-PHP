<!doctype html>
<html lang="en">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Meta -->
		<meta name="description" content="Responsive Bootstrap Admin Dashboards">
		<meta name="author" content="Bootstrap Gallery" />
		<link rel="canonical" href="https://www.bootstrap.gallery/">
		<meta property="og:url" content="https://www.bootstrap.gallery">
		<meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
		<meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
		<meta property="og:type" content="Website">
		<meta property="og:site_name" content="Bootstrap Gallery">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<!-- Title -->
		<title>Admin Dashboards Private</title>

		<!-- *************
			************ Common Css Files *************
		************ -->

		<!-- Animated css -->
		<link rel="stylesheet" href="{{asset('admin/assets/css/animate.css')}}">

		<!-- Bootstrap font icons css -->
		<link rel="stylesheet" href="{{asset('admin/assets/fonts/bootstrap/bootstrap-icons.css')}}">

		<!-- Main css -->
		<link rel="stylesheet" href="{{asset('admin/assets/css/main.min.css')}}">


		<!-- *************
			************ Vendor Css Files *************
		************ -->
		
		<link rel="stylesheet" href="{{asset('admin/assets/vendor/dropzone/dropzone.min.css')}}">
		<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
		<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
		
		<!-- Scrollbar CSS -->
		<link rel="stylesheet" href="{{asset('admin/assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}">
		@vite(['resources/css/app.css', 'resources/js/app.js'])
  		@livewireStyles
		@yield('styles')
	</head>

	<body>

		<!-- Loading wrapper start -->
		<div id="loading-wrapper">
			<div class="spinner">
				<div class="line1"></div>
				<div class="line2"></div>
				<div class="line3"></div>
				<div class="line4"></div>
				<div class="line5"></div>
				<div class="line6"></div>
			</div>
		</div>
		<!-- Loading wrapper end -->

		<!-- Page wrapper start -->
		<div class="page-wrapper">

			<!-- Sidebar wrapper start -->
			<nav class="sidebar-wrapper">

				<!-- Sidebar brand starts -->
				<div class="sidebar-brand">
					<a href="{{route('home.index')}}" class="logo">
						<img style="border-radius: 100%" src="{{asset('pictures/icon/Logo.png')}}" alt="Max Admin Dashboard" />
					</a>
				</div>
				<!-- Sidebar brand starts -->

				<!-- Sidebar menu starts -->
				@include('admin.layouts.slidebar-menu')
				<!-- Sidebar menu ends -->

			</nav>
			<!-- Sidebar wrapper end -->

			<!-- *************
				************ Main container start *************
			************* -->
			<div class="main-container">

				<!-- Page header starts -->
				<div class="page-header">

					<div class="toggle-sidebar" id="toggle-sidebar"><i class="bi bi-list"></i></div>

					<!-- Breadcrumb start -->
					@yield('title')
					<!-- Breadcrumb end -->

					<!-- Header actions ccontainer start -->
					<div class="header-actions-container">

						<!-- Search container start -->
						<div class="search-container">

							<!-- Search input group start -->
							@yield('search-content')
							<!-- Search input group end -->

						</div>
						<!-- Search container end -->

						<!-- Header actions start -->
						<ul class="header-actions">

							<!-- Messages start -->
							<li class="dropdown">
								<a href="#" data-toggle="dropdown" aria-haspopup="true">
									<i class="bi bi-bell fs-4 lh-1"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-end shadow">
									<div class="dropdown-item">
										<div class="d-flex py-2 border-bottom">
											<img src="" class="img-4x me-3 rounded-3" alt="" />
											<div class="m-0">
												<h6 class="mb-1"></h6>
												<p class="mb-2"></p>
												<p class="small m-0 text-secondary"></p>
											</div>
										</div>
									</div>
								</div>
							</li>
							<!-- Messages end -->

							<li style="margin-bottom: 35px;">
								@livewire('navigation-menu')
							</li>
						</ul>
						<!-- Header actions end -->

					</div>
					<!-- Header actions ccontainer end -->

				</div>
				<!-- Page header ends -->

				<!-- Content wrapper scroll start -->
				<div class="content-wrapper-scroll">
					@yield('content')
					<!-- App Footer start -->
					<div class="app-footer">
						<span>© Private 2023</span>
					</div>
					<!-- App footer end -->

				</div>
				
				<!-- Content wrapper scroll end -->

			</div>
			<!-- *************
				************ Main container end *************
			************* -->

		</div>
		<!-- Page wrapper end -->

		<!-- *************
			************ Required JavaScript Files *************
		************* -->
		<!-- Required jQuery first, then Bootstrap Bundle JS -->
		<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
		<script src="{{asset('admin/assets/js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{asset('admin/assets/js/modernizr.js')}}"></script>
		<script src="{{asset('admin/assets/js/moment.js')}}"></script>

		<!-- *************
			************ Vendor Js Files *************
		************* -->
		<script src="{{asset('admin/assets/vendor/dropzone/dropzone.min.js')}}"></script>

		<!-- Overlay Scroll JS -->
		<script src="{{asset('admin/assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js')}}"></script>
		<script src="{{asset('admin/assets/vendor/overlay-scroll/custom-scrollbar.js')}}"></script>

		<!-- Apex Charts -->
		<script src="{{asset('admin/assets/vendor/apex/apexcharts.min.js')}}"></script>
		<script src="{{asset('admin/assets/vendor/apex/custom/sales/sparkline.js')}}"></script>
		<script src="{{asset('admin/assets/vendor/apex/custom/sales/salesGraph.js')}}"></script>
		<script src="{{asset('admin/assets/vendor/apex/custom/sales/revenueGraph.js')}}"></script>
		<script src="{{asset('admin/assets/vendor/apex/custom/sales/taskGraph.js')}}"></script>

		<!-- Vector Maps -->
		<script src="{{asset('admin/assets/vendor/jvectormap/jquery-jvectormap-2.0.5.min.js')}}"></script>
		<script src="{{asset('admin/assets/vendor/jvectormap/world-mill-en.js')}}"></script>
		<script src="{{asset('admin/assets/vendor/jvectormap/gdp-data.js')}}"></script>
		<script src="{{asset('admin/assets/vendor/jvectormap/custom/world-map-markers2.js')}}"></script>
		
		
		<!-- Main Js Required -->
		<script src="{{asset('admin/assets/js/main.js')}}"></script>

		<!-- customJS -->
		@yield('customJs')
		@livewireScripts

	</body>

</html>