@extends('admin.layouts.app')

@section('title')
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<i class="bi bi-house"></i>
	</li>
	<li class="breadcrumb-item breadcrumb-active" aria-current="page">PRIVATE</li>
</ol>
@endsection

@section('search-content')
<div class="input-group">
	<input type="text" class="form-control" placeholder="Search">
	<button class="btn" type="button">
		<i class="bi bi-search"></i>
	</button>
</div>
@endsection

@section('content')
<div class="content-wrapper-scroll">

	<!-- Content wrapper start -->
	<div class="content-wrapper" style="display: flex; justify-content: center">

		<img style="border-radius: 100%" src="{{asset('pictures/icon/Logo.png')}}" alt="Max Admin Dashboard" />
		<!-- Row start -->

		<!-- Row end -->

		<!-- Row start -->

		<!-- Row end -->

		<!-- Row start -->

		<!-- Row end -->

		<!-- Row start -->

		<!-- Row end -->

		<!-- Row start -->

		<!-- Row end -->

	</div>
	<!-- Content wrapper end -->

	<!-- App Footer start -->
	<div class="app-footer">
		<span>© Private</span>
	</div>
	<!-- App footer end -->

</div>
@endsection