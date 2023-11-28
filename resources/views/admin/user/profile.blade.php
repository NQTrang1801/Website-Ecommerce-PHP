@extends('admin.layouts.app')

@section('title')
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<i class="bi bi-stickies"></i>
	</li>
	<li class="breadcrumb-item breadcrumb-active" aria-current="Profile">Profile</li>
</ol>
@endsection
    
@section('content')
<main style="">
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
