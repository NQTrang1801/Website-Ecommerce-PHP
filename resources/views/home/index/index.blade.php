@extends('layouts.app-home')

@section('styles')
<link rel="stylesheet" href="home/styles/pages/index-body.css">
@endsection

@section('content')
  <main class="main-index">
    <!-- private-header-video -->
    @include('home.index.index-video')

    <!-- first section -->
    @include('home.index.index-first-section')

    <!-- second section -->
    @include('home.index.index-second-section')

    <!-- third section -->
    @include('home.index.index-third-section')

  </main>
@endsection

@section('scripts')
<script src="home/scripts/index-body.js"></script>
@endsection

