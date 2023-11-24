@extends('layouts.app-home')

@section('styles')
    <base href="/public">
    <link rel="stylesheet" href="home/styles/pages/categories.css" />
    <link rel="stylesheet" href="home/styles/pages/media-categories.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
@endsection

@section('content')
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
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script type="module" src="home/scripts/categories.js"></script>
@endsection
