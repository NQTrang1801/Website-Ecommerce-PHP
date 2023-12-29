@extends('layouts.app-home')

@section('styles')
    <base href="/public">
    <link rel="stylesheet" href="home/styles/pages/profile.css">
@endsection

@section('content')
    <main>
        <div class="">
            <!-- Page Content -->
            <main style="height: fit-content;">
                {{ $slot }}
            </main>
        </div>
    </main>
@endsection

@section('scripts')
@endsection
