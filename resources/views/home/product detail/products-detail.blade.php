@extends('layouts.app-home')

@section('styles')
    <base href="/public">
    <link rel="stylesheet" href="home/styles/pages/product-detail.css">
@endsection

@section('content')
    <main class="main-product-detail">
        <div class="button-back">
            <i class="ri-arrow-left-line"></i>
            Back
        </div>
        <div class="product-detail-container">
            @include('home.product detail.products-detail-data')
            @include('home.product detail.products-details-partner')
            <div></div>
            @include('home.product detail.products-detail-exploring')
        </div>
    </main>

@endsection

@section('scripts')
    <script type="module" src="home/scripts/index.js"></script>
    <script type="module" src="home/scripts/product-detail.js"></script>
@endsection