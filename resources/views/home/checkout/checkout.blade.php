@extends('layouts.app-home')

@section('styles')
<base href="/public">
<link rel="stylesheet" href="home/styles/pages/checkout.css">
@endsection
    

@section('content')
    <main>
        @include('home.checkout.checkout-form')
    </main>
@endsection

@section('scripts')
    <script src="home/scripts/checkout.js"></script>
@endsection
