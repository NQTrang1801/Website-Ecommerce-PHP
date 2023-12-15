@extends('layouts.app-home')

@section('styles')
    <link rel="stylesheet" href="home/styles/pages/cart.css">
    <link rel="stylesheet" href="home/styles/pages/media-cart.css">
@endsection


@section('content')
    @include('home.cart.cart-data')
@endsection

@section('scripts')
    <script type="module" src="home/scripts/cart.js"></script>
@endsection